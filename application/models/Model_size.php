<?php 

class Model_size extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the brand data */
	public function getSizeData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM size where size_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM size ORDER BY size_id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getActiveSizeData()
	{
		$sql = "SELECT * FROM size WHERE availability = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('size', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('size_id', $id);
			$update = $this->db->update('size', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('size_id', $id);
			$delete = $this->db->delete('size');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalSize()
	{
		$sql = "SELECT * FROM size";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

}