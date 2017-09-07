<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Myrules extends CI_Controller {
	
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
	function pro_secruleremovebyid(){		
		//rules id
		$rules_id = $this->input->post('id');
		
		$data = array(
			
			'rules_id' => $rules_id
		
		);
		
		$ru = $this->datasistem->listdata($data,'tblid_list',null,null)->row();
			
		
		$id = $ru->id;
		$rules_id = $ru->rules_id;
		$codes = $ru->codes;
		
		$id = htmlspecialchars($ru->id,ENT_QUOTES);
		$rules_id = htmlspecialchars($ru->rules_id,ENT_QUOTES);
		
			if (isset($rules_id)){
			
			$simpan = array(
				'id' => $id,
				'rules_id' => $rules_id,
				'codes' => $codes
			);
			
			echo $this->datasistem->save($simpan,'tblid_added');
		}
		
		
	}
	function pro_secruleremovebyidactivate(){
		
		//ambil data dari butang kemaskini
		$id = $this->input->post('id');
	
		//simpan data dalam table tblid_added
		//$query = "update tblid_added set status ='A' where id = '$id'";
		
		$update = array(
			'status' => 'A'
		);
		
		$this->datasistem->edit($id,'id',$update,'tblid_added');
		
		$update = array(
			'status' => 'A'
		);
			
		
		$this->datasistem->write_crules($update);
		
	}
	function pro_secruleremovebyiddelete(){
		
		$id =  $this->input->post('id');

		//delete data dalam table tblid_added
		$padam = array(
			'id' => $id
		);
		$this->datasistem->remove($padam ,'tblid_added');
			
		}
	function pro_secruleremovebyidremove(){

		$id = $this->input->post('id');

		//deactivate data dalam table tblid_added
		
		$update = array(
			'status' => 'TA'
		);
		
		$this->datasistem->edit($id,'id',$update,'tblid_added');
				
		$this->datasistem->write_crules($update);
		
	}
	function pro_secruleremovebymsg(){
			
		echo $this->input->post('id');
		
		$msg = $this->input->post('id');
	
	
		$data = array(
			'msg' => $msg
		);
		
		$qr = $this->datasistem->listdata($data,'tblmsg_list',null,null)->result();
		
		while($row = mysql_fetch_array($comments, MYSQL_ASSOC))
		foreach ($qr as $q) 
		{
	        $id = $q->id;
			$msg = $q->msg;
			$codes = $q->codes;
			
			$id = htmlspecialchars($q->id,ENT_QUOTES);
			
			$simpan = array(
				'id' => $id,
				'msg' => $msg,
				'codes' => $codes
			);
			
			$this->datasistem->save($simpan,'tblmsg_added');
			
		}
		
	}
	function pro_secruleremovebymsgactivate(){
			
		echo $this->input->post('id');
		$id = $this->input->post('id');

		//simpan data dalam table tblmsg_added		
		$simpan = array(
			'status' => 'A'
		);
		
		$this->datasistem->edit($id,'id',$simpan,'tblmsg_added');
	
	    $update = array(
			'status' => 'A'
		);
			
		
		$this->datasistem->write_crules($update);
		
	}
	function pro_secruleremovebymsgdelete(){
	
		$id = $this->input->post('id');
	
		//delete data dalam table tblmsg_added
		$padam = array(
			'id' => $id
		);
		
		$this->datasistem->remove('tblmsg_added',$padam);
		
		
	}
	function pro_secruleremovebymsgremove(){
			
		$id = $this->input->post('id');

		//deactivate data dalam table tblmsg_added		
		$simpan = array(
			'status' => 'TA'
		);
		
		$this->datasistem->edit($id,'id',$simpan,'tblmsg_added');
		
		$update = array(
			'status' => 'A'
		);
			
		
		$this->datasistem->write_crules($update);
			
		
	}
	function pro_secruleremovebytag(){
			
		
		$tag = $this->input->post('id');
	

		
		$data = array(
			'id' => $tag
		);
		
		$cr = $this->datasistem->listdata($data,'tbltag_list',null,null)->result();
		
		foreach ($cr as $c) 
		
		{
	        $id = $c->id;
			$tag = $c->tag;
			$codes = $c->codes;
			
			$id = htmlspecialchars($c->id,ENT_QUOTES);
		
			$simpan = array(
				'id' => $id,
				'tag' => $tag,
				'codes' => $codes
			);
			
			$this->datasistem->save($simpan,'tbltag_added');
			
		}

		
		
	}
	function pro_secruleremovebytagactivate(){
			

		$id = $this->input->post('id');

		//simpan data dalam table tbltag_added

		$simpan = array(
			'status' => 'A'
		);
		
		$this->datasistem->edit($id,'id',$simpan,'tbltag_added');
		
		
		$update = array(
			'status' => 'A'
		);
			
		
		$this->datasistem->write_crules($update);
		
	}
	function pro_secruleremovebytagdelete(){

		$id = $this->input->post('id');

		//delete data dalam table tbltag_added
		$padam = array (
			'id' => $id
		);
		
		$this->datasistem->remove($padam,'tbltag_added');		
		
	}
	function pro_secruleremovebytagremove(){

		$id = $this->input->post('id');

		//deactivate data dalam table tbltag_added
	
		$simpan = array(
			'status' => 'TA'
		);
		
		$this->datasistem->edit($id,'id',$simpan,'tbltag_added');
		
		
			
	    $update = array(
			'status' => 'A'
		);
			
		
		$this->datasistem->write_crules($update);
		
		
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
}
	
	
	
	