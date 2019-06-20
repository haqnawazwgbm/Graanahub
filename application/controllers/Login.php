<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends General_Functions {

	 function __construct() {
        parent::__construct();

    }

    public function login_form() {
    	$this->load->view('login');
    }

    public function registration_form() {
    	$this->load->view('site/registration.php');
    }

    public function register() {
        if ($this->input->post('submitRegistration')) {
                
            
                $this->form_validation->set_rules('email', 'Email', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required|is_unique[wh_users.email]');
                $this->form_validation->set_rules('full_name', 'User name', 'required');
                $this->form_validation->set_rules('password', 'Password', 'required');
	            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
               
                $userData = array(
                    'email' => strip_tags($this->input->post('email')),
                    'full_name' => strip_tags($this->input->post('full_name')),
                    'password' => md5(strip_tags($this->input->post('password'))),
                    'status' => 1
                ); 

                if ($this->form_validation->run() == true) {
                    $id = $this->Common_Model->insert($userData, 'wh_users');
                    if($id){

                        $result = $this->user_unactive();
                        if ($result) {
                            $this->session->set_flashdata('success', array('message' => 'Registration successfull. Please check your email for account activiations.'));
                            redirect('Site_Login/login_form');
                        } else {
                            $redirect = 'Site_Login/registration_form';
                            $this->error($redirect);
                        }
                        
                    }else{
                        $redirect = 'Site_Login/registration_form';
                        $this->error($redirect);
                        
                    }
                } else {
 
                    $this->load->view('site/registration');
                }

        }
    }

    public function login() {
        
		if($this->input->post('login')){
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'password', 'required');
            if ($this->form_validation->run() == true) {
                $con['returnType'] = 'single';
                $con['conditions'] = array(
                    'email'=>strip_tags($this->input->post('email')),
                    'password' => md5(strip_tags($this->input->post('password'))),
                    'status' => '1'
                );
                $checkLogin = $this->Common_Model->getRows($con, 'hr_users');
                if($checkLogin){
                    $this->session->set_userdata('isUserLoggedIn',TRUE);
                    $this->session->set_userdata('user',$checkLogin);
                    $user = $this->session->userdata('user');
                    if ($user['role_id'] == 4) {
                        redirect('Dashboard/employee');
                    } else {
                        redirect('Dashboard/index');
                    }
                    
                }else{
                	$this->session->set_flashdata('danger', array('message' => 'Invalid login credentials. Please try again.'));
                    redirect('Login/login_form');
                }
            } else {

            	$this->load->view('login');
            }
        }
	}

/*
     * User logout
     */
    public function logout(){
        $this->session->unset_userdata('isUserLoggedIn');
        $this->session->unset_userdata('user');
        $this->session->sess_destroy();
        redirect('Dashboard/');
    }

    /* Activate user account
    */
    public function activate_account($token) {
        $con['returnType'] = 'single';
        $con['conditions'] = array(
            'token' => $token
        );
        $result = $this->Common_Model->getRows($con, 'wh_user_activations');
        if ($result) {

            $this->Common_Model->delete($con['conditions'], 'wh_user_activations');
            $this->session->set_flashdata('success', array('message' => 'Activated successfully. Please login.'));
            redirect('Site_Login/login_form');
        } else {
            $redirect = 'Site_Login/login_form';
            $this->error($redirect);
        }
    }

    /* 
    *  keep user user unactive
    */
    public function user_unactive() {
        if ($this->input->post('submitRegistration')) {
            $userData = array(
                'email' => $this->input->post('email'),
                'token' => md5($this->input->post('email'))
            );

            $this->Common_Model->insert($userData, 'wh_user_activations');

            $userData['message'] = 'Click the below link to activate your account. <br /><a href="' . base_url() . 'Site_Login/activate_account/' . $userData['token'] . '">Activate</a>';
            $userData['subject'] = 'Account activation';

            $result = $this->sendMail($userData);
            if ($result) {
                return true;
            } else {
                return false;
            }
        }
    }

}