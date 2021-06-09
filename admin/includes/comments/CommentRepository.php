<?php
    
    
    class CommentRepository extends BaseRepository {
        
        function __construct() {
            parent::__construct();
        }
        
        protected function getTableName(): string {
            return Comment::getTableName();
        }
        
        protected function getFactoryClass(): BaseFactory {
            return new CommentFactory;
        }
    }
