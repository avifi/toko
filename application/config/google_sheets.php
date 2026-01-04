<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Google Sheets Configuration
|--------------------------------------------------------------------------
| 
| Configure your Google Sheets ID and API Key here
| 
| To get started:
| 1. Create a Google Sheet with tabs: Products, Categories, Store
| 2. Make the sheet publicly accessible (Anyone with the link can view)
| 3. Get a Google Sheets API key from Google Cloud Console
| 4. Copy your Sheet ID from the URL
|
*/

// Your Google Sheet ID (from the URL)
// Example: https://docs.google.com/spreadsheets/d/YOUR_SHEET_ID_HERE/edit
$config['google_sheet_id'] = '1234567890abcdefghijklmnopqrstuvwxyz';

// Your Google Sheets API Key
$config['google_api_key'] = 'YOUR_API_KEY_HERE';
