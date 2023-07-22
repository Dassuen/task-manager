<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_user_by_email($email) {
        // Busca o usuário pelo email na tabela "users"
        $query = $this->db->get_where('users', array('email' => $email));
        return $query->row_array();
    }
    public function insert_user($data) {
            $data['perfil'] = 0; // Define o perfil padrão como 'guest'
            $this->db->insert('users', $data);
            return $this->db->insert_id();
    }
    public function save_remember_me_token($user_id, $token) {
        $this->db->where('id', $user_id);
        $this->db->update('users', array('remember_me_token' => $token));
    }
}