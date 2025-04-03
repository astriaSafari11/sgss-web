<?php

class Master_model extends CI_Model
	{
	private function _get_datatables_query($p = array(), $type = "")
		{
		$table = "";

		if ($type == "vendor")
			{
			$column_search = array('vendor_code', 'vendor_name', 'rating');
			$column_order_vendor = array(null, 'vendor_code', 'vendor_name', 'rating');
			$order = array('vendor_code' => 'asc');

			$this->db->select ("view_master_vendor.*");

			if (isset ($p['vendor_code']) && $p['vendor_code'] != null)
				{
				$this->db->where ('vendor_code', $p['vendor_code']);
				}

			$table = 'view_master_vendor';
			}
		elseif ($type == "material")
			{
			$table = 'm_master_data_material';
			$this->db->where ('type', 'goods');
			$this->db->where ('is_active', 1);
			}
		elseif ($type == "service")
			{
			$table = 'm_master_data_material';
			$this->db->where ('type', 'service');
			$this->db->where ('is_active', 1);
			}
		elseif ($type == "material_by_factory")
			{
			$table = 'view_material_by_factory';
			}
		elseif ($type == "vendor_list")
			{
			$table = 'm_master_data_vendor';
			$this->db->where ('is_active', 1);
			}
		elseif ($type == "vendor_material_price")
			{
			$table = 'm_vendor_material_price';
			if (isset ($p['vendor_material_id']) && $p['vendor_material_id'] != null)
				{
				$this->db->where ('vendor_material_id', $p['vendor_material_id']);
				}
			}

		elseif ($type == "uom_list")
		{
			$table = 'm_uom';
			
			if (!empty($_POST['id'])) { 
				$this->db->where('id', $_POST['id']);
				
			}
			
		}
		
		elseif ($type == "category_list")
		{
			$table = 'm_category';
			
			if (!empty($_POST['id'])) { 
				$this->db->where('id', $_POST['id']);
				
			}
			
		}

		elseif ($type == "factory_list")
		{
			$table = 'm_factory';
			
			if (!empty($_POST['id'])) { 
				$this->db->where('id', $_POST['id']);
				
			}
			
		}

		elseif ($type == "purchase_reason")
		{
			$table = 'm_purchase_reason';
			
			if (!empty($_POST['id'])) { 
				$this->db->where('id', $_POST['id']);
				
			}
			
		}

		elseif ($type == "item_group")
		{
			$table = 'm_item_category';
			
			if (!empty($_POST['id'])) { 
				$this->db->where('id', $_POST['id']);
				
			}
			
		}

		$this->db->from ($table);

		$i = 0;
		if (isset ($_POST['order']))
			{
			$this->db->order_by ($column_order_vendor[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
			}
		else if (isset ($order))
			{
			$this->db->order_by (key ($order), $order[key ($order)]);
			}
		}

	function get_datatables($p = array(), $type = "")
		{
		$this->_get_datatables_query ($p, $type);
		if ($_POST['length'] != -1)
			$this->db->limit ($_POST['length'], $_POST['start']);
		$query = $this->db->get ();
		return $query->result ();
		}

	function count_filtered($p = array(), $type = "")
		{
		$this->_get_datatables_query ($p, $type);
		$query = $this->db->get ();
		return $query->num_rows ();
		}

	public function count_all($type = "")
		{
		if ($type == "vendor")
			{
			$this->db->from ('view_master_vendor');
			}
		elseif ($type == "material")
			{
			$this->db->from ('m_master_data_material');
			}
		elseif ($type == "vendor_material_price")
			{
			$this->db->from ('vendor_material_price');
			}

		return $this->db->count_all_results ();
		}
	}
