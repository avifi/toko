<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_controller extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('store_model');
        $this->load->library('cart');
    }
    
    /**
     * View cart page
     */
    public function index() {
        $data['store'] = $this->store_model->get_settings();
        $data['categories'] = $this->category_model->get_all();
        $data['cart_items'] = $this->cart->contents();
        $data['cart_count'] = $this->cart->total_items();
        $data['cart_total'] = $this->cart->total();
        
        $this->load->view('templates/header', $data);
        $this->load->view('cart/index', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * Add to cart (AJAX)
     */
    public function add() {
        $product_id = $this->input->post('product_id');
        $quantity = $this->input->post('quantity') ? $this->input->post('quantity') : 1;
        
        if (!$product_id) {
            echo json_encode(array('success' => false, 'message' => 'Product ID required'));
            return;
        }
        
        $product = $this->product_model->get_by_id($product_id);
        
        if (!$product) {
            echo json_encode(array('success' => false, 'message' => 'Product not found'));
            return;
        }
        
        $images = $this->product_model->get_images($product);
        $image = !empty($images) ? $images[0] : '';
        
        $this->cart->add(
            $product['id'],
            $product['name'],
            $product['price'],
            $quantity,
            $image
        );
        
        echo json_encode(array(
            'success' => true,
            'message' => 'Product added to cart',
            'cart_count' => $this->cart->total_items()
        ));
    }
    
    /**
     * Update cart item quantity (AJAX)
     */
    public function update() {
        $product_id = $this->input->post('product_id');
        $quantity = $this->input->post('quantity');
        
        if (!$product_id || !is_numeric($quantity)) {
            echo json_encode(array('success' => false, 'message' => 'Invalid parameters'));
            return;
        }
        
        $this->cart->update($product_id, $quantity);
        
        echo json_encode(array(
            'success' => true,
            'cart_count' => $this->cart->total_items(),
            'cart_total' => $this->cart->total()
        ));
    }
    
    /**
     * Remove item from cart (AJAX)
     */
    public function remove() {
        $product_id = $this->input->post('product_id');
        
        if (!$product_id) {
            echo json_encode(array('success' => false, 'message' => 'Product ID required'));
            return;
        }
        
        $this->cart->remove($product_id);
        
        echo json_encode(array(
            'success' => true,
            'message' => 'Item removed from cart',
            'cart_count' => $this->cart->total_items(),
            'cart_total' => $this->cart->total()
        ));
    }
    
    /**
     * Clear cart
     */
    public function clear() {
        $this->cart->clear();
        redirect('cart_controller');
    }
}
