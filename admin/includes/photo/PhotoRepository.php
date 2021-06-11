<?php
    
    
    class PhotoRepository extends BaseRepository {
        
        function __construct() {
            parent::__construct();
        }
        
        function findAllByUserId(int $user_id): array {
            $stmt = $this->prepareStatement('SELECT * FROM ' . $this->getTableName() . ' WHERE user_id = ?');
            $stmt->bind_param('i', $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($this->isResultEmpty($result)) {
                return [];
            }
            return PhotoFactory::reconstituteArray($result->fetch_all(MYSQLI_ASSOC));
        }
        
        protected function getTableName(): string {
            return Photo::getTableName();
        }
        
        protected function getFactoryClass(): BaseFactory {
            return new PhotoFactory;
        }
    }
