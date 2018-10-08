<?php
/**
 * Author: bedirhan
 * 
 * This class takes a single line, processes it and produces an object 
 * representation of a single modsecurity audit log alert message.

Example;
Message: Access denied with code 500 (phase 2). Pattern match "(?:\\b(?:(..." at ARGS:name. [id "950001"] [msg "SQL Injection Attack. Matched signature <union select>"] [severity "CRITICAL"]

 */
    
    require_once "AlertMessage.php";
    require_once "MSALParserException.php";
    
    // ModSecurity Single Audit Log Part H's single Alert Message Parser
    class AlertMessageParser{
        
        const REVISION_PATTERN = '/\[rev "(.+?)"\]/';
        const MESSAGE_PATTERN = '/\[msg "(.+?)"\]/';
        const SEVERITY_PATTERN = '/\[severity "(.+?)"\]/';
        const ID_PATTERN = '/\[id "(.+?)"\]/';
        
        // general message
        // Access denied with code 500 (phase 2)
        // I had to use the ungreedy option here since I want to stop matching
        // at first dot (.) character
        const GENERAL_MESSAGE_PATTERN = '/Message: (.+)\./U';

        // technical message
        //
        // Examples:
        //
        // Pattern match "(?:\\b..." at ...
        // Match of ...
        // Found 1 byte(s) outside range ...
        //
        //
        // I couldn't use the ungreedy option here since I can't stop at first
        // dot (.) character. Because technical messages contain dot (.) 
        // characters all over. So when we come accross [id we stop
        //
        // Question: How do we know that immediately after technical message comes [id?  
        // Answer: We may not be sure. Then we include (nearly) all of the metafield names; rev, msg, id, severity, 
        
        const TECHNICAL_MESSAGE_PATTERN = '/(Pattern match .+|Match of .+|Found .+)\. \[(id|rev|msg|severity)/';
        
        
         /*      
         * $line is a string which contains a ModSecurity single audit log alert
         *  message.
         */
        public static function parse(&$line){
            $alertMessage = new AlertMessage();
            
            /* from php.net
             * If matches is provided, then it is filled with the results of 
             * search. $matches[0] will contain the text that matched the 
             * full pattern, $matches[1] will have the text that matched the 
             * first captured parenthesized subpattern, and so on. 
             */            
            
            if(preg_match(self::MESSAGE_PATTERN, trim($line), $matches))
                $alertMessage->setMessage($matches[1]);            
            if(preg_match(self::REVISION_PATTERN, trim($line), $matches)){
                $alertMessage->setRevision($matches[1]);
                echo "Rev Set: " . $matches[1] . "<br/>";
                echo "Line is: " . htmlentities(trim($line)) . "<br/>";
            }
            if(preg_match(self::SEVERITY_PATTERN, trim($line), $matches))
                $alertMessage->setSeverity($matches[1]);            
            if(preg_match(self::ID_PATTERN, trim($line), $matches))
                $alertMessage->setId($matches[1]);            
            if(preg_match(self::GENERAL_MESSAGE_PATTERN, trim($line), $matches))
                $alertMessage->setGeneralMessage($matches[1]);
            if(preg_match(self::TECHNICAL_MESSAGE_PATTERN, trim($line), $matches))
                $alertMessage->setTechnicalMessage($matches[1]);
            
            return $alertMessage;
        }        
    }
?>
