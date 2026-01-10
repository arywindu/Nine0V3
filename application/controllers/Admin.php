<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->model('Portfolio_model');
        $this->load->library('session');
        $this->load->helper('url');
    }
    
    public function login() {
        if ($this->session->userdata('admin_logged_in')) {
            redirect('admin/dashboard');
        }
        
        if ($this->input->post()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            
            $user = $this->Admin_model->login($username, $password);
            if ($user) {
                $this->session->set_userdata('admin_logged_in', true);
                $this->session->set_userdata('admin_id', $user->id);
                redirect('admin/dashboard');
            } else {
                $data['error'] = 'Invalid credentials';
            }
        }
        
        $data['title'] = 'Admin Login';
        $this->load->view('admin/login', $data);
    }
    
    public function dashboard() {
        $this->check_login();
        $data['title'] = 'Dashboard';
        $data['total_portfolios'] = count($this->Portfolio_model->get_all());
        $data['active_portfolios'] = count($this->Portfolio_model->get_all('active'));
        $this->load->view('admin/dashboard', $data);
    }
    
    public function portfolio() {
        $this->check_login();
        
        if ($this->input->post('action') == 'add') {
            // Debug: Log POST data
            log_message('debug', 'Add portfolio POST data: ' . print_r($_POST, true));
            log_message('debug', 'Add portfolio FILES data: ' . print_r($_FILES, true));
            $this->handle_portfolio_save();
        }
        
        if ($this->input->post('action') == 'edit') {
            // Debug: Log POST data
            log_message('debug', 'Edit portfolio POST data: ' . print_r($_POST, true));
            log_message('debug', 'Edit portfolio FILES data: ' . print_r($_FILES, true));
            $this->handle_portfolio_save($this->input->post('id'));
        }
        
        if ($this->input->post('action') == 'delete') {
            $this->Portfolio_model->delete($this->input->post('id'));
            redirect('admin/portfolio');
        }
        
        $data['title'] = 'Portfolio Management';
        $data['portfolios'] = $this->Portfolio_model->get_all();
        $this->load->view('admin/portfolio_new', $data);
    }
    
    public function get_portfolio($id) {
        $this->check_login();
        
        try {
            $portfolio = $this->Portfolio_model->get_by_id($id);
            if ($portfolio) {
                // Ensure all properties exist
                $portfolio->title = $portfolio->title ?? '';
                $portfolio->description = $portfolio->description ?? '';
                $portfolio->category = $portfolio->category ?? '';
                $portfolio->client = $portfolio->client ?? '';
                $portfolio->year = $portfolio->year ?? date('Y');
                $portfolio->url = $portfolio->url ?? '';
                $portfolio->status = $portfolio->status ?? 'active';
                
                // Get images
                $images = [];
                if (isset($portfolio->images) && $portfolio->images) {
                    $images = json_decode($portfolio->images, true) ?: [];
                }
                $portfolio->images = $images;
                
                header('Content-Type: application/json');
                echo json_encode($portfolio);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Portfolio not found']);
            }
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Server error: ' . $e->getMessage()]);
        }
        exit;
    }
    
    public function profile() {
        $this->check_login();
        
        if ($this->input->post('action') == 'change_password') {
            $current = $this->input->post('current_password');
            $new = $this->input->post('new_password');
            $confirm = $this->input->post('confirm_password');
            
            if ($new !== $confirm) {
                $data['error'] = 'New passwords do not match';
            } elseif (!$this->Admin_model->verify_password($this->session->userdata('admin_id'), $current)) {
                $data['error'] = 'Current password is incorrect';
            } else {
                $this->Admin_model->change_password($this->session->userdata('admin_id'), $new);
                $data['success'] = 'Password changed successfully';
            }
        }
        
        $data['title'] = 'Profile Settings';
        $data['admin'] = $this->Admin_model->get_by_id($this->session->userdata('admin_id'));
        $this->load->view('admin/profile', $data);
    }
    
    private function handle_portfolio_save($id = null) {
        $images = [];
        $upload_errors = [];
        
        // Create uploads directory if not exists
        if (!is_dir('./uploads/')) {
            mkdir('./uploads/', 0777, true);
        }
        
        // Debug: Check if files are uploaded
        if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
            $config['max_size'] = 5120; // 5MB
            $config['encrypt_name'] = TRUE;
            
            $this->load->library('upload', $config);
            
            $files = $_FILES['images'];
            $file_count = count($files['name']);
            
            for ($i = 0; $i < $file_count; $i++) {
                if ($files['error'][$i] == 0 && !empty($files['name'][$i])) {
                    $_FILES['file']['name'] = $files['name'][$i];
                    $_FILES['file']['type'] = $files['type'][$i];
                    $_FILES['file']['tmp_name'] = $files['tmp_name'][$i];
                    $_FILES['file']['error'] = $files['error'][$i];
                    $_FILES['file']['size'] = $files['size'][$i];
                    
                    $this->upload->initialize($config);
                    
                    if ($this->upload->do_upload('file')) {
                        $upload_data = $this->upload->data();
                        $images[] = [
                            'image' => $upload_data['file_name'],
                            'caption' => ''
                        ];
                    } else {
                        $upload_errors[] = $this->upload->display_errors();
                    }
                }
            }
        }
        
        $data = array(
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'category' => $this->input->post('category'),
            'client' => $this->input->post('client'),
            'year' => $this->input->post('year'),
            'url' => $this->input->post('url'),
            'status' => $this->input->post('status')
        );
        
        // Only add images column if we have images and column exists
        if (!empty($images)) {
            // Check if images column exists
            $columns = $this->db->list_fields('portfolios');
            if (in_array('images', $columns)) {
                $data['images'] = json_encode($images);
            }
            $data['image'] = $images[0]['image']; // Keep first image as main
        }
        
        // Debug: Log errors if any
        if (!empty($upload_errors)) {
            log_message('error', 'Upload errors: ' . implode(', ', $upload_errors));
        }
        
        if ($id) {
            $this->Portfolio_model->update($id, $data);
        } else {
            $this->Portfolio_model->insert($data);
        }
        
        redirect('admin/portfolio');
    }
    
    public function image_manager() {
        $this->check_login();
        $data['title'] = 'Image Manager';
        $this->load->view('admin/image_manager', $data);
    }
    
    public function update_image_order() {
        $this->check_login();
        
        $input = json_decode(file_get_contents('php://input'), true);
        $portfolio_id = $input['portfolio_id'];
        $images = $input['images'];
        
        $data = array('images' => json_encode($images));
        
        if ($this->Portfolio_model->update($portfolio_id, $data)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update']);
        }
        exit;
    }
    
    public function deck_password() {
        $this->check_login();
        
        if ($this->input->post('action') == 'update') {
            $password = $this->input->post('password');
            $deck_url = $this->input->post('deck_url');
            $expires_days = $this->input->post('expires_days');
            
            $data = array(
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'deck_url' => $deck_url,
                'expires_at' => date('Y-m-d H:i:s', strtotime("+$expires_days days"))
            );
            
            // Check if setting exists
            $this->db->select('id');
            $this->db->from('deck_settings');
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
                // Update
                $this->db->where('id', $query->row()->id);
                $this->db->update('deck_settings', $data);
            } else {
                // Insert
                $this->db->insert('deck_settings', $data);
            }
            
            $data['success'] = 'Deck password updated successfully';
        }
        
        // Get current settings
        $this->db->select('*');
        $this->db->from('deck_settings');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        
        $data['title'] = 'Deck Password Settings';
        $data['settings'] = $query->num_rows() > 0 ? $query->row() : null;
        $this->load->view('admin/deck_password', $data);
    }
    
    public function logout() {
        $this->session->sess_destroy();
        redirect('admin/login');
    }
    
    private function check_login() {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
    }
}
