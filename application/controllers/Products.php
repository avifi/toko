<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
    protected $theme;
    
    public function __construct() {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('store_model');
        $this->load->library('shopping_cart');
    }

    protected function _init_theme() {
        // Determine active theme from Store sheet (key: tema)
        if (empty($this->theme)) {
             $this->theme = $this->store_model->get('tema', 'tema_default');
        }
    }
    
    /**
     * Product listing page
     */
    public function index() {
        $this->_init_theme();
        $category_id = $this->input->get('category');
        $search = $this->input->get('search');
        
        $data['store'] = $this->store_model->get_settings();
        $data['categories'] = $this->category_model->get_all();
        $data['cart_count'] = $this->shopping_cart->total_items();
        $data['theme'] = $this->theme;
        $data['seo_description'] = $data['store']['description'];
        $theme_view = ($this->theme ?: 'tema_default');
        
        if ($category_id) {
            $data['products'] = $this->product_model->get_by_category($category_id);
            $data['current_category'] = $this->category_model->get_by_id($category_id);
            $data['seo_title'] = 'Produk Kami - ' . (isset($data['current_category']['name']) ? $data['current_category']['name'] : 'Toko Online');
            $data['seo_description'] = $data['current_category']['description'];
        } elseif ($search) {
            $data['products'] = $this->product_model->search($search);
            $data['search_term'] = $search;
            $data['seo_title'] = 'Produk Kami - ' . $data['search_term'];
        } else {
            $data['products'] = $this->product_model->get_all();
            $data['seo_title'] = 'Produk Kami - ' . (isset($data['store']['name']) ? $data['store']['name'] : 'Toko Online');
        }
        $data['seo_image'] = $data['store']['logo'];
        
        $this->load->view($theme_view . '/templates/header', $data);
        $this->load->view($theme_view . '/products/index', $data);
        $this->load->view($theme_view . '/templates/footer');
    }
    
    /**
     * Product detail page
     */
    public function detail($slug) {
        $this->_init_theme();
        $data['store'] = $this->store_model->get_settings();
        $data['categories'] = $this->category_model->get_all();
        $data['cart_count'] = $this->shopping_cart->total_items();
        $data['theme'] = $this->theme;
        $theme_view = ($this->theme ?: 'tema_default');
        $data['product'] = $this->product_model->get_by_slug($slug);
        $data['seo_title'] = $data['product']['name'];
        $data['seo_description'] = $data['product']['description'];
        $data['seo_image'] = $data['product']['thumbnail_image'];
        
        if (!$data['product']) {
            show_404();
            return;
        }
        
        $data['images'] = $this->product_model->get_images($data['product']);
        
        // Get category info
        if (isset($data['product']['category_id'])) {
            $data['category'] = $this->category_model->get_by_id($data['product']['category_id']);
        }
        
        // Get related products (same category)
        if (isset($data['product']['category_id'])) {
            $related = $this->product_model->get_by_category($data['product']['category_id']);
            $data['related_products'] = array_filter($related, function($p) use ($slug) {
                return $p['slug'] != $slug;
            });
            $data['related_products'] = array_slice($data['related_products'], 0, 4);
        } else {
            $data['related_products'] = array();
        }
        
        $this->load->view($theme_view . '/templates/header', $data);
        $this->load->view($theme_view . '/products/detail', $data);
        $this->load->view($theme_view . '/templates/footer');
    }
}
