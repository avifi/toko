<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Google Sheets Library
 * Simple library to fetch data from Google Sheets as JSON
 */
class Google_sheets {
    
    protected $CI;
    protected $sheet_id;
    protected $api_key;
    
    public function __construct($params = array()) {
        $this->CI =& get_instance();
        $this->CI->load->config('google_sheets');
        
        $this->sheet_id = $this->CI->config->item('google_sheet_id');
        $this->api_key = $this->CI->config->item('google_api_key');
    }
    
    /**
     * Get data from a specific sheet/tab
     * @param string $sheet_name The name of the sheet/tab
     * @param string $range The range to fetch (e.g., 'A1:Z1000')
     * @return array
     */
    public function get_sheet_data($sheet_name, $range = 'A1:Z1000') {
        $url = "https://sheets.googleapis.com/v4/spreadsheets/{$this->sheet_id}/values/{$sheet_name}!{$range}?key={$this->api_key}";
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($http_code != 200) {
            log_message('error', 'Google Sheets API Error: ' . $response);
            return array();
        }
        
        $data = json_decode($response, true);
        
        if (!isset($data['values']) || empty($data['values'])) {
            return array();
        }
        
        return $this->parse_sheet_data($data['values']);
    }
    
    /**
     * Parse sheet data into associative array
     * First row is treated as headers
     */
    private function parse_sheet_data($values) {
        if (empty($values)) {
            return array();
        }
        
        $headers = array_shift($values);
        $result = array();
        
        foreach ($values as $row) {
            $item = array();
            foreach ($headers as $index => $header) {
                $item[$header] = isset($row[$index]) ? $row[$index] : '';
            }
            $result[] = $item;
        }
        
        return $result;
    }
    
    /**
     * Get a single row by ID
     */
    public function get_by_id($sheet_name, $id) {
        $data = $this->get_sheet_data($sheet_name);
        
        foreach ($data as $row) {
            if (isset($row['id']) && $row['id'] == $id) {
                return $row;
            }
        }
        
        return null;
    }
    
    /**
     * Get rows filtered by a field value
     */
    public function get_where($sheet_name, $field, $value) {
        $data = $this->get_sheet_data($sheet_name);
        $result = array();
        
        foreach ($data as $row) {
            if (isset($row[$field]) && $row[$field] == $value) {
                $result[] = $row;
            }
        }
        
        return $result;
    }
}
