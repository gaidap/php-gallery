<?php
    
    
    abstract class BaseEntity {
        
        // The name of the database table
        protected string $table;
        // The properties must omit to this form: array('property_name' => 'type'), e.g. array('username' => 's');
        protected array $properties;
        
        protected int|null $id;
    
        function getTable(): string {
            return $this->table;
        }
    
        function getProperties(): array {
            return array_keys($this->properties);
        }
        
        function getPropertyTypes(): string {
            return implode(array_values($this->properties));
        }
        
        function getPropertyValues(): array {
            $property_values = [];
            foreach ($this->getProperties() as $property) {
                $getter = StringUtils::convertPropertyToGetter($property);
                if (method_exists($this, $getter)) {
                    array_push($property_values, $this->$getter());
                }
            }
            return $property_values;
        }
    
        function getPropertiesCount(): int {
            return sizeof($this->properties);
        }
        
    
        function getId(): int|null {
            return $this->id;
        }
    
        function setId($id): BaseEntity {
            $this->id = $id;
            return $this;
        }
    
        abstract static function getTableName (): string;
    }
