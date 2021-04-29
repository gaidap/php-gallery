<?php
    
    
    class UserRepository extends BaseRepository {
        
        function __construct() {
            parent::__construct();
        }
    
        function findByUsername($username): ?User {
            $stmt = $this->prepareStatement('SELECT * FROM ' . User::getTableName() . ' WHERE username = ?');
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($this->isResultEmpty($result)) {
                return null;
            }
            
            return UserFactory::reconstitute($result->fetch_assoc());
        }
    }
