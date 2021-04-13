<?php
    
    require_once "../admin/includes/StringUtils.php";
    
    use PHPUnit\Framework\TestCase;
    
    class StringUtilsTest extends TestCase {
        
        public function testSnakeToCamelReturnsEmptyStringIfInputIsNull() {
            self::assertEmpty(StringUtils::snakeToCamel(null));
        }
        
        public function testSnakeToCamelReturnsFirstLetterAsLowerCaseAsDefault() {
            self::assertEquals('lifeOfBrian', StringUtils::snakeToCamel('Life_of_brian'));
        }
        
        public function testSnakeToCamelReturnsFirstLetterAsUpperCaseAsDefault() {
            self::assertEquals('LifeOfBrian', StringUtils::snakeToCamel('life_of_brian', true));
        
        }
        
        public function testCamelToSnakeReturnsEmptyStringIfInputIsNull() {
            self::assertEmpty(StringUtils::camelToSnake(null));
        }
        
        public function testCamelToSnakeReturnsFirstLetterAsLowerCaseAsDefault() {
            self::assertEquals('life_of_brian', StringUtils::camelToSnake('LifeOfBrian'));
        }
        
        public function testCamelToSnakeReturnsFirstLetterAsUpperCaseAsDefault() {
            self::assertEquals('Life_of_brian', StringUtils::camelToSnake('lifeOfBrian', true));
        
        }
        
        public function testConvertPropertyToSetterReturnsJustSetIfPropertyIsNull() {
            self::assertEquals('set', StringUtils::convertPropertyToSetter(null));
        }
    }
