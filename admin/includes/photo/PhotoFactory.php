<?php
    
    
    class PhotoFactory extends BaseFactory {
        
        static function createNewPhoto(
            string $file,
            string $fileName,
            string $title,
            string $type,
            string $size,
            string $description = null
        ): Photo {
            return self::castToPhoto(self::reconstitute([
                'file' => $file,
                'fileName' => $fileName,
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
