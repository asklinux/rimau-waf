<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Panel extends CI_Controller {
	
	function __construct() {
        parent::__construct();
		$this->load->helper('url');
 		
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
				
			//$this->load->view('block');	
			
			//header("Refresh:0");
			
		}
		else{
			redirect('../../','refresh');
		} 
    }
	
   
	
	function index(){
			
		//if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			
			$uptimem = exec('uptime');
			$uptimem = explode(",",$uptimem);
			$uptime  = $uptimem[0];
			$data_f['uptime'] = $uptime;
		
				
			$this->load->view('panel/header');
			$this->load->view('panel/main');
			$this->load->view('footer',$data_f);
		//}
		//else{
		//redirect('/', 'refresh');
		//}
		
	}
	function utama(){

			$this->load->view('panel/model/utama');

	}
	function live_cpu(){
		
			$data['statusx'] = $this->datasistem->status_mod();	
			$data['cpu_avg'] = sys_getloadavg();
			
			$stat1 = $this->datasistem->GetCoreInformation();
			sleep(1);
			$stat2 = $this->datasistem->GetCoreInformation();
			$data['cpu'] = $this->datasistem->GetCpuPercentages($stat1, $stat2);
			
			$this->load->view('panel/model/live_cpu',$data);
	}
	public function rules()
	{
		$dir='/etc/httpd/modsecurity.d/activated_rules';
		$files=array_diff(scandir($dir),Array(".",".."));
		$data['activatedRules']=preg_grep("/^(.+)\.conf$/", $files);
	
		$dir='/usr/lib/modsecurity.d/base_rules';
		$files=array_diff(scandir($dir),Array(".",".."));
		$data['baseRules']=preg_grep("/^(.+)\.conf$/", $files);
		
		$dir='/usr/lib/modsecurity.d/experimental_rules';
		$files=array_diff(scandir($dir),Array(".",".."));
		$data['experimentalRules']=preg_grep("/^(.+)\.conf$/", $files);
		
		$dir='/etc/httpd/modsecurity.d';
		$files=array_diff(scandir($dir),Array(".",".."));
		$data['anomalyProtocol']=preg_grep("/^(.+)\.conf$/", $files);
	
		$dir='/usr/lib/modsecurity.d/rimau_rules';
		$files=array_diff(scandir($dir),Array(".",".."));
		$data['rimauRules']=preg_grep("/^(.+)\.conf$/", $files);
                
                $dir='/usr/lib/modsecurity.d/comodo';
		$files=array_diff(scandir($dir),Array(".",".."));
		$data['comodoRules']=preg_grep("/^(.+)\.conf$/", $files);
	
		$data['mytab'] = $this->input->post('stab');
	
		$this->load->view('panel/model/base_rules',$data);
		
	}
	public function actif_rules(){
		echo $this->datasistem->rules_act($this->input->post('id'),$this->input->post('fail'),$this->input->post('ack'));
		$this->datasistem->reload();
	}
	public function reload(){
			
		echo $this->datasistem->reload();
		
	}
	public function check(){
			
		echo $this->datasistem->chkconfig();
		
	}
	public function config(){
		$data['statusx'] = $this->datasistem->status_mod();	
		
		$this->load->view('panel/model/config',$data);
	}
	public function web_server(){
			
		$data['list'] = $this->datasistem->listdata(null,'server',null,null)->result();
		$this->load->view('panel/model/web_server',$data);
		
	}
	public function crules(){
		$data['ruleslist'] = $this->datasistem->listdata(null,'tblrule_list',null,null)->result();
		
		$stat = array(
			'status' => 'A'
		);
		$data['ruleslist_a'] = $this->datasistem->listdata($stat,'tblid_added',null,null)->result();
		$data['ruleslist_a2'] = $this->datasistem->listdata($stat,'tblmsg_added',null,null)->result();
		$data['ruleslist_a3'] = $this->datasistem->listdata($stat,'tbltag_added',null,null)->result();
		
		$data['ruleslist_b'] = $this->datasistem->listdata(null,'tblid_added',null,null)->result();
		$data['ruleslist_b2'] = $this->datasistem->listdata(null,'tblmsg_added',null,null)->result();
		$data['ruleslist_b3'] = $this->datasistem->listdata(null,'tbltag_added',null,null)->result();
		
		$data['ruleslist_c'] = $this->datasistem->listdata(null,'tblid_list',null,null)->result();
		$data['ruleslist_c2'] = $this->datasistem->listdata(null,'tblmsg_list',null,null)->result();
		$data['ruleslist_c3'] = $this->datasistem->listdata(null,'tbltag_list',null,null)->result();
		
		
		$this->load->view('panel/model/crules',$data);
	}
	public function white(){
			
		$arr_ip = array(
			'jenis' => 1
		);
		
		$arr_url = array(
			'jenis' => 0
		);
		
		$data['whitelist'] = $this->datasistem->listdata(null,'whitelist',null,null)->result();
		$data['whitelist_ip'] = $this->datasistem->listdata($arr_ip,'whitelist',null,null)->result();
		$data['whitelist_url'] = $this->datasistem->listdata($arr_url,'whitelist',null,null)->result();
		
		$this->load->view('panel/model/white',$data);
	}
	public function black(){
		
		$arr_ip = array(
			'jenis' => 1
		);
		
		$arr_url = array(
			'jenis' => 0
		);
		
		$data['blacklist'] = $this->datasistem->listdata(null,'blacklist',null,null)->result();
		$data['blacklist_ip'] = $this->datasistem->listdata($arr_ip,'blacklist',null,null)->result();
		$data['blacklist_url'] = $this->datasistem->listdata($arr_url,'blacklist',null,null)->result();
		
		$this->load->view('panel/model/black',$data);
	}
	public function exclude(){
		$this->load->view('panel/model/exclude');
	}
	public function mlog(){
		
		$this->load->view('panel/model/log');
		
	}
	public function load_log(){
		
		$this->load->helper('file');
		$log = shell_exec('sudo tail -n 20 /var/log/httpd/error_log');
		echo $log;
	}
	public function about(){
		$this->load->view('panel/model/about');
	}
	public function conf_change(){
		//echo $this->input->post('mod');	
		echo $this->datasistem->change_mode($this->input->post('mod'));
		$this->datasistem->reload();
	}
	public function changepass(){
		$this->load->view('panel/password');
	}
	public function addserver(){
		
		$simpan = array(
			'hosts' => $this->input->post('host'),
			'port' => $this->input->post('port'),
			'description' => $this->input->post('maklumat'),
			'SSLCertificateFile' => $this->input->post('SSLCertificateFile'),
			'SSLEngine' =>$this->input->post('SSLEngine')
		);
		
		echo $this->datasistem->save($simpan,'server');
		
		
		
		echo $this->datasistem->write_server();
		
	}
	function padamserver(){
		$data = array(
			'id' => $this->input->post('id')
		);	
		$this->datasistem->remove($data,'server');
		echo $this->datasistem->write_server();
		
	}
	function editserver(){
		
		$data = array(
			'id' => $this->input->post('id')
		);	
		
		$maklumat['server'] = $this->datasistem->listdata($data,'server',null,null)->result_array();
		
		
		$this->load->view('panel/model/edit_server',$maklumat);
		
	}
	function editserversimpan(){
		
		$simpan = array(
			'hosts' => $this->input->post('host'),
			'port' => $this->input->post('port'),
			'description' => $this->input->post('maklumat'),
			'SSLCertificateFile' => $this->input->post('SSLCertificateFile'),
			'SSLEngine' =>$this->input->post('SSLEngine')
		);
		$this->datasistem->edit($this->input->post('id'),'id',$simpan,'server');
		echo $this->datasistem->write_server();
	}
	public function ubahpassword(){
		
		if($this->datasistem->check_login($_SESSION['user_id'],$this->input->post('old'))){
			 
			$simpan = array(
				'password' => sha1($this->input->post('new'))
			);
			
			$this->datasistem->edit($_SESSION['user_id'],'username',$simpan,'user');
			
		}
		else {
			echo 'hoi';
			//echo $_SESSION['user_id'];
		}
		
	}
	function padamrules(){
		
		if ($this->input->post('jenis') == 1){	
			$data = array(
				'bid' => $this->input->post('id')
			);	
			$this->datasistem->remove($data,'blacklist');
						
			echo $this->datasistem->write_blacklist();
		}
		
		else if ($this->input->post('jenis') == 2){	
			$data = array(
				'wid' => $this->input->post('id')
			);	
			$this->datasistem->remove($data,'whitelist');
						
			echo $this->datasistem->write_whitelist();
		}
	}
	function editrules(){
		
		
		if ($this->input->post('jenis') == 1){
			
			$data = array(
				'bid' => $this->input->post('id')
			);	
			$maklumat['rules'] = $this->datasistem->listdata($data,'blacklist',null,null)->result_array();
			$this->load->view('panel/model/edit_rules_black',$maklumat);
			
		}
		else if ($this->input->post('jenis') == 2){
			
			$data = array(
				'wid' => $this->input->post('id')
			);	
			
			$maklumat['rules'] = $this->datasistem->listdata($data,'whitelist',null,null)->result_array();
			
			$this->load->view('panel/model/edit_rules_white',$maklumat);
		}

	}
	function editrulessimpan(){
		
		if ($this->input->post('jenis') == 1){
				
			$simpan = array(
				'url_pattern' => $this->input->post('host')
			);	
			$this->datasistem->edit($this->input->post('id'),'bid',$simpan,'blacklist');
			echo $this->datasistem->write_blacklist();
		}
		
		else if ($this->input->post('jenis') == 2){
				
			$simpan = array(
				'url_pattern' => $this->input->post('host')
			);
			$this->datasistem->edit($this->input->post('id'),'wid',$simpan,'whitelist');
			echo $this->datasistem->write_whitelist();
		}
		
	}
	function tools(){
		$this->load->view('panel/tools');
	}
	function ntopng(){
		
		$jenis = $this->input->post('jenis');
		
		if($jenis == 1){
			//on
			echo $this->datasistem->ntopng_start();
			
		}
		else if($jenis == 0){
			//off
			echo $this->datasistem->ntopng_stop();
		}
		else {
			//get status
			echo $this->datasistem->ntopng_status();
		}
		
	}
        function disablerules(){
            
		
		$data['listid'] = $this->datasistem->listdata(null,'tblid_added',null,null)->result();
	
		
		$this->load->view('panel/model/disable',$data);
        }
        function ownrules(){
            
        }
        function rulesfail(){
            
                $id = $this->input->post('id');
                
                if($id == "a") { 
			$targetpathbase='/usr/lib/modsecurity.d/base_rules/';
		} 
		
		if($id == "b") {
			$targetpathexp='/usr/lib/modsecurity.d/experimental_rules/';
		} 

		if($id == "c") {
			$targetpathbase='/usr/lib/modsecurity.d/base_rules/';
			

		}
		if($id == "d") {
			$targetpathbase='/usr/lib/modsecurity.d/rimau_rules/';
		

		}
                if($id == "e") {
			$targetpathbase='/usr/lib/modsecurity.d/comodo/';
		

		}  
                
            echo "<pre>";
            echo file_get_contents($targetpathbase . basename($this->input->post('file')) );
            echo "</pre>";
            
        }

}
	
