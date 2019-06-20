<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Designations extends Check_Logged {

     function __construct() {
        parent::__construct();
    }

     // Get all designations
    public function list_designations()
    {
        $data['designations'] = $this->get_designations();
        $this->load->view('designations/designations', $data);
    }

       public function store() {
        if ($this->input->post('submitUser')) {
                $this->form_validation->set_rules('name', 'name', 'required');
        
          

                $userData = array(
                    'name' => strip_tags($this->input->post('name')),
                    'status' => 1
                ); 

                if ($this->form_validation->run() == true) {

                    $id = $this->Common_Model->insert($userData, 'hr_designations');
                     $this->session->set_flashdata('success', array('message' => 'Record created successfully.'));
                    redirect('Designations/list_designations');
                } else {
                    //load the view
                    $this->load->view('designations/designation_form');
                }

        }
    }

    public function edit_form($id) {
        $con['conditions'] = array(
            'hr_designations.id' => $id
        );
        $con['returnType'] = 'single';
        $data['designation'] = $this->Common_Model->getRows($con, 'hr_designations');
        $view = $this->load->view('designations/edit_designation_form', $data, true);

        $this->output->set_content_type('application/json')
            ->set_output(json_encode($view));
    }


    public function edit() {
        if ($this->input->post('submitEditUser')) {
                $this->form_validation->set_rules('name', 'name', 'required');


                $id = $this->input->post('id');
                $userData = array(
                    'name' => strip_tags($this->input->post('name')),
                    'status' => 1
                ); 

                 $condition = array('id' => $id);
                 if ($this->form_validation->run() == true) {

                    $update = $this->Common_Model->update($userData, $condition, 'hr_designations');
                    if($update){
                        $this->session->set_flashdata('success', array('message' => 'Record updated successfully.'));
                        redirect('Designations/list_designations');
                    }else{
                        $this->session->set_flashdata('warning', array('message' => 'Something went wrong. Please try again.'));
                        redirect('Designations/list_designations');
                    }
                } else {
                    $this->session->set_flashdata('warning', array('message' => 'Something went wrong. Please try again.'));
                    redirect('Designations/list_designations');
                }
        }
    }

    public function delete() {
        $id = $this->input->post('id');
        $condition = array('id' => $id);
        $result = $this->Common_Model->delete($condition, 'hr_designations');
        if ($result) {
            $this->session->set_flashdata('success', array('message' => 'Record deleted successfully.'));
        } else {
            $this->session->set_flashdata('danger', array('message' => 'Designation user are exist can not delete it.'));
        }
        
        redirect('Designations/list_designations');
    }

}