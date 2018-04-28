<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Uom extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Uom';

		$this->load->model('model_uom');
	}

	/* 
	* It only redirects to the manage uom page
	*/
	public function index()
	{

		$this->render_template('uom/index', $this->data);	
	}	

	/*
	* It checks if it gets the uom id and retreives
	* the uom information from the uom model and 
	* returns the data into json format. 
	* This function is invoked from the view page.
	*/
	public function fetchUomDataById($id) 
	{
		if($id) {
			$data = $this->model_uom->getUomData($id);
			echo json_encode($data);
		}

		return false;
	}

	/*
	* Fetches the uom value from the uom table 
	* this function is called from the datatable ajax function
	*/
	public function fetchUomData()
	{
		$result = array('data' => array());

		$data = $this->model_uom->getUomData();

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			$buttons .= '<button type="button" class="btn btn-default" onclick="editFunc('.$value['uom_id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';

			$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['uom_id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
				
			$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$value['uom_name'],
				$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	/*
	* Its checks the Uom form validation 
	* and if the validation is successfully then it inserts the data into the database 
	* and returns the json format operation messages
	*/
	public function create()
	{
		$response = array();

		$this->form_validation->set_rules('uom_name', 'Uom name', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'uom_name' => $this->input->post('uom_name'),
        		'active' => $this->input->post('active'),	
        		'date_created' => date('Y-m-d H:i:s'),	
        		'date_modified' => date('Y-m-d H:i:s'),	
        	);

        	$create = $this->model_uom->create($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Uom Succesfully created';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating Vednor';			
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
	* Its checks the uom form validation 
	* and if the validation is successfully then it updates the data into the database 
	* and returns the json format operation messages
	*/
	public function update($id)
	{
		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_uom_name', 'Uom name', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'uom_name' => $this->input->post('edit_uom_name'),
	        		'active' => $this->input->post('edit_active'),	
	        		'date_modified' => date('Y-m-d H:i:s'),	
	        	);

	        	$update = $this->model_uom->update($data, $id);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the brand information';			
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
	* It removes the uom information from the database 
	* and returns the json format operation messages
	*/
	public function remove()
	{

		$uom_id = $this->input->post('uom_id');

		$response = array();
		if($uom_id) {
			$delete = $this->model_uom->remove($uom_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Uom Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing Uom";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}

}