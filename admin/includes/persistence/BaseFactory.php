<?php
    
    
    abstract class BaseFactory {
        
        static function reconstitute($result_assoc): BaseEntity {
            $result = static::createNewEntity();
            $result->setId(null);
            foreach ($result_assoc as $property => $value) {
                $setter = StringUtils::convertPropertyToSetter($property);
                if (method_exists($result, $setter)) {
                    $result->$setter($value);
                }
            }
            return $result;
        }
        
        static function reconstituteArray($user_array): array {
            $result = [];
            foreach ($user_array as $user_assoc) {
                array_push($result, self::reconstitute($user_assoc));
            }
            return $result;
        }
        
        abstract protected static function createNewEntity(): BaseEntity;
    }
