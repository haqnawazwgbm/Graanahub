<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payrolls extends Check_Logged {

     function __construct() {
        parent::__construct();
       // $this->load->library('Ppdf');
    }

     // Get all users
    public function list_payrolls()
    {
        $con['conditions'] = array(
            'hr_payrolls.status' => 1
        );
        $con['groupBy'] = array("hr_payrolls.date");
        $con['orderBy'] = "hr_payrolls.date desc";
        $payrolls = $this->Common_Model->getRows($con, 'hr_payrolls');
        $payrolls = $payrolls ? $payrolls : array();
        $data['payrolls'] = $payrolls;

        $date = date('Y-m');
        $date = explode('-', $date);
        $month = $date[1];
        $year = $date[0];
        $con2['conditions'] = array(
            'month(hr_payrolls.date)' => $month,
            'year(hr_payrolls.date)' => $year
        );
        $con2['returnType'] = 'single';
        $payroll = $this->Common_Model->getRows($con2, 'hr_payrolls');
        if ($payroll) {
            $data['current_month_payroll'] = false;
        } else {
            $data['current_month_payroll'] = true;
        }
        $this->load->view('payrolls/payrolls', $data);
    }

    public function generate_payroll() {
        $con['selection'] = 'hr_users.*, hr_users.id as user_id, hr_designations.name as designation, hr_roles.name as role, hr_departments.name as department, hr_salaries.*, hr_leaves.*';
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
            ),array(
                'table' => 'hr_salaries',
                'condition' =>'hr_users.id = hr_salaries.user_id',
                'joinType' => 'inner'
            ),array(
                'table' => 'hr_leaves',
                'condition' =>'hr_users.id = hr_leaves.user_id',
                'joinType' => 'left'
            )
        );
        $data['users'] = $this->Common_Model->getRows($con, 'hr_users');
        $view = $this->load->view('payrolls/generate_payroll', $data, true);
        $this->output->set_content_type('application/json')
            ->set_output(json_encode($view));
    }

    public function store() {
        if ($this->input->post('submitPayroll')) {

          

                $con['selection'] = 'hr_users.*, hr_users.id as user_id, hr_designations.name as designation, hr_roles.name as role, hr_departments.name as department, hr_salaries.*';
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
                    ),array(
                        'table' => 'hr_salaries',
                        'condition' =>'hr_users.id = hr_salaries.user_id',
                        'joinType' => 'inner'
                    )
                );
                $users = $this->Common_Model->getRows($con, 'hr_users');

                foreach ($users as $user) : 
                    $data = array(
                        'user_id' => $user['user_id'],
                        'basic_salary' => $user['basic_salary'],
                        'house_rent_allowance' => $user['house_rent_allowance'],
                        'food_allowance' => $user['food_allowance'],
                        'medical_allowance' => $user['medical_allowance'],
                        'provident_fund' => $user['provident_fund'],
                        'tax_deduction' => $user['tax_deduction'],
                        'travelling_allowance' => $user['travelling_allowance'],
                        'dearness_allowance' => $user['dearness_allowance'],
                        'date' => date('Y-m-d'),
                        'status' => 1
                    );
                    $id = $this->Common_Model->insert($data, 'hr_payrolls');
                endforeach;
                $this->session->set_flashdata('success', array('message' => 'Payroll saved successfully.'));

                $date = date('Y-m');
                redirect('Payrolls/payroll_detail/'.$date);

            }
    }

    public function payroll_detail($date = '') {
        $date2 = explode('-', $date);
        $month = $date2[1];
        $year = $date2[0];
        $con['selection'] = 'hr_users.*, hr_users.id as user_id, hr_designations.name as designation, hr_roles.name as role, hr_departments.name as department, hr_payrolls.*, hr_leaves.*';
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
                    ),array(
                        'table' => 'hr_payrolls',
                        'condition' =>'hr_users.id = hr_payrolls.user_id',
                        'joinType' => 'inner'
                    ),array(
                        'table' => 'hr_leaves',
                        'condition' =>'hr_users.id = hr_leaves.user_id',
                        'joinType' => 'left'
                    )
                );
                $con['conditions'] = array(
                    'month(hr_payrolls.date)' => $month,
                    'year(hr_payrolls.date)' => $year
                );
                $con['groupBy'] = array("hr_users.id");

                $data['users'] = $this->Common_Model->getRows($con, 'hr_users');
                $data['date'] = $date;
                $this->load->view('payrolls/payroll_detail', $data);
    }

    // PDF Print
    function slips($date = '')
    {
        $date2 = explode('-', $date);
        $month = $date2[1];
        $year = $date2[0];
        $con['selection'] = 'hr_users.*, hr_users.id as user_id, hr_designations.name as designation, hr_roles.name as role, hr_departments.name as department, hr_payrolls.*, hr_leaves.*';
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
                    ),array(
                        'table' => 'hr_payrolls',
                        'condition' =>'hr_users.id = hr_payrolls.user_id',
                        'joinType' => 'inner'
                    ),array(
                        'table' => 'hr_leaves',
                        'condition' =>'hr_users.id = hr_leaves.user_id',
                        'joinType' => 'left'
                    )
                );
                $con['conditions'] = array(
                    'month(hr_payrolls.date)' => $month,
                    'year(hr_payrolls.date)' => $year
                );
        $con['groupBy'] = array("hr_users.id");
        $data['users'] = $this->Common_Model->getRows($con, 'hr_users');
        $data['date'] = $date;

        $this->load->view('payrolls/slips',$data);

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

    public function delete($id) {
        $condition = array('id' => $id);
        $this->Common_Model->delete($condition, 'pms_users');
        $this->session->set_flashdata('success', array('message' => 'Record deleted successfully.'));
        redirect('Users/');
    }

}