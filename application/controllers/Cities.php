<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cities extends Check_Logged {

     function __construct() {
        parent::__construct();
    }

     // Get all cities
    public function list_cities()
    {
        $data['cities'] = $this->get_cities();
        $this->load->view('cities/cities', $data);
    }

       public function store() {
        if ($this->input->post('submitUser')) {
                $this->form_validation->set_rules('name', 'name', 'required');
        
          

                $userData = array(
                    'name' => strip_tags($this->input->post('name')),
                    'status' => 1
                ); 

                if ($this->form_validation->run() == true) {

                    $id = $this->Common_Model->insert($userData, 'hr_cities');
                     $this->session->set_flashdata('success', array('message' => 'Record created successfully.'));
                    redirect('Cities/list_cities');
                } else {
                    //load the view
                    $this->load->view('cities/city_form');
                }

        }
    }

    public function edit_form($id) {
        $con['conditions'] = array(
            'hr_cities.id' => $id
        );
        $con['returnType'] = 'single';
        $data['city'] = $this->Common_Model->getRows($con, 'hr_cities');
        $view = $this->load->view('cities/edit_city_form', $data, true);

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

                    $update = $this->Common_Model->update($userData, $condition, 'hr_cities');
                    if($update){
                        $this->session->set_flashdata('success', array('message' => 'Record updated successfully.'));
                        redirect('Cities/list_cities');
                    }else{
                        $this->session->set_flashdata('warning', array('message' => 'Something went wrong. Please try again.'));
                        redirect('Cities/list_cities');
                    }
                } else {
                    $this->session->set_flashdata('warning', array('message' => 'Something went wrong. Please try again.'));
                    redirect('Cities/list_cities');
                }
        }
    }

    public function delete() {
        $id = $this->input->post('id');
        $condition = array('id' => $id);
        $result = $this->Common_Model->delete($condition, 'hr_cities');
        if ($result) {
            $this->session->set_flashdata('success', array('message' => 'Record deleted successfully.'));
        } else {
            $this->session->set_flashdata('danger', array('message' => 'City user are exist can not delete it.'));
        }
        
        redirect('Cities/list_cities');
    }

}