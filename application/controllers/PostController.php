<?php

class PostController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PostModel');
        $this->load->model('UserModel');
        $this->load->helper('date');
    }

    public function store()
    {
        $uname = $this->uri->segment(3);
        //$user = $this->PostModel->getUserID($id);

        $now = time();
        $time = unix_to_human($now);

        $this->form_validation->set_rules('caption', 'caption', 'required|max_length[280]');
        if (empty($_FILES['image']['name'])) {
            $this->form_validation->set_rules('image', 'document', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            $title['page'] = "Home";
            $result['data'] = $this->PostModel->getAllPosts();
            $this->load->view('layouts/header', $title);
            $this->load->view('home', $result);
            $this->load->view('layouts/footer');
        } else {

            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                //$error = array('error' => $this->upload->display_errors());
                $result['data'] = $this->PostModel->getAllPosts();
                $title['page'] = "Home";
                $this->load->view('layouts/header', $title);
                $this->load->view('home', $result);
                $this->load->view('layouts/footer');
            } else {
                $uploadFiles = $this->upload->data();
                $image = $uploadFiles['file_name'];

                $data = array(
                    'u_username' => $uname,
                    'post_caption' => $this->input->post('caption'),
                    'post_img' => $image,
                    'post_created_at' => $time,
                );

                $this->PostModel->insertPost($data);
                $this->session->set_flashdata('success', 'Posted Successfully!');

                redirect(base_url('UserController'));
            }
        }
    }

    public function profile($uname)
    {
        $username = $this->uri->segment(3);
        $title['page'] = "Profile";
        $user['userdata'] = $this->UserModel->getUser($uname);
        $user['data'] = $this->PostModel->getUserPost($username);

        $this->load->view('layouts/header', $title);
        $this->load->view('profile', $user);
        $this->load->view('layouts/footer');
    }

    public function savePost()
    {
        $uname = $this->uri->segment(3);
        //$user = $this->PostModel->getUserID($id);

        $now = time();
        $time = unix_to_human($now);

        $this->form_validation->set_rules('caption', 'caption', 'required|max_length[280]');
        if (empty($_FILES['image']['name'])) {
            $this->form_validation->set_rules('image', 'document', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            $title['page'] = "Profile";
            $result['userdata'] = $this->UserModel->getUser($uname);
            $result['data'] = $this->PostModel->getUserPost($uname);
            $this->load->view('layouts/header', $title);
            $this->load->view('profile', $result);
            $this->load->view('layouts/footer');
        } else {

            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                //$error = array('error' => $this->upload->display_errors());
                $result['userdata'] = $this->UserModel->getUser($uname);
                $result['data'] = $this->PostModel->getUserPost($uname);
                $title['page'] = "Profile";
                $this->load->view('layouts/header', $title);
                $this->load->view('profile', $result);
                $this->load->view('layouts/footer');
            } else {
                $uploadFiles = $this->upload->data();
                $image = $uploadFiles['file_name'];

                $data = array(
                    'u_username' => $uname,
                    'post_caption' => $this->input->post('caption'),
                    'post_img' => $image,
                    'post_created_at' => $time,
                );

                $this->PostModel->insertPost($data);
                $this->session->set_flashdata('success', 'Posted Successfully!');

                redirect(base_url('PostController/profile/') . $uname);
            }
        }
    }


    public function deletePost($postID)
    {
        $uname = $this->uri->segment(3);
        $postID = $this->uri->segment(4);

        $this->PostModel->deleteUserPost($postID);
        $this->session->set_flashdata('deletepost', 'The post has been deleted!');

        redirect(base_url('PostController/profile/') . $uname);
    }
}
