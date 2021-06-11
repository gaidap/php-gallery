<?php
    
    
    class Pagination {
        
        private int $current_page;
        private int $total_count;
        private int $limit;
        
        function __construct($total_count = 0, $current_page = 1, $limit = 2) {
            $this->total_count = $total_count;
            $this->current_page = $current_page;
            $this->limit = $limit;
        }
        
        function nextPage(): Pagination {
            if ($this->hasNextPage()) {
                $this->current_page++;
                return new Pagination($this->total_count, $this->current_page, $this->limit);
            }
            return $this;
        }
        
        function previousPage(): Pagination {
            if ($this->hasPreviousPage()) {
                $this->current_page--;
                return new Pagination($this->total_count, $this->current_page, $this->limit);
            }
            $this->current_page = 1;
            return $this;
        }
        
        function getCurrentPage(): int {
            return $this->current_page;
        }
        
        function getLimit(): int {
            return $this->limit;
        }
        
        function getTotalCount(): int {
            return $this->total_count;
        }
        
        function calculateTotalPageCount(): int {
            return ceil($this->total_count / $this->limit);
        }
        
        function calculateOffset(): int {
            return ($this->current_page - 1) * $this->limit;
        }
        
        function hasNextPage(): bool {
            return $this->total_count > 0 && $this->current_page < $this->calculateTotalPageCount();
        }
        
        function hasPreviousPage(): bool {
            return $this->total_count > 0 && $this->current_page > 1;
        }
    }
