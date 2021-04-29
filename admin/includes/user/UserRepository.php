<?php
    
    
    class UserRepository extends BaseRepository {
        
        function __construct() {
            parent::__construct();
        }
    
        function findAll(): array {
            $result = $this->executeQuery('SELECT * FROM' . BaseEntity::getTableName());
            if ($this->isResultEmpty($result)) {
                return [];
            }
            return UserFactory::reconstituteUsers($result->fetch_all(MYSQLI_ASSOC));
        }
        
        function findById($id): ?User {
            $stmt = $this->prepareStatement('SELECT * FROM' . BaseEntity::getTableName() . 'WHERE id = ?');
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($this->isResultEmpty($result)) {
                return null;
            }
            
            return UserFactory::reconstituteUser($result->fetch_assoc());
        }
        
        function findByUsername($username): ?User {
            $stmt = $this->prepareStatement('SELECT * FROM ' . BaseEntity::getTableName() . ' WHERE username = ?');
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($this->isResultEmpty($result)) {
                return null;
            }
            
            return UserFactory::reconstituteUser($result->fetch_assoc());
        }
        
        private function isResultEmpty(mysqli_result|bool $result): bool {
            return !$result || $result->num_rows === 0;
        }
    }
