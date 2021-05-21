<?php
    
    
    class Photo extends BaseEntity {
        
        private const supported_files = array('JPG', 'JPEG', 'TIFF', 'PNG', 'GIF');
        
        private string $fileName;
        private string $title;
        private string|null $caption;
        private string $alternate_text;
        private string $type;
        private int $size;
        private string|null $description;
        
        function __construct() {
            $this->table = ' photos ';
            $this->properties = array('file_name' => 's', 'title' => 's', 'type' => 's', 'size' => 'i', 'alternate_text' => 's', 'caption' => 's', 'description' => 's');
        }
        
        static function isFileSupported($file_type): bool {
            return in_array(strtoupper($file_type), self::supported_files);
        }
        
        
        function getFileName(): string {
            return $this->fileName;
        }
        
        function setFileName(string $fileName): Photo {
            $this->fileName = $fileName;
            return $this;
        }
        
        
        function getRelativePath(): string {
            return StringUtils::normalizePath('..' . DS . UPLOAD_FOLDER . DS . $this->fileName);
        }
        
        function getTitle(): string {
            return $this->title;
        }
        
        function setTitle(string $title): Photo {
            $this->title = $title;
            return $this;
        }
        
        function getCaption(): string|null {
            return $this->caption;
        }
        
        function setCaption(string|null $caption): Photo {
            $this->caption = $caption;
            return $this;
        }
        
        function getAlternateText(): string {
            return $this->alternate_text;
        }
        
        function setAlternateText(string $alternate_text): Photo {
            $this->alternate_text = $alternate_text;
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
                    file_name: $this->fileName,
                    title: $this->title,
                    caption: $this->caption,
                    alternate_text: $this->alternate_text,
                    type: $this->type,
                    size: $this->size,
                    description: $this->description,
                    created: $this->creation_date";
        }
        
    }
