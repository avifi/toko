<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title -->
    <title>
        <?php 
        echo isset($seo_title) 
            ? $seo_title 
            : (isset($store['name']) 
                ? $store['name'].' - Toko Elektronik Terpercaya' 
                : 'Toko Elektronik Terpercaya');
        ?>
    </title>

    <!-- Favicon -->
    <link href="<?php echo $store['favicon']; ?>" rel="shortcut icon" type="image/png" />

    <!-- Meta Description -->
    <meta name="description" content="<?php 
        echo isset($seo_description) 
            ? $seo_description 
            : 'Toko elektronik terpercaya dengan harga terbaik. Menyediakan berbagai produk elektronik berkualitas dan bergaransi resmi.'; 
    ?>">

    <!-- Meta Keywords (opsional, tidak terlalu berpengaruh tapi aman) -->
    <meta name="keywords" content="toko elektronik, elektronik murah, jual elektronik, <?php echo isset($store['name']) ? strtolower($store['name']) : 'toko online'; ?>">

    <!-- Author -->
    <meta name="author" content="<?php echo isset($store['name']) ? $store['name'] : 'Toko Elektronik'; ?>">

    <!-- Canonical URL -->
    <link rel="canonical" href="<?php echo current_url(); ?>">

    <!-- Open Graph (Facebook, WhatsApp) -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo isset($seo_title) ? $seo_title : $store['name']; ?>">
    <meta property="og:description" content="<?php echo isset($seo_description) ? $seo_description : 'Belanja elektronik mudah, aman, dan terpercaya.'; ?>">
    <meta property="og:url" content="<?php echo current_url(); ?>">
    <meta property="og:site_name" content="<?php echo $store['name'] ?? 'Toko Elektronik'; ?>">
    <meta property="og:image" content="<?php echo isset($seo_image) ? $seo_image : 'https://placehold.co/300x300'; ?>">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo isset($seo_title) ? $seo_title : $store['name']; ?>">
    <meta name="twitter:description" content="<?php echo isset($seo_description) ? $seo_description : 'Belanja elektronik terpercaya.'; ?>">
    <meta name="twitter:image" content="<?php echo isset($seo_image) ? $seo_image : 'https://placehold.co/300x300'; ?>">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/modern/style.css'); ?>">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container">
    
