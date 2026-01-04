#!/usr/bin/env php
<?php
/**
 * Google Sheets Configuration Test
 * 
 * This script helps you verify that your Google Sheets configuration is correct.
 * Run this from the command line: php test_google_sheets.php
 */

// Load CodeIgniter bootstrap
define('BASEPATH', TRUE);
$config = array();

// Load config files
require_once __DIR__ . '/application/config/google_sheets.php';

echo "===========================================\n";
echo "Google Sheets Configuration Test\n";
echo "===========================================\n\n";

// Check if config is set
if (!isset($config['google_sheet_id']) || !isset($config['google_api_key'])) {
    echo "❌ ERROR: Configuration not found!\n";
    echo "Please create application/config/google_sheets.php\n";
    echo "Use google_sheets.php.sample as a template.\n\n";
    exit(1);
}

$sheet_id = $config['google_sheet_id'];
$api_key = $config['google_api_key'];

echo "Sheet ID: " . $sheet_id . "\n";
echo "API Key: " . substr($api_key, 0, 10) . "..." . substr($api_key, -5) . "\n\n";

// Check if config values are still default
if ($sheet_id === '1234567890abcdefghijklmnopqrstuvwxyz') {
    echo "⚠️  WARNING: Sheet ID is still the default value!\n";
    echo "Please update it with your actual Google Sheet ID.\n\n";
}

if ($api_key === 'YOUR_API_KEY_HERE') {
    echo "⚠️  WARNING: API Key is still the default value!\n";
    echo "Please update it with your actual Google API Key.\n\n";
}

// Test each sheet
$sheets = array('Products', 'Categories', 'Store');
$all_success = true;

foreach ($sheets as $sheet_name) {
    echo "Testing '{$sheet_name}' sheet...\n";
    
    $url = "https://sheets.googleapis.com/v4/spreadsheets/{$sheet_id}/values/{$sheet_name}!A1:Z1000?key={$api_key}";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($http_code != 200) {
        echo "❌ FAILED (HTTP {$http_code})\n";
        $error_data = json_decode($response, true);
        if (isset($error_data['error']['message'])) {
            echo "   Error: " . $error_data['error']['message'] . "\n";
        } else {
            echo "   Response: " . $response . "\n";
        }
        $all_success = false;
    } else {
        $data = json_decode($response, true);
        
        if (!isset($data['values']) || empty($data['values'])) {
            echo "⚠️  WARNING: Sheet is empty or has no data\n";
        } else {
            $row_count = count($data['values']) - 1; // Subtract header row
            echo "✅ SUCCESS - Found " . $row_count . " rows (excluding header)\n";
            
            // Show first row (headers)
            if (isset($data['values'][0])) {
                echo "   Headers: " . implode(', ', $data['values'][0]) . "\n";
            }
        }
    }
    echo "\n";
}

echo "===========================================\n";

if ($all_success) {
    echo "✅ All tests passed!\n";
    echo "Your Google Sheets configuration is working correctly.\n";
} else {
    echo "❌ Some tests failed.\n";
    echo "\nCommon issues:\n";
    echo "1. Sheet ID is incorrect - Copy from the URL between /d/ and /edit\n";
    echo "2. API Key is invalid - Generate a new one in Google Cloud Console\n";
    echo "3. Google Sheets API is not enabled - Enable it in Google Cloud Console\n";
    echo "4. Sheet is not public - Share it with 'Anyone with the link can view'\n";
    echo "5. Sheet tab names don't match - Must be exactly: Products, Categories, Store\n";
}

echo "\n";
