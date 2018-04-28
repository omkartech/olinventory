<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gst extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Vendor GST';

		$this->load->model('model_gst');
		$this->load->model('model_vendor');
	}

    /* 
    * It only redirects to the manage gst page
    */
	public function index()
	{
		$this->render_template('gst/index', $this->data);	
	}

    /*
    * It Fetches the gst data from the gst table 
    * this function is called from the datatable ajax function
    */
	public function fetchGstData()
	{
		$result = array('data' => array());

		$data = $this->model_gst->getGstData();

		foreach ($data as $key => $value) {

			// button
            $buttons = '';
            
    		$buttons .= '<a href="'.base_url('gst/update/'.$value['gst_id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
         
    		$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['gst_id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            
            // $availability = ($value['availability'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

            // $qty_status = '';
            // if($value['qty'] <= 10) {
            //     $qty_status = '<span class="label label-warning">Low !</span>';
            // } else if($value['qty'] <= 0) {
            //     $qty_status = '<span class="label label-danger">Out of stock !</span>';
            // }


			$result['data'][$key] = array(
				$value['vendor_name'],
                $value['gst_amount'],
                $value['date_created'],
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}	

    /*
    * If the validation is not valid, then it redirects to the create page.
    * If the validation for each input field is valid then it inserts the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage gst page
    */
	public function create()
	{
		$this->form_validation->set_rules('vendor_id', 'Vendor ID', 'trim|required');
		// $this->form_validation->set_rules('vendor_name', 'Vendor Name', 'trim|required');
		$this->form_validation->set_rules('gst_amount', 'GST Amount', 'trim|required');
		
        if ($this->form_validation->run() == TRUE) {
            // true case

            $datas = explode('|',$this->input->post('vendor_id'));
            $id = $datas[0];
            $name = $datas[1];

        	$data = array(
                'vendor_id' => $id,
        		'vendor_name' => $name,
        		'gst_amount' => $this->input->post('gst_amount'),
                'date_created' => date('Y-m-d H:i:s'),
        		'date_modified' => date('Y-m-d H:i:s'),
        	);

            // print_r($data);exit();
            
        	$create = $this->model_gst->create($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Vendor GST Successfully added');
        		redirect('gst/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('gst/create', 'refresh');
        	}
        }
        else {
			$this->data['vendor'] = $this->model_vendor->getActiveVendor();        	
            $this->render_template('gst/create', $this->data);
        }	
	}

    
    /*
    * If the validation is not valid, then it redirects to the edit gst page 
    * If the validation is successfully then it updates the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage gst page
    */
	public function update($gst_id)
	{      
        
        if(!$gst_id) {
            redirect('dashboard', 'refresh');
        }

        $this->form_validation->set_rules('vendor_id', 'Vendor ID', 'trim|required');
        // $this->form_validation->set_rules('vendor_name', 'Vendor Name', 'trim|required');
        $this->form_validation->set_rules('gst_amount', 'GST Amount', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            // true case
            
            $data = array(
                'vendor_id' => $this->input->post('vendor_id'),
                'gst_amount' => $this->input->post('gst_amount'),
                
            );

            $update = $this->model_gst->update($data, $gst_id);
            if($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('gst/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('gst/update/'.$gst_id, 'refresh');
            }
        }
        else {
            $this->data['vendor'] = $this->model_vendor->getActiveVendor();           
                     
            $gst_data = $this->model_gst->getGstData($gst_id);
            $this->data['gst_data'] = $gst_data;
            $this->render_template('gst/edit', $this->data); 
        }   
	}

    /*
    * It removes the data from the database
    * and it returns the response into the json format
    */
	public function remove()
	{
    
        $gst_id = $this->input->post('gst_id');

        $response = array();
        if($gst_id) {
            $delete = $this->model_gst->remove($gst_id);
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Vendor GST Entry Successfully removed"; 
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the gst information";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response);
	}

}