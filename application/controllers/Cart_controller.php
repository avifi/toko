<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_controller extends CI_Controller {
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
     * View cart page
     */
    public function index() {
        $this->_init_theme();
        $data['store'] = $this->store_model->get_settings();
        $data['categories'] = $this->category_model->get_all();
        
        $data['theme'] = $this->theme;
        $data['seo_title'] = 'Keranjang Belanja';
        $data['seo_description'] = 'Keranjang belanja Anda, ayo checkout sekarang';
        $data['seo_image'] = $data['store']['logo'];
        
        $theme_view = ($this->theme ?: 'tema_default');
        
        $this->load->view($theme_view . '/templates/header', $data);
        $this->load->view($theme_view . '/cart/index', $data);
        $this->load->view($theme_view . '/templates/footer');
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
        
        $image = $product['thumbnail_image'];
        
        $this->shopping_cart->add(
            $product['id'],
            $product['name'],
            $product['price'],
            $quantity,
            $image
        );
        
        echo json_encode(array(
            'success' => true,
            'message' => 'Product added to cart',
            'cart_count' => $this->shopping_cart->total_items()
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
        
        $this->shopping_cart->update($product_id, $quantity);
        
        echo json_encode(array(
            'success' => true,
            'cart_count' => $this->shopping_cart->total_items(),
            'cart_total' => $this->shopping_cart->total(),
            'html' => $this->get_list(true)
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
        
        $this->shopping_cart->remove($product_id);
        
        echo json_encode(array(
            'success' => true,
            'message' => 'Item removed from cart',
            'cart_count' => $this->shopping_cart->total_items(),
            'cart_total' => $this->shopping_cart->total(),
            'html' => $this->get_list(true)
        ));
    }
    
    /**
     * Clear cart
     */
    public function clear() {
        $this->shopping_cart->clear();
        redirect('cart_controller');
    }


    /**
     * Ambil tampilan list
     */
    public function get_list($isi = false)
    {
        $this->_init_theme();
        $data['cart_items'] = $this->shopping_cart->contents();
        $data['cart_count'] = $this->shopping_cart->total_items();
        $data['cart_total'] = $this->shopping_cart->total();
        $data['store'] = $this->store_model->get_settings();

        $theme_view = ($this->theme ?: 'tema_default');

        $html = $this->load->view($theme_view.'/cart/cart_list', $data, true);

        if ($isi == true) {
            return $html;
        } else {
            echo json_encode(array(
                'success' => true,
                'html' => $html
            ));
        }

    }
}
