<?php

class Master_data extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		$this->load->model('master_model');
		if(!$this->auth_model->current_user()){
			redirect('auth/login');
		}
	}

	public function index()
	{
		$this->session->set_flashdata('page_title', 'MASTER DATA MATERIAL BY VENDOR');
		$this->load->view('master-data/index.php');
	}

	public function material()
	{
		$this->session->set_flashdata('page_title', 'MASTER DATA MATERIAL BY FACTORY');
		$this->load->view('master-data/master-material.php');
	}	

	public function vendor_list()
	{
		$this->session->set_flashdata('page_title', 'MASTER DATA VENDOR');
		$this->load->view('master-data/vendor-list.php');
	}		

	public function material_list()
	{
		$this->session->set_flashdata('page_title', 'MASTER DATA MATERIAL');
		$this->load->view('master-data/material-list.php');
	}		

	function get_master_vendor()
	{
			$search = $this->session->userdata('search');
			$list = $this->master_model->get_datatables($search, 'vendor');
			$data = array();
			$no = $_POST['start'];
			foreach ($list as $field) {
					$edit 	= '
					<a href="" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">
						<i class="fa-solid fa-circle-info"></i>						
					</a>';	
					$link 	= '
					<a href="'.$field->link.'" class="btn btn-outline-primary" target="_blank" data-toggle="tooltip" data-placement="top" title="Link">
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
					$row[] = $field->est_lead_time;
					$row[] = myCurr($field->price_per_uom);
					$row[] = myNum($field->moq);
					$row[] = myCurr($field->total_price);
					$row[] = myCurr($field->price_equal_moq);
					$row[] = myCurr($field->price_moq_divide_moq);
					$row[] = myDecimal($field->saving);
					$row[] = $field->place_to_buy;
					$row[] = $link;
					$row[] = $edit;
					$data[] = $row;
			}
  
			$output = array(
					"draw" => $_POST['draw'],
					"recordsTotal" => $this->master_model->count_all($search, 'vendor'),
					"recordsFiltered" => $this->master_model->count_filtered($search, 'vendor'),
					"data" => $data,
			);
			//output dalam format JSON
			echo json_encode($output);
	}	

	function get_master_material()
	{
			$search = $this->session->userdata('search');
			$list = $this->master_model->get_datatables($search, 'material');
			$data = array();
			$no = $_POST['start'];
			foreach ($list as $field) {
					$edit 	= '
					<a href="'.$field->item_code.'" class="btn btn-outline-primary">
						<i class="fa-solid fa-circle-info"></i>						
					</a>';	

					$row = array();
					$row[] = ++$no;
					$row[] = $field->item_code;
					$row[] = $field->item_name;
					$row[] = $field->factory;
					$row[] = $field->uom;
					$row[] = $field->lt_pr_po;
					$row[] = $field->vendor_code;
					$row[] = myNum($field->lot_size);
					$row[] = myNum($field->initial_value_stock);
					$row[] = myNum($field->order_cycle);
					$row[] = myNum($field->initial_stock);
					$row[] = myNum($field->lt_po_to_delivery);
					$row[] = myNum($field->standar_safety_stock);
					$row[] = myNum($field->initial_value_for_to_do);
					$row[] = $edit;
					$data[] = $row;
			}

			$output = array(
					"draw" => $_POST['draw'],
					"recordsTotal" => $this->master_model->count_all($search, 'vendor'),
					"recordsFiltered" => $this->master_model->count_filtered($search, 'vendor'),
					"data" => $data,
			);
			//output dalam format JSON
			echo json_encode($output);
	}	

	function get_master_vendor_list()
	{
			$search = $this->session->userdata('search');
			$list = $this->master_model->get_datatables($search, 'vendor_list');
			$data = array();
			$no = $_POST['start'];
			foreach ($list as $field) {
					$edit 	= '
					<a href="'.site_url('master_data/vendor_detail/'._encrypt($field->id)).'" class="btn btn-outline-primary">
						<i class="fa-solid fa-circle-info"></i>						
					</a>';	

					$row = array();
					$row[] = ++$no;
					$row[] = $field->vendor_code;
					$row[] = $field->category;
					$row[] = $field->vendor_name;
					$row[] = $field->rating;
					$row[] = $edit;
					$data[] = $row;
			}

			$output = array(
					"draw" => $_POST['draw'],
					"recordsTotal" => $this->master_model->count_all($search, 'vendor_list'),
					"recordsFiltered" => $this->master_model->count_filtered($search, 'vendor_list'),
					"data" => $data,
			);
			//output dalam format JSON
			echo json_encode($output);
	}		
	public function add_vendor()
	{
		$this->session->set_flashdata('page_title', 'FORM ADD NEW VENDOR');
		$this->load->view('master-data/vendor/add-form.php');
	}	

	public function save_vendor()
	{
		if(isset($_POST['submit'])){
			$vendor_code = $this->input->post('vendor_code');
			$exist = $this->db->get_where("m_master_data_vendor",array(
				"vendor_code"	=> $this->input->post('vendor_code'),
			))->row();

			if($exist){
				$err = array(
					'show' => true,
					'type' => 'error',
					'msg'  => 'Add new vendor failed. Vendor with code '.$vendor_code.' is already exist.'
				);
				$this->session->set_flashdata('toast', $err);
				$this->load->view('master-data/vendor/add-form.php');		
			}else{
				$inserted = $this->db->insert(
					"m_master_data_vendor", 
					array(
						"vendor_code" 		=> $this->input->post('vendor_code'),
						"vendor_name" 		=> $this->input->post('vendor_name'),
						"est_lead_time"		=> $this->input->post('est_lead_time'),
						"category"			=> $this->input->post('category'),
						"rating"			=> $this->input->post('rating'),
						"time_add"			=> date("Y-m-d H:i:s"),
						"time_update"		=> date("Y-m-d H:i:s"),
					));

				if($inserted){
					$err = array(
						'show' => true,
						'type' => 'success',
						'msg'  => 'Successfully added new vendor.'
					);
					$this->session->set_flashdata('toast', $err);
				}else{
					$err = array(
						'show' => true,
						'type' => 'error',
						'msg'  => 'Add new vendor failed.'
					);
					$this->session->set_flashdata('toast', $err);
				}
			}
			redirect('master_data/vendor_list');
		}else{
			redirect('master_data/vendor_list');
		}
	}

	public function vendor_detail()
	{
		$vendor_code = _decrypt($this->uri->segment(3));
		$data['vendor'] = $this->db->get_where("m_master_data_vendor",array(
			"id"	=> $vendor_code,
		))->row();		
		// debugCode($data);

		$this->session->set_flashdata('page_title', 'FORM DETAIL VENDOR');
		load_view('master-data/vendor/detail.php', $data);
		// debugCode(_decrypt($vendor_code));
	}	

	function get_material_list_by_vendor()
	{
			$vendor_code = _decrypt($this->input->get('vendor_code'));
			$search = array(
				"vendor_code" => $vendor_code
			);

			$list = $this->master_model->get_datatables($search, 'vendor');
			$data = array();
			$no = $_POST['start'];
			foreach ($list as $field) {
					$edit 	= '
					<a href="" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">
						<i class="fa-solid fa-circle-info"></i>						
					</a>';	
					$link 	= '
					<a href="'.$field->link.'" class="btn btn-outline-primary" target="_blank" data-toggle="tooltip" data-placement="top" title="Link">
						<i class="fa-solid fa-up-right-from-square"></i>		
					</a>';	

					$row[] = $field->item_name;
					$row[] = $field->uom;
					$row[] = myCurr($field->price_per_uom);
					$row[] = myNum($field->moq);
					$row[] = myCurr($field->total_price);
					$row[] = myCurr($field->price_equal_moq);
					$row[] = myCurr($field->price_moq_divide_moq);
					$row[] = myDecimal($field->saving);
					$row[] = $field->place_to_buy;
					$row[] = $link;
					$row[] = $edit;
					$data[] = $row;
			}

			$output = array(
					"draw" => $_POST['draw'],
					"recordsTotal" => $this->master_model->count_all($search, 'vendor'),
					"recordsFiltered" => $this->master_model->count_filtered($search, 'vendor'),
					"data" => $data,
			);
			//output dalam format JSON
			echo json_encode($output);
	}	

	public function edit_vendor()
	{
		$vendor_code = _decrypt($this->uri->segment(3));
		$data['vendor'] = $this->db->get_where("m_master_data_vendor",array(
			"id"	=> $vendor_code,
		))->row();		
		// debugCode($data);

		$this->session->set_flashdata('page_title', 'FORM EDIT VENDOR');
		load_view('master-data/vendor/edit-form', $data);
	}
	
	public function update_vendor()
	{
		if(isset($_POST['submit'])){
			$id = $this->input->post('id');
			$inserted = $this->db->update(
				"m_master_data_vendor", 
				array(
					"vendor_name" 		=> $this->input->post('vendor_name'),
					"est_lead_time"		=> $this->input->post('est_lead_time'),
					"category"			=> $this->input->post('category'),
					"rating"			=> $this->input->post('rating'),
					"time_update"		=> date("Y-m-d H:i:s"),
				), array("id" => $id)
			);

			if($inserted){
				$err = array(
					'show' => true,
					'type' => 'success',
					'msg'  => 'Successfully update vendor data.'
				);
				$this->session->set_flashdata('toast', $err);
			}else{
				$err = array(
					'show' => true,
					'type' => 'error',
					'msg'  => 'Update vendor failed.'
				);
				$this->session->set_flashdata('toast', $err);
			}
			redirect('master_data/vendor_detail/'._encrypt($id));
		}else{
			redirect('master_data/vendor_list');
		}
	}	

	public function add_material()
	{
		$this->session->set_flashdata('page_title', 'FORM ADD NEW MATERIAL');
		load_view('master-data/material/add-form.php', []);
	}	

	public function save_material()
	{
		if(isset($_POST['submit'])){
			$material_code = $this->input->post('material_code');
			$exist = $this->db->get_where("m_master_data_material",array(
				"item_code"	=> $this->input->post('material_code'),
			))->row();

			if($exist){
				$err = array(
					'show' => true,
					'type' => 'error',
					'msg'  => 'Add new material failed. Material with code '.$material_code.' is already exist.'
				);
				$this->session->set_flashdata('toast', $err);
				$this->load->view('master-data/material/add-form.php');		
			}else{
				$inserted = $this->db->insert(
					"m_master_data_material", 
					array(
						"item_code" 				=> $this->input->post('item_code'),
						"item_name" 				=> $this->input->post('item_name'),
						"factory"					=> $this->input->post('factory'),
						"uom"						=> $this->input->post('uom'),
						"lt_pr_po"					=> $this->input->post('lt_pr_po'),
						"vendor_code"				=> $this->input->post('vendor_code'),
						"lot_size"					=> $this->input->post('lot_size'),
						"initial_value_stock"		=> $this->input->post('initial_value_stock'),
						"order_cycle"				=> $this->input->post('order_cycle'),
						"initial_stock"				=> $this->input->post('initial_stock'),
						"standart_safety_stock"		=> $this->input->post('standart_safety_stock'),
						"initial_value_for_to_do"	=> $this->input->post('initial_value_for_to_do'),
						"price_per_uom"		=> $this->input->post('price_per_uom'),
						"price_equal_moq"	=> $this->input->post('price_equal_moq'),
						"place_to_buy"		=> $this->input->post('place_to_buy'),
						"link"				=> $this->input->post('link'),
						"moq"				=> $this->input->post('moq'),
						"time_add"			=> date("Y-m-d H:i:s"),
						"time_update"		=> date("Y-m-d H:i:s"),
					));

				if($inserted){
					$err = array(
						'show' => true,
						'type' => 'success',
						'msg'  => 'Successfully added new material.'
					);
					$this->session->set_flashdata('toast', $err);
				}else{
					$err = array(
						'show' => true,
						'type' => 'error',
						'msg'  => 'Add new material failed.'
					);
					$this->session->set_flashdata('toast', $err);
				}
			}
			redirect('master_data/material_list');
		}else{
			redirect('master_data/material_list');
		}
	}

	public function material_detail()
	{
		$vendor_code = _decrypt($this->uri->segment(3));
		$data['vendor'] = $this->db->get_where("m_master_data_vendor",array(
			"id"	=> $vendor_code,
		))->row();		
		// debugCode($data);

		$this->session->set_flashdata('page_title', 'FORM DETAIL VENDOR');
		load_view('master-data/vendor/detail.php', $data);
		// debugCode(_decrypt($vendor_code));
	}		
}
