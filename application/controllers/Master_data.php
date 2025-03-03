<?php

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
					$row[] = $field->factory;
					$row[] = $field->uom;
					$row[] = $field->moq;
					$row[] = $field->lt_pr_po;
					$row[] = $field->lot_size;
					$row[] = $field->order_cycle;
					$row[] = myNum($field->initial_stock);
					$row[] = myNum($field->lt_po_deliv);
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
					<a href="'.site_url('master_data/edit_material/'._encrypt($field->id)).'" class="btn btn-sm btn-outline-primary" style="font-weight: 600; border-radius: 50px;margin-right:5px;">
						<i class="fa-solid fa-pen-to-square"></i>
						Edit
					</a>
					<a href="'.site_url('master_data/delete_material/'._encrypt($field->id)).'" class="btn btn-sm btn-outline-danger" style="font-weight: 600; border-radius: 50px;margin-right:5px;" data-bs-toggle="modal" data-bs-target="#modal-delete-'.$field->id.'">
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
					$row[] = $field->factory;
					$row[] = $field->uom;
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
			$itemcode = strtolower($this->input->post('item_name').$this->input->post('uom').$this->input->post('size'));

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

				$inserted = _add(
					"m_master_data_material",
					array(
						"item_code" 				=> $itemcode,
						"item_name" 				=> $this->input->post('item_name'),
						"size" 						=> $this->input->post('size'),
						"factory"					=> $this->input->post('factory'),
						"uom"						=> $this->input->post('uom'),						
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
	public function edit_material()
	{
		$item_code = _decrypt($this->uri->segment(3));
		$data['material'] = $this->db->get_where("m_master_data_material",array(
			"id" => $item_code
		))->row();		
		// debugCode($data);

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
			redirect('master_data/material_list');
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
			"vendor_material_id"	=> $id,
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
			"vendor_material_id"	=> $id,
		))->row();		

		$data['gross_req'] = $this->db->get_where("m_stock_card_formula",array(
			"vendor_material_id"	=> $id,
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

			$lt_po_deliv = !empty($this->input->post('lt_pr_po'))?$vendor->est_lead_time + $this->input->post('lt_pr_po'):NULL;
			$standart_safety_stock = !empty($this->input->post('order_cycle'))&&!empty($this->input->post('lot_size'))?($lt_po_deliv/$this->input->post('order_cycle'))*$this->input->post('lot_size'):NULL;
			$price_per_uom = !empty($this->input->post('price_per_uom'))?str_replace(',', '', $this->input->post('price_per_uom')):NULL;
			$price_equal_moq = !empty($this->input->post('price_equal_moq'))?str_replace(',', '', $this->input->post('price_equal_moq')):NULL;

			$inserted = _update(
				"m_vendor_material", 
				array(
					"moq" 							=> $this->input->post('moq'),
					"lt_pr_po" 						=> $this->input->post('lt_pr_po'),
					"lot_size"						=> $this->input->post('lot_size'),
					"initial_stock"					=> $this->input->post('initial_stock'),	
					"order_cycle"					=> $this->input->post('order_cycle'),	
					"lt_po_deliv"					=> $lt_po_deliv,	
					"standart_safety_stock"			=> $standart_safety_stock,	
					// "initial_value_for_to_do"		=> $this->input->post('uom'),	
					"price_per_uom"					=> $price_per_uom,	
					"price_equal_moq"				=> $price_equal_moq,	
					"place_to_buy"					=> $this->input->post('place_to_buy'),	
					"link"							=> $this->input->post('link'),	

				), array("id" => $id)
			);

			$get_var_settings = $this->db->get_where("m_variable_settings",array(
				"vendor_material_id" => $id
			))->row();

			if(empty($get_var_settings)){
				generate_var_settings($id);
			}

			_update(
				"m_variable_settings", 
				array(
					"var_todo_list" 					=> $this->input->post('var_todo_list'),
					"var_stock_card_todo_list" 			=> $this->input->post('var_stock_card_todo_list'),
					"var_stock_card_overstock"			=> $this->input->post('var_stock_card_overstock'),
					"var_stock_card_ok"					=> $this->input->post('var_stock_card_ok'),	

				), array("vendor_material_id" => $id)
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
			"vendor_material_id" => _decrypt($this->input->get('id'))
		);
		$list = $this->gross_req_model->get_datatables($search);

		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
				$frm = $field->type=='formula'?"selected":"";
				$m = $field->type=='manual'?'selected':'';
				$edit 	= '
				<a class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal-update-gross-req-'.$field->id.'">
					<i class="fa-solid fa-pen-to-square"></i>		
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
			redirect('master_data/edit_vendor_material/'._encrypt($get_data->vendor_material_id));
		}else{
			redirect('master_data/material_list');
		}
	}
	public function update_item_movement()
	{
		if(isset($_POST['submit'])){
			$id = $this->input->post('material_movement_id');			
			$get_data = $this->db->get_where("t_material_movement",array(
				"id"	=> $id,
			))->row();
			$get_initial_week = $get_data->week;

			$get_material = $this->db->get_where("m_vendor_material",array(
				"id"	=> $get_data->vendor_material_id,
			))->row();			

			$get_mat_detail = $this->db->get_where("m_master_data_material",array(
				"item_code"	=> $get_data->item_code,
			))->row();			

			$gross_req = $this->input->post('gross_requirement');
			$schedule_receipt = $this->input->post('schedule_receipt');
			$get_last_week = date('W', strtotime('December 28th'));
			$get_last_week = $get_initial_week+12;
			$total_data = array();
			
			for($i = $get_initial_week; $i <= $get_last_week; $i++){
				$get_stock_card = $this->db->get_where("m_stock_card_formula",array(
					"vendor_material_id"	=> $get_data->vendor_material_id,
					"week" 					=> $i
				))->row();			

				$get_prev_week_data = $this->db->get_where("t_material_movement",array(
					"vendor_material_id"	=> $get_data->vendor_material_id,
					"week" 					=> $i-1
				))->row();		

				$get_curr_week_data = $this->db->get_where("t_material_movement",array(
					"vendor_material_id"	=> $get_data->vendor_material_id,
					"week" 					=> $i
				))->row();		

				$stock_on_hand = $get_data->week==1?($get_material->initial_stock+$schedule_receipt)-$gross_req:($get_prev_week_data->stock_on_hand+$schedule_receipt)-$gross_req;
				$current_safety_stock = min($stock_on_hand,$get_material->standart_safety_stock);
				$net_on_hand = $stock_on_hand-$current_safety_stock;
				$net_requirement = min($stock_on_hand,0);					

				if($get_stock_card->type=='manual'){
					if($i == $get_initial_week){
						$gross_req = $this->input->post('gross_requirement');
					}else{
						$gross_req = $get_curr_week_data->gross_requirement;
					}					
				}else{
					$gross_req = get_avg_value($get_data->vendor_material_id,$i);
				}

				if($i == $get_initial_week){
					$schedule_receipt = $this->input->post('schedule_receipt');
				}else{
					$schedule_receipt = $get_curr_week_data->schedules_receipts;
				}

				$data= array(
					'week' => $i,
					'gross_requirement' => $gross_req,
					'schedules_receipts' => $schedule_receipt,
					'stock_on_hand' => myNum($stock_on_hand),
					'current_safety_stock' => myNum($current_safety_stock),
					'net_on_hand' => myNum($net_on_hand),
					'net_requirement' => myNum($net_requirement),
					'planned_order_receipt' => 0,
					'planned_order_release' => 0,					
				);

				_update('t_material_movement',$data, array(
					"vendor_material_id"	=> $get_data->vendor_material_id,
					"week" => $i
				));

				if($net_on_hand <= 0){
					$planned_order_receipt = MAX($get_material->moq,$get_material->lot_size);
					_update('t_material_movement',array(
						'planned_order_receipt' => $planned_order_receipt,
					), array(
						"vendor_material_id"	=> $get_data->vendor_material_id,
						"week" => $i
					));
					
					$planned_release = array(
						'vendor_code' => $get_data->vendor_code,
						'item_code' => $get_mat_detail->item_code,
						'vendor_material_id' => $get_data->vendor_material_id,
						'item_name' => $get_mat_detail->item_name,
						'qty' => $planned_order_receipt,
						'uom' => $get_mat_detail->uom,
						'year' => date('Y'),
						'week' => $i,
						'status' => 'urgent',
						'due_date' => date("Y-m-d H:i:s"),
						'until_due_date' => date("Y-m-d H:i:s"),
					);

					_add('t_stock_planned_request', $planned_release);
				}

				_update('t_material_movement',array(
					'planned_order_release' => $planned_order_receipt,						
				), array(
					"vendor_material_id"	=> $get_data->vendor_material_id,
					"week" => $i-1
				));

			}

			$err = array(
				'show' => true,
				'type' => 'success',
				'msg'  => 'Successfully update material movement.'
			);
			$this->session->set_flashdata('toast', $err);

			redirect('master_data/item_movement/'._encrypt($get_data->vendor_material_id));			
		}
	}		
}
