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
		$week	=	date("W");
		$data['item'] = $this->db->query("
		select *,
		(standart_safety_stock + ((standart_safety_stock /100)* var_stock_card_ok)) as ok,
		(standart_safety_stock + ((standart_safety_stock /100)* var_stock_card_overstock)) as overstock,
		(CASE
		WHEN net_on_hand >= (standart_safety_stock + ((standart_safety_stock /100)* var_stock_card_overstock)) THEN 'overstock'
		WHEN net_on_hand >= (standart_safety_stock + ((standart_safety_stock /100)* var_stock_card_ok)) 	   THEN 'OK'
		WHEN net_on_hand = 0 THEN 'understock'
		WHEN net_on_hand <= standart_safety_stock THEN 'understock'
		WHEN current_safety_stock <= standart_safety_stock THEN 'understock'
		END) AS status 
		from view_stock_card
		WHERE week = '$week'
		")->result();		
		
		$this->session->set_flashdata('page_title', 'STOCK CARD');
		load_view('goods-management/item-movement.php', $data);
	}	

	public function stock_card_detail()
	{
		$id = _decrypt($this->uri->segment(3));

		$data['vendor'] = $this->db->get_where("view_master_vendor",array(
			"id"	=> $id,
		))->row();		

		$data['vendor_detail'] = $this->db->get_where("m_master_data_vendor",array(
			"vendor_code"	=> $data['vendor']->vendor_code,
		))->row();		

		$data['material'] = $this->db->get_where("m_vendor_material",array(
			"id"	=> $id,
		))->row();		

		$data['var_settings'] = $this->db->get_where("m_variable_settings",array(
			"vendor_material_id"	=> $id,
		))->row();		

		$data['gross_req'] = $this->db->get_where("m_stock_card_formula",array(
			"vendor_material_id"	=> $id,
		))->result();		
		
		$data['item_movement'] = $this->db->get_where("t_material_movement",array(
			"vendor_material_id"	=> $id,
		))->result();	

		$data['total_gross_req'] = count($data['gross_req']);

		$this->session->set_flashdata('page_title', 'STOCK CARD');
		load_view('goods-management/item-movement/detail.php', $data);
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
