<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


	public function index()
	{
		$this->load->view('header');
		$this->load->view('main');
		
		
		  /*
		  $useral  = exec('who -q');
		  $usersec = explode("=",$useral);
		  $curuser = "".$usersec[1]."";
		  
		  $hostname = $_SERVER['SERVER_NAME'];
		  $hostip   = "127.0.0.1";
		  $ostype   = $_SERVER['HTTP_USER_AGENT'];
		  $webserv  = $_SERVER['SERVER_SOFTWARE'];
		  $yourip   = $_SERVER["REMOTE_ADDR"];
		  $ostype   = PHP_OS;
		   
		  
		  $uname    = php_uname();
		  */
		 
		$uptimem = exec('uptime');
		$uptimem = explode(",",$uptimem);
		$uptime  = $uptimem[0];
		$data_f['uptime'] = $uptime;
		

		$this->load->view('footer',$data_f);
	}
	public function test(){
		echo "test";
	}
	
	public function checklogin(){
		
		
		if($this->datasistem->check_login($this->input->post('user'),$this->input->post('pass'))){
				
				
				$_SESSION['user_id']      = $this->input->post('user');
				$_SESSION['username']     = (string)$this->input->post('user');
				$_SESSION['logged_in']    = (bool)true;
	
				echo "ok";					
		}
		else {
			echo $this->datasistem->check_login($this->input->post('user'),$this->input->post('pass'));	
		}
	}
	public function juslogout(){
			
		foreach ($_SESSION as $key => $value) {
				unset($_SESSION[$key]);
		}
		redirect('../../','refresh');
	}
	
}
