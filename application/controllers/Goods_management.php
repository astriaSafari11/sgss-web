<?php

class Goods_management extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		if(!$this->auth_model->current_user()){
			redirect('auth/login');
		}

		if (!$this->auth_model->session_timeout()) {
			redirect('auth/login');
		}
	}

	public function index()
	{
		$search = '';

		if(isset($_POST['reset'])){
			$search = '';
		}

		if(isset($_POST['search'])){
			$column_search = $this->input->post('column_search');
			$search = $this->input->post('keyword');
			$filter = $this->input->post('column_filter');

			$data['param_search'] = array(
				'column_search' => $column_search,
				'keyword' => $search,
				'column_filter' => $filter,
			);
	
			if($filter == 'like'){
				$search = " WHERE ".$column_search." LIKE '%".$search."%'";				
			}else{
				$search = " WHERE ".$column_search." ".$filter." '".$search."'";
			}
		}

		$fSearch = !empty($search)?$search.' AND order_status = 0':'WHERE order_status = 0';
		
		$query =  $this->db->query("SELECT * FROM t_stock_planned_request $fSearch")->result();
		$count =  $this->db->get_where('t_stock_planned_request',array("order_status" => 0))->num_rows();
		$feedback =  $this->db->get_where('t_order',array("is_approved" => 1, "is_feedback" => 0))->num_rows();

		$data['req_list'] = $query;		
		$data['req_count'] = $count;		
		$data['feedback_count'] = $feedback;		
		$data['column_search'] = array(
			'due_date',
			'until_due_date',
			'item_code',
			'item_name',
			'qty',
			'uom',
			'status',
		);		

		$this->session->set_flashdata('page_title', 'PERFORMANCE DASHBOARD');
		$this->load->view('goods-management/dashboard.php', $data);
	}

	public function feedback()
	{
		$query =  $this->db->query(
			"SELECT t_stock_planned_request.*, t_order.id as order_id, t_order.status as order_statuses, t_order.is_download, t_order.attachment_file  FROM t_stock_planned_request 
			 INNER JOIN t_order ON t_order.planned_id = t_stock_planned_request.id 
			 WHERE t_order.is_approved = 1 and t_order.is_feedback = 0"
		)->result();

		// $query =  $this->db->get_where('t_stock_planned_request',array("order_status" => NULL))->result();

		$count =  $this->db->get_where('t_stock_planned_request',array("order_status" => 0))->num_rows();
		$feedback =  $this->db->get_where('t_order',array("is_approved" => 1, "is_feedback" => 0))->num_rows();

		$data['feedback_list'] = $query;		
		$data['req_count'] = $count;		
		$data['feedback_count'] = $feedback;

		$this->session->set_flashdata('page_title', 'PERFORMANCE DASHBOARD');
		$this->load->view('goods-management/feedback.php', $data);
	}	
	public function order()
	{
		$id = _decrypt($this->uri->segment(3));

		$data['order'] = $this->db->query("
		select * from t_stock_planned_request 
		INNER JOIN m_vendor_material ON t_stock_planned_request.vendor_material_id = m_vendor_material.id 
		where t_stock_planned_request.id = '$id'
		")->result();	

		$data['purchase_reason'] = $this->db->get("m_purchase_reason")->result();	
		$data['user_list'] = $this->db->get("m_employee")->result();	
		$data['area'] = $this->db->get_where("m_employee_area",array(
			"nip"	=> $this->session->userdata('user_nip'),
		))->row();	

		$exist = $this->db->get_where("t_order",array(
			"planned_id"	=> $id,
		))->row();	

		if(!$exist){
			_add("t_order",array(				
				"planned_id"	=> $id,
				"is_approval_required"	=> 0
			));			
		}

		$data['order_detail'] = $this->db->get_where("t_order",array(
			"planned_id"	=> $id
		))->row();

		$check_exist = $this->db->get_where("t_order_detail",array(
			"order_id"	=> $data['order_detail']->id
		))->row();

		if(!$check_exist){
			$order = $this->db->query("
			select * from t_stock_planned_request 
			INNER JOIN m_vendor_material ON t_stock_planned_request.vendor_material_id = m_vendor_material.id 
			where t_stock_planned_request.id = '$id'
			")->row();		

			_add("t_order_detail",array(	
				"order_id"	=> $data['order_detail']->id,
				"item"	=> $order->item_code,
				"qty"	=> $order->qty,
				"uom"	=> $order->uom,
				"vendor_code" => $order->vendor_code,
				"uom_price"	  => $order->price_per_uom,
				"total_price" => $order->moq*$order->price_per_uom,
				"status"	  => 0
			));			
		}

		$this->session->set_flashdata('page_title', 'FORM INPUT ORDER');
		$this->load->view('goods-management/order.php', $data);
	}	

	public function submit_order(){
		$config['allowed_types'] = '*';
	  	$config['max_size'] = 0;
		$config['upload_path'] = 'assets/upload/order/';
  		$config['file_name'] = date('dmY_His');

  		$attachment = '';
  		$this->load->library('upload', $config);
	  	if ($this->upload->do_upload('attachment')) {
	  		$data_file = $this->upload->data();
		  	$attachment = $data_file['file_name'];

		}else{
		  	print_r($this->upload->display_errors());
		}

		$purchase_reason = $this->input->post('purchase_reason');
		$order_id = $this->input->post('order_id');
		$planned_id = $this->input->post('planned_id');
		$is_approved = 0;
		$is_feedback = 0;
		if($purchase_reason == "Routine Buy"){
			$is_approval_required = 0;

			$status = "auto_approved";
			$is_approved=1;
		}else{
			$is_approval_required = 1;
			$status = "waiting_approval";
		}

		$request_id = 'REQ'.date("dmY").$order_id;
		$data = array(
			"date"					=> $this->input->post('date'),
			"request_id"			=> $request_id,
			"requestor"				=> $this->session->userdata('user_name'),
			"requested_for"			=> $this->input->post('requested_for'),
			"area"					=> $this->input->post('area'),
			"remarks"				=> $this->input->post('remarks'),
			"status"				=> $status,
			"purchase_reason"		=> $purchase_reason,
			"is_approval_required"	=> $is_approval_required,
			"attachment_file"		=> $attachment,
			"approved_by"			=> "auto_approved",
			"is_approved"			=> $is_approved,
			"is_feedback"			=> $is_feedback,
			"is_download"			=> 0,
			// "rejected_by"			=> $this->input->post('rejected_by'),
			"approved_date"			=> date("Y-m-d"),
			// "rejected_date"			=> $this->input->post('rejected_date'),
			"approved_remark"		=> 'Auto Approved by SGSS System - as per application recommendation',
			// "rejected_remark"		=> $this->input->post('rejected_remark'),
		);
	
		_update("t_order", $data, array("id" => $order_id));

		_update("t_stock_planned_request", array(
			"order_status" =>1
		), array("id" => $planned_id));

		redirect('goods_management/order_detail/'._encrypt($order_id));
	}

	public function order_detail()
	{
		$id = _decrypt($this->uri->segment(3));

		$data['order'] = $this->db->get_where("t_order",array(
			"id"	=> $id
		))->row();
		
		$data['order_detail'] = $this->db->query("
		select * from t_order_detail 
		INNER JOIN m_master_data_vendor ON m_master_data_vendor.vendor_code = t_order_detail.vendor_code
		INNER JOIN m_master_data_material ON m_master_data_material.item_code = t_order_detail.item 
		where t_order_detail.order_id = '$id'
		")->result();	
		
		$this->session->set_flashdata('page_title', 'FORM INPUT ORDER DETAIL');
		$this->load->view('goods-management/order/detail.php', $data);
	}	
	
	public function feedback_form()
	{
		$id = _decrypt($this->uri->segment(3));

		$data['order'] = $this->db->get_where("t_order",array(
			"id"	=> $id
		))->row();
		
		$data['order_detail'] = $this->db->query("
		select * from t_order_detail 
		INNER JOIN m_master_data_vendor ON m_master_data_vendor.vendor_code = t_order_detail.vendor_code
		INNER JOIN m_master_data_material ON m_master_data_material.item_code = t_order_detail.item 
		where t_order_detail.order_id = '$id'
		")->result();	
		
		$this->session->set_flashdata('page_title', 'FEEDBACK FORM');
		$this->load->view('goods-management/order/feedback_form.php', $data);
	}	

	public function feedback_update(){
		$id = _decrypt($this->uri->segment(3));

		$po_gr = $this->input->post('po_gr');
		$is_feedback = 1;

		_update("t_order", array(
			"is_feedback" => $is_feedback,
			"po_gr_number" => $po_gr,
			"feedback_date" => date("Y-m-d"),
			"feedback_by" => $this->session->userdata('user_name')
		), array("id" => $id));

		$get_order = $this->db->get_where("t_order",array(
			"id"	=> $id,
		))->row();

		$get_planned = $this->db->get_where("t_stock_planned_request",array(
			"id"	=> $get_order->planned_id
		))->row();

		$get_stock_card = $this->db->get_where("t_material_movement",array(
			"vendor_material_id"	=> $get_planned->vendor_material_id,
			"week"	=> $get_planned->week
		))->row();

		$schedule_receipt = $get_stock_card->schedules_receipts + $get_planned->qty;

		calc_sched_receipt($get_stock_card->id, $schedule_receipt);

		_update("t_material_movement", array(
			"schedules_receipts" => $schedule_receipt
		), array(
			"vendor_material_id"	=> $get_planned->vendor_material_id,
			"week"	=> $get_planned->week
		));

		redirect('goods_management/order_detail/'._encrypt($id));
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
			"item_id"	=> $data['material']->id,
		))->row();		

		$data['gross_req'] = $this->db->get_where("m_stock_card_formula",array(
			"item_id"	=> $data['material']->id,
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
