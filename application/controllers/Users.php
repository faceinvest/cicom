<?php
/**
 * Created by PhpStorm.
 * User: invest
 * Date: 02.11.2017
 * Time: 15:52
 */

class Users extends Base_Controller
{
    private $user;

    function __construct()
    {
        parent::__construct();
    }

    public function profile($user_id = FALSE)
    {
        if ($user_id)
        {
            $this->user = $user_id;

            $this->load->model('User_model');
            $result_model = $this->User_model->get_user($this->user);
            $user = new stdClass();
            $user->id = $result_model->id;
            $user->login = $result_model->name;
            $user->date = $result_model->date;
            $user->email = $result_model->email;

            $this->data = ['profile' => $user];

        }
        else
        {
            if ($this->session->userdata('is_logged_in'))
            {
                $this->user = $this->session->userdata('id');

                $user = new stdClass();
                $user->id = $this->session->userdata('id');
                $user->login = $this->session->userdata('login');
                $user->date = $this->session->userdata('date');
                $user->email = $this->session->userdata('email');

                $this->data = ['profile' => $user];
            }
        }

        if (isset($this->user))
        {
            $this->load->model('Comment_model');
            $comments = $this->Comment_model->get_last_five_comments($this->user);
            $count_comments = $this->Comment_model->count_comments($this->user);
            $this->data += ['count_comments'=>$count_comments];

            if (!empty($comments))
            {
                $html = $this->get_last_five_comments($comments);
                $this->data += ['comments'=>$html];
            }

            $this->load->model('Theme_model');
            $themes = $this->Theme_model->get_themes();
            $this->data += ['themes'=>$themes];
        }

        $this->render('profile', $this->data);
    }

    public function comments()
    {
        if ($this->session->userdata('is_logged_in'))
        {
            $this->load->model('Comment_model');
            $comments = $this->Comment_model->user_comments($this->session->userdata('id'));
            $this->data += ['comments'=>$comments];
        }

        $this->render('user_comments', $this->data);
    }

    public function delete_comment()
    {
        $this->load->model('Comment_model');
        $this->Comment_model->delete_comment($_POST['id'], $_POST['parent_id']);

        echo $this->security->get_csrf_hash();
    }

    public function all_comments()
    {
        $csrf = $this->security->get_csrf_hash();

        $this->load->model('Comment_model');
        $result = $this->Comment_model->all_comments($_POST['user_id']);
        $html = $this->get_last_five_comments($result);

        $append = [
            'csrf' => $csrf,
            'result' => $html,
        ];

        echo json_encode($append);
    }

    public function add_comment()
    {
        $csrf = $this->security->get_csrf_hash();

        if (isset($_POST)) {
            $data = new stdClass();
            $data->title = '';
            $data->theme_id = '1';

            if (isset($_POST['title']) AND isset($_POST['theme_id']))
            {
                $data->title = $_POST['title'];
                $data->theme_id = $_POST['theme_id'];
            }

            $data->user_id = $this->session->userdata('id');
            $data->date = date('Y-m-d H:i:s');
            $data->text = $_POST['text'];
            $data->parent_id = $_POST['parent_id'];
            $data->del_com = 1;

            $this->load->model('Comment_model');
            $id = $this->Comment_model->add_comment($data);

            if ($data->title != '')
            {
                $this->load->model('Theme_model');
                $theme = $this->Theme_model->get_themes($data->theme_id);
                $data->theme_name = $theme->theme_name;
            }


            $data->name = $this->session->userdata('login');
            $data->id = $id;
            $comment = ['1'=>$data];
            $append = $this->get_last_five_comments($comment);
        }




        $append = [
            'csrf' => $csrf,
            'append' => $append,
        ];

        echo json_encode($append);
    }

    public function get_reply_form()
    {
        $csrf = $this->security->get_csrf_hash();

        $reply_form = $this->load->view('template/t_reply_form', '', TRUE);

        $append = [
            'csrf' => $csrf,
            'reply_form' => $reply_form,
        ];

        echo json_encode($append);
    }
}