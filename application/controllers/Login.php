<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper("form");
		$this->load->library("session");
		
	}

	public function login1()
	{
		$this->load->view("login");
	}
	public function loginAction()
	{
		$user=$this->input->post("user");
		$pass=$this->input->post("pass");

		$query_user=$this->db->query("select * from sc_option where t_value=?",array($user));
		$query_user_rows=$query_user->result();

		$query_pass=$this->db->query("select * from sc_option where t_value=?",array(md5($pass)));
		$query_pass_rows=$query_pass->result();

		if(count($query_user_rows)>=1&&count($query_pass_rows)>=1)
		{
			//success
			$this->session->set_userdata("info",$user);
			header("location:".site_url()."/admin/");
		}else{
			$this->session->set_userdata("info",null);
			header("location:".site_url()."/login/login1");
		}

	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */