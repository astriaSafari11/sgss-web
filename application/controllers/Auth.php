<?php

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('master_model');
		$this->load->model('auth_model');
		$this->load->library('email');
	}
	
	public function index()
	{
		show_404();
	}

	public function login()
	{
		$this->auth_model->logout();
	
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			if(!empty($username) && !empty($password)){
				if($this->auth_model->login($username, $password)){
					redirect('landing_page');
				} else {
					// redirect('dashboard');
					$this->session->set_flashdata('message_login_error', 'Login Failed, Please check your username or password!');
				}	
			}
			$this->load->view('login_form');	
	}
	public function logout()
	{
		$this->load->model('auth_model');
		$this->auth_model->logout();
		redirect(site_url());
	}
}
