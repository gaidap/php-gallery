<?php
    
    
    class BaseRepository extends DatabaseConnection {
        
        function __construct() {
            parent::__construct();
        }
        
        function delete(BaseEntity $entity): bool|string {
            $stmt = $this->prepareStatement('DELETE FROM ' . $entity->getTable() . ' WHERE id=?');
            $id = $entity->getId();
            $stmt->bind_param('i', $id);
            $stmt->execute();
            
            if ($stmt->errno) {
                return $stmt->error;
            }
            
            return true;
        }
        
        function save(BaseEntity $entity): BaseEntity|string {
            if ($entity->getId()) {
                return $this->update($entity);
            }
            $stmt = $this->prepareStatement($this->createInsertSqlStatement($entity));
            $stmt->bind_param($this->createPropertyTypes($entity),
                ...$this->extractPropertyValues($entity));
            $stmt->execute();
            
            if ($stmt->errno) {
                return $stmt->error;
            }
            
            $entity->setId($stmt->insert_id);
            return $entity;
        }
    
        function update(BaseEntity $entity): BaseEntity|string {
            $stmt = $this->prepareStatement($this->createUpdateSqlStatement($entity));
            $property_values = $this->extractPropertyValues($entity);
            array_push($property_values, $entity->getId());
            $stmt->bind_param($this->createPropertyTypes($entity) . 'i', ...$property_values);
            $stmt->execute();
        
            if ($stmt->errno) {
                return $stmt->error;
            }
        
            return $entity;
        }
        
        private function extractPropertyValues(BaseEntity $entity): array {
            $property_values = [];
            foreach (array_keys($entity->getProperties()) as $property) {
                $getter = StringUtils::convertPropertyToGetter($property);
                if (method_exists($entity, $getter)) {
                    array_push($property_values, $entity->$getter());
                }
            }
            return $property_values;
        }
        
        private function createPropertyTypes(BaseEntity $entity): string {
            return implode(array_values($entity->getProperties()));
        }
        
        private function createPlaceholders(BaseEntity $entity): string {
            return '(' . implode(',', array_fill(0, $entity->getPropertiesCount(), '?')) . ')';
        }
        
        private function createPropertyNames(BaseEntity $entity): string {
            return '(' . implode(',', array_keys($entity->getProperties())) . ')';
        }
        
        private function createInsertSqlStatement(BaseEntity $entity): string {
            $sql = 'INSERT INTO ' . $entity->getTable();
            $sql .= $this->createPropertyNames($entity);
            $sql .= ' values ' . $this->createPlaceholders($entity);
            return $sql;
        }
        
        private function createUpdateSqlStatement(BaseEntity $entity): string {
            $sql = 'UPDATE ' . $entity->getTable() . ' SET ';
            $sql .= ' SET username = ?, password = ?, first_name = ?, last_name = ? WHERE id=?';
            return $sql;
        }
    
        function findAll(): array {
            $result = $this->executeQuery('SELECT * FROM' . BaseEntity::getTableName());
            if ($this->isResultEmpty($result)) {
                return [];
            }
            return BaseFactory::reconstituteArray($result->fetch_all(MYSQLI_ASSOC));
        }
    
        function findById($id): ?User {
            $stmt = $this->prepareStatement('SELECT * FROM' . BaseEntity::getTableName() . 'WHERE id = ?');
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
        
            if ($this->isResultEmpty($result)) {
                return null;
            }
        
            return BaseFactory::reconstitute($result->fetch_assoc());
        }
    
        protected function isResultEmpty(mysqli_result|bool $result): bool {
            return !$result || $result->num_rows === 0;
        }
    }
