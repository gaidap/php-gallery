<?php
    
    
    class UserFactory {
        static function createNewUser(
            string $username,
            string $password,
            string $first_name,
            string $last_name
        ): User {
            return (new User())->setUsername($username)
                ->setPassword($password)
                ->setFirstName($first_name)
                ->setLastName($last_name);
            
        }
        
        static function reconstituteUsers($user_array): array {
            $result = [];
            foreach ($user_array as $user_assoc) {
                array_push($result, self::reconstituteUser($user_assoc));
            }
            return $result;
        }
        
        static function reconstituteUser($user_assoc): User {
            return (new User())->setId($user_assoc['id'])
                ->setUsername($user_assoc['username'])
                ->setPassword($user_assoc['password'])
                ->setFirstName($user_assoc['first_name'])
                ->setLastName($user_assoc['last_name'])
                ->setCreationDate($user_assoc['creation_date']);
        }
    }
