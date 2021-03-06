<?php
    
    require_once "../admin/includes/util/StringUtils.php";
    
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
        
        public function testConvertPropertyToSetterReturnsSetterOfPropertyInCamelCase() {
            self::assertEquals('setLifeOfBrian', StringUtils::convertPropertyToSetter('life_of_brian'));
        }
        
        public function testConvertPropertyToSetterReturnsSetterOfPropertyInMixedForm() {
            self::assertEquals('setLifeOfBrian', StringUtils::convertPropertyToSetter('life_ofBrian'));
        }
        
        public function testConvertPropertyToSetterReturnsSetterOfPropertyInCamelCaseForm() {
            self::assertEquals('setLifeOfBrian', StringUtils::convertPropertyToSetter('LifeOfBrian'));
        }
        
        public function testConvertPropertyToGetterReturnsJustSetIfPropertyIsNull() {
            self::assertEquals('get', StringUtils::convertPropertyToGetter(null));
        }
        
        public function testConvertPropertyToGetterReturnsSetterOfPropertyInCamelCase() {
            self::assertEquals('getLifeOfBrian', StringUtils::convertPropertyToGetter('life_of_brian'));
        }
    
        public function testConvertPropertyToGetterReturnsSetterOfPropertyInMixedForm() {
            self::assertEquals('getLifeOfBrian', StringUtils::convertPropertyToGetter('life_ofBrian'));
        }
    
        public function testConvertPropertyToGetterReturnsSetterOfPropertyInCamelCaseForm() {
            self::assertEquals('getLifeOfBrian', StringUtils::convertPropertyToGetter('LifeOfBrian'));
        }
    
        public function testNormalizePathReturnsNullIfInputIsNull() {
            self::assertNull(StringUtils::normalizePath(null));
        }
    
        public function testNormalizePathConvertsWindowsPathToUnixPath() {
            self::assertEquals('C:/test/folder', StringUtils::normalizePath('C:\test\folder'));
        }
    }
