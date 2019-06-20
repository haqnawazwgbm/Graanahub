<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site_Jobs extends General_Functions {

     function __construct() {
        parent::__construct();
    }

     // Get all jobs
    public function list_jobs()
    {
        $con['selection'] = "hr_jobs.*, hr_departments.name as department";
        $con['conditions'] = array(
            'hr_jobs.status' => 1
        );
        $con['innerJoin'] = array(array(
            'table' => 'hr_departments',
            'condition' =>'hr_departments.id = hr_jobs.department_id',
            'joinType' => 'left'
        ));
        $con['orderBy'] = "hr_jobs.created desc";
        $data['jobs'] = $this->get_jobs($con);
        $this->load->view('jobs/site_jobs', $data);
    }

    // Get specific job 
    public function details($id)
    {
        $con['selection'] = "hr_jobs.*, hr_jobs.id as job_id, hr_departments.name as department, hr_experience.*, hr_experience.name as experience, hr_domicile.*, hr_domicile.name as domicile";
        $con['conditions'] = array(
            'hr_jobs.status' => 1,
            'hr_jobs.id' => $id
        );
        $con['innerJoin'] = array(array(
            'table' => 'hr_departments',
            'condition' =>'hr_departments.id = hr_jobs.department_id',
            'joinType' => 'left'
        ),array(
            'table' => 'hr_experience',
            'condition' =>'hr_experience.id = hr_jobs.experience_id',
            'joinType' => 'left'
        ),array(
            'table' => 'hr_domicile',
            'condition' =>'hr_domicile.id = hr_jobs.domicile_id',
            'joinType' => 'left'
        ));
        $con['returnType'] = 'single';
        $data['job'] = $this->get_jobs($con);
        $this->load->view('jobs/site_job_details', $data);
    }

    public function apply() {
        if ($this->input->post('submitUser')) {
                $this->form_validation->set_rules('name', 'name', 'required');
                $this->form_validation->set_rules('email', 'email', 'required');
                $this->form_validation->set_rules('phone_no', 'phone_no', 'required');
                $this->form_validation->set_rules('message', 'message', 'required');


                $userData = array(
                    'job_id' => strip_tags($this->input->post('job_id')),
                    'name' => strip_tags($this->input->post('name')),
                    'email' => strip_tags($this->input->post('email')),
                    'phone_no' => strip_tags($this->input->post('phone_no')),
                    'education' => strip_tags($this->input->post('education')),
                    'experience_id' => strip_tags($this->input->post('experience_id')),
                    'domicile_id' => strip_tags($this->input->post('domicile_id')),
                    'message' => strip_tags($this->input->post('message')),
                    'application_status' => 'new',
                    'apply_date' => date('Y-m-d'),
                    'status' => 1
                ); 

                if (!empty($_FILES['userfile']['name'])) {
                    $upload_picture = $this->upload_single_file();
                    if (! $upload_picture) {
                        $this->session->set_flashdata('warning', array('message' => 'Something went wrong. File not uploaded successfully.'));
                        redirect('Site_Jobs/list_jobs');
                    }
                    $userData['file'] = $upload_picture;
                } else {
                    $this->session->set_flashdata('warning', array('message' => 'Something went wrong. Please make sure attachment are required.'));
                        redirect('Site_Jobs/list_jobs');
                }

                if ($this->form_validation->run() == true) {

                    $id = $this->Common_Model->insert($userData, 'hr_job_applications');
                     $this->session->set_flashdata('success', array('message' => 'Application submited successfully.'));
                    redirect('Site_Jobs/list_jobs');
                } else {
                    $this->session->set_flashdata('danger', array('message' => 'Something went wrong. Please make sure all fields are mandatory'));
                    redirect('Site_Jobs/list_jobs');
                }

        }
    }
       public function store() {
        if ($this->input->post('submitUser')) {
            print_r($_POST); exit;
                $this->form_validation->set_rules('title', 'title', 'required');
                $this->form_validation->set_rules('department_id', 'department', 'required');
                $this->form_validation->set_rules('location', 'location', 'required');
                $this->form_validation->set_rules('vacancies', 'vacancies', 'required');
                $this->form_validation->set_rules('experience', 'experience', 'required');
                $this->form_validation->set_rules('age', 'age', 'required');
                $this->form_validation->set_rules('vacancies', 'vacancies', 'required');
                $this->form_validation->set_rules('salary_from', 'salary_from', 'required');
                $this->form_validation->set_rules('salary_to', 'salary_to', 'required');
                $this->form_validation->set_rules('job_type', 'job_type', 'required');
                $this->form_validation->set_rules('job_status', 'job_status', 'required');
                $this->form_validation->set_rules('start_date', 'start_date', 'required');
                $this->form_validation->set_rules('expire_date', 'expire_date', 'required');
                $this->form_validation->set_rules('description', 'description', 'required');
              
        

                $userData = array(
                    'title' => strip_tags($this->input->post('title')),
                    'department_id' => strip_tags($this->input->post('department_id')),
                    'location' => strip_tags($this->input->post('location')),
                    'vacancies' => strip_tags($this->input->post('vacancies')),
                    'experience' => strip_tags($this->input->post('experience')),
                    'age' => strip_tags($this->input->post('age')),
                    'salary_from' => strip_tags($this->input->post('salary_from')),
                    'salary_to' => strip_tags($this->input->post('salary_to')),
                    'job_type' => strip_tags($this->input->post('job_type')),
                    'job_status' => strip_tags($this->input->post('job_status')),
                    'start_date' => $this->input->post('start_date'),
                    'expire_date' => $this->input->post('expire_date'),
                    'description' => $this->input->post('description'),
                    'status' => 1
                ); 

                if ($this->form_validation->run() == true) {

                    $id = $this->Common_Model->insert($userData, 'hr_jobs');
                     $this->session->set_flashdata('success', array('message' => 'Record created successfully.'));
                    redirect('Jobs/list_jobs');
                } else {
                    //load the view
                    $this->load->view('jobs/job_form');
                }

        }
    }

    public function edit_form($id) {
        $con['selection'] = "hr_jobs.*, hr_jobs.id as job_id, hr_departments.id, hr_departments.name";
        $con['conditions'] = array(
            'hr_jobs.id' => $id
        );
        $con['innerJoin'] = array(array(
            'table' => 'hr_departments',
            'condition' =>'hr_departments.id = hr_jobs.department_id',
            'joinType' => 'left'
        ));
        $con['returnType'] = 'single';
        $data['job'] = $this->Common_Model->getRows($con, 'hr_jobs');
        $view = $this->load->view('jobs/edit_job_form', $data, true);

        $this->output->set_content_type('application/json')
            ->set_output(json_encode($view));
    }


    public function edit() {
        if ($this->input->post('submitEditUser')) {
                $this->form_validation->set_rules('title', 'title', 'required');
                $this->form_validation->set_rules('department_id', 'department', 'required');
                $this->form_validation->set_rules('location', 'location', 'required');
                $this->form_validation->set_rules('vacancies', 'vacancies', 'required');
                $this->form_validation->set_rules('experience', 'experience', 'required');
                $this->form_validation->set_rules('age', 'age', 'required');
                $this->form_validation->set_rules('vacancies', 'vacancies', 'required');
                $this->form_validation->set_rules('salary_from', 'salary_from', 'required');
                $this->form_validation->set_rules('salary_to', 'salary_to', 'required');
                $this->form_validation->set_rules('job_type', 'job_type', 'required');
                $this->form_validation->set_rules('job_status', 'job_status', 'required');
                $this->form_validation->set_rules('start_date', 'start_date', 'required');
                $this->form_validation->set_rules('expire_date', 'expire_date', 'required');
                $this->form_validation->set_rules('description', 'description', 'required');
              
        

                $userData = array(
                    'title' => strip_tags($this->input->post('title')),
                    'department_id' => strip_tags($this->input->post('department_id')),
                    'location' => strip_tags($this->input->post('location')),
                    'vacancies' => strip_tags($this->input->post('vacancies')),
                    'experience' => strip_tags($this->input->post('experience')),
                    'age' => strip_tags($this->input->post('age')),
                    'salary_from' => strip_tags($this->input->post('salary_from')),
                    'salary_to' => strip_tags($this->input->post('salary_to')),
                    'job_type' => strip_tags($this->input->post('job_type')),
                    'job_status' => strip_tags($this->input->post('job_status')),
                    'start_date' => $this->input->post('start_date'),
                    'expire_date' => $this->input->post('expire_date'),
                    'description' => $this->input->post('description'),
                    'status' => 1
                ); 

                $id = $this->input->post('id'); 

                 $condition = array('id' => $id);
                 if ($this->form_validation->run() == true) {

                    $update = $this->Common_Model->update($userData, $condition, 'hr_jobs');
                    if($update){
                        $this->session->set_flashdata('success', array('message' => 'Record updated successfully.'));
                        redirect('Jobs/list_jobs');
                    }else{
                        $this->session->set_flashdata('warning', array('message' => 'Something went wrong. Please try again.'));
                        redirect('Jobs/list_jobs');
                    }
                } else {
                    $this->session->set_flashdata('warning', array('message' => 'Something went wrong. Please try again.'));
                    redirect('Jobs/list_jobs');
                }
        }
    }

    public function delete() {
        $id = $this->input->post('id');
        $condition = array('id' => $id);
        $result = $this->Common_Model->delete($condition, 'hr_jobs');
        if ($result) {
            $this->session->set_flashdata('success', array('message' => 'Record deleted successfully.'));
        } else {
            $this->session->set_flashdata('danger', array('message' => 'Designation user are exist can not delete it.'));
        }
        
        redirect('Jobs/list_jobs');
    }

}