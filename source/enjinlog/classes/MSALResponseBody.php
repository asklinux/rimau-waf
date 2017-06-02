<?php
/**
 * Author: bedirhan
 * 
 * This class represents a ModSecurity Single Audit Log's part E
 */

    class MSALResponseBody{
        
        private $responseBody;
        
        public function __constructor(){            
        }        

        // SETTERS
        function setResponseBody($responseBody){
            $this->responseBody = $responseBody;
        }
        
        // GETTERS
        function getResponseBody(){
            return $this->responseBody;
        }

        // toString magic method
        public function __toString(){          
            return '--E--' . "\r\n" . 
                   $this->getResponseBody();
        }        
        
        public function toStringHTML(){
            return '--E--' . '<br/>' . 
            htmlentities($this->getResponseBody(), ENT_QUOTES, "UTF-8");            
        }
    }
    
?>