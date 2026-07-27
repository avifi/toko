<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {
    
    private $table = 'categories';
    private $tenant_id;
    
    public function __construct() {
        parent::__construct();
        $this->tenant_id = $this->config->item('tenant_id') ?: 1;
    }
    
    /**
     * Get all categories for current tenant
     */
    public function get_all() {
        return $this->db->get_where($this->table, ['tenant_id' => $this->tenant_id])->result_array();
    }
    
    /**
     * Get single category by ID for current tenant
     */
    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id, 'tenant_id' => $this->tenant_id])->row_array();
    }

    /**
     * Insert category for current tenant
     */
    public function insert($data) {
        $data['tenant_id'] = $this->tenant_id;
        return $this->db->insert($this->table, $data);
    }

    /**
     * Update category for current tenant
     */
    public function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->where('tenant_id', $this->tenant_id);
        return $this->db->update($this->table, $data);
    }

    /**
     * Delete category for current tenant
     */
    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->where('tenant_id', $this->tenant_id);
        return $this->db->delete($this->table);
    }
}
