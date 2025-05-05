<?php

class Service_master_model extends CI_Model
	{
	private function _get_datatables_query($p = array(), $type = "")
		{
		$table = "";

		if ($type == "vendor_list")
			{
			$table = 'm_master_data_vendor';
			$this->db->where ('type', 'service');
			$this->db->where ('is_active', 1);
			}
		elseif ($type == "service")
			{
			$table = 'm_master_data_material';
			$this->db->where ('type', 'service');
			$this->db->where ('is_active', 1);

			}
		elseif ($type == "purchase_reason")
			{
			$table = 'm_purchase_reason';
			$this->db->where ('type', 'service');
			}
		elseif ($type == "vendor")
			{
			$column_search = array('vendor_code', 'vendor_name', 'rating');
			$column_order_vendor = array(null, 'vendor_code', 'vendor_name', 'rating');
			$order = array('vendor_code' => 'asc');

			$this->db->select ("view_master_vendor_service.*");

			if (isset ($p['vendor_code']) && $p['vendor_code'] != null)
				{
				$this->db->where ('vendor_code', $p['vendor_code']);
				}

			$table = 'view_master_vendor_service';
			}

		if (isset ($p['column_search']) && $p['column_search'] != null)
			{
			$count = count ($p['column_search']);
			for ($i = 0; $i < $count; $i++)
				{
				$column_search = $p['column_search'][$i];
				$search = $p['keyword'][$i];
				$filter = $p['column_filter'][$i];

				if (! empty ($search) && ! empty ($column_search) && ! empty ($filter))
					{
					if ($filter == 'like')
						{
						$this->db->like ($column_search, $search);
						}
					else
						{
						$this->db->where ($column_search . " " . $filter, $search);
						}
					}

				}
			}

		$this->db->from ($table);
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
		elseif ($type == "uom_list")
			{
			$this->db->from ('m_uom');
			}
		$this->db->where ('type', 'service');
		return $this->db->count_all_results ();
		}
	}
