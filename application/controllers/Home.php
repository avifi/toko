<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('store_model');
        $this->load->library('cart');
    }
    
    public function index() {
        $data['store'] = $this->store_model->get_settings();
        $data['categories'] = $this->category_model->get_all();
        $data['products'] = $this->product_model->get_all();
        $data['cart_count'] = $this->cart->total_items();
        
        $this->load->view('templates/header', $data);
        $this->load->view('home', $data);
        $this->load->view('templates/footer');
    }
}
