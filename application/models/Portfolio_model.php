<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portfolio_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_all($status = null) {
        if ($status) {
            $this->db->where('status', $status);
        }
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('portfolios')->result();
    }
    
    public function get_by_id($id) {
        return $this->db->get_where('portfolios', array('id' => $id))->row();
    }
    
    public function insert($data) {
        return $this->db->insert('portfolios', $data);
    }
    
    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('portfolios', $data);
    }
    
    public function delete($id) {
        return $this->db->delete('portfolios', array('id' => $id));
    }
    
    public function get_categories() {
        $this->db->select('category');
        $this->db->distinct();
        $this->db->where('status', 'active');
        return $this->db->get('portfolios')->result();
    }
    
    public function get_images($portfolio_id) {
        $portfolio = $this->get_by_id($portfolio_id);
        if ($portfolio) {
            // Check if images column exists
            $columns = $this->db->list_fields('portfolios');
            if (in_array('images', $columns) && isset($portfolio->images) && $portfolio->images) {
                return json_decode($portfolio->images, true) ?: [];
            }
            // Fallback to single image
            if ($portfolio->image) {
                return [['image' => $portfolio->image, 'caption' => '']];
            }
        }
        return [];
    }
}
