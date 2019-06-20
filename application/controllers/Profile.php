<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Check_Logged {

	function __construct() {
        parent::__construct();
        $this->user = $this->session->userdata('user');      
    }

    // Get all archive activities
	public function index()
	{


        $data['profile'] = $this->get_user($this->user['id']);
        $data['educations'] = $this->get_user_educations($this->user['id']);
        $dependant_con['conditions'] = array(
            'user_id' => $this->user['id']
        );
        $data['dependants'] = $this->get_dependants($dependant_con);
        $picture_con['conditions'] = array(
            'user_id' => $this->user['id']
        );
        $data['pictures'] = $this->get_pictures($picture_con);

        $this->load->view('profile/profile', $data);
	}

    public function view($id) {
        $data['profile'] = $this->get_user($id);
        $data['educations'] = $this->get_user_educations($id);
        $dependant_con['conditions'] = array(
            'user_id' => $id
        );
        $data['dependants'] = $this->get_dependants($dependant_con);
        $picture_con['conditions'] = array(
            'user_id' => $id
        );
        $data['pictures'] = $this->get_pictures($picture_con);

        $this->load->view('profile/profile', $data);
    }

      // Get all archive activities
    public function edit()
    {
        $data['profile'] = $this->get_user($this->user['id']);
        $data['educations'] = $this->get_user_educations($this->user['id']);
        $dependant_con['conditions'] = array(
            'user_id' => $this->user['id']
        );
        $data['dependants'] = $this->get_dependants($dependant_con);
        $picture_con['conditions'] = array(
            'user_id' => $this->user['id']
        );
        $data['pictures'] = $this->get_pictures($picture_con);
        $this->load->view('profile/edit_profile', $data);
    }

    
    public function update() {

        if ($this->input->post('submitProfile')) {
                $this->form_validation->set_rules('name', 'name', 'required');
                $this->form_validation->set_rules('email', 'email', 'required');
                $this->form_validation->set_rules('gender', 'gender', 'required');
                $this->form_validation->set_rules('dob', 'Date of birth', 'required');

                $userData = array(
                    'name' => strip_tags($this->input->post('name')),
                    'email' => strip_tags($this->input->post('email')),
                    'gender' => strip_tags($this->input->post('gender')),
                    'dob' => date('Y-m-d', strtotime($this->input->post('dob'))),
                    'address' => strip_tags($this->input->post('address')),
                    'city' => strip_tags($this->input->post('city')),
                    'mobile_no' => strip_tags($this->input->post('mobile_no'))
                );

                $userfiles = $_FILES['userfile'];


                if (!empty($_FILES['userpicture']['name'])) {
                    $_FILES['userfile'] = $_FILES['userpicture'];
                    $upload_picture = $this->upload_picture();
                    if (! $upload_picture) {
                        $this->session->set_flashdata('warning', array('message' => 'Something went wrong. Image not uploaded successfully.'));
                        redirect('edit');
                    }
                    $userData['photo'] = $upload_picture;
                    // update session
                    $this->user['photo'] = $upload_picture;
                } else {
                    unset($userData['photo']);
                }

                $_FILES['userfile'] = $userfiles;

                 

                if ($this->form_validation->run() == true) {

                   $condition = array('id' => $this->user['id']);
                    $update = $this->Common_Model->update($userData, $condition, 'hr_users');
                    
                    $this->session->set_userdata('user',$this->user);

                    if ($update) {
                        $degree_title = $this->input->post('degree_title');
                        $condition = array('user_id' => $this->user['id']);
                        $this->Common_Model->delete($condition, 'hr_educations');

                        foreach ($degree_title as $key => $value) {
                            $userData = array(
                                'user_id' => $this->user['id'],
                                'university_name' => strip_tags($_POST['university_name'][$key]),
                                'degree_title' => strip_tags($_POST['degree_title'][$key]),
                                'major_subjects' => strip_tags($_POST['major_subjects'][$key]),
                                'start_date' => date('Y-m-d', strtotime($_POST['start_date'][$key])),
                                'end_date' => date('Y-m-d', strtotime($_POST['end_date'][$key])),
                                'status' => 1
                            );
                            $this->Common_Model->insert($userData, 'hr_educations');


                        } 
                        $this->store_dependants($this->user['id']);
                        if (!empty($_FILES['userfile']['name'][0])) {
                            $this->upload_path = $this->upload_multiple_files();
                            $this->store_user_pictures($this->user['id']);
                        }
                         $this->session->set_flashdata('success', array('message' => 'Record updated successfully.'));
                         redirect('Profile');  
                    }
                    
                } else {
                    $this->session->set_flashdata('danger', array('message' => 'Something went wrong. Please try again.'));

                    $data['profile'] = $this->get_user($this->user['id']);
                    $data['educations'] = $this->get_user_educations($this->user['id']);
                    $this->load->view('profile/edit_profile', $data);
                }

        }
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
            $this->session->set_flashdata('warning', array('message' => 'Something went wrong. Doc Images not uploaded successfully.'));
            return false;
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
    public function update_image() {
        $upload_path = $this->upload_single_file();
        if ($upload_path) {
            $condition = array('id' => $this->user['id']);
            $userData = array(
                'photo_path' => $upload_path
            );
             $update = $this->Common_Model->update($userData, $condition, 'pms_users');
             if ($update) {
            $this->session->set_flashdata('success', array('message' => 'Record updated successfully.'));
            $user = $this->session->userdata('user');
            $user['photo_path'] = $upload_path;
            $this->session->set_userdata('user', $user);
            redirect('Profile');  
            }

        } else {
               $this->session->set_flashdata('danger', array('message' => 'Please select an image.'));
                redirect('Profile'); 
            }
    }
    


   
}

