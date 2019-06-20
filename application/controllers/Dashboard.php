<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Check_Logged {
    private $data;
    private $upload_path = array();


	function __construct() {
        parent::__construct();
        $this->user = $this->session->userdata('user'); 
        
    }

    // Get all cars
	public function index()
	{
        if ($this->user['role_id'] == 4) {
            redirect('Dashboard/employee');
        } elseif ($this->user['role_id'] == 2) {
            redirect('Dashboard/manager');
        }

        
        // count all users.
        $con['selection'] = 'count(hr_users.id) as users';
        $con['conditions'] = array(
            'status' => 1
        );
        $con['returnType'] = 'single';
        $users = $this->Common_Model->getRows($con, 'hr_users');
        $data['users'] = $users['users'];

        // count all departments.
        $con['selection'] = 'count(hr_departments.id) as departments';
        $con['conditions'] = array(
            'status' => 1
        );
        $con['returnType'] = 'single';
        $users = $this->Common_Model->getRows($con, 'hr_departments');
        $data['departments'] = $users['departments'];

        // count all designations.
        $con['selection'] = 'count(hr_designations.id) as designations';
        $con['conditions'] = array(
            'status' => 1
        );
        $con['returnType'] = 'single';
        $users = $this->Common_Model->getRows($con, 'hr_designations');
        $data['designations'] = $users['designations'];

        // count all salaries.
        $con['selection'] = 'sum(hr_salaries.basic_salary) as basic_salary, sum(hr_salaries.house_rent_allowance) as house_rent_allowance, sum(hr_salaries.medical_allowance) as medical_allowance, sum(hr_salaries.provident_fund) as provident_fund, sum(hr_salaries.travelling_allowance) as travelling_allowance';
        $con['conditions'] = array(
            'status' => 1
        );
        $con['returnType'] = 'single';
        $salary = $this->Common_Model->getRows($con, 'hr_salaries');
        $data['salary'] = $salary;
        $this->load->view('dashboard.php', $data);
	}

    public function manager () {
        // count all users.
        $con['selection'] = 'count(hr_users.id) as users';
        $con['conditions'] = array(
            'status' => 1
        );
        $con['returnType'] = 'single';
        $users = $this->Common_Model->getRows($con, 'hr_users');
        $data['users'] = $users['users'];

        // count all departments.
        $con['selection'] = 'count(hr_departments.id) as departments';
        $con['conditions'] = array(
            'status' => 1
        );
        $con['returnType'] = 'single';
        $users = $this->Common_Model->getRows($con, 'hr_departments');
        $data['departments'] = $users['departments'];

        // count all designations.
        $con['selection'] = 'count(hr_designations.id) as designations';
        $con['conditions'] = array(
            'status' => 1
        );
        $con['returnType'] = 'single';
        $users = $this->Common_Model->getRows($con, 'hr_designations');
        $data['designations'] = $users['designations'];

        // count all salaries.
        $con['selection'] = 'sum(hr_salaries.basic_salary) as basic_salary, sum(hr_salaries.house_rent_allowance) as house_rent_allowance, sum(hr_salaries.medical_allowance) as medical_allowance, sum(hr_salaries.provident_fund) as provident_fund, sum(hr_salaries.travelling_allowance) as travelling_allowance';
        $con['conditions'] = array(
            'status' => 1
        );
        $con['returnType'] = 'single';
        $salary = $this->Common_Model->getRows($con, 'hr_salaries');
        $data['salary'] = $salary;
        $this->load->view('dashboard.php', $data);
    }

    public function employee() {

        // sum all basic salaries.
        $con['selection'] = 'sum(hr_payrolls.basic_salary) as basic_salaries';
        $con['conditions'] = array(
            'status' => 1,
            'user_id' => $this->user['id']
        );
        $con['returnType'] = 'single';
        $users = $this->Common_Model->getRows($con, 'hr_payrolls');
        $data['basic_salaries'] = $users['basic_salaries'];
        // count all accepted requests.
        $con['selection'] = 'count(hr_user_requests.id) as accepted_requests';
        $con['conditions'] = array(
            'status' => 1,
            'user_id' => $this->user['id'],
            'approved' => 1,
            'status' => 1
        );
        $con['returnType'] = 'single';
        $users = $this->Common_Model->getRows($con, 'hr_user_requests');
        $data['accepted_requests'] = $users['accepted_requests'];
        // count all accepted requests.
        $con['selection'] = 'count(hr_user_requests.id) as rejected_requests';
        $con['conditions'] = array(
            'user_id' => $this->user['id'],
            'status' => 0,
            'approved' => 0
        );
        $con['returnType'] = 'single';
        $users = $this->Common_Model->getRows($con, 'hr_user_requests');
        $data['rejected_requests'] = $users['rejected_requests'];
        // count all pending requests.
        $con['selection'] = 'count(hr_user_requests.id) as pending_requests';
        $con['conditions'] = array(
            'status' => 1,
            'user_id' => $this->user['id'],
            'approved' => 0
        );
        $con['returnType'] = 'single';
        $users = $this->Common_Model->getRows($con, 'hr_user_requests');
        $data['pending_requests'] = $users['pending_requests'];
        $this->load->view('employee_dashboard.php', $data);
    }


	public function form() 
	{

		
		$this->load->view('admin/activity_form');

	}

    public function store() {
        if ($this->input->post('submitActivity')) {
            
                $this->form_validation->set_rules('city_id', 'City', 'required');
                $this->form_validation->set_rules('year_model_id', 'Car model', 'required');
                $this->form_validation->set_rules('car_info', 'Car inofrmation', 'required');

                $this->form_validation->set_rules('mileage', 'Mileage', 'required');
                $this->form_validation->set_rules('price', 'Car price', 'required');
                $this->form_validation->set_rules('seller_name', 'Car seller', 'required');
                $this->form_validation->set_rules('contact_info', 'Car phone number', 'required');
                $this->form_validation->set_rules('color_id', 'Car color', 'required');
                $userData = array(
                    'user_id' => $this->session->userdata('userId'),
                    'city_id' => strip_tags($this->input->post('city_id')),
                    'year_model_id' => strip_tags($this->input->post('year_model_id')),
                    'car_info' => strip_tags($this->input->post('car_info')),
                    'registration_city_id' => strip_tags($this->input->post('registration_city_id')),
                    'mileage' => strip_tags($this->input->post('mileage')),
                    'color_id' => strip_tags($this->input->post('color_id')),
                    'price' => strip_tags($this->input->post('price')),
                    'description' => strip_tags($this->input->post('description')),
                    'seller_name' => strip_tags($this->input->post('seller_name')),
                    'contact_info' => strip_tags($this->input->post('contact_info')),
                    'featured' => strip_tags($this->input->post('featured')),
                    'popular' => strip_tags($this->input->post('popular')),
                    'upcomming' => strip_tags($this->input->post('upcomming')),
                    'type' => strip_tags($this->input->post('type')),
                    'features' => strip_tags($this->input->post('features')),
                    'expire_date' => date('Y-m-d', strtotime('+1 years')),
                    'status' => $this->input->post('status')
                ); 

                if ($this->form_validation->run() == true) {

                    $upload = $this->upload_multiple_files();
                    if (!$upload) {
                        $this->session->set_flashdata('danger', array('message' => 'Something went wrong. Please try again.'));
                        redirect('Admin_Cars/form');
                    } 
                    $id = $this->Common_Model->insert($userData, 'wh_car_information');
                    if($id){
                        foreach ($this->uploaded_path as $key => $value) {
                            $userData2 = array(
                                'photo_path' => $value,
                                'car_information_id' => $id,
                                'status' => 1
                            );
                            $this->Common_Model->insert($userData2, 'wh_car_photos');
                        }
                        $this->session->set_flashdata('success', array('message' => 'Record created successfully.'));
                        redirect('Admin_Cars');
                    }else{
                        $this->session->set_flashdata('danger', array('message' => 'Something went wrong. Please try again.'));
                        redirect('Admin_Cars/form');
                    }
                } else {
                    $data['user'] = $userData;
                    //load the view
                    $this->load->view('admin/car_form', $data);
                }

        }
    }

    public function edit_form($id) 
    {
        $con['conditions'] = array(
            'status' => 1,
            'id', $id
        );
        $con['returnType'] = 'single';
        $data['activity'] = $this->Common_Model->getRows($con, 'pms_activities');
        $this->load->view('admin/edit_activity_form', $data);

    }

    public function edit() {
        if ($this->input->post('submitEditActivity')) {
                $con['conditions'] = array(
                    'status' => 1
                );
            
                $this->form_validation->set_rules('city_id', 'City', 'required');
                $this->form_validation->set_rules('year_model_id', 'Car model', 'required');
                $this->form_validation->set_rules('car_info', 'Car inofrmation', 'required');
                $this->form_validation->set_rules('mileage', 'Mileage', 'required');
                $this->form_validation->set_rules('price', 'Car price', 'required');
                $this->form_validation->set_rules('seller_name', 'Car seller', 'required');
                $this->form_validation->set_rules('contact_info', 'Car phone number', 'required');
                $this->form_validation->set_rules('color_id', 'Car color', 'required');

                $id = $this->input->post('id');

                $userData = array(
                    'id' => $id,
                    'user_id' => $this->session->userdata('userId'),
                    'city_id' => strip_tags($this->input->post('city_id')),
                    'year_model_id' => strip_tags($this->input->post('year_model_id')),
                    'car_info' => strip_tags($this->input->post('car_info')),
                    'registration_city_id' => strip_tags($this->input->post('registration_city_id')),
                    'mileage' => strip_tags($this->input->post('mileage')),
                    'color_id' => strip_tags($this->input->post('color_id')),
                    'price' => strip_tags($this->input->post('price')),
                    'description' => strip_tags($this->input->post('description')),
                    'seller_name' => strip_tags($this->input->post('seller_name')),
                    'contact_info' => strip_tags($this->input->post('contact_info')),
                    'featured' => strip_tags($this->input->post('featured')),
                    'popular' => strip_tags($this->input->post('popular')),
                    'upcomming' => strip_tags($this->input->post('upcomming')),
                    'type' => strip_tags($this->input->post('type')),
                    'features' => strip_tags($this->input->post('features')),
                    'status' => $this->input->post('status')
                ); 
                $condition = array('id' => $id);

                if ($this->form_validation->run() == true) {

                    $upload = $this->upload_multiple_files();
                    if (!$upload) {
                        $this->session->set_flashdata('danger', array('message' => 'Something went wrong. Please try again.'));
                        redirect('Admin_Cars/form');
                    } 
                    
                

                    $update = $this->Common_Model->update($userData, $condition, 'wh_car_information');
                    if($update){
                        // delete car photos if user select new photos.
                        if (!empty($_FILES['userfile']['name'])) {
                            $deleteCondition = array('car_information_id' => $id);
                            $this->Common_Model->delete($deleteCondition, 'wh_car_photos');

                            foreach ($this->uploaded_path as $key => $value) {
                                $userData2 = array(
                                    'photo_path' => $value,
                                    'car_information_id' => $id,
                                    'status' => 1
                                );
                                $this->Common_Model->insert($userData2, 'wh_car_photos');
                            }
                        }
                        
                        $this->session->set_flashdata('success', array('message' => 'Record updated successfully.'));
                        redirect('Admin_Cars');
                    }else{
                        $this->session->set_flashdata('danger', array('message' => 'Something went wrong. Please try again.'));
                        redirect('Admin_Cars/edit_form/'. $id);
                    }
                } else {
                    $data['user'] = $userData;
                    //load the view
                    $this->load->view('admin/car_form/'. $id, $data);
                }

        }
    }

    public function delete($id) {
        $condition = array('id' => $id);
        $this->Common_Model->delete($condition, 'pms_activities');
        $this->session->set_flashdata('success', array('message' => 'Record deleted successfully.'));
        redirect('Admin_Cars/');
    }

   
}

