<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

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
	
	public function export_goods_order_request() {
		ini_set("max_execution_time", 0);

		$reader = IOFactory::createReader('Xlsx');
		$spreadsheet = $reader->load('assets/format/template_export_goods_order_request.xlsx');
		$spreadsheet->setActiveSheetIndexByName('request_list');
		$sheet = $spreadsheet->getActiveSheet();
		$index = 2;
		$getData = $this->db->query("SELECT * FROM t_stock_planned_request WHERE order_status = 0 and type = 'goods'")->result();

		foreach ((array)$getData as $datas => $list) {
			// $sheet->insertNewRowBefore($index + 1, 1);
			$sheet->setCellValue("A{$index}", trim($list->due_date));
			$sheet->setCellValue("B{$index}", trim($list->until_due_date));
			$sheet->setCellValue("C{$index}", trim($list->item_code));
			$sheet->setCellValue("D{$index}", trim($list->item_name));
			$sheet->setCellValue("E{$index}", trim($list->qty));
			$sheet->setCellValue("F{$index}", trim($list->uom));
			$sheet->setCellValue("G{$index}", trim($list->status));

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
	
			$sheet->getStyle("M{$index}:B{$index}")->applyFromArray($styleArray);
			$index++;				
		}				

		ob_end_clean();
        $writer = new Xlsx($spreadsheet); // instantiate Xlsx
        header('Content-type: application/vnd.ms-excel');
        // It will be called file.xls
		$filename = 'order_request_list'.date('YmdHis');
        header('Content-Disposition: attachment; filename="'.$filename.'.xlsx"');
        // Write file to the browser
        $writer->save('php://output');

		echo 1;
	}	
}
