<?php
/**
 * Author: bedirhan
 * 
 * This class takes an input stream, processes it and produces an object 
 * representation of a single modsecurity audit log's part F.
 * 
 * Example entry;
 * 
--9686b17c-F--
HTTP/1.1 500 Internal Server Error
Content-Length: 552
Connection: close
Content-Type: text/html; charset=iso-8859-1
 */
    
    require_once "MSALResponseHeaders.php";
    require_once "MSALParserException.php";
    
    // ModSecurity Single Audit Log Part F Parser
    class MSALResponseHeadersParser{
        
        const RESPONSE_HEADER_PATTERN = '/^(\S+)\s*:\s*(.+)$/';
        const RESPONSE_LINE_PATTERN = '/^(HTTP\/\d\.\d) (\d{3}) (.+)$/';
        const EMPTY_LINE_PATTERN = '/^\s+$/';
                
         /*      
         * $lines is an array which contains a ModSecurity single audit log. 
         * $startIndex is the index that ModSecurity response body starts
         * $endIndex is the index that ModSecurity response body ends
         */
        public static function parse(&$lines, $startIndex, $endIndex){
            $msalResponseHeaders = NULL;

            if($startIndex > $endIndex)
                throw new MSALParserException("MSAL (F) erroneous number of response header lines: " . ($endIndex - $startIndex));
            
            $responseHeaderLine = trim($lines[$startIndex]);
            if(preg_match(self::RESPONSE_LINE_PATTERN, $responseHeaderLine, $matches)){
                $msalResponseHeaders = new MSALResponseHeaders();
                $msalResponseHeaders->setResponseLine($responseHeaderLine);
                $msalResponseHeaders->setResponseProtocol($matches[1]);
                $msalResponseHeaders->setResponseStatusCode($matches[2]);
                $msalResponseHeaders->setResponseStatusPhrase($matches[3]);
            }
            else
                throw new MSALParserException("MSAL (F) erroneous response initial line: " . $responseHeaderLine);
            
            for($index = $startIndex + 1; $index <= $endIndex; $index++){
                $aHeader = trim($lines[$index]);
                if(preg_match(self::RESPONSE_HEADER_PATTERN, $aHeader, $matches)){
                    $msalResponseHeaders->addResponseHeader($matches[0]);
                }
                // if the line is the last one
                else if( ($index == $endIndex) && preg_match(self::EMPTY_LINE_PATTERN, $lines[$index])){
                    // then the line can be empty, I've seen this in modsec logs
                }                
                else{
                    throw new MSALParserException("MSAL (B) erroneous response header: " . $aHeader);
                }
            }
            
            return $msalResponseHeaders;
        }
        
    }

?>