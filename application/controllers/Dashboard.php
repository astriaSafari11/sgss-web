<?php

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
	}

	public function index()
	{
		$this->session->set_flashdata('page_title', 'DASHBOARD');
		$this->load->view('dashboard.php');
	}
}
