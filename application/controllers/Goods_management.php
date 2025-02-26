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
		// $this->db->from("t_stock_planned_request");
		// $this->db->limit(5);
		$query =  $this->db->get('t_stock_planned_request')->result();

		$data['req_list'] = $query;		

		$this->session->set_flashdata('page_title', 'PERFORMANCE DASHBOARD');
		$this->load->view('goods-management/dashboard.php', $data);
	}

	public function feedback()
	{
		$this->session->set_flashdata('page_title', 'PERFORMANCE DASHBOARD');
		$this->load->view('goods-management/feedback.php');
	}	
	public function order()
	{
		$this->session->set_flashdata('page_title', 'FORM INPUT ORDER');
		$this->load->view('goods-management/order.php');
	}	

	public function order_detail()
	{
		$this->session->set_flashdata('page_title', 'FORM INPUT ORDER DETAIL');
		$this->load->view('goods-management/order/detail.php');
	}		

	public function order_approve()
	{
		$this->session->set_flashdata('page_title', 'FORM INPUT ORDER APPROVED');
		$this->load->view('goods-management/order/approved.php');
	}	

	public function order_reject()
	{
		$this->session->set_flashdata('page_title', 'FORM INPUT ORDER REJECTED');
		$this->load->view('goods-management/order/rejected.php');
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

	public function transactions()
	{
		$this->session->set_flashdata('page_title', 'TRANSACTIONS CARD');
		$this->load->view('goods-management/transactions.php');
	}	
}
