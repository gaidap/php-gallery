<?php
    
    
    class StringUtils {
        static function camelToSnake($input, $capitalizeFirstCharacter = false): string {
            $input = $capitalizeFirstCharacter ? ucfirst($input) : $input;
            return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $input));
        }
        
        static function snakeToCamel($input, $capitalizeFirstCharacter = false): string {
            $input = $capitalizeFirstCharacter ? ucfirst($input) : $input;
            return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $input))));
        }
    
        static function convertPropertyToSetter(string $property): string {
            return 'set' . StringUtils::snakeToCamel($property, true);
        }
    }
