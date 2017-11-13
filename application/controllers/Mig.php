<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mig extends Base_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->plane = "Миг";
    }

    public function getAttack()
    {
        $this->act = "Атака";
        $this->action();
    }
}