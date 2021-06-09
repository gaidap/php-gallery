<?php
    
    
    class Comment extends BaseEntity {
        
        private int $photo_id;
        private string $author;
        private string $body;
        
        function __construct() {
            $this->table = ' comments ';
            $this->properties = array('photo_id' => 'i', 'author' => 's', 'body' => 's');
        }
        
        function setPhotoId(int $photo_id): Comment {
            $this->photo_id = $photo_id;
            return $this;
        }
        
        function getPhotoId(): int {
            return $this->photo_id;
        }
        
        
        function setAuthor(string $author): Comment {
            $this->author = $author;
            return $this;
            
        }
        
        function getAuthor(): string {
            return $this->author;
        }
        
        function setBody(string $body): Comment {
            $this->body = $body;
            return $this;
        }
        
        function getBody(): string {
            return $this->body;
        }
        
        function setCreationDate(string $creation_date): Comment {
            $this->creation_date = $creation_date;
            return $this;
        }
        
        static function getTableName(): string {
            return (new User())->getTable();
        }
        
        function __toString(): string {
            return "ID: $this->id,
                    photo_id: $this->photo_id,
                    author: $this->author,
                    body: $this->body,
                    created: $this->creation_date";
        }
        
    }
