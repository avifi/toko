<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sosmed_model extends CI_Model {
    
    private $table = 'sosmed';
    private $socials = null;
    private $tenant_id;
    
    public function __construct() {
        parent::__construct();
        $this->tenant_id = $this->config->item('tenant_id') ?: 1;
    }
    
    /**
     * Get all social media links for current tenant
     */
    public function get_all() {
        if ($this->socials !== null) {
            return $this->socials;
        }
        
        $this->socials = $this->db->get_where($this->table, ['tenant_id' => $this->tenant_id])->result_array();
        return $this->socials;
    }
}
