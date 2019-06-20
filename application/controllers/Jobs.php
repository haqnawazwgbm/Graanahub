<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobs extends Check_Logged {

     function __construct() {
        parent::__construct();
        $this->user = $this->session->userdata('user');
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
        $data['jobs'] = $this->get_jobs($con);

        
        $this->load->view('jobs/jobs', $data);
    }


    // Get candidates applications.
    public function list_candidates($job_id, $application_status = 'new') {
        if ($application_status == 'new') {
            $con['selection'] = "hr_jobs.*, hr_jobs.id as job_id, hr_job_applications.*, hr_job_applications.id as application_id, hr_experience.name as experience, hr_domicile.name as domicile";
             $con['conditions'] = array(
                'hr_job_applications.application_status' => $application_status 
            );
            $con['innerJoin'] = array(array(
                'table' => 'hr_jobs',
                'condition' =>'hr_jobs.id = hr_job_applications.job_id and hr_jobs.experience_id = hr_job_applications.experience_id and hr_jobs.domicile_id = hr_job_applications.domicile_id and hr_jobs.education = hr_job_applications.education',
                'joinType' => 'inner'
            ),array(
                'table' => 'hr_domicile',
                'condition' =>'hr_domicile.id = hr_job_applications.domicile_id',
                'joinType' => 'inner'
            ),array(
                'table' => 'hr_experience',
                'condition' =>'hr_experience.id = hr_job_applications.experience_id',
                'joinType' => 'inner'
            ));
        } else {
            $con['selection'] = "hr_jobs.*, hr_jobs.id as job_id, hr_job_applications.*, hr_job_applications.id as application_id";
             $con['conditions'] = array(
                'hr_job_applications.application_status' => $application_status 
            );
            
            $con['innerJoin'] = array(array(
                'table' => 'hr_jobs',
                'condition' =>'hr_jobs.id = hr_job_applications.job_id',
                'joinType' => 'inner'
            ));
        }
        if ($job_id) {
            $con['conditions']['hr_jobs.id'] = $job_id;
        }
        $data['applications'] = $this->Common_Model->getRows($con, 'hr_job_applications');

        
        $this->load->view('jobs/candidate_applications', $data);
    }


    // Get not eligible applications.
    public function not_eligible() {
        $con['selection'] = "hr_jobs.*, hr_jobs.id as job_id, hr_job_applications.*, hr_job_applications.id as application_id, hr_experience.name as experience, hr_domicile.name as domicile";
             $con['conditions'] = array(
                'hr_job_applications.application_status' => 'new' 
            );
            $con['innerJoin'] = array(array(
                'table' => 'hr_jobs',
                'condition' =>'hr_jobs.id = hr_job_applications.job_id and hr_jobs.experience_id != hr_job_applications.experience_id and hr_jobs.domicile_id != hr_job_applications.domicile_id and hr_jobs.education != hr_job_applications.education',
                'joinType' => 'inner'
            ),array(
                'table' => 'hr_domicile',
                'condition' =>'hr_domicile.id = hr_job_applications.domicile_id',
                'joinType' => 'inner'
            ),array(
                'table' => 'hr_experience',
                'condition' =>'hr_experience.id = hr_job_applications.experience_id',
                'joinType' => 'inner'
            ));
            $data['applications'] = $this->Common_Model->getRows($con, 'hr_job_applications');
            $this->load->view('jobs/candidate_applications', $data);
    }
    // Get interviewes.
    public function interviews() {
        $con['selection'] = "hr_jobs.*, hr_jobs.id as job_id, hr_job_interviews.*, hr_job_interviews.id as interview_id, hr_departments.name as department";
        $con['innerJoin'] = array(array(
            'table' => 'hr_jobs',
            'condition' =>'hr_jobs.id = hr_job_interviews.job_id',
            'joinType' => 'inner'
        ),array(
            'table' => 'hr_departments',
            'condition' =>'hr_jobs.department_id = hr_departments.id',
            'joinType' => 'inner'
        ));
        $data['interviews'] = $this->Common_Model->getRows($con, 'hr_job_interviews');

        $this->load->view('jobs/interviews', $data);
    }

       public function store() {
        if ($this->input->post('submitUser')) {
                $this->form_validation->set_rules('title', 'title', 'required');
                $this->form_validation->set_rules('department_id', 'department', 'required');
                $this->form_validation->set_rules('location', 'location', 'required');
                $this->form_validation->set_rules('vacancies', 'vacancies', 'required');
                $this->form_validation->set_rules('age', 'age', 'required');
                $this->form_validation->set_rules('vacancies', 'vacancies', 'required');
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
                    'experience_id' => strip_tags($this->input->post('experience_id')),
                    'education' => strip_tags($this->input->post('education')),
                    'domicile_id' => strip_tags($this->input->post('domicile_id')),
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

           public function store_interview() {
        if ($this->input->post('submitUser')) {
                $this->form_validation->set_rules('job_id', 'job_id', 'required');
                $this->form_validation->set_rules('date', 'date', 'required');
                $this->form_validation->set_rules('place', 'place', 'required');
                $this->form_validation->set_rules('time', 'time', 'required');
                $this->form_validation->set_rules('description', 'description', 'required');

                
                $job_id = strip_tags($this->input->post('job_id'));
        

                $userData = array(
                    'job_id' => $job_id,
                    'date' => strip_tags($this->input->post('date')),
                    'place' => strip_tags($this->input->post('place')),
                    'time' => strip_tags($this->input->post('time')),
                    'description' => strip_tags($this->input->post('description')),
                    'user_id' => $this->user['id']
                ); 

                $users = $this->input->post('user_id');
                $applications = $this->input->post('application_id');
                

                if ($this->form_validation->run() == true) {

                    $id = $this->Common_Model->insert($userData, 'hr_job_interviews');
                    foreach ($applications as $application) {
                        $userData = array(
                            'interview_id' => $id,
                            'job_application_id' => $application
                        );
                        $this->Common_Model->insert($userData, 'hr_job_interview_candidates');
                    }
                    foreach ($users as $user) {
                        $userData = array(
                            'interview_id' => $id,
                            'user_id' => $user
                        );
                        $this->Common_Model->insert($userData, 'hr_job_interview_interviewers');
                    }
                     $this->session->set_flashdata('success', array('message' => 'Record created successfully.'));
                    redirect('Jobs/interviews');
                } else {
                    $this->session->set_flashdata('danger', array('message' => 'Something went wrong. Please make sure all fields are quired.'));
                    redirect('Jobs/interviews');
                }

        }
    }

    public function update_apply_status($job_id, $application_id, $apply_status) {
        $userData = array(
            'application_status' => $apply_status
        );
        $condition = array('id' => $application_id);
        $update = $this->Common_Model->update($userData, $condition, 'hr_job_applications');
        if($update){
            if ($apply_status == 'hired') {
                // Get the hired applicant details
                $con['selection'] = 'hr_job_applications.*, hr_jobs.department_id';
                $con['conditions'] = array(
                    'hr_job_applications.id' => $application_id
                );
                $con['innerJoin'] = array(array(
                    'table' => 'hr_jobs',
                    'condition' =>'hr_jobs.id = hr_job_applications.job_id',
                    'joinType' => 'left'
                ));
                $con['returnType'] = 'single';
                $application = $this->Common_Model->getRows($con, 'hr_job_applications');

                // Check hired user. If exist then dont store any data.
                $user = $this->check_user($application['email'], $application['phone_no']);
                if (! $user) {
                    $this->session->set_flashdata('warning', array('message' => 'User already hired.'));
                    redirect("Jobs/list_candidates/$job_id/$apply_status");
                }

                $pws = $this->rand_password();
                $userData = array(
                    'name' => $application['name'],
                    'email' => $application['email'],
                    'password' => md5($pws),
                    'mobile_no' => $application['phone_no'],
                    'department_id' => $application['department_id'],
                    'designation_id' => 3,
                    'role_id' => 4,
                    'status' => 1
                );

                // Stored the hired applicant into users table.
                $id = $this->Common_Model->insert($userData, 'hr_users');
                if ($id) {
                    $userData['message'] = 'Below are the login credentials. <br />URL: <a href="' . base_url().'">'.base_url().'</a> <br />Email: '. $userData['email'].'<br />Password: '.$pws;
                    $userData['subject'] = 'Login credentials';
                    $this->sendMail($userData);
                } else {
                    die('error occured');
                }
                
            }
            

            $this->session->set_flashdata('success', array('message' => 'Status updated successfully.'));
            redirect("Jobs/list_candidates/$job_id/$apply_status");
        }else{
        $this->session->set_flashdata('warning', array('message' => 'Something went wrong. Please try again.'));
        redirect("Jobs/list_candidates/$job_id/$apply_status");
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
                $this->form_validation->set_rules('age', 'age', 'required');
                $this->form_validation->set_rules('vacancies', 'vacancies', 'required');
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
                    'experience_id' => strip_tags($this->input->post('experience_id')),
                    'education' => strip_tags($this->input->post('education')),
                    'domicile_id' => strip_tags($this->input->post('domicile_id')),
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

    public function list_applications($id) {
        $dropdown = '';

        if ($id != -1) {
                $con['conditions'] = array(
                'hr_job_applications.job_id' => $id,
                'hr_job_applications.application_status' => 'new'
            );
            $applications = $this->Common_Model->getRows($con, 'hr_job_applications');
            if (! empty($applications)) {
                $dropdown = '<select id="application_id" multiple class="form-control" name="application_id[]">';
                foreach ($applications as $application) :
                    $dropdown = $dropdown .'<option value="'.$application['id'].'">'.ucfirst($application['name']).'</option>';
                endforeach;
                $dropdown = $dropdown . '</select>';
            }
            
        }
        
        
        $this->output->set_content_type('application/json')
            ->set_output(json_encode($dropdown));
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

    public function delete_application() {
        $id = $this->input->post('id');
        $condition = array('id' => $id);
        $result = $this->Common_Model->delete($condition, 'hr_job_applications');
        if ($result) {
            $this->session->set_flashdata('success', array('message' => 'Record deleted successfully.'));
        } else {
            $this->session->set_flashdata('danger', array('message' => 'Designation user are exist can not delete it.'));
        }
        
        redirect('Jobs/list_candidates/0');
    }

    public function send_mail() {
        if ($this->input->post('submitUser')) {
            $userData = array(
                'email' => $this->input->post('mail'),
                'subject' => $this->input->post('subject'),
                'message' => $this->input->post('description')
            );
            $this->sendMail($userData);

            $this->session->set_flashdata('success', array('message' => 'Mail sent successfully.'));
            
            redirect('Jobs/list_candidates/0/new');
        }
        
    }

    public function check_user($email, $phone) {
        $con['conditions'] = array(
            'email' => $email,
            'mobile_no' => $phone
        );
        $con['returnType'] = 'single';
        $user = $this->Common_Model->getRows($con, 'hr_users');
        return $user;
    }
    public function delete_interview() {
        $id = $this->input->post('id');
        $condition = array('id' => $id);
        $result = $this->Common_Model->delete($condition, 'hr_job_interviews');
        if ($result) {
            $this->session->set_flashdata('success', array('message' => 'Record deleted successfully.'));
        } else {
            $this->session->set_flashdata('danger', array('message' => 'Designation user are exist can not delete it.'));
        }
        
        redirect('Jobs/interviews');
    }

}