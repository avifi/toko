<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('store_model');
        $this->load->library('cart');
    }
    
    /**
     * Product listing page
     */
    public function index() {
        $category_id = $this->input->get('category');
        $search = $this->input->get('search');
        
        $data['store'] = $this->store_model->get_settings();
        $data['categories'] = $this->category_model->get_all();
        $data['cart_count'] = $this->cart->total_items();
        
        if ($category_id) {
            $data['products'] = $this->product_model->get_by_category($category_id);
            $data['current_category'] = $this->category_model->get_by_id($category_id);
        } elseif ($search) {
            $data['products'] = $this->product_model->search($search);
            $data['search_term'] = $search;
        } else {
            $data['products'] = $this->product_model->get_all();
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('products/index', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * Product detail page
     */
    public function detail($id) {
        $data['store'] = $this->store_model->get_settings();
        $data['categories'] = $this->category_model->get_all();
        $data['cart_count'] = $this->cart->total_items();
        $data['product'] = $this->product_model->get_by_id($id);
        
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
            $data['related_products'] = array_filter($related, function($p) use ($id) {
                return $p['id'] != $id;
            });
            $data['related_products'] = array_slice($data['related_products'], 0, 4);
        } else {
            $data['related_products'] = array();
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('products/detail', $data);
        $this->load->view('templates/footer');
    }
}
