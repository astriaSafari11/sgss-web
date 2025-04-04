<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Goods_management extends CI_Controller
	{

	public function __construct()
		{
		parent::__construct ();
		$this->load->model ('auth_model');
		$this->session->set_userdata ('session_created', time ());
		if (! $this->auth_model->current_user ())
			{
			redirect ('auth/login');
			}

		if (! $this->auth_model->session_timeout ())
			{
			redirect ('auth/login');
			}

		$this->load->model ('goods_management_model');
		}

	public function index()
		{
		$curr_user = $this->auth_model->current_user ();


		if ($curr_user->role_id != 1 && $curr_user->role_id != 3)
			{
			$sql = "
				SELECT * FROM t_order_approval_track				
				INNER JOIN t_order_detail ON t_order_detail.order_id = t_order_approval_track.order_id
				INNER JOIN t_order ON t_order.id = t_order_detail.order_id
				INNER JOIN m_master_data_material ON t_order_detail.item_code = m_master_data_material.item_code
				WHERE t_order_approval_track.approve_by = '" . $curr_user->nip . "' and approve_status = 'pending'
				AND t_order.status = 'waiting_approval'
				AND request_id IS NOT NULL
			";

			$query = $this->db->query ($sql)->result ();
			$count = $this->db->query ($sql)->num_rows ();
			$feedback = $this->db->get_where ('t_order', array("is_approved" => 1, "is_feedback" => 0))->num_rows ();

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

			// debugCode($data);
			$this->session->set_flashdata ('page_title', 'PERFORMANCE DASHBOARD');
			$this->load->view ('goods-management/dashboard-lm.php', $data);

			}
		else
			{

			$search = '';

			if (isset ($_POST['reset']))
				{
				$search = '';
				}

			if (isset ($_POST['search']))
				{
				$column_search = $this->input->post ('column_search');
				$search = $this->input->post ('keyword');
				$filter = $this->input->post ('column_filter');

				$data['param_search'] = array(
					'column_search' => $column_search,
					'keyword' => $search,
					'column_filter' => $filter,
				);

				if ($filter == 'like')
					{
					$search = " WHERE " . $column_search . " LIKE '%" . $search . "%'";
					}
				else
					{
					$search = " WHERE " . $column_search . " " . $filter . " '" . $search . "'";
					}
				}

			$fSearch = ! empty ($search) ? $search . " AND planned.order_status = 0 AND planned.type = 'goods'" : "WHERE planned.order_status = 0 AND planned.type = 'goods' AND planned.status != 'ignored'";

			$query = $this->db->query ("select planned.*, material.item_group, material.size, material.uom, vendor.vendor_name from t_stock_planned_request as planned
			INNER JOIN m_master_data_material as material ON planned.item_id = material.id
			INNER JOIN m_master_data_vendor as vendor ON planned.vendor_code = vendor.vendor_code
			$fSearch")->result ();

			$count = $this->db->get_where ('t_stock_planned_request', array("order_status" => 0, "type" => 'goods', "status !=" => "ignored"))->num_rows ();
			$feedback = $this->db->get_where ('t_order', array("is_approved" => 1, "is_feedback" => 0))->num_rows ();

			$data['req_list'] = $query;
			$data['req_count'] = $count;
			$data['feedback_count'] = $feedback;
			$data['column_search'] = array(
				'status',
				'item_code',
				'item_name',
				'item_group',
				'vendor_code',
				'vendor_name',
				'qty',
				'uom',
			);

			$this->session->set_flashdata ('page_title', 'GOODS DASHBOARD');
			$this->load->view ('goods-management/dashboard.php', $data);

			}
		}

	public function feedback()
		{
		$query = $this->db->query (
			"select t_order.*, t_order.status as order_status, detail.*, material.item_group, vendor.vendor_name FROM t_order
			INNER JOIN t_order_detail as detail ON t_order.id = detail.order_id
			INNER JOIN m_master_data_material as material on detail.item_id = material.id
			INNER JOIN m_master_data_vendor as vendor on detail.vendor_code = vendor.vendor_code
			 WHERE t_order.is_approved = 1 and t_order.is_feedback = 0"
		)->result ();

		// $query =  $this->db->get_where('t_stock_planned_request',array("order_status" => NULL))->result();

		$count = $this->db->get_where ('t_stock_planned_request', array("order_status" => 0, "type" => 'goods'))->num_rows ();
		$feedback = $this->db->get_where ('t_order', array("is_approved" => 1, "is_feedback" => 0))->num_rows ();

		$data['feedback_list'] = $query;
		$data['req_count'] = $count;
		$data['feedback_count'] = $feedback;

		$this->session->set_flashdata ('page_title', 'GOODS DASHBOARD');
		$this->load->view ('goods-management/feedback.php', $data);
		}
	public function order()
		{
		$id = _decrypt ($this->uri->segment (3));

		$data['order'] = $this->db->query ("
		select * from t_stock_planned_request 
		INNER JOIN m_master_data_material ON t_stock_planned_request.item_id = m_master_data_material.id 
		where t_stock_planned_request.id = '$id'
		")->result ();

		$data['purchase_reason'] = $this->db->get ("m_purchase_reason")->result ();
		$data['user_list'] = $this->db->get ("m_employee")->result ();
		$data['area'] = $this->db->get_where ("m_employee_area", array(
			"nip" => $this->session->userdata ('user_nip'),
		))->row ();

		$exist = $this->db->get_where ("t_order", array(
			"planned_id" => $id,
		))->row ();

		if (! $exist)
			{
			_add ("t_order", array(
				"planned_id" => $id,
				"approval_category" => 'normal',
				"is_approval_required" => 0
			));
			}

		$data['order_detail'] = $this->db->get_where ("t_order", array(
			"planned_id" => $id
		))->row ();

		$check_exist = $this->db->get_where ("t_order_detail", array(
			"order_id" => $data['order_detail']->id
		))->row ();

		if (! $check_exist)
			{
			$order = $this->db->query ("
			select * from t_stock_planned_request 
			INNER JOIN m_master_data_material ON t_stock_planned_request.item_code = m_master_data_material.item_code
			where t_stock_planned_request.id = '$id'
			")->row ();

			$get_price = $this->db->get_where ("m_vendor_material", array(
				"vendor_code" => $order->vendor_code,
				"item_code" => $order->item_code
			))->row ();

			_add ("t_order_detail", array(
				"order_id" => $data['order_detail']->id,
				"item_id" => $order->item_id,
				"item_code" => $order->item_code,
				"item_name" => $order->item_name,
				"qty" => $order->qty,
				"uom" => $order->uom,
				"vendor_code" => $order->vendor_code,
				"uom_price" => $get_price->price_per_uom,
				"total_price" => $order->qty * $get_price->price_per_uom,
				"status" => 0
			));
			}
		$data['detail'] = $this->db->query ("select * from t_order_detail 
			INNER JOIN m_master_data_material ON t_order_detail.item_code = m_master_data_material.item_code 
			INNER JOIN m_master_data_vendor ON t_order_detail.vendor_code = m_master_data_vendor.vendor_code 			
			where t_order_detail.order_id = '" . $data['order_detail']->id . "'")->row ();

		$data['planned'] = $this->db->query ("select * from t_stock_planned_request 
			INNER JOIN m_master_data_material ON t_stock_planned_request.item_code = m_master_data_material.item_code 
			INNER JOIN m_master_data_vendor ON t_stock_planned_request.vendor_code = m_master_data_vendor.vendor_code 			
			where t_stock_planned_request.id = '$id'")->row ();

		$data['vendor_list'] = $this->db->query ("select * from m_vendor_material 
        INNER JOIN m_master_data_vendor ON m_master_data_vendor.vendor_code = m_vendor_material.vendor_code
        where item_code = '$check_exist->item_code'")->result ();

		$this->session->set_flashdata ('page_title', 'INPUT ORDER FORM');
		$this->load->view ('goods-management/order.php', $data);
		}

	public function edit_qty_order()
		{
		$order_id = $this->input->post ('order_id');
		$qty = $this->input->post ('qty');

		$order = $this->db->get_where ("t_order", array(
			"id" => $order_id
		))->row ();

		$order_detail = $this->db->get_where ("t_order_detail", array(
			"order_id" => $order_id
		))->row ();

		$threshold = $this->db->get_where ("m_variable_settings", array(
			"item_id" => $order_detail->item_id
		))->row ()->min_threshold;

		$planned = $this->db->get_where ("t_stock_planned_request", array(
			"id" => $order->planned_id
		))->row ();

		$diff = $qty - $planned->qty;

		$diff_percentage = (abs ($diff) / $planned->qty) * 100;

		if ($diff_percentage >= $threshold)
			{
			$order_status = 'qty_over_threshold';
			}
		else
			{
			$order_status = 'normal';
			}

		$data = array(
			"qty" => $qty,
			"total_price" => $qty * $order_detail->uom_price,
			"adjustment" => 'qty'
		);

		_update ("t_order_detail", $data, array(
			"id" => $order_detail->id
		));

		_update ("t_order", array(
			"approval_category" => $order_status
		), array(
			"id" => $order->id
		));

		redirect ('goods_management/order/' . _encrypt ($order->planned_id));
		}

	public function edit_vendor_order()
		{
		$order_id = $this->input->post ('order_id');
		$id = $this->input->post ('vendor');

		$order = $this->db->get_where ("t_order", array(
			"id" => $order_id
		))->row ();

		$order_detail = $this->db->get_where ("t_order_detail", array(
			"order_id" => $order_id
		))->row ();

		$threshold = $this->db->get_where ("m_variable_settings", array(
			"item_id" => $order_detail->item_id
		))->row ()->min_threshold;

		$planned = $this->db->get_where ("t_stock_planned_request", array(
			"id" => $order->planned_id
		))->row ();

		$planned_price = $this->db->get_where ("m_vendor_material", array(
			"vendor_code" => $planned->vendor_code,
			"item_code" => $planned->item_code
		))->row ();


		$vendor = $this->db->get_where ("m_vendor_material", array(
			"vendor_code" => $id,
			"item_code" => $order_detail->item_code
		))->row ();

		$planned_total_price = $planned_price->price_per_uom * $order_detail->qty;

		$total_price = $vendor->price_per_uom * $order_detail->qty;
		$diff = $order->total_price - $total_price;

		$diff_percentage = (abs ($diff) / $planned_total_price) * 100;

		if ($diff_percentage >= $threshold)
			{
			$order_status = 'price_over_threshold';
			}
		else
			{
			$order_status = 'normal';
			}

		$data = array(
			"vendor_code" => $vendor->vendor_code,
			"uom_price" => $vendor->price_per_uom,
			"total_price" => $total_price,
			"adjustment" => 'vendor'
		);

		_update ("t_order_detail", $data, array(
			"id" => $order_detail->id
		));

		_update ("t_order", array(
			"approval_category" => $order_status
		), array(
			"id" => $order->id
		));

		redirect ('goods_management/order/' . _encrypt ($order->planned_id));
		}

	public function ignore_order()
		{
		$id = _decrypt ($this->uri->segment (3));

		$data['order'] = $this->db->query ("
		select * from t_stock_planned_request 
		INNER JOIN m_master_data_material ON t_stock_planned_request.item_id = m_master_data_material.id 
		where t_stock_planned_request.id = '$id'
		")->row ();

		$get_pending_days = $this->db->get_where ("m_variable_settings", array(
			"item_id" => $data['order']->item_id
		))->row ();

		$exist = $this->db->get_where ("t_order", array(
			"planned_id" => $id,
		))->row ();

		$request_id = 'REQ' . date ("dmYHi");

		if (! $exist)
			{
			_add ("t_order", array(
				"request_id" => $request_id,
				"planned_id" => $id,
				"date" => date ("Y-m-d"),
				"ignored_reason" => $this->input->post ('ignore_remarks'),
				"requestor" => $this->session->userdata ('user_name'),
				"requestor_nip" => $this->session->userdata ('user_nip'),
				"pending_days" => $get_pending_days->var_pending_approval,
				"remarks" => 'Request to remove and ignore this order',
				"status" => 'waiting_approval',
				"order_category" => 'ignore',
				"is_approval_required" => 1,
				"is_approved" => 0,
				"is_feedback" => 0,
				"is_download" => 0,
			));
			}
		else
			{
			_update ("t_order", array(
				"planned_id" => $id,
				"date" => date ("Y-m-d"),
				"ignored_reason" => $this->input->post ('ignore_remarks'),
				"requestor" => $this->session->userdata ('user_name'),
				"requestor_nip" => $this->session->userdata ('user_nip'),
				"pending_days" => $get_pending_days->var_pending_approval,
				"remarks" => 'Request to remove and ignore this order',
				"status" => 'waiting_approval',
				"order_category" => 'ignore',
				"is_approval_required" => 1,
				"is_approved" => 0,
				"is_feedback" => 0,
				"is_download" => 0,
			), array(
				"id" => $exist->id
			));
			}

		$data['order_detail'] = $this->db->get_where ("t_order", array(
			"planned_id" => $id
		))->row ();

		$check_exist = $this->db->get_where ("t_order_detail", array(
			"order_id" => $data['order_detail']->id
		))->row ();

		if (! $check_exist)
			{
			$order = $this->db->query ("
			select * from t_stock_planned_request 
			INNER JOIN m_master_data_material ON t_stock_planned_request.item_code = m_master_data_material.item_code
			where t_stock_planned_request.id = '$id'
			")->row ();

			$get_price = $this->db->get_where ("m_vendor_material", array(
				"vendor_code" => $order->vendor_code,
				"item_code" => $order->item_code
			))->row ();

			_add ("t_order_detail", array(
				"order_id" => $data['order_detail']->id,
				"item_id" => $order->item_id,
				"item_code" => $order->item_code,
				"item_name" => $order->item_name,
				"qty" => $order->qty,
				"uom" => $order->uom,
				"vendor_code" => $order->vendor_code,
				"uom_price" => $get_price->price_per_uom,
				"total_price" => $order->qty * $get_price->price_per_uom,
				"status" => 0
			));

			_update ("t_stock_planned_request", array(
				"order_status" => 1,
				"status" => 'ignored'
			), array("id" => $id));

			generate_approval_track ($data['order_detail']->id, $this->session->userdata ('user_nip'));
			}

		$data['detail'] = $this->db->get_where ("t_order_detail", array(
			"order_id" => $data['order_detail']->id
		))->result ();

		$err = array(
			'show' => true,
			'type' => 'success',
			'msg' => 'Successfully Ignore Request Planned'
		);
		$this->session->set_flashdata ('toast', $err);


		redirect ('goods_management');
		}

	public function submit_order()
		{
		$config['allowed_types'] = '*';
		$config['max_size'] = 0;
		$config['upload_path'] = 'assets/upload/order/';
		$config['file_name'] = date ('dmY_His');

		$attachment = '';
		$this->load->library ('upload', $config);
		if ($this->upload->do_upload ('attachment'))
			{
			$data_file = $this->upload->data ();
			$attachment = $data_file['file_name'];

			}
		else
			{
			print_r ($this->upload->display_errors ());
			}

		$purchase_reason = $this->input->post ('purchase_reason');
		$order_id = $this->input->post ('order_id');
		$planned_id = $this->input->post ('planned_id');
		$is_approved = 0;
		$is_feedback = 0;

		$order = $this->db->get_where ("t_order", array(
			"id" => $order_id
		))->row ();

		if ($purchase_reason == "Routine Buy")
			{
			if ($order->approval_category != 'normal')
				{
				$is_approval_required = 1;
				$status = "waiting_approval";
				$approved_by = '';
				$approve_remarks = '';
				$approve_date = NULL;
				}
			else
				{
				$is_approval_required = 0;
				$status = "auto_approved";
				$is_approved = 1;
				$approved_by = "auto_approved";
				$approve_remarks = 'Auto Approved by SGSS System - as per application recommendation';
				$approve_date = date ("Y-m-d");
				}
			}
		else
			{
			$is_approval_required = 1;
			$status = "waiting_approval";
			$approved_by = '';
			$approve_remarks = '';
			$approve_date = NULL;
			}

		$request_id = 'REQ' . date ("dmY") . $order_id;
		$data = array(
			"date" => date ("Y-m-d"),
			"request_id" => $request_id,
			"requestor" => $this->session->userdata ('user_name'),
			"requestor_nip" => $this->session->userdata ('user_nip'),
			"requested_for" => $this->input->post ('requested_for'),
			"area" => $this->input->post ('area'),
			"remarks" => $this->input->post ('remarks'),
			"order_category" => 'order',
			"status" => $status,
			"purchase_reason" => $purchase_reason,
			"is_approval_required" => $is_approval_required,
			"attachment_file" => $attachment,
			"approved_by" => $approved_by,
			"is_approved" => $is_approved,
			"is_feedback" => $is_feedback,
			"is_download" => 0,
			"approved_date" => $approve_date,
			"approved_remark" => $approve_remarks,
		);

		_update ("t_order", $data, array("id" => $order_id));

		_update ("t_stock_planned_request", array(
			"order_status" => 1
		), array("id" => $planned_id));

		generate_approval_track ($order_id, $this->session->userdata ('user_nip'));

		redirect ('goods_management/order_detail/' . _encrypt ($order_id));
		}

	public function order_detail()
		{
		$id = _decrypt ($this->uri->segment (3));

		$data['order'] = $this->db->get_where ("t_order", array(
			"id" => $id
		))->row ();

		$data['order_detail'] = $this->db->query ("
		select * from t_order_detail 
		INNER JOIN m_master_data_vendor ON m_master_data_vendor.vendor_code = t_order_detail.vendor_code
		INNER JOIN m_master_data_material ON m_master_data_material.item_code = t_order_detail.item_code
		where t_order_detail.order_id = '$id'
		")->result ();
		$curr_user = $this->auth_model->current_user ();
		$data['curr_user'] = $curr_user;

		$this->session->set_flashdata ('page_title', 'INPUT ORDER FORM DETAIL');
		$this->load->view ('goods-management/order/detail.php', $data);
		}

	public function feedback_form()
		{
		$id = _decrypt ($this->uri->segment (3));

		$data['order'] = $this->db->get_where ("t_order", array(
			"id" => $id
		))->row ();

		$data['order_detail'] = $this->db->query ("
		select * from t_order_detail 
		INNER JOIN m_master_data_vendor ON m_master_data_vendor.vendor_code = t_order_detail.vendor_code
		INNER JOIN m_master_data_material ON m_master_data_material.item_code = t_order_detail.item_code 
		where t_order_detail.order_id = '$id'
		")->result ();

		$this->session->set_flashdata ('page_title', 'FEEDBACK FORM');
		$this->load->view ('goods-management/order/feedback_form.php', $data);
		}

	public function feedback_update()
		{
		$id = _decrypt ($this->uri->segment (3));

		$po_gr = $this->input->post ('po_gr');
		$is_feedback = 1;

		_update ("t_order", array(
			"is_feedback" => $is_feedback,
			"po_gr_number" => $po_gr,
			"feedback_date" => date ("Y-m-d"),
			"feedback_by" => $this->session->userdata ('user_name')
		), array("id" => $id));

		$get_order = $this->db->get_where ("t_order", array(
			"id" => $id,
		))->row ();

		$get_planned = $this->db->get_where ("t_stock_planned_request", array(
			"id" => $get_order->planned_id
		))->row ();

		$get_stock_card = $this->db->get_where ("t_material_movement", array(
			"item_id" => $get_planned->item_id,
			"week" => $get_planned->week
		))->row ();

		$schedule_receipt = $get_stock_card->schedules_receipts + $get_planned->qty;

		calc_sched_receipt ($get_stock_card->id, $schedule_receipt);

		_update ("t_material_movement", array(
			"schedules_receipts" => $schedule_receipt
		), array(
			"item_id" => $get_planned->item_id,
			"week" => $get_planned->week
		));

		redirect ('goods_management/order_detail/' . _encrypt ($id));
		}

	public function approval_approve()
		{
		// $order_id = $this->input->post('order_id');
		$id = _decrypt ($this->uri->segment (3));


		$curr_user = $this->auth_model->current_user ();
		$order = $this->db->get_where ('t_order', array("id" => $id))->row ();
		$get_requestor = $this->db->get_where ('m_employee', array("nip" => $order->requestor_nip))->row ();

		if ($curr_user->role == 'line_manager')
			{
			$desc = 'Approved by Line Manager';
			$title = 'Line Manager';
			$level = 1;
			}
		else
			{
			$desc = 'Approved by WL1';
			$title = 'WL1';
			$level = 1;
			}

		$data = array(
			"status" => "approved",
			"is_approved" => 1,
			"is_feedback" => 0,
			"is_download" => 0,
			"approved_by" => $this->session->userdata ('user_name'),
			"approve_by_title" => $title,
			// "rejected_by"			=> $this->input->post('rejected_by'),
			"approved_date" => date ("Y-m-d"),
			// "rejected_date"			=> $this->input->post('rejected_date'),
			"approved_remark" => 'Approved by Line Manager',
			// "rejected_remark"		=> $this->input->post('rejected_remark'),
		);

		_update ("t_order", $data, array("id" => $id));

		_update (
			"t_order_approval_track",
			array(
				"approve_status" => "approved",
				"approve_by" => $this->session->userdata ('user_nip'),
				"approve_date" => date ("Y-m-d"),
			),
			array(
				"order_id" => $id,
				"approve_level" => $level
			)
		);

		if ($order->order_category == 'ignore')
			{
			_hard_delete ('t_stock_planned_request', array('id' => $order->planned_id));
			}

		$err = array(
			'show' => true,
			'type' => 'success',
			'msg' => 'Successfully Approved Order'
		);
		$this->session->set_flashdata ('toast', $err);

		$email_body = email_body ('Approved Order', "
		Hi, " . $get_requestor->name . "<br>

		Your order request is approved by Line Manager
		");

		send_email_notification ($get_requestor->email, 'Approved Order', $email_body);

		redirect ('goods_management/order_detail/' . _encrypt ($id));
		}

	public function approval_reject()
		{
		$id = _decrypt ($this->uri->segment (3));
		$id = $this->input->post ('id');


		$curr_user = $this->auth_model->current_user ();
		$order = $this->db->get_where ('t_order', array("id" => $id))->row ();
		$get_requestor = $this->db->get_where ('m_employee', array("nip" => $order->requestor_nip))->row ();

		if ($curr_user->role == 'line_manager')
			{
			$desc = 'Rejected by Line Manager';
			$title = 'Line Manager';
			$level = 1;
			}
		else
			{
			$desc = 'Rejected by WL1';
			$title = 'WL1';
			$level = 1;
			}

		$data = array(
			"status" => "rejected",
			"is_approved" => 1,
			"is_feedback" => 0,
			"is_download" => 0,
			"approve_by_title" => $title,
			"rejected_by" => $this->session->userdata ('user_name'),
			"rejected_date" => date ("Y-m-d"),
			"rejected_remark" => $this->input->post ('remarks'),
		);

		_update ("t_order", $data, array("id" => $id));

		_update (
			"t_order_approval_track",
			array(
				"approve_status" => "rejected",
				"approve_by" => $this->session->userdata ('user_nip'),
				"approve_date" => date ("Y-m-d"),
			),
			array(
				"order_id" => $id,
				"approve_level" => $level
			)
		);

		$err = array(
			'show' => true,
			'type' => 'success',
			'msg' => 'Successfully Reject Order'
		);
		$this->session->set_flashdata ('toast', $err);

		$email_body = email_body ('Rejected Order', "
		Hi, " . $get_requestor->name . "<br>

		Your order request is rejected by Line Manager
		");

		send_email_notification ($get_requestor->email, 'Rejected Order', $email_body);

		redirect ('goods_management/order_detail/' . _encrypt ($id));
		}

	public function order_reject()
		{
		if (isset ($_POST['submit']))
			{
			$id = $this->input->post ('id');
			$reason = $this->input->post ('ignore_remarks');
			$days = $this->input->post ('ignore_days');

			_update ("t_stock_planned_request", array(
				"status" => "ignored",
				"ignored_for" => $days,
				"ignored_reason" => $reason,
			), array("id" => $id));

			$err = array(
				'show' => true,
				'type' => 'success',
				'msg' => 'Successfully Ignore Request Planned'
			);
			$this->session->set_flashdata ('toast', $err);

			redirect ('goods_management');
			}
		}

	public function item_movement()
		{

		$data = array();
		if (isset ($_POST['search']))
			{
			$week = date ("W");
			$data['item'] = $this->db->query ("
				select *,
				(standard_safety_stock + ((standard_safety_stock /100)* var_stock_card_ok)) as ok,
				(standard_safety_stock + ((standard_safety_stock /100)* var_stock_card_overstock)) as overstock,
				(CASE
				WHEN net_on_hand >= (standard_safety_stock + ((standard_safety_stock /100)* var_stock_card_overstock)) THEN 'overstock'
				WHEN net_on_hand >= (standard_safety_stock + ((standard_safety_stock /100)* var_stock_card_ok)) 	   THEN 'OK'
				WHEN net_on_hand = 0 THEN 'understock'
				WHEN net_on_hand <= standard_safety_stock THEN 'understock'
				WHEN current_safety_stock <= standard_safety_stock THEN 'understock'
				END) AS status 
				from view_stock_card
				WHERE week = '$week'
				")->result ();

			}
		$this->session->set_flashdata ('page_title', 'INVENTORY');
		load_view ('goods-management/item-movement.php', $data);
		}

	public function stock_card_detail()
		{
		$id = _decrypt ($this->uri->segment (3));

		// $data['vendor'] = $this->db->get_where("view_master_vendor",array(
		// 	"id"	=> $id,
		// ))->row();		

		// $data['vendor_detail'] = $this->db->get_where("m_master_data_vendor",array(
		// 	"vendor_code"	=> $data['vendor']->vendor_code,
		// ))->row();		

		$data['material'] = $this->db->get_where ("m_master_data_material", array(
			"id" => $id,
		))->row ();

		$data['var_settings'] = $this->db->get_where ("m_variable_settings", array(
			"item_id" => $id,
		))->row ();

		$data['gross_req'] = $this->db->get_where ("m_stock_card_formula", array(
			"item_id" => $id,
		))->result ();

		$data['item_movement'] = $this->db->get_where ("t_material_movement", array(
			"item_id" => $id,
		))->result ();

		$data['total_gross_req'] = count ($data['gross_req']);

		$get_current_week = date ('W', strtotime (date ('Y-m-d')));

		if (isset ($_POST['search']))
			{
			$get_past_week = $this->input->post ('start_week');
			$get_up_week = $this->input->post ('to_week');

			}
		else
			{
			$get_past_week = $get_current_week - 5;
			$get_up_week = $get_current_week + 6;

			}

		$data['current_week'] = $get_current_week;
		$data['past_week'] = $get_past_week;
		$data['up_week'] = $get_up_week;

		$this->session->set_flashdata ('page_title', 'INVENTORY');
		load_view ('goods-management/item-movement/detail.php', $data);
		}

	public function update_item_movement()
		{
		if (isset ($_POST['submit']))
			{
			$id = $this->input->post ('material_movement_id');
			$get_data = $this->db->get_where ("t_material_movement", array(
				"id" => $id,
			))->row ();
			$get_initial_week = $get_data->week;

			$get_mat_detail = $this->db->get_where ("m_master_data_material", array(
				"item_code" => $get_data->item_code,
			))->row ();

			$gross_req = $this->input->post ('gross_requirement');

			$get_last_week = date ('W', strtotime ('December 28th'));
			$get_last_week = 20;
			$total_data = array();

			for ($i = $get_initial_week; $i <= $get_last_week; $i++)
				{
				$get_stock_card = $this->db->get_where ("m_stock_card_formula", array(
					"item_id" => $get_data->item_id,
					"year" => date ('Y'),
					"week" => $i
				))->row ();

				$get_prev_week_data = $this->db->get_where ("t_material_movement", array(
					"item_id" => $get_data->item_id,
					"year" => date ('Y'),
					"week" => $i - 1
				))->row ();

				$get_curr_week_data = $this->db->get_where ("t_material_movement", array(
					"item_id" => $get_data->item_id,
					"year" => date ('Y'),
					"week" => $i
				))->row ();

				$schedule_receipt = $get_curr_week_data->schedules_receipts ? $get_curr_week_data->schedules_receipts : 0;

				if ($this->input->post ('stock_on_hand') == 0)
					{
					$stock_on_hand = $get_initial_week == 1 ? ($get_mat_detail->initial_stock + $schedule_receipt) - $gross_req : ($get_prev_week_data->stock_on_hand + $get_prev_week_data->schedules_receipts) - $gross_req;
					}
				else
					{
					$stock_on_hand = $this->input->post ('stock_on_hand');
					}

				// debugCode(array(
				// 	$get_mat_detail,
				// 	$schedule_receipt,
				// 	$gross_req
				// ));

				$current_safety_stock = min ($stock_on_hand, $get_mat_detail->standard_safety_stock);
				$net_on_hand = $stock_on_hand - $current_safety_stock;
				$net_requirement = min ($stock_on_hand, 0);

				if ($get_stock_card->type == 'manual')
					{
					if ($i == $get_initial_week)
						{
						$gross_req = $this->input->post ('gross_requirement');
						}
					else
						{
						$gross_req = $get_curr_week_data->gross_requirement;
						}
					}
				else
					{
					$gross_req = get_avg_value ($get_mat_detail->id, $i);
					}

				// if($i == $get_initial_week){
				// 	$schedule_receipt = 100;
				// }else{
				// 	$schedule_receipt = $get_curr_week_data->schedules_receipts;
				// }

				$schedule_receipt = $get_curr_week_data->schedules_receipts;

				$data = array(
					'week' => $i,
					'gross_requirement' => $gross_req,
					'schedules_receipts' => $schedule_receipt,
					'stock_on_hand' => $stock_on_hand,
					'current_safety_stock' => round ($current_safety_stock, 0),
					'net_on_hand' => $net_on_hand,
					'net_requirement' => $net_requirement,
					'planned_order_receipt' => 0,
					'planned_order_release' => 0,
				);
				// debugCode(array($get_mat_detail, $get_curr_week_data, $get_stock_card, $i, $get_initial_week, $data));

				_update ('t_material_movement', $data, array(
					"item_id" => $get_data->item_id,
					"year" => date ('Y'),
					"week" => $i
				));

				if ($net_on_hand <= 0)
					{
					$exist = $this->db->get_where ("t_stock_planned_request", array(
						"item_id" => $get_data->item_id,
						"year" => date ('Y'),
						"week" => $i
					))->row ();

					$get_rec_material = $this->db->query ("
						SELECT TOP 1 * from m_vendor_material WHERE item_code = '" . $get_mat_detail->item_code . "' ORDER BY price_per_uom ASC
					")->row ();

					$planned_order_receipt = MAX ($get_rec_material->moq, $get_mat_detail->lot_size);

					_update ('t_material_movement', array(
						'planned_order_receipt' => $planned_order_receipt,
					), array(
						"item_id" => $get_data->item_id,
						"year" => date ('Y'),
						"week" => $i
					));

					$due_date = week_start_date ($i, date ('Y'));
					$lt_po_deliv = $get_mat_detail->gen_lead_time;

					$until_due_date = date ('Y-m-d', strtotime ($due_date . "+ $lt_po_deliv day"));

					$planned_release = array(
						'vendor_code' => $get_rec_material->vendor_code,
						'item_code' => $get_mat_detail->item_code,
						'item_id' => $get_mat_detail->id,
						'vendor_material_id' => $get_rec_material->vendor_material_id,
						'item_name' => $get_mat_detail->item_name,
						'qty' => $planned_order_receipt,
						'uom' => $get_mat_detail->uom,
						'year' => date ('Y'),
						'week' => $i,
						'status' => 'urgent',
						'due_date' => $due_date,
						'until_due_date' => $until_due_date,
						'order_status' => 0,
						'type' => 'goods'
					);

					if (! $exist)
						{
						_add ('t_stock_planned_request', $planned_release);
						}
					else
						{
						_update ('t_stock_planned_request', $planned_release, array(
							"id" => $exist->id,
						));
						}
					}
				else
					{
					_hard_delete ('t_stock_planned_request', array(
						"item_id" => $get_data->item_id,
						"year" => date ('Y'),
						"week" => $i,
						"order_status" => 0
					));

					}

				_update ('t_material_movement', array(
					'planned_order_release' => $planned_order_receipt,
				), array(
					"item_id" => $get_data->item_id,
					"year" => date ('Y'),
					"week" => $i - 1
				));

				}

			$err = array(
				'show' => true,
				'type' => 'success',
				'msg' => 'Successfully update material movement.'
			);
			$this->session->set_flashdata ('toast', $err);

			redirect ('goods_management/stock_card_detail/' . _encrypt ($get_mat_detail->id));
			}
		}

	public function item_movement_detail()
		{
		$this->session->set_flashdata ('page_title', 'INVENTORY');
		$this->load->view ('goods-management/item-movement/index.php');
		}

	public function transactions()
		{
		$this->session->set_flashdata ('page_title', 'USAGE');
		$this->load->view ('goods-management/transactions.php');
		}

	public function export_goods_order_request()
		{
		ini_set ("max_execution_time", 0);

		$reader = IOFactory::createReader ('Xlsx');
		$spreadsheet = $reader->load ('assets/format/template_export_goods_order_request.xlsx');
		$spreadsheet->setActiveSheetIndexByName ('request_list');
		$sheet = $spreadsheet->getActiveSheet ();
		$index = 2;
		$getData = $this->db->query ("
		SELECT * FROM t_stock_planned_request 
		INNER JOIN m_vendor_material ON m_vendor_material.item_code = t_stock_planned_request.item_code
		INNER JOIN m_master_data_vendor ON m_master_data_vendor.vendor_code = t_stock_planned_request.vendor_code
		WHERE order_status = 0 and type = 'goods'
		")->result ();
		$userlist = $this->db->get ("m_employee")->result ();

		$area = $this->db->get_where ("m_employee_area", array(
			"nip" => $this->session->userdata ('user_nip'),
		))->row ();

		foreach ((array) $getData as $datas => $list)
			{
			// $sheet->insertNewRowBefore($index + 1, 1);
			$sheet->setCellValue ("A{$index}", trim (date ("Y-m-d", strtotime ($list->due_date))));
			$sheet->setCellValue ("B{$index}", trim ($list->status));
			// $sheet->setCellValue("C{$index}", trim($list->item_code));
			$sheet->setCellValue ("D{$index}", trim ($list->item_name));
			$sheet->setCellValue ("E{$index}", trim ($list->qty));
			$sheet->setCellValue ("F{$index}", trim ($list->uom));
			$sheet->setCellValue ("G{$index}", trim ($list->vendor_name));
			$sheet->setCellValue ("H{$index}", trim ($list->price_per_uom));
			$sheet->setCellValue ("I{$index}", trim ($list->price_per_uom * $list->moq));
			$sheet->setCellValue ("J{$index}", trim ($this->session->userdata ('user_email')));
			$sheet->setCellValue ("L{$index}", trim ($area->area_code));

			$styleArray = [
				'font' => [
					'name' => 'Calibri',
					'size' => 10
				],
				'alignment' => [
					'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
					'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
				]
			];

			$sheet->getStyle ("A{$index}:L{$index}")->applyFromArray ($styleArray);
			$index++;
			}

		$spreadsheet->setActiveSheetIndexByName ('user_list');
		$sheet = $spreadsheet->getActiveSheet ();
		$index = 2;
		$userlist = $this->db->query ("
			select nama, email, m_employee_area.area_code from m_employee
			INNER JOIN m_employee_area ON m_employee_area.nip = m_employee.nip
		")->result ();

		foreach ((array) $userlist as $datas => $list)
			{
			// $sheet->insertNewRowBefore($index + 1, 1);
			$sheet->setCellValue ("A{$index}", trim ($list->nama));
			$sheet->setCellValue ("B{$index}", trim ($list->email));
			$sheet->setCellValue ("C{$index}", trim ($list->area_code));

			$styleArray = [
				'font' => [
					'name' => 'Calibri',
					'size' => 10
				],
				'alignment' => [
					'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
					'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
				]
			];

			$sheet->getStyle ("A{$index}:C{$index}")->applyFromArray ($styleArray);
			$index++;
			}


		ob_end_clean ();
		$writer = new Xlsx($spreadsheet); // instantiate Xlsx
		header ('Content-type: application/vnd.ms-excel');
		// It will be called file.xls
		$filename = 'order_request_list' . date ('YmdHis');
		header ('Content-Disposition: attachment; filename="' . $filename . '.xlsx"');
		// Write file to the browser
		$writer->save ('php://output');
		}

	public function upload()
		{
		ini_set ("max_execution_time", 0);
		$path = 'assets/upload/order/';
		$json = [];
		$this->upload_config ($path);
		if (! $this->upload->do_upload ('file'))
			{
			$json = [
				'error_message' => $this->upload->display_errors (),
			];
			}
		else
			{
			$file_data = $this->upload->data ();
			$file_name = $path . $file_data['file_name'];
			$arr_file = explode ('.', $file_name);
			$extension = end ($arr_file);
			if ('csv' == $extension)
				{
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
				}
			else
				{
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
				}
			$spreadsheet = $reader->load ($file_name);
			$count_success = 0;
			$count_failed = 0;
			$list = [];

			//check uom
			$sheetData = $spreadsheet->getSheetbyName ('request_list');
			$cellRow = $spreadsheet->getSheetbyName ('request_list')->getHighestRow ();
			for ($i = 2; $i <= $cellRow; $i++)
				{
				$due_date = $sheetData->getCell ('A' . $i)->getValue ();
				$category = $sheetData->getCell ('B' . $i)->getValue ();
				$action_date = $sheetData->getCell ('C' . $i)->getValue ();
				$item = $sheetData->getCell ('D' . $i)->getValue ();
				$qty = $sheetData->getCell ('E' . $i)->getValue ();
				$uom = $sheetData->getCell ('F' . $i)->getValue ();
				$vendor_name = $sheetData->getCell ('G' . $i)->getValue ();
				$uom_price = $sheetData->getCell ('H' . $i)->getValue ();
				$total_price = $sheetData->getCell ('I' . $i)->getValue ();
				$requestor = $sheetData->getCell ('J' . $i)->getValue ();
				$requested_for = $sheetData->getCell ('K' . $i)->getValue ();
				$area = $sheetData->getCell ('L' . $i)->getValue ();
				$purchase_reason = trim ($sheetData->getCell ('M' . $i)->getValue ());
				$remarks = $sheetData->getCell ('N' . $i)->getValue ();

				if (! empty ($action_date) && ! empty ($requestor) && ! empty ($purchase_reason) && ! empty ($requested_for) && ! empty ($area))
					{
					$getVendor = $this->db->query ("SELECT * FROM m_master_data_vendor WHERE vendor_name LIKE '%$vendor_name%'")->row ();
					$check = $this->db->query ("SELECT * FROM t_stock_planned_request WHERE due_date >= ? AND vendor_code = ? AND item_name = ? AND qty = ? AND uom = ? AND order_status = 0 and type= 'goods'", array($due_date, $getVendor->vendor_code, $item, $qty, $uom))->row ();

					if (! empty ($check))
						{
						$planned_id = $check->id;
						$is_approved = 0;
						$is_feedback = 0;
						if ($purchase_reason == "Routine Buy")
							{
							$is_approval_required = 0;

							$order_status = "auto_approved";
							$is_approved = 1;
							}
						else
							{
							$is_approval_required = 1;
							$order_status = "waiting_approval";
							}

						$reqId = 'REQ' . date ("dmY");
						$getMax = $this->db->query ("SELECT MAX(id) as max FROM t_order")->row ()->max + 1;

						$request_id = $reqId . $getMax;

						$data = array(
							"date" => $action_date,
							"request_id" => $request_id,
							"requestor" => $requestor,
							"requested_for" => $requested_for,
							"area" => $area,
							"remarks" => $remarks,
							"status" => $order_status,
							"purchase_reason" => $purchase_reason,
							"is_approval_required" => $is_approval_required,
							"approved_by" => "auto_approved",
							"is_approved" => $is_approved,
							"is_feedback" => $is_feedback,
							"is_download" => 0,
							"planned_id" => $planned_id,
							// "rejected_by"			=> $this->input->post('rejected_by'),
							"approved_date" => date ("Y-m-d"),
							// "rejected_date"			=> $this->input->post('rejected_date'),
							"approved_remark" => 'Auto Approved by SGSS System - as per application recommendation',
							// "rejected_remark"		=> $this->input->post('rejected_remark'),
						);

						_add ("t_order", $data);

						_update ("t_stock_planned_request", array(
							"order_status" => 1
						), array("id" => $planned_id));

						$order = $this->db->get_where ("t_order", array(
							"planned_id" => $planned_id
						))->row ();



						_add ("t_order_detail", array(
							"order_id" => $order->id,
							"item" => $check->item_code,
							"qty" => $qty,
							"uom" => $uom,
							"vendor_code" => $getVendor->vendor_code,
							"uom_price" => $uom_price,
							"total_price" => $total_price,
							"status" => 0
						));

						$list[] = [
							"due_date" => $due_date,
							"category" => $category,
							"action_date" => $action_date,
							"item" => $item,
							"qty" => $qty,
							"uom" => $uom,
							"vendor" => $vendor_name,
							"uom_price" => $uom_price,
							"total_price" => $total_price,
							"requestor" => $requestor,
							"requested_for" => $requested_for,
							"area" => $area,
							"purchase_reason" => $purchase_reason,
							"remarks" => $remarks
						];
						}
					}
				}

			$html = 'Processing file finished.<br>';
			$html .= '
			<table id="example" class="table table-sm" cellspacing="0">
                      <thead>
                          <tr >
                              <th style="color: #fff;background-color: #001F82;text-align: center;font-size:12px;">Due Date</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;font-size:12px;">Category</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;font-size:12px;">Action Date</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;font-size:12px;">Item</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;font-size:12px;">Qty</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;font-size:12px;">UoM</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;font-size:12px;">Vendor</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;font-size:12px;">UoM Price</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;font-size:12px;">Total Price</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;font-size:12px;">Requestor</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;font-size:12px;">Requested For</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;font-size:12px;">Area</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;font-size:12px;">Purchase Reason</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;font-size:12px;">Remarks</th>                              
                          </tr>
                      </thead>
					  <tbody>			
			';
			foreach ($list as $k => $v)
				{
				$html .= '
					<tr>
						<td style="text-align: center;font-size:12px;">' . $v['due_date'] . '</td>
						<td style="text-align: center;font-size:12px;">' . $v['category'] . '</td>
						<td style="text-align: center;font-size:12px;">' . $v['action_date'] . '</td>
						<td style="text-align: center;font-size:12px;">' . $v['item'] . '</td>
						<td style="text-align: center;font-size:12px;">' . $v['qty'] . '</td>
						<td style="text-align: center;font-size:12px;">' . $v['uom'] . '</td>
						<td style="text-align: center;font-size:12px;">' . $v['vendor'] . '</td>
						<td style="text-align: center;font-size:12px;">' . $v['uom_price'] . '</td>
						<td style="text-align: center;font-size:12px;">' . $v['total_price'] . '</td>
						<td style="text-align: center;font-size:12px;">' . $v['requestor'] . '</td>
						<td style="text-align: center;font-size:12px;">' . $v['requested_for'] . '</td>
						<td style="text-align: center;font-size:12px;">' . $v['area'] . '</td>
						<td style="text-align: center;font-size:12px;">' . $v['purchase_reason'] . '</td>
						<td style="text-align: center;font-size:12px;">' . $v['remarks'] . '</td>
					</tr>
					';
				}
			$html .= '<tbody></table>';

			$msg = $html;

			if (file_exists ($file_name))
				unlink ($file_name);
			if (count ($list) > 0)
				{
				$result = true;
				if ($result)
					{
					$json = [
						'success_message' => $msg,
						'list' => $list,
					];
					}
				else
					{
					$json = [
						'error_message' => "Something went wrong while importing the data. Please check your excel file and try again.",
					];
					}
				}
			else
				{
				$json = [
					'success_message' => "Import completed. No new record is found on uploaded file.",
				];
				}
			}
		echo json_encode ($json);
		}

	public function upload_config($path)
		{
		if (! is_dir ($path))
			mkdir ($path, 0777, TRUE);
		$config['upload_path'] = './' . $path;
		$config['allowed_types'] = 'csv|CSV|xlsx|XLSX|xls|XLS';
		$config['max_filename'] = '255';
		$config['encrypt_name'] = TRUE;
		$config['max_size'] = 4096;
		$this->load->library ('upload', $config);
		}

	public function export_pdf($id = NULL)
		{
		$id = _decrypt ($this->uri->segment (3));

		$data = $this->goods_management_model->get_order_detail ($id);

		ini_set ('max_execution_time', '300');
		ini_set ("pcre.backtrack_limit", "5000000");
		$filename = 'Validation_Report_' . $data->request_id . "_" . date ('dmY');
		$mpdf = new \Mpdf\Mpdf(
			[
				'mode' => 'utf-8',
				'format' => 'A4-L',
				// 'margin_left' => 3,
				// 'margin_right' => 3,
				// 'margin_top' => 1,
				// 'margin_bottom' => 1,
			]
		);

		$html = '
		<html>
		<head>
		<style>
			
		span {
			font-family: Arial, Helvetica, sans-serif;  
			font-weight:bold;
			font-size:16px;
			line-height:0px;
			text-align:center;
		  }
		  table, th, thead {
			font-family: Arial, Helvetica, sans-serif;  
			font-size:8px;
		  }
		  
		  td {
			padding:5px;
			font-family: Arial, Helvetica, sans-serif;  
		  }
		  img {
			display: block;
			margin-left: auto;
			margin-right: auto;
		  }		  
		  .center {
			display: block;
			margin-left: auto;
			margin-right: auto;
		  }
		</style>
		</head>
		<body>
				<htmlpagefooter name="MyFooter1">
					<small style="text-align:left;font-size:10px;font-style:italic;">this validation report is generated from sgss application</small>
				</htmlpagefooter>
				<sethtmlpagefooter name="MyFooter1" value="on" />

				<div style="text-align:center;margin-bottom:20px;">
					<img style="text-align:center;" src="./assets/dist/images/logos/unilever-logo.png" height="50px" width="50px"><br>
					<span>SGSS - VALIDATION REPORT</span><br>
					<span>PT UNILEVER INDONESIA, Tbk</span><br>
				</div>	
				
				<div style="background-color:#87cdf0;width:100%;padding:5px;margin-bottom:5px;">
					<span>GENERAL INFORMATION</span>
				</div>

				<table width="100%" cellspacing="0" style="margin-bottom:10px;">
					<tr>
						<td style="text-align: left;font-size:12px;width:200px;">Date of Request</td>
						<td style="text-align: center;font-size:12px;width:50px;">:</td>
						<td style="text-align: left;font-size:12px;">' . mDate ($data->date) . '</td>
						<td style="text-align: left;font-size:12px;width:200px;">Requestor</td>
						<td style="text-align: center;font-size:12px;width:50px;">:</td>
						<td style="text-align: left;font-size:12px;">' . $data->requestor . '</td>
					</tr>
					<tr>
						<td style="text-align: left;font-size:12px;width:200px;">Requested For</td>
						<td style="text-align: center;font-size:12px;width:50px;">:</td>
						<td style="text-align: left;font-size:12px;">' . $data->requested_for_name . '</td>
						<td style="text-align: left;font-size:12px;width:200px;">Area</td>
						<td style="text-align: center;font-size:12px;width:50px;">:</td>
						<td style="text-align: left;font-size:12px;">' . $data->area . '</td>
					</tr>
					<tr>
						<td style="text-align: left;font-size:12px;width:200px;">Purchase Reason</td>
						<td style="text-align: center;font-size:12px;width:50px;">:</td>
						<td style="text-align: left;font-size:12px;">' . $data->purchase_reason . '</td>
						<td style="text-align: left;font-size:12px;width:200px;">Remarks</td>
						<td style="text-align: center;font-size:12px;width:50px;">:</td>
						<td style="text-align: left;font-size:12px;">' . $data->remarks . '</td>
					</tr>
				</table>
				<div style="background-color:#87cdf0;width:100%;padding:5px;margin-bottom:5px;">
					<span>ITEM INFORMATION</span>
				</div>
				<table width="100%" cellspacing="0" style="border: 1px solid #bac2bc;border-collapse: collapse;margin-bottom:10px;">
					<tr>
						<td style="text-align: center;font-size:12px;background-color:#bac2bc;font-weight:bold;border: 1px solid #bac2bc;">Item</td>
						<td style="text-align: center;font-size:12px;background-color:#bac2bc;font-weight:bold;border: 1px solid #bac2bc;">Quantity</td>
						<td style="text-align: center;font-size:12px;background-color:#bac2bc;font-weight:bold;border: 1px solid #bac2bc;">UoM</td>
						<td style="text-align: center;font-size:12px;background-color:#bac2bc;font-weight:bold;border: 1px solid #bac2bc;">Vendor</td>
						<td style="text-align: center;font-size:12px;background-color:#bac2bc;font-weight:bold;border: 1px solid #bac2bc;">UoM Price</td>
						<td style="text-align: center;font-size:12px;background-color:#bac2bc;font-weight:bold;border: 1px solid #bac2bc;">Total Price</td>
						<td style="text-align: center;font-size:12px;background-color:#bac2bc;font-weight:bold;border: 1px solid #bac2bc;">Purchase Reason</td>
					</tr>
					<tr>
						<td style="text-align: center;font-size:12px;border: 1px solid #bac2bc;">' . $data->item_name . ' ' . $data->size . ' ' . $data->uom . '</td>
						<td style="text-align: center;font-size:12px;border: 1px solid #bac2bc;">' . $data->qty . '</td>
						<td style="text-align: center;font-size:12px;border: 1px solid #bac2bc;">' . $data->uom . '</td>
						<td style="text-align: center;font-size:12px;border: 1px solid #bac2bc;">' . $data->vendor_code . ' - ' . $data->vendor_name . '</td>
						<td style="text-align: right;font-size:12px;border: 1px solid #bac2bc;">' . myNum ($data->uom_price) . '</td>
						<td style="text-align: right;font-size:12px;border: 1px solid #bac2bc;">' . myNum ($data->total_price) . '</td>
						<td style="text-align: center;font-size:12px;border: 1px solid #bac2bc;">' . $data->purchase_reason . '</td>
					</tr>
				</table>	
				
		';

		if ($data->request_status == 'approved' || $data->request_status == 'auto_approved')
			{
			$html .= '
				<div style="background-color:#87cdf0;width:100%;padding:5px;margin-bottom:5px;">
					<span>APPROVAL</span>
				</div>
				<table width="100%" cellspacing="0">
					<tr>
						<td style="text-align: left;font-size:12px;width:200px;border: 1px solid #bac2bc;">Date of Approval</td>
						<td style="text-align: left;font-size:12px;border: 1px solid #bac2bc;">: ' . mDate ($data->approval_date) . '</td>
						<td style="text-align: left;font-size:12px;width:200px;border: 1px solid #bac2bc;">Approved By</td>
						<td style="text-align: left;font-size:12px;border: 1px solid #bac2bc;">: ' . $data->approved_by . '</td>
						<td style="text-align: left;font-size:12px;width:250px;border: 1px solid #bac2bc;" rowspan="2">Approval Remarks:<br/>' . $data->approved_remark . '</td>
					</tr>
					<tr>
						<td style="text-align: center;font-size:20px;font-weight:bold;border: 1px solid #bac2bc;color:#046e19;" colspan="2">' . strtoupper (str_replace (" ", "_", $data->request_status)) . '</td>
						<td style="text-align: left;font-size:12px;width:200px;border: 1px solid #bac2bc;">As</td>
						<td style="text-align: left;font-size:12px;border: 1px solid #bac2bc;">: ' . $data->approve_by_title . '</td>
					</tr>
				</table>				
			</body>
			<pagebreak/>
			';
			}
		else
			{
			$html .= '
				<div style="background-color:#87cdf0;width:100%;padding:5px;margin-bottom:5px;">
					<span>REJECTED</span>
				</div>
				<table width="100%" cellspacing="0">
					<tr>
						<td style="text-align: left;font-size:12px;width:200px;border: 1px solid #bac2bc;">Date of Rejection</td>
						<td style="text-align: left;font-size:12px;border: 1px solid #bac2bc;">: ' . mDate ($data->rejected_date) . '</td>
						<td style="text-align: left;font-size:12px;width:200px;border: 1px solid #bac2bc;">Rejected By</td>
						<td style="text-align: left;font-size:12px;border: 1px solid #bac2bc;">: ' . $data->rejected_by . '</td>
						<td style="text-align: left;font-size:12px;width:250px;border: 1px solid #bac2bc;" rowspan="2">Rejected Remarks:<br/>' . $data->approved_remark . '</td>
					</tr>
					<tr>
						<td style="text-align: center;font-size:20px;font-weight:bold;border: 1px solid #bac2bc;color:#e60606;" colspan="2">' . strtoupper (str_replace (" ", "_", $data->request_status)) . '</td>
						<td style="text-align: left;font-size:12px;width:200px;border: 1px solid #bac2bc;">As</td>
						<td style="text-align: left;font-size:12px;border: 1px solid #bac2bc;">: ' . $data->approve_by_title . '</td>
					</tr>
				</table>				
			</body>
			<pagebreak/>
			';
			}

		$html .= '</html>';

		_update ("t_order", ["is_download" => 1], ["id" => $id]);

		$mpdf->SetDisplayMode (50);
		// $mpdf->SetFooter('');			
		$mpdf->WriteHTML ($html);
		$mpdf->Output ('assets/export/pdf/' . $filename . '.pdf', 'F');
		$fname = $filename . ".pdf";
		header ('Content-type: application/PDF');
		// It will be called file.xls
		header ("Content-Type: application/pdf");
		header ('Content-Disposition: attachment; filename="' . $fname . '"');
		// Write file to the browser
		$mpdf->Output ($fname, 'D');
		}
	}
