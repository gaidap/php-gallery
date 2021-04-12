<?php
    
    
    abstract class BaseRepository {
        
        private mysqli $db_connection;
        
        function __construct($db_connection) {
            $this->db_connection = $db_connection;
        }
        
        protected function execute_query($sql): mysqli_result|bool {
            $mysqli_result = mysqli_query($this->db_connection, $this->escape_sql_string($sql));
            $this->validate_query_result($mysqli_result);
            return $mysqli_result;
        }
        
        private function validate_query_result($result) {
            if(!$result) {
                die("Database query failed.");
            }
        }
        
        private function escape_sql_string($sql): string {
            return mysqli_real_escape_string($this->db_connection, $sql);
        }
    }
