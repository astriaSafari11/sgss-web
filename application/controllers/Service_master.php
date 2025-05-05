<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Service_master extends CI_Controller
	{

	public function __construct()
		{
		parent::__construct ();
		$this->load->model ('auth_model');
		$this->load->model ('master_model');
		$this->load->model ('gross_req_model');
		$this->load->model ('service_master_model');
		$this->session->set_userdata ('session_created', time ());
		if (! $this->auth_model->current_user ())
			{
			redirect ('auth/login');
			}
		}

	public function index()
		{
		$this->session->set_flashdata ('page_title', 'MASTER DATA SERVICE');
		$this->load->view ('service_management/master_data/index.php');
		}

	public function vendor_list()
		{
		$this->session->set_flashdata ('page_title', 'SERVICE MASTER DATA VENDOR');
		$this->load->view ('service-management/master-data/vendor/index.php');
		}
	public function search_material()
		{

		if (isset ($_POST['reset']))
			{
			$this->session->set_userdata ('search_material', array());
			}
		else
			{
			$search = array(
				'column_search' => $this->input->post ('column_search'),
				'column_filter' => $this->input->post ('column_filter'),
				'keyword' => $this->input->post ('keyword'),
			);
			$this->session->set_userdata ('search_material', $search);
			}
		}
	public function material_list()
		{
		$data['column_search'] = array(
			'factory',
			'item_code',
			'item_name',
			'item_group',
			'size',
			'uom',
			'lot_size',
			'order_cycle',
		);

		$this->session->unset_userdata ('search_material');
		$this->session->set_flashdata ('page_title', 'MASTER DATA ITEM');
		$this->load->view ('master-data/material-list.php', $data);
		}

	public function usage_reason()
		{
		$data['column_search'] = array(
			'purchase_reason',
			'type',
		);
		$this->session->unset_userdata ('search_material');
		$this->session->set_flashdata ('page_title', 'MASTER DATA PURCHASE REASON');
		$this->load->view ('service-management/master-data/purchase_reason/index.php', $data);
		}

	function get_purchase_reason()
		{
		$search = $this->session->userdata ('search_material');
		$list = $this->service_master_model->get_datatables ($search, 'purchase_reason');
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field)
			{
			$edit = '
			<a href="#" class="btn btn-outline-primary">
				<i class="fa-solid fa-circle-info"></i>						
			</a>';

			$row = array();

			$row[] = ++$no;
			$row[] = $field->id;
			$row[] = $field->type;
			$row[] = $field->purchase_reason;
			$row[] = $edit;

			$data[] = $row;
			}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->master_model->count_all ($search, 'purchase_reason'),
			"recordsFiltered" => $this->master_model->count_filtered ($search, 'purchase_reason'),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode ($output);
		}

	function get_master_vendor()
		{
		$search = $this->session->userdata ('search');
		$list = $this->service_master_model->get_datatables ($search, 'vendor');
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field)
			{
			$edit = '
					<a href="" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">
						<i class="fa-solid fa-circle-info"></i>						
					</a>';
			$link = '
					<a href="' . $field->link . '" class="btn btn-outline-primary" target="_blank" data-toggle="tooltip" data-placement="top" title="Link">
						<i class="fa-solid fa-up-right-from-square"></i>		
					</a>';

			$row = array();
			$row[] = ++$no;
			$row[] = $field->vendor_code;
			$row[] = $field->category;
			$row[] = $field->vendor_name;
			$row[] = $field->rating;
			$row[] = 0;
			$row[] = $field->item_name;
			$row[] = $field->uom;
			$row[] = myNum ($field->lt_po_deliv);
			$row[] = myNum ($field->moq);
			$row[] = myCurr ($field->price_per_uom);
			$row[] = myCurr ($field->moq * $field->price_per_uom);
			$row[] = myCurr ($field->moq * $field->price_per_uom);
			$row[] = ! empty ($field->moq) && $field->moq != 0 ? myCurr (($field->moq * $field->price_per_uom) / $field->moq) : 0;
			$row[] = myDecimal ($field->saving);
			$row[] = $field->place_to_buy;
			$row[] = $link;
			$row[] = $edit;
			$data[] = $row;
			}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->master_model->count_all ($search, 'vendor'),
			"recordsFiltered" => $this->master_model->count_filtered ($search, 'vendor'),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode ($output);
		}
	function get_master_material()
		{
		$search = $this->session->userdata ('search_material');
		$list = $this->master_model->get_datatables ($search, 'material');
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field)
			{
			$edit = '
					<a href="' . site_url ('master_data/detail_material/' . _encrypt ($field->id)) . '" class="btn btn-sm btn-outline-primary" style="font-weight: 600; border-radius: 50px;margin-right:5px;">
						<i class="fa-solid fa-info-circle"></i>
						Detail
					</a>
					<div class="modal fade" id="modal-delete-' . $field->id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel" class="text-primary" style="color: #001F82;font-weight:600;">Delete Material</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body" style="text-align: left;">
									<p>You are going to delete material ' . $field->item_code . ' - ' . $field->item_name . ', all data related with this material will be deleted. Are you sure?</p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">No, Cancel Delete.</button>
									<a href="' . site_url ('master_data/delete_material?id=' . _encrypt ($field->id)) . '" type="button" class="btn btn-outline-danger">Yes, Delete Data.</a>
								</div>
							</div>
						</div>
					</div>					
				  ';

			$row = array();
			$row[] = ++$no;
			$row[] = $field->factory;
			$row[] = $field->item_code . "-" . sprintf ("%02d", $field->item_number);
			$row[] = $field->item_name;
			$row[] = $field->item_group;
			$row[] = $field->size;
			$row[] = $field->size_uom;
			$row[] = $field->uom;
			$row[] = $field->lot_size;
			$row[] = $field->initial_stock;
			$row[] = $field->order_cycle;
			$row[] = myNum ($field->standard_safety_stock);
			$row[] = myNum ($field->lt_pr_po);
			$row[] = myNum ($field->lt_pr_to_deliv);
			$row[] = myNum ($field->gen_lead_time);
			$row[] = $edit;
			$data[] = $row;
			}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->master_model->count_all ($search, 'material'),
			"recordsFiltered" => $this->master_model->count_filtered ($search, 'material'),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode ($output);
		}

	function get_master_vendor_list()
		{
		$search = $this->session->userdata ('search');
		$list = $this->service_master_model->get_datatables ($search, 'vendor_list');
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field)
			{
			$edit = '
					<a href="' . site_url ('service_master/vendor_detail/' . _encrypt ($field->id)) . '" class="btn btn-outline-primary">
						<i class="fa-solid fa-circle-info"></i>						
					</a>';

			$row = array();
			$row[] = ++$no;
			$row[] = $field->vendor_code;
			$row[] = $field->vendor_name;
			$row[] = $field->vendor_location;
			$row[] = $field->vendor_channel;
			$row[] = ! empty ($field->additional_margin) ? $field->additional_margin : '-';
			$row[] = ! empty ($field->last_transaction) ? $field->last_transaction : '-';
			$row[] = $field->validity;
			$row[] = $field->category;
			$row[] = ! empty ($field->total_spend_ytd) ? $field->total_spend_ytd : '-';
			$row[] = ! empty ($field->last_year_spend) ? $field->last_year_spend : '-';
			$row[] = $field->est_lead_time;
			$row[] = $field->rating;
			$row[] = $edit;
			$data[] = $row;
			}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->master_model->count_all ($search, 'vendor_list'),
			"recordsFiltered" => $this->master_model->count_filtered ($search, 'vendor_list'),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode ($output);
		}
	public function add_vendor()
		{
		$this->session->set_flashdata ('page_title', 'FORM ADD NEW VENDOR');
		$this->load->view ('service-management/master-data/vendor/add-form.php');
		}
	public function add_purchase_reason()
		{
		$this->session->set_flashdata ('page_title', 'FORM ADD NEW PURCHASE REASON');
		$this->load->view ('master-data/purchase-reason/add-form.php');
		}
	public function save_purchase_reason()
		{
		$exist = $this->db->get_where ("m_purchase_reason", array(
			"purchase_reason" => $this->input->post ('purchase_reason'),
			"type" => $this->input->post ('type'),
		))->row ();

		if ($exist)
			{
			$err = array(
				'show' => true,
				'type' => 'error',
				'msg' => 'Add new purchase reason failed.'
			);
			$this->session->set_flashdata ('toast', $err);
			echo 0;
			}
		else
			{
			$inserted = _add (
				"m_purchase_reason",
				array(
					"purchase_reason" => $this->input->post ('purchase_reason'),
					"type" => 'service',
					"is_approval" => 0,
					"WL_approval" => '',
				)
			);

			if ($inserted)
				{
				$err = array(
					'show' => true,
					'type' => 'success',
					'msg' => 'Successfully added new purchase reason.'
				);
				$this->session->set_flashdata ('toast', $err);
				echo 1;
				}
			else
				{
				$err = array(
					'show' => true,
					'type' => 'error',
					'msg' => 'Add new purchase reason failed.'
				);
				$this->session->set_flashdata ('toast', $err);
				echo 1;
				}
			}

		echo 1;
		}

	public function update_purchase_reason()
		{
		if (isset ($_POST['submit']))
			{

			$id = $this->input->post ('id');
			$exist = $this->db->get_where ('m_category', array("category_name" => $id))->row ();
			$inserted = _update (
				"m_category",
				array(
					"category_name" => $this->input->post ('category_name'),
				),
				array("category_name" => $exist->category_name)
			);

			if ($inserted)
				{
				$err = array(
					'show' => true,
					'type' => 'success',
					'msg' => 'Successfully update uom data.'
				);
				$this->session->set_flashdata ('toast', $err);
				}
			else
				{
				$err = array(
					'show' => true,
					'type' => 'error',
					'msg' => 'Update data failed.'
				);
				$this->session->set_flashdata ('toast', $err);
				}
			redirect ('master_data/category_list/');
			}
		}
	public function delete_purchase_reason()
		{
		$id = _decrypt ($this->input->get ('id'));
		$deleted = _hard_delete ("m_category", array("category_name" => $id));

		if ($deleted)
			{
			$err = array(
				'show' => true,
				'type' => 'error',
				'msg' => 'Successfully delete category data.'
			);
			$this->session->set_flashdata ('toast', $err);
			}
		else
			{
			$err = array(
				'show' => true,
				'type' => 'error',
				'msg' => 'Delete category failed.'
			);
			$this->session->set_flashdata ('toast', $err);
			}
		redirect ('master_data/category_list');
		}
	public function save_vendor()
		{
		if (isset ($_POST['submit']))
			{
			$vendor_code = $this->input->post ('vendor_code');
			$exist = $this->db->get_where ("m_master_data_vendor", array(
				"vendor_code" => $this->input->post ('vendor_code'),
			))->row ();

			$get_max_id = $this->db->query ("select max(id) as id from m_master_data_vendor")->row ();

			$vendorCode = 'VND' . sprintf ('%04s', $get_max_id->id + 1);
			if ($exist)
				{
				$err = array(
					'show' => true,
					'type' => 'error',
					'msg' => 'Add new vendor failed. Vendor with code ' . $vendorCode . ' is already exist.'
				);
				$this->session->set_flashdata ('toast', $err);
				$this->load->view ('service-management/master-data/vendor/add-form.php');
				}
			else
				{
				$inserted = _add (
					"m_master_data_vendor",
					array(
						"vendor_code" => $vendorCode,
						"vendor_name" => $this->input->post ('vendor_name'),
						"vendor_location" => $this->input->post ('vendor_location'),
						"est_lead_time" => $this->input->post ('est_lead_time'),
						"vendor_channel" => $this->input->post ('vendor_channel'),
						"additional_margin" => $this->input->post ('additional_margin'),
						"validity" => $this->input->post ('validity'),
						"category" => $this->input->post ('category'),
						"rating" => $this->input->post ('rating'),
						"type" => 'service'
					)
				);
				if ($inserted)
					{
					$err = array(
						'show' => true,
						'type' => 'success',
						'msg' => 'Successfully added new vendor.'
					);
					$this->session->set_flashdata ('toast', $err);
					}
				else
					{
					$err = array(
						'show' => true,
						'type' => 'error',
						'msg' => 'Add new vendor failed.'
					);
					$this->session->set_flashdata ('toast', $err);
					}
				}
			redirect ('service_master/vendor_list');
			}
		else
			{
			redirect ('service_master/vendor_list');
			}
		}

	public function vendor_detail()
		{
		$vendor_code = _decrypt ($this->uri->segment (3));
		$data['vendor'] = $this->db->get_where ("m_master_data_vendor", array(
			"id" => $vendor_code,
		))->row ();
		$data['item_list'] = $this->db->query ("select * from m_master_data_material WHERE type='service'")->result ();
		// debugCode($data);

		$this->session->set_flashdata ('page_title', 'FORM DETAIL VENDOR');
		load_view ('service-management/master-data/vendor/detail.php', $data);
		// debugCode(_decrypt($vendor_code));
		}

	function get_material_list_by_vendor()
		{
		$search = $this->session->userdata ('search');
		$list = $this->service_master_model->get_datatables (array(
			"vendor_code" => _decrypt ($this->input->get ('id'))
		), 'vendor');

		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field)
			{
			$link = '
				<a href="' . $field->link . '" class="btn btn-sm btn-outline-primary" target="_blank" data-bs-toggle="tooltip" data-bs-title="' . $field->link . '">
					<i class="fa-solid fa-up-right-from-square"></i>		
				</a>';
			$edit = '
				<a href="' . site_url ('master_data/edit_vendor_material/' . _encrypt ($field->id)) . '" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" data-bs-title="' . $field->link . '">
					<i class="fa-solid fa-pen-to-square"></i>		
				</a>';
			$row = array();
			$row[] = ++$no;
			$row[] = $field->item_code;
			$row[] = $field->item_name;
			$row[] = $field->service_type;
			$row[] = $field->service_recurring;
			$row[] = $field->service_urgent_if;
			$data[] = $row;
			}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->master_model->count_all ($search, 'vendor'),
			"recordsFiltered" => $this->master_model->count_filtered ($search, 'vendor'),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode ($output);
		}

	public function edit_vendor()
		{
		$vendor_code = _decrypt ($this->uri->segment (3));
		$data['vendor'] = $this->db->get_where ("m_master_data_vendor", array(
			"id" => $vendor_code,
		))->row ();
		// debugCode($data);

		$this->session->set_flashdata ('page_title', 'FORM EDIT VENDOR');
		load_view ('master-data/vendor/edit-form', $data);
		}

	public function update_vendor()
		{
		if (isset ($_POST['submit']))
			{
			$id = $this->input->post ('id');
			$inserted = _update (
				"m_master_data_vendor",
				array(
					"vendor_name" => $this->input->post ('vendor_name'),
					"est_lead_time" => $this->input->post ('est_lead_time'),
					"category" => $this->input->post ('category'),
					"rating" => $this->input->post ('rating'),
				),
				array("id" => $id)
			);

			$vendor = $this->db->get_where ("m_master_data_vendor", array(
				"id" => $id,
			))->row ();

			$material = $this->db->get_where ("m_vendor_material", array(
				"vendor_code" => $vendor->vendor_code,
			))->result ();

			foreach ($material as $item)
				{
				$lt_po_deliv = $vendor->est_lead_time + $item->lt_pr_po;
				_update ('m_vendor_material', array('lt_po_deliv' => $lt_po_deliv), array('id' => $item->id));
				}

			if ($inserted)
				{
				$err = array(
					'show' => true,
					'type' => 'success',
					'msg' => 'Successfully update vendor data.'
				);
				$this->session->set_flashdata ('toast', $err);
				}
			else
				{
				$err = array(
					'show' => true,
					'type' => 'error',
					'msg' => 'Update vendor failed.'
				);
				$this->session->set_flashdata ('toast', $err);
				}
			redirect ('master_data/vendor_detail/' . _encrypt ($id));
			}
		else
			{
			redirect ('master_data/vendor_list');
			}
		}

	public function delete_vendor()
		{
		$id = _decrypt ($this->input->get ('id'));
		$deleted = _soft_delete ("m_master_data_vendor", array("id" => $id));

		if ($deleted)
			{
			$err = array(
				'show' => true,
				'type' => 'error',
				'msg' => 'Successfully delete vendor data.'
			);
			$this->session->set_flashdata ('toast', $err);
			}
		else
			{
			$err = array(
				'show' => true,
				'type' => 'error',
				'msg' => 'Delete vendor failed.'
			);
			$this->session->set_flashdata ('toast', $err);
			}
		redirect ('master_data/vendor_list');
		}

	public function edit_vendor_material()
		{
		$id = _decrypt ($this->uri->segment (3));

		$data['vendor'] = $this->db->get_where ("view_master_vendor", array(
			"id" => $id,
		))->row ();

		$data['vendor_detail'] = $this->db->get_where ("m_master_data_vendor", array(
			"vendor_code" => $data['vendor']->vendor_code,
		))->row ();

		$data['material'] = $this->db->get_where ("m_vendor_material", array(
			"id" => $id,
		))->row ();

		$data['var_settings'] = $this->db->get_where ("m_variable_settings", array(
			"item_id" => $data['material']->id,
		))->row ();

		// debugCode($data);

		$this->session->set_flashdata ('page_title', 'FORM EDIT VENDOR MATERIAL');
		load_view ('master-data/vendor/material/edit-form', $data);
		}

	public function item_movement()
		{
		$id = _decrypt ($this->uri->segment (3));

		generate_item_movement ($id);

		$data['vendor'] = $this->db->get_where ("view_master_vendor", array(
			"id" => $id,
		))->row ();

		$data['vendor_detail'] = $this->db->get_where ("m_master_data_vendor", array(
			"vendor_code" => $data['vendor']->vendor_code,
		))->row ();

		$data['material'] = $this->db->get_where ("m_vendor_material", array(
			"id" => $id,
		))->row ();

		$data['var_settings'] = $this->db->get_where ("m_variable_settings", array(
			"item_id" => $data['material']->id,
		))->row ();

		$data['gross_req'] = $this->db->get_where ("m_stock_card_formula", array(
			"item_id" => $data['material']->id,
		))->result ();

		$data['item_movement'] = $this->db->get_where ("t_material_movement", array(
			"vendor_material_id" => $id,
		))->result ();

		$data['total_gross_req'] = count ($data['gross_req']);

		$this->session->set_flashdata ('page_title', 'INPUT ITEM MOVEMENT MATERIAL');
		load_view ('master-data/vendor/material/item-movement', $data);
		}

	public function update_vendor_material()
		{
		if (isset ($_POST['submit']))
			{
			$id = $this->input->post ('id');

			$get_data = $this->db->get_where ("m_vendor_material", array(
				"id" => $id,
			))->row ();

			$vendor = $this->db->get_where ("m_master_data_vendor", array(
				"vendor_code" => $get_data->vendor_code,
			))->row ();

			$material = $this->db->get_where ("m_master_data_material", array(
				"item_code" => $get_data->item_code,
			))->row ();

			$lt_po_deliv = ! empty ($this->input->post ('lt_po_deliv')) ? $vendor->est_lead_time + $this->input->post ('lt_po_deliv') : NULL;
			$standart_safety_stock = ! empty ($material->order_cycle) && ! empty ($material->lot_size) ? ($lt_po_deliv / $material->order_cycle) * $material->lot_size : NULL;
			$price_per_uom = ! empty ($this->input->post ('price_per_uom')) ? str_replace (',', '', $this->input->post ('price_per_uom')) : NULL;
			$price_equal_moq = ! empty ($this->input->post ('price_equal_moq')) ? str_replace (',', '', $this->input->post ('price_equal_moq')) : NULL;

			$inserted = _update (
				"m_vendor_material",
				array(
					"moq" => $this->input->post ('moq'),
					"lead_time" => $this->input->post ('lt_po_deliv'),
					"lt_po_deliv" => $lt_po_deliv,
					"price_per_uom" => $price_per_uom,
					"price_equal_moq" => $price_equal_moq,
					"place_to_buy" => $this->input->post ('place_to_buy'),
					"link" => $this->input->post ('link'),

				),
				array("id" => $id)
			);

			if ($inserted)
				{
				$err = array(
					'show' => true,
					'type' => 'success',
					'msg' => 'Successfully update material data.'
				);
				$this->session->set_flashdata ('toast', $err);
				}
			else
				{
				$err = array(
					'show' => true,
					'type' => 'error',
					'msg' => 'Update material failed.'
				);
				$this->session->set_flashdata ('toast', $err);
				}
			redirect ('master_data/edit_vendor_material/' . _encrypt ($id));
			}
		else
			{
			redirect ('master_data/vendor_list');
			}
		}

	public function generate()
		{
		ini_set ("max_execution_time", 0);

		$reader = IOFactory::createReader ('Xlsx');
		$spreadsheet = $reader->load ('assets/format/template_master.xlsx');
		$spreadsheet->setActiveSheetIndexByName ('UoM');
		$sheet = $spreadsheet->getActiveSheet ();
		$index = 2;
		$getUom = $this->db->query ("SELECT * FROM m_uom")->result ();

		foreach ((array) $getUom as $datas => $list)
			{
			// $sheet->insertNewRowBefore($index + 1, 1);
			$sheet->setCellValue ("A{$index}", trim ($list->uom_code));
			$sheet->setCellValue ("B{$index}", trim ($list->uom_name));

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

			$sheet->getStyle ("A{$index}:B{$index}")->applyFromArray ($styleArray);
			$index++;
			}

		$spreadsheet->setActiveSheetIndexByName ('Category');
		$sheet = $spreadsheet->getActiveSheet ();
		$index = 2;
		$getCategory = $this->db->query ("SELECT * FROM m_category")->result ();

		foreach ((array) $getCategory as $datas => $list)
			{
			// $sheet->insertNewRowBefore($index + 1, 1);
			$sheet->setCellValue ("A{$index}", trim ($list->category_name));

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

			$sheet->getStyle ("A2:B{$index}")->applyFromArray ($styleArray);
			$index++;
			}

		$spreadsheet->setActiveSheetIndexByName ('Factory');
		$sheet = $spreadsheet->getActiveSheet ();
		$index = 2;
		$getFactory = $this->db->query ("SELECT * FROM m_factory")->result ();

		foreach ((array) $getFactory as $datas => $list)
			{
			// $sheet->insertNewRowBefore($index + 1, 1);
			$sheet->setCellValue ("A{$index}", trim ($list->factory_name));

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

			$sheet->getStyle ("A{$index}:B{$index}")->applyFromArray ($styleArray);
			$index++;
			}

		$spreadsheet->setActiveSheetIndexByName ('Item Group');
		$sheet = $spreadsheet->getActiveSheet ();
		$index = 2;
		$getItemGroup = $this->db->query ("SELECT * FROM m_item_category")->result ();

		foreach ((array) $getItemGroup as $datas => $list)
			{
			// $sheet->insertNewRowBefore($index + 1, 1);
			$sheet->setCellValue ("A{$index}", trim ($list->item_category_name));

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

			$sheet->getStyle ("A2:B{$index}")->applyFromArray ($styleArray);
			$index++;
			}

		$spreadsheet->setActiveSheetIndexByName ('Factory');
		$sheet = $spreadsheet->getActiveSheet ();
		$index = 2;
		$getFactory = $this->db->query ("SELECT * FROM m_factory")->result ();

		foreach ((array) $getFactory as $datas => $list)
			{
			// $sheet->insertNewRowBefore($index + 1, 1);
			$sheet->setCellValue ("A{$index}", trim ($list->factory_name));

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

			$sheet->getStyle ("A{$index}:B{$index}")->applyFromArray ($styleArray);
			$index++;
			}

		$spreadsheet->setActiveSheetIndexByName ('Master Vendor');
		$sheet = $spreadsheet->getActiveSheet ();
		$index = 2;
		$getVendor = $this->db->query ("SELECT * FROM m_master_data_vendor WHERE is_active = 1")->result ();

		foreach ((array) $getVendor as $datas => $list)
			{
			// $sheet->insertNewRowBefore($index + 1, 1);
			$sheet->setCellValue ("A{$index}", trim ($list->vendor_code));
			$sheet->setCellValue ("B{$index}", trim ($list->vendor_name));
			$sheet->setCellValue ("C{$index}", trim ($list->vendor_location));
			$sheet->setCellValue ("D{$index}", trim ($list->vendor_channel));
			$sheet->setCellValue ("E{$index}", trim ($list->additional_margin));
			$sheet->setCellValue ("F{$index}", trim ($list->last_transaction));
			$sheet->setCellValue ("G{$index}", trim ($list->validity));
			$sheet->setCellValue ("H{$index}", trim ($list->category));
			$sheet->setCellValue ("I{$index}", trim ($list->total_spend_ytd));
			$sheet->setCellValue ("J{$index}", trim ($list->last_year_spend));
			$sheet->setCellValue ("K{$index}", trim ($list->est_lead_time));

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

			$sheet->getStyle ("A2:K{$index}")->applyFromArray ($styleArray);
			$index++;
			}

		$spreadsheet->setActiveSheetIndexByName ('Master Material');
		$sheet = $spreadsheet->getActiveSheet ();
		$index = 3;
		$getMaterial = $this->db->query ("SELECT * FROM m_master_data_material WHERE is_active = 1")->result ();

		foreach ((array) $getMaterial as $datas => $list)
			{

			$setting = $this->db->query ("SELECT * FROM m_variable_settings WHERE item_id = '{$list->id}'")->row ();
			// $sheet->insertNewRowBefore($index + 1, 1);
			$sheet->setCellValue ("A{$index}", trim ($list->factory));
			$sheet->setCellValue ("B{$index}", trim ($list->item_code));
			$sheet->setCellValue ("C{$index}", trim ($list->item_name));
			$sheet->setCellValue ("D{$index}", trim ($list->item_group));
			$sheet->setCellValue ("E{$index}", trim ($list->size));
			$sheet->setCellValue ("F{$index}", trim ($list->size_uom));
			$sheet->setCellValue ("G{$index}", trim ($list->uom));
			$sheet->setCellValue ("H{$index}", trim ($list->lot_size));
			$sheet->setCellValue ("I{$index}", trim ($list->initial_stock));
			$sheet->setCellValue ("J{$index}", trim ($list->standard_safety_stock));
			$sheet->setCellValue ("K{$index}", trim ($list->order_cycle));
			$sheet->setCellValue ("L{$index}", trim ($list->lt_pr_po));
			$sheet->setCellValue ("M{$index}", trim ($list->lt_pr_to_deliv));
			$sheet->setCellValue ("N{$index}", trim ($list->gen_lead_time));
			$sheet->setCellValue ("O{$index}", trim (get_baseline_price ($list->id, 'Best')));
			$sheet->setCellValue ("P{$index}", trim (get_baseline_price ($list->id, 'Average')));
			$sheet->setCellValue ("Q{$index}", trim (get_baseline_price ($list->id, 'Latest')));
			$sheet->setCellValue ("R{$index}", trim (get_baseline_price ($list->id, 'Target')));
			$sheet->setCellValue ("S{$index}", trim (get_baseline_price ($list->id, 'Budget')));
			$sheet->setCellValue ("T{$index}", trim ($setting->var_stock_card_overstock));
			$sheet->setCellValue ("U{$index}", trim ($setting->var_stock_card_ok));
			$sheet->setCellValue ("V{$index}", trim ($list->target_inventory));
			$sheet->setCellValue ("W{$index}", trim ($setting->fast_moving_threshold));
			$sheet->setCellValue ("X{$index}", trim ($setting->slow_moving_threshold));
			$sheet->setCellValue ("Y{$index}", trim ($setting->usage_ok_threshold));
			$sheet->setCellValue ("Z{$index}", trim ($setting->pic_name));

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

			$sheet->getStyle ("A3:Z{$index}")->applyFromArray ($styleArray);
			$index++;
			}

		$spreadsheet->setActiveSheetIndexByName ('Master Vendor x Material');
		$sheet = $spreadsheet->getActiveSheet ();
		$index = 2;
		$getVendorMaterial = $this->db->query ("SELECT m_vendor_material.*, m_master_data_vendor.vendor_name, m_master_data_material.item_name FROM m_vendor_material 
		INNER JOIN m_master_data_vendor ON m_master_data_vendor.vendor_code = m_vendor_material.vendor_code
		INNER JOIN m_master_data_material ON m_master_data_material.item_code = m_vendor_material.item_code
		WHERE m_vendor_material.is_active = 1")->result ();

		foreach ((array) $getVendorMaterial as $datas => $list)
			{

			$get_price = $this->db->get_where ("m_vendor_material_price", array(
				"item_id" => $list->item_id
			))->result ();

			// $sheet->insertNewRowBefore($index + 1, 1);
			$sheet->setCellValue ("A{$index}", trim ($list->vendor_code));
			$sheet->setCellValue ("B{$index}", trim ($list->vendor_name));
			$sheet->setCellValue ("C{$index}", trim ($list->item_code));
			$sheet->setCellValue ("D{$index}", trim ($list->item_name));
			$sheet->setCellValue ("E{$index}", trim ($list->uom));
			$sheet->setCellValue ("F{$index}", trim ($list->total_spend_ytd));
			$sheet->setCellValue ("G{$index}", trim ($list->last_year_spend));
			$sheet->setCellValue ("H{$index}", trim ($list->lt_po_deliv ? $list->lt_po_deliv : 0));
			$sheet->setCellValue ("I{$index}", trim ($list->price_per_uom ? $list->price_per_uom : 0));
			$sheet->setCellValue ("J{$index}", trim ($list->moq ? $list->moq : 0));
			$sheet->setCellValue ("K{$index}", $get_price[0]->minimum_order ? $get_price[0]->minimum_order : 0);
			$sheet->setCellValue ("L{$index}", $get_price[0]->price_per_uom ? $get_price[0]->price_per_uom : 0);
			$sheet->setCellValue ("M{$index}", $get_price[1]->minimum_order ? $get_price[1]->minimum_order : 0);
			$sheet->setCellValue ("N{$index}", $get_price[1]->price_per_uom ? $get_price[1]->price_per_uom : 0);
			$sheet->setCellValue ("O{$index}", $get_price[2]->minimum_order ? $get_price[2]->minimum_order : 0);
			$sheet->setCellValue ("P{$index}", $get_price[3]->price_per_uom ? $get_price[2]->price_per_uom : 0);
			$sheet->setCellValue ("Q{$index}", trim ($list->saving));

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

			$sheet->getStyle ("A{$index}:Q{$index}")->applyFromArray ($styleArray);
			$index++;
			}

		$writer = new Xlsx($spreadsheet); // instantiate Xlsx
		$writer->setPreCalculateFormulas (false);
		$filename = 'SGSS_Master_Data_' . date ('YmdHis'); // set filename for excel file to be exported
		header ('Content-Type: application/vnd.ms-excel'); // generate excel file
		header ('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header ('Cache-Control: max-age=0');
		$writer->save ('php://output');	// download file 
		}
	public function generate_template()
		{
		ini_set ("max_execution_time", 0);

		$reader = IOFactory::createReader ('Xlsx');
		$spreadsheet = $reader->load ('assets/format/template_import_master.xlsx');
		$spreadsheet->setActiveSheetIndexByName ('UoM');
		$sheet = $spreadsheet->getActiveSheet ();
		$index = 2;
		$getUom = $this->db->query ("SELECT * FROM m_uom")->result ();

		foreach ((array) $getUom as $datas => $list)
			{
			// $sheet->insertNewRowBefore($index + 1, 1);
			$sheet->setCellValue ("A{$index}", trim ($list->uom_code));
			$sheet->setCellValue ("B{$index}", trim ($list->uom_name));

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

			$sheet->getStyle ("A{$index}:B{$index}")->applyFromArray ($styleArray);
			$index++;
			}

		$spreadsheet->setActiveSheetIndexByName ('Category');
		$sheet = $spreadsheet->getActiveSheet ();
		$index = 2;
		$getCategory = $this->db->query ("SELECT * FROM m_category")->result ();

		foreach ((array) $getCategory as $datas => $list)
			{
			// $sheet->insertNewRowBefore($index + 1, 1);
			$sheet->setCellValue ("A{$index}", trim ($list->category_name));

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

			$sheet->getStyle ("A2:B{$index}")->applyFromArray ($styleArray);
			$index++;
			}

		$spreadsheet->setActiveSheetIndexByName ('Factory');
		$sheet = $spreadsheet->getActiveSheet ();
		$index = 2;
		$getFactory = $this->db->query ("SELECT * FROM m_factory")->result ();

		foreach ((array) $getFactory as $datas => $list)
			{
			// $sheet->insertNewRowBefore($index + 1, 1);
			$sheet->setCellValue ("A{$index}", trim ($list->factory_name));

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

			$sheet->getStyle ("A{$index}:B{$index}")->applyFromArray ($styleArray);
			$index++;
			}

		$spreadsheet->setActiveSheetIndexByName ('Item Group');
		$sheet = $spreadsheet->getActiveSheet ();
		$index = 2;
		$getItemGroup = $this->db->query ("SELECT * FROM m_item_category")->result ();

		foreach ((array) $getItemGroup as $datas => $list)
			{
			// $sheet->insertNewRowBefore($index + 1, 1);
			$sheet->setCellValue ("A{$index}", trim ($list->item_category_name));

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

			$sheet->getStyle ("A2:B{$index}")->applyFromArray ($styleArray);
			$index++;
			}

		$spreadsheet->setActiveSheetIndexByName ('Factory');
		$sheet = $spreadsheet->getActiveSheet ();
		$index = 2;
		$getFactory = $this->db->query ("SELECT * FROM m_factory")->result ();

		foreach ((array) $getFactory as $datas => $list)
			{
			// $sheet->insertNewRowBefore($index + 1, 1);
			$sheet->setCellValue ("A{$index}", trim ($list->factory_name));

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

			$sheet->getStyle ("A{$index}:B{$index}")->applyFromArray ($styleArray);
			$index++;
			}

		$spreadsheet->setActiveSheetIndexByName ('User');
		$sheet = $spreadsheet->getActiveSheet ();
		$index = 2;
		$getFactory = $this->db->query ("SELECT * FROM view_employee_area")->result ();

		foreach ((array) $getFactory as $datas => $list)
			{
			// $sheet->insertNewRowBefore($index + 1, 1);
			$sheet->setCellValue ("A{$index}", trim ($list->nip));
			$sheet->setCellValue ("B{$index}", trim ($list->nama));
			$sheet->setCellValue ("C{$index}", trim ($list->area));

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

		$spreadsheet->setActiveSheetIndexByName ('Master Material');
		$sheet = $spreadsheet->getActiveSheet ();
		$index = 3;
		$getMaterial = $this->db->query ("SELECT * FROM m_master_data_material WHERE is_active = 1")->result ();

		foreach ((array) $getMaterial as $datas => $list)
			{

			$setting = $this->db->query ("SELECT * FROM m_variable_settings WHERE item_id = '{$list->id}'")->row ();
			// $sheet->insertNewRowBefore($index + 1, 1);
			$sheet->setCellValue ("A{$index}", trim ($list->factory));
			$sheet->setCellValue ("B{$index}", trim ($list->item_code));
			$sheet->setCellValue ("C{$index}", trim ($list->item_name));
			$sheet->setCellValue ("D{$index}", trim ($list->item_group));
			$sheet->setCellValue ("E{$index}", trim ($list->size));
			$sheet->setCellValue ("F{$index}", trim ($list->size_uom));
			$sheet->setCellValue ("G{$index}", trim ($list->uom));
			$sheet->setCellValue ("H{$index}", trim ($list->lot_size));
			$sheet->setCellValue ("I{$index}", trim ($list->initial_stock));
			$sheet->setCellValue ("J{$index}", trim ($list->standard_safety_stock));
			$sheet->setCellValue ("K{$index}", trim ($list->order_cycle));
			$sheet->setCellValue ("L{$index}", trim ($list->lt_pr_po));
			$sheet->setCellValue ("M{$index}", trim ($list->lt_pr_to_deliv));
			$sheet->setCellValue ("N{$index}", trim ($list->gen_lead_time));
			$sheet->setCellValue ("O{$index}", trim (get_baseline_price ($list->id, 'Best')));
			$sheet->setCellValue ("P{$index}", trim (get_baseline_price ($list->id, 'Average')));
			$sheet->setCellValue ("Q{$index}", trim (get_baseline_price ($list->id, 'Latest')));
			$sheet->setCellValue ("R{$index}", trim (get_baseline_price ($list->id, 'Target')));
			$sheet->setCellValue ("S{$index}", trim (get_baseline_price ($list->id, 'Budget')));
			$sheet->setCellValue ("T{$index}", trim ($setting->var_stock_card_overstock));
			$sheet->setCellValue ("U{$index}", trim ($setting->var_stock_card_ok));
			$sheet->setCellValue ("V{$index}", trim ($list->target_inventory));
			$sheet->setCellValue ("W{$index}", trim ($setting->fast_moving_threshold));
			$sheet->setCellValue ("X{$index}", trim ($setting->slow_moving_threshold));
			$sheet->setCellValue ("Y{$index}", trim ($setting->usage_ok_threshold));
			$sheet->setCellValue ("Z{$index}", trim ($setting->pic_name));

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

			$sheet->getStyle ("A3:Z{$index}")->applyFromArray ($styleArray);
			$index++;
			}

		$spreadsheet->setActiveSheetIndexByName ('Master Vendor');
		$sheet = $spreadsheet->getActiveSheet ();
		$index = 2;
		$getVendor = $this->db->query ("SELECT * FROM m_master_data_vendor WHERE is_active = 1")->result ();

		foreach ((array) $getVendor as $datas => $list)
			{
			// $sheet->insertNewRowBefore($index + 1, 1);
			$sheet->setCellValue ("A{$index}", trim ($list->vendor_code));
			$sheet->setCellValue ("B{$index}", trim ($list->vendor_name));
			$sheet->setCellValue ("C{$index}", trim ($list->vendor_location));
			$sheet->setCellValue ("D{$index}", trim ($list->vendor_channel));
			$sheet->setCellValue ("E{$index}", trim ($list->additional_margin));
			$sheet->setCellValue ("F{$index}", trim ($list->last_transaction));
			$sheet->setCellValue ("G{$index}", trim ($list->validity));
			$sheet->setCellValue ("H{$index}", trim ($list->category));
			$sheet->setCellValue ("I{$index}", trim ($list->total_spend_ytd));
			$sheet->setCellValue ("J{$index}", trim ($list->last_year_spend));
			$sheet->setCellValue ("K{$index}", trim ($list->est_lead_time));

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

			$sheet->getStyle ("A2:K{$index}")->applyFromArray ($styleArray);
			$index++;
			}

		$writer = new Xlsx($spreadsheet); // instantiate Xlsx
		$writer->setPreCalculateFormulas (false);
		$filename = 'SGSS_Import_Template'; // set filename for excel file to be exported
		header ('Content-Type: application/vnd.ms-excel'); // generate excel file
		header ('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header ('Cache-Control: max-age=0');
		$writer->save ('php://output');	// download file 
		}
	public function upload()
		{
		ini_set ("max_execution_time", 0);
		$path = 'assets/upload/';
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
			$sheetData = $spreadsheet->getSheetbyName ('UoM');
			$cellRow = $spreadsheet->getSheetbyName ('UoM')->getHighestRow ();
			for ($i = 2; $i <= $cellRow; $i++)
				{
				$uom = $sheetData->getCell ('A' . $i)->getValue ();
				$name = $sheetData->getCell ('B' . $i)->getValue ();
				if (! empty ($uom))
					{
					$check = $this->db->query ("SELECT * FROM m_uom WHERE uom_code = ? AND uom_name = ?", array($uom, $name))->row ();
					if (empty ($check))
						{
						_add ("m_uom", array("uom_code" => $uom, "uom_name" => $name));
						$list[] = [
							"status" => "success",
							"data" => "New UoM " . $name . " added",
						];
						}
					}
				}

			//check category
			$sheetData = $spreadsheet->getSheetbyName ('Category');
			$cellRow = $spreadsheet->getSheetbyName ('Category')->getHighestRow ();
			for ($i = 2; $i <= $cellRow; $i++)
				{
				$name = $sheetData->getCell ('A' . $i)->getValue ();
				if (! empty ($name))
					{
					$check = $this->db->query ("SELECT * FROM m_category WHERE category_name = ?", array($name))->row ();
					if (empty ($check))
						{
						_add ("m_category", array("category_name" => $name));

						$list[] = [
							"status" => "success",
							"data" => "New Category " . $name . " added",
						];
						}
					}
				}

			//check factory
			$sheetData = $spreadsheet->getSheetbyName ('Factory');
			$cellRow = $spreadsheet->getSheetbyName ('Factory')->getHighestRow ();
			for ($i = 2; $i <= $cellRow; $i++)
				{
				$name = $sheetData->getCell ('A' . $i)->getValue ();
				if (! empty ($name))
					{
					$check = $this->db->query ("SELECT * FROM m_factory WHERE factory_name = ?", array($name))->row ();
					if (empty ($check))
						{
						_add ("m_factory", array("factory_name" => $name));

						$list[] = [
							"status" => "success",
							"data" => "New Factory " . $name . " added",
						];
						}
					}
				}

			//check item group
			$sheetData = $spreadsheet->getSheetbyName ('Item Group');
			$cellRow = $spreadsheet->getSheetbyName ('Item Group')->getHighestRow ();
			for ($i = 2; $i <= $cellRow; $i++)
				{
				$name = $sheetData->getCell ('A' . $i)->getValue ();
				if (! empty ($name))
					{
					$check = $this->db->query ("SELECT * FROM m_item_category WHERE item_category_name = ?", array($name))->row ();
					if (empty ($check))
						{
						_add ("m_item_category", array("item_category_name" => $name));

						$list[] = [
							"status" => "success",
							"data" => "New Item Group " . $name . " added",
						];
						}
					}
				}

			//check material
			$sheetData = $spreadsheet->getSheetbyName ('Master Material');
			$cellRow = $spreadsheet->getSheetbyName ('Master Material')->getHighestRow ();
			for ($i = 3; $i <= $cellRow; $i++)
				{
				$factory = $sheetData->getCell ('A' . $i)->getValue ();
				$item_code = $sheetData->getCell ('B' . $i)->getValue ();
				$item_name = $sheetData->getCell ('C' . $i)->getValue ();
				$item_group = $sheetData->getCell ('D' . $i)->getValue ();
				$size = $sheetData->getCell ('E' . $i)->getValue ();
				$size_uom = $sheetData->getCell ('F' . $i)->getValue ();
				$uom = $sheetData->getCell ('G' . $i)->getValue ();
				$lot_size = $sheetData->getCell ('H' . $i)->getValue ();
				$initial_stock = $sheetData->getCell ('I' . $i)->getValue ();
				$order_cycle = $sheetData->getCell ('K' . $i)->getValue ();
				$lt_pr_po = $sheetData->getCell ('L' . $i)->getValue ();
				$lt_pr_to_deliv = $sheetData->getCell ('M' . $i)->getValue ();
				$total_lead_time = $lt_pr_po + $lt_pr_to_deliv;
				$target = $sheetData->getCell ('R' . $i)->getValue ();
				$overstock_threshold = $sheetData->getCell ('T' . $i)->getValue ();
				$ok_threshold = $sheetData->getCell ('U' . $i)->getValue ();
				$target_inventory = $sheetData->getCell ('V' . $i)->getValue ();
				$fast_moving_threshold = $sheetData->getCell ('W' . $i)->getValue ();
				$slow_moving_threshold = $sheetData->getCell ('X' . $i)->getValue ();
				$usage_ok_threshold = $sheetData->getCell ('Y' . $i)->getValue ();
				$pic = $sheetData->getCell ('Z' . $i)->getValue ();
				$standart_safety_stock = ! empty ($order_cycle) && ! empty ($lot_size) ? ($total_lead_time / $order_cycle) * $lot_size : NULL;
				$target_price = ! empty ($target) ? $target * $standart_safety_stock : 0;

				if (! empty ($item_name) && ! empty ($uom) && ! empty ($size) && ! empty ($lot_size) && ! empty ($order_cycle))
					{
					$check = $this->db->query ("SELECT * FROM m_master_data_material WHERE item_name = ? AND size = ? AND uom = ? ", array($item_name, $size, $uom))->row ();
					$checkUoM = $this->db->query ("SELECT * FROM m_uom WHERE uom_code = ? ", array($uom))->row ();

					if (! is_numeric ($lot_size) || ! is_numeric ($order_cycle) || ! is_numeric ($initial_stock) || ! is_numeric ($initial_stock))
						{
						$list[] = [
							"status" => "failed",
							"data" => "Incorrect data format on material row $i, please check and try again.",
						];
						}
					else
						{
						if (empty ($checkUoM))
							{
							$list[] = [
								"status" => "failed",
								"data" => "Incorrect data format on material row $i, please check and try again.",
							];
							}
						else
							{
							if (empty ($check))
								{
								$itemName = explode (" ", $item_name);

								$itemNameCode = '';
								for ($i = 0; $i < 3; $i++)
									{
									$length = $i == 0 ? 3 : 2;
									$itemNameCode .= substr ($itemName[$i], 0, $length);
									}

								$itemcode = strtoupper ($itemNameCode . $size . $uom);

								$get_item_group = $this->db->get_where ("m_item_category", array(
									"item_category_name" => $item_group,
								))->row ();

								$get_pic = $this->db->get_where ("m_employee", array(
									"nama" => $pic,
								))->row ();

								$itemNumber = 1;

								$checkCode = $this->db->query ("SELECT MAX(item_number) as item_number FROM m_master_data_material WHERE item_code = ? ", array($itemcode))->row ();

								if ($checkCode)
									{
									$itemNumber = $checkCode->item_number + 1;
									}

								$inserted = _add (
									"m_master_data_material",
									array(
										"item_code" => $item_code . "-" . sprintf ("%02d", $itemNumber),
										"item_name" => $item_name,
										"type" => 'goods',
										"size" => $size,
										"factory" => $factory,
										"size_uom" => $size_uom,
										"uom" => $uom,
										"item_category_id" => $get_item_group->id,
										"item_group" => $item_group,
										"lot_size" => $lot_size,
										"order_cycle" => $order_cycle,
										"initial_stock" => $initial_stock,
										"lt_pr_po" => $lt_pr_po,
										"lt_pr_to_deliv" => $lt_pr_to_deliv,
										"gen_lead_time" => $total_lead_time,
										"standard_safety_stock" => round ($standart_safety_stock),
										'target_inventory' => $target_price,
										"pic" => $get_pic->nip,
										"pic_name" => $get_pic->nama,
										"item_number" => $itemNumber
									)
								);
								if ($inserted)
									{

									$get_last_id = $this->db->get_where ("m_master_data_material", array(
										"item_code" => $itemcode
									));

									if ($get_last_id->num_rows () > 0)
										{
										$last_id = $get_last_id->row ();
										$last_id = $last_id->id;

										generate_gross_requirement ($last_id);
										$data_var_settings = array(
											"item_code" => $itemcode,
											"item_id" => $last_id,
											"var_todo_list" => 10,
											"var_stock_card_todo_list" => 10,
											"var_stock_card_overstock" => $overstock_threshold,
											'var_stock_card_ok' => $ok_threshold,
											'var_pending_approval' => 5,
											'min_threshold' => 20,
											'fast_moving_threshold' => $fast_moving_threshold,
											'slow_moving_threshold' => $slow_moving_threshold,
											'usage_ok_threshold' => $usage_ok_threshold,
										);

										_add_nologs ('m_variable_settings', $data_var_settings);
										generate_budget_baseline ($last_id, 0, $target_price);
										generate_item_movement ($last_id);
										generate_average_forecast ($last_id);

										_add ('m_material_budget', array(
											"item_id" => $last_id,
											"item_code" => $itemcode,
											"annual_budget" => 0,
											"annual_usage" => 0,
											"year" => date ('Y')
										));
										}
									}

								$list[] = [
									"status" => "success",
									"data" => "New material " . $itemcode . " - " . $item_name . " added. ",
								];
								}
							}
						}
					}
				}

			//check vendor
			$sheetData = $spreadsheet->getSheetbyName ('Master Vendor');
			$cellRow = $spreadsheet->getSheetbyName ('Master Vendor')->getHighestRow ();
			for ($i = 2; $i <= $cellRow; $i++)
				{
				$vendor_code = $sheetData->getCell ('A' . $i)->getValue ();
				$vendor_name = $sheetData->getCell ('B' . $i)->getValue ();
				$vendor_location = $sheetData->getCell ('C' . $i)->getValue ();
				$vendor_channel = $sheetData->getCell ('D' . $i)->getValue ();
				$additional_margin = $sheetData->getCell ('E' . $i)->getValue ();
				$validity = $sheetData->getCell ('G' . $i)->getValue ();
				$category = $sheetData->getCell ('H' . $i)->getValue ();
				$rating = 5;
				$est_lead_time = $sheetData->getCell ('K' . $i)->getValue ();

				if (! empty ($vendor_code) && ! empty ($vendor_name) && ! empty ($est_lead_time) && ! empty ($category))
					{
					$check = $this->db->query ("SELECT * FROM m_master_data_vendor WHERE vendor_code = ? ", array($vendor_code))->row ();
					$checkCategory = $this->db->query ("SELECT * FROM m_category WHERE category_name = ? ", array($category))->row ();

					if (! is_numeric (($est_lead_time)))
						{
						$list[] = [
							"status" => "failed",
							"data" => "Incorrect data format on vendor row $i, please check and try again.",
						];
						}
					else
						{
						if (empty ($checkCategory))
							{
							$list[] = [
								"status" => "failed",
								"data" => "Incorrect category on vendor row $i, please check and try again.",
							];
							}
						else
							{
							if (empty ($check))
								{
								$get_max_id = $this->db->query ("select max(id) as id from m_master_data_vendor")->row ();
								$vendorCode = 'VND' . sprintf ('%04s', $get_max_id->id + 1);

								_add ("m_master_data_vendor", array(
									"vendor_code" => $vendorCode,
									"vendor_name" => $vendor_name,
									"vendor_location" => $vendor_location,
									"vendor_channel" => $vendor_channel,
									"additional_margin" => $additional_margin,
									"validity" => $validity,
									"category" => $category,
									"rating" => $rating,
									"est_lead_time" => $est_lead_time
								));
								$list[] = [
									"status" => "success",
									"data" => "New Vendor " . $vendor_code . " - " . $vendor_name . " added",
								];
								}
							}
						}
					}
				}

			//check vendor material
			$sheetData = $spreadsheet->getSheetbyName ('Master Vendor x Material');
			$cellRow = $spreadsheet->getSheetbyName ('Master Vendor x Material')->getHighestRow ();
			for ($i = 2; $i <= $cellRow; $i++)
				{
				$vendor_code = $sheetData->getCell ('A' . $i)->getValue ();
				$item_code = $sheetData->getCell ('C' . $i)->getValue ();
				$lt_pr_po = $sheetData->getCell ('H' . $i)->getValue ();
				// $lot_size = $sheetData->getCell('E'.$i)->getValue();
				// $order_cycle = $sheetData->getCell('F'.$i)->getValue();
				// $initial_stock = $sheetData->getCell('G'.$i)->getValue();
				$price_per_uom = $sheetData->getCell ('I' . $i)->getValue ();
				$moq = $sheetData->getCell ('J' . $i)->getValue ();
				// $price_equal_uom = $sheetData->getCell ('G' . $i)->getValue ();
				// $place_to_buy = $sheetData->getCell ('H' . $i)->getValue ();
				// $link = $sheetData->getCell ('I' . $i)->getValue ();

				if (! empty ($vendor_code) && ! empty ($item_code))
					{
					$check = $this->db->query ("SELECT * FROM m_vendor_material WHERE vendor_code = ? AND item_code = ? ", array($vendor_code, $item_code))->row ();
					$checkVendor = $this->db->query ("SELECT * FROM m_master_data_vendor WHERE vendor_code = ? ", array($vendor_code))->row ();
					$checkMaterial = $this->db->query ("SELECT * FROM m_master_data_material WHERE item_code = ? ", array($item_code))->row ();

					if (empty ($checkVendor) || empty ($checkMaterial))
						{
						$list[] = [
							"status" => "failed",
							"data" => "Incorrect vendor material data on vendor material row $i, please check and try again.",
						];
						}
					else
						{
						if (! is_numeric (($moq)) || ! is_numeric (($lt_pr_po)))
							{
							$list[] = [
								"status" => "failed",
								"data" => "Incorrect vendor material data on vendor material row $i, please check and try again.",
							];
							}
						else
							{
							if (empty ($check))
								{
								$vendor = $this->db->get_where ("m_master_data_vendor", array(
									"vendor_code" => $vendor_code,
								))->row ();

								$material = $this->db->get_where ("m_master_data_material", array(
									"item_code" => $item_code,
								))->row ();

								$lt_po_deliv = ! empty ($lt_pr_po) ? $vendor->est_lead_time + $lt_pr_po : NULL;
								$standart_safety_stock = ! empty ($material->order_cycle) && ! empty ($material->lot_size) ? ($lt_po_deliv / $material->order_cycle) * $material->lot_size : NULL;

								_add ("m_vendor_material", array(
									'vendor_code' => $vendor_code,
									'item_code' => $item_code,
									"moq" => $moq,
									"lt_po_deliv" => $lt_po_deliv,
									"price_per_uom" => $price_per_uom,
									"price_equal_moq" => $price_equal_uom,
									"place_to_buy" => $place_to_buy,
									"link" => $link,
								));

								$get_last_id = $this->db->get_where ("m_vendor_material", array(
									'vendor_code' => $vendor_code,
									'item_code' => $item_code,
								))->row ()->id;

								generate_item_movement ($get_last_id);

								$list[] = [
									"status" => "success",
									"data" => "New Vendor Material " . $vendor_code . " - " . $item_code . " added",
								];
								}
							}
						}
					}
				}

			$html = 'Processing file finished.<br>';
			$html .= '<ul>';
			foreach ($list as $k => $v)
				{
				if ($v['status'] == "failed")
					{
					$html .= '<li><span style="color:red;font-size:12px;">' . $v['status'] . ' - ' . $v['data'] . '</span></li>';
					}
				else
					{
					$html .= '<li><span  style="font-size:12px;">' . $v['status'] . ' - ' . $v['data'] . '</span></li>';
					}
				}
			$html .= '</ul>';
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

	function get_master_service()
		{
		$search = $this->session->userdata ('search');
		$list = $this->master_model->get_datatables ($search, 'service');
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field)
			{
			$edit = '
					<a href="' . site_url ('master_data/edit_service/' . _encrypt ($field->id)) . '" class="btn btn-sm btn-outline-primary" style="font-weight: 600; border-radius: 50px;margin-right:5px;">
						<i class="fa-solid fa-pen-to-square"></i>
						Edit
					</a>
					<a href="' . site_url ('master_data/delete_service/' . _encrypt ($field->id)) . '" class="btn btn-sm btn-outline-danger" style="font-weight: 600; border-radius: 50px;margin-right:5px;" data-bs-toggle="modal" data-bs-target="#modal-delete-' . $field->id . '">
						<i class="fa-solid fa-trash"></i>
						Delete
					</a>
					<div class="modal fade" id="modal-delete-' . $field->id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel" class="text-primary" style="color: #001F82;font-weight:600;">Delete Material</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body" style="text-align: left;">
									<p>You are going to delete material ' . $field->item_code . ' - ' . $field->item_name . ', all data related with this material will be deleted. Are you sure?</p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">No, Cancel Delete.</button>
									<a href="' . site_url ('master_data/delete_material?id=' . _encrypt ($field->id)) . '" type="button" class="btn btn-outline-danger">Yes, Delete Data.</a>
								</div>
							</div>
						</div>
					</div>					
				  ';

			$row = array();
			$row[] = ++$no;
			$row[] = $field->item_code;
			$row[] = $field->item_name;
			$row[] = $field->service_type;
			$row[] = $field->service_recurring;
			$row[] = $field->service_due_date;
			$row[] = $field->service_urgent_if;
			$row[] = $edit;
			$data[] = $row;
			}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->master_model->count_all ($search, 'service'),
			"recordsFiltered" => $this->master_model->count_filtered ($search, 'service'),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode ($output);
		}

	public function add_service()
		{
		$this->session->set_flashdata ('page_title', 'FORM ADD NEW SERVICE');
		load_view ('master-data/service/add-form.php', []);
		}

	public function save_service()
		{
		if (isset ($_POST['submit']))
			{
			$itemcode = strtolower (str_replace (' ', '', $this->input->post ('item_name')) . $this->input->post ('uom') . $this->input->post ('size'));

			$material_code = $this->input->post ('material_code');
			$exist = $this->db->get_where ("m_master_data_material", array(
				"item_code" => $itemcode,
			))->row ();

			if ($exist)
				{
				$err = array(
					'show' => true,
					'type' => 'error',
					'msg' => 'Add new service failed. Service with code ' . $material_code . ' is already exist.'
				);
				$this->session->set_flashdata ('toast', $err);
				$this->load->view ('master-data/service/add-form.php');
				}
			else
				{

				$inserted = _add (
					"m_master_data_material",
					array(
						"item_code" => $itemcode,
						"item_name" => $this->input->post ('item_name'),
						"type" => 'service',
						"service_type" => $this->input->post ('service_type'),
						"service_recurring" => $this->input->post ('service_recurring'),
						"service_due_date" => $this->input->post ('service_due_date'),
						"service_urgent_if" => $this->input->post ('service_urgent_if'),
						"service_category" => $this->input->post ('service_category'),
					)
				);
				if ($inserted)
					{
					$err = array(
						'show' => true,
						'type' => 'success',
						'msg' => 'Successfully added new service.'
					);
					$this->session->set_flashdata ('toast', $err);
					}
				else
					{
					$err = array(
						'show' => true,
						'type' => 'error',
						'msg' => 'Add new service failed.'
					);
					$this->session->set_flashdata ('toast', $err);
					}
				}
			redirect ('service_management/master_data');
			}
		else
			{
			redirect ('service_management/master_data');
			}
		}
	public function edit_service()
		{
		$item_code = _decrypt ($this->uri->segment (3));
		$data['material'] = $this->db->get_where ("m_master_data_material", array(
			"id" => $item_code
		))->row ();

		$this->session->set_flashdata ('page_title', 'FORM EDIT SERVICE');
		load_view ('master-data/service/edit-form', $data);
		}

	public function update_service()
		{
		if (isset ($_POST['submit']))
			{
			$itemcode = strtolower (str_replace (' ', '', $this->input->post ('item_name')) . $this->input->post ('uom') . $this->input->post ('size'));
			$id = $this->input->post ('id');

			$get_data = $this->db->get_where ("m_master_data_material", array(
				"id" => $id,
			))->row ();

			$material_code = $this->input->post ('item_code');

			$exist = $this->db->get_where ("m_master_data_material", array(
				"item_code" => $itemcode,
			))->row ();

			if (($itemcode != $get_data->item_code) && $exist)
				{
				$err = array(
					'show' => true,
					'type' => 'error',
					'msg' => 'Add new service failed. Service with code ' . $material_code . ' is already exist.'
				);
				$this->session->set_flashdata ('toast', $err);
				$this->load->view ('service_management/master_data.php');
				}
			else
				{
				$inserted = _update (
					"m_master_data_material",
					array(
						"item_code" => $itemcode,
						"item_name" => $this->input->post ('item_name'),
						"type" => 'service',
						"service_type" => $this->input->post ('service_type'),
						"service_recurring" => $this->input->post ('service_recurring'),
						"service_due_date" => $this->input->post ('service_due_date'),
						"service_urgent_if" => $this->input->post ('service_urgent_if'),
						"service_category" => $this->input->post ('service_category'),
					),
					array("id" => $id)
				);


				if ($inserted)
					{
					$err = array(
						'show' => true,
						'type' => 'success',
						'msg' => 'Successfully update material data.'
					);
					$this->session->set_flashdata ('toast', $err);
					}
				else
					{
					$err = array(
						'show' => true,
						'type' => 'error',
						'msg' => 'Update material failed.'
					);
					$this->session->set_flashdata ('toast', $err);
					}
				redirect ('service_management/master_data');
				}
			}
		else
			{
			redirect ('service_management/master_data');
			}
		}

	public function delete_service()
		{
		$id = _decrypt ($this->input->get ('id'));
		$deleted = _soft_delete ("m_master_data_material", array("id" => $id));

		if ($deleted)
			{
			$err = array(
				'show' => true,
				'type' => 'error',
				'msg' => 'Successfully delete material data.'
			);
			$this->session->set_flashdata ('toast', $err);
			}
		else
			{
			$err = array(
				'show' => true,
				'type' => 'error',
				'msg' => 'Delete material failed.'
			);
			$this->session->set_flashdata ('toast', $err);
			}
		redirect ('master_data/material_list');
		}
	}
