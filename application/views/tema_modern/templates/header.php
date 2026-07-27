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
                ? $store['name'].' - Toko Online Terpercaya' 
                : 'Toko Online Terpercaya');
        ?>
    </title>

    <!-- Favicon -->
    <?php if(!empty($store['favicon'])): ?>
        <link href="<?php echo base_url($store['favicon']); ?>" rel="shortcut icon" type="image/png" />
    <?php endif; ?>

    <!-- Meta Description & SEO -->
    <meta name="description" content="<?php 
        echo isset($seo_description) 
            ? $seo_description 
            : 'Toko online terpercaya dengan harga terbaik. Menyediakan berbagai produk berkualitas dan bergaransi resmi.'; 
    ?>">
    <meta name="keywords" content="toko online, belanja murah, e-commerce, <?php echo isset($store['name']) ? strtolower($store['name']) : 'toko online'; ?>">
    <meta name="author" content="<?php echo isset($store['name']) ? $store['name'] : 'Toko Online'; ?>">
    <link rel="canonical" href="<?php echo current_url(); ?>">

    <!-- Open Graph (Facebook, WhatsApp) -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo isset($seo_title) ? $seo_title : (isset($store['name']) ? $store['name'] : 'Toko Online'); ?>">
    <meta property="og:description" content="<?php echo isset($seo_description) ? $seo_description : 'Belanja online mudah, aman, dan terpercaya.'; ?>">
    <meta property="og:url" content="<?php echo current_url(); ?>">
    <meta property="og:site_name" content="<?php echo $store['name'] ?? 'Toko Online'; ?>">
    <meta property="og:image" content="<?php echo isset($seo_image) ? (filter_var($seo_image, FILTER_VALIDATE_URL) ? $seo_image : base_url($seo_image)) : base_url('assets/uploads/kaos.png'); ?>">

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/modern/style.css'); ?>">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container">
