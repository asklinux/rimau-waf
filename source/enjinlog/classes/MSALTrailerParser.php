<?php
/**
 * Author: bedirhan
 * 
 * This class takes an input stream, processes it and produces an object 
 * representation of a single modsecurity audit log's part H.
 * 
 * Example Entry;

--9686b17c-H--
Message: Access denied with code 500 (phase 2). Pattern match "(?:\\b(?:(?:s(?:elect\\b(?:.{1,100}?\\b(?:(?:length|count|top)\\b.{1,100}?\\bfrom|from\\b.{1,100}?\\bwhere)|.*?\\b(?:d(?:ump\\b.*\\bfrom|ata_type)|(?:to_(?:numbe|cha)|inst)r))|p_(?:(?:addextendedpro|sqlexe)c|(?:oacreat|prepar)e|execute(?:sql)?|makewebt ..." at ARGS:name. [id "950001"] [msg "SQL Injection Attack. Matched signature <union select>"] [severity "CRITICAL"]
Action: Intercepted (phase 2)
Stopwatch: 1209964824490940 115379 (102802* 103660 -)
Producer: ModSecurity v2.1.4 (Apache 2.x)
Server: Apache/2.0.61 (FreeBSD) PHP/5.2.5 with Suhosin-Patch

 */
    
    require_once "MSALTrailer.php";
    require_once "AlertMessageParser.php";
    require_once "MSALParserException.php";
    
    // ModSecurity Single Audit Log Part H Parser
    class MSALTrailerParser{
        
        const HEADER_PATTERN = "/^(\S+)\s*:\s*(.+)$/";
        const STOPWATCH_VALUE_PATTERN = '/^(\d+) (\d+)( \((-|\d+)\*? (-|\d+) (-|\d+)\))?$/';
        const EMPTY_LINE_PATTERN = '/^\s+$/';
        const WEBAPP_DETAILS_PATTERN = '/^\"(.+)\" \"(.+)\" \"(.+)\"$/';
        
        // NOTE: if one of the headers of Part H is "Action", then it is blocked
        // look at the above
        
         /*      
         * $lines is an array which contains a ModSecurity single audit log. 
         * $startIndex is the index that ModSecurity response body starts
         * $endIndex is the index that ModSecurity response body ends
         */
        public static function parse(&$lines, $startIndex, $endIndex){
            $msalTrailer = NULL;
            
            if($startIndex > $endIndex)
                throw new MSALParserException("MSAL (H) erroneous number of trailer header lines: " . ($endIndex - $startIndex));
            
            $msalTrailer = new MSALTrailer();
            
            // first apply the HEADER_PATTERN and get two halves!!!
            for($index = $startIndex; $index <= $endIndex; $index++){
                $aHeader = trim($lines[$index]);
                if(preg_match(self::HEADER_PATTERN, $aHeader, $matches)){
                    // message where we get the alert's details of this
                    // single modsec audit log
                    if(strcasecmp($matches[1], "Message") == 0){
                      $msalTrailer->addAlertMessage(AlertMessageParser::parse($matches[0]));
                    }
                    // stopwatch where we parse the timestamp and duration of this
                    // single modsec audit log 
                    else if(strcasecmp($matches[1], "Stopwatch") == 0){
                        if(preg_match(self::STOPWATCH_VALUE_PATTERN, $matches[2], $matches2)){
                            $msalTrailer->setTimestamp($matches2[1]);
                            $msalTrailer->setDuration($matches2[2]);
                        }
                        else{
                          throw new MSALParserException("MSAL (H) erroneous trailer Stopwatch header: " . $matches[0]);
                        }
                    }
                    // if there's a header named Action, this means
                    // the original request that caused this single modsec audit 
                    // log entry is blocked
                    else if(strcasecmp($matches[1], "Action") == 0){
                        $msalTrailer->setBlocked();
                    }
                    // There are also "Apache-Error:" headers, which we don't keep any
                    else if(strcasecmp($matches[1], "Apache-Error") == 0){
                        // do nothing for now, since without any Messages this MSAL
                        // will be invalid and NOT LOGGED!
                    }                 
                    // WebApp-Info header includes the application/user details when SecWebAppId is used
                    else if(strcasecmp($matches[1], "WebApp-Info") == 0){
                        if(preg_match(self::WEBAPP_DETAILS_PATTERN, $matches[2], $matches2)){
                            if(strcasecmp($matches[1], "-") != 0)
                              $msalTrailer->setWebappId($matches2[1]);
                            if(strcasecmp($matches[2], "-") != 0)
                              $msalTrailer->setSessId($matches2[2]);
                            if(strcasecmp($matches[3], "-") != 0)
                              $msalTrailer->setUserId($matches2[3]);
                        }
                        else{
                          throw new MSALParserException("MSAL (H) erroneous trailer WebApp-Info header: " . $matches[0]);
                        }
                    }                                     
                    // NOTE: For now, we don't analyze other trailer headers
                }
                // if the line is the last one
                else if( ($index == $endIndex) && preg_match(self::EMPTY_LINE_PATTERN, $lines[$index])){
                    // then the line can be empty, I've seen this in modsec logs
                }                 
                else{
                    throw new MSALParserException("MSAL (B) erroneous trailer header: " . $aHeader);
                }
            }
            
            return $msalTrailer;
        }
        
    }

?>