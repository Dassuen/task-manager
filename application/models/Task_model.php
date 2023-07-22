<?php
class Task_model extends CI_Model {
    function __construct() {
        parent::__construct();
        //$this->load->database();
    }
    public function get_tasks($ordem = "ASC") {
        $this->db->order_by('order', $ordem); // Ordenar as tarefas pelo campo "order" em ordem crescente
        $query = $this->db->get('tasks');
        return $query->result_array();
    }
    public function get_user_tasks($user_id) {
        $query = $this->db->get_where('tasks', array('user_id' => $user_id));
        return $query->result_array();
    }
    public function get_task_by_id($id) {
        // Obter uma tarefa específica pelo ID e retorná-la como um array
        $query = $this->db->get_where('tasks', array('id' => $id));
        return $query->row_array();
    }
    public function get_task_user_id($taskId)
    {
        $this->db->select('user_id');
        $this->db->where('id', $taskId);
        $query = $this->db->get('tasks');
        $result = $query->row();
        return $result->user_id;
    }
    public function create_task($data) {
        // Inserir a nova tarefa no banco de dados
        $data["user_id"] = $this->session->user_id;
        $this->db->insert('tasks', $data);
    }
    public function update_task($taskId, $data)
    {
        $this->db->where('id', $taskId);
        $this->db->update('tasks', $data);
    }
    public function update_task_order($order_array) {
        // Atualizar a ordem das tarefas no banco de dados
        $order = 1;
        foreach ($order_array as $task_id) {
            $this->db->set('order', $order);
            $this->db->where('id', $task_id);
            $this->db->update('tasks');
            $order++;
        }
    }    
    public function delete_task($id) {
        // Excluir uma tarefa específica pelo ID
        $this->db->delete('tasks', array('id' => $id));
    }
}