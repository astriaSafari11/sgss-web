<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Usage extends CI_Controller
    {

    public $search = array();
    public function __construct()
        {
        parent::__construct ();
        $this->load->model ('auth_model');
        $this->load->model ('inventory_model');
        $this->session->set_userdata ('session_created', time ());
        }

    public function index()
        {
        $this->session->set_flashdata ('page_title', 'Home');
        $this->load->view ('landing_page.php');
        }

    public function export()
        {
        ini_set ("max_execution_time", 0);

        $reader = IOFactory::createReader ('Xlsx');
        $spreadsheet = $reader->load ('assets/format/template_export_stock_take.xlsx');
        $spreadsheet->setActiveSheetIndexByName ('STOCK TAKE');
        $sheet = $spreadsheet->getActiveSheet ();
        $index = 4;
        $week = date ("W");

        $getData = $this->db->query ("SELECT * FROM view_stock_card where week = '$week'")->result ();
        $currentDate = date ('Y-m-d') . " week : " . $week;

        $sheet->setCellValue ("B1", $currentDate);

        foreach ((array) $getData as $datas => $list)
            {
            // $sheet->insertNewRowBefore($index + 1, 1);
            $sheet->setCellValue ("A{$index}", trim ($list->item_code));
            $sheet->setCellValue ("B{$index}", trim ($list->item_name));
            $sheet->setCellValue ("C{$index}", trim ($list->stock_on_hand));

            $styleArray = [
                'font' => [
                    'name' => 'Calibri',
                    'size' => 10
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                ],
                'borders' => array(
                    'top' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                    'right' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                    'bottom' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                    'left' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ),
            ];

            $sheet->getStyle ("A{$index}:E{$index}")->applyFromArray ($styleArray);
            $index++;
            }

        ob_end_clean ();
        $writer = new Xlsx($spreadsheet); // instantiate Xlsx
        header ('Content-type: application/vnd.ms-excel');
        // It will be called file.xls
        $filename = 'Stock_Take_' . date ('Ymd');
        header ('Content-Disposition: attachment; filename="' . $filename . '.xlsx"');
        // Write file to the browser
        $writer->save ('php://output');
        }

    public function inventory_export()
        {
        ini_set ("max_execution_time", 0);

        $from = date ("W", strtotime ($this->input->post ('from')));
        $to = date ("W", strtotime ($this->input->post ('to')));

        $reader = IOFactory::createReader ('Xlsx');
        $spreadsheet = $reader->load ('assets/format/template_export_inventory.xlsx');
        $spreadsheet->setActiveSheetIndexByName ('Report');
        $sheet = $spreadsheet->getActiveSheet ();
        $index = 2;
        $week = date ("W");

        $getData = $this->db->query ("select material.id, material.item_code, material.item_name, material.lot_size, material.order_cycle, material.lt_pr_po, material.lt_pr_to_deliv, material.gen_lead_time, 
        material.standard_safety_stock, view_stock_card.year, view_stock_card.week, view_stock_card.stock_on_hand from view_stock_card
        INNER JOIN m_master_data_material as material ON material.id = view_stock_card.id
        WHERE year = '" . date ('Y') . "' and week >= '$from' and week <= '$to'")->result ();

        $i = 8;
        $max = $i + ($to - $from + 1);

        for ($i = 8; $i <= $max + 1; $i++)
            {
            $col = num2alpha ($i);
            $sheet->setCellValue ("{$col}1", date ('Y') . "-" . $i);
            }

        foreach ((array) $getData as $datas => $list)
            {
            // $sheet->insertNewRowBefore($index + 1, 1);
            $sheet->setCellValue ("A{$index}", trim ($list->item_code));
            $sheet->setCellValue ("B{$index}", trim ($list->item_name));
            $sheet->setCellValue ("C{$index}", trim ($list->lt_pr_po));
            $sheet->setCellValue ("D{$index}", trim ($list->lt_pr_to_deliv));
            $sheet->setCellValue ("E{$index}", trim ($list->gen_lead_time));
            $sheet->setCellValue ("F{$index}", trim ($list->order_cycle));
            $sheet->setCellValue ("G{$index}", trim ($list->standard_safety_stock));
            $sheet->setCellValue ("H{$index}", trim ($list->item_name));
            $sheet->setCellValue ("I{$index}", trim ($list->stock_on_hand));

            $styleArray = [
                'font' => [
                    'name' => 'Calibri',
                    'size' => 10
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                ],
                'borders' => array(
                    'top' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                    'right' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                    'bottom' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                    'left' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ),
            ];

            $sheet->getStyle ("A{$index}:E{$index}")->applyFromArray ($styleArray);
            $index++;
            }

        ob_end_clean ();
        $writer = new Xlsx($spreadsheet); // instantiate Xlsx
        header ('Content-type: application/vnd.ms-excel');
        // It will be called file.xls
        $filename = 'Inventory_Report_' . date ('Ymd');
        header ('Content-Disposition: attachment; filename="' . $filename . '.xlsx"');
        // Write file to the browser
        $writer->save ('php://output');
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
    public function import_usage()
        {
        ini_set ("max_execution_time", 0);
        $path = 'assets/upload/usage/';
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

            $sheetData = $spreadsheet->getSheetbyName ('Usage');
            $cellRow = $spreadsheet->getSheetbyName ('Usage')->getHighestRow ();
            for ($i = 2; $i <= $cellRow; $i++)
                {
                $item_code = $sheetData->getCell ('A' . $i)->getValue ();
                $item_desc = $sheetData->getCell ('B' . $i)->getValue ();
                $uom = $sheetData->getCell ('C' . $i)->getValue ();
                $qty = $sheetData->getCell ('D' . $i)->getValue ();

                if (! empty ($item_code) && ! empty ($qty))
                    {
                    $getMat = $this->db->get_where ("m_master_data_material", array(
                        "item_code" => $item_code,
                    ))->row ();

                    $trxId = "TRX-" . date ('ymdhis') . $getMat->id;
                    $data = array(
                        "transaction_id" => $trxId,
                        "date" => date ("Y-m-d"),
                        "item_id" => $getMat->id,
                        "item_code" => $getMat->item_code,
                        "qty" => $qty,
                        "requestor" => $this->session->userdata ('user_name'),
                        "requestor_nip" => $this->session->userdata ('user_nip'),

                    );

                    _update ('m_master_data_material', array(
                        "recent_usage" => $trxId,
                    ), array(
                        "id" => $getMat->id,
                    ));

                    _add ("t_transactions", $data);

                    $get_current_week = date ('W', strtotime (date ('Y-m-d')));

                    $getStockOnHand = $this->db->get_where ("t_material_movement", array(
                        "item_id" => $getMat->id,
                        "week" => $get_current_week,
                    ))->row ();

                    $usage = $getStockOnHand->usage + $qty;

                    $prevUsage = $this->db->get_where ("t_material_movement", array(
                        "item_id" => $getMat->id,
                        "week" => $get_current_week - 1,
                    ))->row ();

                    $stock_on_hand = ($prevUsage->stock_on_hand + $getStockOnHand->schedules_receipts) - $usage;
                    $current_safety_stock = min ($stock_on_hand, $getMat->standard_safety_stock);
                    $net_on_hand = $stock_on_hand - $current_safety_stock;

                    _update ('t_material_movement', array(
                        "usage" => str_replace (",", "", myNum ($usage)),
                        "stock_on_hand" => $stock_on_hand,
                        "current_safety_stock" => str_replace (",", "", myNum ($current_safety_stock)),
                        "net_on_hand" => $net_on_hand
                    ), array(
                        "item_id" => $getMat->id,
                        "week" => $get_current_week,
                    ));

                    $get_stock_card = $this->db->get_where ("t_material_movement", array(
                        "item_id" => $getMat->id,
                        "week" => $get_current_week + 1,
                    ))->row ();

                    calc_usage ($get_stock_card->id);

                    $list[] = [
                        "item_id" => $getMat->id,
                        "item_code" => $getMat->item_code,
                        "item_desc" => $getMat->item_name,
                        "uom" => $getMat->uom,
                        "qty" => $qty,
                    ];
                    }
                }

            $html = 'Processing file finished.<br>';
            $html .= '
			<table id="example" class="table table-sm" cellspacing="0">
                      <thead>
                          <tr >
                              <th style="color: #fff;background-color: #001F82;text-align: center;font-size:12px;">Item Code</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;font-size:12px;">Item Desc</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;font-size:12px;">UoM</th>
                              <th style="color: #fff;background-color: #001F82;text-align: center;font-size:12px;">Qty</th>
                          </tr>
                      </thead>
					  <tbody>			
			';
            foreach ($list as $k => $v)
                {
                $html .= '
					<tr>
						<td style="text-align: center;font-size:12px;">' . $v['item_code'] . '</td>
						<td style="text-align: center;font-size:12px;">' . $v['item_desc'] . '</td>
						<td style="text-align: center;font-size:12px;">' . $v['uom'] . '</td>
						<td style="text-align: center;font-size:12px;">' . $v['qty'] . '</td>
					</tr>
					';
                }
            $html .= '<tbody></table>';

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

    public function generate_template()
        {
        ini_set ("max_execution_time", 0);

        $from = date ("W", strtotime ($this->input->post ('from')));
        $to = date ("W", strtotime ($this->input->post ('to')));

        $reader = IOFactory::createReader ('Xlsx');
        $spreadsheet = $reader->load ('assets/format/template_import_usage.xlsx');
        $spreadsheet->setActiveSheetIndexByName ('Master Material');
        $sheet = $spreadsheet->getActiveSheet ();
        $index = 3;
        $week = date ("W");

        $getData = $this->db->query ("select * from m_master_data_material where type = 'goods' and is_active = 1")->result ();

        foreach ((array) $getData as $datas => $list)
            {
            // $sheet->insertNewRowBefore($index + 1, 1);
            $sheet->setCellValue ("A{$index}", trim ($list->factory));
            $sheet->setCellValue ("B{$index}", trim ($list->item_code));
            $sheet->setCellValue ("C{$index}", trim ($list->item_name));
            $sheet->setCellValue ("D{$index}", trim ($list->item_group));
            $sheet->setCellValue ("E{$index}", trim ($list->size));
            $sheet->setCellValue ("F{$index}", trim ($list->size_uom));
            $sheet->setCellValue ("G{$index}", trim ($list->uom));

            $styleArray = [
                'font' => [
                    'name' => 'Calibri',
                    'size' => 10
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                ],
                'borders' => array(
                    'top' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                    'right' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                    'bottom' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                    'left' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ),
            ];

            $sheet->getStyle ("A{$index}:G{$index}")->applyFromArray ($styleArray);
            $index++;
            }

        ob_end_clean ();
        $writer = new Xlsx($spreadsheet); // instantiate Xlsx
        header ('Content-type: application/vnd.ms-excel');
        // It will be called file.xls
        $filename = 'Usage_Template_' . date ('Ymd');
        header ('Content-Disposition: attachment; filename="' . $filename . '.xlsx"');
        // Write file to the browser
        $writer->save ('php://output');
        }
    }
