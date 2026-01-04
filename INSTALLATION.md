# Installation Guide - Toko E-commerce Website

## Prerequisites

- PHP 7.2 or higher (tested with PHP 8.3)
- Web server (Apache, Nginx, or PHP built-in server for development)
- cURL extension enabled in PHP
- Google Account for Google Sheets

## Quick Start

### 1. Clone the Repository

```bash
git clone https://github.com/avifi/toko.git
cd toko
```

### 2. Configure Google Sheets

#### 2.1 Create Google Sheet

1. Go to [Google Sheets](https://sheets.google.com)
2. Create a new spreadsheet
3. Create three tabs/worksheets:
   - **Products**
   - **Categories** 
   - **Store**

4. Add column headers to each sheet (see SAMPLE_DATA.md for structure)
5. Add sample data (optional - see SAMPLE_DATA.md)

#### 2.2 Make Sheet Public

1. Click the "Share" button
2. Change to "Anyone with the link can view"
3. Copy the sheet URL - you'll need the Sheet ID from it

Example URL:
```
https://docs.google.com/spreadsheets/d/1abc123def456ghi789jkl/edit
```
The Sheet ID is: `1abc123def456ghi789jkl`

#### 2.3 Get Google Sheets API Key

1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Create a new project (or select existing)
3. Enable Google Sheets API:
   - Navigate to "APIs & Services" → "Library"
   - Search for "Google Sheets API"
   - Click "Enable"
4. Create API Key:
   - Go to "APIs & Services" → "Credentials"
   - Click "Create Credentials" → "API Key"
   - Copy the generated API key
5. (Recommended) Restrict the API key:
   - Click on the API key to edit
   - Under "API restrictions", select "Restrict key"
   - Choose "Google Sheets API"
   - Save

### 3. Configure Application

#### 3.1 Copy Configuration File

```bash
cp application/config/google_sheets.php.sample application/config/google_sheets.php
```

#### 3.2 Edit Configuration

Edit `application/config/google_sheets.php`:

```php
$config['google_sheet_id'] = 'YOUR_SHEET_ID_HERE';
$config['google_api_key'] = 'YOUR_API_KEY_HERE';
```

Replace:
- `YOUR_SHEET_ID_HERE` with your Google Sheet ID
- `YOUR_API_KEY_HERE` with your Google API Key

#### 3.3 Set Base URL (Production Only)

For production deployment, edit `application/config/config.php`:

```php
$config['base_url'] = 'https://yourdomain.com/';
```

For local development, you can leave it empty.

### 4. Run the Application

#### Option A: PHP Built-in Server (Development)

```bash
php -S localhost:8000
```

Then open http://localhost:8000 in your browser.

#### Option B: Apache/Nginx (Production)

1. Point your web server document root to the project directory
2. Make sure `.htaccess` is enabled (Apache) or configure rewrite rules (Nginx)
3. Ensure `mod_rewrite` is enabled (Apache)

##### Apache Configuration

Make sure `.htaccess` files are allowed:

```apache
<Directory /path/to/toko>
    AllowOverride All
    Require all granted
</Directory>
```

##### Nginx Configuration

Add this to your server block:

```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

### 5. Set Permissions

```bash
chmod -R 755 application/cache
chmod -R 755 application/logs
```

## Verify Installation

1. Open the website in your browser
2. You should see:
   - Homepage with hero section
   - Products from your Google Sheet
   - Categories in the navigation
   - Cart functionality

If you see "Belum ada produk tersedia", check:
- Google Sheets API key is correct
- Sheet ID is correct
- Sheet is publicly accessible
- Sheet tab names match exactly: Products, Categories, Store
- Column headers match the structure in SAMPLE_DATA.md

## Google Sheets Structure

### Products Sheet

Required columns (first row):
```
id | name | description | price | category_id | image1 | image2 | image3 | image4 | image5 | stock
```

### Categories Sheet

Required columns (first row):
```
id | name | description
```

### Store Sheet

Required columns (first row):
```
key | value
```

Common keys:
- name
- address
- phone
- whatsapp
- email
- hero_title
- hero_subtitle
- about

See `SAMPLE_DATA.md` for detailed examples.

## Customization

### Change Colors

Edit `application/views/templates/header.php`:

```css
:root {
    --primary-color: #007bff;  /* Change this */
    --secondary-color: #6c757d;
}
```

### Change Homepage Content

Store settings are configured in the Google Sheets "Store" tab. No code changes needed!

### Add Custom Pages

1. Create controller in `application/controllers/`
2. Create view in `application/views/`
3. Add route in `application/config/routes.php`

## Troubleshooting

### "A PHP Error was encountered"

If you see deprecation warnings with PHP 8.x, these are from CodeIgniter 3 core and don't affect functionality. To hide them, edit `application/config/config.php`:

```php
$config['log_threshold'] = 0;
```

### Products Not Showing

1. Check browser console for errors (F12)
2. Verify API key and Sheet ID
3. Test API access:
   ```
   https://sheets.googleapis.com/v4/spreadsheets/YOUR_SHEET_ID/values/Products!A1:Z1000?key=YOUR_API_KEY
   ```
4. Make sure sheet is public
5. Check column headers match exactly

### Images Not Loading

1. Use full URLs (https://...)
2. Test image URLs directly in browser
3. Use public image hosting (Imgur, Cloudinary, etc.)
4. Or upload to your server's public directory

### Cart Not Working

1. Check that cookies are enabled in browser
2. Make sure base_url is set correctly
3. Check browser console for JavaScript errors

## Security Notes

1. **Never commit `google_sheets.php`** - it contains sensitive API keys
2. Use `.gitignore` to exclude it (already configured)
3. Restrict your API key to only Google Sheets API
4. Consider using environment variables for production
5. Keep CodeIgniter up to date

## Production Deployment

1. Set `$config['base_url']` in `application/config/config.php`
2. Disable error reporting: `error_reporting(0);` in `index.php`
3. Set log threshold to 1 in `application/config/config.php`
4. Use HTTPS for security
5. Consider using a Content Delivery Network (CDN) for images
6. Enable caching in production

## Support

For issues, questions, or contributions, please visit:
https://github.com/avifi/toko

## License

This project uses CodeIgniter 3 which is licensed under the MIT License.
