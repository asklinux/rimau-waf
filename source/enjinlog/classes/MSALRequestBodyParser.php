<?php
/**
 * Author: bedirhan
 * 
 * This class takes an input stream, processes it and produces an object 
 * representation of a single modsecurity audit log's part C.
 * 
 * Example entry;
 * 
--9686b17c-C--
name=asd%27+union+select+%271%27%2C%271%27%2Ccurrent_user+--&message=asd%3Cscript%3Ealert%28document.cookie%29%3C%2Fscript%3E&sendMessageButton=ADD+MY+MESSAGE
 */
    
    require_once "MSALRequestBody.php";
    require_once "MSALParserException.php";
    
    // ModSecurity Single Audit Log Part C Parser
    class MSALRequestBodyParser{
        
         /*      
         * $lines is an array which contains a ModSecurity single audit log. 
         * $startIndex is the index that ModSecurity request body starts
         * $endIndex is the index that ModSecurity request body ends
         */
        public static function parse(&$lines, $startIndex, $endIndex){
            $msalRequestBody = NULL;

            // request body should be one line, 'cause we use Log Part I, which 
            // downsizes multipart/type to a single line not including the 
            // uploaded files.
            // so indices should hold:  $startIndex = $endIndex
            if($startIndex != $endIndex)
                throw new MSALParserException("MSAL (C) erroneous number of request body lines: " . ($endIndex - $startIndex));            
            
            $msalRequestBody = new MSALRequestBody();
            $msalRequestBody->setRequestBody(trim($lines[$startIndex]));
            
            
            return $msalRequestBody;
        }
        
    }

?>