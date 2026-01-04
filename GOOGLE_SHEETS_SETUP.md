# Google Sheets Setup Guide

## Prerequisites

1. Google Account
2. Google Sheets API enabled in Google Cloud Console
3. API Key generated

## Step-by-Step Setup

### 1. Create Google Sheet

Create a new Google Sheet with four tabs/worksheets:

#### Products Sheet
Create a sheet named "Products" with the following columns (first row):

| id | name | description | price | category_id | stock |
|----|------|-------------|-------|-------------|-------|

Example data:
```
1, Laptop Gaming, Laptop gaming dengan spesifikasi tinggi, 15000000, 1, 10
2, Mouse Wireless, Mouse wireless ergonomis, 150000, 2, 50
```

**Note:** Format baru tidak menggunakan kolom image1-image5. Gambar produk sekarang dikelola di sheet terpisah "ProductImages".

#### ProductImages Sheet (Sheet Baru)
Create a sheet named "ProductImages" with the following columns:

| id | product_id | image_url | sort_order |
|----|------------|-----------|------------|

Example data:
```
1, 1, https://example.com/laptop1.jpg, 1
2, 1, https://example.com/laptop2.jpg, 2
3, 1, https://example.com/laptop3.jpg, 3
4, 2, https://example.com/mouse1.jpg, 1
```

**Keterangan:**
- `id`: ID unik untuk setiap record gambar
- `product_id`: ID produk yang sesuai dengan kolom id di Products sheet
- `image_url`: URL lengkap gambar produk
- `sort_order`: Urutan tampilan gambar (1 = gambar utama)

**Keunggulan:**
- Tidak terbatas jumlah gambar per produk
- Lebih terorganisir dan mudah dikelola
- Kontrol urutan tampilan gambar

#### Categories Sheet
Create a sheet named "Categories" with the following columns:

| id | name | description |
|----|------|-------------|

Example data:
```
1, Elektronik, Produk elektronik dan gadget
2, Aksesoris, Aksesoris komputer dan gadget
3, Pakaian, Pakaian dan fashion
```

#### Store Sheet
Create a sheet named "Store" with the following columns:

| key | value |
|-----|-------|

Example data:
```
name, Toko Saya
address, Jl. Contoh No. 123, Jakarta
phone, 081234567890
whatsapp, 081234567890
email, info@tokosaya.com
hero_title, Selamat Datang di Toko Saya
hero_subtitle, Belanja produk berkualitas dengan harga terbaik
about, Kami adalah toko online yang menyediakan berbagai produk berkualitas dengan harga terjangkau. Kami berkomitmen untuk memberikan pelayanan terbaik kepada pelanggan kami.
```

### 2. Make Sheet Public

1. Click "Share" button in the top right
2. Change to "Anyone with the link can view"
3. Copy the share link

### 3. Get Sheet ID

From the share link, extract the Sheet ID:
```
https://docs.google.com/spreadsheets/d/YOUR_SHEET_ID_HERE/edit
```
The part between `/d/` and `/edit` is your Sheet ID.

### 4. Create Google Cloud Project and Enable API

1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Create a new project or select existing one
3. Enable "Google Sheets API":
   - Go to "APIs & Services" > "Library"
   - Search for "Google Sheets API"
   - Click "Enable"

### 5. Create API Key

1. Go to "APIs & Services" > "Credentials"
2. Click "Create Credentials" > "API Key"
3. Copy the API key
4. (Optional) Restrict the API key to only Google Sheets API

### 6. Configure Application

Edit `application/config/google_sheets.php`:

```php
$config['google_sheet_id'] = 'YOUR_SHEET_ID_HERE';
$config['google_api_key'] = 'YOUR_API_KEY_HERE';
```

### 7. Test

1. Add some sample data to your Google Sheets
2. Access your website
3. Products should appear on the homepage

## Image URLs

For product images, you can use:

1. **Public image hosting services**: Upload images to services like Imgur, Cloudinary, etc.
2. **Google Drive**: 
   - Upload image to Google Drive
   - Make it public
   - Use direct link format: `https://drive.google.com/uc?export=view&id=FILE_ID`
3. **Your own server**: Upload images to your web server's public directory

## Troubleshooting

### No products showing

1. Check if Google Sheets API is enabled
2. Verify API key is correct
3. Ensure sheet is publicly accessible
4. Check sheet names match exactly (case-sensitive)
5. Check browser console for errors

### Images not loading

1. Verify image URLs are publicly accessible
2. Use HTTPS URLs for better compatibility
3. Test image URLs in browser directly

## Notes

- Data is cached by the browser, so changes may take a few moments to appear
- Keep your API key secure - don't commit it to public repositories
- Consider setting up API key restrictions in Google Cloud Console
- The sheet must remain publicly accessible for the website to read it
