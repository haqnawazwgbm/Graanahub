<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salaries extends Check_Logged {

     function __construct() {
        parent::__construct();
    }

     // Get all policies
    public function payslip($id)
    {
        $date2 = explode('-', date('Y-m-d'));
        $month = $date2[1];
        $year = $date2[0];
        $con['selection'] = 'hr_users.*, hr_users.id as user_id, hr_designations.name as designation, hr_roles.name as role, hr_departments.name as department, hr_leaves.*, hr_payrolls.*';
        $con['conditions'] = array(
            'hr_payrolls.user_id' => $id,
            'month(hr_payrolls.date)' => $month,
            'year(hr_payrolls.date)' => $year
        );
        $con['innerJoin'] = array(array(
            'table' => 'hr_users',
            'condition' =>'hr_users.id = hr_payrolls.user_id',
            'joinType' => 'left'
        ),array(
            'table' => 'hr_designations',
            'condition' =>'hr_users.designation_id = hr_designations.id',
            'joinType' => 'left'
        ),array(
            'table' => 'hr_roles',
            'condition' =>'hr_users.role_id = hr_roles.id',
            'joinType' => 'left'
        ),array(
            'table' => 'hr_departments',
            'condition' =>'hr_users.department_id = hr_departments.id',
            'joinType' => 'left'
        ),array(
            'table' => 'hr_leaves',
            'condition' =>'hr_users.id = hr_leaves.user_id',
            'joinType' => 'left'
        ));
        $con['returnType'] = 'single';
        $data['user'] = $this->Common_Model->getRows($con, 'hr_payrolls');
        $view = $this->load->view('users/payslip', $data, true);
        $this->output->set_content_type('application/json')
            ->set_output(json_encode($view));
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
        $this->load->view('policies/policy_template', $data);
    }

    public function delete($id) {
        $condition = array('id' => $id);
        $this->Common_Model->delete($condition, 'pms_users');
        $this->session->set_flashdata('success', array('message' => 'Record deleted successfully.'));
        redirect('Users/');
    }

}