<?php 

class Model_inventory extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the inventory data */
	public function getInventoryData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM inventory where inventory_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM inventory ORDER BY inventory_id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('inventory', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('inventory_id', $id);
			$update = $this->db->update('inventory', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('inventory_id', $id);
			$delete = $this->db->delete('inventory');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalInventory()
	{
		$sql = "SELECT * FROM inventory";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

}