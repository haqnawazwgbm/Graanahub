<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Code_Conducts extends Check_Logged {
    private $upload_path = array();

    function __construct() {
        parent::__construct();
    }

     // Get all policies
    public function list_code_conducts()
    {
        $data['code_conducts'] = $this->get_code_conducts();
        $this->load->view('code_conducts/code_conducts', $data);
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

                    $id = $this->Common_Model->insert($userData, 'hr_code_conducts');
                    if (!empty($_FILES['userfile']['name'][0])) {
                            $this->upload_path = $this->upload_multiple_files();
                            $this->store_user_pictures($id);
                    }
                     $this->session->set_flashdata('success', array('message' => 'Record created successfully.'));
                    redirect('Code_Conducts/list_code_conducts');
                } else {
                    //load the view
                    $this->load->view('code_conducts/form');
                }

        }
    }

    public function edit_form($id) {
        $con['conditions'] = array(
            'hr_code_conducts.id' => $id
        );
        $con['returnType'] = 'single';
        $data['code_conduct'] = $this->Common_Model->getRows($con, 'hr_code_conducts');

        $picture_con['conditions'] = array(
            'hr_code_conduct_pictures.code_conduct_id' => $id
        );
        $data['pictures'] = $this->Common_Model->getRows($picture_con, 'hr_code_conduct_pictures');
        $view = $this->load->view('code_conducts/edit_form', $data, true);

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

                    $update = $this->Common_Model->update($userData, $condition, 'hr_code_conducts');
                    if($update){
                        if (!empty($_FILES['userfile']['name'][0])) {
                            $this->upload_path = $this->upload_multiple_files();
                            $this->store_user_pictures($id);
                        }
                        $this->session->set_flashdata('success', array('message' => 'Record updated successfully.'));
                        redirect('Code_Conducts/list_code_conducts');
                    }else{
                        $this->session->set_flashdata('warning', array('message' => 'Something went wrong. Please try again.'));
                        redirect('Code_Conducts/list_code_conducts');
                    }
                } else {
                    $this->session->set_flashdata('warning', array('message' => 'Something went wrong. Please try again.'));
                    redirect('Code_Conducts/list_code_conducts');
                }
        }
    }

    // Get specific code of conduct
    public function code_conduct($id)
    {
        $con['conditions'] = array(
            'id' => $id
        );
        $con['returnType'] = 'single';  
        $data['code_conduct'] = $this->get_policies($con);

        $picture_con['conditions'] = array(
            'code_conduct_id' => $id
        );
        $pictures = $this->Common_Model->getRows($picture_con, 'hr_code_conduct_pictures');
        $data['pictures'] = $pictures ? $pictures : array();
        $this->load->view('code_conducts/template', $data);
    }

    public function store_user_pictures($id) {
        if (empty($this->upload_path)) {
            $this->session->set_flashdata('warning', array('message' => 'Something went wrong. Images not uploaded successfully.'));
        }
        $condition = array('code_conduct_id' => $id);
        $this->Common_Model->delete($condition, 'hr_code_conduct_pictures');
            foreach ($this->upload_path as $key => $value) {
                $userData = array(
                    'code_conduct_id' => $id,
                    'photo' => $value
                );
           $this->Common_Model->insert($userData, 'hr_code_conduct_pictures');
        }
        return true;
    }

    public function delete() {
        $id = $this->input->post('id');
        $condition = array('id' => $id);
        $result = $this->Common_Model->delete($condition, 'hr_code_conducts');
        if ($result) {
            $this->session->set_flashdata('success', array('message' => 'Record deleted successfully.'));
        } else {
            $this->session->set_flashdata('danger', array('message' => 'Code of conduct record can not deleted.'));
        }
        
        redirect('Code_Conducts/list_code_conducts');
    }

}