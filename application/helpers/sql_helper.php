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

function generate_gross_requirement($vendor_material_id){
    $CI = getCI();
    $data = array();

    $year = date('Y');
    $get_last_week = date('W', strtotime('December 28th'));
    $get_max_manual_input = 6;

    $get_data = $CI->db->get_where('m_vendor_material', array(
        "id" => $vendor_material_id
    ))->row();

    for($w = 1; $w <= $get_last_week; $w++){
        $exist = $CI->db->get_where('m_stock_card_formula', array(
            "vendor_code"   => $get_data->vendor_code,
            "item_code"     => $get_data->item_code,
            "vendor_material_id" => $vendor_material_id,            
            "year" => $year,
            "week" => $w
        ))->row();

        if(!$exist){
            if($w <= $get_max_manual_input){
                $data = array(
                    "vendor_code"   => $get_data->vendor_code,
                    "item_code"     => $get_data->item_code,
                    "vendor_material_id" => $vendor_material_id,
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
                    "vendor_code"   => $get_data->vendor_code,
                    "item_code"     => $get_data->item_code,
                    "vendor_material_id" => $vendor_material_id,
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

function generate_var_settings($vendor_material_id){
    $CI = getCI();
    $get_data = $CI->db->get_where('m_vendor_material', array(
        "id" => $vendor_material_id
    ))->row();

    $exist = $CI->db->get_where('m_variable_settings', array(
        "vendor_code"   => $get_data->vendor_code,
        "item_code"     => $get_data->item_code,
        "vendor_material_id" => $vendor_material_id,            
    ))->row();

    if(!$exist){
        $data = array(
            "vendor_code"   => $get_data->vendor_code,
            "item_code"     => $get_data->item_code,
            "vendor_material_id" => $vendor_material_id,
            "var_todo_list"             => 10,
            "var_stock_card_todo_list"  => 10,
            "var_stock_card_overstock"  => 10,
            'var_stock_card_ok'         => 10,
        );
        _add_nologs('m_variable_settings', $data);
    }
}

function generate_item_movement($vendor_material_id){
    $CI = getCI();
    $data = array();

    $year = date('Y');
    $get_last_week = date('W', strtotime('December 28th'));
    $get_max_manual_input = 6;

    $get_data = $CI->db->get_where('m_vendor_material', array(
        "id" => $vendor_material_id
    ))->row();

    for($w = 1; $w <= $get_last_week; $w++){
        $exist = $CI->db->get_where('t_material_movement', array(
            "vendor_code"   => $get_data->vendor_code,
            "item_code"     => $get_data->item_code,
            "vendor_material_id" => $vendor_material_id,            
            "year" => $year,
            "week" => $w
        ))->row();

        if(!$exist){
            $data = array(
                "vendor_code"   => $get_data->vendor_code,
                "item_code"     => $get_data->item_code,
                "vendor_material_id" => $vendor_material_id,
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

function get_avg_value($vendor_material_id, $week){
    $CI = getCI();
    $get_data = $CI->db->get_where('m_stock_card_formula', array(
        "vendor_material_id" => $vendor_material_id,
        "week" => $week
    ))->row();

    $get_avg = $CI->db->query('
    SELECT AVG(gross_requirement) as avg_gross, vendor_material_id
    FROM t_material_movement
    WHERE vendor_material_id = '.$vendor_material_id.'
    AND week >= '.$get_data->week_start_average.'
    AND week <= '.$get_data->week_end_average.'
    GROUP BY vendor_material_id
    ORDER BY vendor_material_id DESC
    ')->row();

    return $get_avg->avg_gross;
}
?>