<?php
/**
 * Author: bedirhan
 * 
 * This class takes an input stream, processes it and produces an object 
 * representation of a single modsecurity audit log's part E.
 * 
 * Example Entry;
 * ???
 */
    
    require_once "MSALResponseBody.php";
    require_once "MSALParserException.php";
    
    // ModSecurity Single Audit Log Part B Parser
    class MSALResponseBodyParser{
        
         /*      
         * $lines is an array which contains a ModSecurity single audit log. 
         * $startIndex is the index that ModSecurity response body starts
         * $endIndex is the index that ModSecurity response body ends
         */
        public static function parse(&$lines, $startIndex, $endIndex){
            
            if($startIndex > $endIndex)
                throw new MSALParserException("MSAL (E) erroneous number of response body lines: " . ($endIndex - $startIndex));
            
            $msalResponseBody = new MSALResponseBody();
            
            $response = "";
            for($index = $startIndex; $index <= $endIndex; $index++)
              $response .= $lines[$index] . "\n";

            $msalResponseBody->setResponseBody($response);
            
            return $msalResponseBody;
        }
        
    }

?>