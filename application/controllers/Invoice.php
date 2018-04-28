<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Product';

		$this->load->model('model_products');
        
		/*$this->load->model('model_brands');
		$this->load->model('model_category');
		$this->load->model('model_stores');
		$this->load->model('model_attributes');*/
	}

    /* 
    * It only redirects to the manage product page
    */
	public function create()
	{
        /*if(!in_array('viewProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }*/

        $this->data['vendor'] = $this->model_products->getVendorData();
        $this->data['products'] = $this->model_products->getProductData();

		$this->render_template('invoice/create', $this->data);	
	}

    public function getColor($productId){
        if($productId) {
            $data = $this->model_products->getColorOnProduct($productId);
            echo json_encode($data);
        }
    }

    public function getSize($colorId, $productId){
        
        $data = $this->model_products->getSizeOnProduct($colorId, $productId);
        echo json_encode($data);
    }

    public function getUom($sizeId, $colorId, $productId){
        
        $data = $this->model_products->getUomOnProduct($sizeId, $colorId, $productId);
        echo json_encode($data);
    }

    public function generate($vendor_id){
        $data = $_POST['data'];
        $totalAmount = 0;
        for ($i=0; $i < count($data); $i++) {
            $total = $data[$i]['qty'] * $data[$i]['rate'];
            $totalAmount = $totalAmount + $total;
        }
        $response = $this->model_products->generateOrder($data, $totalAmount, $vendor_id);
        echo json_encode($data);
    }
}