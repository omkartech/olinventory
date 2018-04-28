<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Vendor';

		$this->load->model('model_vendor');
	}

	/* 
	* It only redirects to the manage vendor page
	*/
	public function index()
	{

		// if(!in_array('viewVendor', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		$this->render_template('vendor/index', $this->data);	
	}	

	/*
	* It checks if it gets the vendor id and retreives
	* the vendor information from the vendor model and 
	* returns the data into json format. 
	* This function is invoked from the view page.
	*/
	public function fetchVendorDataById($id) 
	{
		if($id) {
			$data = $this->model_vendor->getVendorData($id);
			echo json_encode($data);
		}

		return false;
	}

	/*
	* Fetches the vendor value from the vendor table 
	* this function is called from the datatable ajax function
	*/
	public function fetchVendorData()
	{
		$result = array('data' => array());

		$data = $this->model_vendor->getVendorData();

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			// if(in_array('updateVendor', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-default" onclick="editFunc('.$value['vendor_id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
			// }

			// if(in_array('deleteVendor', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['vendor_id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			// }
				

			$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$value['vendor_name'],
				$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	/*
	* Its checks the vendor form validation 
	* and if the validation is successfully then it inserts the data into the database 
	* and returns the json format operation messages
	*/
	public function create()
	{
		// if(!in_array('createVendor', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		$response = array();

		$this->form_validation->set_rules('vendor_name', 'Vendor name', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'vendor_name' => $this->input->post('vendor_name'),
        		'active' => $this->input->post('active'),	
        		'date_created' => date('Y-m-d H:i:s'),	
        		'date_modified' => date('Y-m-d H:i:s'),	
        	);

        	$create = $this->model_vendor->create($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Vendor Succesfully created';
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
	* Its checks the vendor form validation 
	* and if the validation is successfully then it updates the data into the database 
	* and returns the json format operation messages
	*/
	public function update($id)
	{

		// if(!in_array('updateVendor', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_vendor_name', 'Vendor name', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'vendor_name' => $this->input->post('edit_vendor_name'),
	        		'active' => $this->input->post('edit_active'),	
	        		'date_modified' => date('Y-m-d H:i:s'),	
	        	);

	        	$update = $this->model_vendor->update($data, $id);
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
	* It removes the vendor information from the database 
	* and returns the json format operation messages
	*/
	public function remove()
	{
		// if(!in_array('deleteVendor', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }
		
		$vendor_id = $this->input->post('vendor_id');

		$response = array();
		if($vendor_id) {
			$delete = $this->model_vendor->remove($vendor_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Vendor Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing Vendor";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}

}