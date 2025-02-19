<?php

class Goods_management extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
	}

	public function index()
	{
		$this->session->set_flashdata('page_title', 'PERFORMANCE DASHBOARD');
		$this->load->view('goods-management/dashboard.php');
	}

	public function feedback()
	{
		$this->session->set_flashdata('page_title', 'PERFORMANCE DASHBOARD');
		$this->load->view('goods-management/feedback.php');
	}	
	public function order()
	{
		$this->session->set_flashdata('page_title', 'PERFORMANCE DASHBOARD');
		$this->load->view('goods-management/order.php');
	}	

	public function item_movement()
	{
		$this->session->set_flashdata('page_title', 'STOCK CARD');
		$this->load->view('goods-management/item-movement.php');
	}	
	
	public function item_movement_detail()
	{
		$this->session->set_flashdata('page_title', 'STOCK CARD');
		$this->load->view('goods-management/item-movement/index.php');
	}	
}
