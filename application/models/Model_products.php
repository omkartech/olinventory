<?php 

class Model_products extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the brand data */
	public function getProductData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM product where product_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM product ORDER BY product_id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getActiveProductData()
	{
		$sql = "SELECT * FROM products WHERE availability = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('product', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('product_id', $id);
			$update = $this->db->update('product', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('product_id', $id);
			$delete = $this->db->delete('product');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalProducts()
	{
		$sql = "SELECT * FROM product";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

}