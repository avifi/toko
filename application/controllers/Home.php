<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    protected $theme;
    
    public function __construct() {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('store_model');
        $this->load->model('sosmed_model');
        $this->load->model('feature_model');
        $this->load->library('shopping_cart');
    }

    protected function _init_theme() {
        // Determine active theme from Store sheet (key: tema)
        if (empty($this->theme)) {
             $this->theme = $this->store_model->get('tema', 'tema_modern');
        }
    }
    
    public function index() {
        $this->_init_theme();
        $data['store'] = $this->store_model->get_settings();
        $data['products'] = $this->product_model->get_prime();
        $data['cart_count'] = $this->shopping_cart->total_items();
        $data['sosmed'] = $this->sosmed_model->get_all();
        $data['theme'] = $this->theme;
        $data['seo_title'] = $data['store']['name'];
        $data['seo_description'] = $data['store']['description'];
        $data['seo_image'] = $data['store']['logo'];
        
        $theme_view = ($this->theme ?: 'tema_modern');
        
        $this->load->view($theme_view . '/templates/header', $data);
        $this->load->view($theme_view . '/home', $data);
        $this->load->view($theme_view . '/templates/footer');
    }

    public function about() {
        $this->_init_theme();
        $data['store'] = $this->store_model->get_settings();
        $data['cart_count'] = $this->shopping_cart->total_items();
        $data['sosmed'] = $this->sosmed_model->get_all();
        $data['features'] = $this->feature_model->get_all();
        $data['theme'] = $this->theme;
        $data['title'] = 'Tentang Kami - ' . (isset($data['store']['name']) ? $data['store']['name'] : 'Toko Online');
        $data['seo_title'] = $data['title'];
        $data['seo_description'] = $data['store']['description'];
        $data['seo_image'] = $data['store']['logo'];
        
        $theme_view = ($this->theme ?: 'tema_modern');
        
        $this->load->view($theme_view . '/templates/header', $data);
        $this->load->view($theme_view . '/about', $data);
        $this->load->view($theme_view . '/templates/footer');
    }
}
