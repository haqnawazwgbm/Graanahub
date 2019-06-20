<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General_Functions extends Numbertowords {


	public function __construct()
    {
        parent::__construct();
        $this->load->helper("file");
        $this->load->library('form_validation');
        $this->load->model('Common_Model');
        $this->load->helper('security');    
        $this->load->library('pagination');
        $this->lang->load('message','english');
        $this->load->helper('htmlpurifier');
    }

    public function rand_password() {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $pws = substr(str_shuffle($chars),0,8);
        return $pws;
    }

    public function remaining_date($date) {
        $date = strtotime(date('Y-m-d H:i:s')) - strtotime($date);
        return date('i:s', $date);
    }

    // Get all leave notifications
    public function get_leave_notifications($verified_by) {
        if ($verified_by == 'verified_by_admin') {
            $con['conditions'] = array(
                'pms_leaves.verified_by_admin' => 'null',
                'pms_leaves.status' => 1
            );

        } elseif ($verified_by == 'verified_by_manager') {
            $con['conditions'] = array(
                'pms_leaves.verified_by_manager' => 'null',
                'pms_leaves.status' => 1
            );
        }
        if (isset($con)) {
            $con['selection'] = 'pms_users.name, pms_leaves.id';
            $con['innerJoin'] = array(array(
                'table' => 'pms_users',
                'condition' =>'pms_users.id = pms_leaves.user_id',
                'joinType' => 'inner'
            ));
            $leave_notifications = $this->Common_Model->getRows($con, 'pms_leaves');
            $leave_notifications = $leave_notifications ? $leave_notifications : array();
            return $leave_notifications;
        }
        
    }
    // Get user time
    public function get_user_hours($id) {
        $con['returnType'] = 'single';
        $con['conditions'] = array(
            'user_id' => $id,
            'status' => 1
        );

        $hours = $this->Common_Model->getRows($con, 'hr_users');
        $hours = $hours ? $hours : array();
        return $hours;
    }


    // Get all leaves type
    public function get_leave_types() {
        $con['conditions'] = array(
            'status' => 1
        );
        $leave_types = $this->Common_Model->getRows($con, 'pms_leave_types');
        $leave_types = $leave_types ? $leave_types : array();
        return $leave_types; 
    }

    // Get user types
    public function get_user_types() {
        $con['conditions'] = array(
            'status' => 1
        );
        $user_types = $this->Common_Model->getRows($con, 'pms_user_types');
        $user_types = $user_types ? $user_types : array();
        return $user_types; 
    }

    // Get departments
    public function get_departments() {
        $con['conditions'] = array(
            'status' => 1
        );
        $departments = $this->Common_Model->getRows($con, 'hr_departments');
        $departments = $departments ? $departments : array();
        return $departments; 
    }
    // Get domiciles
    public function get_domiciles() {
        $con = array();
        $domiciles = $this->Common_Model->getRows($con, 'hr_domicile');
        $domiciles = $domiciles ? $domiciles : array();
        return $domiciles; 
    }
    // Get experiences
    public function get_experiences() {
        $con = array();
        $experiences = $this->Common_Model->getRows($con, 'hr_experience');
        $experiences = $experiences ? $experiences : array();
        return $experiences; 
    }

    // Get designations
    public function get_designations() {
        $con['conditions'] = array(
            'status' => 1
        );
        $designations = $this->Common_Model->getRows($con, 'hr_designations');
        $designations = $designations ? $designations : array();
        return $designations; 
    }

    // Get roles
    public function get_roles() {
        $con['conditions'] = array(
            'status' => 1
        );
        $roles = $this->Common_Model->getRows($con, 'hr_roles');
        $roles = $roles ? $roles : array();
        return $roles; 
    }

    // Get roles
    public function get_cities() {
        $con['conditions'] = array(
            'status' => 1
        );
        $cities = $this->Common_Model->getRows($con, 'hr_cities');
        $cities = $cities ? $cities : array();
        return $cities; 
    }

    // Get jobs
    public function get_jobs($con = array()) {
        if (empty($con)) {
             $con['conditions'] = array(
                'status' => 1
            );
        }
        $jobs = $this->Common_Model->getRows($con, 'hr_jobs');
        $jobs = $jobs ? $jobs : array();
        return $jobs; 
    }

    // Get payrolls
    public function get_payrolls($con = array()) {
        if (empty($con)) {
             $con['conditions'] = array(
                'status' => 1
            );
        }
        $payrolls = $this->Common_Model->getRows($con, 'hr_payrolls');
        $payrolls = $payrolls ? $payrolls : array();
        return $payrolls; 
    }

    // Get policies
    public function get_policies($con = array()) {
        if (empty($con)) {
             $con['conditions'] = array(
                'status' => 1
            );
        }
        $policies = $this->Common_Model->getRows($con, 'hr_policies');
        $policies = $policies ? $policies : array();
        return $policies; 
    }

    // Get code of conducts
    public function get_code_conducts($con = array()) {
        if (empty($con)) {
             $con['conditions'] = array(
                'status' => 1
            );
        }
        $code_conducts = $this->Common_Model->getRows($con, 'hr_code_conducts');
        $code_conducts = $code_conducts ? $code_conducts : array();
        return $code_conducts; 
    }

    // Get request types
    public function get_request_types($con = array()) {
        if (empty($con)) {
             $con['conditions'] = array(
                'status' => 1
            );
        }
        $request_types = $this->Common_Model->getRows($con, 'hr_request_types');
        $request_types = $request_types ? $request_types : array();
        return $request_types; 
    }

    // Get leaves 
    public function get_taken_leaves($user_id, $date) {
        $start_date = $date;
        $time = strtotime($date);
        $end_date = date("Y-m-d", strtotime("+1 month", $time));

        $con['selection'] = "sum(DATEDIFF(end_date, start_date)) as leaves";
        $con['conditions'] = array(
            'user_id' => $user_id,
            'start_date >=' => $start_date,
            'end_date <=' => $end_date,
            'request_type_id' => 1,
            'approved' => 1,
            'status' => 1
        );
        $con['returnType'] = 'single';
        $leaves = $this->Common_Model->getRows($con, 'hr_user_requests');
        return $leaves['leaves'] ? $leaves['leaves'] : 0;
    }

    // Get educations
    public function get_educations($con = array()) {
        if (empty($con)) {
             $con['conditions'] = array(
                'status' => 1
            );
        }
        $educations = $this->Common_Model->getRows($con, 'hr_educations');
        $educations = $educations ? $educations : array();
        return $educations; 
    }

    // Get dependants
    public function get_dependants($con = array()) {
        if (empty($con)) {
             $con['conditions'] = array(
                'status' => 1
            );
        }
        $dependants = $this->Common_Model->getRows($con, 'hr_dependants');
        $dependants = $dependants ? $dependants : array();
        return $dependants; 
    }

    // Get doc pictures
    public function get_pictures($con = array()) {
        if (empty($con)) {
             $con['conditions'] = array(
                'status' => 1
            );
        }
        $pictures = $this->Common_Model->getRows($con, 'hr_user_pictures');
        $pictures = $pictures ? $pictures : array();
        return $pictures; 
    }

    // Get salaries
    public function get_salaries($con = array()) {
        if (empty($con)) {
             $con['conditions'] = array(
                'status' => 1
            );
        }
        $salaries = $this->Common_Model->getRows($con, 'hr_salaries');
        $salaries = $salaries ? $salaries : array();
        return $salaries; 
    }

     // Get candidates
    public function get_candidates($con = array()) {
        $con['innerJoin'] = array(array(
            'table' => 'hr_job_applications',
            'condition' =>'hr_job_applications.id = hr_job_interview_candidates.job_application_id',
            'joinType' => 'inner'
        ));
        $candidates = $this->Common_Model->getRows($con, 'hr_job_interview_candidates');
        $candidates = $candidates ? $candidates : array();
        return $candidates; 
    }

     // Get interviewers
    public function get_interviewers($con = array()) {
         $con['innerJoin'] = array(array(
            'table' => 'hr_users',
            'condition' =>'hr_users.id = hr_job_interview_interviewers.user_id',
            'joinType' => 'inner'
        ));
        $interviewers = $this->Common_Model->getRows($con, 'hr_job_interview_interviewers');
        $interviewers = $interviewers ? $interviewers : array();
        return $interviewers; 
    }

    // count applications
    public function count_applications ($con = array()) {
        if (empty($con)) {
            $con['conditions'] = array(
                'status' => 1
            );
            $con['returnType'] = 'count';
        }
        $applications = $this->Common_Model->getRows($con, 'hr_job_applications');
        return $applications;
    }

    // Get leaves
    public function get_leaves($con = array()) {
        if (empty($con)) {
             $con['conditions'] = array(
                'status' => 1
            );
        }
        $leaves = $this->Common_Model->getRows($con, 'hr_leaves');
        $leaves = $leaves ? $leaves : array();
        return $leaves; 
    }

     // Get requests for top notifications
    public function get_notifications($con = array()) {
        $user = $this->session->userdata('user');
        $con['selection'] = 'hr_users.name as user_name, hr_roles.name as role, hr_request_types.name as request_name, hr_users.photo, hr_user_requests.description, hr_users.code, hr_user_requests.created as created, hr_user_requests.*, hr_user_requests.id as request_id, hr_user_requests.status as status, hr_user_requests.start_date, hr_user_requests.end_date';
        if ($user['role_id'] == 1) {
            $con['conditions'] = array(
                'hr_request_types.id' => 7,
                'hr_user_requests.status' => 1
            );
            $con['string_or_conditions'] = array(
                "hr_request_types.id = 8 and hr_user_requests.status = 1 or hr_request_types.id = 11 and hr_user_requests.status = 1 or hr_request_types.id = 12 and hr_user_requests.status = 1 or hr_request_types.id = 13 and hr_user_requests.status = 1 or hr_user_requests.status = 1 and hr_user_requests.approved = 1 and hr_user_requests.request_type_id = 1"
            );
        } elseif ($user['role_id'] == 2) {
            $department_id = $user['department_id'];
            $con['conditions'] = array(
                'hr_request_types.id' => 1,
                'hr_user_requests.status' => 1,
                'hr_users.department_id' => $department_id,
                'hr_user_requests.approved' => 0
            );
            $con['string_or_conditions'] = array(
                "hr_request_types.id = 3 and hr_user_requests.status = 1 and hr_users.department_id = $department_id and hr_user_requests.approved = 0 or hr_request_types.id = 5 and hr_user_requests.status = 1 and hr_users.department_id = $department_id and hr_user_requests.approved = 0 or hr_request_types.id = 6 and hr_user_requests.status = 1 and hr_users.department_id = $department_id and hr_user_requests.approved = 0 or hr_request_types.id = 7 and hr_user_requests.status = 1 and hr_users.department_id = $department_id and hr_user_requests.approved = 0 or hr_request_types.id = 8 and hr_user_requests.status = 1 and hr_users.department_id = $department_id and hr_user_requests.approved = 0 or hr_request_types.id = 9 and hr_user_requests.status = 1 and hr_users.department_id = $department_id and hr_user_requests.approved = 0 or hr_request_types.id = 12 and hr_user_requests.status = 1 and hr_users.department_id = $department_id and hr_user_requests.approved = 0 or hr_request_types.id = 13 and hr_user_requests.status = 1 and hr_users.department_id = $department_id and hr_user_requests.approved = 0 or hr_request_types.id = 14 and hr_user_requests.status = 1 and hr_users.department_id = $department_id and hr_user_requests.approved = 0"
            );
  
        } elseif ($user['role_id'] == 3) {
            $con['conditions'] = array(
                'hr_request_types.id' => 10,
                'hr_user_requests.status' => 1
            );
            $con['string_or_conditions'] = array(
                "hr_request_types.id = 14 and hr_user_requests.status = 1"
            );
        } elseif ($user['role_id'] == 4) {
            $user_id = $user['id'];
            $con['conditions'] = array(
                'hr_user_requests.user_id' => $user_id,
                'hr_user_requests.approved' => 1,
                'hr_user_requests.status' => 1
            );
            $con['string_or_conditions'] = array(
                "hr_user_requests.user_id = '$user_id' and hr_user_requests.status = 0 and hr_user_requests.approved = 0"
            );
        } elseif ($user['role_id'] == 5) {
            $con['conditions'] = array(
                'hr_request_types.id' => 2,
                'hr_user_requests.status' => 1
            );
            $con['string_or_conditions'] = array(
                "hr_request_types.id = 6 and hr_user_requests.status = 1 or hr_request_types.id = 9 and hr_user_requests.status = 1"
            );
        } elseif ($user['role_id'] == 6) {
            $con['conditions'] = array(
                'hr_request_types.id' => 5,
                'hr_user_requests.status' => 1
            );
            $con['string_or_conditions'] = array(
                "hr_request_types.id = 7 and hr_user_requests.status = 1 or hr_request_types.id = 8 and hr_user_requests.status = 1 or hr_request_types.id = 9 and hr_user_requests.status = 1 or hr_request_types.id = 12 and hr_user_requests.status = 1 or hr_request_types.id = 13 and hr_user_requests.status = 1"
            );
 
        } elseif ($user['role_id'] == 7) {
            $con['conditions'] = array(
                'hr_request_types.id' => 4,
                'hr_user_requests.status' => 1
            );
            $con['string_or_conditions'] = array(
                "hr_request_types.id = 6 and hr_user_requests.status = 1 or hr_request_types.id = 9 and hr_user_requests.status = 1"
            );
        }
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
        $requests = $this->Common_Model->getRows($con, 'hr_user_requests');
        $requests = $requests ? $requests : array();
        return $requests; 
    }
     // Get requests
    public function get_requests($con = array()) {
        $user = $this->session->userdata('user');
        $con['selection'] = 'hr_users.name as user_name, hr_roles.name as role, hr_request_types.name as request_name, hr_users.photo, hr_user_requests.description, hr_users.code, hr_user_requests.created as created, hr_user_requests.*, hr_user_requests.id as request_id, hr_user_requests.status as status, hr_user_requests.start_date, hr_user_requests.end_date';
        if ($user['role_id'] == 1) {
            $con['conditions'] = array(
                'hr_request_types.id' => 7,
                'hr_user_requests.status' => 1
            );
            $con['string_or_conditions'] = array(
                "hr_request_types.id = 8 and hr_user_requests.status = 1 or hr_request_types.id = 11 and hr_user_requests.status = 1 or hr_request_types.id = 12 and hr_user_requests.status = 1 or hr_request_types.id = 13 and hr_user_requests.status = 1"
            );
        } elseif ($user['role_id'] == 2) {
            $department_id = $user['department_id'];
            $con['conditions'] = array(
                'hr_request_types.id' => 1,
                'hr_users.department_id' => $department_id
            );
            $con['string_or_conditions'] = array(
                "hr_request_types.id = 3 and hr_users.department_id = $department_id or hr_request_types.id = 5 and hr_users.department_id = $department_id or hr_request_types.id = 6 and hr_users.department_id = $department_id or hr_request_types.id = 7 and hr_users.department_id = $department_id or hr_request_types.id = 8 and hr_users.department_id = $department_id or hr_request_types.id = 9 and hr_users.department_id = $department_id or hr_request_types.id = 12 and hr_users.department_id = $department_id or hr_request_types.id = 13 and hr_users.department_id = $department_id or hr_request_types.id = 14 and hr_users.department_id = $department_id"
            );
  
        } elseif ($user['role_id'] == 3) {
            $con['conditions'] = array(
                'hr_request_types.id' => 10,
                'hr_user_requests.status' => 1
            );
            $con['string_or_conditions'] = array(
                "hr_request_types.id = 14 and hr_user_requests.status = 1"
            );
        } elseif ($user['role_id'] == 4) {
            $user_id = $user['id'];
            $con['conditions'] = array(
                'hr_user_requests.user_id' => $user_id,
                'hr_user_requests.approved' => 1,
                'hr_user_requests.status' => 1
            );
            $con['string_or_conditions'] = array(
                "hr_user_requests.user_id = '$user_id' and hr_user_requests.status = 0 and hr_user_requests.approved = 0"
            );
        } elseif ($user['role_id'] == 5) {
            $con['conditions'] = array(
                'hr_request_types.id' => 2,
                'hr_user_requests.status' => 1
            );
            $con['string_or_conditions'] = array(
                "hr_request_types.id = 6 and hr_user_requests.status = 1 or hr_request_types.id = 9 and hr_user_requests.status = 1"
            );
        } elseif ($user['role_id'] == 6) {
            $con['conditions'] = array(
                'hr_request_types.id' => 5,
                'hr_user_requests.status' => 1
            );
            $con['string_or_conditions'] = array(
                "hr_request_types.id = 7 and hr_user_requests.status = 1 or hr_request_types.id = 8 and hr_user_requests.status = 1 or hr_request_types.id = 9 and hr_user_requests.status = 1 or hr_request_types.id = 12 and hr_user_requests.status = 1 or hr_request_types.id = 13 and hr_user_requests.status = 1"
            );
 
        } elseif ($user['role_id'] == 7) {
            $con['conditions'] = array(
                'hr_request_types.id' => 4,
                'hr_user_requests.status' => 1
            );
            $con['string_or_conditions'] = array(
                "hr_request_types.id = 6 and hr_user_requests.status = 1 or hr_request_types.id = 9 and hr_user_requests.status = 1"
            );
        }
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
        $requests = $this->Common_Model->getRows($con, 'hr_user_requests');
        $requests = $requests ? $requests : array();
        return $requests; 
    }


    // Get all times
    public function get_users($con = array()) {
        $users = $this->Common_Model->getRows($con, 'hr_users');
        $users = $users ? $users : array();
        return $users; 
    }


    public function error($path) {
        $this->session->set_flashdata('danger', array('message' => 'Something went wrong. Please try again.'));
        redirect($path);
    }

    public function get_user($id) {
        $con['returnType'] = 'single';
        $con['selection'] = 'hr_users.*, hr_designations.name as designation, hr_departments.name as department, hr_salaries.*, hr_leaves.*';
        $con['conditions'] = array(
            'hr_users.id' => $id,
            'hr_users.status' => 1
        );
        $con['innerJoin'] = array(array(
            'table' => 'hr_designations',
            'condition' =>'hr_users.designation_id = hr_designations.id',
            'joinType' => 'left'
        ),array(
            'table' => 'hr_departments',
            'condition' =>'hr_users.department_id = hr_departments.id',
            'joinType' => 'left'
        ),array(
            'table' => 'hr_salaries',
            'condition' =>'hr_users.id = hr_salaries.user_id',
            'joinType' => 'left'
        ),array(
            'table' => 'hr_leaves',
            'condition' =>'hr_users.id = hr_leaves.user_id',
            'joinType' => 'left'
        ));
        $user = $this->Common_Model->getRows($con, 'hr_users');
        $user = $user ? $user : array();
        return $user;
    }

     public function get_user_educations($id) {
        $con['selection'] = 'hr_educations.*';
        $con['conditions'] = array(
            'user_id' => $id
        );
        $educations = $this->Common_Model->getRows($con, 'hr_educations');
        $educations = $educations ? $educations : array();
        return $educations;
    }



    // email for localhost
    function sendMail($userData)
    {
        $this->load->library('encrypt');
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.mailgun.org';
        $config['smtp_port'] = '465';
        $config['smtp_timeout'] = '30';
        $config['smtp_user'] = 'postmaster@sandbox97aac6780c214217a9eb0f8788aca5c4.mailgun.org';
        $config['smtp_pass'] = 'haqnawaz';
        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n";

        
        $this->load->library('email', $config);
        $this->email->from('hrms@gmail.com'); // change it to yours
        $this->email->to($userData['email']);// change it to yours
        $this->email->subject($userData['subject']);
        $this->email->message($userData['message']);
        if($this->email->send())
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    // email for server

/*    function sendMail($userData)
    {
        $this->load->library('encrypt');
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://core32.hostingmadeeasy.com';
        $config['smtp_port'] = '465';
        $config['smtp_timeout'] = '30';
        $config['smtp_user'] = 'info@graanahub.com';
        $config['smtp_pass'] = 'YIq5L%A@xh^?';
        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n";

        
        $this->load->library('email', $config);
        $this->email->from('hrms@amazonmall.pk'); // change it to yours
        $this->email->to($userData['email']);// change it to yours
        $this->email->subject($userData['subject']);
        $this->email->message($userData['message']);
        if($this->email->send())
        {
            return true;
        }
        else
        {
            return false;
        }

    }*/

      public function upload_single_file()
        {
                $config['upload_path']          = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/";
                $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf';
                $config['max_size']             = 5000;
                $config['max_width']            = 4024;
                $config['max_height']           = 4068;
                $config['encrypt_name']         = TRUE;

                $this->load->library('upload', $config);

                    if (!empty($_FILES['userfile']['name']))
                    {

                        if (!$this->upload->do_upload())
                        {
                            
                            exit('Only jpg, png and gif formats are supported.');

                        } else {
                            return $this->upload->data('file_name');
                        }
                    }  else {
                        return false;
                    }


            }

        public function upload_picture()
        {
                $config['upload_path']          = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/";
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 5000;
                $config['max_width']            = 4024;
                $config['max_height']           = 4068;
                $config['encrypt_name']         = TRUE;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                    if (!empty($_FILES['userpicture']['name']))
                    {

                        if (!$this->upload->do_upload())
                        {
                            
                            exit('Only jpg, png and gif formats are supported.');

                        } else {
                            return $this->upload->data('file_name');
                        }
                    }  else {
                        return false;
                    }


            }

        /*
        * upload multiple files.
        */
        public function upload_multiple_files()
        {
                $config['upload_path']          = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/";
                $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf';
                $config['max_size']             = 5000;
                $config['max_width']            = 4024;
                $config['max_height']           = 4068;
                $config['encrypt_name']         = TRUE;
                $uploaded_path = array();

                $this->load->library('upload', $config);

                $files = $_FILES;
                $ctf = count($_FILES['userfile']['name']);
                  for($i=0; $i < $ctf; $i++)  //fieldname 
                {

                    $_FILES['userfile']['name']= $files['userfile']['name'][$i];
                    $_FILES['userfile']['type']= $files['userfile']['type'][$i];
                    $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
                    $_FILES['userfile']['error']= $files['userfile']['error'][$i];
                    $_FILES['userfile']['size']= $files['userfile']['size'][$i];

                    if (!empty($_FILES['userfile']['name']))
                    {

                        if (!$this->upload->do_upload())
                        {
                            return false;

                        } else {
                            $uploaded_path[$i] = $this->upload->data('file_name');
                            $this->upload->initialize($config);
                        }
                    }else {
                        return false;
                    }


            }
            return $uploaded_path;

        }

        public function time2str($ts) {
            if(!ctype_digit($ts)) {
                $ts = strtotime($ts);
            }
            $diff = time() - $ts;
            if($diff == 0) {
                return 'now';
            } elseif($diff > 0) {
                $day_diff = floor($diff / 86400);
                if($day_diff == 0) {
                    if($diff < 60) return 'just now';
                    if($diff < 120) return '1 minute ago';
                    if($diff < 3600) return floor($diff / 60) . ' minutes ago';
                    if($diff < 7200) return '1 hour ago';
                    if($diff < 86400) return floor($diff / 3600) . ' hours ago';
                }
                if($day_diff == 1) { return 'Yesterday'; }
                if($day_diff < 7) { return $day_diff . ' days ago'; }
                if($day_diff < 31) { return ceil($day_diff / 7) . ' weeks ago'; }
                if($day_diff < 60) { return 'last month'; }
                return date('F Y', $ts);
            } else {
                $diff = abs($diff);
                $day_diff = floor($diff / 86400);
                if($day_diff == 0) {
                    if($diff < 120) { return 'in a minute'; }
                    if($diff < 3600) { return 'in ' . floor($diff / 60) . ' minutes'; }
                    if($diff < 7200) { return 'in an hour'; }
                    if($diff < 86400) { return 'in ' . floor($diff / 3600) . ' hours'; }
                }
                if($day_diff == 1) { return 'Tomorrow'; }
                if($day_diff < 4) { return date('l', $ts); }
                if($day_diff < 7 + (7 - date('w'))) { return 'next week'; }
                if(ceil($day_diff / 7) < 4) { return 'in ' . ceil($day_diff / 7) . ' weeks'; }
                if(date('n', $ts) == date('n') + 1) { return 'next month'; }
                return date('F Y', $ts);
            }
        }

}
