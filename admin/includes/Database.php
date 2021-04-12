<?php
    
    class Database {
        
        private mysqli|bool|null $connection = null;
        
        function __construct() {
            $this->openDbConnection();
        }
    
        private function openDbConnection() {
            $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            if (mysqli_connect_errno()) {
                die("Database connection failed:\n\n" . mysqli_error($this->connection));
            }
        }
        
        function getConnection(): mysqli|bool|null {
            return $this->connection;
        }
    }
    
