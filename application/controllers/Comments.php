<?php
/**
 * Created by PhpStorm.
 * User: invest
 * Date: 02.11.2017
 * Time: 15:50
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Comments extends Base_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->model('Comment_model');
        $comments = $this->Comment_model->get_last_five_comments();
        $html = $this->get_last_five_comments($comments);
        $this->data += ['comments'=>$html];

        $this->load->model('Theme_model');
        $themes = $this->Theme_model->get_themes();
        $this->data += ['themes'=>$themes];

        $this->render('comments', $this->data);
    }
    public function all_comments()
    {
        $csrf = $this->security->get_csrf_hash();

        $this->load->model('Comment_model');
        $comments = $this->Comment_model->all_comments();
        $html = $this->get_last_five_comments($comments);


        $append = [
            'csrf' => $csrf,
            'result' => $html,
        ];

        echo json_encode($append);
    }


}