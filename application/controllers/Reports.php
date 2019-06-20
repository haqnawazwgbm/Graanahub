<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends Check_Logged {


    function __construct() {
        parent::__construct();
        $this->user = $this->session->userdata('user'); 
        
    }

    public function salaries_taxes() {
        if($this->input->post('submitSalariesTaxes')) {
            $department_id = $this->input->post('department_id');
            $user_id = $this->input->post('user_id');
            $from_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');

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
            if ($department_id != -1 && $user_id == -1 && $from_date == '' && $to_date == '') {
                $con['conditions'] = array(
                    'hr_departments.id' => $department_id
                );
            } elseif ($department_id != -1 && $user_id != -1 && $from_date == '' && $to_date == '') {
                $con['conditions'] = array(
                    'hr_departments.id' => $department_id,
                    'hr_users.id' => $user_id
                );
            } elseif ($department_id != -1 && $user_id != -1 && $from_date != '' && $to_date != '') {
                $con['conditions'] = array(
                    'hr_departments.id' => $department_id,
                    'hr_users.id' => $user_id,
                    'hr_payrolls.date >=' => $from_date,
                    'hr_payrolls.date <=' => $to_date
                );
            } elseif ($from_date != '' && $to_date != '') {
                $con['conditions'] = array(
                    'hr_payrolls.date >=' => $from_date,
                    'hr_payrolls.date <=' => $to_date
                );
            } elseif ($user_id != '') {
                $con['conditions'] = array(
                    'hr_users.id' => $user_id
                );
            }

            $con['groupBy'] = array('hr_users.id');
            $users = $this->Common_Model->getRows($con, 'hr_users');
            $data['users'] = $users ? $users : array();
            $view = $this->load->view('reports/salaries_taxes_report', $data, true);
            $this->output->set_content_type('application/json')
            ->set_output(json_encode($view));
        } else {
            $data['departments'] = $this->get_departments();

            $this->load->view('reports/salaries_taxes_form', $data);
        }
        
        
    }

    public function employee_salaries_taxes() {
        if($this->input->post('submitSalariesTaxes')) {
            $from_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');

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
                    'joinType' => 'inner'
                )
            );
           if ($from_date != '' && $to_date != '') {
                $con['conditions'] = array(
                    'hr_payrolls.date >=' => $from_date,
                    'hr_payrolls.date <=' => $to_date,
                    'hr_users.id' => $this->user['id']
                );
            } else {
                $con['conditions'] = array(
                    'hr_users.id' => $this->user['id']
                );
            }
            $users = $this->Common_Model->getRows($con, 'hr_users');
            $data['users'] = $users ? $users : array();
            $view = $this->load->view('reports/employee_salaries_taxes_report', $data, true);
            $this->output->set_content_type('application/json')
            ->set_output(json_encode($view));
        } else {

            $this->load->view('reports/employee_salaries_taxes_form');
        }
    }

    public function manager_salaries_taxes() {
        if($this->input->post('submitSalariesTaxes')) {
            $user_id = $this->input->post('user_id');
            $from_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');

            $con['selection'] = 'hr_users.*, hr_users.id as user_id, hr_designations.name as designation, hr_roles.name as role, hr_departments.name as department, hr_payrolls.*, hr_payrolls.date as date, hr_leaves.*';
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
            if ($user_id != -1 && $from_date == '' && $to_date == '') {
                $con['conditions'] = array(
                    'hr_users.id' => $user_id
                );
            } elseif ($from_date != '' && $to_date != '') {
                $con['conditions'] = array(
                    'hr_payrolls.date >=' => $from_date,
                    'hr_payrolls.date <=' => $to_date
                );
            } elseif ($user_id == -1 && $from_date == '' && $to_date == '') {
                $con['conditions'] = array(
                    'hr_users.department_id' => $this->user['department_id'],
                    'hr_users.status' => 1
                );

            } elseif ($user_id != -1 && $from_date =! '' && $to_date =! '') {
                $con['conditions'] = array(
                    'hr_payrolls.date >=' => $from_date,
                    'hr_payrolls.date <=' => $to_date,
                    'hr_users.id' => $user_id
                );
            }
            $con['groupBy'] = array('hr_users.id');
            $users = $this->Common_Model->getRows($con, 'hr_users');

            $data['users'] = $users ? $users : array();
            $view = $this->load->view('reports/salaries_taxes_report', $data, true);
            $this->output->set_content_type('application/json')
            ->set_output(json_encode($view));
        } else {
            $con['conditions'] = array(
                'hr_users.department_id' => $this->user['department_id'],
                'status' => 1
            );
            $data['users'] = $this->get_users($con);

            $this->load->view('reports/manager_salaries_taxes_form', $data);
        }
        
        
    }

    public function user_list($id) {
        $dropdown = '';

        if ($id != -1) {
                $con['conditions'] = array(
                'hr_users.department_id' => $id,
                'hr_users.status' => 1
            );
            $users = $this->get_users($con);
            if (! empty($users)) {
                $dropdown = '<select id="users" class="form-control" name="user_id"><option value="-1">Select Employee</option>';
                foreach ($users as $user) :
                    $dropdown = $dropdown .'<option value="'.$user['id'].'">'.ucfirst($user['name']).'</option>';
                endforeach;
                $dropdown = $dropdown . '</select>';
            }
            
        }
        
        
        $this->output->set_content_type('application/json')
            ->set_output(json_encode($dropdown));

    }
   
}

