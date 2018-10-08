<?php
/**
 * Author: bedirhan
 * 
 * This class represents a ModSecurity Single Audit Log's part I
 * 
 * NOTE: even if you specify SecAuditLogParts ABIDEFGHZ in modsec configuration
 * it still sends you a part named C. I hope it won't conflict with what reference
 * says about specifying log part I instead of C.
 */

    class MSALRequestBody{
        
        private $requestBody;
        
        public function __constructor(){            
        }     
        
        // SETTERS
        function setRequestBody($requestBody){
            $this->requestBody = $requestBody;
        }
        
        // GETTERS
        function getRequestBody(){
            return $this->requestBody;
        }

        // toString magic method
        public function __toString(){          
            return '--I--' . "\r\n" .
                   $this->getRequestBody();
        }     

        public function toStringHTML(){          
            return '--I--' . '<br/>' .
                   htmlentities($this->getRequestBody(), ENT_QUOTES, 'UTF-8');
        }     
        
    }
    
?>