<?php

class Inventory_model extends CI_Model
    {
    private function _get_datatables_query($p = array())
        {
        $column_order = array(null, 'week', 'type');
        $table = 'view_stock_card';

        if (isset ($p['item']) && $p['item'] != "")
            {
            $this->db->where ('id', $p['item']);
            }
        if (isset ($p['item_group']) && $p['item_group'] != "")
            {
            $this->db->where ('item_group', $p['item_group']);
            }
        if (isset ($p['uom']) && $p['uom'] != "")
            {
            $this->db->where ('uom', $p['uom']);
            }
        if (isset ($p['status']) && $p['status'] != "")
            {
            $this->db->where ('status', $p['status']);
            }
        if (isset ($p['keyword']) && $p['keyword'] != "")
            {
            $this->db->where ("(item_code LIKE '%" . $p['keyword'] . "%' OR item_name LIKE '%" . $p['keyword'] . "%' OR uom LIKE '%" . $p['keyword'] . '%" OR status LIKE "%' . $p['keyword'] . "%')");
            }

        $week = date ("W");
        $this->db->where ('week', $week);
        $this->db->from ($table);

        $i = 0;
        if (isset ($_POST['order']))
            {
            $this->db->order_by ($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            }
        else if (isset ($order))
            {
            $this->db->order_by (key ($order), $order[key ($order)]);
            }
        }

    function get_datatables($p = array())
        {
        $this->_get_datatables_query ($p);
        if ($_POST['length'] != -1)
            $this->db->limit ($_POST['length'], $_POST['start']);
        $query = $this->db->get ();
        return $query->result ();
        }

    function count_filtered($p = array())
        {
        $this->_get_datatables_query ($p);
        $query = $this->db->get ();
        return $query->num_rows ();
        }

    public function count_all($p = array())
        {
        $this->db->from ('view_stock_card');
        if (isset ($p['item_id']) && $p['item_id'] != null)
            {
            $this->db->where ('item_id', $p['item_id']);
            }
        $week = date ("W");
        $this->db->where ('week', $week);
        return $this->db->count_all_results ();
        }
    }
