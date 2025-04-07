<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Ajax extends CI_Controller
	{
	public function __construct()
		{
		parent::__construct ();
		}


	public function index()
		{
		show_404 ();
		}


	function get_category()
		{
		$id = $this->input->post ('id');

		$this->db->order_by ("category_name");

		$m = $this->db->get ("m_category")->result ();

		$html = "<option value=''> - Select Category - </option>";
		foreach ((array) $m as $k => $v)
			{
			$s = $v->category_name == $id ? 'selected="selected"' : '';
			$html .= "<option value='" . $v->category_name . "' $s >" . $v->category_name . "</option>";
			}

		die ($html);
		}
	function get_vendor_category()
		{
		$id = $this->input->post ('id');

		$this->db->order_by ("vendor_category");

		$m = $this->db->get ("m_vendor_category")->result ();

		$html = "<option value=''> - Select Category - </option>";
		foreach ((array) $m as $k => $v)
			{
			$s = $v->vendor_category == $id ? 'selected="selected"' : '';
			$html .= "<option value='" . $v->vendor_category . "' $s >" . $v->vendor_category . "</option>";
			}

		die ($html);
		}
	function get_factory()
		{
		$id = $this->input->post ('id');
		$this->db->order_by ("factory_name");

		$m = $this->db->get ("m_factory")->result ();

		$html = "<option value=''> - Select Factory - </option>";
		foreach ((array) $m as $k => $v)
			{
			$s = $v->factory_name == $id ? 'selected="selected"' : '';
			$html .= "<option value='" . $v->factory_name . "' $s >" . $v->factory_name . "</option>";
			}

		die ($html);
		}

	function get_item_group()
		{
		$id = $this->input->post ('id');
		$this->db->order_by ("id");

		$m = $this->db->get ("m_item_category")->result ();

		$html = "<option value=''> - Select Item Group - </option>";
		foreach ((array) $m as $k => $v)
			{
			$s = $v->id == $id ? 'selected="selected"' : '';
			$html .= "<option value='" . $v->id . "' $s >" . $v->item_category_name . "</option>";
			}

		die ($html);
		}

	function get_uom()
		{
		$id = $this->input->post ('id');
		$this->db->order_by ("uom_code");

		$m = $this->db->get ("m_uom")->result ();

		$html = "<option value=''> - Select UoM - </option>";
		foreach ((array) $m as $k => $v)
			{
			$s = $v->uom_code == $id ? 'selected="selected"' : '';
			$html .= "<option value='" . $v->uom_code . "' $s >" . $v->uom_code . " (" . $v->uom_name . ")</option>";
			}

		die ($html);
		}

	function get_material()
		{
		$id = $this->input->post ('id');
		$this->db->order_by ("id");

		$m = $this->db->get_where (
			"m_master_data_material",
			array(
				"is_active" => 1
			)
		)->result ();

		$html = '<option value="">-- All Item --</option>';
		foreach ((array) $m as $k => $v)
			{
			$s = $v->item_id == $id ? 'selected="selected"' : '';
			$html .= "<option value='" . $v->item_id . "' $s>" . $v->item_code . "-" . sprintf ("%02d", $v->item_number) . " (" . $v->item_name . ")</option>";
			}

		die ($html);
		}
	function get_area()
		{
		$m = $this->db->get (
			"m_area"
		)->result ();

		$html = '<option value="">-- All Area --</option>';
		foreach ((array) $m as $k => $v)
			{
			$html .= "<option value='" . $v->area_code . "'>" . $v->area_name . "</option>";
			}

		die ($html);
		}
	function add_material_to_vendor()
		{
		$vendor_code = $this->input->post ('vendor_code');
		$item_code = $this->input->post ('item_code');

		foreach ($item_code as $k => $v)
			{

			$exist = $this->db->get_where ("m_vendor_material", array(
				'vendor_code' => $vendor_code,
				'item_code' => $v
			))->row ();

			$getMat = $this->db->get_where ("m_master_data_material", array(
				'item_code' => $v,
			))->row ();

			if (! $exist)
				{
				_add (
					"m_vendor_material",
					[
						'vendor_code' => $vendor_code,
						'item_id' => $getMat->id,
						'item_code' => $v
					]
				);
				}
			}

		$err = array(
			'show' => true,
			'type' => 'success',
			'msg' => 'Successfully add material to vendor.'
		);
		$this->session->set_flashdata ('toast', $err);

		echo 1;
		}

	function add_vendor_material_price()
		{
		$moq = $this->input->post ('moq');
		$price_per_uom = $this->input->post ('price_per_uom');
		$vendor_material_id = $this->input->post ('vendor_material_id');
		$minimum_order = $this->input->post ('minimum_order');
		$price = $this->input->post ('price');

		$saving = ($price_per_uom - $price) / $price_per_uom * 100;

		$exist = $this->db->get_where ("m_vendor_material", array(
			'id' => $vendor_material_id,
		))->row ();

		if ($exist)
			{
			_add (
				"m_vendor_material_price",
				[
					'vendor_material_id' => $vendor_material_id,
					'vendor_code' => $exist->vendor_code,
					'item_id' => $exist->item_id,
					'item_code' => $exist->item_code,
					'moq' => $moq,
					'minimum_order' => $minimum_order,
					'price_per_uom' => $price,
					'saving' => $saving
				]
			);
			}
		$err = array(
			'show' => true,
			'type' => 'success',
			'msg' => 'Successfully add price.'
		);
		$this->session->set_flashdata ('toast', $err);

		echo 1;
		}

	function remove_vendor_material_price()
		{
		$id = $this->input->post ('id');
		$exist = $this->db->get_where ("m_vendor_material_price", array(
			'id' => $id,
		))->row ();

		if ($exist)
			{
			_hard_delete ("m_vendor_material_price", ['id' => $id]);
			}
		$err = array(
			'show' => true,
			'type' => 'success',
			'msg' => 'Successfully delete price.'
		);
		$this->session->set_flashdata ('toast', $err);

		echo 1;
		}

	public function export_goods_order_request()
		{
		ini_set ("max_execution_time", 0);

		$reader = IOFactory::createReader ('Xlsx');
		$spreadsheet = $reader->load ('assets/format/template_export_goods_order_request.xlsx');
		$spreadsheet->setActiveSheetIndexByName ('request_list');
		$sheet = $spreadsheet->getActiveSheet ();
		$index = 2;
		$getData = $this->db->query ("SELECT * FROM t_stock_planned_request WHERE order_status = 0 and type = 'goods'")->result ();

		foreach ((array) $getData as $datas => $list)
			{
			// $sheet->insertNewRowBefore($index + 1, 1);
			$sheet->setCellValue ("A{$index}", trim ($list->due_date));
			$sheet->setCellValue ("B{$index}", trim ($list->until_due_date));
			$sheet->setCellValue ("C{$index}", trim ($list->item_code));
			$sheet->setCellValue ("D{$index}", trim ($list->item_name));
			$sheet->setCellValue ("E{$index}", trim ($list->qty));
			$sheet->setCellValue ("F{$index}", trim ($list->uom));
			$sheet->setCellValue ("G{$index}", trim ($list->status));

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

			$sheet->getStyle ("M{$index}:B{$index}")->applyFromArray ($styleArray);
			$index++;
			}

		ob_end_clean ();
		$writer = new Xlsx($spreadsheet); // instantiate Xlsx
		header ('Content-type: application/vnd.ms-excel');
		// It will be called file.xls
		$filename = 'order_request_list' . date ('YmdHis');
		header ('Content-Disposition: attachment; filename="' . $filename . '.xlsx"');
		// Write file to the browser
		$writer->save ('php://output');

		echo 1;
		}
	}
