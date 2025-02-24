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

?>