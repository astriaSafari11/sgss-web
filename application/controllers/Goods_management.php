<?php

class Goods_management extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		// $this->load->model('proposal_model');
		// if(!$this->auth_model->current_user()){
		// 	redirect('auth/login');
		// }
	}

	public function index()
	{
		$this->session->set_flashdata('page_title', 'PERFORMANCE DASHBOARD');
		$this->load->view('goods-management/dashboard.php');
	}
}
