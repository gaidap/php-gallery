<?php
    
    
    class CommentRepository extends BaseRepository {
        
        function __construct() {
            parent::__construct();
        }
        
        function findAllByPhotoId(int $photo_id): array {
            $stmt = $this->prepareStatement('SELECT * FROM ' . $this->getTableName() . ' WHERE photo_id = ?');
            $stmt->bind_param('i', $photo_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($this->isResultEmpty($result)) {
                return [];
            }
            return CommentFactory::reconstituteArray($result->fetch_all(MYSQLI_ASSOC));
        }
        
        function countByPhotoId(int $photo_id): int {
            $stmt = $this->prepareStatement('SELECT count(id) FROM ' . $this->getTableName() . ' WHERE photo_id = ?');
            $stmt->bind_param('i', $photo_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($this->isResultEmpty($result)) {
                return 0;
            }
            
            return $result->fetch_row()[0];
        }
        
        protected function getTableName(): string {
            return Comment::getTableName();
        }
        
        protected function getFactoryClass(): BaseFactory {
            return new CommentFactory;
        }
    }
