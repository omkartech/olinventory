<?php 

class Model_color extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the brand data */
	public function getColorData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM color where color_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM color ORDER BY color_id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getActiveColorData()
	{
		$sql = "SELECT * FROM color WHERE availability = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('color', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('color_id', $id);
			$update = $this->db->update('color', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('color_id', $id);
			$delete = $this->db->delete('color');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalColor()
	{
		$sql = "SELECT * FROM color";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

}