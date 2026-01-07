    <div class="header">
        <h1><i class="bi bi-shop"></i> <?php echo isset($store['name']) ? $store['name'] : 'Toko Elektronik'; ?></h1>
        <p><?php echo isset($store['slogan']) ? $store['slogan'] : 'Toko Elektronik'; ?></p>
    </div>
    
    <div class="banner">
        <h2><?php echo isset($store['hero_title']) ? $store['hero_title'] : 'Promo Spesial!'; ?></h2>
        <p><?php echo isset($store['hero_subtitle']) ? $store['hero_subtitle'] : 'Diskon hingga 50% untuk produk pilihan'; ?></p>
    </div>

    <div class="section-title">Produk Populer</div>

    <div class="product-grid">
        <?php if(isset($products) && !empty($products)): ?>
            <?php foreach($products as $product): ?>
                <a href="<?php echo site_url('products/detail/' . $product['id']); ?>" class="product-card">
                    <div class="product-image">
                        <!-- Check if image is URL or Icon class -->
                        <?php if(filter_var($product['thumbnail_image'], FILTER_VALIDATE_URL)): ?>
                            <img src="<?php echo $product['thumbnail_image']; ?>" alt="<?php echo $product['name']; ?>">
                        <?php else: ?>
                            <i class="<?php echo $product['thumbnail_image']; ?>"></i>
                        <?php endif; ?>
                    </div>
                    <div class="product-info">
                        <div class="product-name"><?php echo $product['name']; ?></div>
                        <div class="product-price">Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></div>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">Belum ada produk.</p>
        <?php endif; ?>

        <a href="<?php echo base_url('products'); ?>" class="view-all-btn btn-large">
            Lihat Semua Produk <i class="bi bi-arrow-right-short"></i>
        </a>

    </div>
