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
	function rules_act($id,$fail,$ack){
		
		if($id == "a") { 
			$targetpathbase='/usr/lib/modsecurity.d/base_rules/';
			$target=$targetpathbase.$fail;
		} 
		
		if($id == "b") {
			$targetpathexp='/usr/lib/modsecurity.d/experimental_rules/';
			 $target=$targetpathexp.$fail;
		} 

		if($id == "c") {
			$targetpathbase='/usr/lib/modsecurity.d/base_rules/';
			$targetpathanom='/etc/httpd/modsecurity.d/';
			$target=$targetpathanom.$fail;

		}
		if($id == "d") {
			$targetpathbase='/usr/lib/modsecurity.d/rimau_rules/';
			$targetpathanom='/etc/httpd/modsecurity.d/';
			$target=$targetpathbase.$fail;

		}
                if($id == "e") {
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
		if ( !write_file('/lib/modsecurity.d/mampu_rules/modsecurity_crs_10_whitelist.conf', $data)){
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
		}
		  foreach ( $list as $item) {
				$publicPort=$item->port;
				$publicDomain=$item->hosts;
				$serverUrl= $item->description;
				
				$content="<VirtualHost *:*>
ProxyRequests Off
<Proxy *>
	Order deny,allow
	Allow from all
</Proxy>
<Location />
	ProxyPass  $serverUrl
	ProxyPassReverse  $serverUrl
</Location>
	ServerName $publicDomain
	ServerSignature Off
</VirtualHost>\n\n";
				$contentHostFile.=$content;

                        }
			
			if ( !write_file('/etc/httpd/conf.d/host.conf', $contentHostFile)){
		    return 'Unable to write the file';
		    }
	}
	function write_blacklist(){
		
		$this->load->helper('file');	
		$data = '#Black Rules mampu dari database'."\n";
		
		$getw = $this->datasistem->listdata(null,'blacklist',null,null)->result();
	
		foreach ($getw as $w) {
			$gid = 20000+$w->bid;
			$data .= 'SecRule REMOTE_ADDR "^'.$w->url_pattern.'$" phase:1,log,deny,ctl:ruleEngine=Off,id:'.$gid."\n";
		}
		 
		if ( !write_file('/lib/modsecurity.d/mampu_rules/modsecurity_crs_10_blacklist.conf', $data)){
		     return 'Unable to write the file';
		}
	}
	function write_whitelist(){
			
		$this->load->helper('file');
		
		$data = '#White Rules mampu dari database'."\n";
		
		$getw = $this->datasistem->listdata(null,'whitelist',null,null)->result();
	
		foreach ($getw as $w) {
			$gid = 10000+$w->wid;
			$data .= 'SecRule REMOTE_ADDR "^'.$w->url_pattern.'$" phase:1,log,allow,ctl:ruleEngine=Off,id:'.$gid."\n";
		}
		 
		if ( !write_file('/lib/modsecurity.d/mampu_rules/modsecurity_crs_10_whitelist.conf', $data)){
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

}
