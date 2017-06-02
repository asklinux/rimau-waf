<?php
/**
 * Author: bedirhan
 */
    require_once "MSALParser.php";
    require_once "MSALDB.php";       
    
    $arrayOfLines = file("php://input");
    if($arrayOfLines){
        //$fp = fopen("test.txt","w+");
        //fwrite($fp, $msal);
        //fclose($fp);
        try{
          $msal = MSALParser::parse($arrayOfLines, 0, count($arrayOfLines) - 1);
          MSALDB::saveMSAL($msal);
        }
        catch(MSALParserException $msalpe){
            // kol kirilir yen icinde kalir
            FileLogger::ERROR($msalpe->getMessage());
        }
        catch(MSALDBException $msaldbe){
            // kol kirilir yen icinde kalir
            FileLogger::ERROR($msaldbe->getMessage());
        }
    }

    
    
    /*
     * A NOTE:
     * 
     * in mlogc.conf;
     *    CollectorRoot "/var/log/mlogc"
     *    ConsoleURI "http://[serverip]/rpc/auditLogReceiver"
     *    LogStorageDir "data"  
     *    Keep 1
     * 
     * in modsecurity_crs_10_config.conf;
     *    SecAuditLogStorageDir /var/log/mlogc/data
     * 
     * Individual log files will be created and rest in;
     *    /var/log/mlogc/data/[yyyymmdd]/[yyyymmdd-hhmm]/[yyyymmdd-hhmmss-uniqueid]
     * 
     * Individual log files' actual paths can be deducted from timestamp and 
     * uniqueid fields of audit_log table.
     * 
     * ***************************************************
     * 
     * 
     * In the target httpd.conf;
     * 
     * Script PUT /MSALParser/web/rpc.php
     * 
     * ***************************************************
     * 
     * In the target php.ini;
     * 
     * include_path=".;classes;..\classes;persistent;..\persistent"
     * 
     * 
     * ***************************************************
     * 
     * Install mysqli
     * 
     * 
     * ***************************************************
     * 
     * # MSALParser doesn't understant part K for now
     * #SecAuditLogParts "ABIFHKZ"
     * 
     * ***************************************************
     * 
     * Make use of SecWebAppId directive to take advantage of
     * WebAppId in msal db dump entries...
     * 
     * http://www.modsecurity.org/documentation/modsecurity-apache/2.5.6/modsecurity2-apache-reference.html#N10B1C
     * 
     */
?>
