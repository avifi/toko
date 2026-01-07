
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feature_model extends CI_Model {
    
    private $sheet_name = 'Features';
    private $features = null;
    
    public function __construct() {
        parent::__construct();
        $this->load->library('google_sheets');
    }
    
    /**
     * Get all features
     */
    public function get_all() {
        if ($this->features !== null) {
            return $this->features;
        }
        
        $this->features = $this->google_sheets->get_sheet_data($this->sheet_name);
        return $this->features;
    }
}
