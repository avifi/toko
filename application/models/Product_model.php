<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {
    
    private $table = 'products';
    private $tenant_id;
    
    public function __construct() {
        parent::__construct();
        $this->tenant_id = $this->config->item('tenant_id') ?: 1;
    }
    
    /**
     * Get all active products for current tenant
     */
    public function get_all() {
        $this->db->where('tenant_id', $this->tenant_id);
        $products = $this->db->get($this->table)->result_array();
        return $this->filter_active($products);
    }

    /**
     * Get raw list for admin management scoped to current tenant
     */
    public function get_admin_list() {
        $this->db->select('products.*, categories.name as category_name');
        $this->db->join('categories', 'categories.id = products.category_id', 'left');
        $this->db->where('products.tenant_id', $this->tenant_id);
        $this->db->order_by('products.id', 'DESC');
        return $this->db->get($this->table)->result_array();
    }

    public function get_prime() {
        $this->db->where('tenant_id', $this->tenant_id);
        $this->db->where('prime', 'Ya');
        $products = $this->db->get($this->table)->result_array();
        return $this->filter_active($products);
    }
    
    /**
     * Get products by category for current tenant
     */
    public function get_by_category($category_id) {
        $this->db->where('tenant_id', $this->tenant_id);
        $this->db->where('category_id', $category_id);
        $products = $this->db->get($this->table)->result_array();
        return $this->filter_active($products);
    }
    
    /**
     * Get single product by ID for current tenant
     */
    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id, 'tenant_id' => $this->tenant_id])->row_array();
    }

    public function get_by_slug($slug) {
        return $this->db->get_where($this->table, ['slug' => $slug, 'tenant_id' => $this->tenant_id])->row_array();
    }
    
    /**
     * Search products for current tenant
     */
    public function search($keyword, $sort = 'latest') {
        $this->db->where('tenant_id', $this->tenant_id);
        $this->db->group_start();
        $this->db->like('name', $keyword);
        $this->db->or_like('description', $keyword);
        $this->db->group_end();

        if ($sort == 'lowest') {
            $this->db->order_by('price', 'ASC');
        } elseif ($sort == 'highest') {
            $this->db->order_by('price', 'DESC');
        } else {
            $this->db->order_by('id', 'DESC');
        }

        $products = $this->db->get($this->table)->result_array();
        return $this->filter_active($products);
    }
    
    /**
     * Get product images from product_images table for current tenant
     */
    public function get_images($product) {
        $images = [];
        if (!empty($product['thumbnail_image'])) {
            $images[$product['thumbnail_image']] = isset($product['name']) ? $product['name'] : '';
        }
        
        $product_images = $this->db->get_where('product_images', ['product_id' => $product['id'], 'tenant_id' => $this->tenant_id])->result_array();
        
        if (!empty($product_images)) {
            foreach ($product_images as $img) {
                if (!empty($img['image_url'])) {
                    $images[$img['image_url']] = isset($img['alt']) ? $img['alt'] : '';
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
            if (!isset($product['stock']) || $product['stock'] === '' || intval($product['stock']) > 0) {
                $result[] = $product;
            }
        }
        return $result;
    }

    /**
     * Insert product with tenant_id
     */
    public function insert($data) {
        $data['tenant_id'] = $this->tenant_id;
        return $this->db->insert($this->table, $data);
    }

    /**
     * Update product for current tenant
     */
    public function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->where('tenant_id', $this->tenant_id);
        return $this->db->update($this->table, $data);
    }

    /**
     * Delete product for current tenant
     */
    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->where('tenant_id', $this->tenant_id);
        return $this->db->delete($this->table);
    }
}
