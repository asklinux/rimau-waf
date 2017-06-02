<?php
/**
 * Author: bedirhan
 * 
 * This class represents a single message in ModSecurity Single Audit Log
 * part H, there could be more than one we know.
 * 
 */

    include "AlertSeverity.php";
    
    class AlertMessage{

        // severity level of this single alert message
        // Look at AlertSeverity.php
        private $severity;
        
        // revision number of this single alert message's rule
        private $revision;
        
        // explanation message corresponding to this single alert message
        private $message;
        
        // rule id corresponding to this single alert message
        private $id;
        
        // message that generally gives the patter that the rule triggered 
        private $technicalMessage;
        
        // message that generally tells whether the rule is a warning or error
        private $generalMessage;
        
        public function __constructor(){            
        }      
        
        // SETTERS
        function setTechnicalMessage($technicalMessage){
            $this->technicalMessage = $technicalMessage;            
        }
        
        function setGeneralMessage($generalMessage){
            $this->generalMessage = $generalMessage;            
        }

        function setId($id){
            $this->id = $id;
        }

        function setMessage($message){
            $this->message = $message;
        }

        function setRevision($revision){
            $this->revision = $revision;
        }

        function setSeverity($severity){
            switch($severity){
                case "EMERGENCY":
                  $this->severity = AlertSeverity::EMERGENCY;
                  break;
                case "ALERT":
                  $this->severity = AlertSeverity::ALERT;
                  break;
                case "CRITICAL":
                  $this->severity = AlertSeverity::CRITICAL;
                  break;
                case "WARNING":
                  $this->severity = AlertSeverity::WARNING;
                  break;
                case "NOTICE":
                  $this->severity = AlertSeverity::NOTICE;
                  break;
                case "INFO":
                  $this->severity = AlertSeverity::INFO;
                  break;
                case "DEBUG":
                  $this->severity = AlertSeverity::DEBUG;
                  break;
                default:
                  $this->severity = AlertSeverity::UNDEFINED;   
                  break;
            }
        }
        
        // GETTERS
        function getGeneralMessage(){
            return $this->generalMessage;
        }

        function getTechnicalMessage(){
            return $this->technicalMessage;
        }

        function getId(){
            return $this->id;
        }

        function getMessage(){
            return $this->message;
        }

        function getRevision(){
            return $this->revision;
        }

        function getSeverity(){
            return $this->severity;
        }
        
        // toString magic method
        public function __toString(){
            return 'Message: ' . 
                    $this->getGeneralMessage() . '. ' .
                    $this->getTechnicalMessage() . '. ' .
                   '[id "' . $this->getId() . '"]' . 
                   '[msg "' . $this->getMessage() . '"]' . 
                   '[rev "' . $this->getRevision() . '"]' . 
                   '[severity "' . $this->getSeverityString() . '"]' ;
        }        

        public function toStringHTML(){
            return 'Message: ' . 
                    htmlentities($this->getGeneralMessage(), ENT_QUOTES, 'UTF-8') . '. ' .
                    htmlentities($this->getTechnicalMessage(), ENT_QUOTES, 'UTF-8') . '. ' .
                   '[id "'  . htmlentities($this->getId(), ENT_QUOTES, 'UTF-8') . '"]' . 
                   '[msg "' . htmlentities($this->getMessage(), ENT_QUOTES, 'UTF-8') . '"]' . 
                   '[rev "' . htmlentities($this->getRevision(), ENT_QUOTES, 'UTF-8') . '"]' . 
                   '[severity "' . $this->getSeverityString() . '"]' ;
        }        

        function getSeverityString(){            
            switch($this->severity){
                case AlertSeverity::EMERGENCY:
                  return "EMERGENCY";
                case AlertSeverity::ALERT:
                  return "ALERT";
                case AlertSeverity::CRITICAL:
                  return "CRITICAL";
                case AlertSeverity::WARNING:
                  return "WARNING";
                case AlertSeverity::NOTICE:
                  return "NOTICE";
                case AlertSeverity::INFO:
                  return "INFO";
                case AlertSeverity::DEBUG:
                  return "DEBUG";
                default:
                  return "UNDEFINED";
            }            
        }
    }
    
?>
