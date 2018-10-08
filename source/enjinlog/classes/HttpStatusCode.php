<?php
/**
 * Author: bedirhan
 * 
 * This class represents an enumeration of http status codes
 */
    class HttpStatusCode{
        
        const UNDEFINED         = 0;
        
        // 1xx Informational
        const INFO_100          = 1;
        const INFO_101          = 2;
        const INFO_102          = 3;
        
        // 2xx Success
        const SUCCESS_200       = 4;
        const SUCCESS_201       = 5;
        const SUCCESS_202       = 6;
        const SUCCESS_203       = 7;
        const SUCCESS_204       = 8;
        const SUCCESS_205       = 9;
        const SUCCESS_206       = 10;
        const SUCCESS_207       = 11;
        
        // 3xx Redirection
        const REDIRECTION_300   = 12;
        const REDIRECTION_301   = 13;
        const REDIRECTION_302   = 14;
        const REDIRECTION_303   = 15;
        const REDIRECTION_304   = 16;
        const REDIRECTION_305   = 17;
        const REDIRECTION_306   = 18;
        const REDIRECTION_307   = 19;
        
        // 4xx Client Error
        const CLIENTERR_400     = 20;
        const CLIENTERR_401     = 21;
        const CLIENTERR_402     = 22;
        const CLIENTERR_403     = 23;
        const CLIENTERR_404     = 24;
        const CLIENTERR_405     = 25;
        const CLIENTERR_406     = 26;
        const CLIENTERR_407     = 27;
        const CLIENTERR_408     = 28;
        const CLIENTERR_409     = 29;
        const CLIENTERR_410     = 30;
        const CLIENTERR_411     = 31;
        const CLIENTERR_412     = 32;
        const CLIENTERR_413     = 33;
        const CLIENTERR_414     = 34;
        const CLIENTERR_415     = 35;
        const CLIENTERR_416     = 36;
        const CLIENTERR_417     = 37;
        const CLIENTERR_421     = 38;
        const CLIENTERR_422     = 39;
        const CLIENTERR_423     = 40;
        const CLIENTERR_424     = 41;
        const CLIENTERR_425     = 42;
        const CLIENTERR_426     = 43;
        const CLIENTERR_449     = 44;
        
        // 5xx Server Error
        const SERVERERR_500     = 45;
        const SERVERERR_501     = 46;
        const SERVERERR_502     = 47;
        const SERVERERR_503     = 48;
        const SERVERERR_504     = 49;
        const SERVERERR_505     = 50;
        const SERVERERR_506     = 51;
        const SERVERERR_507     = 52;                
        const SERVERERR_509     = 53;        
        const SERVERERR_510     = 54;
        
        // ...
    }    

?>
