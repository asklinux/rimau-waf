<?php
/**
 * Author: bedirhan
 * 
 * This class represents an enumeration of Category values of an Alert
 */
    class AlertCategory{
        
        const UNDEFINED               = 0;
        const XSS                     = 1;
        const SQL_INJECTION           = 2;
        const XPATH_INJECTION         = 3;
        const COMMAND_INJECTION       = 4;
        const PATH_TRAVERSAL          = 5;
        const HTTP_RESPONSE_SPLITTING = 6;
        //...
        
    }

?>