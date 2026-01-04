<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store_model extends CI_Model {
    
    private $sheet_name = 'Store';
    private $settings = null;
    
    public function __construct() {
        parent::__construct();
        $this->load->library('google_sheets');
    }
    
    /**
     * Get all store settings
     */
    public function get_settings() {
        if ($this->settings !== null) {
            return $this->settings;
        }
        
        $data = $this->google_sheets->get_sheet_data($this->sheet_name);
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
     * Get a specific setting value
     */
    public function get($key, $default = '') {
        $settings = $this->get_settings();
        return isset($settings[$key]) ? $settings[$key] : $default;
    }
}
