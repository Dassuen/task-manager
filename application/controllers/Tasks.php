<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Tasks extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        // Carregar o modelo "Task_model"
        $this->load->model('Task_model');
    }
    public function index() {
        // Verifica se o usuário está logado
        if (!$this->session->userdata('user_id')) {
            redirect('auth');
            return;
        }

        // Obtém o ID do usuário logado
        $user_id = $this->session->userdata('user_id');

        // Carrega as tarefas associadas ao usuário logado
        $this->load->model('task_model');
        $data['tasks'] = $this->task_model->get_user_tasks($user_id);

        // Carrega a view com as tarefas
        $this->load->view('tasks/list', $data);
    }

    public function create() {
        // Carregar a visão "tasks/create"
        $this->load->view('tasks/create');
    }
    public function edit_task()
    {
        // Verificar se o usuário está logado
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
        
        $post = $this->input->post();
        $taskId = $post['editTaskId'];
        // Verificar se o usuário tem permissão para editar a tarefa
        $userId = $this->session->userdata('user_id');
        $task = $this->Task_model->get_task_by_id($taskId);

        if (!$task || $task['user_id'] !== $userId) {
            // O usuário não tem permissão para editar esta tarefa
            redirect('tasks');
        }

        // Obter os dados do formulário enviado via AJAX
        $taskTitle = $post['editTaskTitle'];
        $taskStatus = $post['editTaskStatus'];

        // Atualizar os dados da tarefa no banco de dados
        $data = array(
            'title' => $taskTitle,
            'status' => $taskStatus
        );

        $this->Task_model->update_task($taskId, $data);

        // Responder com uma mensagem de sucesso ou erro, conforme necessário
        echo json_encode(["msg" => "Tarefa atualizada com sucesso!"]);
    }
    public function store() {
        // Obter os dados do formulário
        $data = array(
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'due_date' => $this->input->post('due_date')
        );

        // Carregar o modelo "Task_model" e salvar a nova tarefa no banco de dados
        $this->load->model('Task_model');
        $this->Task_model->create_task($data);

        // Redirecionar de volta para a lista de tarefas
        redirect('tasks');
    }

    public function show($id) {
        // Carregar o modelo "Task_model" e obter a tarefa pelo ID
        $this->load->model('Task_model');
        $data['task'] = $this->Task_model->get_task_by_id($id);

        // Carregar a visão "tasks/show" e passar os dados da tarefa
        $this->load->view('tasks/show', $data);
    }

    public function delete($taskId) {
        // Obter o ID do usuário logado
        $userId = $this->session->userdata('user_id');
        // Verificar se o usuário está logado e tem permissão para excluir a tarefa
        if (!$userId) {
            // O usuário não está logado, redirecionar para a página de login ou mostrar uma mensagem de erro
            redirect('auth/login');
            return;
        }
        // Obter o ID do usuário associado à tarefa
        $taskUserId = $this->Task_model->get_task_user_id($taskId);

        if ($taskUserId != $userId) {
            // O usuário não tem permissão para excluir esta tarefa
            // Aqui você pode redirecionar para outra página ou retornar um JSON com uma mensagem de erro
            echo json_encode(['success' => false, 'message' => 'Você não tem permissão para excluir esta tarefa.']);
            return;
        }

        // O usuário tem permissão, prosseguir com a exclusão da tarefa
        $this->Task_model->delete_task($taskId);

        // Retornar um JSON com uma mensagem de sucesso
        echo json_encode(['success' => true, 'message' => 'Tarefa excluída com sucesso.']);
    }

    public function sort() {
        // Verificar se a requisição é do tipo AJAX
        if ($this->input->is_ajax_request()) {
            // Obter a ordem das tarefas do POST
            $taskOrder = $this->input->post('order');
            var_dump($taskOrder);
            // Atualizar a ordem das tarefas no banco de dados
            if ($taskOrder) {                
                // Atualizar a ordem das tarefas no banco de dados
                $this->Task_model->update_task_order($taskOrder);
            }
            // Retornar uma resposta de sucesso (opcional, dependendo da implementação)
            echo json_encode(array('success' => true));
        } else {
            // Se a requisição não for do tipo AJAX, redirecionar para a lista de tarefas
            redirect('tasks');
        }
    }
}