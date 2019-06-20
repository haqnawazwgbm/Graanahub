<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Check_Logged {
    private $upload_path = array();

     function __construct() {
        parent::__construct();
        $this->user = $this->session->userdata('user');
    }

     // Get all users
    public function list_users()
    {
        $con['selection'] = 'hr_users.*, hr_users.id as user_id, hr_designations.name as designation, hr_roles.name as role, hr_departments.name as department';
        $con['conditions'] = array(
            'hr_users.status' => 1,
            'hr_users.id !=' => $this->user['id']
        );
        $con['innerJoin'] = array(array(
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
        ));
        $data['users'] = $this->get_users($con);
        $data['heading'] = 'Employees';
        if ($this->user['role_id'] == 2) {
            $this->load->view('users/manager_users', $data);
        } else {
            $this->load->view('users/users', $data);
        }
        
    }

    // Get manager users
    public function list_manager_users() {
        $con['selection'] = 'hr_users.*, hr_users.id as user_id, hr_designations.name as designation, hr_roles.name as role, hr_departments.name as department';
        $con['conditions'] = array(
            'hr_users.status' => 1,
            'hr_users.id !=' => $this->user['id'],
            'hr_users.department_id' => $this->user['department_id']
        );
        $con['innerJoin'] = array(array(
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
            'joinType' => 'inner'
        ));
        $data['users'] = $this->get_users($con);
        $data['heading'] = 'Employees';
        $this->load->view('users/manager_users', $data);
    }

     // Get all team wise users
    public function list_team($id)
    {
        $con['selection'] = 'hr_users.*, hr_users.id as user_id, hr_designations.name as designation, hr_roles.name as role, hr_departments.name as department';
        $con['conditions'] = array(
            'hr_users.department_id' => $id,
            'hr_users.status' => 1
        );
        $con['innerJoin'] = array(array(
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
        ));
        $data['users'] = $this->get_users($con);
        $data['heading'] = 'Employees';
        $this->load->view('users/users', $data);
    }

     // Get all managers
    public function list_managers()
    {
        $con['selection'] = 'hr_users.*, hr_users.id as user_id, hr_designations.name as designation, hr_roles.name as role, hr_departments.name as department';
        $con['conditions'] = array(
            'hr_users.role_id' => 2,
            'hr_users.status' => 1
        );
        $con['innerJoin'] = array(array(
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
        ));
        $data['users'] = $this->get_users($con);
        $data['heading'] = 'Managers';
        $this->load->view('users/users', $data);
    }

       public function store() {
        if ($this->input->post('submitUser')) {
                $this->form_validation->set_rules('code', 'Employee code', 'required');
                $this->form_validation->set_rules('name', 'name', 'required');
                $this->form_validation->set_rules('father_name', 'Father name', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required');
                $this->form_validation->set_rules('password', 'Password', 'required');
                $this->form_validation->set_rules('martial_status', 'Martial status', 'required');
                $this->form_validation->set_rules('gender', 'Gender', 'required');
                $this->form_validation->set_rules('designation_id', 'Manager', 'required');
                $this->form_validation->set_rules('department_id', 'Department', 'required');

                $userfiles = $_FILES['userfile'];


                $id = $this->input->post('id');
                if (!empty($_FILES['userpicture']['name'])) {
                    $_FILES['userfile'] = $_FILES['userpicture'];
                    $upload_path = $this->upload_picture();
                } else {
                    $photo_path = 'user.jpg';
                }

                $_FILES['userfile'] = $userfiles;

                $userData = array(
                    'code' => strip_tags($this->input->post('code')),
                    'name' => strip_tags($this->input->post('name')),
                    'father_name' => strip_tags($this->input->post('father_name')),
                    'email' => strip_tags($this->input->post('email')),
                    'password' => strip_tags(md5($this->input->post('password'))),
                    'mobile_no' => strip_tags($this->input->post('mobile_no')),
                    'dob' => strip_tags($this->input->post('dob')),
                    'bank_account_no' => strip_tags($this->input->post('bank_account_no')),
                    'gender' => strip_tags($this->input->post('gender')),
                    'address' => strip_tags($this->input->post('address')),
                    'city' => strip_tags($this->input->post('city')),
                    'cnic' => strip_tags($this->input->post('cnic')),
                    'martial_status' => strip_tags($this->input->post('martial_status')),
                    'designation_id' => strip_tags($this->input->post('designation_id')),
                    'department_id' => strip_tags($this->input->post('department_id')),
                    'joining_date' => strip_tags($this->input->post('joining_date')),
                    'ice_no' => strip_tags($this->input->post('ice_no')),
                    'ntn_no' => strip_tags($this->input->post('ntn_no')),
                    'role_id' => strip_tags($this->input->post('role_id')),
                    'in_probation' => $this->input->post('in_probation') == 1 ? 1 : 0,
                    'photo' => $photo_path,
                    'status' => 1
                ); 

                if ($this->form_validation->run() == true) {

                    $id = $this->Common_Model->insert($userData, 'hr_users');
                    if ($id) {
                        $this->Common_Model->insert(array('user_id' => $id), 'hr_salaries');
                        $this->update_salaries($id);
                        $this->Common_Model->insert(array('user_id' => $id), 'hr_leaves');
                        $this->update_leaves($id);
                        $this->Common_Model->insert(array('user_id' => $id), 'hr_educations');
                        $this->update_educations($id);
                        $this->store_dependants($id);
                        if (!empty($_FILES['userfile']['name'][0])) {
                            $this->upload_path = $this->upload_multiple_files();
                            $this->store_user_pictures($id);
                        }
                        
                        $userData['message'] = 'Below are the login credentials. <br />URL: <a href="' . base_url().'">'.base_url().'</a> <br />Email: '. $userData['email'].'<br />Password: '.$_POST['password'];
                        $userData['subject'] = 'Login credentials';
                        $this->sendMail($userData);
                    }

                    $this->session->set_flashdata('success', array('message' => 'Record created successfully.'));
                    redirect('Users/list_users');
                } else {
                    //load the view
                    $this->load->view('users/user_form');
                }

        }
    }


    public function edit_form($id) {
        $con['selection'] = 'hr_users.*, hr_users.id as user_id, hr_designations.name as designation, hr_roles.name as role, hr_departments.name as department';
        $con['conditions'] = array(
            'hr_users.id' => $id
        );
        $con['innerJoin'] = array(array(
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
        ));
        $con['returnType'] = 'single';
        $data['user'] = $this->Common_Model->getRows($con, 'hr_users');
        $salary_con['conditions'] = array(
            'user_id' => $id
        );
        $salary_con['returnType'] = 'single';
        $data['salary'] = $this->get_salaries($salary_con);
        $leave_con['conditions'] = array(
            'user_id' => $id
        );
        $leave_con['returnType'] = 'single';
        $data['leave'] = $this->get_leaves($leave_con);
        $education_con['conditions'] = array(
            'user_id' => $id
        );
        $data['educations'] = $this->get_educations($education_con);
        $dependant_con['conditions'] = array(
            'user_id' => $id
        );
        $data['dependants'] = $this->get_dependants($dependant_con);

        $picture_con['conditions'] = array(
            'user_id' => $id
        );
        $data['pictures'] = $this->get_pictures($picture_con);
        $view = $this->load->view('users/edit_user_form', $data, true);

        $this->output->set_content_type('application/json')
            ->set_output(json_encode($view));
    }


    public function edit() {
        if ($this->input->post('submitEditUser')) {
                $this->form_validation->set_rules('code', 'Employee code', 'required');
                $this->form_validation->set_rules('name', 'name', 'required');
                $this->form_validation->set_rules('father_name', 'Father name', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required');
                $this->form_validation->set_rules('martial_status', 'Martial status', 'required');
                $this->form_validation->set_rules('gender', 'Gender', 'required');
                $this->form_validation->set_rules('designation_id', 'Manager', 'required');
                $this->form_validation->set_rules('department_id', 'Department', 'required');

                 $userData = array(
                    'code' => strip_tags($this->input->post('code')),
                    'name' => strip_tags($this->input->post('name')),
                    'father_name' => strip_tags($this->input->post('father_name')),
                    'email' => strip_tags($this->input->post('email')),
                    'password' => strip_tags(md5($this->input->post('password'))),
                    'mobile_no' => strip_tags($this->input->post('mobile_no')),
                    'dob' => strip_tags($this->input->post('dob')),
                    'bank_account_no' => strip_tags($this->input->post('bank_account_no')),
                    'gender' => strip_tags($this->input->post('gender')),
                    'address' => strip_tags($this->input->post('address')),
                    'city' => strip_tags($this->input->post('city')),
                    'cnic' => strip_tags($this->input->post('cnic')),
                    'martial_status' => strip_tags($this->input->post('martial_status')),
                    'designation_id' => strip_tags($this->input->post('designation_id')),
                    'department_id' => strip_tags($this->input->post('department_id')),
                    'joining_date' => strip_tags($this->input->post('joining_date')),
                    'ice_no' => strip_tags($this->input->post('ice_no')),
                    'ntn_no' => strip_tags($this->input->post('ntn_no')),
                    'role_id' => strip_tags($this->input->post('role_id')),
                    'in_probation' => $this->input->post('in_probation') == 1 ? 1 : 0,
                    'status' => 1
                ); 

                $userfiles = $_FILES['userfile'];


                $id = $this->input->post('id');
                if (!empty($_FILES['userpicture']['name'])) {
                    $_FILES['userfile'] = $_FILES['userpicture'];
                    $upload_path = $this->upload_picture();
                    $userData['photo'] = $upload_path;
                } else {
                    unset($userData['photo']);
                }

                $_FILES['userfile'] = $userfiles;

               

                 $condition = array('id' => $id);
                 if ($this->form_validation->run() == true) {

                    $update = $this->Common_Model->update($userData, $condition, 'hr_users');
                    if($update){
                        $this->update_salaries($id);
                        $this->update_leaves($id);
                        $this->update_educations($id);
                        $this->store_dependants($id);
                        if (!empty($_FILES['userfile']['name'][0])) {
                            $this->upload_path = $this->upload_multiple_files();
                            $this->store_user_pictures($id);
                        }
                        $this->session->set_flashdata('success', array('message' => 'Record updated successfully.'));
                        redirect('Users/list_users');
                    }else{
                        $this->session->set_flashdata('warning', array('message' => 'Something went wrong. Please try again.'));
                        redirect('Users/list_users');
                    }
                } else {
                    $this->session->set_flashdata('warning', array('message' => 'Something went wrong. Please try again.'));
                    redirect('Users/list_users');
                }
        }
    }

    

    public function update_educations($id) {
        $degree_title = $this->input->post('degree_title');
        $condition = array('user_id' => $id);
        $this->Common_Model->delete($condition, 'hr_educations');

        foreach ($degree_title as $key => $value) {
            $userData = array(
                'user_id' => $id,
                'university_name' => strip_tags($_POST['university_name'][$key]),
                'degree_title' => strip_tags($_POST['degree_title'][$key]),
                'major_subjects' => strip_tags($_POST['major_subjects'][$key]),
                'start_date' => date('Y-m-d', strtotime($_POST['start_date'][$key])),
                'end_date' => date('Y-m-d', strtotime($_POST['end_date'][$key])),
                'status' => 1
            );
            $this->Common_Model->insert($userData, 'hr_educations');
        }  
        return true;
    }   

    // Update user salaires
    public function update_salaries($id) {
        $condition = array(
            'user_id' => $id
        );
        $userData = array(
            'basic_salary' => strip_tags($this->input->post('basic_salary')),
            'house_rent_allowance' => $this->input->post('house_rent_allowance') ? $this->input->post('house_rent_allowance') : 0,
            'food_allowance' => $this->input->post('food_allowance') ? $this->input->post('food_allowance') : 0,
            'medical_allowance' => $this->input->post('medical_allowance') ? $this->input->post('medical_allowance') : 0,
            'provident_fund' => $this->input->post('provident_fund') ? $this->input->post('provident_fund') : 0,
            'tax_deduction' => $this->input->post('tax_deduction') ? $this->input->post('tax_deduction') : 0,
            'travelling_allowance' => $this->input->post('travelling_allowance') ? $this->input->post('travelling_allowance') : 0,
            'dearness_allowance' => $this->input->post('dearness_allowance') ? $this->input->post('dearness_allowance') : 0
        );
        $this->Common_Model->update($userData, $condition, 'hr_salaries');
        return true;
    }   

    // Update user leaves
    public function update_leaves($id) {
        $condition = array(
            'user_id' => $id
        );
        $userData = array(
            'casual_leave' => strip_tags($this->input->post('casual_leave')),
            'medical_leave' => strip_tags($this->input->post('medical_leave'))
        );
        $this->Common_Model->update($userData, $condition, 'hr_leaves');
        return true;
    }

    public function store_dependants($id) {
        $condition = array('user_id' => $id);
        $this->Common_Model->delete($condition, 'hr_dependants');
        $dependant_name = $this->input->post('dependant_name');
            foreach ($dependant_name as $key => $value) {
                $userData = array(
                    'user_id' => $id,
                    'name' => strip_tags($_POST['dependant_name'][$key]),
                    'dob' => strip_tags($_POST['dependant_dob'][$key]),
                    'relationship' => strip_tags($_POST['dependant_relationship'][$key]),
                    'mobile_no' => strip_tags($_POST['dependant_mobile_no'][$key]),
                    'address' => strip_tags($_POST['dependant_address'][$key])
                );
            $this->Common_Model->insert($userData, 'hr_dependants');
        }
        return true;
    }

    public function store_user_pictures($id) {
        if (empty($this->upload_path)) {
            $this->session->set_flashdata('warning', array('message' => 'Something went wrong. Images not uploaded successfully.'));
        }
        $condition = array('user_id' => $id);
        $this->Common_Model->delete($condition, 'hr_user_pictures');
        $dependant_name = $this->input->post('dependant_name');
            foreach ($this->upload_path as $key => $value) {
                $userData = array(
                    'user_id' => $id,
                    'photo' => $value
                );
           $this->Common_Model->insert($userData, 'hr_user_pictures');
        }
        return true;
    }

    public function resend_credentials($id) {
        $con['conditions'] = array(
            'id' => $id
        );
        $con['returnType'] = 'single';
        $user = $this->Common_Model->getRows($con, 'hr_users');
        if ($user) {
            $pws = $this->rand_password();

            $this->Common_Model->update(array('password' => md5($pws)), array('id' => $id), 'hr_users');

            $userData['email'] = $user['email'];
            $userData['message'] = 'Below are the login credentials. <br />URL: <a href="' . base_url().'">'.base_url().'</a> <br />Email: '. $user['email'].'<br />Password: '.$pws;
                        $userData['subject'] = 'Login credentials';
                        $this->sendMail($userData);
            $this->session->set_flashdata('success', array('message' => 'Credentials sent successfully.'));                

        } else {
            $this->session->set_flashdata('danger', array('message' => 'Something went wront. Please try again.'));
        }

        redirect('Users/list_users');
    }

    public function delete() {
        $id = $this->input->post('id');
        $condition = array('id' => $id);
        $result = $this->Common_Model->delete($condition, 'hr_users');
        if ($result) {
            $this->session->set_flashdata('success', array('message' => 'Record deleted successfully.'));
        } else {
            $this->session->set_flashdata('danger', array('message' => 'User record can not deleted.'));
        }
        
        redirect('Users/list_users');
    }


}