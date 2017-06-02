-- MySQL dump 10.14  Distrib 5.5.50-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: waf
-- ------------------------------------------------------
-- Server version	5.5.50-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `alerts`
--

DROP TABLE IF EXISTS `alerts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alerts` (
  `AuditLogUniqueID` char(32) NOT NULL,
  `GeneralMsg` varchar(255) DEFAULT NULL,
  `TechnicalMsg` text,
  `RuleID` int(10) DEFAULT NULL,
  `Rev` varchar(128) DEFAULT NULL,
  `Msg` text,
  `Severity` tinyint(4) DEFAULT '0',
  `Category` tinyint(4) DEFAULT '0',
  `Status` tinyint(4) DEFAULT '0',
  `Resolution` tinyint(4) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alerts`
--

LOCK TABLES `alerts` WRITE;
/*!40000 ALTER TABLE `alerts` DISABLE KEYS */;
/*!40000 ALTER TABLE `alerts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit_log`
--

DROP TABLE IF EXISTS `audit_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `audit_log` (
  `AuditLogID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `AuditLogUniqueID` char(32) NOT NULL,
  `AuditLogDate` date NOT NULL,
  `AuditLogTime` time NOT NULL,
  `SourceIP` char(15) NOT NULL,
  `SourcePort` int(10) unsigned DEFAULT NULL,
  `DestinationIP` char(15) NOT NULL,
  `DestinationPort` int(10) unsigned DEFAULT NULL,
  `Referer` varchar(255) DEFAULT NULL,
  `UserAgent` varchar(255) DEFAULT NULL,
  `WebAppId` varchar(255) DEFAULT NULL,
  `HttpMethod` tinyint(4) NOT NULL DEFAULT '0',
  `Uri` text,
  `QueryString` text,
  `HttpProtocol` tinyint(4) NOT NULL DEFAULT '0',
  `Host` varchar(255) DEFAULT NULL,
  `HttpStatusCode` tinyint(4) NOT NULL DEFAULT '0',
  `RequestContentType` varchar(255) DEFAULT NULL,
  `ResponseContentType` varchar(255) DEFAULT NULL,
  `Blocked` tinyint(4) NOT NULL DEFAULT '0',
  `Duration` int(11) NOT NULL,
  PRIMARY KEY (`AuditLogID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_log`
--

LOCK TABLES `audit_log` WRITE;
/*!40000 ALTER TABLE `audit_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `audit_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blacklist`
--

DROP TABLE IF EXISTS `blacklist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blacklist` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) DEFAULT NULL,
  `url_pattern` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `jenis` int(11) NOT NULL COMMENT 'jenis ip atau domain',
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blacklist`
--

LOCK TABLES `blacklist` WRITE;
/*!40000 ALTER TABLE `blacklist` DISABLE KEYS */;
INSERT INTO `blacklist` VALUES (1,0,'192.168.123.12',0,'2016-11-20 13:59:53',1),(4,NULL,'haha.com',0,'2016-11-20 14:06:38',0),(5,NULL,'88.12.31.44',0,'2016-11-20 14:06:52',1),(14,NULL,'*koko.com',0,'2016-11-20 14:20:37',0);
/*!40000 ALTER TABLE `blacklist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `server`
--

DROP TABLE IF EXISTS `server`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `server` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hosts` varchar(100) NOT NULL,
  `port` int(11) NOT NULL,
  `description` varchar(150) NOT NULL,
  `SSLCertificateFile` varchar(200) NOT NULL,
  `SSLEngine` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `server`
--

LOCK TABLES `server` WRITE;
/*!40000 ALTER TABLE `server` DISABLE KEYS */;
INSERT INTO `server` VALUES (1,'192.168.0.123',80,'web server 1','','');
/*!40000 ALTER TABLE `server` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcustom_rules`
--

DROP TABLE IF EXISTS `tblcustom_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblcustom_rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cr` varchar(50) NOT NULL,
  `stat` varchar(2) NOT NULL COMMENT 'A:Aktif, TA:Tak Aktif',
  `nokp_aktif` varchar(12) NOT NULL COMMENT 'Pengguna yang aktifkan custom rules',
  `masa_aktif` time NOT NULL COMMENT 'Masa custom rules diaktifkan (A)',
  `tarikh_aktif` date NOT NULL COMMENT 'Tarikh custom rules diaktifkan (A)',
  `nokp_deaktif` varchar(12) NOT NULL COMMENT 'Pengguna yang menukar status custom rules kepada Tidak Aktif (TA)',
  `masa_deaktif` time NOT NULL COMMENT 'Masa custom rules deaktifkan (A)',
  `tarikh_deaktif` date NOT NULL COMMENT 'Tarikh custom rules deaktifkan (TA)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcustom_rules`
--

LOCK TABLES `tblcustom_rules` WRITE;
/*!40000 ALTER TABLE `tblcustom_rules` DISABLE KEYS */;
INSERT INTO `tblcustom_rules` VALUES (1,'SecRuleRemoveById','A','','00:00:00','0000-00-00','','00:00:00','0000-00-00'),(2,'SecRuleRemoveByMsg','TA','','00:00:00','0000-00-00','','00:00:00','0000-00-00'),(3,'SecRuleRemoveByTag','A','','00:00:00','0000-00-00','','00:00:00','0000-00-00'),(4,'SecRuleUpdateActionById','A','','16:49:17','2016-11-15','','00:00:00','0000-00-00');
/*!40000 ALTER TABLE `tblcustom_rules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhttp_status_code`
--

DROP TABLE IF EXISTS `tblhttp_status_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblhttp_status_code` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `code` varchar(3) NOT NULL,
  `desc` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhttp_status_code`
--

LOCK TABLES `tblhttp_status_code` WRITE;
/*!40000 ALTER TABLE `tblhttp_status_code` DISABLE KEYS */;
INSERT INTO `tblhttp_status_code` VALUES (1,'100','Continue'),(2,'101','Switching Protocols'),(3,'102','Processing (WebDav R'),(4,'200','OK'),(5,'201','Created'),(6,'202','Accepted'),(7,'203','Non-Authoritative In'),(8,'204','No Content'),(9,'205','Reset Content'),(10,'206','Partial Content'),(11,'207','Multi-Status'),(12,'208','Already Reported'),(13,'226','IM Used (RFC 3229)'),(14,'300','Multiple Choices'),(15,'301','Moved Permanently'),(16,'302','Found'),(17,'303','See Other'),(18,'304','Not Modified'),(19,'305','Use Proxy (since HTT'),(20,'306','Switch Proxy'),(21,'307','Temporary Redirect ('),(22,'308','Permanent Redirect ('),(23,'400','Bad Request'),(24,'401','Unauthorized'),(25,'403','Forbidden'),(26,'404','Not Found');
/*!40000 ALTER TABLE `tblhttp_status_code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblid_added`
--

DROP TABLE IF EXISTS `tblid_added`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblid_added` (
  `id` int(11) NOT NULL,
  `rules_id` int(11) NOT NULL,
  `codes` text NOT NULL,
  `status` varchar(5) NOT NULL DEFAULT 'TA' COMMENT 'TA=Tak Aktif A=Aktif',
  PRIMARY KEY (`id`),
  UNIQUE KEY `rules_id` (`rules_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblid_added`
--

LOCK TABLES `tblid_added` WRITE;
/*!40000 ALTER TABLE `tblid_added` DISABLE KEYS */;
INSERT INTO `tblid_added` VALUES (1,960911,'SecRuleRemoveByID 960911','A'),(13,960007,'SecRuleRemoveByID 960007','TA');
/*!40000 ALTER TABLE `tblid_added` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblid_list`
--

DROP TABLE IF EXISTS `tblid_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblid_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rules_id` int(11) NOT NULL,
  `tag` text NOT NULL,
  `codes` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblid_list`
--

LOCK TABLES `tblid_list` WRITE;
/*!40000 ALTER TABLE `tblid_list` DISABLE KEYS */;
INSERT INTO `tblid_list` VALUES (1,960911,'OWASP_CRS/PROTOCOL_VIOLATION/INVALID_REQ','SecRuleRemoveByID 960911'),(2,981227,'OWASP_CRS/PROTOCOL_VIOLATION/INVALID_REQ','SecRuleRemoveByID 981227'),(3,960000,'OWASP_CRS/PROTOCOL_VIOLATION/INVALID_REQ','SecRuleRemoveByID 960000'),(4,960912,'OWASP_CRS/PROTOCOL_VIOLATION/INVALID_REQ','SecRuleRemoveByID 960912'),(5,960914,'OWASP_CRS/PROTOCOL_VIOLATION/INVALID_REQ','SecRuleRemoveByID 960914'),(6,960915,'OWASP_CRS/PROTOCOL_VIOLATION/INVALID_REQ','SecRuleRemoveByID 960915'),(7,960016,'OWASP_CRS/PROTOCOL_VIOLATION/INVALID_HREQ','SecRuleRemoveByID 960016'),(8,960011,'OWASP_CRS/PROTOCOL_VIOLATION/INVALID_HREQ','SecRuleRemoveByID 960011'),(9,960012,'OWASP_CRS/PROTOCOL_VIOLATION/INVALID_HREQ','SecRuleRemoveByID 960012'),(10,960902,'OWASP_CRS/PROTOCOL_VIOLATION/INVALID_HREQ','SecRuleRemoveByID 960902'),(11,960022,'OWASP_CRS/PROTOCOL_VIOLATION/INVALID_HREQ','SecRuleRemoveByID 960022'),(12,960008,'OWASP_CRS/PROTOCOL_VIOLATION/MISSING_HEADER_HOST','SecRuleRemoveByID 960008'),(13,960007,'OWASP_CRS/PROTOCOL_VIOLATION/MISSING_HEADER_HOST','SecRuleRemoveByID 960007');
/*!40000 ALTER TABLE `tblid_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblmsg_added`
--

DROP TABLE IF EXISTS `tblmsg_added`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblmsg_added` (
  `id` int(11) NOT NULL,
  `msg` text NOT NULL,
  `codes` text NOT NULL,
  `status` varchar(5) NOT NULL DEFAULT 'TA' COMMENT 'TA=Tak Aktif A=Aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblmsg_added`
--

LOCK TABLES `tblmsg_added` WRITE;
/*!40000 ALTER TABLE `tblmsg_added` DISABLE KEYS */;
INSERT INTO `tblmsg_added` VALUES (2,'Apache Error: Invalid URI in Request.','SecRuleRemoveByMsg \"Apache Error: Invalid URI in Request.\"','A'),(7,'GET or HEAD Request with Body Content.','SecRuleRemoveByMsg \"GET or HEAD Request with Body Content.\"','TA');
/*!40000 ALTER TABLE `tblmsg_added` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblmsg_list`
--

DROP TABLE IF EXISTS `tblmsg_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblmsg_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msg` text NOT NULL,
  `codes` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblmsg_list`
--

LOCK TABLES `tblmsg_list` WRITE;
/*!40000 ALTER TABLE `tblmsg_list` DISABLE KEYS */;
INSERT INTO `tblmsg_list` VALUES (1,'Invalid HTTP Request Line','SecRuleRemoveByMsg \"Invalid HTTP Request Line\"'),(2,'Apache Error: Invalid URI in Request.','SecRuleRemoveByMsg \"Apache Error: Invalid URI in Request.\"'),(3,'Attempted multipart/form-data bypass','SecRuleRemoveByMsg \"Attempted multipart/form-data bypass\"'),(4,'Failed to parse request body.','SecRuleRemoveByMsg \"Failed to parse request body.\"'),(5,'Multipart parser detected a possible unmatched boundary.','SecRuleRemoveByMsg \"Multipart parser detected a possible unmatched boundary.\"'),(6,'Content-Length HTTP header is not numeric.','SecRuleRemoveByMsg \"Content-Length HTTP header is not numeric.\"'),(7,'GET or HEAD Request with Body Content.','SecRuleRemoveByMsg \"GET or HEAD Request with Body Content.\"'),(8,'POST request missing Content-Length Header.','SecRuleRemoveByMsg \"POST request missing Content-Length Header.\"'),(9,'Invalid Use of Identity Encoding.','SecRuleRemoveByMsg \"Invalid Use of Identity Encoding.\"'),(10,'Expect Header Not Allowed for HTTP 1.0.','SecRuleRemoveByMsg \"Expect Header Not Allowed for HTTP 1.0.\"'),(11,'Request Missing a Host Header','SecRuleRemoveByMsg \"Request Missing a Host Header\"'),(12,'Empty Host Header','SecRuleRemoveByMsg \"Empty Host Header\"');
/*!40000 ALTER TABLE `tblmsg_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblremove_by_id`
--

DROP TABLE IF EXISTS `tblremove_by_id`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblremove_by_id` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idlist` int(11) NOT NULL,
  `stat` varchar(2) NOT NULL COMMENT 'A=Aktif, TA=Tak Aktif',
  `masa` time NOT NULL,
  `tarikh` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblremove_by_id`
--

LOCK TABLES `tblremove_by_id` WRITE;
/*!40000 ALTER TABLE `tblremove_by_id` DISABLE KEYS */;
INSERT INTO `tblremove_by_id` VALUES (1,900000,'A','00:00:00','0000-00-00'),(2,910006,'A','00:00:00','0000-00-00');
/*!40000 ALTER TABLE `tblremove_by_id` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblrule_list`
--

DROP TABLE IF EXISTS `tblrule_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblrule_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rules_id` int(11) NOT NULL,
  `rules_msg` text NOT NULL,
  `rules_tag` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblrule_list`
--

LOCK TABLES `tblrule_list` WRITE;
/*!40000 ALTER TABLE `tblrule_list` DISABLE KEYS */;
INSERT INTO `tblrule_list` VALUES (1,960911,'Invalid HTTP Request Line\r\n','OWASP_CRS/PROTOCOL_VIOLATION/INVALID_REQ\r\n'),(2,981227,'Apache Error: Invalid URI in Request.\r\n','OWASP_CRS/PROTOCOL_VIOLATION/INVALID_REQ\r\n'),(3,960000,'Attempted multipart/form-data bypass\r\n','OWASP_CRS/PROTOCOL_VIOLATION/INVALID_REQ\r\n'),(4,960912,'Failed to parse request body.\r\n','OWASP_CRS/PROTOCOL_VIOLATION/INVALID_REQ\r\n'),(5,960914,'\r\n','OWASP_CRS/PROTOCOL_VIOLATION/INVALID_REQ\r\n'),(6,960915,'Multipart parser detected a possible unmatched boundary.\r\n','OWASP_CRS/PROTOCOL_VIOLATION/INVALID_REQ\r\n'),(7,960016,'Content-Length HTTP header is not numeric.\r\n','OWASP_CRS/PROTOCOL_VIOLATION/INVALID_HREQ\r\n'),(8,960011,'GET or HEAD Request with Body Content.','OWASP_CRS/PROTOCOL_VIOLATION/INVALID_HREQ\r\n'),(9,960012,'POST request missing Content-Length Header.\r\n','OWASP_CRS/PROTOCOL_VIOLATION/INVALID_HREQ\r\n'),(10,960902,'Invalid Use of Identity Encoding.\r\n','OWASP_CRS/PROTOCOL_VIOLATION/INVALID_HREQ\r\n'),(11,960022,'Expect Header Not Allowed for HTTP 1.0.\r\n','OWASP_CRS/PROTOCOL_VIOLATION/INVALID_HREQ\r\n'),(12,960008,'Request Missing a Host Header\r\n','OWASP_CRS/PROTOCOL_VIOLATION/MISSING_HEADER_HOST\r\n'),(13,960007,'Empty Host Header\r\n','OWASP_CRS/PROTOCOL_VIOLATION/MISSING_HEADER_HOST\r\n'),(14,960015,'Request Missing an Accept Header\r\n','OWASP_CRS/PROTOCOL_VIOLATION/MISSING_HEADER_ACCEPT\r\n'),(15,960021,'Request Has an Empty Accept Header\r\n','OWASP_CRS/PROTOCOL_VIOLATION/MISSING_HEADER_ACCEPT\r\n'),(16,960009,'Request Missing a User Agent Header\r\n','OWASP_CRS/PROTOCOL_VIOLATION/MISSING_HEADER_UA\r\n'),(17,960006,'Empty User Agent Header\r\n','OWASP_CRS/PROTOCOL_VIOLATION/MISSING_HEADER_UA\r\n'),(18,960904,'Request Containing Content, but Missing Content-Type header\r\n','OWASP_CRS/PROTOCOL_VIOLATION/MISSING_HEADER_UA\r\n'),(19,960017,'Host header is a numeric IP address','OWASP_CRS/PROTOCOL_VIOLATION/IP_HOST\r\n'),(20,960209,'Argument name too long\r\n','OWASP_CRS/POLICY/SIZE_LIMIT\r\n');
/*!40000 ALTER TABLE `tblrule_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltag_added`
--

DROP TABLE IF EXISTS `tbltag_added`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbltag_added` (
  `id` int(11) NOT NULL,
  `tag` text NOT NULL,
  `codes` text NOT NULL,
  `status` varchar(5) NOT NULL DEFAULT 'TA' COMMENT 'TA=Tak Aktif A=Aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltag_added`
--

LOCK TABLES `tbltag_added` WRITE;
/*!40000 ALTER TABLE `tbltag_added` DISABLE KEYS */;
INSERT INTO `tbltag_added` VALUES (2,'OWASP_CRS/PROTOCOL_VIOLATION/INVALID_HREQ\r\n','SecRuleRemoveByTag \"OWASP_CRS/PROTOCOL_VIOLATION/INVALID_HREQ\"','A'),(8,'OWASP_CRS/POLICY/METHOD_NOT_ALLOWED\r\n','SecRuleRemoveByTag \"OWASP_CRS/POLICY/METHOD_NOT_ALLOWED\"','A');
/*!40000 ALTER TABLE `tbltag_added` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltag_list`
--

DROP TABLE IF EXISTS `tbltag_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbltag_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` text NOT NULL,
  `codes` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltag_list`
--

LOCK TABLES `tbltag_list` WRITE;
/*!40000 ALTER TABLE `tbltag_list` DISABLE KEYS */;
INSERT INTO `tbltag_list` VALUES (1,'OWASP_CRS/PROTOCOL_VIOLATION/INVALID_REQ\r\n','SecRuleRemoveByTag \"OWASP_CRS/PROTOCOL_VIOLATION/INVALID_REQ\"'),(2,'OWASP_CRS/PROTOCOL_VIOLATION/INVALID_HREQ\r\n','SecRuleRemoveByTag \"OWASP_CRS/PROTOCOL_VIOLATION/INVALID_HREQ\"'),(3,'OWASP_CRS/PROTOCOL_VIOLATION/MISSING_HEADER_HOST\r\n','SecRuleRemoveByTag \"OWASP_CRS/PROTOCOL_VIOLATION/MISSING_HEADER_HOST\"'),(4,'OWASP_CRS/PROTOCOL_VIOLATION/MISSING_HEADER_ACCEPT\r\n','SecRuleRemoveByTag \"OWASP_CRS/PROTOCOL_VIOLATION/MISSING_HEADER_ACCEPT\"'),(5,'OWASP_CRS/PROTOCOL_VIOLATION/MISSING_HEADER_UA\r\n','SecRuleRemoveByTag \"OWASP_CRS/PROTOCOL_VIOLATION/MISSING_HEADER_UA\"'),(6,'OWASP_CRS/PROTOCOL_VIOLATION/IP_HOST\r\n','SecRuleRemoveByTag \"OWASP_CRS/PROTOCOL_VIOLATION/IP_HOST\"'),(7,'OWASP_CRS/POLICY/SIZE_LIMIT\r\n','SecRuleRemoveByTag \"OWASP_CRS/POLICY/SIZE_LIMIT\"'),(8,'OWASP_CRS/POLICY/METHOD_NOT_ALLOWED\r\n','SecRuleRemoveByTag \"OWASP_CRS/POLICY/METHOD_NOT_ALLOWED\"'),(9,'OWASP_CRS/POLICY/ENCODING_NOT_ALLOWED\r\n','SecRuleRemoveByTag \"OWASP_CRS/POLICY/ENCODING_NOT_ALLOWED\"'),(10,'OWASP_CRS/POLICY/PROTOCOL_NOT_ALLOWED\r\n','SecRuleRemoveByTag \"OWASP_CRS/POLICY/PROTOCOL_NOT_ALLOWED\"'),(11,'OWASP_CRS/POLICY/EXT_RESTRICTED\r\n','SecRuleRemoveByTag \"OWASP_CRS/POLICY/EXT_RESTRICTED\"'),(12,'OWASP_CRS/POLICY/HEADER_RESTRICTED\r\n','SecRuleRemoveByTag \"OWASP_CRS/POLICY/HEADER_RESTRICTED\"');
/*!40000 ALTER TABLE `tbltag_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(150) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `key` varchar(200) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','1cb36f94bde548a539489edb39c634bf7a60270c',1,'6b41010ce620c06c1e51c5169cfea9de');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `waf_conf`
--

DROP TABLE IF EXISTS `waf_conf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `waf_conf` (
  `cID` int(5) NOT NULL AUTO_INCREMENT,
  `cName` varchar(100) NOT NULL DEFAULT '',
  `cDefault` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`cID`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `waf_conf`
--

LOCK TABLES `waf_conf` WRITE;
/*!40000 ALTER TABLE `waf_conf` DISABLE KEYS */;
INSERT INTO `waf_conf` VALUES (1,'SecRuleEngine','On'),(2,'SecRequestBodyAccess','On'),(3,'SecResponseBodyAccess','Off'),(4,'SecCookieFormat','zero'),(5,'SecArgumentSperator','&'),(6,'SecServerSignature','WeBekciServer/1.0'),(7,'SecChrootDir','/chroot/apache'),(8,'SecDataDir','/var/storedfile'),(9,'SecTmpDir','/tmp'),(10,'SecUploadKeepFiles','On'),(11,'SecUploadDir','/tmp'),(12,'SecDebugLog','/var/log/modsec_debug.log'),(13,'SecDebugLogLevel','zero'),(14,'SecGuardianLog','/var/log/modsec_guardian.log'),(15,'SecAuditEngine','On'),(16,'SecAuditLogRelevantStatus','^[45]'),(17,'SecAuditLogParts',',A,B,C,D,E,F,G,I,Z'),(18,'SecAuditLogType','Serial'),(19,'SecAuditLog','/var/log/modsec_audit.log'),(20,'SecAuditLogStorageDir','/usr/local/www/apache22/modseclog '),(21,'SecRequestBodyLimit','131072'),(22,'SecRequestBodyInMemoryLimit','131072'),(23,'SecResponseBodyLimit','131072'),(24,'SecResponseBodyMimeType','3'),(25,'SecResponseBodyMimeTypesClear','Off'),(26,'SecAction',''),(27,'SecRule',''),(28,'SecRuleInheritance',''),(29,'SecRuleRemoveById',''),(30,'SecRuleRemoveByMsg',''),(31,'SecWebAppId',''),(32,'SecDefaultAction','log,deny,status:403,t:lowercase,t:replaceNulls,t:compressWhitespace');
/*!40000 ALTER TABLE `waf_conf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `whitelist`
--

DROP TABLE IF EXISTS `whitelist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `whitelist` (
  `wid` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `url_pattern` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `jenis` int(11) NOT NULL COMMENT 'jenis sama ada domain atau ip',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`wid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `whitelist`
--

LOCK TABLES `whitelist` WRITE;
/*!40000 ALTER TABLE `whitelist` DISABLE KEYS */;
INSERT INTO `whitelist` VALUES (3,0,'sa.com',0,0,'2016-11-20 14:32:57'),(5,0,'90.87.89.9',0,1,'2016-11-20 14:34:30');
/*!40000 ALTER TABLE `whitelist` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-21  1:45:53
