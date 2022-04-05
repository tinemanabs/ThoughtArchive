<?php

class RegisterController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->helper('string');

        //$this->data['users'] = $this->users_model->getAllUsers();
    }

    public function index()
    {
        $title['page'] = "Registration";
        $this->load->view('layouts/header', $title);
        $this->load->view('auth/register');
        $this->load->view('layouts/footer');
    }

    public function store()
    {
        $this->form_validation->set_rules('fname', 'first name', 'required|alpha');
        $this->form_validation->set_rules('lname', 'last name', 'required|alpha');
        $this->form_validation->set_rules('uname', 'username', 'required|is_unique[user_account.u_username]',  array('is_unique' => 'Username has already been taken.')); //add unique value
        $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[user_account.u_email]', array('is_unique' => 'Email has already been taken.')); //add unique value
        $this->form_validation->set_rules('pwd', 'password', 'required|min_length[6]');
        $this->form_validation->set_rules('cpwd', 'confirm password', 'required|matches[pwd]');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $vcode = random_string('md5');
            $data = array(
                'u_firstname' => $this->input->post('fname'),
                'u_lastname' => $this->input->post('lname'),
                'u_username' => $this->input->post('uname'),
                'u_email' => $this->input->post('email'),
                'u_password' => $this->input->post('pwd'),
                'u_vcode' => $vcode,
            );

            //$userid = $this->UserModel->insertData($data);

            //set up email

            $mail_config['smtp_host'] = 'smtp.gmail.com';
            $mail_config['smtp_port'] = '587';
            $mail_config['smtp_user'] = '###'; // insert test email 
            $mail_config['_smtp_auth'] = TRUE;
            $mail_config['smtp_pass'] = '###'; // insert pw
            $mail_config['smtp_crypto'] = 'tls';
            $mail_config['protocol'] = 'smtp';
            $mail_config['mailtype'] = 'html';
            $mail_config['send_multipart'] = FALSE;
            $mail_config['charset'] = 'utf-8';
            $mail_config['wordwrap'] = TRUE;

            $message =     "
            <html>
            <head>
                <title>Verification Code</title>
            </head>
            <body>
                <h2>Thank you for Registering.</h2>
                <p>Please click the link below to activate your account.</p>
                <h4><a href='" . base_url() . "RegisterController/activate/" . $data['u_vcode'] . "'>Activate My Account</a></h4>
            </body>
            </html>
            ";

            $this->load->library('email', $mail_config);
            $this->email->set_newline("\r\n");
            $this->email->from($mail_config['smtp_user'], 'Thought Archive');
            $this->email->to($data['u_email']);
            $this->email->subject('Thought Archive Signup Verification Email');
            $this->email->message($message);

            //sending email
            if (!$this->email->send()) {
                $this->session->set_flashdata('error', 'Something went wrong. Please try again!');
            } else {
                $this->UserModel->insertData($data);
                $this->session->set_flashdata('success', 'Activation code sent to email');
            }

            redirect(base_url('RegisterController'));
        }
    }


    public function activate()
    {
        //$id = $this->uri->segment(3);
        $uvcode = $this->uri->segment(3);

        $user = $this->UserModel->getCode($uvcode);

        if ($user['u_vcode'] == $uvcode) {
            $data['u_status'] = 1;
            $this->UserModel->updateStatus($uvcode, $data);

            $title['page'] = "Email Verification";
            $this->load->view('layouts/header', $title);
            $this->load->view('email/activate');
            $this->load->view('layouts/footer');
        } else {
            $title['page'] = "Email Verification";
            $this->load->view('layouts/header', $title);
            $this->load->view('email/unverified');
            $this->load->view('layouts/footer');
        }
    }
}
