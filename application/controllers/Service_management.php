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
				$search = " WHERE " . $column_search . " LIKE '%" . $search . "%'";
				}
			else
				{
				$search = " WHERE " . $column_search . " " . $filter . " '" . $search . "'";
				}
			}

		$fSearch = ! empty ($search) ? $search . " AND order_status = 0 AND type = 'service'" : "WHERE order_status = 0 AND planned.type = 'service'";

		$query = $this->db->query ("
		SELECT planned.*, material.service_urgent_if
		FROM t_stock_planned_request as planned
		INNER JOIN m_master_data_material as material ON material.item_code = planned.item_code
		$fSearch")->result ();
		$count = $this->db->get_where ('t_stock_planned_request', array("order_status" => 0, "type" => 'service'))->num_rows ();
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

		$this->session->set_flashdata ('page_title', 'SERVICE DASHBOARD');
		$this->load->view ('service-management/dashboard.php', $data);
		}

	public function master_data()
		{
		$this->session->set_flashdata ('page_title', 'MASTER DATA SERVICE');
		$this->load->view ('service-management/master-data/index.php');
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
