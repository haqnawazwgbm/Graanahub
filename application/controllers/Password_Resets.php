<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Password_Resets extends General_Functions {

	 function __construct() {
        parent::__construct();

    }

    public function index() {
    	$this->load->view('send_mail_form');
    }

    public function send_mail() {
    	if ($this->input->post('sendMail')) {

	    	$email = $this->input->post('email');
	    	$token = md5($email.time());
	    	$con['conditions'] = array(
	    		'email' => $email
	    	);
	    	$con['returnType'] = 'single';

	    	$user = $this->Common_Model->getRows($con, 'hr_users');
	    	if ($user) {
	    		$userData = array(
	    			'email' => $email,
	    			'token' => $token
	    		);
	    		$id = $this->Common_Model->insert($userData, 'hr_password_resets');
	    		
	    		$userData['message'] = 'Click the below link to open your reset password form. <br /><a href="' . base_url() . 'Password_Resets/reset_pass_form/' . $token . '">Reset</a>';
	    		$userData['subject'] = 'Password reset';
	    		$result = $this->sendMail($userData);
	    		if ($result) {
	    			$this->session->set_flashdata('success', array('message' => 'We sent an email address for reset password.'));
	    			redirect('Password_Resets');
	    		} else {
	    			$this->session->set_flashdata('danger', array('message' => 'Something went wrong. Please try again.'));
	    			redirect('Password_Resets/');
	    		}
	    	} else {
	    		$this->session->set_flashdata('danger', array('message' => 'Email is not exist.'));
	    		redirect('Password_Resets');
	    	}
	    }
    }

    public function reset_pass_form($token) {
    	$data['token'] = $token;
    	$this->load->view('reset_password_form', $data);

    }

    public function change_pass() {
    	if ($this->input->post('changePassword')) {
    		$this->form_validation->set_rules('password', 'New password', 'required');
	        $this->form_validation->set_rules('confirm_password', 'Password', 'required|matches[password]');

	        $token = $this->input->post('token');
	    	$password = $this->input->post('password');
	    	$confirmPassword = $this->input->post('confirm_password');

	        if ($this->form_validation->run() == true) {

	    		$con['conditions'] = array(
	    			'token' => $token
	    		);
	    		$con['returnType'] = 'single';

	    		$token = $this->Common_Model->getRows($con, 'hr_password_resets');
	    		if ($token) {
	    			$userData = array(
	    				'password' => md5($password)
	    			);
	    			$condition = array(
	    				'email' => $token['email']
	    			);

	    			$update = $this->Common_Model->update($userData, $condition, 'hr_users');
	    			if ($update) {
	    				$this->Common_Model->delete($condition, 'hr_password_resets');
	    				$this->session->set_flashdata('success', array('message' => 'Password changed successfully. '));
	    				redirect('Login/login_form');
	    			} else {
	    				$this->session->set_flashdata('danger', array('message' => 'Something went wrong. Please try again.'));
	    				redirect('Password_Resets/reset_pass_form/' . $token);
	    			}


	    		} else {
	    			$this->session->set_flashdata('danger', array('message' => 'Token miss match. Please try again.'));
	    			redirect('Login/login_form');
	    		}	
	    	} else {
	    		$data['token'] = $token;
	    		$this->load->view('reset_password_form', $data);
	    	}
	    } else {
	    		redirect('Login/login_form');
	    }
	}


   
} 

?>