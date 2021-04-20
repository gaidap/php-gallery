<?php
    
    
    class UserRepository extends DatabaseConnection {
        
        function deleteUser(User $user): bool|string {
            $stmt = $this->prepareStatement('DELETE FROM users WHERE id=?');
            $id = $user->getId();
            $stmt->bind_param('i', $id);
            $stmt->execute();
    
            if ($stmt->errno) {
                return $stmt->error;
            }
            
            return true;
        }
        
        function listUsers(): array {
            $result = $this->executeQuery('SELECT * FROM users');
            if ($this->isResultEmpty($result)) {
                return [];
            }
            return UserFactory::reconstituteUsers($result->fetch_all(MYSQLI_ASSOC));
        }
        
        function findById($id): ?User {
            $stmt = $this->prepareStatement('SELECT * FROM users WHERE id = ?');
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($this->isResultEmpty($result)) {
                return null;
            }
            return UserFactory::reconstituteUser($result->fetch_assoc());
        }
        
        function findByUsername($username): ?User {
            $stmt = $this->prepareStatement('SELECT * FROM users WHERE username = ?');
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
