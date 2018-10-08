<?php
/**
 * Author: bedirhan
 * 
 * This class represents a ModSecurity Single Audit Log's part B
 */
    
    include "HttpMethod.php";
    include "HttpProtocol.php";

    class MSALRequestHeaders{
        
        // complete request line before parsing, do we need this?
        private $requestLine;

        // GET, POST, HEAD e.t.c., 
        // for enumerations look at HttpMethod.php
        private $requestMethod;
        
        // relative URI string Ex: /Action.cmd
        private $requestUri;
        
        // query string Ex; ?dispatch=salesinit
        private $requestQueryString;
        
        // protocol used, HTTP/1.1, HTTP/1.0, 0.9
        // for enumerations look at HttpProtocol.php
        private $requestProtocol;
        
        // HTTP request headers
        private $requestHeaders = array();
        
        // NOTE: This doesn't get called when $msal = new MSALRequestHeaders();
        public function __constructor(){    
            // $this->requestHeaders = array();
        }        
        
        // SETTERS
        function addRequestHeader($requestHeader){
            array_push($this->requestHeaders, $requestHeader);
        }
        
        function setRequestMethod($requestMethod){
            switch($requestMethod){
                case "GET":
                  $this->requestMethod = HttpMethod::GET;
                  break;
                case "OPTIONS":
                  $this->requestMethod = HttpMethod::OPTIONS;
                  break;
                case "HEAD":
                  $this->requestMethod = HttpMethod::HEAD;
                  break;
                case "TRACE":
                  $this->requestMethod = HttpMethod::TRACE;
                  break;
                case "TRACK":
                  $this->requestMethod = HttpMethod::TRACK;
                  break;
                case "POST":
                  $this->requestMethod = HttpMethod::POST;
                  break;
                case "PUT":
                  $this->requestMethod = HttpMethod::PUT;
                  break;
                case "DELETE":
                  $this->requestMethod = HttpMethod::DELETE;
                  break;
                case "CONNECT":
                  $this->requestMethod = HttpMethod::CONNECT;
                  break;
                case "PROPFIND":
                  $this->requestMethod = HttpMethod::PROPFIND;
                  break;
                case "PROPPATCH":
                  $this->requestMethod = HttpMethod::PROPPATCH;
                  break;
                case "MKCOL":
                  $this->requestMethod = HttpMethod::MKCOL;
                  break;
                case "COPY":
                  $this->requestMethod = HttpMethod::COPY;
                  break;
                case "MOVE":
                  $this->requestMethod = HttpMethod::MOVE;
                  break;
                case "LOCK":
                  $this->requestMethod = HttpMethod::LOCK;
                  break;
                case "UNLOCK":
                  $this->requestMethod = HttpMethod::UNLOCK;
                  break;
                default:
                  $this->requestMethod = HttpMethod::UNDEFINED;   
                  break;
            }            
        }

        function setRequestUri($requestUri){
            $this->requestUri = $requestUri;
        }

        function setRequestProtocol($requestProtocol){
            switch($requestProtocol){
                case "HTTP/0.9":
                  $this->requestProtocol = HttpProtocol::HTTP09;
                  break;
                case "HTTP/1.0":
                  $this->requestProtocol = HttpProtocol::HTTP10;
                  break;
                case "HTTP/1.1":
                  $this->requestProtocol = HttpProtocol::HTTP11;
                  break;
                case "HTTP/1.2":
                  $this->requestProtocol = HttpProtocol::HTTP12;
                  break;
                default:
                  $this->requestProtocol = HttpProtocol::UNDEFINED;   
                  break;
            }                        
        }

        function setRequestQueryString($requestQueryString){
            $this->requestQueryString = $requestQueryString;
        }
        
        function setRequestLine($requestLine){
            $this->requestLine = $requestLine;
        }
        
        // GETTERS
        function getRequestHeaders(){
            return $this->requestHeaders;
        }

        function getRequestLine(){
            return $this->requestLine;
        }
        
        function getRequestUri(){
            return $this->requestUri;
        }

        function getRequestMethod(){
            return $this->requestMethod;
        }
        
        function getRequestProtocol(){
            return $this->requestProtocol;
        }

        function getRequestQueryString(){
            return $this->requestQueryString;
        }
        
        function getRequestReferer(){
          
            foreach($this->requestHeaders as $aHeader){
                if(preg_match('/^Referer\s*:\s*(.+)$/', $aHeader, $matches)){
                  return $matches[1];
                }                
            }
            
            return '';
        }

        function getRequestHost(){
          
            foreach($this->requestHeaders as $aHeader){
                if(preg_match('/^Host\s*:\s*(.+)$/', $aHeader, $matches)){
                  return $matches[1];
                }                
            }
            
            return '';
        }

        function getRequestContentType(){
          
            foreach($this->requestHeaders as $aHeader){
                if(preg_match('/^Content\-Type\s*:\s*(.+)$/', $aHeader, $matches)){
                  return $matches[1];
                }                
            }
            
            return '';
        }
        
        function getRequestUserAgent(){
          
            foreach($this->requestHeaders as $aHeader){
                if(preg_match('/^User-Agent\s*:\s*(.+)$/', $aHeader, $matches)){
                  return $matches[1];
                }                
            }
            
            return '';
        }

        // toString magic method
        public function __toString(){
            $str = '--B--' . "\r\n";
            
            $str .= $this->getRequestMethodString() . ' '; 
            
            $str .= $this->getRequestUri();

            if($this->getRequestQueryString())
              $str .= '?' . $this->getRequestQueryString();
            
            $str .= ' ' . $this->getRequestProtocolString() . "\r\n";
            
            // adding headers
            foreach ($this->getRequestHeaders() as $requestHeader)                
                $str .= $requestHeader . "\r\n";

            return $str;
        }        
        
        public function toStringHTML(){
            $str = '--B--' . '<br/>';
            
            $str .= htmlentities($this->getRequestMethodString(), ENT_QUOTES, 'UTF-8') . ' '; 
            
            $str .= htmlentities($this->getRequestUri(), ENT_QUOTES, 'UTF-8');

            if($this->getRequestQueryString())
              $str .= '?' . htmlentities($this->getRequestQueryString(), ENT_QUOTES, 'UTF-8');
            
            $str .= ' ' . htmlentities($this->getRequestProtocolString(), ENT_QUOTES, 'UTF-8') . '<br/>';
            
            // adding headers
            foreach ($this->getRequestHeaders() as $requestHeader)                
                $str .= htmlentities($requestHeader, ENT_QUOTES, 'UTF-8') . '<br/>';

            return $str;
        }          
        
        public function getRequestMethodString(){
            switch($this->requestMethod){
                case HttpMethod::GET:
                  return "GET";
                case HttpMethod::OPTIONS:
                  return "OPTIONS";
                case HttpMethod::HEAD:
                  return "HEAD";
                case HttpMethod::TRACE:
                  return "TRACE";
                case HttpMethod::TRACK:
                  return "TRACK";
                case HttpMethod::POST:
                  return "POST";
                case HttpMethod::PUT:
                  return "PUT";
                case HttpMethod::DELETE:
                  return "DELETE";
                case HttpMethod::CONNECT:
                  return "CONNECT";
                case HttpMethod::PROPFIND:
                  return "PROPFIND";
                case HttpMethod::PROPPATCH:
                  return "PROPPATCH";
                case HttpMethod::MKCOL:
                  return "MKCOL";
                case HttpMethod::COPY:
                  return "COPY";
                case HttpMethod::MOVE:
                  return "MOVE";
                case HttpMethod::LOCK:
                  return "LOCK";
                case HttpMethod::UNLOCK:
                  return "UNLOCK";
                default:
                  return "UNDEFINED";   
                  break;
            }                        
        }

        public function getRequestProtocolString(){
            switch($this->requestProtocol){
                case HttpProtocol::HTTP09:
                  return "HTTP/0.9";
                case HttpProtocol::HTTP10:
                  return "HTTP/1.0";
                case HttpProtocol::HTTP11:
                  return "HTTP/1.1";
                case HttpProtocol::HTTP12:
                  return "HTTP/1.2";
                default:
                  return "UNDEFINED";   
            }           
        }

    }
    
    
?>