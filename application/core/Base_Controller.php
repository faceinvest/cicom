<?php
/**
 * Created by PhpStorm.
 * User: invest
 * Date: 02.11.2017
 * Time: 11:33
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Base_Controller extends CI_Controller
{
    protected $act;
    protected $plane;
    protected $csrf;

    public $data = array();

    function __construct()
    {
        parent::__construct();

        $this->csrf = $this->security->get_csrf_hash();
    }

    public function getTakeoff()
    {
        $this->act = "Взлет";
        $this->action();
    }

    public function getLanding()
    {
        $this->act = "Посадка";
        $this->action();    }

    protected function action()
    {
        $action = $this->plane.': '.$this->act;
        $append = [
            'csrf' => $this->csrf,
            'action' => $action
        ];

        echo json_encode($append);
    }


    protected function render($content, $data = FALSE)
    {
        $this->data = array('content'=>$content);

        if ($data)
        {
            $this->data += $data;
        }

        $this->load->view('layouts/layouts', $this->data);
    }

    protected function get_last_five_comments($comments)
    {
        $html = '';
        foreach ($comments as $comment)
        {
            if ($comment->del_com == 1 || isset($comment->subComments))
            {
                $html .= '<li class="li-com" id="'.$comment->id.'">';
                $html .= $this->load->view('template/t_comment', ['comment'=>$comment], true);
                $html .= '<ul class="media-list" id="sub_comments">';
                if(isset($comment->subComments))
                {
                    $html .= $this->get_last_five_comments($comment->subComments);
                }
                $html .= '</ul>';
                $html .= '</li>';
            }
        }
        return $html;
    }
}