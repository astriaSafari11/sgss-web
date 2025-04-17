<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Inventory extends CI_Controller
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
    public function edit_item()
        {
        $item_id = _decrypt ($this->uri->segment (3));
        $data['material'] = $this->db->get_where ("m_master_data_material", array(
            "id" => $item_id,
        ))->row ();
        // debugCode($data);

        $this->session->set_flashdata ('page_title', 'EDIT MATERIAL');
        load_view ('goods-management/item-movement/edit-form', $data);
        }

    public function update_item()
        {
        if (isset ($_POST['submit']))
            {
            $id = $this->input->post ('id');
            $total_lead_time = $this->input->post ('lt_pr_to_deliv') + $this->input->post ('lt_pr_po');
            $standart_safety_stock = ! empty ($this->input->post ('order_cycle')) && ! empty ($this->input->post ('lot_size')) ? ($total_lead_time / $this->input->post ('order_cycle')) * $this->input->post ('lot_size') : NULL;
            $target_inventory = ! empty ($standart_safety_stock) ? $standart_safety_stock * 2 : NULL;

            $inserted = _update (
                "m_master_data_material",
                array(
                    "item_name" => $this->input->post ('item_name'),
                    "lot_size" => $this->input->post ('lot_size'),
                    "order_cycle" => $this->input->post ('order_cycle'),
                    "lt_pr_po" => $this->input->post ('lt_pr_po'),
                    "lt_pr_to_deliv" => $this->input->post ('lt_pr_to_deliv'),
                    "gen_lead_time" => $total_lead_time,
                    "standard_safety_stock" => round ($standart_safety_stock),
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
            redirect ('goods_management/stock_card_detail//' . _encrypt ($id));
            }
        else
            {
            redirect ('goods_management/item_movement');
            }
        }
    public function search_inventory()
        {
        $week = date ("W");

        $search = array(
            'keyword' => $this->input->post ('keyword'),
            'item' => $this->input->post ('item'),
            'item_group' => $this->input->post ('item_group'),
            'uom' => $this->input->post ('uom'),
            'status' => $this->input->post ('status'),
            // 'area' => $this->input->post ('area'),
        );
        $this->session->set_userdata ('search', $search);
        }

    public function load_inventory()
        {
        $search = $this->session->userdata ('search');
        $list = $this->inventory_model->get_datatables ($search);
        $data = array();
        if ($search['keyword'] == "" && $search['item'] == "" && $search['status'] == "" && $search['item_group'] == "" && $search['uom'] == "")
            {
            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->inventory_model->count_all ($search),
                "recordsFiltered" => $this->inventory_model->count_all ($search),
                "data" => [],
            );
            }
        else
            {
            foreach ($list as $field)
                {
                $edit = '
                <a href="' . site_url ('inventory/edit_item/' . _encrypt ($field->id)) . '" class="btn btn-outline-primary">
                    <i class="fa-solid fa-pen-to-square"> </i> Edit						
                </a>';

                switch ($field->status)
                    {
                    case 'ok':
                        $status = '<button class="btn btn-sm btn-success"
                                        style="font-weight: 600; border-radius: 50px; width: 100%;">
                                        Ok
                                    </button>';
                        break;
                    case 'overstock':
                        $status = '<button class="btn btn-sm btn-warning"
                                        style="font-weight: 600; border-radius: 50px; width: 100%;">
                                        OVERSTOCK
                                    </button>                    
                       ';
                        break;
                    case 'understock':
                        $status = '
                         <button class="btn btn-sm btn-danger"
                                        style="font-weight: 600; border-radius: 50px; width: 100%;">
                                        UNDERSTOCK
                                    </button>';
                        break;
                    default:
                        $status = 'Unknown';
                    }
                $row = array();

                $row[] = '<a href="' . site_url ('goods_management/stock_card_detail/' . _encrypt ($field->id)) . '" class="underline-custom">' . $field->item_name . '</a>
                      <br /><small><i>' . $field->item_code . ' - ' . $field->item_group . '</i></small>';
                $row[] = $field->stock_on_hand;
                $row[] = $field->uom;
                $row[] = $status;
                $row[] = '<a href="' . site_url ('goods_management/request_detail/' . _encrypt ($field->recent_transactions)) . '"
                                    target="_blank" class="underline-custom">' . $field->recent_transactions . '</a>';
                $row[] = '<a href="' . site_url ('goods_management/request_detail/' . _encrypt ($field->recent_transactions)) . '"
                                    target="_blank" class="underline-custom">' . $field->recent_usage . '</a>';
                $row[] = $edit;
                $data[] = $row;
                }
            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->inventory_model->count_all ($search),
                "recordsFiltered" => $this->inventory_model->count_filtered ($search),
                "data" => $data,
            );
            }
        //output dalam format JSON
        echo json_encode ($output);
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
    }
