<?php 

class Model_orders extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the orders data */
	/*public function getOrdersData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM orders WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM orders ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}*/

	// get the orders item data
	public function getOrdersItemData($order_id = null)
	{
		if(!$order_id) {
			return false;
		}

		$sql = "SELECT * FROM orders_item WHERE order_id = ?";
		$query = $this->db->query($sql, array($order_id));
		return $query->result_array();
	}

	public function create()
	{
		$user_id = $this->session->userdata('id');
		$bill_no = 'BILPR-'.strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));
    	$data = array(
    		'bill_no' => $bill_no,
    		'customer_name' => $this->input->post('customer_name'),
    		'customer_address' => $this->input->post('customer_address'),
    		'customer_phone' => $this->input->post('customer_phone'),
    		'date_time' => strtotime(date('Y-m-d h:i:s a')),
    		'gross_amount' => $this->input->post('gross_amount_value'),
    		'service_charge_rate' => $this->input->post('service_charge_rate'),
    		'service_charge' => ($this->input->post('service_charge_value') > 0) ?$this->input->post('service_charge_value'):0,
    		'vat_charge_rate' => $this->input->post('vat_charge_rate'),
    		'vat_charge' => ($this->input->post('vat_charge_value') > 0) ? $this->input->post('vat_charge_value') : 0,
    		'net_amount' => $this->input->post('net_amount_value'),
    		'discount' => $this->input->post('discount'),
    		'paid_status' => 2,
    		'user_id' => $user_id
    	);

		$insert = $this->db->insert('orders', $data);
		$order_id = $this->db->insert_id();

		$this->load->model('model_products');

		$count_product = count($this->input->post('product'));
    	for($x = 0; $x < $count_product; $x++) {
    		$items = array(
    			'order_id' => $order_id,
    			'product_id' => $this->input->post('product')[$x],
    			'qty' => $this->input->post('qty')[$x],
    			'rate' => $this->input->post('rate_value')[$x],
    			'amount' => $this->input->post('amount_value')[$x],
    		);

    		$this->db->insert('orders_item', $items);

    		// now decrease the stock from the product
    		$product_data = $this->model_products->getProductData($this->input->post('product')[$x]);
    		$qty = (int) $product_data['qty'] - (int) $this->input->post('qty')[$x];

    		$update_product = array('qty' => $qty);


    		$this->model_products->update($update_product, $this->input->post('product')[$x]);
    	}

		return ($order_id) ? $order_id : false;
	}

	public function update($id)
	{
		if($id) {
			$user_id = $this->session->userdata('id');
			// fetch the order data 

			$data = array(
				'customer_name' => $this->input->post('customer_name'),
	    		'customer_address' => $this->input->post('customer_address'),
	    		'customer_phone' => $this->input->post('customer_phone'),
	    		'gross_amount' => $this->input->post('gross_amount_value'),
	    		'service_charge_rate' => $this->input->post('service_charge_rate'),
	    		'service_charge' => ($this->input->post('service_charge_value') > 0) ? $this->input->post('service_charge_value'):0,
	    		'vat_charge_rate' => $this->input->post('vat_charge_rate'),
	    		'vat_charge' => ($this->input->post('vat_charge_value') > 0) ? $this->input->post('vat_charge_value') : 0,
	    		'net_amount' => $this->input->post('net_amount_value'),
	    		'discount' => $this->input->post('discount'),
	    		'paid_status' => $this->input->post('paid_status'),
	    		'user_id' => $user_id
	    	);

			$this->db->where('id', $id);
			$update = $this->db->update('orders', $data);

			// now the order item 
			// first we will replace the product qty to original and subtract the qty again
			$this->load->model('model_products');
			$get_order_item = $this->getOrdersItemData($id);
			foreach ($get_order_item as $k => $v) {
				$product_id = $v['product_id'];
				$qty = $v['qty'];
				// get the product 
				$product_data = $this->model_products->getProductData($product_id);
				$update_qty = $qty + $product_data['qty'];
				$update_product_data = array('qty' => $update_qty);
				
				// update the product qty
				$this->model_products->update($update_product_data, $product_id);
			}

			// now remove the order item data 
			$this->db->where('order_id', $id);
			$this->db->delete('orders_item');

			// now decrease the product qty
			$count_product = count($this->input->post('product'));
	    	for($x = 0; $x < $count_product; $x++) {
	    		$items = array(
	    			'order_id' => $id,
	    			'product_id' => $this->input->post('product')[$x],
	    			'qty' => $this->input->post('qty')[$x],
	    			'rate' => $this->input->post('rate_value')[$x],
	    			'amount' => $this->input->post('amount_value')[$x],
	    		);
	    		$this->db->insert('orders_item', $items);

	    		// now decrease the stock from the product
	    		$product_data = $this->model_products->getProductData($this->input->post('product')[$x]);
	    		$qty = (int) $product_data['qty'] - (int) $this->input->post('qty')[$x];

	    		$update_product = array('qty' => $qty);
	    		$this->model_products->update($update_product, $this->input->post('product')[$x]);
	    	}

			return true;
		}
	}



	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('orders');

			$this->db->where('order_id', $id);
			$delete_item = $this->db->delete('orders_item');
			return ($delete == true && $delete_item) ? true : false;
		}
	}

	public function countTotalPaidOrders()
	{
		$sql = "SELECT * FROM orders";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	public function getColorOnProduct($productId)
	{
		$sql = "SELECT c.color_name,c.color_id FROM inventory pm join color c ON pm.color_id = c.color_id where pm.product_id = ".$productId."";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getSizeOnProduct($colorId, $productId)
	{
		$sql = "SELECT s.size_name,s.size_id FROM inventory pm join size s ON pm.size_id = s.size_id where pm.product_id = ".$productId." and pm.color_id = ".$colorId."";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getUomOnProduct($sizeId, $colorId, $productId)
	{
		$sql = "SELECT u.uom_name,u.uom_id FROM inventory pm join uom u ON pm.uom_id = u.uom_id where pm.product_id = ".$productId." and pm.size_id = ".$sizeId." and pm.color_id = ".$colorId."";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getVendorData()
	{
		$sql = "SELECT * FROM vendor ORDER BY vendor_id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function generateOrder($data, $totalAmount, $vendor_id)
	{

		$order = array(
    		'vendor_id' => $vendor_id,
    		'total_amount' => $totalAmount,
    		'date_created' => date('Y-m-d H:i:s'),
    	);

		$insert = $this->db->insert('orders', $order);
		$order_id = $this->db->insert_id();


		$orderItems = [];
        for ($i=0; $i < count($data); $i++) {
            $total = $data[$i]['qty'] * $data[$i]['rate'];
            $orderItem = array(
                'order_id' => $order_id,
                'product_id' => $data[$i]['product_id'],   
                'color_id' => $data[$i]['color_id'],  
                'size_id' => $data[$i]['size_id'],  
                'uom_id' => $data[$i]['uom_id'],  
                'qty' => $data[$i]['qty'],  
                'rate' => $data[$i]['rate'],  
                'amount' => $total
            );
            $sql = "SELECT stock FROM inventory where product_id = ".$data[$i]['product_id']." and size_id = ".$data[$i]['size_id']." and color_id = ".$data[$i]['color_id']."";
			$query = $this->db->query($sql);
			$res = $query->row_array();
			$stockBalance = $res['stock'] - $data[$i]['qty'];
			$sql = "update inventory set stock = ".$stockBalance." where product_id = ".$data[$i]['product_id']." and size_id = ".$data[$i]['size_id']." and color_id = ".$data[$i]['color_id']."";
			$query = $this->db->query($sql);

            array_push($orderItems, $orderItem);
        }

        return $this->db->insert_batch('orders_item', $orderItems); 
	}

	public function getOrdersData(){
		$sql = "SELECT * FROM orders o join vendor v ON o.vendor_id = v.vendor_id";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function countOrderItem($order_id){

		if($order_id) {
			$sql = "SELECT * FROM orders_item WHERE order_id = ?";
			$query = $this->db->query($sql, array($order_id));
			return $query->num_rows();
		}
	}

	public function getOrdersItems($orderId)
	{
		$sql = "SELECT p.product_name,s.size_name,c.color_name,o.qty,o.rate,o.amount FROM orders_item o join product p ON o.product_id = p.product_id join color c ON o.color_id = c.color_id join size s ON o.size_id = s.size_id where o.order_id = ".$orderId."";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getOrder($orderId)
	{
		$sql = "SELECT v.vendor_name,o.date_created,o.total_amount FROM orders o join vendor v ON o.vendor_id = v.vendor_id where o.id = ".$orderId."";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

}