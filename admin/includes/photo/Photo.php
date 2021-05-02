<?php
    
    
    class Photo extends BaseEntity {
        
        private string $file;
        private string $title;
        private string $type;
        private int $size;
        private string|null $description;
        
        function __construct() {
            $this->table = ' photos ';
            $this->properties = array('file' => 's', 'title' => 's', 'type' => 's', 'size' => 'i', 'description' => 's');
        }
        
        function getFile(): string {
            return $this->file;
        }
        
        function setFile(string $file): Photo {
            $this->file = $file;
            return $this;
        }
        
        function getTitle(): string {
            return $this->title;
        }
        
        function setTitle(string $title): Photo {
            $this->title = $title;
            return $this;
        }
        
        function getType(): string {
            return $this->type;
        }
        
        function setType(string $type): Photo {
            $this->type = $type;
            return $this;
        }
        
        function getSize(): int {
            return $this->size;
        }
        
        function setSize(int $size): Photo {
            $this->size = $size;
            return $this;
        }
    
        function getDescription(): string|null {
            return $this->description;
        }
    
        function setDescription(string|null $description): Photo {
            $this->description = $description;
            return $this;
        }
        
        function setCreationDate(string $creation_date): Photo {
            $this->creation_date = $creation_date;
            return $this;
        }
        
        static function getTableName(): string {
            return (new Photo())->getTable();
        }
        
        function __toString(): string {
            return "ID: $this->id,
                    file: $this->file,
                    title: $this->title,
                    type: $this->type,
                    size: $this->size,
                    description: $this->description,
                    created: $this->creation_date";
        }
        
    }
