<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function index() {
        $data['title'] = 'VER 3.0 IS COMING SOON - NINE 0 Studio';
        $data['meta_description'] = 'NINE 0 is a design company based in Jakarta and Bali, specializing in creative direction, brand identity, and digital marketing.';
        $this->load->view('home_v3', $data);
    }
}
