<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_Check
{
    private $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function check_session()
    {
        $controller = $this->CI->router->class;
        $method = $this->CI->router->method;

        $public_routes = array(
            'users',
            'login',
            'register',
        );

        $is_public_route = in_array($controller, $public_routes);

        // Verifica se o usuário não está logado e tenta manter a sessão através do cookie remember_me_token
        if (!$this->CI->session->userdata('user_id') && !$is_public_route) {
            $this->CI->load->model('user_model');
            $token = $this->CI->input->cookie('remember_me_token');
            if ($token) {
                $user = $this->CI->user_model->get_user_by_remember_me_token($token);
                if ($user) {
                    $this->CI->session->set_userdata('user_id', $user['id']);
                    $this->CI->session->set_userdata('email', $user['email']);
                    $this->CI->session->set_userdata('perfil', $user['perfil']);
                } else {
                    delete_cookie('remember_me_token');
                }
            }
        }
    }
}