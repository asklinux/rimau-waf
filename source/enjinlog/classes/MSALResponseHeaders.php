<?php
/**
 * Author: bedirhan
 * 
 * This class represents a ModSecurity Single Audit Log's part F
 */

    include "HttpStatusCode.php";
    
    class MSALResponseHeaders{
        
        // complete response line before parsing, do we need this?
        private $responseLine;

        // protocol used, HTTP/1.1, HTTP/1.0, 0.9
        private $responseProtocol;
        
        // response status in number
        private $responseStatusCode;
        
        // response status in string
        private $responseStatusPhrase;
        
        // HTTP response headers
        private $responseHeaders = array();
        
        public function __constructor(){            
            //$this->responseHeaders = array();
        }        

        // SETTERS
        function addResponseHeader($responseHeader){
            array_push($this->responseHeaders, $responseHeader);
        }
        
        function setResponseLine($responseLine){
            $this->responseLine = $responseLine;
        }

        function setResponseStatusCode($responseStatusCode){
           switch($responseStatusCode){
                case "100":
                  $this->responseStatusCode = HttpStatusCode::INFO_100;
                  break;
                case "101":
                  $this->responseStatusCode = HttpStatusCode::INFO_101;
                  break;
                case "102":
                  $this->responseStatusCode = HttpStatusCode::INFO_102;
                  break;
                case "200":
                  $this->responseStatusCode = HttpStatusCode::SUCCESS_200;
                  break;
                case "201":
                  $this->responseStatusCode = HttpStatusCode::SUCCESS_201;
                  break;
                case "202":
                  $this->responseStatusCode = HttpStatusCode::SUCCESS_202;
                  break;
                case "203":
                  $this->responseStatusCode = HttpStatusCode::SUCCESS_203;
                  break;
                case "204":
                  $this->responseStatusCode = HttpStatusCode::SUCCESS_204;
                  break;
                case "205":
                  $this->responseStatusCode = HttpStatusCode::SUCCESS_205;
                  break;
                case "206":
                  $this->responseStatusCode = HttpStatusCode::SUCCESS_206;
                  break;
                case "207":
                  $this->responseStatusCode = HttpStatusCode::SUCCESS_207;
                  break;
                case "300":
                  $this->responseStatusCode = HttpStatusCode::REDIRECTION_300;
                  break;
                case "301":
                  $this->responseStatusCode = HttpStatusCode::REDIRECTION_301;
                  break;
                case "302":
                  $this->responseStatusCode = HttpStatusCode::REDIRECTION_302;
                  break;
                case "303":
                  $this->responseStatusCode = HttpStatusCode::REDIRECTION_303;
                  break;
                case "304":
                  $this->responseStatusCode = HttpStatusCode::REDIRECTION_304;
                  break;
                case "305":
                  $this->responseStatusCode = HttpStatusCode::REDIRECTION_305;
                  break;
                case "306":
                  $this->responseStatusCode = HttpStatusCode::REDIRECTION_306;
                  break;
                case "307":
                  $this->responseStatusCode = HttpStatusCode::REDIRECTION_307;
                  break;   
                case "400":
                  $this->responseStatusCode = HttpStatusCode::CLIENTERR_400;
                  break;
                case "401":
                  $this->responseStatusCode = HttpStatusCode::CLIENTERR_401;
                  break;
                case "402":
                  $this->responseStatusCode = HttpStatusCode::CLIENTERR_402;
                  break;
                case "403":
                  $this->responseStatusCode = HttpStatusCode::CLIENTERR_403;
                  break;
                case "404":
                  $this->responseStatusCode = HttpStatusCode::CLIENTERR_404;
                  break;
                case "405":
                  $this->responseStatusCode = HttpStatusCode::CLIENTERR_405;
                  break;
                case "406":
                  $this->responseStatusCode = HttpStatusCode::CLIENTERR_406;
                  break;
                case "407":
                  $this->responseStatusCode = HttpStatusCode::CLIENTERR_407;
                  break;                  
                case "408":
                  $this->responseStatusCode = HttpStatusCode::CLIENTERR_408;
                  break;                  
                case "409":
                  $this->responseStatusCode = HttpStatusCode::CLIENTERR_409;
                  break;                  
                case "410":
                  $this->responseStatusCode = HttpStatusCode::CLIENTERR_410;
                  break;                  
                case "411":
                  $this->responseStatusCode = HttpStatusCode::CLIENTERR_411;
                  break;                  
                case "412":
                  $this->responseStatusCode = HttpStatusCode::CLIENTERR_412;
                  break;                  
                case "413":
                  $this->responseStatusCode = HttpStatusCode::CLIENTERR_413;
                  break;                  
                case "414":
                  $this->responseStatusCode = HttpStatusCode::CLIENTERR_414;
                  break;                  
                case "415":
                  $this->responseStatusCode = HttpStatusCode::CLIENTERR_415;
                  break;                  
                case "416":
                  $this->responseStatusCode = HttpStatusCode::CLIENTERR_416;
                  break;                  
                case "417":
                  $this->responseStatusCode = HttpStatusCode::CLIENTERR_417;
                  break;                  
                case "421":
                  $this->responseStatusCode = HttpStatusCode::CLIENTERR_421;
                  break;                  
                case "422":
                  $this->responseStatusCode = HttpStatusCode::CLIENTERR_422;
                  break;                  
                case "423":
                  $this->responseStatusCode = HttpStatusCode::CLIENTERR_423;
                  break;                  
                case "424":
                  $this->responseStatusCode = HttpStatusCode::CLIENTERR_424;
                  break;                  
                case "425":
                  $this->responseStatusCode = HttpStatusCode::CLIENTERR_425;
                  break;                  
                case "426":
                  $this->responseStatusCode = HttpStatusCode::CLIENTERR_426;
                  break;                  
                case "449":
                  $this->responseStatusCode = HttpStatusCode::CLIENTERR_449;
                  break;                  
                case "500":
                  $this->responseStatusCode = HttpStatusCode::SERVERERR_500;
                  break;
                case "501":
                  $this->responseStatusCode = HttpStatusCode::SERVERERR_501;
                  break;
                case "502":
                  $this->responseStatusCode = HttpStatusCode::SERVERERR_502;
                  break;
                case "503":
                  $this->responseStatusCode = HttpStatusCode::SERVERERR_503;
                  break;
                case "504":
                  $this->responseStatusCode = HttpStatusCode::SERVERERR_504;
                  break;
                case "505":
                  $this->responseStatusCode = HttpStatusCode::SERVERERR_505;
                  break;
                case "506":
                  $this->responseStatusCode = HttpStatusCode::SERVERERR_506;
                  break;
                case "507":
                  $this->responseStatusCode = HttpStatusCode::SERVERERR_507;
                  break;                  
                case "508":
                  $this->responseStatusCode = HttpStatusCode::SERVERERR_508;
                  break;                  
                case "509":
                  $this->responseStatusCode = HttpStatusCode::SERVERERR_509;
                  break;                  
                case "510":
                  $this->responseStatusCode = HttpStatusCode::SERVERERR_510;
                  break;                  
                default:
                  $this->responseStatusCode = HttpStatusCode::UNDEFINED;   
                  break;
            } 
        }

        function setResponseStatusPhrase($responseStatusPhrase){
            $this->responseStatusPhrase = $responseStatusPhrase;
        }

        function setResponseProtocol($responseProtocol){
            $this->responseProtocol = $responseProtocol;
        }
        
        // GETTERS
        function getResponseHeaders(){
            return $this->responseHeaders;
        }

        function getResponseLine(){
            return $this->responseLine;
        }

        function getResponseStatusCode(){
            return $this->responseStatusCode;
        }

        function getResponseStatusPhrase(){
            return $this->responseStatusPhrase;
        }

        function getResponseProtocol(){
            return $this->responseProtocol;
        }
        
        function getResponseContentType(){
          
            foreach($this->responseHeaders as $aHeader){
                if(preg_match('/^Content\-Type\s*:\s*(.+)$/', $aHeader, $matches)){
                  return $matches[1];
                }                
            }
            
            return '';
        }
        
        // toString magic method
        public function __toString(){
            $str = '--F--' . "\r\n";
            
            $str .= $this->getResponseProtocol() . ' '; 
            
            $str .= $this->getResponseStatusCodeString() . ' ';
            
            $str .= $this->getResponseStatusPhrase() . "\r\n";

            // adding headers
            foreach ($this->getResponseHeaders() as $responseHeader)                
                $str .= $responseHeader . "\r\n";

            return $str;
        }   

        public function toStringHTML(){
            $str = '--F--' . '<br/>';
            
            $str .= htmlentities($this->getResponseProtocol(), ENT_QUOTES, 'UTF-8') . ' '; 
            
            $str .= htmlentities($this->getResponseStatusCodeString(), ENT_QUOTES, 'UTF-8') . ' ';
            
            $str .= htmlentities($this->getResponseStatusPhrase(), ENT_QUOTES, 'UTF-8') . '<br/>';

            // adding headers
            foreach ($this->getResponseHeaders() as $responseHeader)                
                $str .= htmlentities($responseHeader, ENT_QUOTES, 'UTF-8') . '<br/>';

            return $str;
        }    

        public function getResponseStatusCodeString(){
           switch($this->responseStatusCode){
                case HttpStatusCode::INFO_100:
                  return "100";                  
                case HttpStatusCode::INFO_101:
                  return "101";                  
                case HttpStatusCode::INFO_102:
                  return "102"; 
                case HttpStatusCode::SUCCESS_200:
                  return "200";                  
                case HttpStatusCode::SUCCESS_201:
                  return "201";                  
                case HttpStatusCode::SUCCESS_202:
                  return "202";                  
                case HttpStatusCode::SUCCESS_203:
                  return "203";                  
                case HttpStatusCode::SUCCESS_204:
                  return "204";                  
                case HttpStatusCode::SUCCESS_205:
                  return "205";                  
                case HttpStatusCode::SUCCESS_206:
                  return "206";                  
                case HttpStatusCode::SUCCESS_207:
                  return "207";                
                case HttpStatusCode::REDIRECTION_300:
                  return "300";                  
                case HttpStatusCode::REDIRECTION_301:
                  return "301";                  
                case HttpStatusCode::REDIRECTION_302:
                  return "302";                  
                case HttpStatusCode::REDIRECTION_303:
                  return "303";                  
                case HttpStatusCode::REDIRECTION_304:
                  return "304";                  
                case HttpStatusCode::REDIRECTION_305:
                  return "305";                  
                case HttpStatusCode::REDIRECTION_306:
                  return "306";                  
                case HttpStatusCode::REDIRECTION_307:
                  return "307";                                 
                case HttpStatusCode::CLIENTERR_400:
                  return "400";                  
                case HttpStatusCode::CLIENTERR_401:
                  return "401";                  
                case HttpStatusCode::CLIENTERR_402:
                  return "402";                  
                case HttpStatusCode::CLIENTERR_403:
                  return "403";                  
                case HttpStatusCode::CLIENTERR_404:
                  return "404";                  
                case HttpStatusCode::CLIENTERR_405:
                  return "405";                  
                case HttpStatusCode::CLIENTERR_406:
                  return "406";                  
                case HttpStatusCode::CLIENTERR_407:
                  return "407";                  
                case HttpStatusCode::CLIENTERR_408:
                  return "408";                  
                case HttpStatusCode::CLIENTERR_409:
                  return "409";                  
                case HttpStatusCode::CLIENTERR_410:
                  return "410";                  
                case HttpStatusCode::CLIENTERR_411:
                  return "411";                  
                case HttpStatusCode::CLIENTERR_412:
                  return "412";                  
                case HttpStatusCode::CLIENTERR_413:
                  return "413";                  
                case HttpStatusCode::CLIENTERR_414:
                  return "414";                  
                case HttpStatusCode::CLIENTERR_415:
                  return "415";                  
                case HttpStatusCode::CLIENTERR_416:
                  return "416";                  
                case HttpStatusCode::CLIENTERR_417:
                  return "417";                  
                case HttpStatusCode::CLIENTERR_421:
                  return "421";                  
                case HttpStatusCode::CLIENTERR_422:
                  return "422";                  
                case HttpStatusCode::CLIENTERR_423:
                  return "423";                  
                case HttpStatusCode::CLIENTERR_424:
                  return "424";                  
                case HttpStatusCode::CLIENTERR_425:
                  return "425";                  
                case HttpStatusCode::CLIENTERR_426:
                  return "426";                  
                case HttpStatusCode::CLIENTERR_449:
                  return "449";                  
                case HttpStatusCode::SERVERERR_500:
                  return "500";                  
                case HttpStatusCode::SERVERERR_501:
                  return "501";                  
                case HttpStatusCode::SERVERERR_502:
                  return "502";                  
                case HttpStatusCode::SERVERERR_503:
                  return "503";                  
                case HttpStatusCode::SERVERERR_504:
                  return "504";                  
                case HttpStatusCode::SERVERERR_505:
                  return "505";                  
                case HttpStatusCode::SERVERERR_506:
                  return "506";                  
                case HttpStatusCode::SERVERERR_507:
                  return "507";                  
                case HttpStatusCode::SERVERERR_508:
                  return "508";                  
                case HttpStatusCode::SERVERERR_509:
                  return "509";                  
                case HttpStatusCode::SERVERERR_510:
                  return "510";                  
                default:
                  return "UNDEFINED";
            }             
        }
        
    }
    
?>