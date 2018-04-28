<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Color extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Color';

		$this->load->model('model_color');
	}

    /* 
    * It only redirects to the manage product page
    */
	public function index()
	{
        /*if(!in_array('viewProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }*/

		$this->render_template('color/index', $this->data);	
	}

    /*
    * It Fetches the products data from the product table 
    * this function is called from the datatable ajax function
    */
	public function fetchColorData()
	{
		$result = array('data' => array());

		$data = $this->model_color->getColorData();

        foreach ($data as $key => $value) {

            // button
            $buttons = '';

            // if(in_array('updateVendor', $this->permission)) {
                $buttons .= '<button type="button" class="btn btn-default" onclick="editFunc('.$value['color_id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
            // }

            // if(in_array('deleteVendor', $this->permission)) {
                $buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['color_id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            // }
                

            $status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

            $result['data'][$key] = array(
                $value['color_name'],
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

        $this->form_validation->set_rules('color_name', 'color name', 'trim|required');
        $this->form_validation->set_rules('active', 'Active', 'trim|required');

        $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'color_name' => $this->input->post('color_name'),
                'active' => $this->input->post('active'),   
                'date_created' => date('Y-m-d H:i:s'),  
                'date_modified' => date('Y-m-d H:i:s'), 
            );

            $create = $this->model_color->create($data);
            if($create == true) {
                $response['success'] = true;
                $response['messages'] = 'Color Succesfully created';
            }
            else {
                $response['success'] = false;
                $response['messages'] = 'Error in the database while creating Color';          
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
            $this->form_validation->set_rules('edit_color_name', 'Color name', 'trim|required');
            $this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

            $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'color_name' => $this->input->post('edit_color_name'),
                    'active' => $this->input->post('edit_active'),  
                    'date_modified' => date('Y-m-d H:i:s'), 
                );

                $update = $this->model_color->update($data, $id);
                if($update == true) {
                    $response['success'] = true;
                    $response['messages'] = 'Succesfully updated';
                }
                else {
                    $response['success'] = false;
                    $response['messages'] = 'Error in the database while updated the color information';            
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
        
        $color_id = $this->input->post('color_id');

        $response = array();
        if($color_id) {
            $delete = $this->model_color->remove($color_id);
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Color Successfully removed";  
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing Color";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response);
    }


    public function fetchColorDataById($id) 
    {
        if($id) {
            $data = $this->model_color->getColorData($id);
            echo json_encode($data);
        }

        return false;
    }
}