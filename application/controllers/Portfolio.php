<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portfolio extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Portfolio_model');
    }
    
    public function index() {
        $data['title'] = 'Portfolio - NINE 0 Studio';
        $data['meta_description'] = 'Explore our creative portfolio featuring brand identity, digital marketing, and web development projects.';
        $data['portfolios'] = $this->Portfolio_model->get_all();
        $data['categories'] = $this->Portfolio_model->get_categories();
        $this->load->view('portfolio/index', $data);
    }
    
    public function detail($id) {
        $portfolio = $this->Portfolio_model->get_by_id($id);
        if (!$portfolio) {
            show_404();
        }
        
        $data['title'] = $portfolio->title . ' - NINE 0 Studio';
        $data['meta_description'] = substr($portfolio->description, 0, 160);
        $data['portfolio'] = $portfolio;
        $this->load->view('portfolio/detail', $data);
    }
}
