<?php
    
    
    class UserFactory extends BaseFactory {
        
        static function createNewUser(
            string $username,
            string $password,
            string $first_name,
            string $last_name
        ): User {
            return self::castToUser(self::reconstitute([
                'username' => $username,
                'password' => $password,
                'first_name' => $first_name,
                'last_name' => $last_name,
            ]));
        }
    
        static function castToUser($entity): User|null {
            return $entity;
        }
    
        protected static function createNewEntity(): BaseEntity {
            return new User();
        }
    }
