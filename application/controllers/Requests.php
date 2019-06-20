<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Requests extends Check_Logged {

     function __construct() {
        parent::__construct();
        $this->user = $this->session->userdata('user'); 
    }

    // Get employee requests 
    public function employee_requests() {
        $con['selection'] = 'hr_users.name as user_name, hr_roles.name as role, hr_request_types.name as request_name, hr_users.photo, hr_user_requests.description, hr_users.code, hr_user_requests.created as created, hr_user_requests.*, hr_user_requests.id as request_id, hr_user_requests.status as status';
        $con['conditions'] = array(
            'hr_user_requests.user_id' => $this->user['id']
        );
        $con['innerJoin'] = array(array(
            'table' => 'hr_request_types',
            'condition' =>'hr_request_types.id = hr_user_requests.request_type_id',
            'joinType' => 'inner'
             ),array(
            'table' => 'hr_users',
            'condition' =>'hr_users.id = hr_user_requests.user_id',
            'joinType' => 'inner'
             ),array(
            'table' => 'hr_roles',
            'condition' =>'hr_users.role_id = hr_roles.id',
            'joinType' => 'inner'
             )
        );
        $con['orderBy'] = 'hr_user_requests.created asc';

        $data['requests'] = $this->Common_Model->getRows($con, 'hr_user_requests');
        $this->load->view('requests/employee_requests', $data);
    }
    // Get all requests
    public function list_requests() {
        $data['requests'] = $this->get_requests();
        if ($this->user['role_id'] == 2) {
            $this->load->view('requests/manager_requests', $data);
        } else {
            $this->load->view('requests/requests', $data);
        }
        
    }

      public function to_admin_request_details($id) {
        $con['conditions'] = array(
            'hr_user_requests.id' => $id
        );
        $con['selection'] = "hr_users.*, hr_user_requests.*, hr_designations.name as designation, hr_request_types.name as request_type";
        $con['innerJoin'] = array(array(
            'table' => 'hr_request_types',
            'condition' =>'hr_request_types.id = hr_user_requests.request_type_id',
            'joinType' => 'inner'
        ),array(
            'table' => 'hr_users',
            'condition' =>'hr_users.id = hr_user_requests.user_id',
            'joinType' => 'inner'
        ),array(
            'table' => 'hr_designations',
            'condition' =>'hr_designations.id = hr_users.designation_id',
            'joinType' => 'inner'
        ));
        $con['returnType'] = 'single';
        $data['request'] = $this->Common_Model->getRows($con, 'hr_user_requests');

        $picture_con['conditions'] = array(
            'user_request_id' => $id
        );
        $data['pictures'] = $this->Common_Model->getRows($picture_con, 'hr_request_pictures');
        $view = $this->load->view('requests/request_details', $data, true);

        $this->output->set_content_type('application/json')
            ->set_output(json_encode($view));
    }

    public function to_manager_request_details($id) {
        $con['conditions'] = array(
            'hr_user_requests.id' => $id
        );
        $con['selection'] = "hr_users.*, hr_user_requests.*, hr_designations.name as designation, hr_request_types.name as request_type, sum(DATEDIFF(hr_user_requests.end_date, hr_user_requests.start_date)) as leave_days";
        $con['innerJoin'] = array(array(
            'table' => 'hr_request_types',
            'condition' =>'hr_request_types.id = hr_user_requests.request_type_id',
            'joinType' => 'inner'
        ),array(
            'table' => 'hr_users',
            'condition' =>'hr_users.id = hr_user_requests.user_id',
            'joinType' => 'inner'
        ),array(
            'table' => 'hr_designations',
            'condition' =>'hr_designations.id = hr_users.designation_id',
            'joinType' => 'inner'
        ));
        $con['returnType'] = 'single';
        $data['request'] = $this->Common_Model->getRows($con, 'hr_user_requests');

        $picture_con['conditions'] = array(
            'user_request_id' => $id
        );
        $data['pictures'] = $this->Common_Model->getRows($picture_con, 'hr_request_pictures');
        $view = $this->load->view('requests/manager_request_details', $data, true);

        $this->output->set_content_type('application/json')
            ->set_output(json_encode($view));
    }

       public function store() {
        if ($this->input->post('submitUser')) {
                $this->form_validation->set_rules('request_type_id', 'Request type', 'required');
                $this->form_validation->set_rules('description', 'Description', 'required');
        

                $userData = array(
                    'user_id' => $this->user['id'],
                    'request_type_id' => strip_tags($this->input->post('request_type_id')),
                    'start_date' => strip_tags($this->input->post('start_date')),
                    'end_date' => strip_tags($this->input->post('end_date')),
                    'description' => html_purify($this->input->post('description'))
                ); 

                if ($this->form_validation->run() == true) {

                    $id = $this->Common_Model->insert($userData, 'hr_user_requests');
                    if (!empty($_FILES['userfile']['name'][0])) {
                            $this->upload_path = $this->upload_multiple_files();
                            $this->store_user_pictures($id);
                    }
                     $this->session->set_flashdata('success', array('message' => 'Request sent successfully.'));
                    redirect('Dashboard');
                } else {
                    $this->session->set_flashdata('danger', array('message' => 'Something went wrong. Plese try again.'));
                    redirect('Dashboard');
                }

        }
    }

    public function edit_form($id) {
        $con['selection'] = "hr_users.*, hr_user_requests.*, hr_user_requests.id as request_id, hr_designations.name as designation, hr_request_types.name as request_type, sum(DATEDIFF(hr_user_requests.end_date, hr_user_requests.start_date)) as leave_days";
        $con['conditions'] = array(
            'hr_user_requests.id' => $id
        );

        $con['innerJoin'] = array(array(
            'table' => 'hr_request_types',
            'condition' =>'hr_request_types.id = hr_user_requests.request_type_id',
            'joinType' => 'inner'
        ),array(
            'table' => 'hr_users',
            'condition' =>'hr_users.id = hr_user_requests.user_id',
            'joinType' => 'inner'
        ),array(
            'table' => 'hr_designations',
            'condition' =>'hr_designations.id = hr_users.designation_id',
            'joinType' => 'inner'
        ));
        $con['returnType'] = 'single';
        $data['request'] = $this->Common_Model->getRows($con, 'hr_user_requests');
        $view = $this->load->view('requests/edit_request_form', $data, true);

        $this->output->set_content_type('application/json')
            ->set_output(json_encode($view));
    }

    public function update() {
         if ($this->input->post('submitEditUser')) {

                $this->form_validation->set_rules('start_date', 'Start date', 'required');
                $this->form_validation->set_rules('end_date', 'End date', 'required');
                $this->form_validation->set_rules('status', 'Status', 'required');
                $id = $this->input->post('id');
                if ($_POST['status'] == -1) {
                    $userData = array(
                    'start_date' => strip_tags($this->input->post('start_date')),
                    'end_date' => strip_tags($this->input->post('end_date')),
                    'status' => 0
                 ); 
                } else {
                    $userData = array(
                    'start_date' => strip_tags($this->input->post('start_date')),
                    'end_date' => strip_tags($this->input->post('end_date')),
                    'approved' => $this->input->post('status')
                    ); 
                }

                 $condition = array('id' => $id);
                 if ($this->form_validation->run() == true) {

                    $update = $this->Common_Model->update($userData, $condition, 'hr_user_requests');
                    if($update){
                        $this->session->set_flashdata('success', array('message' => 'Record updated successfully.'));
                        redirect('Requests/list_requests');
                    }else{
                        $this->session->set_flashdata('warning', array('message' => 'Something went wrong. Please try again.'));
                        redirect('Requests/list_requests');
                    }
                } else {
                    $this->session->set_flashdata('warning', array('message' => 'Something went wrong. Please try again.'));
                    redirect('Requests/list_requests');
                }
        }
    }


  public function approved() {
    $request_id = $this->input->post('request_id');
    $request_type_id = $this->input->post('request_type_id');
    if ($this->user['role_id'] == 1) {
        $userData = array(
            'approved_by_admin' => $this->user['id']
        );
    } elseif ($this->user['role_id'] == 2) {
        $userData = array(
            'approved_by_manager' => $this->user['id']
        );

    } elseif ($this->user['role_id'] == 3) {
        $userData = array(
            'approved_by_hr' => $this->user['id']
        );

    } elseif ($this->user['role_id'] == 5) {
        $userData = array(
            'approved_by_hod' => $this->user['id']
        );

    } elseif ($this->user['role_id'] == 6) {
        $userData = array(
            'approved_by_gf_manager' => $this->user['id']
        );

    } elseif ($this->user['role_id'] == 7) {
        $userData = array(
            'approved_by_finance' => $this->user['id']
        );

    }
    $condition = array('id' => $request_id);
    $update = $this->Common_Model->update($userData, $condition, 'hr_user_requests');
    $this->update_approve_status();
   
    if ($update) {
        $response = '<a href="#" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-dot-circle-o text-success"></i> Approved 
            </a>';
    } else {
        $response = 'Something went wrong.';
    }
    $this->output->set_content_type('application/json')
            ->set_output(json_encode($response));

  }

   public function rejected() {
    $request_id = $this->input->post('request_id');
    if ($this->user['role_id'] == 1) {
        $userData = array(
            'approved_by_admin' => 0,
            'status' => 0,
            'approved' => 0
        );
    } elseif ($this->user['role_id'] == 2) {
        $userData = array(
            'approved_by_manager' => 0,
            'status' => 0,
            'approved' => 0
        );

    } elseif ($this->user['role_id'] == 3) {
        $userData = array(
            'approved_by_hr' => 0,
            'status' => 0,
            'approved' => 0
        );

    } elseif ($this->user['role_id'] == 5) {
        $userData = array(
            'approved_by_hod' => 0,
            'status' => 0,
            'approved' => 0
        );

    } elseif ($this->user['role_id'] == 6) {
        $userData = array(
            'approved_by_gf_manager' => 0,
            'status' => 0,
            'approved' => 0
        );

    } elseif ($this->user['role_id'] == 7) {
        $userData = array(
            'approved_by_finance' => 0,
            'status' => 0,
            'approved' => 0
        );

    }
    
    $condition = array('id' => $request_id);
    $update = $this->Common_Model->update($userData, $condition, 'hr_user_requests');
    if ($update) {
        $response = '<a href="#" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-dot-circle-o text-danger"></i> Rejected
            </a>';
    } else {
        $response = 'Something went wrong.';
    }
    $this->output->set_content_type('application/json')
            ->set_output(json_encode($response));

  }

    public function update_approve_status() {
        $request_id = $this->input->post('request_id');
        $request_type_id = $this->input->post('request_type_id');
        if ($request_type_id == 1) {
            $condition = array(
                'approved_by_manager !=' => 0,
                'id' => $request_id
            );
        } elseif ($request_type_id == 2) {
            $condition = array(
                'approved_by_manager !=' => 0,
                'approved_by_hod !=' => 0,
                'id' => $request_id
            );
        } elseif ($request_type_id == 3) {
            $condition = array(
                'approved_by_manager !=' => 0,
                'id' => $request_id
            );
        } elseif ($request_type_id == 4) {
            $condition = array(
                'approved_by_finance !=' => 0,
                'id' => $request_id
            );
        } elseif ($request_type_id == 5) {
            $condition = array(
                'approved_by_manager !=' => 0,
                'approved_by_gf_manager !=' => 0,
                'id' => $request_id
            );
        } elseif ($request_type_id == 6) {
            $condition = array(
                'approved_by_manager !=' => 0,
                'approved_by_hod !=' => 0,
                'approved_by_finance !=' => 0,
                'id' => $request_id
            );
        } elseif ($request_type_id == 7) {
            $condition = array(
                'approved_by_manager !=' => 0,
                'approved_by_gf_manager !=' => 0,
                'approved_by_admin !=' => 0,
                'id' => $request_id
            );
        } elseif ($request_type_id == 8) {
            $condition = array(
                'approved_by_manager !=' => 0,
                'approved_by_gf_manager !=' => 0,
                'approved_by_admin !=' => 0,
                'id' => $request_id
            );
        } elseif ($request_type_id == 9) {
            $condition = array(
                'approved_by_manager !=' => 0,
                'approved_by_gf_manager !=' => 0,
                'approved_by_hod !=' => 0,
                'approved_by_finance !=' => 0,
                'id' => $request_id
            );
        } elseif ($request_type_id == 10) {
            $condition = array(
                'approved_by_hr !=' => 0,
                'id' => $request_id
            );
        } elseif ($request_type_id == 11) {
            $condition = array(
                'approved_by_admin !=' => 0,
                'id' => $request_id
            );
        } elseif ($request_type_id == 12) {
            $condition = array(
                'approved_by_manager !=' => 0,
                'approved_by_gf_manager !=' => 0,
                'approved_by_admin !=' => 0,
                'id' => $request_id
            );
        } elseif ($request_type_id == 13) {
            $condition = array(
                'approved_by_manager !=' => 0,
                'approved_by_gf_manager !=' => 0,
                'approved_by_admin !=' => 0,
                'id' => $request_id
            );
        } elseif ($request_type_id == 13) {
            $condition = array(
                'approved_by_manager !=' => 0,
                'approved_by_hr !=' => 0,
                'id' => $request_id
            );
        }
         $userData = array(
            'approved' => 1,
            'status' => 1
        );
  
        $this->Common_Model->update($userData, $condition, 'hr_user_requests');
        return true;
    }

    public function store_user_pictures($id) {
        if (empty($this->upload_path)) {
            $this->session->set_flashdata('warning', array('message' => 'Something went wrong. Images not uploaded successfully.'));
        }
        $condition = array('user_request_id' => $id);
        $this->Common_Model->delete($condition, 'hr_request_pictures');
            foreach ($this->upload_path as $key => $value) {
                $userData = array(
                    'user_request_id' => $id,
                    'photo' => $value
                );
           $this->Common_Model->insert($userData, 'hr_request_pictures');
        }
        return true;
    }

    public function view_calendar() {
        $con['selection'] = 'hr_users.name, hr_user_requests.*';
        $con['conditions'] = array(
            'hr_user_requests.request_type_id' => 1,
            'hr_user_requests.status' => 1,
            'hr_user_requests.approved' => 1
        );
        $con['innerJoin'] = array(array(
            'table' => 'hr_users',
            'condition' =>'hr_users.id = hr_user_requests.user_id',
            'joinType' => 'inner'
        ));
        $data['users'] = $this->Common_Model->getRows($con, 'hr_user_requests');
        $view = $this->load->view('requests/calendar', $data, true);
        $this->output->set_content_type('application/json')
            ->set_output(json_encode($view));
    }

    public function delete() {
        $id = $this->input->post('id');
        $condition = array('id' => $id);
        $this->Common_Model->delete($condition, 'hr_user_requests');
        $this->session->set_flashdata('success', array('message' => 'Record deleted successfully.'));
        redirect('Requests/employee_requests');
    }

}