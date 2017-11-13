<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tu154 extends Base_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->plane = 'Ту154';
    }
}
