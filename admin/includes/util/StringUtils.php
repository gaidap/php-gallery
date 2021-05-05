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
    
        static function convertPropertyToGetter($property): string {
            return 'get' . StringUtils::snakeToCamel($property, true);
        }
    
        static function normalizePath($path): string|null {
            if (!$path) {
                return null;
            }
            $path = str_replace('\\', '/', $path);
            $path = preg_replace('|(?<=.)/+|', '/', $path);
            if (':' === substr($path, 1, 1)) {
                $path = ucfirst($path);
            }
            return $path;
        }
    }
