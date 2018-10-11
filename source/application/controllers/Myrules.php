<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Myrules extends CI_Controller {
	
	function __construct() {
        parent::__construct();
		$this->load->helper('url');
 		
		if ((!isset($_SESSION['logged_in']) && !$_SESSION['logged_in'] == true)) {

			redirect('../../','refresh');
		}

    }
	
	function blacklist(){
			
		$simpan = array(
			'url_pattern' => $this->input->post('url'),
			'jenis' => $this->input->post('jenis')
		);
		
		$this->datasistem->save($simpan,'blacklist');
		
		echo $this->datasistem->write_blacklist();
	}
	function whitelist(){
		
		$simpan = array(
			'url_pattern' => $this->input->post('url'),
			'jenis' => $this->input->post('jenis')
		);
		
		echo $this->datasistem->save($simpan,'whitelist');
		
		
		$this->datasistem->write_whitelist();
		
	}
	function disable(){
		
		$simpan = array(
			'rules_id' => $this->input->post('url'),
			'codes' => 'SecRuleRemoveByID '.$this->input->post('url'),
			'status' => $this->input->post('status')
		);
		
		echo $this->datasistem->save($simpan,'tblid_added');
		
		
		$this->datasistem->write_disablelist();
		
	}
	function addrules(){
		$jenis = $this->input->post('type');	
		if ($jenis == 1) {
				
			//disable rules
			
			$simpan = array(
			'rules' => $this->input->post('url'),
			'serverid' => $this->input->post('id')
			);
			
			echo $this->datasistem->save($simpan,'vrules_disable');
		}
		if ($jenis == 2) {
			//black list ip/host
			$simpan = array(
			'rules' => $this->input->post('url'),
			'serverid' => $this->input->post('id')
			);
			
			
			echo $this->datasistem->save($simpan,'vrules_black');
			
		}
		if ($jenis == 3) {
			//white list ip/hosts
			$simpan = array(
			'rules' => $this->input->post('url'),
			'serverid' => $this->input->post('id')
			);
			
			
			echo $this->datasistem->save($simpan,'vrules_white');
		}
		echo $this->datasistem->write_server();
	}
	function padamrules(){
		$jenis = $this->input->post('type');	
		if ($jenis == 1) {
				
			//disable rules

			$padam = array(
				'vrulesd_id' => $this->input->post('id')
			);
			echo $this->datasistem->remove($padam,'vrules_disable');
		}
		if ($jenis == 2) {
			//black list ip/host
			$padam = array(
				'vrulesb_id' => $this->input->post('id')
			);
			
			
			echo $this->datasistem->remove($padam,'vrules_black');
			
		}
		if ($jenis == 3) {
			//white list ip/hosts
			$padam = array(
				'vrulesw_id' => $this->input->post('id')
			);
			
			
			echo $this->datasistem->remove($padam,'vrules_white');
		}
		echo $this->datasistem->write_server();
	}
	function editvrules(){
		$jenis = $this->input->post('type');	
		if ($jenis == 1) {
				
			//disable rules

			$data = array(
				'rules' => $this->input->post('rules')
			);
			$this->datasistem->edit($this->input->post('id'),'vrulesd_id',$data,'vrules_disable');
			//echo $this->datasistem->remove($padam,'vrules_disable');
		}
		if ($jenis == 2) {
			//black list ip/host
			$data = array(
				'rules' => $this->input->post('rules')
			);
			$this->datasistem->edit($this->input->post('id'),'vrulesb_id',$data,'vrules_black');
			
			//echo $this->datasistem->remove($padam,'vrules_black');
			
		}
		if ($jenis == 3) {
			//white list ip/hosts
			$data = array(
				'rules' => $this->input->post('rules')
			);
			
			$this->datasistem->edit($this->input->post('id'),'vrulesw_id',$data,'vrules_white');
			//echo $this->datasistem->remove($padam,'vrules_white');
		}
		echo $this->datasistem->write_server();
	}
	function create_white(){
			
		echo $this->datasistem->write_whitelist();
	}
	function create_black(){
			
		echo $this->datasistem->write_blacklist();
	}
	function create_crule(){
			
		$this->load->helper('file');
		
		$data = 'SecRule REMOTE_ADDR "^192\.168\.50\.1$" phase:1,log,allow,ctl:ruleEngine=Off,id:5'."\n";
		//$data .= 'SecRule REMOTE_ADDR "^192\.168\.50\.1$" phase:1,log,allow,ctl:ruleEngine=Off,id:999945';
		
		if ( !write_file('/lib/modsecurity.d/mampu_rules/modsecurity_crs_10_crulelist.conf', $data)){
		     echo 'Unable to write the file';
		}
	}
	function ownlist(){
		
		$simpan = array(
			'name' => $this->input->post('name'),
			'rules' => $this->input->post('rules')
		);
		
		echo $this->datasistem->save($simpan,'ownrules');
		
		
		$this->datasistem->write_ownlist();
		
	}
	function domainrules(){
		
		
			
		$data = array(
			'rules' => $this->input->post('rules'),
			'serverid' => $this->input->post('id')
		);
		
		
		$filter = array(
					  'rules' => $this->input->post('rules'),
					  'serverid' => $this->input->post('id')
		);
		$check = $disabler = $this->datasistem->listdata($filter,'vrules',null,null)->result();	
		
		
		if (count($check) == null){	
			$this->datasistem->save($data,'vrules');
			echo $this->datasistem->write_server();
		}
		else{
			if ($this->input->post('status') == 1){
				$this->datasistem->remove($data,'vrules');
			}
			else { 
				echo "found";
			}
		} 
	}
}
	
	
	
	