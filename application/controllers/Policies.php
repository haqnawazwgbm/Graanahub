<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Policies extends Check_Logged {
    private $upload_path = array();

    function __construct() {
        parent::__construct();
    }

     // Get all policies
    public function list_policies()
    {
        $data['policies'] = $this->get_policies();
        $this->load->view('policies/policies', $data);
    }

       public function store() {
        if ($this->input->post('submitUser')) {
                $this->form_validation->set_rules('name', 'name', 'required');
        
          

                $userData = array(
                    'name' => strip_tags($this->input->post('name')),
                    'description' => html_purify($this->input->post('description')),
                    'status' => 1
                ); 

                if ($this->form_validation->run() == true) {

                    $id = $this->Common_Model->insert($userData, 'hr_policies');
                    if (!empty($_FILES['userfile']['name'][0])) {
                            $this->upload_path = $this->upload_multiple_files();
                            $this->store_user_pictures($id);
                    }
                     $this->session->set_flashdata('success', array('message' => 'Record created successfully.'));
                    redirect('Policies/list_policies');
                } else {
                    //load the view
                    $this->load->view('policies/policies_form');
                }

        }
    }

    public function edit_form($id) {
        $con['conditions'] = array(
            'hr_policies.id' => $id
        );
        $con['returnType'] = 'single';
        $data['policy'] = $this->Common_Model->getRows($con, 'hr_policies');

        $picture_con['conditions'] = array(
            'hr_policy_pictures.policy_id' => $id
        );
        $data['pictures'] = $this->Common_Model->getRows($picture_con, 'hr_policy_pictures');
        $view = $this->load->view('policies/edit_policies_form', $data, true);

        $this->output->set_content_type('application/json')
            ->set_output(json_encode($view));
    }


    public function edit() {
        if ($this->input->post('submitEditUser')) {
                $this->form_validation->set_rules('name', 'name', 'required');


                $id = $this->input->post('id');
                $userData = array(
                    'name' => strip_tags($this->input->post('name')),
                    'description' => html_purify($this->input->post('description')),
                    'status' => 1
                ); 

                 $condition = array('id' => $id);
                 if ($this->form_validation->run() == true) {

                    $update = $this->Common_Model->update($userData, $condition, 'hr_policies');
                    if($update){
                        if (!empty($_FILES['userfile']['name'][0])) {
                            $this->upload_path = $this->upload_multiple_files();
                            $this->store_user_pictures($id);
                        }
                        $this->session->set_flashdata('success', array('message' => 'Record updated successfully.'));
                        redirect('Policies/list_policies');
                    }else{
                        $this->session->set_flashdata('warning', array('message' => 'Something went wrong. Please try again.'));
                        redirect('Policies/list_policies');
                    }
                } else {
                    $this->session->set_flashdata('warning', array('message' => 'Something went wrong. Please try again.'));
                    redirect('Policies/list_policies');
                }
        }
    }

    // Get specific policy
    public function policy($id)
    {
        $con['conditions'] = array(
            'id' => $id
        );
        $con['returnType'] = 'single';  
        $data['policy'] = $this->get_policies($con);

        $picture_con['conditions'] = array(
            'policy_id' => $id
        );
        $pictures = $this->Common_Model->getRows($picture_con, 'hr_policy_pictures');
        $data['pictures'] = $pictures ? $pictures : array();
        $this->load->view('policies/policy_template', $data);
    }

    public function store_user_pictures($id) {
        if (empty($this->upload_path)) {
            $this->session->set_flashdata('warning', array('message' => 'Something went wrong. Images not uploaded successfully.'));
        }
        $condition = array('policy_id' => $id);
        $this->Common_Model->delete($condition, 'hr_policy_pictures');
            foreach ($this->upload_path as $key => $value) {
                $userData = array(
                    'policy_id' => $id,
                    'photo' => $value
                );
           $this->Common_Model->insert($userData, 'hr_policy_pictures');
        }
        return true;
    }

    public function delete() {
        $id = $this->input->post('id');
        $condition = array('id' => $id);
        $result = $this->Common_Model->delete($condition, 'hr_policies');
        if ($result) {
            $this->session->set_flashdata('success', array('message' => 'Record deleted successfully.'));
        } else {
            $this->session->set_flashdata('danger', array('message' => 'Policy record can not deleted.'));
        }
        
        redirect('Policies/list_policies');
    }

}