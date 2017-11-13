<?php
/**
 * Created by PhpStorm.
 * User: invest
 * Date: 02.11.2017
 * Time: 16:02
 */

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insert_user($data)
    {
        return $this->db->insert('users', $data);
    }

    public function select_user($where)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    }

    public function auth_user($email)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_user($id)
    {
        $this->db->select('id, name, date, email');
        $this->db->from('users');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_users()
    {
        $this->db->select('id, name');
        $this->db->from('users');
        $query = $this->db->get();
        return $query->result();
    }
}