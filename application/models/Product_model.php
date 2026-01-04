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
     * Get product images
     */
    public function get_images($product) {
        $images = array();
        
        if (!empty($product['image1'])) {
            $images[] = $product['image1'];
        }
        if (!empty($product['image2'])) {
            $images[] = $product['image2'];
        }
        if (!empty($product['image3'])) {
            $images[] = $product['image3'];
        }
        if (!empty($product['image4'])) {
            $images[] = $product['image4'];
        }
        if (!empty($product['image5'])) {
            $images[] = $product['image5'];
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
