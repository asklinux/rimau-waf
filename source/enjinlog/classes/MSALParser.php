<?php
/**
 * Author: bedirhan
 * 
 * This class takes an array of lines, processes it and produces an object 
 * representation of a single modsecurity audit log.
 */
    
    require_once "MSAL.php";
    require_once "MSALHeaderParser.php";
    require_once "MSALRequestHeadersParser.php";
    require_once "MSALRequestBodyParser.php";
    require_once "MSALResponseHeadersParser.php";
    require_once "MSALResponseBodyParser.php";
    require_once "MSALTrailerParser.php";
    
    require_once "MSALParserException.php";
    require_once "FileLogger.php";
    
    // ModSecurity Single Audit Log Parser
    class MSALParser{
        
        // If the string is enclosed in double-quotes ("), PHP will interpret 
        // more escape sequences for special characters. So, we don't want that
        // to happen in order to prevent ambiguities.
        const BOUNDARY_PATTERN = '/^--([0-9a-fA-F]{8,})-([A-Z])--$/';
        const EMPTY_LINE_PATTERN = '/^\s+$/';
        
        /*
         * $lines is an array which contains a ModSecurity single audit log line by line.
         */
        public static function parse(&$lines) {
          
          // the allmighty "ModSecurity Single Audit Log" object
          $msal = new MSAL();
          
          FileLogger::INFO("MSAL Parsing Started");
            
          // initialize indexes that point to start and end of a audit log part
          
          // should the single log starts with empty lines, then we have to eat them
          $startIndex = 0;
          while(preg_match(MSALParser::EMPTY_LINE_PATTERN, $lines[$startIndex])){
              $startIndex += 1;
          }          
          $endIndex = count($lines) - 1;
          
          // a simple error checking
          if($startIndex >= $endIndex)
            throw new MSALParserException("MSAL erroneous audit log (all empty lines or a single line)");
          
          while(($boundaryLetter = MSALParser::readTillNextBoundary($lines, $startIndex, $endIndex)) != '!'){
              switch($boundaryLetter){
                  case 'A':
                    FileLogger::INFO("MSAL Parsing part A");
                    $msalHeader = MSALHeaderParser::parse($lines, $startIndex, $endIndex);
                    $msal->setMSALHeader($msalHeader);
                    break;
                  case 'B':
                    FileLogger::INFO("MSAL Parsing part B");
                    $msalRequestHeaders = MSALRequestHeadersParser::parse($lines, $startIndex, $endIndex);
                    $msal->setMSALRequestHeaders($msalRequestHeaders);
                    break;
                  case 'C':
                    FileLogger::INFO("MSAL Parsing part C");
                    $msalRequestBody = MSALRequestBodyParser::parse($lines, $startIndex, $endIndex);
                    $msal->setMSALRequestBody($msalRequestBody);
                    break;
                  case 'F':
                    FileLogger::INFO("MSAL Parsing part F");
                    $msalResponseHeaders = MSALResponseHeadersParser::parse($lines, $startIndex, $endIndex);
                    $msal->setMSALResponseHeaders($msalResponseHeaders);
                    break;
                  case 'E':
                    FileLogger::INFO("MSAL Parsing part E");
                    $msalResponseBody = MSALResponseBodyParser::parse($lines, $startIndex, $endIndex);
                    $msal->setMSALResponseBody($msalResponseBody);
                    break;
                  case 'H':
                    FileLogger::INFO("MSAL Parsing part H");
                    $msalTrailer = MSALTrailerParser::parse($lines, $startIndex, $endIndex);
                    $msal->setMSALTrailer($msalTrailer);
                    break;
                  case 'Z':
                    FileLogger::INFO("MSAL Parsing part Z");
                    break;
                  default:
                    // throw an error, an unexpected log part letter is read!
                    throw new MSALParserException("An undefined log boundary specified : " . $boundaryLetter);
                    break;
              }
              // why $endIndex + 1 ?
              // because $endIndex points to a line just before the next boundary
              $startIndex = $endIndex + 1;
              // reset the endIndex
              $endIndex = count($lines) - 1;
 
              // a simple eof checking
              // should we check boundary Z? not now.
              if($startIndex > $endIndex){
                FileLogger::INFO("MSAL Parsing Finished");
                break;
              }
                

          }  

          return $msal;
        }
        
        /*
         * $startIndex is supposed to point to a boundary. This method should
         * get all the lines that this boundary includes!
         * 
         * Reads lines starting from $startIndex, when another boundary line is
         * reached, it updates sets the $endIndex and return
         */
        private static function readTillNextBoundary(&$lines, &$startIndex, &$endIndex){

            // defaults to a letter which is not defined in ModSecurity
            $boundaryLetter = '!';
            
            // determine the current part's letter
            if(preg_match(MSALParser::BOUNDARY_PATTERN, trim($lines[$startIndex]), $matches))
                $boundaryLetter = $matches[2];
            else
                throw new MSALParserException("MSAL erroneous line where boundary expected : " . trim($lines[$startIndex]));

            // why $startIndex += 1 ?
            // because $startIndex is already supposed to point to current part's boundary
            $startIndex += 1;

            // now determine where this current part ends
            for($index = $startIndex; $index < count($lines); $index++){
                if(preg_match(MSALParser::BOUNDARY_PATTERN, trim($lines[$index]))){
                    // why $index - 1 ?
                    // because $index points the the next boundary and we don't need it
                    $endIndex = $index - 1;
                    break;
                }
            }            

            return $boundaryLetter;
        }
        
    }

?>
