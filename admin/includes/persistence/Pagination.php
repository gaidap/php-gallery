<?php
    
    
    class Pagination {
        private int $total_count;
        private int $offset;
        private int $limit;
        
        function __construct($total_count = 0, $offset = 0, $limit = 4) {
            $this->total_count = $total_count;
            $this->offset = $offset;
            $this->limit = $limit;
        }
        
        function nextPage() {
            return null;
        }
        
        function previousPage() {
            return null;
        }
        
        function getOffset(): int {
            return $this->offset;
        }
        
        function getLimit(): int {
            return $this->limit;
        }
        
        function getTotalCount(): int {
            return $this->total_count;
        }
    }
