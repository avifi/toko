# Toko - E-commerce Website

CodeIgniter 3 based e-commerce website with Google Sheets as database.

## Features

- Mobile-first responsive design
- Product catalog with categories
- Multiple product images
- Shopping cart (stored in cookies, no login required)
- Store profile configuration
- Google Sheets integration for data storage

## Requirements

- PHP 7.2 or higher
- Web server (Apache/Nginx)
- Google Sheets API access

## Installation

1. Clone this repository
2. Configure your Google Sheets API credentials
3. Update `application/config/config.php` with your base URL
4. Set up your Google Sheets with the required structure
5. Access the website through your web server

## Google Sheets Structure

Create a Google Sheet with the following worksheets:

### Products Sheet
- id, name, description, price, category_id, image1, image2, image3, stock

### Categories Sheet
- id, name, description

### Store Sheet
- key, value (for store profile settings like name, address, phone, hero_title, hero_subtitle, about, etc.)

## Usage

1. Open the website
2. Browse products by category
3. View product details
4. Add items to cart
5. View cart and manage items
