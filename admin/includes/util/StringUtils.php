<?php
    
    
    class StringUtils {
        static function camelToSnake($input, $capitalizeFirstCharacter = false): string {
            if(!$input) {
                return '';
            }
            $converted_input = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $input));
            return $capitalizeFirstCharacter ? ucfirst($converted_input) : lcfirst($converted_input);
        }
        
        static function snakeToCamel($input, $capitalizeFirstCharacter = false): string {
            if(!$input) {
                return '';
            }
            $converted_input = str_replace(' ', '', ucwords(str_replace('_', ' ', $input)));
            return $capitalizeFirstCharacter ? ucfirst($converted_input) : lcfirst($converted_input);
        }
    
        static function convertPropertyToSetter($property): string {
            return 'set' . StringUtils::snakeToCamel($property, true);
        }
    }
