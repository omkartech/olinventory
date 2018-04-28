<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends Admin_Controller 
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
	public function index()
	{
        /*if(!in_array('viewProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }*/

		$this->render_template('products/index', $this->data);	
	}

    /*
    * It Fetches the products data from the product table 
    * this function is called from the datatable ajax function
    */
	public function fetchProductData()
	{
		$result = array('data' => array());

		$data = $this->model_products->getProductData();

		/*foreach ($data as $key => $value) {

            $store_data = $this->model_stores->getStoresData($value['store_id']);
			// button
            $buttons = '';
            if(in_array('updateProduct', $this->permission)) {
    			$buttons .= '<a href="'.base_url('products/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('deleteProduct', $this->permission)) { 
    			$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
			

			$img = '<img src="'.base_url($value['image']).'" alt="'.$value['name'].'" class="img-circle" width="50" height="50" />';

            $availability = ($value['availability'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

            $qty_status = '';
            if($value['qty'] <= 10) {
                $qty_status = '<span class="label label-warning">Low !</span>';
            } else if($value['qty'] <= 0) {
                $qty_status = '<span class="label label-danger">Out of stock !</span>';
            }


			$result['data'][$key] = array(
				$img,
				$value['sku'],
				$value['name'],
				$value['price'],
                $value['qty'] . ' ' . $qty_status,
                $store_data['name'],
				$availability,
				$buttons
			);
		}*/ // /foreach

        foreach ($data as $key => $value) {

            // button
            $buttons = '';

            // if(in_array('updateVendor', $this->permission)) {
                $buttons .= '<button type="button" class="btn btn-default" onclick="editFunc('.$value['product_id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
            // }

            // if(in_array('deleteVendor', $this->permission)) {
                $buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['product_id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            // }
                

            $status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

            $result['data'][$key] = array(
                $value['product_name'],
                $status,
                $buttons
            );
        } // /foreach

		echo json_encode($result);
	}	

    /*
    * If the validation is not valid, then it redirects to the create page.
    * If the validation for each input field is valid then it inserts the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage product page
    */
	public function create()
	{
		$response = array();

        $this->form_validation->set_rules('product_name', 'product name', 'trim|required');
        $this->form_validation->set_rules('active', 'Active', 'trim|required');

        $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'product_name' => $this->input->post('product_name'),
                'active' => $this->input->post('active'),   
                'date_created' => date('Y-m-d H:i:s'),  
                'date_modified' => date('Y-m-d H:i:s'), 
            );

            $create = $this->model_products->create($data);
            if($create == true) {
                $response['success'] = true;
                $response['messages'] = 'Product Succesfully created';
            }
            else {
                $response['success'] = false;
                $response['messages'] = 'Error in the database while creating Product';          
            }
        }
        else {
            $response['success'] = false;
            foreach ($_POST as $key => $value) {
                $response['messages'][$key] = form_error($key);
            }
        }

        echo json_encode($response);	
	}

    /*
    * This function is invoked from another function to upload the image into the assets folder
    * and returns the image path
    */

    /*
    * If the validation is not valid, then it redirects to the edit product page 
    * If the validation is successfully then it updates the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage product page
    */
	public function update($id)
    {

        // if(!in_array('updateVendor', $this->permission)) {
        //  redirect('dashboard', 'refresh');
        // }

        $response = array();

        if($id) {
            $this->form_validation->set_rules('edit_product_name', 'Product name', 'trim|required');
            $this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

            $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'product_name' => $this->input->post('edit_product_name'),
                    'active' => $this->input->post('edit_active'),  
                    'date_modified' => date('Y-m-d H:i:s'), 
                );

                $update = $this->model_products->update($data, $id);
                if($update == true) {
                    $response['success'] = true;
                    $response['messages'] = 'Succesfully updated';
                }
                else {
                    $response['success'] = false;
                    $response['messages'] = 'Error in the database while updated the product information';            
                }
            }
            else {
                $response['success'] = false;
                foreach ($_POST as $key => $value) {
                    $response['messages'][$key] = form_error($key);
                }
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = 'Error please refresh the page again!!';
        }

        echo json_encode($response);
    }

    /*
    * It removes the data from the database
    * and it returns the response into the json format
    */
	public function remove()
    {
        // if(!in_array('deleteVendor', $this->permission)) {
        //  redirect('dashboard', 'refresh');
        // }
        
        $product_id = $this->input->post('product_id');

        $response = array();
        if($product_id) {
            $delete = $this->model_products->remove($product_id);
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Product Successfully removed";  
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing Product";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response);
    }


    public function fetchProductDataById($id) 
    {
        if($id) {
            $data = $this->model_products->getProductData($id);
            echo json_encode($data);
        }

        return false;
    }
}