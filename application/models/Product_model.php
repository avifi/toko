<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {
    
    private $sheet_name = 'Products';
    
    public function __construct() {
        parent::__construct();
        $this->load->library('google_sheets');
    }
    
    /**
     * Get all products
     */
    public function get_all() {
        $products = $this->google_sheets->get_sheet_data($this->sheet_name);
        return $this->filter_active($products);
    }
    
    /**
     * Get products by category
     */
    public function get_by_category($category_id) {
        $products = $this->google_sheets->get_where($this->sheet_name, 'category_id', $category_id);
        return $this->filter_active($products);
    }
    
    /**
     * Get single product by ID
     */
    public function get_by_id($id) {
        return $this->google_sheets->get_by_id($this->sheet_name, $id);
    }

    public function get_by_slug($slug) {
        return $this->google_sheets->get_by_slug($this->sheet_name, $slug);
    }
    
    /**
     * Search products
     */
    public function search($keyword) {
        $products = $this->google_sheets->get_sheet_data($this->sheet_name);
        $result = array();
        
        $keyword = strtolower($keyword);
        foreach ($products as $product) {
            if (stripos($product['name'], $keyword) !== false || 
                stripos($product['description'], $keyword) !== false) {
                $result[] = $product;
            }
        }
        
        return $this->filter_active($result);
    }
    
    /**
     * Get product images from ProductImages sheet
     */
    public function get_images($product) {
        $images = [$product['thumbnail_image'] => $product['name']];
        
        // Try to get images from separate ProductImages sheet first
        $product_images = $this->google_sheets->get_where('ProductImages', 'product_id', $product['id']);
        
        if (!empty($product_images)) {
            // Images found in ProductImages sheet
            foreach ($product_images as $img) {
                if (!empty($img['image_url'])) {
                    $images[$img['image_url']] = $img['alt'];
                }
            }
        }
        
        return $images;
    }
    
    /**
     * Filter only active products (stock > 0)
     */
    private function filter_active($products) {
        $result = array();
        foreach ($products as $product) {
            // Include products that have stock or no stock field defined
            if (!isset($product['stock']) || $product['stock'] === '' || intval($product['stock']) > 0) {
                $result[] = $product;
            }
        }
        return $result;
    }
}
