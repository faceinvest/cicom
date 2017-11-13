<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plane extends Base_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->render('plane');
    }
}