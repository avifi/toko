<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feature_model extends CI_Model {
    
    private $table = 'features';
    private $features = null;
    private $tenant_id;
    
    public function __construct() {
        parent::__construct();
        $this->tenant_id = $this->config->item('tenant_id') ?: 1;
    }
    
    /**
     * Get all features for current tenant
     */
    public function get_all() {
        if ($this->features !== null) {
            return $this->features;
        }
        
        $this->features = $this->db->get_where($this->table, ['tenant_id' => $this->tenant_id])->result_array();
        return $this->features;
    }
}
