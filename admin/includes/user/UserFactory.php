<?php
    
    
    class UserFactory extends BaseFactory {
        
        static function createNewUser(
            string $username,
            string $password,
            string $first_name,
            string $last_name
        ): User {
            return self::reconstitute([
                'username' => $username,
                'password' => $password,
                'first_name' => $first_name,
                'last_name' => $last_name,
                ]);
            
        }
    
        protected static function createNewEntity(): BaseEntity {
            return new User();
        }
    }
