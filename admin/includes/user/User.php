<?php
    
    
    class User extends BaseRepository {
        
        private int|null $id;
        private string $username;
        private string $password;
        private string $first_name;
        private string $last_name;
        private string $creation_date;
        
        function setId($id): User {
            $this->id = $id;
            return $this;
        }
        
        function getId(): int|null {
            return $this->id;
        }
        
        function setUsername(string $username): User {
            $this->username = $username;
            return $this;
        }
        
        function getUsername(): string {
            return $this->username;
        }
        
        function checkPassword($password): bool {
            return $this->password === hash('sha256', $password);
        }
        
        public function getPassword(): string {
            return $this->password;
        }
        
        function setPassword(string $password): User {
            $this->password = !$this->id ? hash('sha256', $password) : $password;
            return $this;
        }
        
        function setFirstName(string $first_name): User {
            $this->first_name = $first_name;
            return $this;
            
        }
        
        function getFirstName(): string {
            return $this->first_name;
        }
        
        function setLastName(string $last_name): User {
            $this->last_name = $last_name;
            return $this;
        }
        
        function getLastName(): string {
            return $this->last_name;
        }
        
        
        function setCreationDate(string $creation_date): User {
            $this->creation_date = $creation_date;
            return $this;
        }
        
        function save(): User|string {
            $stmt = $this->prepareStatement('INSERT INTO users (username, password, first_name, last_name) values (?,?,?,?)');
    
            list($username, $password, $first_name, $last_name) = array($this->getUsername(), $this->getPassword(), $this->getFirstName(), $this->getLastName());
            $stmt->bind_param('ssss', $username, $password, $first_name, $last_name);
            $stmt->execute();
    
            if ($stmt->errno) {
                return $stmt->error;
            }
            
            $this->setId($stmt->insert_id);
            return $this;
        }
        
        function update(): User|string {
            $stmt = $this->prepareStatement('UPDATE users SET username = ?, password = ?, first_name = ?, last_name = ? WHERE id=?');
            
            list($username, $password, $first_name, $last_name, $id) = array($this->getUsername(), $this->getPassword(), $this->getFirstName(), $this->getLastName(), $this->getId());
            $stmt->bind_param('ssssi', $username, $password, $first_name, $last_name, $id);
            $stmt->execute();
            
            if ($stmt->errno) {
                return $stmt->error;
            }
            
            return $this;
        }
        
        function __toString(): string {
            return "ID: $this->id,
                    username: $this->username,
                    first: $this->first_name,
                    last: $this->last_name,
                    created: $this->creation_date";
        }
        
    }
