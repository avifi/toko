<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sosmed_model extends CI_Model {
    
    private $sheet_name = 'Sosmed';
    private $socials = null;
    
    public function __construct() {
        parent::__construct();
        $this->load->library('google_sheets');
    }
    
    /**
     * Get all social media links
     */
    public function get_all() {
        if ($this->socials !== null) {
            return $this->socials;
        }
        
        $this->socials = $this->google_sheets->get_sheet_data($this->sheet_name);
        return $this->socials;
    }
}
