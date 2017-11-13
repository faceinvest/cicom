<?php
/**
 * Created by PhpStorm.
 * User: invest
 * Date: 02.11.2017
 * Time: 11:38
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends Base_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        if (isset($_POST['login'])) {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'Пароль', 'trim|required');

            if ($this->form_validation->run())
            {
                $this->load->model('User_model');
                if ($result = $this->User_model->auth_user($_POST['email']))
                {
                    if($this->encryption->decrypt($result->password) == $_POST['password'])
                    {
                        $data = array(
                            'is_logged_in' => 1,
                            'id' => $result->id,
                            'login' => $result->name,
                            'date' => $result->date,
                            'email' => $result->email
                        );
                        //записать данные в сессию
                        $this->session->set_userdata($data);
                        redirect(base_url()."users/profile");
                    }
                }

                //добавить редирект с ошибкой неправильно введен логин или пароль
            }
            else
            {
                redirect(base_url()."auth/login");
            }
        }

        $this->render('login');
    }

    public function register()
    {
        if (isset($_POST['register']))
        {

            $this->form_validation->set_rules('login', 'Логин', 'trim|required|min_length[5]|max_length[150]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'Пароль', 'trim|required');
            $this->form_validation->set_rules('passconf', 'Повторение пароля', 'trim|required|min_length[5]|matches[password]');

            if ($this->form_validation->run())
            {

                $data = array(
                    'name'=>$_POST['login'],
                    'date'=>date('Y-m-d H:i:s'),
                    'email'=>$_POST['email'],
                    'password'=>$this->encryption->encrypt($_POST['password']),
                );

                $this->load->model('User_model');
                $this->User_model->insert_user($data);

                $this->session->set_flashdata("success", "Ваша учетная запись зарегистрирована. Вы можете авторизоваться");
                redirect(base_url()."auth/register");
            }
        }
        $this->render('register');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }

}