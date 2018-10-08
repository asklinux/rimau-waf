<?php
/**
 * Author: bedirhan
 * 
 * This class represents a "single" ModSecurity alert in part H
 *
 * 
 * WHAT SHOULD BE THE RELATION OF MSALTrailer and Alert classes? 
 */

    
    class Alert{

        // current status of this alert; open, closed, resolved, e.t.c.
        // Look at AlertStatus.php
        private $status;
        
        // resolution explanation of this alert; false positive, vulnerable, e.t.c.
        // Look at AlertResolution.php
        private $resolution;
        
        // vulnerability category that this alert falls in; xss, sqli, commandi, 
        // path traversal, e.t.c. 
        // Look at AlertCategory.php
        private $category;
        
        // comment made on this alert
        private $comment;
                
        public function __constructor(){            
        } 

        // SETTERS
        function setComment($comment){
            $this->comment = $comment;
        }
        
        function setCategory($category){
            $this->category = $category;
        }
        
        function setResolution($resolution){
            $this->resolution = $resolution;
        }
        
        function setStatus($status){
            $this->status = $status;
        }
        
        // GETTERS
        function getComment(){
          return $this->comment;
        }
        
        function getCategory(){
            return $this->category;            
        }
        
        function getResolution(){
            return $this->resolution;
        }
        
        function getStatus(){
            $this->status;
        }
        
        
        // toString magic method
        public function __toString(){
        }
    }
    
?>
