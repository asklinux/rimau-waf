<?php
/**
 * Author: bedirhan
 */

    class FileLogger{
        
        public static $LOGFILE = "msallog.txt";
        
        public static function DEBUG($message){
            FileLogger::LOG("DEBUG", $message);
        }
        public static function ERROR($message){
            FileLogger::LOG("ERROR", $message);
        }
        public static function INFO($message){
            FileLogger::LOG('INFO ', $message);
        }
        public static function WARNING($message){
            FileLogger::LOG('WARN ', $message);
        }
        
        private static function LOG($level, $message){
            
            $logFile = fopen(FileLogger::$LOGFILE, "a+");
            if($logFile){
                fwrite($logFile, date("y-m-d H:i:s") . '  ' . $level . '  ' . $message . "\r\n");
                fclose($logFile);
            }
            
        }
    }
?>
