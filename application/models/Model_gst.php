<?php 

class Model_gst extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the gst data */
	public function getGstData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM vendor_gst where gst_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM vendor_gst ORDER BY gst_id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('vendor_gst', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('gst_id', $id);
			$update = $this->db->update('vendor_gst', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('gst_id', $id);
			$delete = $this->db->delete('vendor_gst');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalGst()
	{
		$sql = "SELECT * FROM vendor_gst";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

}