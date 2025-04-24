<?php

function _add_activity_log($table, $data, $desc)
    {
    $CI = getCI ();
    $data = array(
        'user_id' => $CI->session->userdata ('user_id'),
        'date' => date ("Y-m-d H:i:s"),
        'table_executed' => $table,
        'data_executed' => json_encode ($data),
        'description' => $desc,
        'time_add' => date ("Y-m-d H:i:s")
    );

    return $CI->db->insert (
        't_log_activity',
        $data
    );
    }

function _add($table, $data)
    {
    $CI = getCI ();
    if ($CI->db->field_exists ('user_add', $table))
        {
        $data['user_add'] = $CI->session->userdata ('user_id');
        }

    if ($CI->db->field_exists ('time_add', $table))
        {
        $data['time_add'] = date ("Y-m-d H:i:s");
        }

    if ($CI->db->field_exists ('is_active', $table))
        {
        $data['is_active'] = 1;
        }

    $exec = $CI->db->insert (
        $table,
        $data
    );

    if ($exec)
        {
        _add_activity_log ($table, $data, "Insert");
        return $exec;
        }
    }

function _add_nologs($table, $data)
    {
    $CI = getCI ();
    if ($CI->db->field_exists ('user_add', $table))
        {
        $data['user_add'] = $CI->session->userdata ('user_id');
        }

    if ($CI->db->field_exists ('time_add', $table))
        {
        $data['time_add'] = date ("Y-m-d H:i:s");
        }

    if ($CI->db->field_exists ('is_active', $table))
        {
        $data['is_active'] = 1;
        }

    $exec = $CI->db->insert (
        $table,
        $data
    );

    if ($exec)
        {
        return $exec;
        }
    }

function _update($table, $data, $par)
    {
    $CI = getCI ();

    if ($CI->db->field_exists ('user_update', $table))
        {
        $data['user_update'] = $CI->session->userdata ('user_id');
        }

    if ($CI->db->field_exists ('time_update', $table))
        {
        $data['time_update'] = date ("Y-m-d H:i:s");
        }

    $exec = $CI->db->update (
        $table,
        $data,
        $par
    );

    if ($exec)
        {
        _add_activity_log ($table, $data, "Update");
        return $exec;
        }
    }

function _soft_delete($table, $par)
    {
    $CI = getCI ();
    $data = array();

    if ($CI->db->field_exists ('user_update', $table))
        {
        $data['user_update'] = $CI->session->userdata ('user_id');
        }

    if ($CI->db->field_exists ('time_update', $table))
        {
        $data['time_update'] = date ("Y-m-d H:i:s");
        }
    $data['time_delete'] = date ("Y-m-d H:i:s");
    $data['is_active'] = 0;
    $data['is_delete'] = 1;

    $exec = $CI->db->update (
        $table,
        $data,
        $par
    );

    if ($exec)
        {
        _add_activity_log ($table, $data, "Soft Delete");
        return $exec;
        }
    }

function _hard_delete($table, $par)
    {
    $CI = getCI ();

    $exec = $CI->db->delete (
        $table,
        $par
    );

    if ($exec)
        {
        _add_activity_log ($table, null, "Hard Delete");
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
function generate_gross_requirement($material_id)
    {
    $CI = getCI ();
    $data = array();

    $year = date ('Y');
    $get_last_week = date ('W', strtotime ('December 28th'));
    $get_max_manual_input = 6;

    $get_data = $CI->db->get_where ('m_master_data_material', array(
        "id" => $material_id
    ))->row ();

    for ($w = 1; $w <= $get_last_week; $w++)
        {
        $exist = $CI->db->get_where ('m_stock_card_formula', array(
            "item_id" => $get_data->id,
            "year" => $year,
            "week" => $w
        ))->row ();

        if (! $exist)
            {
            if ($w <= $get_max_manual_input)
                {
                $data = array(
                    "item_id" => $get_data->id,
                    "item_code" => $get_data->item_code,
                    "year" => $year,
                    "week" => $w,
                    "type" => 'manual',
                    'week_start_average' => 0,
                    'week_end_average' => 0,
                );
                _add ('m_stock_card_formula', $data);
                }
            else
                {
                $start_avg = $w - 5;
                $end_avg = $w - 1;
                $data = array(
                    "item_id" => $get_data->id,
                    "item_code" => $get_data->item_code,
                    "year" => $year,
                    "week" => $w,
                    "type" => 'formula',
                    'week_start_average' => $start_avg,
                    'week_end_average' => $end_avg,
                );
                _add_nologs ('m_stock_card_formula', $data);
                }
            }
        }
    }

function generate_var_settings($material_id, $var1, $var2, $var3, $var4)
    {
    $CI = getCI ();
    $get_data = $CI->db->get_where ('m_master_data_material', array(
        "id" => $material_id
    ))->row ();

    $exist = $CI->db->get_where ('m_variable_settings', array(
        "item_code" => $get_data->item_code,
        "item_id" => $get_data->id,
    ))->row ();

    if (! $exist)
        {
        $data = array(
            "item_code" => $get_data->item_code,
            "item_id" => $get_data->id,
            "var_todo_list" => $var1,
            "var_stock_card_todo_list" => $var2,
            "var_stock_card_overstock" => $var3,
            'var_stock_card_ok' => $var4,
            'var_pending_approval' => 5,
        );
        _add_nologs ('m_variable_settings', $data);
        }
    }

function generate_item_movement($last_id)
    {
    $CI = getCI ();
    $data = array();

    $year = date ('Y');
    $get_last_week = date ('W', strtotime ('December 28th'));
    $get_max_manual_input = 6;

    $get_data = $CI->db->get_where ('m_master_data_material', array(
        "id" => $last_id
    ))->row ();

    for ($w = 1; $w <= $get_last_week; $w++)
        {
        $exist = $CI->db->get_where ('t_material_movement', array(
            "item_code" => $get_data->item_code,
            "item_id" => $last_id,
            "year" => $year,
            "week" => $w
        ))->row ();

        if (! $exist)
            {
            $data = array(
                "item_code" => $get_data->item_code,
                "item_id" => $last_id,
                "year" => $year,
                "week" => $w,
                'gross_requirement' => 0,
                'usage' => 0,
                'schedules_receipts' => 0,
                'stock_on_hand' => 0,
                'current_safety_stock' => 0,
                'net_on_hand' => 0,
                'net_requirement' => 0,
                'planned_order_receipt' => 0,
                'planned_order_release' => 0,
            );
            _add_nologs ('t_material_movement', $data);
            }
        }
    }

function get_avg_value($item_id, $week)
    {
    $CI = getCI ();

    $get_data = $CI->db->get_where ('m_stock_card_formula', array(
        "item_id" => $item_id,
        "year" => date ('Y'),
        "week" => $week
    ))->row ();

    $get_avg = $CI->db->query ('
    SELECT AVG(gross_requirement) as avg_gross, item_id
    FROM t_material_movement
    WHERE item_id = ' . $item_id . '
    AND week >= ' . $get_data->week_start_average . '
    AND week <= ' . $get_data->week_end_average . '
    GROUP BY item_id
    ORDER BY item_id DESC
    ')->row ();

    return $get_avg->avg_gross;
    }

function calc_sched_receipt($mat_mov_id, $schedule_receipt)
    {
    $CI = getCI ();
    $id = $mat_mov_id;
    $get_data = $CI->db->get_where ("t_material_movement", array(
        "id" => $id,
    ))->row ();

    $get_initial_week = $get_data->week;

    $get_mat_detail = $CI->db->get_where ("m_master_data_material", array(
        "id" => $get_data->item_id,
    ))->row ();

    $gross_req = $get_data->gross_requirement;
    // $get_last_week = date ('W', strtotime ('December 28th'));
    $get_last_week = $get_initial_week + 2;

    for ($i = $get_initial_week; $i <= $get_last_week; $i++)
        {
        $get_stock_card = $CI->db->get_where ("m_stock_card_formula", array(
            "item_code" => $get_data->item_code,
            "week" => $i
        ))->row ();

        $get_prev_week_data = $CI->db->get_where ("t_material_movement", array(
            "item_id" => $get_data->item_id,
            "week" => $i - 1
        ))->row ();

        $get_curr_week_data = $CI->db->get_where ("t_material_movement", array(
            "item_id" => $get_data->item_id,
            "week" => $i
        ))->row ();

        if ($get_stock_card->type == 'manual')
            {
            $gross_req = $get_curr_week_data->gross_requirement;
            }
        else
            {
            $gross_req = get_avg_value ($get_mat_detail->id, $i);
            }

        $actual_usage = $get_curr_week_data->usage;

        if ($i == $get_initial_week)
            {
            $schedule_receipt = $get_curr_week_data->schedules_receipts + $schedule_receipt;
            }
        else
            {
            $schedule_receipt = $get_curr_week_data->schedules_receipts;
            }

        if ($i == 1)
            {
            $stock_on_hand = ($get_mat_detail->initial_stock + $schedule_receipt) - $actual_usage;
            }
        else
            {
            $stock_on_hand = ($get_prev_week_data->stock_on_hand + $schedule_receipt) - $actual_usage;
            }

        $current_safety_stock = min ($stock_on_hand, $get_mat_detail->standard_safety_stock);
        $net_on_hand = $stock_on_hand - $current_safety_stock;
        $net_requirement = min ($stock_on_hand, 0);

        $data = array(
            'week' => $i,
            'gross_requirement' => $gross_req,
            'usage' => $actual_usage,
            'schedules_receipts' => $schedule_receipt,
            'stock_on_hand' => $stock_on_hand,
            'current_safety_stock' => round ($current_safety_stock, 0),
            'net_on_hand' => $net_on_hand,
            'net_requirement' => $net_requirement,
            'planned_order_receipt' => 0,
            'planned_order_release' => 0,
        );

        _update ('t_material_movement', $data, array(
            "item_id" => $get_data->item_id,
            "week" => $i
        ));

        if ($net_on_hand <= 0)
            {
            $exist = $CI->db->get_where ("t_stock_planned_request", array(
                "item_id" => $get_data->item_id,
                "year" => date ('Y'),
                "week" => $i
            ))->row ();

            $get_rec_material = $CI->db->query ("
            SELECT TOP 1 * from m_vendor_material WHERE item_code = '" . $get_mat_detail->item_code . "' ORDER BY price_per_uom ASC
            ")->row ();

            $planned_order_receipt = MAX ($get_rec_material->moq, $get_mat_detail->lot_size);

            _update ('t_material_movement', array(
                'planned_order_receipt' => $planned_order_receipt,
            ), array(
                "item_id" => $get_data->item_id,
                "year" => date ('Y'),
                "week" => $i
            ));

            $due_date = week_start_date ($i, date ('Y'));
            $lt_po_deliv = $get_mat_detail->gen_lead_time;

            $until_due_date = date ('Y-m-d', strtotime ($due_date . "+ $lt_po_deliv day"));

            $planned_release = array(
                'vendor_code' => $get_rec_material->vendor_code,
                'item_code' => $get_mat_detail->item_code,
                'item_id' => $get_mat_detail->id,
                'vendor_material_id' => $get_rec_material->vendor_material_id,
                'item_name' => $get_mat_detail->item_name,
                'qty' => $planned_order_receipt,
                'uom' => $get_mat_detail->uom,
                'year' => date ('Y'),
                'week' => $i,
                'status' => 'urgent',
                'due_date' => $due_date,
                'until_due_date' => $until_due_date,
                'order_status' => 0,
                'type' => 'goods'
            );

            if (! $exist)
                {
                _add ('t_stock_planned_request', $planned_release);
                }
            else
                {
                _update ('t_stock_planned_request', $planned_release, array(
                    "id" => $exist->id,
                ));
                }
            }
        else
            {
            _hard_delete ('t_stock_planned_request', array(
                "item_id" => $get_data->item_id,
                "year" => date ('Y'),
                "week" => $i,
                "order_status" => 0
            ));

            }

        _update ('t_material_movement', array(
            'planned_order_release' => $planned_order_receipt,
        ), array(
            "item_id" => $get_data->item_id,
            "year" => date ('Y'),
            "week" => $i - 1
        ));

        }
    }

function calc_usage($mat_mov_id)
    {
    $CI = getCI ();
    $id = $mat_mov_id;
    $get_data = $CI->db->get_where ("t_material_movement", array(
        "id" => $id,
    ))->row ();

    $get_initial_week = $get_data->week;

    $get_mat_detail = $CI->db->get_where ("m_master_data_material", array(
        "id" => $get_data->item_id,
    ))->row ();

    $gross_req = $get_data->gross_requirement;
    // $get_last_week = date ('W', strtotime ('December 28th'));
    $get_last_week = $get_initial_week + 2;

    for ($i = $get_initial_week; $i <= $get_last_week; $i++)
        {
        $get_stock_card = $CI->db->get_where ("m_stock_card_formula", array(
            "item_code" => $get_data->item_code,
            "week" => $i
        ))->row ();

        $get_prev_week_data = $CI->db->get_where ("t_material_movement", array(
            "item_id" => $get_data->item_id,
            "week" => $i - 1
        ))->row ();

        $get_curr_week_data = $CI->db->get_where ("t_material_movement", array(
            "item_id" => $get_data->item_id,
            "week" => $i
        ))->row ();

        if ($get_stock_card->type == 'manual')
            {
            $gross_req = $get_curr_week_data->gross_requirement;
            }
        else
            {
            $gross_req = get_avg_value ($get_mat_detail->id, $i);
            }

        $actual_usage = $get_curr_week_data->gross_requirement;

        $schedule_receipt = $get_curr_week_data->schedules_receipts;

        if ($i == 1)
            {
            $stock_on_hand = ($get_mat_detail->initial_stock + $schedule_receipt) - $actual_usage;
            }
        else
            {
            $stock_on_hand = ($get_prev_week_data->stock_on_hand + $schedule_receipt) - $actual_usage;
            }

        $current_safety_stock = min ($stock_on_hand, $get_mat_detail->standard_safety_stock);
        $net_on_hand = $stock_on_hand - $current_safety_stock;
        $net_requirement = min ($stock_on_hand, 0);

        $data = array(
            'week' => $i,
            'gross_requirement' => $gross_req,
            'usage' => $actual_usage,
            'schedules_receipts' => $schedule_receipt,
            'stock_on_hand' => $stock_on_hand,
            'current_safety_stock' => round ($current_safety_stock, 0),
            'net_on_hand' => $net_on_hand,
            'net_requirement' => $net_requirement,
            'planned_order_receipt' => 0,
            'planned_order_release' => 0,
        );

        _update ('t_material_movement', $data, array(
            "item_id" => $get_data->item_id,
            "week" => $i
        ));

        if ($net_on_hand <= 0)
            {
            $exist = $CI->db->get_where ("t_stock_planned_request", array(
                "item_id" => $get_data->item_id,
                "year" => date ('Y'),
                "week" => $i
            ))->row ();

            $get_rec_material = $CI->db->query ("
            SELECT TOP 1 * from m_vendor_material WHERE item_code = '" . $get_mat_detail->item_code . "' ORDER BY price_per_uom ASC
            ")->row ();

            $planned_order_receipt = MAX ($get_rec_material->moq, $get_mat_detail->lot_size);

            _update ('t_material_movement', array(
                'planned_order_receipt' => $planned_order_receipt,
            ), array(
                "item_id" => $get_data->item_id,
                "year" => date ('Y'),
                "week" => $i
            ));

            $due_date = week_start_date ($i, date ('Y'));
            $lt_po_deliv = $get_mat_detail->gen_lead_time;

            $until_due_date = date ('Y-m-d', strtotime ($due_date . "+ $lt_po_deliv day"));

            $planned_release = array(
                'vendor_code' => $get_rec_material->vendor_code,
                'item_code' => $get_mat_detail->item_code,
                'item_id' => $get_mat_detail->id,
                'vendor_material_id' => $get_rec_material->vendor_material_id,
                'item_name' => $get_mat_detail->item_name,
                'qty' => $planned_order_receipt,
                'uom' => $get_mat_detail->uom,
                'year' => date ('Y'),
                'week' => $i,
                'status' => 'urgent',
                'due_date' => $due_date,
                'until_due_date' => $until_due_date,
                'order_status' => 0,
                'type' => 'goods'
            );

            if (! $exist)
                {
                _add ('t_stock_planned_request', $planned_release);
                }
            else
                {
                _update ('t_stock_planned_request', $planned_release, array(
                    "id" => $exist->id,
                ));
                }
            }
        else
            {
            _hard_delete ('t_stock_planned_request', array(
                "item_id" => $get_data->item_id,
                "year" => date ('Y'),
                "week" => $i,
                "order_status" => 0
            ));

            }

        _update ('t_material_movement', array(
            'planned_order_release' => $planned_order_receipt,
        ), array(
            "item_id" => $get_data->item_id,
            "year" => date ('Y'),
            "week" => $i - 1
        ));

        }
    }

function generate_budget_baseline($item_id, $budget, $target)
    {
    $CI = getCI ();
    $data = array();

    $baseline = array('Best', 'Average', 'Latest', 'Target', 'Budget');

    $get_data = $CI->db->get_where ('m_master_data_material', array(
        "id" => $item_id
    ))->row ();

    foreach ($baseline as $key => $value)
        {
        $is_default = 0;
        $price = $target;

        if ($value == 'Budget')
            {
            $price = $budget;
            }
        if ($value == 'Best')
            {
            $is_default = 1;
            }

        _add ('m_material_baseline_price', array(
            "item_id" => $item_id,
            "item_code" => $get_data->item_code,
            "baseline_category" => $value,
            "baseline_price" => $price,
            "is_default" => $is_default
        ));
        }
    }

function generate_average_forecast($item_id)
    {
    $CI = getCI ();
    $data = array();

    $baseline = array('Default', 'YTD', 'Start-To');

    $get_data = $CI->db->get_where ('m_master_data_material', array(
        "id" => $item_id
    ))->row ();

    foreach ($baseline as $key => $value)
        {
        $is_default = 0;
        $start_week = 0;
        $to_week = 0;

        if ($value == 'YTD')
            {
            $is_default = 1;
            $start_week = 1;
            $to_week = 52;
            }
        if ($value == 'Default')
            {
            $is_default = 0;
            $start_week = 5;
            $to_week = 5;
            }

        $exist = $CI->db->get_where ('m_material_average_forecast', array(
            "item_id" => $item_id,
            "baseline" => $value
        ))->row ();

        if (! $exist)
            {
            _add ('m_material_average_forecast', array(
                "item_id" => $item_id,
                "item_code" => $get_data->item_code,
                "baseline" => $value,
                "start_week" => $start_week,
                "to_week" => $to_week,
                "is_default" => $is_default
            ));

            }
        }
    }

function generate_approval_track($order_id, $requestor, $status)
    {
    $CI = getCI ();

    $get_order = $CI->db->get_where ('t_order', array(
        "id" => $order_id
    ))->row ();

    if ($status == "auto_approved")
        {
        //add first layer approval - LM - WL 1 - PIC AREA
        _add ('t_order_approval_track', array(
            "order_id" => $order_id,
            "approve_order" => 1,
            "approve_level" => 1,
            "approve_title" => 'SGSS System',
            "approve_status" => 'approved',
            "approve_by" => 'SGSS System',
            "approve_name" => 'SGSS System',
            "approve_due_date" => date ("Y-m-d H:i:s"),
            "approve_date" => date ("Y-m-d H:i:s"),
        ));
        }
    else
        {
        $getUser = $CI->db->get_where ('m_employee', array(
            "nip" => $requestor
        ))->row ();

        $getUserArea = $CI->db->get_where ('m_employee_area', array(
            "nip" => $getUser->nip
        ))->row ();

        $get_detail = $CI->db->get_where ('t_order_detail', array(
            "order_id" => $order_id
        ))->row ();

        $get_vendor = $CI->db->get_where ('m_master_data_vendor', array(
            "vendor_code" => $get_detail->vendor_code
        ))->row ();

        $get_settings = $CI->db->get_where ('m_variable_settings', array(
            "item_id" => $get_detail->item_id
        ))->row ();

        $pending_days = $get_settings->var_pending_approval;

        $layer_one_date = date ("Y-m-d H:i:s", strtotime ("+" . $pending_days . " day", strtotime (date ("Y-m-d H:i:s"))));

        //add first layer approval - LM - WL 1 - PIC AREA
        _add ('t_order_approval_track', array(
            "order_id" => $order_id,
            "approve_order" => 1,
            "approve_level" => 1,
            "approve_title" => 'WL1',
            "approve_status" => 'pending',
            "approve_by" => $getUser->lm_nip,
            "approve_name" => $getUser->lm_name,
            "approve_due_date" => $layer_one_date
        ));

        if ($get_order->approval_category != 'normal')
            {
            $reason = $get_order->purchase_reason . 'with ' . $get_order->approval_category;
            }
        else
            {
            $reason = $get_order->purchase_reason;
            }

        if ($get_order->order_category == 'ignore')
            {
            $subject = '[SGSS - APPROVAL NEEDED] - IGNORED REQUEST';
            $reason = 'order request is ignored by requestor';
            }
        else
            {
            $subject = '[SGSS - APPROVAL NEEDED] - MODIFICATION REQUEST';
            }
        //send email to first layer approval - LM - WL 1 - PIC AREA
        $email_body = email_body (
            $subject,
            "Dear " . $getUser->lm_name . ",<br><br>

        Request Number " . $get_order->request_id . " needs for approval because " . $get_order->purchase_reason . " " . $reason . "<br><br>
        
        Here are the items requested in detail:<br><br>
        <table class=\"table table-bordered\" style='width:100%;border:1px solid #001F82;'>
        <thead>
        <tr>
        <th style='color: #001F82;background-color:#DAEAFF;text-align: center;'>Item Code</th>
        <th style='color: #001F82;background-color:#DAEAFF;text-align: center;'>Item Name</th>
        <th style='color: #001F82;background-color:#DAEAFF;text-align: center;'>Quantity</th>
        <th style='color: #001F82;background-color:#DAEAFF;text-align: center;'>UoM</th>
        <th style='color: #001F82;background-color:#DAEAFF;text-align: center;'>Vendor</th>
        <th style='color: #001F82;background-color:#DAEAFF;text-align: center;'>UoM Price</th>
        <th style='color: #001F82;background-color:#DAEAFF;text-align: center;'>Total Price</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <td style='vertical-align: middle;text-align: center;'>" . $get_detail->item_code . "</td>
        <td style='vertical-align: middle;text-align: center;'>" . $get_detail->item_name . "</td>
        <td style='vertical-align: middle;text-align: center;'>" . $get_detail->qty . "</td>
        <td style='vertical-align: middle;text-align: center;'>" . $get_detail->uom . "</td>
        <td style='vertical-align: middle;text-align: center;'>" . $get_vendor->vendor_name . "</td>
        <td style='vertical-align: middle;text-align: center;'>" . myNum ($get_detail->uom_price) . "</td>
        <td style='vertical-align: middle;text-align: center;'>" . myNum ($get_detail->total_price) . "</td>
        </tr>
        </tbody>
        </table>

        <br>
        
        Please approve by " . myDate ($layer_one_date) . "<br><br>
        Trough this link : <a href=\"" . base_url () . "\">SGSS Approval Link</a><br>

        <br><br>

        Best Regards,<br>
        SGSS Team"
        );

        send_email_notification ($getUser->lm_email, $subject, $email_body);

        $get_WL2 = $CI->db->query ("select * from view_user WHERE area_code = '" . $getUserArea->area_code . "' and role = 'WL2'")->row ();
        $layer_two_date = date ("Y-m-d H:i:s", strtotime ("+" . $pending_days . " day", strtotime ($layer_one_date)));

        //add second layer approval - WL2
        _add ('t_order_approval_track', array(
            "order_id" => $order_id,
            "approve_order" => 2,
            "approve_level" => 2,
            "approve_title" => 'WL2',
            "approve_status" => 'inactive',
            "approve_by" => $get_WL2->nip,
            "approve_name" => $get_WL2->nama,
            "approve_due_date" => $layer_two_date
        ));

        $get_WL3 = $CI->db->query ("select * from view_user WHERE area_code = '" . $getUserArea->area_code . "' and role = 'WL3'")->row ();
        $layer_three_date = date ("Y-m-d H:i:s", strtotime ("+" . $pending_days . " day", strtotime ($layer_two_date)));

        //add third layer approval - WL3
        _add ('t_order_approval_track', array(
            "order_id" => $order_id,
            "approve_order" => 3,
            "approve_level" => 3,
            "approve_title" => 'WL3',
            "approve_status" => 'inactive',
            "approve_by" => $get_WL3->nip,
            "approve_name" => $get_WL3->nama,
            "approve_due_date" => $layer_three_date
        ));
        }

    }

function get_vendor_name($vendor_code)
    {
    $CI = getCI ();
    $data = $CI->db->get_where ('m_master_data_vendor', array(
        "vendor_code" => $vendor_code
    ))->row ();

    return $data->vendor_name;
    }

function get_baseline_price($item_id, $baseline)
    {
    $CI = getCI ();
    $data = $CI->db->get_where ('m_material_baseline_price', array(
        "item_id" => $item_id,
        "baseline_category" => $baseline
    ))->row ();

    return $data->baseline_price;
    }

function get_annual_price($item_id, $year)
    {
    $CI = getCI ();
    $data = $CI->db->get_where ('m_material_budget', array(
        "item_id" => $item_id,
        "year" => $year
    ))->row ();
    return $data->annual_budget;
    }

function get_vendor_price($vendor_code, $item_id)
    {
    $CI = getCI ();
    $data = $CI->db->get_where ('m_vendor_material', array(
        "vendor_code" => $vendor_code,
        "item_code" => $item_id
    ))->row ();

    return $data->price_per_uom;
    }

function get_vendor_list()
    {
    $CI = getCI ();
    return $CI->db->get ('m_master_data_vendor')->result ();
    }

function get_vendor_material($item_code)
    {
    $CI = getCI ();
    return $CI->db->query ("select * from m_vendor_material 
        INNER JOIN m_master_data_vendor ON m_master_data_vendor.vendor_code = m_vendor_material.vendor_code
        where item_code = '.$item_code.'")->result ();
    }

function calculate_savings($vendor_price, $baseline_price)
    {

    $diffPrice = $baseline_price - $vendor_price;
    $calculated = ! empty ($baseline_price) && ! empty ($vendor_price) ? ($diffPrice / $baseline_price) * 100 : 0;
    return $calculated;
    }


function calc_remaining_budget($item_id)
    {

    $CI = getCI ();
    $getTotalTrx = $CI->db->query ("select SUM(total_price) as total FROM t_order_detail
    INNER JOIN t_order ON t_order_detail.order_id = t_order.id
    WHERE is_feedback = 1 AND item_id = '$item_id'")->row ();

    $getAnnualBudget = get_annual_price ($item_id, date ('Y'));

    $calculated = $getAnnualBudget - $getTotalTrx->total;
    return $calculated;
    }

function get_ss_days_left($item_id, $week)
    {
    $CI = getCI ();
    $getStockCard = $CI->db->get_where ('t_material_movement', array(
        "item_id" => $item_id,
        "week" => $week
    ))->row ();

    $getMat = $CI->db->get_where ('m_master_data_material', array(
        "id" => $item_id
    ))->row ();

    if (empty ($getMat->standard_safety_stock) || empty ($getStockCard->gross_requirement))
        return 0;

    $ss = ($getMat->standard_safety_stock / $getStockCard->gross_requirement) * 6;

    return round ($ss);
    }
?>
