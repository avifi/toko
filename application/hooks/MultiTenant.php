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
        // Check if running via CLI (migrations, etc) - skip tenant check
        if (is_cli()) {
            return;
        }

        $domain = $_SERVER['HTTP_HOST'];
        
        // Remove port if present
        if (strpos($domain, ':') !== false) {
            $domain = explode(':', $domain)[0];
        }

        // Load database if not loaded (though pre_controller usually runs after DB is available if loaded in autoload)
        // But get_instance might not have db loaded yet if it's too early. 
        // Hook point 'pre_controller' calls your classes.
        // Let's ensure we can access DB.
        if (!isset($this->CI->db)) {
            $this->CI->load->database();
        }

        $tenant = $this->CI->db->get_where('tenants', ['domain' => $domain])->row();

        if ($tenant) {
            // Set configuration items
            $this->CI->config->set_item('google_sheet_id', $tenant->google_sheet_id);
            $this->CI->config->set_item('google_api_key', $tenant->google_api_key);
        } else {
            // Optional: Handle unknown tenant (redirect, show 404, or fallback to default)
            // For now, we will just log it or do nothing so it uses default config if any.
            log_message('error', 'MultiTenant: No tenant found for domain ' . $domain);
        }
    }
}
