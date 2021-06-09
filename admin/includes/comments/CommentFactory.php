<?php
    
    
    class CommentFactory extends BaseFactory {
        
        static function createNewComment(
            int $photo_id,
            string $author,
            string $body
        ): Comment {
            return self::castToComment(self::reconstitute([
                'photo_id' => $photo_id,
                'author' => $author,
                'body' => $body
            ]));
        }
    
        static function castToComment($entity): Comment|null {
            return $entity;
        }
    
        protected static function createNewEntity(): BaseEntity {
            return new Comment();
        }
    }
