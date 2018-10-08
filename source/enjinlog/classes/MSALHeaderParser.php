<?php
/**
 * Author: bedirhan
 * 
 * This class takes an array of lines, processes it and produces an object 
 * representation of a single modsecurity audit log's part A.
 *
 * Example entry;

--9686b17c-A--
[05/May/2008:08:20:24 +0300] 443zvAoAACUAAApuE6cAAAAB 192.168.4.201 3458 192.168.4.205 80
  */
    
    require_once "MSALHeader.php";
    require_once "MSALParserException.php";
    
    // ModSecurity Single Audit Log Part A Parser
    class MSALHeaderParser{
        
        /* If the string is enclosed in double-quotes ("), PHP will interpret 
         * more escape sequences for special characters. So, we don't want that
         * to happen in order to prevent ambiguities.
         * NOTE: we won't be parsing the initial match, which is the date, since
         * that will come from somewhere else; part H's Stopwatch.   
         * 
         * NOTE: "uniqueid" that modsec produces is UNIQUE_ID environment 
         * variable's value of mod_unique_id Apache module. In the Apache 
         * documentation (see below), UNIQUE_ID is a string of [A-Za-z0-9@-] 
         * characters as long as 19 characters. But what I see from audit_logs 
         * is that this string is 24 characters. Below we use (\S+) regex to 
         * capture the uniqueid, we could have used ([A-Za-z0-9@-]{24}).
         * 
         * 
         * reference url: http://httpd.apache.org/docs/2.2/mod/mod_unique_id.html
         *     
         */
        const HEADER_PATTERN = '/^\[(.+)\] (\S+) ([.:0-9a-f]+) (\d+) ([.:0-9a-f]+) (\d+)$/';
                
         /*      
         * $lines is an array which contains a ModSecurity single audit log. 
         * $startIndex is the index that ModSecurity header starts
         * $endIndex is the index that ModSecurity header ends
         */
        public static function parse(&$lines, $startIndex, $endIndex){

            $msalHeader = NULL;
            
            // header should be one line, so indices should hold:  $startIndex = $endIndex
            if($startIndex != $endIndex)
                throw new MSALParserException("MSAL (A) erroneous number of header lines: " . ($endIndex - $startIndex));            
            
            /* from php.net
             * If matches is provided, then it is filled with the results of 
             * search. $matches[0] will contain the text that matched the 
             * full pattern, $matches[1] will have the text that matched the 
             * first captured parenthesized subpattern, and so on. 
             */            
            
            if(preg_match(self::HEADER_PATTERN, trim($lines[$startIndex]), $matches)){
                $msalHeader = new MSALHeader();
                $msalHeader->setUniqueId($matches[2]);
                $msalHeader->setSrcIP($matches[3]);
                $msalHeader->setSrcPort($matches[4]);
                $msalHeader->setDstIP($matches[5]);
                $msalHeader->setDstPort($matches[6]);
            }
            else
                throw new MSALParserException("MSAL (A) erroneous initial line: " . trim($lines[$startIndex]));
            
            return $msalHeader;
        }
        
    }

?>