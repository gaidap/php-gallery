<?php
    
    
    class PhotoFactory extends BaseFactory {
        
        static function createNewPhoto(
            string $file,
            string $title,
            string $type,
            string $size,
            string $description = null
        ): Photo {
            return self::castToPhoto(self::reconstitute([
                'file' => $file,
                'title' => $title,
                'type' => $type,
                'size' => $size,
                'description' => $description
            ]));
            
        }
        
        static function castToPhoto($entity): Photo {
            return $entity;
        }
        
        protected static function createNewEntity(): BaseEntity {
            return new Photo();
        }
    }
