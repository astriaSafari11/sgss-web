<?php

class Ajax extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}


	public function index()
	{
		show_404();
	}


	function get_category(){
		$id 			= $this->input->post('id');

		$this->db->order_by("category_name");
	
		$m = $this->db->get("m_category")->result();
	
		$html = "<option value=''> - Select Category - </option>";
		foreach ((array)$m as $k => $v) {
			$s = $v->category_name==$id?'selected="selected"':'';
			$html .= "<option value='".$v->category_name."' $s >".$v->category_name."</option>";
		}
	
		die($html);
	}
	
	function get_factory(){
		$id 			= $this->input->post('id');
		$this->db->order_by("factory_name");
	
		$m = $this->db->get("m_factory")->result();
	
		$html = "<option value=''> - Select Factory - </option>";
		foreach ((array)$m as $k => $v) {
			$s = $v->factory_name==$id?'selected="selected"':'';
			$html .= "<option value='".$v->factory_name."' $s >".$v->factory_name."</option>";
		}
	
		die($html);
	}
	
	function get_uom(){
		$id 			= $this->input->post('id');
		$this->db->order_by("uom_code");
	
		$m = $this->db->get("m_uom")->result();
	
		$html = "<option value=''> - Select UoM - </option>";
		foreach ((array)$m as $k => $v) {
			$s = $v->uom_code==$id?'selected="selected"':'';
			$html .= "<option value='".$v->uom_code."' $s >".$v->uom_code." (".$v->uom_name.")</option>";
		}
	
		die($html);
	}	

	function get_material(){
		$this->db->order_by("item_code");
	
		$m = $this->db->get_where("m_master_data_material",
		array(
			"is_active" => 1
		))->result();
	
		foreach ((array)$m as $k => $v) {
			$html .= "<option value='".$v->item_code."'>".$v->item_code." (".$v->item_name.")</option>";
		}
	
		die($html);
	}	

	function add_material_to_vendor(){
		$vendor_code = $this->input->post('vendor_code');
		$item_code = $this->input->post('item_code');

		foreach($item_code as $k => $v){
			$exist = $this->db->get_where("m_vendor_material",array(
				'vendor_code' => $vendor_code,
				'item_code' => $v
			))->row();
			if(!$exist){
				_add(
					"m_vendor_material",
					[
						'vendor_code' => $vendor_code,
						'item_code' => $v
					]);	

				$get_last_id = $this->db->get_where("m_vendor_material",array(
					'vendor_code' => $vendor_code,
					'item_code' => $v
				))->row()->id;

				generate_gross_requirement($get_last_id);
				generate_var_settings($get_last_id);
				generate_item_movement($get_last_id);
			}
		}

		$err = array(
			'show' => true,
			'type' => 'success',
			'msg'  => 'Successfully add material to vendor.'
		);
		$this->session->set_flashdata('toast', $err);

		echo 1;
	}		
}
