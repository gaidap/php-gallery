<?php
    
    class Database {
        
        private mysqli|null $connection = null;
        
        function __construct() {
            $this->openDbConnection();
        }
        
        function __destruct() {
            $this->connection->close();
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
    }
    
