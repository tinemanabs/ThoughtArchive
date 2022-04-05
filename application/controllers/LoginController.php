<?php

class LoginController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
    }

    public function index()
    {
        $title['page']= "Login";
        $this->load->view('layouts/header', $title);
        $this->load->view('auth/login');
        $this->load->view('layouts/footer');
    }

    public function loginUser()
    {

        $this->form_validation->set_rules('uname', 'username', 'required');
        $this->form_validation->set_rules('pwd', 'password', 'required');

        $uname = $this->input->post('uname');
        $pwd = $this->input->post('pwd');


        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {

            $user = $this->UserModel->getUser($uname);

            if (($user['u_username'] == $uname) && ($user['u_password'] == $pwd)) {
                if ($user['u_status'] == 1) {

                    $this->session->set_userdata('userID', $user['u_ID']);
                    $this->session->set_userdata('firstname', $user['u_firstname']);
                    $this->session->set_userdata('lastname', $user['u_lastname']);
                    $this->session->set_userdata('username', $user['u_username']);
                    $this->session->set_userdata('email', $user['u_email']);
                    $this->session->set_userdata('password', $user['u_password']);

                    redirect(base_url('UserController'));
                } else {
                    $this->session->set_flashdata('warning', 'Please verify your email address.');
                    redirect(base_url('LoginController'));
                }
            } else {
                $this->session->set_flashdata('error', 'Invalid login credentials! Verify your username and password.');
                redirect(base_url('LoginController'));
            }
        }
    }
}
