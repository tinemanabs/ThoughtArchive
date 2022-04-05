<?php

class UserController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->model('PostModel');
    }


    public function index()
    {
        $title['page'] = "Home";
        $result['data'] = $this->PostModel->getAllPosts();
        
        $this->load->view('layouts/header', $title);
        $this->load->view('home', $result);
        $this->load->view('layouts/footer');
    }

    public function editprofile($uname)
    {
        $title['page'] = "Edit Account";
        $user['data'] = $this->UserModel->getUser($uname);

        $this->load->view('layouts/header', $title);
        $this->load->view('editAccount', $user);
        $this->load->view('layouts/footer');
    }

    public function updateprofile()
    {
        $uname = $this->uri->segment(3);
        $user = $this->UserModel->getUser($uname);
        $this->form_validation->set_rules('fname', 'firstname', 'required');
        $this->form_validation->set_rules('lname', 'lastname', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->editprofile($uname);
        } else {
            $data = array(
                'u_firstname' => $this->input->post('fname'),
                'u_lastname' => $this->input->post('lname'),
            );

            $this->UserModel->updateProfile($uname, $data);
            $this->session->set_flashdata('success', 'Profile Updated Successfully.');


            redirect(base_url('UserController/editprofile/' . $user['u_username']));
        }
    }


    public function changePassword($uname)
    {
        $title['page'] = "Change Password";
        $user['data'] = $this->UserModel->getUser($uname);

        $this->load->view('layouts/header', $title);
        $this->load->view('changepassword', $user);
        $this->load->view('layouts/footer');
    }

    public function updatePassword()
    {

        $this->form_validation->set_rules('oldpw', 'old password', 'required');
        $this->form_validation->set_rules('newpw', 'new password', 'required|min_length[6]');
        $this->form_validation->set_rules('confpw', 'confirm password', 'required|matches[newpw]');

        $uname = $this->uri->segment(3);
        $user = $this->UserModel->getUser($uname);

        if ($this->form_validation->run() == FALSE) {
            $this->changePassword($uname);
        } else {

            $oldpw = $this->input->post('oldpw');
            $data['u_password'] = $this->input->post('newpw');


            if ($user['u_password'] != $oldpw) {
                $this->session->set_flashdata('error', 'Your Current password does not matches with the password you provided. Please try again.');
            } else {

                $this->UserModel->updateProfile($uname, $data);
                $this->session->set_flashdata('success', 'Password Updated Successfully.');
            }

            redirect(base_url('UserController/changePassword/' . $user['u_username']));
        }
    }

    public function logout(){
        session_destroy();

        redirect(base_url('LoginController'));
    }
}
