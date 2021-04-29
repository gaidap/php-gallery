<?php
    
    
    abstract class BaseEntity {
        protected string $table;
        protected array $properties;
        protected int|null $id;
    
        function getTable(): string {
            return $this->table;
        }
    
        function getProperties(): array {
            return $this->properties;
        }
        
    
        function getPropertiesCount(): int {
            return sizeof($this->properties);
        }
        
    
        function getId(): int|null {
            return $this->id;
        }
    
        function setId($id): BaseEntity {
            $this->id = $id;
            return $this;
        }
    
        abstract static function getTableName (): string;
    }
