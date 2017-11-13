<?php
/**
 * Created by PhpStorm.
 * User: invest
 * Date: 07.11.2017
 * Time: 14:51
 */

class Theme_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_themes($where = FALSE)
    {
        $this->db->select('*');
        $this->db->from('theme');
        if ($where)
        {
            $this->db->where('id', $where);
            return $this->db->get()->row();
        }
        $query = $this->db->get();
        return $query->result();
    }

}