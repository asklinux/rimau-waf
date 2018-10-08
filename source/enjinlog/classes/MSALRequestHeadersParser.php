<?php
/**
 * Author: bedirhan
 * 
 * This class takes an input stream, processes it and produces an object 
 * representation of a single modsecurity audit log's part B.
 * 
 * Example Entry:
 * 
--9686b17c-B--
POST /app1/index.php HTTP/1.1
Host: 192.168.4.205
User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.14) Gecko/20080404 Firefox/2.0.0.14
Accept: text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,/*;q=0.5
Accept-Language: en-us,en;q=0.5
Accept-Encoding: gzip,deflate
Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7
Keep-Alive: 300
Connection: keep-alive
Referer: http://192.168.4.205/app1/index.php
Cookie: PHPSESSID=92eb9c15038bac8afb43c399ac32d610
Content-Type: application/x-www-form-urlencoded
Content-Length: 158
 */
    
    require_once "MSALRequestHeaders.php";
    require_once "MSALParserException.php";
    
    // ModSecurity Single Audit Log Part B Parser
    class MSALRequestHeadersParser{
        
        const REQUEST_HEADER_PATTERN = '/^(\S+)\s*:\s*(.+)$/';
        const REQUEST_LINE_PATTERN = '/^(\S+) (.*?) (HTTP\/\d.\d)$/';
        const EMPTY_LINE_PATTERN = '/^\s+$/';
                
        
         /*      
         * $lines is an array which contains a ModSecurity single audit log. 
         * $startIndex is the index that ModSecurity header starts
         * $endIndex is the index that ModSecurity header ends
         */
        public static function parse(&$lines, $startIndex, $endIndex){

            $msalRequestHeaders = NULL;
            
            // NOTE: don't parse headers that start with "mod_security-"
            // Because it seems modsecurity appends such headers to the request 
            // headers
            
            if($startIndex > $endIndex)
                throw new MSALParserException("MSAL (B) erroneous number of request header lines: " . ($endIndex - $startIndex));
            
            $requestHeaderLine = trim($lines[$startIndex]);
            
            if(preg_match(self::REQUEST_LINE_PATTERN, $requestHeaderLine, $matches)){
                $msalRequestHeaders = new MSALRequestHeaders();
                $msalRequestHeaders->setRequestLine($requestHeaderLine);
                $msalRequestHeaders->setRequestMethod($matches[1]);
                $arr = explode('?', $matches[2], 2);
                $msalRequestHeaders->setRequestUri($arr[0]);
                // what does $arr[1] contain when there's no query string?
                $msalRequestHeaders->setRequestQueryString($arr[1]);
                $msalRequestHeaders->setRequestProtocol($matches[3]);
            }
            else
                throw new MSALParserException("MSAL (B) erroneous request initial line: " . $requestHeaderLine);
            
            for($index = $startIndex + 1; $index <= $endIndex; $index++){
                $aHeader = trim($lines[$index]);
                if(preg_match(self::REQUEST_HEADER_PATTERN, $aHeader, $matches)){
                    // strpos doesn't work, check return values out!
                    //if(strpos($matches[0], "mod-security") != 0){
                        $msalRequestHeaders->addRequestHeader($matches[0]);
                    //}
                }
                // if the line is the last one
                else if( ($index == $endIndex) && preg_match(self::EMPTY_LINE_PATTERN, $lines[$index])){
                    // then the line can be empty, I've seen this in modsec logs
                }
                else{
                    throw new MSALParserException("MSAL (B) erroneous request header: " . $aHeader);
                }
            }
            
            return $msalRequestHeaders;
        }
        
    }

?>