<?php

class Goods_management_model extends CI_Model
    {

    function get_order_detail($id)
        {

        $get_order = $this->db->get_where ("t_order", array("id" => $id))->row ();

        if ($get_order->status == 'rejected')
            {
            $query = $this->db->query ("
                SELECT *, t_order.status as request_status from t_order
                INNER JOIN t_order_detail ON t_order_detail.order_id = t_order.id
                INNER JOIN m_master_data_material ON m_master_data_material.item_code = t_order_detail.item_code
                INNER JOIN m_master_data_vendor ON m_master_data_vendor.vendor_code = t_order_detail.vendor_code
                WHERE t_order.id = '$id'
                ")->row ();
            }
        else
            {
            $query = $this->db->query ("
                SELECT *, t_order.status as request_status, m_employee.nama as requested_for_name from t_order
                INNER JOIN t_order_detail ON t_order_detail.order_id = t_order.id
                INNER JOIN m_master_data_material ON m_master_data_material.item_code = t_order_detail.item_code
                INNER JOIN m_master_data_vendor ON m_master_data_vendor.vendor_code = t_order_detail.vendor_code
                INNER JOIN m_employee ON m_employee.nip = t_order.requested_for
                WHERE t_order.id = '$id'
                ")->row ();
            }

        return $query;
        }

    }
