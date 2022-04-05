<?php

class PostModel extends CI_Model
{

    public function insertPost($data)
    {
        $this->db->insert('user_post', $data);

        return TRUE;
    }

    public function getAllPosts()
    {

        $this->db->select('*');
        $this->db->from('user_account a');
        $this->db->join('user_post b', 'a.u_username = b.u_username');
        $this->db->order_by('post_created_at', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getUserPost($username)
    {        
        $this->db->select('*');
        $this->db->from('user_post');
        $this->db->join('user_account', 'user_account.u_username = user_post.u_username');
        $this->db->where('user_post.u_username', $username);
        $this->db->order_by('post_created_at', 'DESC');
        $query = $this->db->get();

        return $query->result();
    }

    public function deleteUserPost($postID){
        $this->db->delete('user_post', array('post_id' => $postID));
    }
}
