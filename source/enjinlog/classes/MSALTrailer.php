<?php
/**
 * Author: bedirhan
 * 
 * This class represents a ModSecurity Single Audit Log's part H
 */

    class MSALTrailer{
        
        // the creation time of the log in nanoseconds
        // to call date function you should divide it to 1000*1000
        private $timestamp;
        
        // processing duration of the modsecurity in nanoseconds, I guess
        // I don't think we really need this for now
        private $duration;
        
        // if the http request corresponding to this log entry is blocked
        private $blocked = 0;
        
        // alert message(s) related to this single log entry
        private $alertMessages = array();
        
        // web application id when SecWebAppId is used
        /*
           in httpd.conf;
         
            <VirtualHost *:80> 
                ServerName app1.com 
                ServerAlias www.app1.com
           
                SecWebAppId "App1"
          
                SecRule REQUEST_COOKIES:PHPSESSID !^$ chain,nolog,pass 
                SecAction setsid:%{REQUEST_COOKIES.PHPSESSID} 
                ... 
            </VirtualHost>         
        */
        // which web application that this audit log entry belongs
        private $webappId;
        // which session id that this audit log entry belongs
        private $sessId;
        // which user id that this audit log entry belongs ???
        private $userId;
        
        // NOTE: in fact there are other headers set in part H, but let's 
        // leave them for now

        // this doesn't get called!
        public function __constructor(){
            // initialize alert messages array
            // $this->alertMessages = array();
        }        

        // SETTERS
        function addAlertMessage($alertMessage){
            array_push($this->alertMessages, $alertMessage);
        }
        
        function setBlocked(){
            $this->blocked = 1;
        }
        
        function setDuration($duration){
            $this->duration = $duration;
        }
        
        function setTimestamp($timestamp){
            $this->timestamp = $timestamp;
        }
        
        function setWebappId($webappId){
            $this->webappId = $webappId;
        }
        
        function setSessId($sessId){
            $this->sessId = $sessId;
        }

        function setUserId($userId){
            $this->userId = $userId;
        }
        
        // GETTERS
        function getAlertMessages(){
            return $this->alertMessages;
        }
        
        function isBlocked(){
            return $this->blocked;
        }
        
        function getDuration(){
            return $this->duration;
        }
        
        function getTimestamp(){
            return $this->timestamp;
        }
        
        function getWebappId(){
            return $this->webappId;
        }
        
        function getSessId(){
            return $this->sessId;
        }

        function getUserId(){
            return $this->userId;
        }
                
        // returns in yyyymmdd format
        function getDateInYYYYMMDD(){
            // unix format is 32 bits, java format is 64 bits
            // modsec stopwatch is in terms of nanoseconds not event milliseconds
            return date("Ymd", ($this->getTimestamp()/1000)/1000);
        }

        // returns in yyyy-mm-dd format
        function getDateInYYYY_MM_DD(){
            // unix format is 32 bits, java format is 64 bits
            // modsec stopwatch is in terms of nanoseconds not event milliseconds
            return date("Y-m-d", ($this->getTimestamp()/1000)/1000);
        }
        
        // returns in yyyymmdd-hhmm format
        function getDateInYYYYMMDDHHMM(){
            // unix format is 32 bits, java format is 64 bits
            // modsec stopwatch is in terms of nanoseconds not event milliseconds
            return date("Ymd-Hi", ($this->getTimestamp()/1000)/1000);
        }
        
        // returns in yyyymmdd-hhmmss format
        function getDateInYYYYMMDDHHMMSS(){
            // unix format is 32 bits, java format is 64 bits
            // modsec stopwatch is in terms of nanoseconds not event milliseconds
            return date("Ymd-His", ($this->getTimestamp()/1000)/1000);
        }
        
         // returns in hh:mm:ss format
        function getTimeInHH_MM_SS(){
            // unix format is 32 bits, java format is 64 bits
            // modsec stopwatch is in terms of nanoseconds not event milliseconds
            return date("H:i:s", ($this->getTimestamp()/1000)/1000);
        }       
        
        // returns in milliseconds unit
        function getDurationInMs(){
            return floor($this->getTimestamp()/1000);
        }

        // toString magic method
        public function __toString(){
            $str = '--H--' . "\r\n";
            
            // calling magic toString method of AlertMessage
            foreach ($this->getAlertMessages() as $alertMessage)                
                $str .= $alertMessage . "\r\n";
            
            if($this->isBlocked())
                $str .= 'Action: Intercepted' . "\r\n";
            
            $str .= 'Stopwatch: ' . $this->getTimestamp() . ' ' . $this->getDuration();
            
            if($this->webappId || $this->sessId || $this->userId)
              $str .= 'WebApp-Info: "' . $this->webappId . '" "' . $this->sessId . '" "' . $this->userId . '"';
            
            return $str;
        }                

        public function toStringHTML(){
            $str = '--H--' . '<br/>';
            
            // calling magic toString method of AlertMessage
            foreach ($this->getAlertMessages() as $alertMessage)                
                $str .= $alertMessage->toStringHTML() . '<br/>';
            
            if($this->isBlocked())
                $str .= 'Action: Intercepted' . '<br/>';
            
            $str .= 'Stopwatch: ' . htmlentities($this->getTimestamp(), ENT_QUOTES, 'UTF-8') . 
                    ' ' . htmlentities($this->getDuration(), ENT_QUOTES, 'UTF-8') . '<br/>';
            
            if($this->webappId || $this->sessId || $this->userId)
              $str .= 'WebApp-Info: "' . htmlentities($this->webappId, ENT_QUOTES, 'UTF-8') . '"' .
                                ' "' . htmlentities($this->sessId, ENT_QUOTES, 'UTF-8') . '"' .
                                ' "' . htmlentities($this->userId, ENT_QUOTES, 'UTF-8') . '"' ;
            
            return $str;
        }                
        
    }
    
?>