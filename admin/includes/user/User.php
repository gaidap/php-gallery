<?php
    
    
    class User extends BaseEntity {
        
        private string $username;
        private string $password;
        private string $first_name;
        private string $last_name;
    
        function __construct() {
            $this->table = ' users ';
            $this->properties = array('username' => 's', 'password' => 's', 'first_name' => 's', 'last_name' => 's');
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
        
        function changePassword($password): void {
            $this->password = hash('sha256', $password);
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
    
        static function getTableName(): string {
            return (new User())->getTable();
        }
        
        function __toString(): string {
            return "ID: $this->id,
                    username: $this->username,
                    first: $this->first_name,
                    last: $this->last_name,
                    created: $this->creation_date";
        }
        
    }
