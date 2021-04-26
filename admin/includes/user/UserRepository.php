<?php
    
    
    class UserRepository extends DatabaseConnection {
        
        function delete(User $user): bool|string {
            $stmt = $this->prepareStatement('DELETE FROM ' . User::TABLE . ' WHERE id=?');
            $id = $user->getId();
            $stmt->bind_param('i', $id);
            $stmt->execute();
            
            if ($stmt->errno) {
                return $stmt->error;
            }
            
            return true;
        }
        
        function save(User $user): User|string {
            if ($user->getId()) {
                return $this->update($user);
            }
            
            $stmt = $this->prepareStatement('INSERT INTO ' . User::TABLE . ' (username, password, first_name, last_name) values (?,?,?,?)');
            
            list($username, $password, $first_name, $last_name) = array($user->getUsername(), $user->getPassword(), $user->getFirstName(), $user->getLastName());
            $stmt->bind_param('ssss', $username, $password, $first_name, $last_name);
            $stmt->execute();
            
            if ($stmt->errno) {
                return $stmt->error;
            }
            
            $user->setId($stmt->insert_id);
            return $user;
        }
        
        function update(User $user): User|string {
            $stmt = $this->prepareStatement('UPDATE ' . User::TABLE . ' SET username = ?, password = ?, first_name = ?, last_name = ? WHERE id=?');
            
            list($username, $password, $first_name, $last_name, $id) = array($user->getUsername(), $user->getPassword(), $user->getFirstName(), $user->getLastName(), $user->getId());
            $stmt->bind_param('ssssi', $username, $password, $first_name, $last_name, $id);
            $stmt->execute();
            
            if ($stmt->errno) {
                return $stmt->error;
            }
            
            return $user;
        }
        
        function findAll(): array {
            $result = $this->executeQuery('SELECT * FROM' . User::TABLE);
            if ($this->isResultEmpty($result)) {
                return [];
            }
            return UserFactory::reconstituteUsers($result->fetch_all(MYSQLI_ASSOC));
        }
        
        function findById($id): ?User {
            $stmt = $this->prepareStatement('SELECT * FROM' . User::TABLE . 'WHERE id = ?');
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($this->isResultEmpty($result)) {
                return null;
            }
            
            return UserFactory::reconstituteUser($result->fetch_assoc());
        }
        
        function findByUsername($username): ?User {
            $stmt = $this->prepareStatement('SELECT * FROM ' . User::TABLE . ' WHERE username = ?');
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
