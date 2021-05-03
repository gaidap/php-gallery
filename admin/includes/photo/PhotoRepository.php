<?php
    
    
    class PhotoRepository extends BaseRepository {
        
        function __construct() {
            parent::__construct();
        }
        
        protected function getTableName(): string {
            return Photo::getTableName();
        }
    
        protected function getFactoryClass(): BaseFactory {
            return new PhotoFactory;
        }
    }