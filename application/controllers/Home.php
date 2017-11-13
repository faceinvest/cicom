<?php
/**
 * Created by PhpStorm.
 * User: invest
 * Date: 02.11.2017
 * Time: 13:55
 */

class Home extends Base_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->model('User_model');
        $users = $this->User_model->get_users();
        $data = array('users'=>$users);
        $this->render('home', $data);
    }
}