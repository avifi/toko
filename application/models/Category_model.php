<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {
    
    private $sheet_name = 'Categories';
    
    public function __construct() {
        parent::__construct();
        $this->load->library('google_sheets');
    }
    
    /**
     * Get all categories
     */
    public function get_all() {
        return $this->google_sheets->get_sheet_data($this->sheet_name);
    }
    
    /**
     * Get single category by ID
     */
    public function get_by_id($id) {
        return $this->google_sheets->get_by_id($this->sheet_name, $id);
    }
}
