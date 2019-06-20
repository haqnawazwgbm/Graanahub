<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departments extends Check_Logged {

     function __construct() {
        parent::__construct();
    }

     // Get all users
    public function list_departments()
    {
        $data['departments'] = $this->get_departments();
        $this->load->view('departments/departments', $data);
    }

       public function store() {
        if ($this->input->post('submitUser')) {
                $this->form_validation->set_rules('name', 'name', 'required');
        
          

                $userData = array(
                    'name' => strip_tags($this->input->post('name')),
                    'description' => strip_tags($this->input->post('description')),
                    'status' => 1
                ); 

                if ($this->form_validation->run() == true) {

                    $id = $this->Common_Model->insert($userData, 'hr_departments');
                     $this->session->set_flashdata('success', array('message' => 'Record created successfully.'));
                    redirect('Departments/list_departments');
                } else {
                    //load the view
                    $this->load->view('departments/department_form');
                }

        }
    }

    public function edit_form($id) {
        $con['conditions'] = array(
            'hr_departments.id' => $id
        );
        $con['returnType'] = 'single';
        $data['department'] = $this->Common_Model->getRows($con, 'hr_departments');
        $view = $this->load->view('departments/edit_department_form', $data, true);

        $this->output->set_content_type('application/json')
            ->set_output(json_encode($view));
    }


    public function edit() {
        if ($this->input->post('submitEditUser')) {
                $this->form_validation->set_rules('name', 'name', 'required');


                $id = $this->input->post('id');
                $userData = array(
                    'name' => strip_tags($this->input->post('name')),
                    'description' => strip_tags($this->input->post('description')),
                    'status' => 1
                ); 

                 $condition = array('id' => $id);
                 if ($this->form_validation->run() == true) {

                    $update = $this->Common_Model->update($userData, $condition, 'hr_departments');
                    if($update){
                        $this->session->set_flashdata('success', array('message' => 'Record updated successfully.'));
                        redirect('Departments/list_departments');
                    }else{
                        $this->session->set_flashdata('warning', array('message' => 'Something went wrong. Please try again.'));
                        redirect('Departments/list_departments');
                    }
                } else {
                    $this->session->set_flashdata('warning', array('message' => 'Something went wrong. Please try again.'));
                    redirect('Departments/list_departments');
                }
        }
    }

    public function delete() {
        $id = $this->input->post('id');
        $condition = array('id' => $id);
        $result = $this->Common_Model->delete($condition, 'hr_departments');
        if ($result) {
            $this->session->set_flashdata('success', array('message' => 'Record deleted successfully.'));
        } else {
            $this->session->set_flashdata('danger', array('message' => 'Department user are exist can not delete it.'));
        }
        
        redirect('Departments/list_departments');
    }

}