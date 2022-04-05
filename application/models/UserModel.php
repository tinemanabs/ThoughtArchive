<?php

class UserModel extends CI_Model{

    public function insertData($data){
        $this->db->insert('user_account', $data);

        return TRUE;

        //return $this->db->insert_id();
    }

    public function getAllUsers()
    {
        $query = $this->db->get('user_account');
        return $query->result();
    }
    
    public function getUser($uname){
        $query = $this->db->get_where('user_account', array('u_username' => $uname));
        return $query->row_array();
    }

    public function getCode($vcode){
        $query = $this->db->get_where('user_account', array('u_vcode' => $vcode));
        return $query->row_array();
    }

    public function updateStatus($vcode, $data){
        $this->db->where('u_vcode', $vcode);
        $this->db->update('user_account', $data);
        
    }

    public function loginData($uname, $pwd){
        $array = array('u_username' => $uname, 'u_password' => $pwd);
        $this->db->where($array);
        $query = $this->db->get('user_account');

        return $query->result();
    }

    public function updateProfile($uname, $data){
        $this->db->where('u_username', $uname);
        $this->db->update('user_account', $data);
    }
}
