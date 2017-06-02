<?php
/**
 * Author: bedirhan
 */

    require_once "MSALDBException.php";
    require_once "FileLogger.php";

    require_once "MSAL.php";
    require_once "AlertCategory.php";
    require_once "AlertResolution.php";
    require_once "AlertStatus.php";
    
    class MSALDB {
        
        private static $server = "127.0.0.1";
        private static $dbname = "waf";
        private static $dbuser = "root";
        private static $dbpass = "mampu";
        
        private static $db_alerts_table = "alerts";
        private static $db_auditlog_table = "audit_log";        

        public static function getConnection() {
           
            $mysqli = new mysqli(self::$server, self::$dbuser, self::$dbpass, self::$dbname);

            if (mysqli_connect_errno()) {
                FileLogger::ERROR("Cannot connect to database: " . mysqli_connect_error());
                throw new MSALDBException("Cannot connect to database");
            }
                
            return $mysqli;            
        }
                
        /*
         * Takes MSAL object and writes it to db persistent storage.
         * throws MSALDBException
         * NOTE: 
         * In order to prevent "Too long data form column" errors we use substr
         */
        public static function saveMSAL($msal){            
            
            if(!isset($msal) || !$msal->isValid()){
                // we should at least print the uniqueid if it exists...
                $uniqueid = 'N/A';
                
                if(isset($msal) && $msal->getMSALHeader())
                    $uniqueid = $msal->getMSALHeader()->getUniqueId();
                    
                FileLogger::WARNING("Error saving to database: MSAL object is not valid with uniqueid: " . $uniqueid);
                return;
            }
            
            
            
            // connect
            $conn =  self::getConnection();

/*
CREATE TABLE  `admin` (
  `user` varchar(50) NOT NULL,
  `pass` char(50) NOT NULL,
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
*/
 
/*
INSERT INTO `admin`(`user`, `pass`) VALUES ('admin','4a823245a08c257041938042b728d9f7
');
*/          

            
            /*
CREATE TABLE  `audit_log` (
  `AuditLogID` bigint(20) unsigned NOT NULL auto_increment,
  `AuditLogUniqueID` char(32) NOT NULL, 
  `AuditLogDate` date NOT NULL,
  `AuditLogTime` time NOT NULL,
  `SourceIP` char(15) NOT NULL,
  `SourcePort` int unsigned default NULL,
  `DestinationIP` char(15) NOT NULL,
  `DestinationPort` int unsigned default NULL,
  `Referer` varchar(255) default NULL,
  `UserAgent` varchar(255) default NULL,
  `WebAppId` varchar(255) DEFAULT NULL,
  `HttpMethod` tinyint NOT NULL DEFAULT 0,
  `Uri` text,
  `QueryString` text,
  `HttpProtocol` tinyint NOT NULL DEFAULT 0,
  `Host` varchar(255) DEFAULT NULL,
  `HttpStatusCode` tinyint NOT NULL DEFAULT 0,
  `RequestContentType` varchar(255) DEFAULT NULL,
  `ResponseContentType` varchar(255) DEFAULT NULL,
  `Blocked` tinyint NOT NULL DEFAULT 0,
  `Duration` int NOT NULL,
  PRIMARY KEY  (`AuditLogID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
             */

                        
            $stmt = $conn->prepare('INSERT INTO audit_log VALUES (
                                                                 NULL,
                                                                 ?,
                                                                 ?,
                                                                 ?,
                                                                 ?, ?,
                                                                 ?, ?,
                                                                 ?, ?, ?,
                                                                 ?, ?, ?, ?,
                                                                 ?, ?, 
                                                                 ?, ?,
                                                                 ?,
                                                                 ?)'); 
            /*
            if ($stmt == FALSE) { 
                FileLogger::ERROR("Error saving MSAL to database: " + $stmt->error);
                throw new MSALDBException("Error saving MSAL to database");
            }             
            */
                    

            $msalHeader = $msal->getMSALHeader();
            $msalRequestHeaders = $msal->getMSALRequestHeaders();
            $msalResponseHeaders = $msal->getMSALResponseHeaders();
            $msalTrailer = $msal->getMSALTrailer();
            
            $stmt->bind_param('ssssisisssissisissii',
                                  substr($msalHeader->getUniqueId(),0,32),
                                  $msalTrailer->getDateInYYYY_MM_DD(),
                                  $msalTrailer->getTimeInHH_MM_SS(),
                                  substr($msalHeader->getSrcIP(),0,15), $msalHeader->getSrcPort(),
                                  substr($msalHeader->getDstIP(),0,15), $msalHeader->getDstPort(),
                                  substr($msalRequestHeaders->getRequestReferer(),0,255),                   
                                  substr($msalRequestHeaders->getRequestUserAgent(),0,255), 
                                  substr($msalTrailer->getWebappId(),0,255),
                                  $msalRequestHeaders->getRequestMethod(), 
                                  $msalRequestHeaders->getRequestUri(),
                                  $msalRequestHeaders->getRequestQueryString(),
                                  $msalRequestHeaders->getRequestProtocol(),
                                  substr($msalRequestHeaders->getRequestHost(),0,255), 
                                  $msalResponseHeaders->getResponseStatusCode(),   
                                  substr($msalRequestHeaders->getRequestContentType(),0,255),
                                  substr($msalResponseHeaders->getResponseContentType(),0,255),
                                  $msalTrailer->isBlocked(),
                                  $msalTrailer->getDuration()
                                  );

            
            if($stmt->execute())
                FileLogger::DEBUG("A MSAL object inserted into database : " . $msalHeader->getUniqueId());
            else  { 
                FileLogger::ERROR("Error saving MSAL to database: uniqueid: " . $msalHeader->getUniqueId() . " with Detailed Message: " . $stmt->error);
                throw new MSALDBException("Error saving MSAL to database");
            }
              
            $stmt->close();
            
            
            
            /*
CREATE TABLE  `alerts` (
  `AuditLogUniqueID` char(32) NOT NULL,
  `GeneralMsg` varchar(255) DEFAULT NULL,
  `TechnicalMsg` text,
  `RuleID` int(10) DEFAULT NULL,
  `Rev` varchar(128) DEFAULT NULL,
  `Msg` text,
  `Severity` tinyint DEFAULT 0,
  `Category` tinyint DEFAULT 0,
  `Status` tinyint DEFAULT 0,
  `Resolution` tinyint DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
             */
            

                        
            $stmt2 = $conn->prepare('INSERT INTO alerts VALUES(  ?,
                                                                 ?, ?,
                                                                 ?, ?,
                                                                 ?, ?,
                                                                 ?, 
                                                                 ?, ?)');
            
            /*
            if ($stmt2 == FALSE) { 
                FileLogger::ERROR("Error saving Alert to database: " + $stmt2->error);
                throw new MSALDBException("Error saving Alert to database");
            }             
            */


            foreach($msalTrailer->getAlertMessages() as $anAlertMessage){

                //FileLogger::DEBUG("Debug: " . AlertCategory::UNDEFINED);                
                     
                // why not just pass those constants to bind_param method?
                // because you can't pass const to a method accepting params by reference
                $alertCatUndef = AlertCategory::UNDEFINED;
                $alertStatOpen = AlertStatus::OPEN;
                $alertResOpen = AlertResolution::UNDEFINED;
                
                $stmt2->bind_param('sssissiiii',
                          substr($msalHeader->getUniqueId(),0,32),
                          substr($anAlertMessage->getGeneralMessage(),0,255),
                          substr($anAlertMessage->getTechnicalMessage(),0,255),
                          $anAlertMessage->getId(),
                          substr($anAlertMessage->getRevision(),0,128),
                          $anAlertMessage->getMessage(),
                          $anAlertMessage->getSeverity(),                          
                          $alertCatUndef,
                          $alertStatOpen,
                          $alertResOpen                           
                          );
            
                
                if($stmt2->execute())
                    FileLogger::DEBUG("An Alert object inserted into database : " . $msalHeader->getUniqueId());
                else  { 
                    FileLogger::ERROR("Error saving Alert to database: uniqueid: " . $msalHeader->getUniqueId() . " with Detailed Message: " . $stmt2->error);
                    throw new MSALDBException("Error saving Alert to database");
                }

                
            }
                        
            $stmt2->close();

            $conn->close();            
        }

    }

?>
