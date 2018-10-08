<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
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
		
		//$apacheconf = $this->config->item('apachecfg');
		
		//$baca = read_file($apacheconf);
		//print_r($baca);
		//echo write_file('/usr/share/mampu/rules/test.txt',$baca);
		$this->load->view('footer',$data_f);
	}
	public function test(){
		echo "test";
	}
	
	public function checklogin(){
		
		
		if($this->datasistem->check_login($this->input->post('user'),$this->input->post('pass'))){
				
				//$user_id = $this->datasistem->getuid($this->input->post('user'))->agency_id;
				//$agensi    = $this->datasistem->get_agensi($user_id);
					
				//$_SESSION['user_id']      = (int)$user_id;
				$_SESSION['user_id']      = $this->input->post('user');
				$_SESSION['username']     = (string)$this->input->post('user');
				$_SESSION['logged_in']    = (bool)true;
				//$_SESSION['is_confirmed'] = (bool)$user->is_confirmed;
				//$_SESSION['is_admin']     = (bool)$user->is_admin;
				echo "ok";					
		}
		else {
			//echo "Kemasukan Dihalang.. ";
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
