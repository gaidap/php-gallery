<?php
    
    
    class Photo extends BaseEntity {
        
        private const supported_files = array('JPG', 'JPEG', 'TIFF', 'PNG', 'GIF');
        
        private string $file;
        private string $title;
        private string $type;
        private int $size;
        private string|null $description;
        
        function __construct() {
            $this->table = ' photos ';
            $this->properties = array('file' => 's', 'title' => 's', 'type' => 's', 'size' => 'i', 'description' => 's');
        }
        
        public static function isFileSupported($file_type): bool {
            return in_array(strtoupper($file_type), self::supported_files);
        }
        
        function getFile(): string {
            return $this->file;
        }
        
        function getUrl(): string {
            return $this->normalizePath();
        }
        
        private function normalizePath() {
            $path = str_replace('\\', '/', $this->file);
            $path = preg_replace('|(?<=.)/+|', '/', $path);
            if (':' === substr($path, 1, 1)) {
                $path = ucfirst($path);
            }
            return $path;
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
        
        function getTmpFile(): string {
            return $this->tmp_file;
        }
        
        function setTmpFile(string $tmp_file): Photo {
            $this->tmp_file = $tmp_file;
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
