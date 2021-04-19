<?php
    
    
    class UserRepository extends BaseRepository {
        
        function create(
            string $username,
            string $password,
            string $first_name,
            string $last_name
        ): int|string {
            $stmt = $this->prepareStatement('INSERT INTO users (username, password, first_name, last_name) values (?,?,?,?)');
            
            list($username, $password, $first_name, $last_name) = $this->createNewUserDtoAttributes($username, $password, $first_name, $last_name);
            $stmt->bind_param('ssss', $username, $password, $first_name, $last_name);
            $stmt->execute();
            
            if ($stmt->errno) {
                return $stmt->error;
            }
            
            return $stmt->insert_id;
        }
        
        private function createNewUserDtoAttributes(string $username, string $password, string $first_name, string $last_name): array {
            $user = UserFactory::createNewUser($username, $password, $first_name, $last_name);
            $username = $user->getUsername();
            $password = $user->getPassword();
            $first_name = $user->getFirstName();
            $last_name = $user->getLastName();
            return array($username, $password, $first_name, $last_name);
        }
        
        function verifyUser(string $username, string $password): ?User {
            $current_user = $this->findByUsername($username);
            return $current_user && $current_user->checkPassword($password) ? $current_user : null;
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
