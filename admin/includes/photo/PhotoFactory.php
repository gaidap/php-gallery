<?php
    
    
    class PhotoFactory extends BaseFactory {
        
        static function createNewPhoto(
            string $fileName,
            string $title,
            string $type,
            string $size,
            string $alternate_text = '',
            string $caption = null,
            string $description = null
        ): Photo {
            return self::castToPhoto(self::reconstitute([
                'fileName' => $fileName,
                'title' => $title,
                'type' => $type,
                'size' => $size,
                'alternate_text' => $alternate_text,
                'caption' => $caption,
                'description' => $description
            ]));
            
        }
        
        static function castToPhoto($entity): Photo|null {
            return $entity;
        }
        
        protected static function createNewEntity(): BaseEntity {
            return new Photo();
        }
    }
