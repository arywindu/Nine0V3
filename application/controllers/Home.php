<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function index() {
        $data['title'] = 'VER 3.0 IS COMING SOON - NINE 0 Studio';
        $data['meta_description'] = 'NINE 0 is a design company based in Jakarta and Bali, specializing in creative direction, brand identity, and digital marketing.';
        $this->load->view('home_v3', $data);
    }
    
    public function deck() {
        $data['title'] = 'Company Deck - NINE 0 Studio';
        $data['meta_description'] = 'Download NINE 0 company deck and portfolio presentation.';
        $this->load->view('deck', $data);
    }
    
    public function verify_deck_password() {
        header('Content-Type: application/json');
        
        $password = $this->input->post('password');
        
        // Get deck settings
        $this->db->select('*');
        $this->db->from('deck_settings');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        
        if ($query->num_rows() == 0) {
            echo json_encode([
                'success' => false,
                'message' => 'Deck settings not configured'
            ]);
            return;
        }
        
        $settings = $query->row();
        
        // Check if password expired
        if (strtotime($settings->expires_at) < time()) {
            echo json_encode([
                'success' => false,
                'message' => 'Password has expired. Please contact admin for new password.'
            ]);
            return;
        }
        
        // Verify password
        if (password_verify($password, $settings->password)) {
            echo json_encode([
                'success' => true,
                'deck_url' => $settings->deck_url,
                'expires_at' => date('F d, Y', strtotime($settings->expires_at))
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => '
                '
            ]);
        }
    }
}
