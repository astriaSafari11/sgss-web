<?php

class Service_management extends CI_Controller
	{

	public function __construct()
		{
		parent::__construct ();
		$this->load->model ('auth_model');
		$this->session->set_userdata ('session_created', time ());
		}

	public function index()
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
				$search = " AND " . $column_search . " LIKE '%" . $search . "%'";
				}
			else
				{
				$search = " AND " . $column_search . " " . $filter . " '" . $search . "'";
				}
			}

		$fSearch = ! empty ($search) ? $search . " AND order_status = 0 AND type = 'service'" : "WHERE order_status = 0 AND planned.type = 'service'";

		$query = $this->db->query ("
			select planned.* from t_stock_planned_request as planned
			INNER JOIN m_master_data_material as material ON planned.item_id = material.id
			where planned.type = 'service' and order_status = 0
			ORDER BY due_date DESC
			")->result ();
		$count = $this->db->get_where ('t_stock_planned_request', array("order_status" => 0, "type" => 'service'))->num_rows ();
		$feedback = $this->db->get_where ('t_order', array("is_approved" => 1, "is_feedback" => 0, "type" => 'service', "status" => 'approved'))->num_rows ();

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

		$this->session->set_flashdata ('page_title', 'SERVICE DASHBOARD');
		$this->load->view ('service-management/dashboard.php', $data);
		}
	public function feedback()
		{
		$query = $this->db->query (
			"select t_order.*, t_order.status as order_status, detail.*, m_master_data_vendor.vendor_name FROM t_order
			INNER JOIN t_order_detail as detail ON t_order.id = detail.order_id
			LEFT JOIN m_master_data_vendor ON detail.vendor_code = m_master_data_vendor.vendor_code
			WHERE t_order.type = 'service' and t_order.status != 'draft'
			ORDER by t_order.time_add  DESC"
		)->result ();

		// $query =  $this->db->get_where('t_stock_planned_request',array("order_status" => NULL))->result();

		$count = $this->db->get_where ('t_stock_planned_request', array("order_status" => 0, "type" => 'service'))->num_rows ();
		$feedback = $this->db->get_where ('t_order', array("is_approved" => 1, "is_feedback" => 0, "type" => 'service', "status" => 'approved'))->num_rows ();

		$data['feedback_list'] = $query;
		$data['req_count'] = $count;
		$data['feedback_count'] = $feedback;

		$this->session->set_flashdata ('page_title', 'SERVICE DASHBOARD');
		$this->load->view ('service-management/feedback.php', $data);
		}

	public function order_detail()
		{
		$id = _decrypt ($this->uri->segment (3));

		$data['order'] = $this->db->get_where ("t_order", array(
			"id" => $id
		))->row ();

		$data['order_detail'] = $this->db->query ("
		select t_order_detail.*, m_master_data_vendor.vendor_name from t_order_detail 
		LEFT JOIN m_master_data_vendor ON m_master_data_vendor.vendor_code = t_order_detail.vendor_code
		where t_order_detail.order_id = '$id' 
		")->result ();

		$data['order_approval'] = $this->db->query ("SELECT t_order_approval_track.*, m_employee.nama FROM t_order_approval_track
		LEFT JOIN m_employee ON t_order_approval_track.approve_by = m_employee.nip
		where order_id = '$id'")->result ();

		$curr_user = $this->auth_model->current_user ();
		$data['curr_user'] = $curr_user;

		$this->session->set_flashdata ('page_title', 'SERVICE ORDER DETAIL');
		$this->load->view ('service-management/order/detail.php', $data);
		}
	public function master_data()
		{
		$this->session->set_flashdata ('page_title', 'MASTER DATA SERVICE');
		$this->load->view ('service-management/master-data/index.php');
		}

	public function order()
		{

		$data['item'] = $this->db->get_where ('m_master_data_material', array('type' => 'service'))->result ();
		$data['vendor'] = $this->db->get_where ('m_master_data_vendor', array('is_active' => 1, 'type' => 'service'))->result ();
		$data['user'] = $this->db->get ('m_employee')->result ();
		$data['purchase_reason'] = $this->db->get_where ('m_purchase_reason', array('type' => 'service'))->result ();
		$data['area'] = $this->db->get_where ("m_employee_area", array(
			"nip" => $this->session->userdata ('user_nip'),
		))->row ();

		$this->session->set_flashdata ('page_title', 'SERVICE ORDER REQUEST');
		load_view ('service-management/order.php', $data);
		}
	public function create_order()
		{

		$id = _decrypt ($this->uri->segment (3));


		$exist = $this->db->get_where ("t_order", array(
			"planned_id" => $id,
		))->row ();

		if (! $exist)
			{
			$request_id = 'REQ' . date ("dmY") . rand (10000, 99999);
			$data = array(
				"date" => date ("Y-m-d"),
				"request_id" => $request_id,
				"order_category" => 'order',
				"status" => 'draft',
				"is_approved" => 1,
				"is_approval_required" => 0,
				"is_feedback" => 0,
				"is_download" => 0,
				"type" => 'service',
				'planned_id' => $id
			);

			_add ('t_order', $data);

			$order = $this->db->get_where ('t_order', array('request_id' => $request_id))->row ();
			$item = $this->db->get_where ('t_stock_planned_request', array('id' => $id))->row ();

			$detail = array(
				"order_id" => $order->id,
				"item_id" => $item->item_id,
				"item_code" => $item->item_code,
				"item_name" => $item->item_name,
				"service_type" => $item->service_category,
				"vendor_code" => $item->vendor_code,
			);

			_add ('t_order_detail', $detail);

			$data['order'] = $order;
			$data['detail'] = $this->db->get_where ('t_order_detail', array('order_id' => $order->id))->row ();
			}
		else
			{
			$data['order'] = $exist;
			$data['detail'] = $this->db->get_where ('t_order_detail', array('order_id' => $exist->id))->row ();
			}
		$data['item'] = $this->db->get_where ('m_master_data_material', array('type' => 'service'))->result ();
		$data['vendor'] = $this->db->get_where ('m_master_data_vendor', array('is_active' => 1, 'type' => 'service'))->result ();
		$data['user'] = $this->db->get ('m_employee')->result ();
		$data['purchase_reason'] = $this->db->get_where ('m_purchase_reason', array('type' => 'service'))->result ();
		$data['area'] = $this->db->get_where ("m_employee_area", array(
			"nip" => $this->session->userdata ('user_nip'),
		))->row ();

		$this->session->set_flashdata ('page_title', 'SERVICE ORDER REQUEST');
		load_view ('service-management/order.php', $data);
		}

	public function submit_order()
		{
		if (isset ($_POST['submit']))
			{
			$id = $this->input->post ('order_id');

			if (! empty ($id))
				{

				$order = $this->db->get_where ('t_order', array('id' => $id))->row ();
				$data = array(
					"date" => date ("Y-m-d"),
					"period_start" => date ("Y-m-d", strtotime ($this->input->post ('period_start'))),
					"period_end" => date ("Y-m-d", strtotime ($this->input->post ('period_end'))),
					"shift" => $this->input->post ('shift'),
					"request_id" => $order->request_id,
					"requestor" => $this->session->userdata ('user_name'),
					"requestor_nip" => $this->session->userdata ('user_nip'),
					"requested_for" => $this->input->post ('requested_for'),
					"area" => $this->input->post ('area'),
					"remarks" => $this->input->post ('remarks'),
					"order_category" => 'order',
					"status" => 'approved',
					"purchase_reason" => $this->input->post ('usage_reason'),
					"is_approved" => 1,
					"is_approval_required" => 0,
					"is_feedback" => 0,
					"is_download" => 0,
					"type" => 'service'
				);

				_update ("t_order", $data, array('id' => $id));

				$item = $this->input->post ('item');
				$qty = $this->input->post ('qty');
				$uom = $this->input->post ('uom');
				$uom_price = $this->input->post ('unit_price');
				$sub_total = $this->input->post ('sub_total');
				$tax = $this->input->post ('tax');
				$total_price = $this->input->post ('total');
				$vendor_code = $this->input->post ('vendor');

				for ($i = 0; $i < count ($item); $i++)
					{
					$getItem = $this->db->get_where ('m_master_data_material', array('id' => $item[$i]))->row ();
					$check = $this->db->get_where ('t_order_detail', array('order_id' => $order->id, 'item_id' => $item[$i]))->row ();

					$detail = array(
						"order_id" => $order->id,
						"item_id" => $getItem->id,
						"item_code" => $getItem->item_code,
						"item_name" => $getItem->item_name,
						"service_type" => $getItem->service_category,
						"qty" => $qty[$i],
						"uom" => $uom[$i],
						"uom_price" => str_replace (',', '', $uom_price[$i]),
						"sub_total" => str_replace (',', '', $sub_total[$i]),
						"tax" => $tax[$i],
						"total_price" => str_replace (',', '', $total_price[$i]),
						"vendor_code" => $vendor_code[$i],
					);

					if (! $check)
						{
						_add ('t_order_detail', $detail);
						}
					else
						{
						_update ("t_order_detail", $detail, array('id' => $check->id));
						}
					}

				_update ("t_stock_planned_request", array('order_status' => 1), array('id' => $order->planned_id));
				}
			else
				{
				$request_id = 'REQ' . date ("dmY") . rand (10000, 99999);
				$data = array(
					"date" => date ("Y-m-d"),
					"period_start" => date ("Y-m-d", strtotime ($this->input->post ('period_start'))),
					"period_end" => date ("Y-m-d", strtotime ($this->input->post ('period_end'))),
					"shift" => $this->input->post ('shift'),
					"request_id" => $request_id,
					"requestor" => $this->session->userdata ('user_name'),
					"requestor_nip" => $this->session->userdata ('user_nip'),
					"requested_for" => $this->input->post ('requested_for'),
					"area" => $this->input->post ('area'),
					"remarks" => $this->input->post ('remarks'),
					"order_category" => 'order',
					"status" => 'approved',
					"purchase_reason" => $this->input->post ('usage_reason'),
					"is_approved" => 1,
					"is_approval_required" => 0,
					"is_feedback" => 0,
					"is_download" => 0,
					"type" => 'service'
				);

				_add ('t_order', $data);

				$order = $this->db->get_where ('t_order', array('request_id' => $request_id))->row ();

				$item = $this->input->post ('item');
				$qty = $this->input->post ('qty');
				$uom = $this->input->post ('uom');
				$uom_price = $this->input->post ('unit_price');
				$sub_total = $this->input->post ('sub_total');
				$tax = $this->input->post ('tax');
				$total_price = $this->input->post ('total');
				$vendor_code = $this->input->post ('vendor');

				for ($i = 0; $i < count ($item); $i++)
					{
					$getItem = $this->db->get_where ('m_master_data_material', array('id' => $item[$i]))->row ();
					$detail = array(
						"order_id" => $order->id,
						"item_id" => $getItem->id,
						"item_code" => $getItem->item_code,
						"item_name" => $getItem->item_name,
						"service_type" => $getItem->service_category,
						"qty" => $qty[$i],
						"uom" => $uom[$i],
						"uom_price" => str_replace (',', '', $uom_price[$i]),
						"sub_total" => str_replace (',', '', $sub_total[$i]),
						"tax" => $tax[$i],
						"total_price" => str_replace (',', '', $total_price[$i]),
						"vendor_code" => $vendor_code[$i],
					);

					_add ('t_order_detail', $detail);

					}
				}
			$err = array(
				'show' => true,
				'type' => 'success',
				'msg' => 'Successfully Submit Service Order Request'
			);
			$this->session->set_flashdata ('toast', $err);

			redirect ('service_management');
			}
		}

	public function ignore_request()
		{
		if (isset ($_POST['submit']))
			{
			$request_id = 'REQ' . date ("dmY") . rand (10000, 99999);
			$data = array(
				"date" => date ("Y-m-d"),
				"period_start" => date ("Y-m-d"),
				"period_end" => date ("Y-m-d"),
				"shift" => '',
				"request_id" => $request_id,
				"requestor" => $this->session->userdata ('user_name'),
				"requestor_nip" => $this->session->userdata ('user_nip'),
				"requested_for" => $this->input->post ('requested_for'),
				"area" => $this->input->post ('area'),
				"remarks" => $this->input->post ('ignore_remarks'),
				"order_category" => 'ignore',
				"status" => 'ignored',
				"purchase_reason" => 'Request Ignored',
				"is_approved" => 1,
				"is_approval_required" => 0,
				"is_feedback" => 0,
				"is_download" => 0,
				"type" => 'service'
			);

			_add ('t_order', $data);

			$order = $this->db->get_where ('t_order', array('request_id' => $request_id))->row ();
			$item = $this->db->get_where ('t_stock_planned_request', array('id' => $this->input->post ('order_id')))->row ();

			$detail = array(
				"order_id" => $order->id,
				"item_id" => $item->item_id,
				"item_code" => $item->item_code,
				"item_name" => $item->item_name,
				"service_type" => $item->service_category,
				"qty" => 0,
				"uom" => '',
				"uom_price" => 0,
				"sub_total" => 0,
				"tax" => 0,
				"total_price" => 0,
				"vendor_code" => $item->vendor_code,
			);

			_add ('t_order_detail', $detail);

			$err = array(
				'show' => true,
				'type' => 'success',
				'msg' => 'Successfully Ignored Service Order Request'
			);
			$this->session->set_flashdata ('toast', $err);

			redirect ('service_management');
			}
		}
	public function feedback_update()
		{
		$id = _decrypt ($this->uri->segment (3));

		$po_gr = $this->input->post ('po_gr_number');
		$po_gr_amount = $this->input->post ('po_gr_amount');
		$is_feedback = 1;
		$week = date ('W');

		_update ("t_order", array(
			"is_feedback" => $is_feedback,
			"status" => 'finished',
			"po_gr_number" => $po_gr,
			"po_gr_amount" => $po_gr_amount,
			"feedback_date" => date ("Y-m-d"),
			"feedback_by" => $this->session->userdata ('user_name')
		), array("id" => $id));

		redirect ('service_management/order_detail/' . _encrypt ($id));
		}
	public function generate_service_order()
		{

		$get_service = $this->db->get_where ("m_master_data_material", array(
			"type" => 'service',
			"is_active" => 1
		))->result ();

		foreach ($get_service as $item)
			{
			// First date of current month
			$firstDay = date ('Y-m-01'); // e.g., 2025-05-01

			// Last date of current month
			$lastDay = date ('Y-m-t');   // e.g., 2025-05-31


			$dates = generateRecurringDates ($firstDay, $lastDay, $item->service_recurring);

			foreach ($dates as $date)
				{
				$format = $date;

				$thisMonth = (new DateTime("this month"))->format ($format);

				$exist = $this->db->get_where ("t_stock_planned_request", array(
					"item_id" => $item->id,
					"due_date" => $date,
				))->row ();

				if (! $exist)
					{
					_add ("t_stock_planned_request", array(
						"item_id" => $item->id,
						"item_code" => $item->item_code,
						"item_name" => $item->item_name,
						"qty" => 0,
						"uom" => '',
						"due_date" => $thisMonth,
						"until_due_date" => $date,
						"type" => 'service',
						"order_status" => 0,
					));

					}
				}
			}
		}

	public function requirement_calculation()
		{
		$this->session->set_flashdata ('page_title', 'VARIABLE VALIDATION');
		load_view ('service-management/requirement_calculation.php', array());
		}

	public function absenteeism()
		{
		$this->session->set_flashdata ('page_title', 'FIXED VALIDATION');
		load_view ('service-management/absenteeism.php', array());
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

		$order = $this->db->get_where ("t_order", array(
			"id" => $id
		))->row ();

		$data = $this->db->query ("
		select t_order_detail.*, m_master_data_vendor.vendor_name from t_order_detail 
		LEFT JOIN m_master_data_vendor ON m_master_data_vendor.vendor_code = t_order_detail.vendor_code
		where t_order_detail.order_id = '$id'
		")->row ();

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
						<td style="text-align: left;font-size:12px;width:200px;">Period Start</td>
						<td style="text-align: center;font-size:12px;width:50px;">:</td>
						<td style="text-align: left;font-size:12px;">' . mDate ($order->period_start) . '</td>
						<td style="text-align: left;font-size:12px;width:200px;">Period End</td>
						<td style="text-align: center;font-size:12px;width:50px;">:</td>
						<td style="text-align: left;font-size:12px;">' . mDate ($order->period_end) . '</td>
					</tr>				
					<tr>
						<td style="text-align: left;font-size:12px;width:200px;">Shift</td>
						<td style="text-align: center;font-size:12px;width:50px;">:</td>
						<td style="text-align: left;font-size:12px;">' . $order->shift . '</td>
						<td style="text-align: left;font-size:12px;width:200px;">Requestor</td>
						<td style="text-align: center;font-size:12px;width:50px;">:</td>
						<td style="text-align: left;font-size:12px;">' . $order->requestor . '</td>
					</tr>
					<tr>
						<td style="text-align: left;font-size:12px;width:200px;">Requested For</td>
						<td style="text-align: center;font-size:12px;width:50px;">:</td>
						<td style="text-align: left;font-size:12px;">' . $order->requested_for_name . '</td>
						<td style="text-align: left;font-size:12px;width:200px;">Area</td>
						<td style="text-align: center;font-size:12px;width:50px;">:</td>
						<td style="text-align: left;font-size:12px;">' . $order->area . '</td>
					</tr>
					<tr>
						<td style="text-align: left;font-size:12px;width:200px;">Usage Reason</td>
						<td style="text-align: center;font-size:12px;width:50px;">:</td>
						<td style="text-align: left;font-size:12px;">' . $order->purchase_reason . '</td>
						<td style="text-align: left;font-size:12px;width:200px;">Remarks</td>
						<td style="text-align: center;font-size:12px;width:50px;">:</td>
						<td style="text-align: left;font-size:12px;">' . $order->remarks . '</td>
					</tr>
					<tr>
						<td style="text-align: left;font-size:12px;width:200px;">PO GR</td>
						<td style="text-align: center;font-size:12px;width:50px;">:</td>
						<td style="text-align: left;font-size:12px;">' . $order->po_gr_number . '</td>
						<td style="text-align: left;font-size:12px;width:200px;">PO GR AMOUNT</td>
						<td style="text-align: center;font-size:12px;width:50px;">:</td>
						<td style="text-align: left;font-size:12px;">' . myNum ($order->po_gr_amount) . '</td>
					</tr>											
				</table>
				<div style="background-color:#87cdf0;width:100%;padding:5px;margin-bottom:5px;">
					<span>ITEM INFORMATION</span>
				</div>
				<table width="100%" cellspacing="0" style="border: 1px solid #bac2bc;border-collapse: collapse;margin-bottom:10px;">
                        <tr>
                            <th style="color: #001F82;background-color:#DAEAFF;text-align: center;">Vendor</th>
                            <th style="color: #001F82;background-color:#DAEAFF;text-align: center;">Type of Service</th>
                            <th style="color: #001F82;background-color:#DAEAFF;text-align: center;">Service Category
                            </th>
                            <th style="color: #001F82;background-color:#DAEAFF;text-align: center;">Unit Price</th>
                            <th style="color: #001F82;background-color:#DAEAFF;text-align: center;">Qty</th>
                            <th style="color: #001F82;background-color:#DAEAFF;text-align: center;">UoM</th>
                            <th style="color: #001F82;background-color:#DAEAFF;text-align: center;">Subtotal</th>
                            <th style="color: #001F82;background-color:#DAEAFF;text-align: center;">Tax / VAT</th>
                            <th style="color: #001F82;background-color:#DAEAFF;text-align: center;">Total</th>
                        </tr>
					<tr>
						<td style="text-align: center;font-size:12px;border: 1px solid #bac2bc;">' . $data->vendor_name . '</td>
						<td style="text-align: center;font-size:12px;border: 1px solid #bac2bc;">' . $data->item_name . '</td>
						<td style="text-align: center;font-size:12px;border: 1px solid #bac2bc;">' . $data->service_type . '</td>
						<td style="text-align: right;font-size:12px;border: 1px solid #bac2bc;">' . myNum ($data->uom_price) . '</td>
						<td style="text-align: center;font-size:12px;border: 1px solid #bac2bc;">' . $data->qty . '</td>
						<td style="text-align: center;font-size:12px;border: 1px solid #bac2bc;">' . $data->uom . '</td>
						<td style="text-align: right;font-size:12px;border: 1px solid #bac2bc;">' . myNum ($data->sub_total) . '</td>
						<td style="text-align: right;font-size:12px;border: 1px solid #bac2bc;">' . myNum ($data->tax) . '</td>
						<td style="text-align: right;font-size:12px;border: 1px solid #bac2bc;">' . myNum ($data->total) . '</td>
					</tr>
				</table>	
				
		';

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
