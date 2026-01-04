<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($store['name']) ? $store['name'] : 'Toko Online'; ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #007bff;
            --secondary-color: #6c757d;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 56px;
        }
        
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, #0056b3 100%);
            color: white;
            padding: 60px 0;
            margin-bottom: 30px;
        }
        
        .product-card {
            transition: transform 0.2s, box-shadow 0.2s;
            height: 100%;
            border: 1px solid #e0e0e0;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .product-card img {
            height: 200px;
            object-fit: cover;
        }
        
        .price {
            font-size: 1.25rem;
            font-weight: bold;
            color: var(--primary-color);
        }
        
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #dc3545;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 0.75rem;
        }
        
        .category-badge {
            display: inline-block;
            padding: 5px 10px;
            margin: 2px;
            background: #f8f9fa;
            border-radius: 15px;
            font-size: 0.875rem;
            text-decoration: none;
            color: #495057;
            border: 1px solid #dee2e6;
        }
        
        .category-badge:hover {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }
        
        .category-badge.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }
        
        .btn-add-to-cart {
            width: 100%;
        }
        
        .product-image-gallery {
            margin-bottom: 20px;
        }
        
        .product-image-gallery img {
            cursor: pointer;
            border: 2px solid transparent;
            transition: border-color 0.2s;
        }
        
        .product-image-gallery img:hover,
        .product-image-gallery img.active {
            border-color: var(--primary-color);
        }
        
        .main-product-image {
            max-height: 400px;
            object-fit: contain;
            width: 100%;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
        }
        
        footer {
            background: #343a40;
            color: white;
            padding: 30px 0;
            margin-top: 50px;
        }
        
        .cart-item {
            border-bottom: 1px solid #e0e0e0;
            padding: 15px 0;
        }
        
        .cart-item:last-child {
            border-bottom: none;
        }
        
        .cart-item-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
        }
        
        .quantity-input {
            width: 70px;
            text-align: center;
        }
        
        @media (max-width: 768px) {
            .product-card img {
                height: 180px;
            }
            
            .hero-section {
                padding: 40px 0;
            }
            
            .main-product-image {
                max-height: 300px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="<?php echo base_url(); ?>">
                <i class="fas fa-store"></i>
                <?php echo isset($store['name']) ? $store['name'] : 'Toko Online'; ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('products'); ?>">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="<?php echo base_url('cart'); ?>">
                            <i class="fas fa-shopping-cart"></i> Keranjang
                            <?php if (isset($cart_count) && $cart_count > 0): ?>
                                <span class="cart-badge"><?php echo $cart_count; ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
