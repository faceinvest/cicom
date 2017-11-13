<?php
/**
 * Created by PhpStorm.
 * User: invest
 * Date: 02.11.2017
 * Time: 10:44
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Migrate extends CI_Controller
{
    public function index()
    {
        $this->load->library('migration');

        if ($this->migration->current() === FALSE)
        {
            show_error($this->migration->error_string());
        }
        else
        {
            $this->session->set_flashdata('success', 'Миграции выполнены успешно');
        }

        $this->load->view('migrate');
    }
}