<?php
/**
 * Author: bedirhan
 * 
 * This class represents a ModSecurity Single Audit Log, hence the name MSAL.
 * MSAL has a MSALHeader          (part A)
 * MSAL has a MSALRequestHeaders  (part B)
 * MSAL has a MSALRequestBody     (part I, not C)
 * 
 *    NOTE: even if we configured ModSec like below
 *              SecAuditLogParts ABIDEFGHZ
 *          mlogc sends related part as C
 * 
 * MSAL has a MSALResponseHeaders (part F, not D - not implemented)
 * MSAL has a MSALResponseBody    (part E, not G - not implemented) 
 * 
 *    NOTE: even if we configured ModSec like below
 *              SecResponseBodyAccess On
 *              SecAuditLogParts ABIDEFGHZ
 *              auditLogParts=+E
 *          mlogc doesn't send part E
 * 
 * MSAL has a MSALTrailer         (part H)
 * 
 * 
 * Extra Information: When mlogc is configured, 
 * SecAuditLogParts ABIDEFGHZ 
 * SecResponseBodyAccess On
 */
    
    require_once "MSALHeader.php";
    require_once "MSALRequestHeaders.php";
    require_once "MSALRequestBody.php";
    require_once "MSALResponseHeaders.php";
    require_once "MSALResponseBody.php";
    require_once "MSALTrailer.php";
    
    class MSAL{
        
        private $msalHeader;
        private $msalRequestHeaders;
        private $msalRequestBody;
        private $msalResponseHeaders;
        private $msalResponseBody;
        private $msalTrailer;
        
        /* this variable holds the relative single audit log file residing on the
         * hard disk. 
         * 
         * Example:
         * yyyyMMdd/yyyyMMdd-HHmm/yyyyMMdd-HHmm.bin
         * 
         * Here "/yyyyMMdd/yyyyMMdd-HHmm" and "/yyyyMMdd-HHmm.bin" parts are
         * produced from log creation time, which is parsed from "Stopwatch:"
         * header in part H
         * 
         * Example:
         * Stopwatch: 1209964824490940 115379 (102802* 103660 -)
         * 
         * Here 1209964824490940 represents the "log creation time" and 115379 
         * represents the processing duration. In which unit; milliseconds?
         */
        private $relativeLogFilePath;
        
        public function __constructor(){            
        }
                
        // SETTERS        
        public function setRelativeLogFilePath($relativeLogFilePath){
            $this->relativeLogFilePath = $relativeLogFilePath;
        }
        
        public function setMSALHeader($msalHeader){
            return $this->msalHeader = $msalHeader;
        } 
        
        public function setMSALRequestHeaders($msalRequestHeaders){
            return $this->msalRequestHeaders = $msalRequestHeaders;
        } 
        
        public function setMSALRequestBody($msalRequestBody){
            return $this->msalRequestBody = $msalRequestBody;
        } 

        public function setMSALResponseHeaders($msalResponseHeaders){
            return $this->msalResponseHeaders = $msalResponseHeaders;
        } 

        public function setMSALResponseBody($msalResponseBody){
            return $this->msalResponseBody = $msalResponseBody;
        } 

        public function setMSALTrailer($msalMSALTrailer){
            return $this->msalTrailer = $msalMSALTrailer;
        } 
        
        // GETTERS
        public function getMSALHeader(){
            return $this->msalHeader;
        } 
        
        public function getMSALRequestHeaders(){
            return $this->msalRequestHeaders;
        } 
        
        public function getMSALRequestBody(){
            return $this->msalRequestBody;
        } 

        public function getMSALResponseHeaders(){
            return $this->msalResponseHeaders;
        } 

        public function getMSALResponseBody(){
            return $this->msalResponseBody;
        } 

        public function getMSALTrailer(){            
            return $this->msalTrailer;
        } 
        
        /*
        I delegated this function to MSALDB class
        // a convenient method that saves itself (the object) into a 
        // persistent store should a few conditions get satisfied.        
        // Note: throws MSALDBException
        public function save(){
            
            // we let the caller to handle a possible MSALDBException
            $conn =  MSALDB::getConnection();
            
            // Note: when the script ends, connection get closed!
            
        }      
        */
        
        // this method checks the validity of itself;
        // Is this MSAL object successfully mimics a sense (meaningful) 
        // ModSecurity Single Audit Log File?        
        public function isValid(){
            $validMSALHeader = FALSE;
            $validMSALRequestHeaders = FALSE;            
            $validMSALResponseHeaders = FALSE;
            $validMSALTrailer = FALSE;
            
            // all members of msalHeader should be defined
            // NOTE: You can’t use the function $this->msalHeader inside isset(). 
            if(isset($this->msalHeader)){
                if(
                   $this->msalHeader->getUniqueId() && 
                   $this->msalHeader->getSrcIP() && 
                   $this->msalHeader->getSrcPort() && 
                   $this->msalHeader->getDstIP() && 
                   $this->msalHeader->getDstPort()
                  )
                  $validMSALHeader = TRUE;
            }

            // some members of msalRequestHeaders should be defined
            if(isset($this->msalRequestHeaders)){
                if(
                   $this->msalRequestHeaders->getRequestMethod() && 
                   $this->msalRequestHeaders->getRequestUri() && 
                   $this->msalRequestHeaders->getRequestProtocol()
                  )
                  $validMSALRequestHeaders = TRUE;
            }
            
            // some members of msalResponseHeaders should be defined
            if(isset($this->msalResponseHeaders)){
                if(
                   $this->msalResponseHeaders->getResponseStatusCode() 
                  )
                  $validMSALResponseHeaders = TRUE;
            }
            
            // some members of msalTrailer should be defined
            // NOTE:
            // Should there be alert messages for MSAL to be defined as "valid"?
            // I've seen audit_logs in which there were no "Messages:" headers in part H
            if(isset($this->msalTrailer)){
                if(
                   $this->msalTrailer->getDuration() && 
                   $this->msalTrailer->getTimestamp() &&
                   $this->msalTrailer->getAlertMessages()
                  )
                  $validMSALTrailer = TRUE;
            }

            if($validMSALTrailer && $validMSALResponseHeaders &&
               $validMSALRequestHeaders && $validMSALHeader)
               return TRUE;
            
            return FALSE;
        }
        
        // toString magic method
        public function __toString(){
            $str = ($this->msalHeader?$this->msalHeader."\r\n":'') .
                   ($this->msalRequestHeaders?$this->msalRequestHeaders."\r\n":'') .
                   ($this->msalRequestBody?$this->msalRequestBody . "\r\n":'') .
                   ($this->msalResponseHeaders?$this->msalResponseHeaders . "\r\n":'') ;
            
            $str .= ($this->msalResponseBody?$this->msalResponseBody.'<br/>':'');
              
            $str .= ($this->msalTrailer?$this->msalTrailer.'<br/>':'');
            
            return $str;
                                      
        }
        
        // toString magic method
        public function toStringHTML(){
            
            $str = ($this->msalHeader?$this->msalHeader->toStringHTML().'<br/>':'') .
                   ($this->msalRequestHeaders?$this->msalRequestHeaders->toStringHTML().'<br/>':'') .
                   ($this->msalRequestBody?$this->msalRequestBody->toStringHTML().'<br/>':'') .
                   ($this->msalResponseHeaders?$this->msalResponseHeaders->toStringHTML().'<br/>':'') ;
                   
            $str .= ($this->msalResponseBody?$this->msalResponseBody->toStringHTML().'<br/>':'');
              
            $str .= ($this->msalTrailer?$this->msalTrailer->toStringHTML().'<br/>':'');
            
            return $str;
                   
        }        
    }

?>
