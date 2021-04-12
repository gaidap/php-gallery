<?php
    
    
    class UserRepository extends BaseRepository {
        
        function listUsers(): array {
            return UserFactory::reconstituteUsers($this->executeQuery('SELECT * FROM users')->fetch_all(MYSQLI_ASSOC));
        }
        
        function findUserById ($id) {
            $stmt = $this->prepareStatement('SELECT * FROM users WHERE id = ?');
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            return UserFactory::reconstituteUser($result->fetch_assoc());
        }
        
        function findUserByUsername ($username) {
            $stmt = $this->prepareStatement('SELECT * FROM users WHERE username = ?');
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $result = $stmt->get_result();
            return UserFactory::reconstituteUser($result->fetch_assoc());
        }
    }
