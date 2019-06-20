<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Change_Password extends General_Functions {

	 function __construct() {
	 	
        parent::__construct();
        $this->user = $this->session->userdata('user'); 

    }

    public function index() {
    	$this->load->view('change_password');
    }

    public function update() {
    	if ($this->input->post('submitChangePassword')) {
    			$this->form_validation->set_rules('current_password', 'Old password', 'required');
    			$this->form_validation->set_rules('password', 'New password', 'required');
	            $this->form_validation->set_rules('confirm_password', 'Password', 'required|matches[password]');


	            $userData = array(
	                'password' => strip_tags($this->input->post('password')),
	                'status' => 1
	            );

	            $con['returnType'] = 'single';
                $con['conditions'] = array(
                    'email'=>$this->user['email'],
                    'password' => md5($this->input->post('current_password')), //md5($this->input->post('password')),
                    'status' => '1'
                );
                
                
           
	             if ($this->form_validation->run() == true) {
	             	$check = $this->Common_Model->getRows($con, 'hr_users');
	                if($check){

	                	$condition = array(
		                    'id' => $this->user['id']
		                );

	                	$userData = array(
		                    'password' => md5(strip_tags($this->input->post('password'))),
		                );
	                	$update = $this->Common_Model->update($userData, $condition, 'hr_users');

	                	if ($update) {
	                		$this->session->set_flashdata('success', array('message' => 'Password changed successfully.'));
                      	  redirect('Change_Password');
	                	}

	                } else {
	                    $this->session->set_flashdata('warning', array('message' => 'Current password is wrong. Please try again.'));
	                    redirect('Change_Password');
	                }
	            } else {
		        //load the view
		        $this->load->view('change_password');
		    }
		}
    }

   
}