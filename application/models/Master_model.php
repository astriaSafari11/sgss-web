<?php

class Master_model extends CI_Model
{
	private function _get_datatables_query($p=array(), $type="")
	{			 
			$table = "";

			if($type == "vendor"){
				$column_search = array('vendor_code','vendor_name','rating');
				$column_order_vendor = array(null, 'vendor_code','vendor_name','rating');
				$order = array('vendor_code' => 'asc');

				$this->db->select("view_master_vendor.*");		
				$table = 'view_master_vendor';			
			}elseif($type == "material"){
				$this->db->select("
					item_code,
					item_name,
					factory,
					uom,
					lt_pr_po,
					vendor_code,
					lot_size,
					initial_value_stock,
					order_cycle,
					initial_stock,
					lt_po_to_delivery,
					((lt_pr_po/order_cycle)*lot_size) as standar_safety_stock,
					initial_value_for_to_do
				");		
				$table = 'm_master_data_material';			
			}

			$this->db->from($table);							
				
			$i = 0;			 
			if(isset($_POST['order'])) 
			{
					$this->db->order_by($column_order_vendor[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
			} 
			else if(isset($order))
			{
					$this->db->order_by(key($order), $order[key($order)]);
			}
	}

	function get_datatables($p=array(), $type="")
	{
			$this->_get_datatables_query($p, $type);
			if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
			$query = $this->db->get();
			return $query->result();
	}

	function count_filtered($p=array(), $type="")
	{
			$this->_get_datatables_query($p, $type);
			$query = $this->db->get();
			return $query->num_rows();
	}

	public function count_all($type="")
	{
		if($type == "vendor"){
			$this->db->from('view_master_vendor');
		}elseif($type == "material"){
			$this->db->from('m_master_data_material');							
		}		

		return $this->db->count_all_results();
	}
}
