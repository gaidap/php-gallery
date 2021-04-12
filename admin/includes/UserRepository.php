<?php
    
    
    class UserRepository extends BaseRepository {
        
        function list_users() {
            return $this->execute_query('SELECT * FROM users')->fetch_all();
        }
        
    }
