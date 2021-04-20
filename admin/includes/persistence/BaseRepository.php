<?php
    
    
    abstract class BaseRepository {
        
        private mysqli|null $db_connection;
        
        function __construct() {
            $this->db_connection = Database::createConnection();
        }
        
        protected function executeQuery($sql): mysqli_result|bool {
            $mysqli_result = mysqli_query($this->db_connection, $this->escapeSqlString($sql));
            $this->validateQueryResult($mysqli_result);
            return $mysqli_result;
        }
        
        protected function prepareStatement($sql): bool|mysqli_stmt {
            return mysqli_prepare($this->db_connection, $sql);
        }
        
        private function validateQueryResult($result) {
            if(!$result) {
                die("Database query failed.");
            }
        }
        
        private function escapeSqlString($sql): string {
            return mysqli_real_escape_string($this->db_connection, $sql);
        }
    }
