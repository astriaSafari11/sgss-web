<?php

function _add_activity_log($table, $data, $desc){
    $CI = getCI();
    $data = array(
        'user_id'           => $CI->session->userdata('user_id'),
        'date'              => date("Y-m-d H:i:s"),
        'table_executed'    => $table,
        'data_executed'     => json_encode($data),
        'description'       => $desc,
        'time_add'          => date("Y-m-d H:i:s")
    );
        
    return $CI->db->insert(
        't_log_activity',
        $data
    );
}

function _add($table, $data){
    $CI = getCI();
    if($CI->db->field_exists('user_add',$table)){			
        $data['user_add'] = $CI->session->userdata('user_id');
    }
    
    if($CI->db->field_exists('time_add',$table)){	
        $data['time_add'] = date("Y-m-d H:i:s");
    }

    if($CI->db->field_exists('is_active',$table)){	
        $data['is_active'] = 1;
    }
        
    $exec =  $CI->db->insert(
        $table,
        $data
    );

    if($exec){ 
        _add_activity_log($table, $data, "Insert");
        return $exec;
    }
}

function _add_nologs($table, $data){
    $CI = getCI();
    if($CI->db->field_exists('user_add',$table)){			
        $data['user_add'] = $CI->session->userdata('user_id');
    }
    
    if($CI->db->field_exists('time_add',$table)){	
        $data['time_add'] = date("Y-m-d H:i:s");
    }

    if($CI->db->field_exists('is_active',$table)){	
        $data['is_active'] = 1;
    }
        
    $exec =  $CI->db->insert(
        $table,
        $data
    );

    if($exec){ 
        return $exec;
    }
}

function _update($table, $data, $par){
    $CI = getCI();

    if($CI->db->field_exists('user_update',$table)){			
        $data['user_update'] = $CI->session->userdata('user_id');
    }
    
    if($CI->db->field_exists('time_update',$table)){	
        $data['time_update'] = date("Y-m-d H:i:s");
    }
        
    $exec =  $CI->db->update(
        $table,
        $data,
        $par
    );

    if($exec){ 
        _add_activity_log($table, $data, "Update");
        return $exec;
    }
}

function _soft_delete($table, $par){
    $CI = getCI();
    $data = array();

    if($CI->db->field_exists('user_update',$table)){			
        $data['user_update'] = $CI->session->userdata('user_id');
    }
    
    if($CI->db->field_exists('time_update',$table)){	
        $data['time_update'] = date("Y-m-d H:i:s");
    }
    $data['time_delete'] = date("Y-m-d H:i:s");
    $data['is_active'] = 0;
    $data['is_delete'] = 1;

    $exec =  $CI->db->update(
        $table,
        $data,
        $par
    );

    if($exec){ 
        _add_activity_log($table, $data, "Soft Delete");
        return $exec;
    }
}

function _hard_delete($table, $par){
    $CI = getCI();
    
    $exec =  $CI->db->delete(
        $table,
        $par
    );

    if($exec){ 
        _add_activity_log($table, null, "Hard Delete");
        return $exec;
    }
}

/*************  ✨ Codeium Command ⭐  *************/
/**
 * Generate gross requirement for given material id
 *
 * @param int $material_id material id
 *
 * @return void
 */
function generate_gross_requirement($material_id){
    $CI = getCI();
    $data = array();

    $year = date('Y');
    $get_last_week = date('W', strtotime('December 28th'));
    $get_max_manual_input = 6;

    $get_data = $CI->db->get_where('m_master_data_material', array(
        "id" => $material_id
    ))->row();

    for($w = 1; $w <= $get_last_week; $w++){
        $exist = $CI->db->get_where('m_stock_card_formula', array(
            "item_id"           => $get_data->id,
            "year"              => $year,
            "week"              => $w
        ))->row();

        if(!$exist){
            if($w <= $get_max_manual_input){
                $data = array(
                    "item_id"        => $get_data->id,
                    "item_code"     => $get_data->item_code,
                    "year" => $year,
                    "week" => $w,
                    "type" => 'manual',
                    'week_start_average' => 0,
                    'week_end_average' => 0,                
                );
                _add('m_stock_card_formula', $data);
            }else{
                $start_avg = $w - 5;
                $end_avg = $w - 1;
                $data = array(
                    "item_id"        => $get_data->id,
                    "item_code"     => $get_data->item_code,
                    "year" => $year,
                    "week" => $w,
                    "type" => 'formula',
                    'week_start_average' => $start_avg,
                    'week_end_average' => $end_avg,                
                );
                _add_nologs('m_stock_card_formula', $data);
            }
        }
    }
}

function generate_var_settings($material_id, $var1, $var2, $var3, $var4){
    $CI = getCI();
    $get_data = $CI->db->get_where('m_master_data_material', array(
        "id" => $material_id
    ))->row();

    $exist = $CI->db->get_where('m_variable_settings', array(
        "item_code"     => $get_data->item_code,
        "item_id"       => $get_data->id,            
    ))->row();

    if(!$exist){
        $data = array(
            "item_code"     => $get_data->item_code,
            "item_id"       => $get_data->id,            
            "var_todo_list"             => $var1,
            "var_stock_card_todo_list"  => $var2,
            "var_stock_card_overstock"  => $var3,
            'var_stock_card_ok'         => $var4,
            'var_pending_approval'      => 5,
        );
        _add_nologs('m_variable_settings', $data);
    }
}

function generate_item_movement($last_id){
    $CI = getCI();
    $data = array();

    $year = date('Y');
    $get_last_week = date('W', strtotime('December 28th'));
    $get_max_manual_input = 6;

    $get_data = $CI->db->get_where('m_master_data_material', array(
        "id" => $last_id
    ))->row();

    for($w = 1; $w <= $get_last_week; $w++){
        $exist = $CI->db->get_where('t_material_movement', array(
            "item_code"     => $get_data->item_code,
            "item_id" => $last_id,            
            "year" => $year,
            "week" => $w
        ))->row();

        if(!$exist){
            $data = array(
                "item_code"     => $get_data->item_code,
                "item_id" => $last_id,
                "year" => $year,
                "week" => $w,
                'gross_requirement' => 0,
                'schedules_receipts' => 0,
                'stock_on_hand' => 0,
                'current_safety_stock' => 0,
                'net_on_hand' => 0,
                'net_requirement' => 0,
                'planned_order_receipt' => 0,
                'planned_order_release' => 0,
            );
            _add_nologs('t_material_movement', $data);
        }
    }
}

function get_avg_value($item_id, $week){
    $CI = getCI();

    $get_data = $CI->db->get_where('m_stock_card_formula', array(
        "item_id" => $item_id,
        "year" => date('Y'),
        "week" => $week
    ))->row();

    $get_avg = $CI->db->query('
    SELECT AVG(gross_requirement) as avg_gross, item_id
    FROM t_material_movement
    WHERE item_id = '.$item_id.'
    AND week >= '.$get_data->week_start_average.'
    AND week <= '.$get_data->week_end_average.'
    GROUP BY item_id
    ORDER BY item_id DESC
    ')->row();

    return $get_avg->avg_gross;
}

function calc_sched_receipt($mat_mov_id, $schedule_receipt)
{
        $CI = getCI();
        $id = $mat_mov_id;			
        $get_data = $CI->db->get_where("t_material_movement",array(
            "id"	=> $id,
        ))->row();
        $get_initial_week = $get_data->week;

        $get_material = $CI->db->get_where("m_vendor_material",array(
            "id"	=> $get_data->vendor_material_id,
        ))->row();			

        $get_mat_detail = $CI->db->get_where("m_master_data_material",array(
            "item_code"	=> $get_data->item_code,
        ))->row();

        $gross_req = $get_data->gross_requirement;
        $get_last_week = date('W', strtotime('December 28th'));
        $get_last_week = 12;
        $total_data = array();
        
        for($i = $get_initial_week; $i <= $get_last_week; $i++){
            $get_stock_card = $CI->db->get_where("m_stock_card_formula",array(
                "item_code"				=> $get_data->item_code,
                "week" 					=> $i
            ))->row();			

            $get_prev_week_data = $CI->db->get_where("t_material_movement",array(
                "vendor_material_id"	=> $get_data->vendor_material_id,
                "week" 					=> $i-1
            ))->row();		

            $get_curr_week_data = $CI->db->get_where("t_material_movement",array(
                "vendor_material_id"	=> $get_data->vendor_material_id,
                "week" 					=> $i
            ))->row();		

            $stock_on_hand = $get_data->week==1?($get_material->initial_stock+$schedule_receipt)-$gross_req:($get_prev_week_data->stock_on_hand+$schedule_receipt)-$gross_req;
            $current_safety_stock = min($stock_on_hand,$get_material->standart_safety_stock);
            $net_on_hand = $stock_on_hand-$current_safety_stock;
            $net_requirement = min($stock_on_hand,0);					

            if($get_stock_card->type=='formula'){
                $gross_req = get_avg_value($get_data->vendor_material_id, $get_mat_detail->id,$i);
            }

            if($i != $get_initial_week){
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

            if($net_on_hand >= 1){
                _hard_delete('t_stock_planned_request',array(
                    "vendor_material_id"	=> $get_data->vendor_material_id,
                    "week" => $i,
                    "order_status" => 0
                ));
            }

            // if($net_on_hand <= 0){
            //     $planned_order_receipt = MAX($get_material->moq,$get_material->lot_size);
            //     _update('t_material_movement',array(
            //         'planned_order_receipt' => $planned_order_receipt,
            //     ), array(
            //         "vendor_material_id"	=> $get_data->vendor_material_id,
            //         "week" => $i
            //     ));
                
            //     $planned_release = array(
            //         'vendor_code' => $get_data->vendor_code,
            //         'item_code' => $get_mat_detail->item_code,
            //         'vendor_material_id' => $get_data->vendor_material_id,
            //         'item_name' => $get_mat_detail->item_name,
            //         'qty' => $planned_order_receipt,
            //         'uom' => $get_mat_detail->uom,
            //         'year' => date('Y'),
            //         'week' => $i,
            //         'status' => 'urgent',
            //         'due_date' => date("Y-m-d H:i:s"),
            //         'until_due_date' => date("Y-m-d H:i:s"),
            //     );

            //     _add('t_stock_planned_request', $planned_release);
            // }

            // _update('t_material_movement',array(
            //     'planned_order_release' => $planned_order_receipt,						
            // ), array(
            //     "vendor_material_id"	=> $get_data->vendor_material_id,
            //     "week" => $i-1
            // ));

        }
}

function generate_budget_baseline($item_id, $budget, $target){
    $CI = getCI();
    $data = array();

    $baseline = array('Best', 'Average', 'Latest', 'Target', 'Budget');

    $get_data = $CI->db->get_where('m_master_data_material', array(
        "id" => $item_id
    ))->row();

    foreach ($baseline as $key => $value) {
        $is_default = 0;
        $price = $target;

        if($value == 'Budget'){
            $price = $budget;
        }
        if($value == 'Best'){
            $is_default = 1;
        }
        
        _add('m_material_baseline_price', array(
            "item_id" => $item_id,
            "item_code" => $get_data->item_code,
            "baseline_category" => $value,
            "baseline_price" => $price,
            "is_default" => $is_default          
        ));
    }
}

function generate_approval_track($order_id, $requestor){
    $CI = getCI();
    $getUser = $CI->db->get_where('m_employee', array(
        "nip" => $requestor
    ))->row();

    //add first layer approval - LM - WL 1 - PIC AREA
    _add('t_order_approval_track', array(
        "order_id" => $order_id,
        "approve_order" => 1,
        "approve_level" => 1,
        "approve_title" => 'WL1',
        "approve_status" => 'pending',
        "approve_by" => $getUser->lm_nip,
    ));

    //add second layer approval - WL2
    _add('t_order_approval_track', array(
        "order_id" => $order_id,
        "approve_order" => 2,
        "approve_level" => 2,
        "approve_title" => 'WL2',
        "approve_status" => 'inactive',
    ));

    //add third layer approval - WL3
    _add('t_order_approval_track', array(
        "order_id" => $order_id,
        "approve_order" => 3,
        "approve_level" => 3,
        "approve_title" => 'WL3',
        "approve_status" => 'inactive',
    ));
}

function get_vendor_name($vendor_code){
    $CI = getCI();
    $data = $CI->db->get_where('m_master_data_vendor', array(
        "vendor_code" => $vendor_code
    ))->row();

    return $data->vendor_name;
}

function get_baseline_price($item_id, $baseline){
    $CI = getCI();
    $data = $CI->db->get_where('m_material_baseline_price', array(
        "item_id" => $item_id,
        "baseline_category" => $baseline
    ))->row();

    return $data->baseline_price;
}

function get_annual_price($item_id, $year){
    $CI = getCI();
    $data = $CI->db->get_where('m_material_budget', array(
        "item_id" => $item_id,
        "year" => $year
    ))->row();
    return $data->annual_budget;
}

function get_vendor_price($vendor_code, $item_id){
    $CI = getCI();
    $data = $CI->db->get_where('m_vendor_material', array(
        "vendor_code" => $vendor_code,
        "item_code" => $item_id
    ))->row();

    return $data->price_per_uom;
}

function get_vendor_list(){
    $CI = getCI();
    return $CI->db->get('m_master_data_vendor')->result();
}

function get_vendor_material($item_code){
    $CI = getCI();
    return $CI->db->query("select * from m_vendor_material 
        INNER JOIN m_master_data_vendor ON m_master_data_vendor.vendor_code = m_vendor_material.vendor_code
        where item_code = '.$item_code.'")->result();
}
?>