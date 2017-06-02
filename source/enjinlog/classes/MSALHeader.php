<?php
/**
 * Author: bedirhan
 * 
 * This class represents a ModSecurity Single Audit Log's part A 
 */

    
    class MSALHeader{
        
        private $srcIP;
        private $srcPort;
        private $dstIP;
        private $dstPort;
        
        private $uniqueId;
        
        public function __constructor(){            
        } 

        // SETTERS        
        function setUniqueId($uniqueId){
            $this->uniqueId = $uniqueId;
        }
        
        function setSrcIP($srcIP){
            $this->srcIP = $srcIP;
        }

        function setSrcPort($srcPort){
            $this->srcPort = $srcPort;
        }

        function setDstIP($dstIP){
            $this->dstIP = $dstIP;
        }
        
        function setDstPort($dstPort){
            $this->dstPort = $dstPort;
        }
        
        // GETTERS
        function getUniqueId(){
            return $this->uniqueId;
        }
        
        function getSrcIP(){
            return $this->srcIP;
        }

        function getSrcPort(){
            return $this->srcPort;
        }

        function getDstIP(){
            return $this->dstIP;
        }

        function getDstPort(){
            return $this->dstPort;
        }
        
        // toString magic method
        public function __toString(){
            // Unlike the "double quotes" syntax, variables and escape sequences for
            // special characters will not be expanded when they occur in single
            // quoted strings. 
            return '--A--' . "\r\n" .                   
                   $this->getUniqueId() . ' ' . 
                   $this->getSrcIP() . ' ' . $this->getSrcPort() . ' ' . 
                   $this->getDstIP() . ' ' . $this->getDstPort();
                   
        }
        
        public function toStringHTML(){
            // Unlike the "double quotes" syntax, variables and escape sequences for
            // special characters will not be expanded when they occur in single
            // quoted strings. 
            return '--A--' . '<br/>'.                   
                   htmlentities($this->getUniqueId(), ENT_QUOTES, 'UTF-8') . ' ' . 
                   htmlentities($this->getSrcIP(), ENT_QUOTES, 'UTF-8') . ' ' . 
                   htmlentities($this->getSrcPort(), ENT_QUOTES, 'UTF-8') . ' ' . 
                   htmlentities($this->getDstIP(), ENT_QUOTES, 'UTF-8') . ' ' . 
                   htmlentities($this->getDstPort(), ENT_QUOTES, 'UTF-8');
                   
        }        
        
    }
    
?>
