<?php

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
    }
