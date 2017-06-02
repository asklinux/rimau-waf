<?php
/**
 * Author: bedirhan
 * 
 * This class represents an enumeration of http method values 
 */
    class HttpMethod{
        
        const UNDEFINED   = 0;
        
        // safe methods
        const GET         = "GET";
        const OPTIONS     = "OPTIONS";
        const HEAD        = "HEAD";
        const TRACE       = "TRACE";
        const TRACK       = "TRACK"; // non standard
        
        // unsafe methods
        const POST        = "POST";
        const PUT         = "PUT";
        const DELETE      = "DELETE";
        
        // thru method
        const CONNECT     = "CONNECT";
        
        // webdav extensions
        const PROPFIND    = "PROPFIND";
        const PROPPATCH   = "PROPPATCH";
        const MKCOL       = "MKCOL";
        const COPY        = "COPY";
        const MOVE        = "MOVE";
        const LOCK        = "LOCK";
        const UNLOCK      = "UNLOCK";
        
        // ...
    }    

?>
