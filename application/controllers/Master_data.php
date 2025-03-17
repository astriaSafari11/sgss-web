<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Master_data extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		$this->load->model('master_model');
		$this->load->model('gross_req_model');
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
					$row[] = myNum($field->moq);
					$row[] = myCurr($field->price_per_uom);
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
	function get_master_material_by_factory()
	{
			$search = $this->session->userdata('search');
			$list = $this->master_model->get_datatables($search, 'material_by_factory');
			$data = array();
			$no = $_POST['start'];
			foreach ($list as $field) {
					$row = array();
					$row[] = ++$no;
					$row[] = $field->item_code;
					$row[] = $field->item_name;
					$row[] = $field->vendor_code;
					$row[] = $field->factory;
					$row[] = $field->uom;
					$row[] = $field->moq;
					$row[] = $field->est_lead_time;
					$row[] = $field->lt_pr_po;
					$row[] = myNum($field->lt_po_deliv);
					$row[] = $field->lot_size;
					$row[] = $field->order_cycle;
					$row[] = myNum($field->initial_stock);
					$row[] = myNum($field->standart_safety_stock);
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
					<a href="'.site_url('master_data/detail_material/'._encrypt($field->id)).'" class="btn btn-sm btn-outline-primary" style="font-weight: 600; border-radius: 50px;margin-right:5px;">
						<i class="fa-solid fa-info-circle"></i>
						Detail
					</a>
					<div class="modal fade" id="modal-delete-'.$field->id.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel" class="text-primary" style="color: #001F82;font-weight:600;">Delete Material</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body" style="text-align: left;">
									<p>You are going to delete material '.$field->item_code.' - '.$field->item_name.', all data related with this material will be deleted. Are you sure?</p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">No, Cancel Delete.</button>
									<a href="'.site_url('master_data/delete_material?id='._encrypt($field->id)).'" type="button" class="btn btn-outline-danger">Yes, Delete Data.</a>
								</div>
							</div>
						</div>
					</div>					
				  ';	

					$row = array();
					$row[] = ++$no;
					$row[] = $field->item_code;
					$row[] = $field->item_name;
					$row[] = $field->factory;
					$row[] = $field->size;
					$row[] = $field->uom;
					$row[] = $field->lot_size;
					$row[] = $field->order_cycle;
					$row[] = $field->initial_stock;
					$row[] = myNum($field->gen_lead_time);
					$row[] = myNum($field->standard_safety_stock);
					$row[] = $edit;
					$data[] = $row;
			}

			$output = array(
					"draw" => $_POST['draw'],
					"recordsTotal" => $this->master_model->count_all($search, 'material'),
					"recordsFiltered" => $this->master_model->count_filtered($search, 'material'),
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
				$inserted = _add(
					"m_master_data_vendor",
					array(
						"vendor_code" 		=> $this->input->post('vendor_code'),
						"vendor_name" 		=> $this->input->post('vendor_name'),
						"est_lead_time"		=> $this->input->post('est_lead_time'),
						"category"			=> $this->input->post('category'),
						"rating"			=> $this->input->post('rating'),						
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
		$search = $this->session->userdata('search');
		$list = $this->master_model->get_datatables(array(
			"vendor_code" => _decrypt($this->input->get('id'))
		), 'vendor');

		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
				$link 	= '
				<a href="'.$field->link.'" class="btn btn-sm btn-outline-primary" target="_blank" data-bs-toggle="tooltip" data-bs-title="'.$field->link.'">
					<i class="fa-solid fa-up-right-from-square"></i>		
				</a>';	
				$edit 	= '
				<a href="'.site_url('master_data/edit_vendor_material/'._encrypt($field->id)).'" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" data-bs-title="'.$field->link.'">
					<i class="fa-solid fa-pen-to-square"></i>		
				</a>';
				$row = array();
				$row[] = ++$no;
				$row[] = $field->item_code;
				$row[] = $field->item_name;
				$row[] = $field->factory;
				$row[] = $field->uom;
				$row[] = myCurr($field->price_per_uom);
				$row[] = myNum($field->moq);
				$row[] = myCurr($field->total_price);
				$row[] = myCurr($field->price_equal_moq);
				$row[] = myCurr($field->price_moq_divide_moq);
				$row[] = myDecimal($field->saving)." %";
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
			$inserted = _update(
				"m_master_data_vendor", 
				array(
					"vendor_name" 		=> $this->input->post('vendor_name'),
					"est_lead_time"		=> $this->input->post('est_lead_time'),
					"category"			=> $this->input->post('category'),
					"rating"			=> $this->input->post('rating'),
				), array("id" => $id)
			);

			$vendor = $this->db->get_where("m_master_data_vendor",array(
				"id"	=> $id,
			))->row();	
			
			$material = $this->db->get_where("m_vendor_material",array(
				"vendor_code"	=> $vendor->vendor_code,
			))->result();	

			foreach($material as $item){
				$lt_po_deliv = $vendor->est_lead_time+$item->lt_pr_po;
				_update('m_vendor_material', array('lt_po_deliv' => $lt_po_deliv), array('id' => $item->id));
			}

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

	public function delete_vendor()
	{
		$id = _decrypt($this->input->get('id'));		
		$deleted = _soft_delete("m_master_data_vendor", array("id" => $id));

		if($deleted){
			$err = array(
				'show' => true,
				'type' => 'error',
				'msg'  => 'Successfully delete vendor data.'
			);
			$this->session->set_flashdata('toast', $err);
		}else{
			$err = array(
				'show' => true,
				'type' => 'error',
				'msg'  => 'Delete vendor failed.'
			);
			$this->session->set_flashdata('toast', $err);
		}
		redirect('master_data/vendor_list');
	}	


	public function add_material()
	{
		$this->session->set_flashdata('page_title', 'FORM ADD NEW MATERIAL');
		load_view('master-data/material/add-form.php', []);
	}	

	public function save_material()
	{
		if(isset($_POST['submit'])){
			$itemcode = strtolower(str_replace(' ','',$this->input->post('item_name')).$this->input->post('uom').$this->input->post('size'));

			$material_code = $this->input->post('material_code');
			$exist = $this->db->get_where("m_master_data_material",array(
				"item_code"	=> $itemcode,
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
				$standart_safety_stock = !empty($this->input->post('order_cycle'))&&!empty($this->input->post('lot_size'))?($this->input->post('gen_lead_time')/$this->input->post('order_cycle'))*$this->input->post('lot_size'):NULL;

				$inserted = _add(
					"m_master_data_material",
					array(
						"item_code" 				=> $itemcode,
						"item_name" 				=> $this->input->post('item_name'),
						"type" 						=> 'goods',
						"size" 						=> $this->input->post('size'),
						"factory"					=> $this->input->post('factory'),
						"uom"						=> $this->input->post('uom'),						
						"lot_size"					=> $this->input->post('lot_size'),						
						"order_cycle"				=> $this->input->post('order_cycle'),						
						"initial_stock"				=> $this->input->post('initial_stock'),						
						"gen_lead_time"				=> $this->input->post('gen_lead_time'),						
						"standard_safety_stock"		=> round($standart_safety_stock),						
					));				
				if($inserted){

					$get_last_id = $this->db->get_where("m_master_data_material",array(
						"item_code" => $itemcode
					));

					if($get_last_id->num_rows() > 0){
						$last_id = $get_last_id->row();
						$last_id = $last_id->id;

						generate_gross_requirement($last_id);
						generate_var_settings($last_id,
							$this->input->post('var_todo_list'),
							$this->input->post('var_stock_card_todo_list'),
							$this->input->post('var_stock_card_overstock'),
							$this->input->post('var_stock_card_ok'));

						generate_budget_baseline($last_id,str_replace(',','',$this->input->post('budget_price')),str_replace(',','',$this->input->post('budget_target')));
						generate_item_movement($last_id);

						_add('m_material_budget', array(
							"item_id" => $last_id,
							"item_code" => $itemcode,
							"annual_budget" => 0,
							"annual_usage" => 0,
							"year" => date('Y')
						));
					}
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
			redirect('master_data/detail_material/'._encrypt($last_id));
		}else{
			redirect('master_data/material_list');
		}
	}

	public function detail_material()
	{
		$item_code = _decrypt($this->uri->segment(3));
		$data['material'] = $this->db->get_where("m_master_data_material",array(
			"id" => $item_code
		))->row();		

		$data['settings'] = $this->db->get_where("m_variable_settings",array(
			"item_id" => $item_code
		))->row();		

		$data['baseline_budget'] = $this->db->get_where("m_material_baseline_price",array(
			"item_id" => $item_code
		))->result();		

		$data['annual_budget'] = $this->db->get_where("m_material_budget",array(
			"item_id" => $item_code
		))->result();		

		$this->session->set_flashdata('page_title', 'GOODS MATERIAL DETAIL');
		load_view('master-data/material/detail', $data);
	}	

	public function add_annual_budget()
	{
		if(isset($_POST['submit'])){
			$id = $this->input->post('item_id');
			$year = $this->input->post('year');
			$annual_budget = str_replace(',', '', $this->input->post('annual_budget'));
			$exist = $this->db->get_where("m_material_budget",array(
				"item_id" => $id,
				"year" => $year
			))->row();

			$get_target_price = $this->db->get_where("m_material_baseline_price",array(
				"item_id" => $id
			))->row();

			$targetPrice = $annual_budget/$this->input->post('annual_usage');

			if($exist){
				$err = array(
					'show' => true,
					'type' => 'error',
					'msg'  => 'Cannot add annual budget. Annual budget for year '.$year.' is already exist.'
				);
				$this->session->set_flashdata('toast', $err);				
			}else{
				$inserted = _add('m_material_budget', array(
					"item_id" 		=> $id,
					"item_code" 	=> $this->db->get_where("m_master_data_material",array(
										"id" => $id
									))->row()->item_code,
					"annual_budget" => $annual_budget,
					"annual_usage" 	=> $this->input->post('annual_usage'),
					"year" => $year
				));

				if($inserted){
					if($get_target_price && (date('Y') == $year)){
						_update(
							"m_material_baseline_price", 
							array(
								"baseline_price" => $targetPrice,								
							), array(
								"item_id" => $id,
								"baseline_category" => "Budget"
							));
					}					
					$err = array(
						'show' => true,
						'type' => 'success',
						'msg'  => 'Successfully added new annual budget.'
					);
					$this->session->set_flashdata('toast', $err);
				}else{
					$err = array(
						'show' => true,
						'type' => 'error',
						'msg'  => 'Add new annual budget failed.'
					);
					$this->session->set_flashdata('toast', $err);
				}
				redirect('master_data/detail_material/'._encrypt($id));
			}
			redirect('master_data/detail_material/'._encrypt($id));			
		}
	}	

	public function edit_annual_budget()
	{
		if(isset($_POST['submit'])){
			$id = $this->input->post('id');
			$item_id = $this->input->post('item_id');
			$year = $this->input->post('year');
			$annual_budget = str_replace(',', '', $this->input->post('annual_budget'));
			$annual_usage = $this->input->post('annual_usage');

			$get_target_price = $this->db->get_where("m_material_baseline_price",array(
				"item_id" => $item_id
			))->row();

			$targetPrice = $annual_budget/$annual_usage;
			
			$update  =_update(
				"m_material_budget", 
				array(					
					"annual_budget" => $annual_budget,
					"annual_usage" => $annual_usage
				), array(
					"id" => $id
				));

				if($update){
					if($get_target_price && (date('Y') == $year)){
						_update(
							"m_material_baseline_price", 
							array(
								"baseline_price" => $targetPrice,								
							), array(
								"item_id" => $item_id,
								"baseline_category" => "Budget"
							));
					}

					$err = array(
						'show' => true,
						'type' => 'success',
						'msg'  => 'Successfully update new annual budget.'
					);
					$this->session->set_flashdata('toast', $err);
				}else{
					$err = array(
						'show' => true,
						'type' => 'error',
						'msg'  => 'Update annual budget failed.'
					);
					$this->session->set_flashdata('toast', $err);
				}
				redirect('master_data/detail_material/'._encrypt($item_id));	
		}
	}	


	public function edit_material()
	{
		$item_code = _decrypt($this->uri->segment(3));
		$data['material'] = $this->db->get_where("m_master_data_material",array(
			"id" => $item_code
		))->row();		

		$data['settings'] = $this->db->get_where("m_variable_settings",array(
			"item_id" => $item_code
		))->row();		

		$data['budget'] = $this->db->get_where("m_material_baseline_price",array(
			"item_id" => $item_code,
			"baseline_category" => "Target",
		))->row();		

		$this->session->set_flashdata('page_title', 'FORM EDIT MATERIAL');
		load_view('master-data/material/edit-form', $data);
	}
	
	public function update_material()
	{
		if(isset($_POST['submit'])){
			$id = $this->input->post('id');			
			$inserted = _update(
				"m_master_data_material", 
				array(
					"item_code" 				=> $this->input->post('item_code'),
					"item_name" 				=> $this->input->post('item_name'),
					"factory"					=> $this->input->post('factory'),
					"uom"						=> $this->input->post('uom'),	
					"lot_size"					=> $this->input->post('lot_size'),						
					"order_cycle"				=> $this->input->post('order_cycle'),						
					"initial_stock"				=> $this->input->post('initial_stock'),						
				), array("id" => $id)
			);

			_update(
				"m_variable_settings", 
				array(
					"var_todo_list"             => $this->input->post('var_todo_list'),
					"var_stock_card_todo_list"  => $this->input->post('var_stock_card_todo_list'),
					"var_stock_card_overstock"  => $this->input->post('var_stock_card_overstock'),
					'var_stock_card_ok'         => $this->input->post('var_stock_card_ok'),
					'var_pending_approval'      => $this->input->post('var_pending_approval'),
				), array("item_id" => $id));
			
			_update(
				"m_material_baseline_price", 
				array(
					"baseline_price" => str_replace(',', '', $this->input->post('budget_target')),
				),
				array(
					"item_id" => $id,
					"baseline_category" => "Target"
				));

			if($inserted){
				$err = array(
					'show' => true,
					'type' => 'success',
					'msg'  => 'Successfully update material data.'
				);
				$this->session->set_flashdata('toast', $err);
			}else{
				$err = array(
					'show' => true,
					'type' => 'error',
					'msg'  => 'Update material failed.'
				);
				$this->session->set_flashdata('toast', $err);
			}
			redirect('master_data/detail_material/'._encrypt($id));
		}else{
			redirect('master_data/material_list');
		}
	}		

	public function delete_material()
	{
		$id = _decrypt($this->input->get('id'));		
		$deleted = _soft_delete("m_master_data_material", array("id" => $id));

		if($deleted){
			$err = array(
				'show' => true,
				'type' => 'error',
				'msg'  => 'Successfully delete material data.'
			);
			$this->session->set_flashdata('toast', $err);
		}else{
			$err = array(
				'show' => true,
				'type' => 'error',
				'msg'  => 'Delete material failed.'
			);
			$this->session->set_flashdata('toast', $err);
		}
		redirect('master_data/material_list');
	}	
	public function edit_vendor_material()
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

		// debugCode($data);

		$this->session->set_flashdata('page_title', 'FORM EDIT VENDOR MATERIAL');
		load_view('master-data/vendor/material/edit-form', $data);
	}

	public function item_movement()
	{
		$id = _decrypt($this->uri->segment(3));

		generate_item_movement($id);

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

		$this->session->set_flashdata('page_title', 'INPUT ITEM MOVEMENT MATERIAL');
		load_view('master-data/vendor/material/item-movement', $data);
	}	

	public function update_vendor_material()
	{
		if(isset($_POST['submit'])){
			$id = $this->input->post('id');

			$get_data = $this->db->get_where("m_vendor_material",array(
				"id"	=> $id,
			))->row();		
	
			$vendor = $this->db->get_where("m_master_data_vendor",array(
				"vendor_code"	=> $get_data->vendor_code,
			))->row();

			$material = $this->db->get_where("m_master_data_material",array(
				"item_code"	=> $get_data->item_code,
			))->row();

			$lt_po_deliv = !empty($this->input->post('lt_pr_po'))?$vendor->est_lead_time + $this->input->post('lt_pr_po'):NULL;
			$standart_safety_stock = !empty($material->order_cycle)&&!empty($material->lot_size)?($lt_po_deliv/$material->order_cycle)*$material->lot_size:NULL;
			$price_per_uom = !empty($this->input->post('price_per_uom'))?str_replace(',', '', $this->input->post('price_per_uom')):NULL;
			$price_equal_moq = !empty($this->input->post('price_equal_moq'))?str_replace(',', '', $this->input->post('price_equal_moq')):NULL;

			$inserted = _update(
				"m_vendor_material", 
				array(
					"moq" 							=> $this->input->post('moq'),
					"lt_pr_po" 						=> $this->input->post('lt_pr_po'),
					"lot_size"						=> $material->lot_size,
					"initial_stock"					=> $material->initial_stock,	
					"order_cycle"					=> $material->order_cycle,	
					"lt_po_deliv"					=> $lt_po_deliv,	
					"standart_safety_stock"			=> $standart_safety_stock,	
					"price_per_uom"					=> $price_per_uom,	
					"price_equal_moq"				=> $price_equal_moq,	
					"place_to_buy"					=> $this->input->post('place_to_buy'),	
					"link"							=> $this->input->post('link'),	

				), array("id" => $id)
			);

			if($inserted){
				$err = array(
					'show' => true,
					'type' => 'success',
					'msg'  => 'Successfully update material data.'
				);
				$this->session->set_flashdata('toast', $err);
			}else{
				$err = array(
					'show' => true,
					'type' => 'error',
					'msg'  => 'Update material failed.'
				);
				$this->session->set_flashdata('toast', $err);
			}
			redirect('master_data/edit_vendor_material/'._encrypt($id));
		}else{
			redirect('master_data/vendor_list');
		}
	}	
	
	function get_gross_req()
	{		
		$search = array(
			"item_id" => _decrypt($this->input->get('id'))
		);
		$list = $this->gross_req_model->get_datatables($search);

		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
				$frm = $field->type=='formula'?"selected":"";
				$m = $field->type=='manual'?'selected':'';
				$edit 	= '
				<a class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal-update-gross-req-'.$field->id.'" >
					<i class="fa-solid fa-pen-to-square" data-bs-toggle="tooltip" data-bs-title="Edit Gross Requirement Formula"></i> Edit		
				</a>
                      <form action="'.site_url('master_data/update_gross_req/'._encrypt($field->id)).'" method="post">
                        <div class="modal fade" id="modal-update-gross-req-'.$field->id.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <input type="hidden" name="material_movement_id" value="<?php echo $item_movement[$i-1]->id;?>">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel" class="text-primary" style="color: #001F82;font-weight:600;">Update Gross Requirement Data, Week '.$field->week.'</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                            <div class="col-12">
                                              <div class="row">
												<div class="col-4">
													<div class="form-floating mb-3">
														<select class="form-select" aria-label="Default select example" id="uom" style="height: 56px;" name="type" required>
														<option value="">-- Select Method --</option>
														<option value="formula" '.$frm.'>Formula</option>
														<option value="manual" '.$m.'>Manual</option>
														</select>
														<label for="uom" class="fw-bold text-primary">Input Method</label>
														<div class="invalid-feedback">This field is required.</div>
													</div>
												</div>										  
                                                <!--begin::Col-->
                                                <div class="col-4">
                                                  <div class="form-floating mb-3">
                                                    <input type="number" min="1" max="52" class="form-control" id="floatingInput" placeholder="name@example.com" name="week_start_average" value ="'.$field->week_start_average.'">
                                                    <label for="floatingInput" class="fw-bold text-primary">AVG Week Start</label>
                                                  </div>
                                                </div>
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                                <div class="col-4">
                                                  <div class="form-floating mb-3">
                                                    <input type="number" min="1" max="52" class="form-control" id="floatingInput" placeholder="name@example.com" name="week_end_average" value ="'.$field->week_end_average.'">
                                                    <label for="floatingInput" class="fw-bold text-primary">AVG Week End</label>
                                                  </div>
                                                </div>
                                                <!--end::Col-->                              
                                                <!--begin::Col-->
                                                <div class="col-12">
                                                  <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="reason" value ="" required>
                                                    <label for="floatingInput" class="fw-bold text-primary">Update Reason</label>
                                                  </div>
                                                </div>
                                                <!--end::Col--> 												
                                            </div>         
                                          </div>
                                          </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Cancel</button>
                                  <button type="submit" name="submit" class="btn btn-outline-primary">Update Data</button>
                                </div>
                              </div>
                            </div>
                        </div>  
                      </form>				
				';


				$manual 	= '
				<a class="btn btn-sm btn-primary" target="_blank">
					manual		
				</a>';

				$formula 	= '
				<a class="btn btn-sm btn-warning" target="_blank">
					formula		
				</a>';				

				$row = array();
				$row[] = $field->year;
				$row[] = $field->week;
				$row[] = $field->type=='manual'?$manual:$formula;
				$row[] = $field->type=='manual'?'-':$field->week_start_average;
				$row[] = $field->type=='manual'?'-':$field->week_end_average;
				$row[] = $edit;
				$data[] = $row;
		}

		$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->gross_req_model->count_all($search),
				"recordsFiltered" => $this->gross_req_model->count_filtered($search),
				"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}	
	public function update_gross_req()
	{
		if(isset($_POST['submit'])){

			if($this->input->post('week_start_average') <= $this->input->post('week_end_average')){
				$err = array(
					'show' => true,
					'type' => 'error',
					'msg'  => 'Average week start must be less than average week end.'
				);
				$this->session->set_flashdata('toast', $err);			
			}

			$id = _decrypt($this->uri->segment(3));			
			$get_data = $this->db->get_where("m_stock_card_formula",array(
				"id" => $id
			))->row();

			$inserted = _update(
				"m_stock_card_formula", 
				array(
					"type" 						=> $this->input->post('type'),
					"week_start_average" 		=> $this->input->post('week_start_average'),
					"week_end_average"			=> $this->input->post('week_end_average'),
				), array("id" => $id)
			);

			_add(
				"t_stock_card_log", 
				array(
					"vendor_code" 				=> $get_data->vendor_code,
					"item_code" 				=> $get_data->item_code,
					"vendor_material_id"		=> $get_data->vendor_material_id,
					"week"						=> $get_data->week,
					"week_start_avg_og"			=> $get_data->week_start_average,
					"week_end_avg_og"			=> $get_data->week_end_average,
					"week_start_avg_up"			=> $this->input->post('week_start_average'),
					"week_end_avg_up"			=> $this->input->post('week_end_average'),
					"reason"					=> $this->input->post('reason'),
				)
			);

			if($inserted){
				$err = array(
					'show' => true,
					'type' => 'success',
					'msg'  => 'Successfully update gross requirement formula.'
				);
				$this->session->set_flashdata('toast', $err);
			}else{
				$err = array(
					'show' => true,
					'type' => 'error',
					'msg'  => 'Update gross requirement formula failed.'
				);
				$this->session->set_flashdata('toast', $err);
			}
			redirect('master_data/edit_material/'._encrypt($get_data->item_id));
		}else{
			redirect('master_data/material_list');
		}
	}
	
	public function generate() {
		ini_set("max_execution_time", 0);

		$reader = IOFactory::createReader('Xlsx');
		$spreadsheet = $reader->load('assets/format/template_master.xlsx');
		$spreadsheet->setActiveSheetIndexByName('uom');
		$sheet = $spreadsheet->getActiveSheet();
		$index = 2;
		$getData = $this->db->query("SELECT * FROM m_uom")->result();

		foreach ((array)$getData as $datas => $list) {
			// $sheet->insertNewRowBefore($index + 1, 1);
			$sheet->setCellValue("A{$index}", trim($list->uom_code));
			$sheet->setCellValue("B{$index}", trim($list->uom_name));

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
	
			$sheet->getStyle("A{$index}:B{$index}")->applyFromArray($styleArray);
			$index++;				
		}			

		$spreadsheet->setActiveSheetIndexByName('category');
		$sheet = $spreadsheet->getActiveSheet();
		$index = 2;
		$getData = $this->db->query("SELECT * FROM m_category")->result();

		foreach ((array)$getData as $datas => $list) {
			// $sheet->insertNewRowBefore($index + 1, 1);
			$sheet->setCellValue("A{$index}", trim($list->category_name));

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
	
			$sheet->getStyle("A{$index}:B{$index}")->applyFromArray($styleArray);
			$index++;				
		}		

		$spreadsheet->setActiveSheetIndexByName('factory');
		$sheet = $spreadsheet->getActiveSheet();
		$index = 2;
		$getData = $this->db->query("SELECT * FROM m_factory")->result();

		foreach ((array)$getData as $datas => $list) {
			// $sheet->insertNewRowBefore($index + 1, 1);
			$sheet->setCellValue("A{$index}", trim($list->factory_name));

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
	
			$sheet->getStyle("A{$index}:B{$index}")->applyFromArray($styleArray);
			$index++;				
		}		
		
		$spreadsheet->setActiveSheetIndexByName('vendor');
		$sheet = $spreadsheet->getActiveSheet();
		$index = 2;
		$getData = $this->db->query("SELECT * FROM m_master_data_vendor WHERE is_active = 1")->result();

		foreach ((array)$getData as $datas => $list) {
			// $sheet->insertNewRowBefore($index + 1, 1);
			$sheet->setCellValue("A{$index}", trim($list->vendor_code));
			$sheet->setCellValue("B{$index}", trim($list->category));
			$sheet->setCellValue("C{$index}", trim($list->rating));
			$sheet->setCellValue("D{$index}", trim($list->vendor_name));
			$sheet->setCellValue("E{$index}", trim($list->est_lead_time));

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
	
			$sheet->getStyle("A{$index}:B{$index}")->applyFromArray($styleArray);
			$index++;				
		}	
		
		$spreadsheet->setActiveSheetIndexByName('material');
		$sheet = $spreadsheet->getActiveSheet();
		$index = 2;
		$getData = $this->db->query("SELECT * FROM m_master_data_material WHERE is_active = 1")->result();

		foreach ((array)$getData as $datas => $list) {
			// $sheet->insertNewRowBefore($index + 1, 1);
			$sheet->setCellValue("A{$index}", trim($list->item_code));
			$sheet->setCellValue("B{$index}", trim($list->item_name));
			$sheet->setCellValue("C{$index}", trim($list->factory));
			$sheet->setCellValue("D{$index}", trim($list->uom));
			$sheet->setCellValue("E{$index}", trim($list->size));
			$sheet->setCellValue("F{$index}", trim($list->lot_size));
			$sheet->setCellValue("G{$index}", trim($list->order_cycle));
			$sheet->setCellValue("H{$index}", trim($list->initial_stock));

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
	
			$sheet->getStyle("A{$index}:B{$index}")->applyFromArray($styleArray);
			$index++;				
		}		

		$spreadsheet->setActiveSheetIndexByName('vendor_material');
		$sheet = $spreadsheet->getActiveSheet();
		$index = 2;
		$getData = $this->db->query("SELECT * FROM m_vendor_material WHERE is_active = 1")->result();

		foreach ((array)$getData as $datas => $list) {
			// $sheet->insertNewRowBefore($index + 1, 1);
			$sheet->setCellValue("A{$index}", trim($list->vendor_code));
			$sheet->setCellValue("B{$index}", trim($list->item_code));
			$sheet->setCellValue("C{$index}", trim($list->moq?$list->moq:0));
			$sheet->setCellValue("D{$index}", trim($list->lt_pr_po?$list->lt_pr_po:0));
			// $sheet->setCellValue("E{$index}", trim($list->lot_size?$list->lot_size:0));
			// $sheet->setCellValue("F{$index}", trim($list->order_cycle?$list->order_cycle:0));
			// $sheet->setCellValue("G{$index}", trim($list->initial_stock?$list->initial_stock:0));
			$sheet->setCellValue("E{$index}", trim($list->price_per_uom?$list->price_per_uom:0));
			$sheet->setCellValue("F{$index}", $list->price_per_uom*$list->moq);
			$sheet->setCellValue("G{$index}", trim($list->price_equal_moq?$list->price_equal_moq:0));
			$sheet->setCellValue("H{$index}", trim($list->place_to_buy));
			$sheet->setCellValue("I{$index}", trim($list->link));

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
	
			$sheet->getStyle("A{$index}:B{$index}")->applyFromArray($styleArray);
			$index++;				
		}		

		ob_end_clean();
        $writer = new Xlsx($spreadsheet); // instantiate Xlsx
        header('Content-type: application/vnd.ms-excel');
        // It will be called file.xls
        header('Content-Disposition: attachment; filename="template_master_data.xlsx"');
        // Write file to the browser
        $writer->save('php://output');
	}	
	
	public function upload() {
		ini_set("max_execution_time", 0);
		$path 		= 'assets/upload/';
		$json 		= [];
		$this->upload_config($path);
		if (!$this->upload->do_upload('file')) {
			$json = [
				'error_message' => $this->upload->display_errors(),
			];
		} else {
			$file_data 	= $this->upload->data();
			$file_name 	= $path.$file_data['file_name'];
			$arr_file 	= explode('.', $file_name);
			$extension 	= end($arr_file);
			if('csv' == $extension) {
				$reader 	= new \PhpOffice\PhpSpreadsheet\Reader\Csv();
			} else {
				$reader 	= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			}
			$spreadsheet 	= $reader->load($file_name);
			$count_success  = 0;
			$count_failed   = 0;
			$list 			= [];

			//check uom
			$sheetData 		= $spreadsheet->getSheetbyName('uom');
			$cellRow 		= $spreadsheet->getSheetbyName('uom')->getHighestRow();
			for($i=2;$i<=$cellRow;$i++){
				$uom = $sheetData->getCell('A'.$i)->getValue();
				$name = $sheetData->getCell('B'.$i)->getValue();
				if(!empty($uom)){
					$check = $this->db->query("SELECT * FROM m_uom WHERE uom_code = ? AND uom_name = ?", array($uom, $name))->row();
					if(empty($check)){
						_add("m_uom", array("uom_code" => $uom, "uom_name" => $name));
						$list [] = [
							"status" => "success",
							"data" => "New UoM ".$name." added",
						];							
					}
				}
			}

			//check category
			$sheetData 		= $spreadsheet->getSheetbyName('category');
			$cellRow 		= $spreadsheet->getSheetbyName('category')->getHighestRow();
			for($i=2;$i<=$cellRow;$i++){
				$name = $sheetData->getCell('A'.$i)->getValue();
				if(!empty($name)){
					$check = $this->db->query("SELECT * FROM m_category WHERE category_name = ?", array($name))->row();
					if(empty($check)){
						_add("m_category", array("category_name" => $name));

						$list [] = [
							"status" => "success",
							"data" => "New Category ".$name." added",
						];							
					}
				}
			}		
			
			//check factory
			$sheetData 		= $spreadsheet->getSheetbyName('factory');
			$cellRow 		= $spreadsheet->getSheetbyName('factory')->getHighestRow();
			for($i=2;$i<=$cellRow;$i++){
				$name = $sheetData->getCell('A'.$i)->getValue();
				if(!empty($name)){
					$check = $this->db->query("SELECT * FROM m_factory WHERE factory_name = ?", array($name))->row();
					if(empty($check)){
						_add("m_factory", array("factory_name" => $name));

						$list [] = [
							"status" => "success",
							"data" => "New Factory ".$name." added",
						];								
					}
				}
			}				

			//check material
			$sheetData 		= $spreadsheet->getSheetbyName('material');
			$cellRow 		= $spreadsheet->getSheetbyName('material')->getHighestRow();
			for($i=2;$i<=$cellRow;$i++){
				$item_code = $sheetData->getCell('A'.$i)->getValue();
				$item_name = $sheetData->getCell('B'.$i)->getValue();
				$factory = $sheetData->getCell('C'.$i)->getValue();
				$uom = $sheetData->getCell('D'.$i)->getValue();
				$size = $sheetData->getCell('E'.$i)->getValue();
				$lot_size = $sheetData->getCell('F'.$i)->getValue();
				$order_cycle = $sheetData->getCell('G'.$i)->getValue();
				$initial_stock = $sheetData->getCell('H'.$i)->getValue();

				if(!empty($item_name) && !empty($uom) && !empty($size) && !empty($lot_size) && !empty($order_cycle) && !empty($initial_stock)){
					$check = $this->db->query("SELECT * FROM m_master_data_material WHERE item_name = ? AND size = ? AND uom = ? ", array($item_name, $size, $uom))->row();
					$checkUoM = $this->db->query("SELECT * FROM m_uom WHERE uom_code = ? ", array($uom))->row();

					if(!is_numeric($lot_size) || !is_numeric($order_cycle) || !is_numeric($initial_stock)){
						$list [] = [
							"status" 	=> "failed",
							"data" 		=> "Incorrect data format on material row $i, please check and try again.",
						];									
					}else{
						if(empty($checkUoM)){
							$list [] = [
								"status" 	=> "failed",
								"data" 		=> "Incorrect data format on material row $i, please check and try again.",
							];																
						}else{
							if(empty($check)){
								$genItemcode = strtolower(str_replace(' ', '', $item_name).$uom.$size);
								_add("m_master_data_material", array("item_code" => $genItemcode, "item_name" => $item_name, "uom" => $uom, "size" => $size, "factory" => $factory, "lot_size" => $lot_size, "order_cycle" => $order_cycle, "initial_stock" => $initial_stock));	
		
								$get_last_id = $this->db->get_where("m_master_data_material",array(
									'item_code' => $genItemcode,
								))->row()->id;
				
								generate_gross_requirement($get_last_id);
								generate_var_settings($get_last_id,10,10,50,10);
		
								$list [] = [
									"status" => "success",
									"data" => "New material ".$genItemcode." - ".$item_name." added. ",
								];						
							}
						}	
					}				
				}
			}

			//check vendor
			$sheetData 		= $spreadsheet->getSheetbyName('vendor');
			$cellRow 		= $spreadsheet->getSheetbyName('vendor')->getHighestRow();
			for($i=2;$i<=$cellRow;$i++){
				$vendor_code = $sheetData->getCell('A'.$i)->getValue();
				$category = $sheetData->getCell('B'.$i)->getValue();
				$rating = $sheetData->getCell('C'.$i)->getValue();
				$vendor_name = $sheetData->getCell('D'.$i)->getValue();
				$est_lead_time = $sheetData->getCell('E'.$i)->getValue();

				if(!empty($vendor_code) && !empty($vendor_name) && !empty($est_lead_time) && !empty($category)){
					$check = $this->db->query("SELECT * FROM m_master_data_vendor WHERE vendor_code = ? ", array($vendor_code))->row();
					$checkCategory = $this->db->query("SELECT * FROM m_category WHERE category_name = ? ", array($category))->row();

					if(!is_numeric(($est_lead_time))){
						$list [] = [
							"status" 	=> "failed",
							"data" 		=> "Incorrect data format on vendor row $i, please check and try again.",
						];							
					}else{
						if(empty($checkCategory)){
							$list [] = [
								"status" 	=> "failed",
								"data" 		=> "Incorrect category on vendor row $i, please check and try again.",
							];							
						}else{
							if(empty($check)){
								_add("m_master_data_vendor", array("vendor_code" => $vendor_code, "category" => $category, "rating" => $rating, "vendor_name" => $vendor_name, "est_lead_time" => $est_lead_time));	
								$list [] = [
									"status" => "success",
									"data" => "New Vendor ".$vendor_code." - ".$vendor_name." added",
								];							
							}	
						}
					}
				}
			}	
			
			//check vendor material
			$sheetData 		= $spreadsheet->getSheetbyName('vendor_material');
			$cellRow 		= $spreadsheet->getSheetbyName('vendor_material')->getHighestRow();
			for($i=2;$i<=$cellRow;$i++){
				$vendor_code = $sheetData->getCell('A'.$i)->getValue();
				$item_code = $sheetData->getCell('B'.$i)->getValue();
				$moq = $sheetData->getCell('C'.$i)->getValue();
				$lt_pr_po = $sheetData->getCell('D'.$i)->getValue();
				// $lot_size = $sheetData->getCell('E'.$i)->getValue();
				// $order_cycle = $sheetData->getCell('F'.$i)->getValue();
				// $initial_stock = $sheetData->getCell('G'.$i)->getValue();
				$price_per_uom = $sheetData->getCell('E'.$i)->getValue();
				$price_equal_uom = $sheetData->getCell('G'.$i)->getValue();
				$place_to_buy = $sheetData->getCell('H'.$i)->getValue();
				$link = $sheetData->getCell('I'.$i)->getValue();

				if(!empty($vendor_code) && !empty($item_code)){
					$check = $this->db->query("SELECT * FROM m_vendor_material WHERE vendor_code = ? AND item_code = ? ", array($vendor_code, $item_code))->row();
					$checkVendor = $this->db->query("SELECT * FROM m_master_data_vendor WHERE vendor_code = ? ", array($vendor_code))->row();
					$checkMaterial = $this->db->query("SELECT * FROM m_master_data_material WHERE item_code = ? ", array($item_code))->row();

					if(empty($checkVendor) || empty($checkMaterial)){
						$list [] = [
							"status" 	=> "failed",
							"data" 		=> "Incorrect vendor material data on vendor material row $i, please check and try again.",
						];	
					}else{
						if(!is_numeric(($moq)) || !is_numeric(($lt_pr_po))){
							$list [] = [
								"status" 	=> "failed",
								"data" 		=> "Incorrect vendor material data on vendor material row $i, please check and try again.",
							];	
						}else{
							if(empty($check)){
								$vendor = $this->db->get_where("m_master_data_vendor",array(
									"vendor_code"	=> $vendor_code,
								))->row();
		
								$material = $this->db->get_where("m_master_data_material",array(
									"item_code"	=> $item_code,
								))->row();
		
								$lt_po_deliv = !empty($lt_pr_po)?$vendor->est_lead_time + $lt_pr_po:NULL;
								$standart_safety_stock = !empty($material->order_cycle)&&!empty($material->lot_size)?($lt_po_deliv/$material->order_cycle)*$material->lot_size:NULL;
		
								_add("m_vendor_material", array(
									'vendor_code' 					=> $vendor_code,
									'item_code' 					=> $item_code,
									"moq" 							=> $moq,
									"lt_pr_po" 						=> $lt_pr_po,
									"lot_size"						=> $material->lot_size,
									"initial_stock"					=> $material->initial_stock,	
									"order_cycle"					=> $material->order_cycle,	
									"lt_po_deliv"					=> $lt_po_deliv,	
									"standart_safety_stock"			=> $standart_safety_stock,	
									"price_per_uom"					=> $price_per_uom,	
									"price_equal_moq"				=> $price_equal_uom,	
									"place_to_buy"					=> $place_to_buy,	
									"link"							=> $link,	
								));	

								$get_last_id = $this->db->get_where("m_vendor_material",array(
									'vendor_code' => $vendor_code,
									'item_code' => $item_code,
								))->row()->id;
				
								generate_item_movement($get_last_id);

								$list [] = [
									"status" => "success",
									"data" => "New Vendor Material ".$vendor_code." - ".$item_code." added",
								];							
							}
						}
					}
				}
			}			

			$html = 'Processing file finished.<br>';
			$html .= '<ul>';
			foreach($list as $k => $v){
				if($v['status'] == "failed"){
					$html .= '<li><span style="color:red;font-size:12px;">'.$v['status'].' - '.$v['data'].'</span></li>';
				}else{
					$html .= '<li><span  style="font-size:12px;">'.$v['status'].' - '.$v['data'].'</span></li>';
				}
			}
			$html .= '</ul>';
			$msg = $html;

			if(file_exists($file_name))
				unlink($file_name);
				if(count($list) > 0) {
					$result 	= true;
					if($result) {
						$json = [
							'success_message' 	=> $msg,
							'list'				=> $list,
						];
					} else {
						$json = [
							'error_message' 	=> "Something went wrong while importing the data. Please check your excel file and try again.",
						];
					}
				} else {
					$json = [
						'success_message' => "Import completed. No new record is found on uploaded file.",
				];
				}
		}
		echo json_encode($json);
	}

	public function upload_config($path) {
		if (!is_dir($path)) 
			mkdir($path, 0777, TRUE);		
		$config['upload_path'] 		= './'.$path;		
		$config['allowed_types'] 	= 'csv|CSV|xlsx|XLSX|xls|XLS';
		$config['max_filename']	 	= '255';
		$config['encrypt_name'] 	= TRUE;
		$config['max_size'] 		= 4096; 
		$this->load->library('upload', $config);
	}
	
	function get_master_service()
	{
			$search = $this->session->userdata('search');
			$list = $this->master_model->get_datatables($search, 'service');
			$data = array();
			$no = $_POST['start'];
			foreach ($list as $field) {
					$edit 	= '
					<a href="'.site_url('master_data/edit_service/'._encrypt($field->id)).'" class="btn btn-sm btn-outline-primary" style="font-weight: 600; border-radius: 50px;margin-right:5px;">
						<i class="fa-solid fa-pen-to-square"></i>
						Edit
					</a>
					<a href="'.site_url('master_data/delete_service/'._encrypt($field->id)).'" class="btn btn-sm btn-outline-danger" style="font-weight: 600; border-radius: 50px;margin-right:5px;" data-bs-toggle="modal" data-bs-target="#modal-delete-'.$field->id.'">
						<i class="fa-solid fa-trash"></i>
						Delete
					</a>
					<div class="modal fade" id="modal-delete-'.$field->id.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel" class="text-primary" style="color: #001F82;font-weight:600;">Delete Material</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body" style="text-align: left;">
									<p>You are going to delete material '.$field->item_code.' - '.$field->item_name.', all data related with this material will be deleted. Are you sure?</p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">No, Cancel Delete.</button>
									<a href="'.site_url('master_data/delete_material?id='._encrypt($field->id)).'" type="button" class="btn btn-outline-danger">Yes, Delete Data.</a>
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
					"recordsTotal" => $this->master_model->count_all($search, 'service'),
					"recordsFiltered" => $this->master_model->count_filtered($search, 'service'),
					"data" => $data,
			);
			//output dalam format JSON
			echo json_encode($output);
	}		

	public function add_service()
	{
		$this->session->set_flashdata('page_title', 'FORM ADD NEW SERVICE');
		load_view('master-data/service/add-form.php', []);
	}	

	public function save_service()
	{
		if(isset($_POST['submit'])){
			$itemcode = strtolower(str_replace(' ', '', $this->input->post('item_name')).$this->input->post('uom').$this->input->post('size'));

			$material_code = $this->input->post('material_code');
			$exist = $this->db->get_where("m_master_data_material",array(
				"item_code"	=> $itemcode,
			))->row();

			if($exist){
				$err = array(
					'show' => true,
					'type' => 'error',
					'msg'  => 'Add new service failed. Service with code '.$material_code.' is already exist.'
				);
				$this->session->set_flashdata('toast', $err);
				$this->load->view('master-data/service/add-form.php');		
			}else{

				$inserted = _add(
					"m_master_data_material",
					array(
						"item_code" 				=> $itemcode,
						"item_name" 				=> $this->input->post('item_name'),
						"type" 						=> 'service',
						"service_type" 				=> $this->input->post('service_type'),
						"service_recurring"			=> $this->input->post('service_recurring'),
						"service_due_date"			=> $this->input->post('service_due_date'),						
						"service_urgent_if"			=> $this->input->post('service_urgent_if'),						
					));				
				if($inserted){
					$err = array(
						'show' => true,
						'type' => 'success',
						'msg'  => 'Successfully added new service.'
					);
					$this->session->set_flashdata('toast', $err);
				}else{
					$err = array(
						'show' => true,
						'type' => 'error',
						'msg'  => 'Add new service failed.'
					);
					$this->session->set_flashdata('toast', $err);
				}
			}
			redirect('service_management/master_data');
		}else{
			redirect('service_management/master_data');
		}
	}
	public function edit_service()
	{
		$item_code = _decrypt($this->uri->segment(3));
		$data['material'] = $this->db->get_where("m_master_data_material",array(
			"id" => $item_code
		))->row();		

		$this->session->set_flashdata('page_title', 'FORM EDIT SERVICE');
		load_view('master-data/service/edit-form', $data);
	}
	
	public function update_service()
	{
		if(isset($_POST['submit'])){
			$itemcode = strtolower(str_replace(' ', '', $this->input->post('item_name')).$this->input->post('uom').$this->input->post('size'));
			$id = $this->input->post('id');		

			$get_data = $this->db->get_where("m_master_data_material",array(
				"id"	=> $id,
			))->row();

			$material_code = $this->input->post('item_code');

			$exist = $this->db->get_where("m_master_data_material",array(
				"item_code"	=> $itemcode,
			))->row();
			
			if(($itemcode != $get_data->item_code) && $exist){
				$err = array(
					'show' => true,
					'type' => 'error',
					'msg'  => 'Add new service failed. Service with code '.$material_code.' is already exist.'
				);
				$this->session->set_flashdata('toast', $err);
				$this->load->view('service_management/master_data.php');		
			}else{
				$inserted = _update(
					"m_master_data_material", 
					array(
						"item_code" 				=> $itemcode,
						"item_name" 				=> $this->input->post('item_name'),
						"type" 						=> 'service',
						"service_type" 				=> $this->input->post('service_type'),
						"service_recurring"			=> $this->input->post('service_recurring'),
						"service_due_date"			=> $this->input->post('service_due_date'),						
						"service_urgent_if"			=> $this->input->post('service_urgent_if'),						
					), array("id" => $id)
				);
	
	
				if($inserted){
					$err = array(
						'show' => true,
						'type' => 'success',
						'msg'  => 'Successfully update material data.'
					);
					$this->session->set_flashdata('toast', $err);
				}else{
					$err = array(
						'show' => true,
						'type' => 'error',
						'msg'  => 'Update material failed.'
					);
					$this->session->set_flashdata('toast', $err);
				}
				redirect('service_management/master_data');
			}
		}else{
			redirect('service_management/master_data');
		}
	}		

	public function delete_service()
	{
		$id = _decrypt($this->input->get('id'));		
		$deleted = _soft_delete("m_master_data_material", array("id" => $id));

		if($deleted){
			$err = array(
				'show' => true,
				'type' => 'error',
				'msg'  => 'Successfully delete material data.'
			);
			$this->session->set_flashdata('toast', $err);
		}else{
			$err = array(
				'show' => true,
				'type' => 'error',
				'msg'  => 'Delete material failed.'
			);
			$this->session->set_flashdata('toast', $err);
		}
		redirect('master_data/material_list');
	}	
}
