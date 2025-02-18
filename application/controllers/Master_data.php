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
					<a href="'.$field->vendor_code.'" class="btn btn-outline-primary">
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
}
