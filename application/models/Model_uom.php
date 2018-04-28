<?php 

class Model_uom extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get active brand infromation */
	public function getActiveUom()
	{
		$sql = "SELECT * FROM uom WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	/* get the brand data */
	public function getUomData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM uom WHERE uom_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM uom";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('uom', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('uom_id', $id);
			$update = $this->db->update('uom', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('uom_id', $id);
			$delete = $this->db->delete('uom');
			return ($delete == true) ? true : false;
		}
	}

}