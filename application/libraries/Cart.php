<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Shopping Cart Library
 * Manages cart using cookies
 */
class Cart {
    
    protected $CI;
    protected $cart_name = 'toko_cart';
    protected $cart_items = array();
    
    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->helper('cookie');
        $this->CI->load->library('encryption');
        
        // Load cart from cookie
        $this->load_cart();
    }
    
    /**
     * Load cart from cookie
     */
    private function load_cart() {
        $cookie = get_cookie($this->cart_name);
        
        if ($cookie) {
            $cart_data = json_decode($cookie, true);
            if (is_array($cart_data)) {
                $this->cart_items = $cart_data;
            }
        }
    }
    
    /**
     * Save cart to cookie
     */
    private function save_cart() {
        $cookie = array(
            'name'   => $this->cart_name,
            'value'  => json_encode($this->cart_items),
            'expire' => 86400 * 30, // 30 days
            'path'   => '/',
            'secure' => FALSE
        );
        
        set_cookie($cookie);
    }
    
    /**
     * Add item to cart
     */
    public function add($product_id, $name, $price, $quantity = 1, $image = '') {
        $product_id = (string)$product_id;
        
        if (isset($this->cart_items[$product_id])) {
            $this->cart_items[$product_id]['quantity'] += $quantity;
        } else {
            $this->cart_items[$product_id] = array(
                'id' => $product_id,
                'name' => $name,
                'price' => $price,
                'quantity' => $quantity,
                'image' => $image
            );
        }
        
        $this->save_cart();
        return true;
    }
    
    /**
     * Update item quantity
     */
    public function update($product_id, $quantity) {
        $product_id = (string)$product_id;
        
        if (isset($this->cart_items[$product_id])) {
            if ($quantity > 0) {
                $this->cart_items[$product_id]['quantity'] = $quantity;
            } else {
                unset($this->cart_items[$product_id]);
            }
            $this->save_cart();
            return true;
        }
        
        return false;
    }
    
    /**
     * Remove item from cart
     */
    public function remove($product_id) {
        $product_id = (string)$product_id;
        
        if (isset($this->cart_items[$product_id])) {
            unset($this->cart_items[$product_id]);
            $this->save_cart();
            return true;
        }
        
        return false;
    }
    
    /**
     * Get all cart items
     */
    public function contents() {
        return $this->cart_items;
    }
    
    /**
     * Get total items count
     */
    public function total_items() {
        $total = 0;
        foreach ($this->cart_items as $item) {
            $total += $item['quantity'];
        }
        return $total;
    }
    
    /**
     * Get cart total price
     */
    public function total() {
        $total = 0;
        foreach ($this->cart_items as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
    
    /**
     * Clear cart
     */
    public function clear() {
        $this->cart_items = array();
        delete_cookie($this->cart_name);
        return true;
    }
}
