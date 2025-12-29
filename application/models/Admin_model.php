<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function login($username, $password) {
        $user = $this->db->get_where('admins', array('username' => $username))->row();
        if ($user && password_verify($password, $user->password)) {
            // Update last login
            $this->db->where('id', $user->id);
            $this->db->update('admins', array('last_login' => date('Y-m-d H:i:s')));
            return $user;
        }
        return false;
    }
    
    public function get_by_id($id) {
        return $this->db->get_where('admins', array('id' => $id))->row();
    }
    
    public function change_password($id, $new_password) {
        $data = array('password' => password_hash($new_password, PASSWORD_DEFAULT));
        $this->db->where('id', $id);
        return $this->db->update('admins', $data);
    }
    
    public function verify_password($id, $password) {
        $user = $this->get_by_id($id);
        return $user && password_verify($password, $user->password);
    }
}
