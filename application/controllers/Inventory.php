<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Inventory';

		$this->load->model('model_inventory');
        $this->load->model('model_products');
        $this->load->model('model_size');
        $this->load->model('model_color');
		$this->load->model('model_uom');
	}

    /* 
    * It only redirects to the manage inventory page
    */
	public function index()
	{
		$this->render_template('inventory/index', $this->data);	
	}

    /*
    * It Fetches the inventory data from the inventory table 
    * this function is called from the datatable ajax function
    */
	public function fetchInventoryData()
	{
		$result = array('data' => array());

        $data = $this->model_inventory->getInventoryData();

        foreach ($data as $key => $value) {

            // button
            $buttons = '';
            
            // $buttons .= '<a href="'.base_url('inventory/update/'.$value['inventory_id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
         
            // $buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['inventory_id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            
            $product_data = $this->model_products->getProductData($value['product_id']);
            $size_data = $this->model_size->getSizeData($value['size_id']);
            $color_data = $this->model_color->getColorData($value['color_id']);
		    $uom_data = $this->model_uom->getUomData($value['uom_id']);

            // print_r($size_data);exit();
            // echo $category_data['name'];exit();

			$result['data'][$key] = array(
                $product_data['product_name'],
                $size_data['size_name'],
                $color_data['color_name'],
                $uom_data['uom_name'],
                $value['stock'],
                $value['date_created'],
				// $buttons
			);
		} // /foreach

		echo json_encode($result);
	}	

    /*
    * If the validation is not valid, then it redirects to the create page.
    * If the validation for each input field is valid then it inserts the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage inventory page
    */
	public function create()
	{
        $this->form_validation->set_rules('product_id', 'Product', 'trim|required');
        $this->form_validation->set_rules('size_id', 'Size', 'trim|required');
        $this->form_validation->set_rules('color_id', 'Color', 'trim|required');
        $this->form_validation->set_rules('uom_id', 'UOM', 'trim|required');
		$this->form_validation->set_rules('stock', 'Stock', 'trim|required');
		
        if ($this->form_validation->run() == TRUE) {
            // true case

        	$data = array(
                'product_id' => $this->input->post('product_id'),
        		'size_id' => $this->input->post('size_id'),
                'color_id' => $this->input->post('color_id'),
                'uom_id' => $this->input->post('uom_id'),
        		'stock' => $this->input->post('stock'),
                'date_created' => date('Y-m-d H:i:s'),
        		'date_modified' => date('Y-m-d H:i:s'),
        	);

            // print_r($data);exit();
            
        	$create = $this->model_inventory->create($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Stock Successfully added');
        		redirect('inventory/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('inventory/create', 'refresh');
        	}
        }
        else {
            $this->data['product'] = $this->model_products->getProductData();          
            $this->data['size'] = $this->model_size->getSizeData();           
            $this->data['color'] = $this->model_color->getColorData();            
			$this->data['uom'] = $this->model_uom->getActiveUom();        	
            $this->render_template('inventory/create', $this->data);
        }	
	}

    
    /*
    * If the validation is not valid, then it redirects to the edit inventory page 
    * If the validation is successfully then it updates the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage inventory page
    */
	public function update($inventory_id)
	{      
        
        if(!$inventory_id) {
            redirect('dashboard', 'refresh');
        }

        $this->form_validation->set_rules('product_id', 'Product', 'trim|required');
        $this->form_validation->set_rules('size_id', 'Size', 'trim|required');
        $this->form_validation->set_rules('color_id', 'Color', 'trim|required');
        $this->form_validation->set_rules('uom_id', 'UOM', 'trim|required');
        $this->form_validation->set_rules('stock', 'Stock', 'trim|required');
        
        if ($this->form_validation->run() == TRUE) {
            // true case
            
            $data = array(
                'product_id' => $this->input->post('product_id'),
                'size_id' => $this->input->post('size_id'),
                'color_id' => $this->input->post('color_id'),
                'uom_id' => $this->input->post('uom_id'),
                'stock' => $this->input->post('stock'),
            );

            $update = $this->model_inventory->update($data, $inventory_id);
            if($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('inventory/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('inventory/update/'.$inventory_id, 'refresh');
            }
        }
        else {
            $this->data['inventory'] = $this->model_inventory->getActiveInventory();           
                     
            $inventory_data = $this->model_inventory->getInventoryData($inventory_id);
            $this->data['inventory_data'] = $inventory_data;
            $this->render_template('inventory/edit', $this->data); 
        }   
	}

    /*
    * It removes the data from the database
    * and it returns the response into the json format
    */
	public function remove()
	{
    
        $inventory_id = $this->input->post('inventory_id');

        $response = array();
        if($inventory_id) {
            $delete = $this->model_inventory->remove($inventory_id);
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Stock Entry Successfully removed"; 
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the stock information";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response);
	}

}