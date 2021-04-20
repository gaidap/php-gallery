<?php
    
    class Database {
        
        private static Database|null $instance = null;
        
        private mysqli|null $connection = null;
        
        private function __construct() {
            $this->openDbConnection();
        }
        
        private function openDbConnection() {
            $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            if ($this->connection->errno) {
                die("Database connection failed:\n\n" . $this->connection->error);
            }
        }
        
        function getConnection(): mysqli|null {
            return $this->connection;
        }
        
        static function createConnection(): ?mysqli {
            if (self::$instance === null) {
                self::$instance = new Database();
            }
            return self::$instance->getConnection();
        }
    }
    
