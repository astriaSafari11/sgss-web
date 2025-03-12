<?php

class LandingPage extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
	}

	public function index()
	{
		$this->session->set_flashdata('page_title', 'Home');
		$this->load->view('landing_page.php');
	}
}
