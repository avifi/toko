<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store_model extends CI_Model {
    
    private $table = 'store';
    private $settings = null;
    private $tenant_id;
    
    public function __construct() {
        parent::__construct();
        $this->tenant_id = $this->config->item('tenant_id') ?: 1;
    }
    
    /**
     * Get all store settings for current tenant as key => value associative array
     */
    public function get_settings() {
        if ($this->settings !== null) {
            return $this->settings;
        }
        
        $data = $this->db->get_where($this->table, ['tenant_id' => $this->tenant_id])->result_array();
        $settings = array();
        
        foreach ($data as $row) {
            if (isset($row['key']) && isset($row['value'])) {
                $settings[$row['key']] = $row['value'];
            }
        }
        
        $this->settings = $settings;
        return $settings;
    }
    
    /**
     * Get a specific setting value for current tenant
     */
    public function get($key, $default = '') {
        $settings = $this->get_settings();
        return isset($settings[$key]) ? $settings[$key] : $default;
    }

    /**
     * Save or update a setting for current tenant
     */
    public function set($key, $value) {
        $existing = $this->db->get_where($this->table, ['tenant_id' => $this->tenant_id, 'key' => $key])->row();
        if ($existing) {
            $this->db->where('tenant_id', $this->tenant_id);
            $this->db->where('key', $key);
            return $this->db->update($this->table, ['value' => $value]);
        } else {
            return $this->db->insert($this->table, ['tenant_id' => $this->tenant_id, 'key' => $key, 'value' => $value]);
        }
    }
}
