<?php

class Gross_req_model extends CI_Model
{
	private function _get_datatables_query($p=array())
	{		
			$column_search = array('week','type');
			$column_order = array(null, 'week','type');		
			$year = date('Y');
			$table = 'm_stock_card_formula';	
			$this->db->where('year', $year);		

			if(isset($p['vendor_material_id']) && $p['vendor_material_id'] != null){
				$this->db->where('vendor_material_id', $p['vendor_material_id']);
			}
			
			$this->db->from($table);							

			$i = 0;			 
			if(isset($_POST['order'])) 
			{
					$this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
			} 
			else if(isset($order))
			{
					$this->db->order_by(key($order), $order[key($order)]);
			}
	}

	function get_datatables($p=array())
	{
			$this->_get_datatables_query($p);
			if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
			$query = $this->db->get();
			return $query->result();
	}

	function count_filtered($p=array())
	{
			$this->_get_datatables_query($p);
			$query = $this->db->get();
			return $query->num_rows();
	}

	public function count_all($type="")
	{
		$this->db->from('m_stock_card_formula');		
		return $this->db->count_all_results();
	}
}
