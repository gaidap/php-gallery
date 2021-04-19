<?php
    
    
    class UserFactory {
        
        static function createNewUser(
            string $username,
            string $password,
            string $first_name,
            string $last_name
        ): User {
            return self::reconstituteUser([
                'username' => $username,
                'password' => $password,
                'first_name' => $first_name,
                'last_name' => $last_name,
                ]);
            
        }
        
        static function reconstituteUsers($user_array): array {
            $result = [];
            foreach ($user_array as $user_assoc) {
                array_push($result, self::reconstituteUser($user_assoc));
            }
            return $result;
        }
        
        static function reconstituteUser($user_assoc): User {
            $result = new User();
            $result->setId(null);
            foreach ($user_assoc as $property => $value) {
                $setter = StringUtils::convertPropertyToSetter($property);
                if (method_exists($result, $setter)) {
                    $result->$setter($value);
                }
            }
            return $result;
        }
    }
