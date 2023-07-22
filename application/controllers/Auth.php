<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('user_model'); // Carrega o modelo User_Model
    }
    public function index() {
        // Carregar a view "auth/login" e passar os dados das tarefas
        
        $this->load->view('auth/login');
    }
    public function login() {
        // Verifica se o formulário foi submetido
        if ($this->input->post()) {
            // Define as regras de validação para o formulário de login
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');

            // Executa a validação
            if ($this->form_validation->run() === TRUE) {
                $email = $this->input->post('email');
                $password = $this->input->post('password');

                // Verifica se as credenciais são válidas
                $user = $this->user_model->get_user_by_email($email);

                if ($user && password_verify($password, $user['password'])) {
                    // Armazena os dados do usuário na sessão
                    $this->session->set_userdata('user_id', $user['id']);
                    $this->session->set_userdata('email', $user['email']);
                    $this->session->set_userdata('perfil', $user['perfil']);
                    // Verifica se o usuário selecionou a opção "manter conectado"
                    if ($this->input->post('remember_me')) {
                        // Gera um token único para o usuário
                        $token = bin2hex(random_bytes(32));

                        // Define o token no cookie
                        set_cookie(array(
                            'name' => 'remember_me_token',
                            'value' => $token,
                            'expire' => 2592000, // 30 dias (em segundos)
                            'secure' => TRUE
                        ));

                        // Salva o token no banco de dados associado ao usuário
                        $this->user_model->save_remember_me_token($user['id'], $token);
                    }
                    // Redireciona com base no perfil do usuário
                    if ($user['perfil'] == '1') {
                        $redirect = 'admin/dashboard';
                    } else {
                        $redirect = 'tasks';
                    }
                    // Retorna uma resposta JSON indicando sucesso
                    echo json_encode(array('success' => true, "redirect" => $redirect));
                    return;
                } else {
                    // Credenciais inválidas, envia mensagem de erro
                    echo json_encode(array('success' => false, 'message' => 'Credenciais inválidas. Verifique seu email e senha.'));
                    return;
                }
            } else {
                // Erros de validação, envia mensagem de erro
                echo json_encode(array('success' => false, 'message' => validation_errors()));
                return;
            }
        }

        // Resposta padrão caso não receba dados do POST
        echo json_encode(array('success' => false, 'message' => 'Requisição inválida.'));
        return;
    }

    public function logout() {
        // Remove os dados do usuário da sessão
        $this->session->sess_destroy();

        // Redireciona para a página de login após o logout
        redirect('auth/login');
    }

    public function register() {
        // Carrega a página de cadastro de usuários
        $this->load->view('auth/register');
    } 
    public function ajax_register() {
        // Verifica se o formulário foi submetido
        if ($this->input->post()) {
            // Define as regras de validação para o formulário de cadastro
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
    
            // Executa a validação
            if ($this->form_validation->run() === TRUE) {
                // Obtém os valores do formulário
                $email = $this->input->post('email');
                $password = $this->input->post('password');
    
                // Insere o novo usuário no banco de dados
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $data = array(
                    'email' => $email,
                    'password' => $hashed_password
                );
                $this->user_model->insert_user($data);
    
                // Retorna uma resposta JSON indicando sucesso
                echo json_encode(array('success' => true));
                return;
            } else {
                // Erros de validação, envia mensagem de erro
                echo json_encode(array('success' => false, 'message' => validation_errors()));
                return;
            }
        }
    
        // Resposta padrão caso não receba dados do POST
        echo json_encode(array('success' => false, 'message' => 'Requisição inválida.'));
        return;
    }
}