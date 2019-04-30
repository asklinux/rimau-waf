<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datasistem extends CI_Model {

	
	function listall($table=null,$limit=null,$offset=null){
					
		return $this->db->get($table,$data,$limit,$offset);
		
	}
	
	function listdata($data=null,$table=null,$limit=null,$offset=null){
					
		return $this->db->get_where($table,$data,$limit,$offset);
		
	}
	function save($data=null,$table=null){
			
		$this->db->insert($table,$data);
		
		return $this->db->insert_id();
	}
	function edit($id=null,$id_name=null,$data=null,$table=null){
		
		$this->db->where($id_name,$id);
			
		return $this->db->update($table,$data);
		
	}
	function remove($data=null,$table=null){
		
		//$this->db->where($id_nama,$id);		
		return $this->db->delete($table,$data);
		
	}
	function check_login($id,$pass){
		
		$this->db->where('username',$id);
		$this->db->where('password',sha1($pass));
		
		return $this->db->get('user')->row();
	}
	function check_login_pam($id,$pass){
		
		if(pam_auth($id,$pass,$error) ) {

        return  "You are authenticated!";

		} else {
		
		        return $error;
		
		}
	}
	function rules_act($id,$fail,$ack){
		
		if($id == "a") {
			//dir for base rules 
			$targetpathbase='/usr/lib/modsecurity.d/base_rules/';
			$target=$targetpathbase.$fail;
		} 
		
		if($id == "b") {
			//dir for experimental rules
			$targetpathexp='/usr/lib/modsecurity.d/base_rulesv3/';
			 $target=$targetpathexp.$fail;
		} 

		if($id == "c") {
			//dir for anomaly rulse set
			$targetpathbase='/usr/lib/modsecurity.d/base_rules/';
			$targetpathanom='/etc/httpd/modsecurity.d/';
			$target=$targetpathanom.$fail;

		}
		if($id == "d") {
			//dir for user own rules
			$targetpathbase='/usr/lib/modsecurity.d/rimau_rules/';
			$targetpathanom='/etc/httpd/modsecurity.d/';
			$target=$targetpathbase.$fail;

		}
        if($id == "e") {
        	//dir for comodo rules
			$targetpathbase='/usr/lib/modsecurity.d/comodo/';
			$targetpathanom='/etc/httpd/modsecurity.d/';
			$target=$targetpathbase.$fail;

		}  
	
		
		
		$link='/etc/httpd/modsecurity.d/activated_rules/';
		
		if($ack == 1) {
			if($id=="a" | $id=="b") {

			return shell_exec("sudo /usr/bin/unlink $link/" . escapeshellarg($fail));
			} elseif($id=="c") {
			  return shell_exec("sudo /usr/bin/unlink $link/" . escapeshellarg($fail) . ";sudo /usr/bin/unlink $link/modsecurity_crs_21_protocol_anomalies.conf;sudo /usr/bin/unlink $link/modsecurity_crs_49_inbound_blocking.conf;sudo /usr/bin/unlink $link/modsecurity_crs_50_outbound.conf;sudo /usr/bin/unlink $link/modsecurity_crs_59_outbound_blocking.conf");
			}
			else {
			return shell_exec("sudo /usr/bin/unlink $link/" . escapeshellarg($fail) );	
			}
		}	
		if ($ack == 0){
			if($id=="a" | $id=="b") {

			return shell_exec("sudo ln -s " . escapeshellarg($target) . " $link/" . escapeshellarg($fail));
			} elseif($id=="c") {
			  
			  shell_exec("sudo ln -s $target $link/" . escapeshellarg($fail));
			  shell_exec("sudo ln -s $targetpathbase/modsecurity_crs_21_protocol_anomalies.conf $link/modsecurity_crs_21_protocol_anomalies.conf");	
			  shell_exec("sudo ln -s $targetpathbase/modsecurity_crs_49_inbound_blocking.conf $link/modsecurity_crs_49_inbound_blocking.conf");
			  shell_exec("sudo ln -s $targetpathbase/modsecurity_crs_50_outbound.conf $link/modsecurity_crs_50_outbound.conf");
			  shell_exec("sudo ln -s $targetpathbase/modsecurity_crs_59_outbound_blocking.conf $link/modsecurity_crs_59_outbound_blocking.conf");
			}
			else{

			return shell_exec("sudo ln -s " . escapeshellarg($target) . " $link/" . escapeshellarg($fail));
			}
		}
		
	}

	function reload(){
		
		return shell_exec('sudo /usr/bin/systemctl restart httpd 2>&1'  );
		
	}
	function chkconfig(){
			
		return $test = shell_exec('sudo /usr/sbin/apachectl configtest 2>&1');
		
		//shell_exec('sudo /usr/bin/systemctl reload httpd');
	}
	function change_mod($mode=null){
			
		$mode=isset($mode) ? $mode : "" ;
		
		if($mode=="DetectionOnly" ||$mode=="On" || $mode=="Off"){
			$modsecurityconfig= $this->config->item('modseccfg');
			$command="sudo /usr/bin/sed -i -e 's/[^#]\sSecRuleEngine \(DetectionOnly\|On\|Off\)/SecRuleEngine " . escapeshellarg($mode) . "/g' " . escapeshellarg($modsecurityconfig) . ";echo $?";
			$code=shell_exec($command);
		}
		if($code==0){
			return "Success";
		}
		else {
			return "Failure";
		}
	}
	function change_kibana($server){
		//sed -i '124 c\ host:test.com:5506' /etc/filebeat/filebeat.yml

		$cmd = "sudo /usr/bin/sed -i '124 c\ \"host: ".escapeshellarg($server)."\"' /etc/filebeat/filebeat.yml";

	}
	function get_kibana_host(){
		$cmd = "sudo /usr/bin/sed -n 124p  /etc/filebeat/filebeat.yml";
		$hasil = str_replace("\"","",shell_exec($cmd));
		return substr($hasil,5);
	}
	function get_es_host(){
		$cmd = "sudo /usr/bin/sed -n 146p  /etc/filebeat/filebeat.yml";
		$hasil = str_replace("\"","",shell_exec($cmd));
		return substr(str_replace(str_split('[]'),"",$hasil),8);
	}
	function enable_filebeat(){
		$cmd = "sudo /usr/bin/systemctl enable filebeat";
		$cmd2 = "sudo /usr/bin/systemctl start filebeat";
		shell_exec($cmd);
		shell_exec($cmd2);
	}
	function status_filebeat(){
		$cmd = "sudo /usr/bin/systemctl status filebeat | grep -e \"Active\"";
		return shell_exec($cmd);
	}
	function disable_filebeat(){
		$cmd = "sudo /usr/bin/systemctl disable filebeat";
		$cmd2 = "sudo /usr/bin/systemctl stop filebeat";
		shell_exec($cmd);
		shell_exec($cmd2);
	}
	function status_mod(){
			
		
		$modesecurityconfig = $this->config->item('modseccfg');
		$command='sudo /usr/bin/cat '.escapeshellarg($modesecurityconfig).' | /usr/bin/grep "[^#]\sSecRuleEngine\\s.\+[Off|On|DetectionOnly]$"';
		
		$output=shell_exec($command);
		$hasil = $output;
		return md5($hasil);
		//return md5('SecRuleEngine On');
		//$currentMode=explode(" ",$output);
		//return $hasil = str_replace(' ', '',$output);
		//return $currentMode;
		//return $currentMode[1];
	}

	function GetCoreInformation() {
	$data = file('/proc/stat');
	$cores = array();
	foreach( $data as $line ) {
		if( preg_match('/^cpu[0-9]/', $line) )
		{
			$info = explode(' ', $line );
			$cores[] = array(
				'user' => $info[1],
				'nice' => $info[2],
				'sys' => $info[3],
				'idle' => $info[4]
			);
		}
	}
	return $cores;
	}
	/* compares two information snapshots and returns the cpu percentage */
	function GetCpuPercentages($stat1, $stat2) {
		if( count($stat1) !== count($stat2) ) {
			return;
		}
		$cpus = array();
		for( $i = 0, $l = count($stat1); $i < $l; $i++) {
			$dif = array();
			$dif['user'] = $stat2[$i]['user'] - $stat1[$i]['user'];
			$dif['nice'] = $stat2[$i]['nice'] - $stat1[$i]['nice'];
			$dif['sys'] = $stat2[$i]['sys'] - $stat1[$i]['sys'];
			$dif['idle'] = $stat2[$i]['idle'] - $stat1[$i]['idle'];
			$total = array_sum($dif);
			$cpu = array();
			foreach($dif as $x=>$y) $cpu[$x] = round($y / $total * 100, 1);
			$cpus['cpu' . $i] = $cpu;
		}
		return $cpus;
	}
	function change_mode($mod = null){
			
		$mode=isset($mod) ? $mod : "" ;
		
		if($mode=="DetectionOnly" ||$mode=="On" || $mode=="Off") {
			
		$modsecurityconfig= $this->config->item('modseccfg'); 
		$command="sudo sed -i -e 's/^    SecRuleEngine \(DetectionOnly\|On\|Off\)/    SecRuleEngine ".escapeshellarg($mode)."/g' ".escapeshellarg($modsecurityconfig).";echo $?";
		$code=shell_exec($command);
		if($code==0)
			return "Success:".$code;
		else 
			//return "Failure:".$code;
			return $command;
		}
	}
	function write_rules($data){
			
		$this->load->helper('file');
		$data = 'SecRule REMOTE_ADDR "^192\.168\.50\.1$" phase:1,log,allow,ctl:ruleEngine=Off,id:999945\n';
		$data .= 'SecRule REMOTE_ADDR "^192\.168\.50\.1$" phase:1,log,allow,ctl:ruleEngine=Off,id:999945';
		if ( !write_file('/lib/modsecurity.d/rimau_rules/modsecurity_crs_70_whitelist.conf', $data)){
		     return 'Unable to write the file';
		}
	}
	function write_server(){
			
		$list = $this->datasistem->listdata(null,'server',null,null)->result();	
		$this->db->select('port');
 		$this->db->group_by('port'); 
		$listenports=$this->db->get('server')->result_array();
		$contentHostFile="";	
		foreach ( $listenports as $listenport) { 
			$openport=$listenport['port'];
			$contentHostFile.="#Listen ".$openport."\n";
			$contentHostFile.="#Ruler Create By Rimau Waf Panel"."\n";
		}
		  foreach ( $list as $item) {
					
				$publicPort=$item->port;
				$publicDomain=$item->hosts;
				$serverUrl= $item->description;
				if($item->modsec == ''){
					$modsstatus = 'Off';
				}
				else {
					$modsstatus = $item->modsec;
				}
				$modssl = $item->SSLEngine;
				$id = $item->id;
				
				$filter = array(
					  'serverid' => $id
				);
				
if ($item->lb == 1){
					
				$lbname = strstr($publicDomain,'.',true);
				$content='<VirtualHost *:'.$publicPort.'>'."\n\n";
				$content .= ' SecRuleEngine '.$modsstatus."\n\n";
				
				if ($modssl == "on") {
					//$content .= ' SSLCipherSuite EECDH+AESGCM:EDH+AESGCM:AES256+EECDH:AES256+EDH'."\n";
					$content .= ' SSLProtocol All -SSLv2 -SSLv3 -TLSv1 -TLSv1.1'."\n";
					$content .= ' SSLHonorCipherOrder On'."\n";
					$content .= ' SSLCertificateFile '.$item->SSLCertificateFile."\n";
					$content .= ' SSLCertificateKeyFile '.$item->SSLCertificateKeyFile."\n";
					$content .= ' SSLCertificateChainFile '.$item->SSLCertificateChainFile."\n";
				}
				
				$content .= ' Header set X-Content-Type-Options "nosniff"'."\n";
				$content .= ' RemoteIPHeader X-Forwarded-For'."\n\n";
				$content .= '<Proxy *>'."\n";
				$content .= '   AllowOverride All'."\n";
				$content .= '   Allow from all'."\n";
				$content .= '   SetEnv force-proxy-request-1.0 1'."\n";
				$content .= '   SetEnv proxy-nokeepalive 1'."\n";
				
				$content .= '</Proxy>'."\n\n";				
				$content .= '  ProxyPreserveHost On'."\n";
				$content .= '  ProxyRequests off'."\n\n";
					
				
				$vrules = $disabler = $this->datasistem->listdata($filter,'vrules',null,null)->result();
				$disabler = $this->datasistem->listdata($filter,'vrules_disable',null,null)->result();
				
				if (count($vrules) !== null){
					$content .= '  Include /etc/httpd/modsecurity.d/modsecurity_crs_10_config.conf'."\n";
					foreach ($vrules as $v) {
						$rurl = "/lib/modsecurity.d/base_rules/";
						$content .= '  IncludeOptional '.$rurl.$v->rules."\n";
					}
				}
				if (count($disabler) !== null){
					foreach ($disabler as $d) {
						$content .= '  SecRuleRemoveByID '.$d->rules."\n";
					}
				}
				
				$wrules = $this->datasistem->listdata($filter,'vrules_white',null,null)->result();
				
				if (count($wrules) !== null){
					foreach ($wrules as $w) {
						$gid = 40000+$w->vrulesw_id;
						$content .= '  SecRule REMOTE_ADDR "^'.$w->rules.'$" phase:1,log,deny,ctl:ruleEngine=Off,id:'.$gid."\n";
						
					}
				}
					
					$content .= "\n".'<Proxy balancer://'.$lbname.'>'."\n";
					$content .= '  BalancerMember http://'.$serverUrl.':'.$publicPort."\n";
					
					
				
					$lbhost = $this->listdata($filter,'host',null,null)->result();
					foreach ($lbhost as $l) {
						
						
					  $content.= '  BalancerMember http://'.$l->ip.':'.$l->port;
					  $content.= $l->loadfactor == 0 ? '':' loadfactor='.$l->loadfactor;
					  $content.= empty($l->timeout) ?'':' timeout='.$l->timeout;
					  $content.= $l->lblset == 0 ? '':' lbset='.$l->lblset;
					  $content.= empty($l->route) ? '':' route='.$l->route;
					  $content.= "\n";
						
					}	   
					$content.= '  ProxySet lbmethod='.$item->lbmethod."\n";
					$content .= '</Proxy>'."\n\n";
					
					$content .= '  ProxyPass / balancer://'.$lbname.'/'."\n";
					$content .= '  ProxyPassReverse /  balancer://'.$lbname.'/'."\n";
				
					$content .= '  ServerName '.$publicDomain."\n";
					$content .= '  ServerAlias www.'.$publicDomain."\n";
					$content .= '  ServerSignature off'."\n\n";
					$content .= '</VirtualHost>'."\n\n";
}
else {				
				$content='<VirtualHost *:'.$publicPort.'>'."\n\n";
				
				$content .= '  SecRuleEngine '.$modsstatus."\n\n";
				
				
				if ($modssl == "on") {
					//$content .= '  SSLCipherSuite EECDH+AESGCM:EDH+AESGCM:AES256+EECDH:AES256+EDH'."\n";
					$content .= '  SSLProtocol All -SSLv2 -SSLv3 -TLSv1 -TLSv1.1'."\n";
					$content .= '  SSLHonorCipherOrder On'."\n";
					$content .= '  SSLCertificateFile '.$item->SSLCertificateFile."\n";
					$content .= '  SSLCertificateKeyFile '.$item->SSLCertificateKeyFile."\n";
					$content .= '  SSLCertificateChainFile '.$item->SSLCertificateChainFile."\n";
				}
				$content .= '  Header set X-Content-Type-Options "nosniff"'."\n";
				$content .= '  RemoteIPHeader X-Forwarded-For'."\n\n";
				
				$vrules = $disabler = $this->datasistem->listdata($filter,'vrules',null,null)->result();
				$disabler = $this->listdata($filter,'vrules_disable',null,null)->result();
				
				if (count($vrules) !== null){
					$content .= '  Include /etc/httpd/modsecurity.d/modsecurity_crs_10_config.conf'."\n";
					foreach ($vrules as $v) {
						$rurl = "/lib/modsecurity.d/base_rules/";
						$content .= '  IncludeOptional '.$rurl.$v->rules."\n";
					}
				}
				
				if (count($disabler) !== null){
					foreach ($disabler as $d) {
						$content .= '  SecRuleRemoveByID '.$d->rules."\n";
					}
				}
				
				$wrules = $this->listdata($filter,'vrules_white',null,null)->result();
				
				if (count($wrules) !== null){
					foreach ($wrules as $w) {
						$gid = 40000+$w->vrulesw_id;
						$content .= '  SecRule REMOTE_ADDR "^'.$w->rules.'$" phase:1,log,deny,ctl:ruleEngine=Off,id:'.$gid."\n";
						
					}
				}
				
				$content .= "\n".'<Proxy *>'."\n";
				$content .= '  AllowOverride All'."\n";
				$content .= '  Allow from all'."\n";
				$content .= '  SetEnv force-proxy-request-1.0 1'."\n";
				$content .= '  SetEnv proxy-nokeepalive 1'."\n\n";
				
				$content .= '</Proxy>'."\n\n";				
				$content .= '  ProxyPreserveHost On'."\n";
				$content .= '  ProxyRequests off'."\n";
				$content .= '  ProxyPass / http://'.$serverUrl.'/'."\n";
				$content .= '  ProxyPassReverse /  http://'.$serverUrl.'/'."\n";
				
				$content .= '  ServerName '.$publicDomain."\n";
				$content .= '  ServerAlias www.'.$publicDomain."\n";
				$content .= '  ServerSignature off'."\n\n";
				$content .= '</VirtualHost>'."\n\n";
	}
				$contentHostFile.=$content;

}
			
			if ( !write_file('/etc/httpd/conf.d/host.conf', $contentHostFile)){
		    return 'Unable to write the file';
		    }
			return $contentHostFile;
	}
	function write_blacklist(){
		
		$this->load->helper('file');	
		$data = '#Black Rules mampu dari database'."\n";
		
		$getw = $this->datasistem->listdata(null,'blacklist',null,null)->result();
	
		foreach ($getw as $w) {
			$gid = 20000+$w->bid;
			$data .= 'SecRule REMOTE_ADDR "^'.$w->url_pattern.'$" phase:1,log,deny,ctl:ruleEngine=Off,id:'.$gid."\n";
		}
		 
		if ( !write_file('/lib/modsecurity.d/rimau_rules/modsecurity_crs_70_blacklist.conf', $data)){
		     return 'Unable to write the file';
		}
	}
	function write_whitelist(){
			
		$this->load->helper('file');
		
		$data = '#White Rules rimau dari database'."\n";
		
		$getw = $this->datasistem->listdata(null,'whitelist',null,null)->result();
	
		foreach ($getw as $w) {
			$gid = 10000+$w->wid;
			$data .= 'SecRule REMOTE_ADDR "^'.$w->url_pattern.'$" phase:1,log,allow,ctl:ruleEngine=Off,id:'.$gid."\n";
		}
		 
		if ( !write_file('/lib/modsecurity.d/rimau_rules/modsecurity_crs_70_whitelist.conf', $data)){
		     return 'Unable to write the file';
		}
	}
	
	function write_disablelist(){
			
		$this->load->helper('file');
		
		$data = '#White Rules rimau dari database'."\n";
		
		$getw = $this->datasistem->listdata(null,'tblid_added',null,null)->result();
		
		foreach ($getw as $w) {
			//$gid = 10000+$w->wid;
			//$data .= 'SecRule REMOTE_ADDR "^'.$w->url_pattern.'$" phase:1,log,allow,ctl:ruleEngine=Off,id:'.$gid."\n";
			$data .= $w->codes."\n";
		}
		 
		if ( !write_file('/lib/modsecurity.d/rimau_rules/modsecurity_crs_70_disable_rules.conf', $data)){
		     return 'Unable to write the file';
		}
	}
	function write_crules($update){
		
		
			
		$query1 = $this->datasistem->listdata($update,'tblid_added',null,null)->result();
		
		
	    $loadcontent = "/lib/modsecurity.d/mampu_rules/modsecurity_crs_80_custom_rules.conf";
	    
	    $fp = @fopen($loadcontent, "w+");
	
		foreach ($query1 as $q ) {
			$code = $q->codes;
				if ($fp) {
		            fwrite($fp, $codes."\n");	
				}
		}
	}
	function ntopng_start(){
		
		shell_exec('sudo /usr/bin/systemctl start redis'  );
		return shell_exec('sudo /usr/bin/systemctl start ntopng'  );
		
	}
	function ntopng_stop(){
		
		shell_exec('sudo /usr/bin/systemctl stop redis'  );
		return shell_exec('sudo /usr/bin/systemctl stop ntopng'  );
		
	}
	function ntopng_status(){
		
		//shell_exec('sudo /usr/bin/systemctl stop redis 2>&1'  );
		return shell_exec('sudo /usr/bin/systemctl status ntopng 2>&1'  );
		
	}
	function parse_block($block){
			
		//preg_match_all("/^--([0-9a-fA-F]{8,})-([Z])--$/", $line);
		preg_match("/((?:(?:[0-2]?\\d{1})|(?:[3][01]{1}))[-:\\/.](?:Jan(?:uary)?|Feb(?:ruary)?|Mar(?:ch)?|Apr(?:il)?|May|Jun(?:e)?|Jul(?:y)?|Aug(?:ust)?|Sep(?:tember)?|Sept|Oct(?:ober)?|Nov(?:ember)?|Dec(?:ember)?)[-:\\/.](?:(?:[1]{1}\\d{1}\\d{1}\\d{1})|(?:[2]{1}\\d{3})))(?![\\d])/",$block,$matches); // Date
		$date=$matches[0];
		preg_match("/[0-9]{2}:[0-9]{2}:[0-9]{2}\s/",$block,$matches); // Time
		$time=$matches[0];
		preg_match("/([a-zA-Z]{2}\s)([0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3})\s([0-9]*)\s([0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3})\s([0-9]*)/",$block,$matches); // IP's & Port's
		$source_ip=$matches[2];
		$source_port=$matches[3];
		$dest_ip=$matches[4];
		$dest_port=$matches[5];
		//preg_match("/\s(GET)(.*)(\sHost)/",$block,$matches); // GET Header Address
		//$get_address=$matches[2];
		preg_match("/\s(User-Agent:\s)(.*)(\sAccept:)/",$block,$matches); // User Agent
		//$user_agent=$matches[2];
		//preg_match("/\s\[(tag\s\")(.*)(\"])\s/",$block,$matches); // message Tags(Attack Type)
		//$message_tags=$matches;
		preg_match("/(\[msg)(.*?)(\"\])/",$block,$matches); //  message
		$message=$matches[2];
		preg_match("/(-H--\sMessage:\s)(.*)(]\s)/",$block,$matches); // detailed message
		$detailed_message=$matches[2];
		
		//("Date:".$date."<br>Time:".$time."<br>Attacker IP:".$attacker_ip."<br>Attacker Port:".$attacker_port."<br>Server IP:".$server_ip."<br>server port:".$server_port."<br>GET Adress:".$get_address."<br>User Agent:".$user_agent."<br>Message:".$message."<br>Detailed Message:".$detailed_message."<br><br><br>");
		
		//$ua=useragent_parser($user_agent);// parsing user agent for browser & os
		//$browser=$ua['name'];//browser
		//$os=$ua['platform'];//os 
		//mysql_query("insert into log (`date`,`time`,`source_ip`,`source_port`,`dest_ip`,`dest_port`,`get_adr`,`os`,`browser`,`message`,`detailed_message`)values('$date','$time','$source_ip','$source_port','$dest_ip','$dest_port','$get_address','$os','$browser','$message','$detailed_message')");
		
		
		
		$data  = array(
		 
		'date' 				=> $date,
		'time' 				=> $time,
		'source_ip'	 		=> $source_ip,
		'source_port'		=> $source_port,
		'dest_ip' 			=> $dest_ip,
		'dest_port' 		=> $dest_port,
		//'get_address' 		=> $get_address,
		//'os' 				=> $os,
		//'browser' 			=> $browser,
		'message' 			=> $message,
		'detailed_message' 	=> $detailed_message
		);
		
		return $data;
	
		 //echo  $source_ip;
	}
	function write_ownlist(){
			
		$this->load->helper('file');
		
		$data = '#own Rules rimau dari database'."\n";
		
		$getw = $this->datasistem->listdata(null,'ownrules',null,null)->result();
	
		foreach ($getw as $w) {
			//$gid = 30000+$w->wid;
			$data .= $w->rules.PHP_EOL.PHP_EOL;
		}
		 
		if ( !write_file('/lib/modsecurity.d/rimau_rules/modsecurity_crs_10_own_rules.conf', $data)){
		     return 'Unable to write the file';
		}
	}
	function adomainrules($serverid){
		
		$this->db->select('rules');
		$this->db->where('serverid',$serverid);
		$rulesa = $this->db->get('vrules')->result();
		
		$p = array();
		foreach ($rulesa as $r) {
			$p[] = $r->rules;
		}
	
		
		return $p;
	}

}
