<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function index() {
        $data['title'] = 'NINE 0 - VER 3.0 IS COMING COON';
        $data['meta_description'] = 'NINE 0 is a design company based in Jakarta and Bali, specializing in creative direction, brand identity, and digital marketing.';
        $this->load->view('home_v3', $data);
    }
    
    public function deck() {
        $data['title'] = 'NINE 0 - Limited Access Portal';
        $data['meta_description'] = 'This page is intended solely for sharing tender-related files of PT Nawa Surya Kharisma. Authorized access only';
        $this->load->view('deck', $data);
    }
    
    public function verify_deck_password() {
        header('Content-Type: application/json');
        
        $password = $this->input->post('password');
        
        // Find deck by password
        $this->db->where('password', $password);
        $query = $this->db->get('deck_settings');
        
        if ($query->num_rows() == 0) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid password'
            ]);
            return;
        }
        
        $deck = $query->row();
        
        // Check if password expired
        if (strtotime($deck->expires_at) < time()) {
            echo json_encode([
                'success' => false,
                'message' => 'This deck access has expired.'
            ]);
            return;
        }
        
        // Success
        echo json_encode([
            'success' => true,
            'deck_url' => $deck->deck_url,
            'expires_at' => date('F d, Y', strtotime($deck->expires_at))
        ]);
    }
}
