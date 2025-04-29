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

		$query = $this->db->query ("SELECT * from t_order  INNER JOIN t_order_detail ON t_order_detail.order_id = t_order.id where type = 'service'")->result ();
		$count = $this->db->get_where ('t_stock_planned_request', array("order_status" => 0, "type" => 'service'))->num_rows ();
		$feedback = $this->db->get_where ('t_order', array("is_feedback" => 0))->num_rows ();

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

	public function master_data()
		{
		$this->session->set_flashdata ('page_title', 'MASTER DATA SERVICE');
		$this->load->view ('service-management/master-data/index.php');
		}

	public function order()
		{

		$data['item'] = $this->db->get_where ('m_master_data_material', array('type' => 'service'))->result ();
		$data['vendor'] = $this->db->get_where ('m_master_data_vendor', array('is_active' => 1))->result ();
		$data['user'] = $this->db->get ('m_employee')->result ();
		$data['purchase_reason'] = $this->db->get ("m_purchase_reason")->result ();
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
				"status" => 'submitted',
				"purchase_reason" => $this->input->post ('usage_reason'),
				"is_approval_required" => 0,
				"is_feedback" => 0,
				"is_download" => 0,
				"type" => 'service'
			);

			_add ('t_order', $data);

			$order = $this->db->get_where ('t_order', array('request_id' => $request_id))->row ();
			$item = $this->db->get_where ('m_master_data_material', array('id' => $this->input->post ('item')))->row ();

			$detail = array(
				"order_id" => $order->id,
				"item_id" => $this->input->post ('item'),
				"item_code" => $item->item_code,
				"item_name" => $item->item_name,
				"service_type" => $item->service_category,
				"qty" => $this->input->post ('qty'),
				"uom" => $this->input->post ('uom'),
				"uom_price" => $this->input->post ('unit_price'),
				"sub_total" => $this->input->post ('sub_total'),
				"tax" => $this->input->post ('tax'),
				"total_price" => $this->input->post ('vendor_code'),
			);

			_add ('t_order_detail', $detail);

			$err = array(
				'show' => true,
				'type' => 'success',
				'msg' => 'Successfully Submit Service Order Request'
			);
			$this->session->set_flashdata ('toast', $err);

			redirect ('service_management');
			}
		}

	public function generate_service_order()
		{
		$get_service = $this->db->get_where ("m_master_data_material", array(
			"type" => 'service',
			"is_active" => 1
		))->result ();

		foreach ($get_service as $item)
			{

			$format = 'Y-m-' . $item->service_due_date;

			$thisMonth = (new DateTime("this month"))->format ($format);

			_add ("t_stock_planned_request", array(
				"item_code" => $item->item_code,
				"item_name" => $item->item_name,
				"qty" => 10,
				"uom" => 'ppl',
				"due_date" => $thisMonth,
				"until_due_date" => $item->until_due_date,
				"type" => 'service',
				"order_status" => 0,
			));
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
	}
