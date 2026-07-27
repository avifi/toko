<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MultiTenant {

    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    public function initialize()
    {
        // Check if running via CLI (migrations, etc) - default tenant_id = 1
        if (is_cli()) {
            $this->CI->config->set_item('tenant_id', 1);
            return;
        }

        $domain = $_SERVER['HTTP_HOST'];
        
        // Remove port if present (e.g. localhost:8080 -> localhost)
        if (strpos($domain, ':') !== false) {
            $domain = explode(':', $domain)[0];
        }

        if (!isset($this->CI->db)) {
            $this->CI->load->database();
        }

        // Search tenant by domain
        $tenant = $this->CI->db->get_where('tenants', ['domain' => $domain])->row();

        if ($tenant) {
            $this->CI->config->set_item('tenant_id', (int)$tenant->id);
            $this->CI->config->set_item('tenant_domain', $tenant->domain);
        } else {
            // Default fallback to tenant_id = 1 if domain is not registered
            $this->CI->config->set_item('tenant_id', 1);
            log_message('debug', 'MultiTenant: Domain ' . $domain . ' not registered in tenants table. Fallback to tenant_id = 1');
        }
    }
}
