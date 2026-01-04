<!-- Hero Section -->
<div class="hero-section">
    <div class="container text-center">
        <h1 class="display-4"><?php echo isset($store['hero_title']) ? $store['hero_title'] : 'Selamat Datang di Toko Kami'; ?></h1>
        <p class="lead"><?php echo isset($store['hero_subtitle']) ? $store['hero_subtitle'] : 'Temukan produk berkualitas dengan harga terbaik'; ?></p>
        <a href="<?php echo base_url('products'); ?>" class="btn btn-light btn-lg mt-3">
            <i class="fas fa-shopping-bag"></i> Belanja Sekarang
        </a>
    </div>
</div>

<div class="container">
    <!-- About Section -->
    <?php if (isset($store['about']) && !empty($store['about'])): ?>
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="text-center mb-4">Tentang Kami</h2>
            <div class="text-center">
                <p class="lead"><?php echo nl2br($store['about']); ?></p>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Categories Section -->
    <?php if (!empty($categories)): ?>
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="mb-3">Kategori Produk</h3>
            <div class="d-flex flex-wrap">
                <?php foreach ($categories as $category): ?>
                    <a href="<?php echo base_url('products?category=' . $category['id']); ?>" class="category-badge">
                        <?php echo $category['name']; ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Featured Products -->
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="mb-3">Produk Terbaru</h3>
        </div>
    </div>
    
    <div class="row">
        <?php if (!empty($products)): ?>
            <?php 
            $featured_products = array_slice($products, 0, 8);
            foreach ($featured_products as $product): 
                $images = array();
                if (!empty($product['image1'])) $images[] = $product['image1'];
                if (!empty($product['image2'])) $images[] = $product['image2'];
                if (!empty($product['image3'])) $images[] = $product['image3'];
                
                $default_image = !empty($images) ? $images[0] : 'https://via.placeholder.com/300x200?text=No+Image';
            ?>
            <div class="col-6 col-md-4 col-lg-3 mb-4">
                <div class="card product-card">
                    <img src="<?php echo $default_image; ?>" class="card-img-top" alt="<?php echo $product['name']; ?>">
                    <div class="card-body">
                        <h6 class="card-title text-truncate"><?php echo $product['name']; ?></h6>
                        <p class="price mb-2">Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></p>
                        <a href="<?php echo base_url('product/' . $product['id']); ?>" class="btn btn-primary btn-sm btn-add-to-cart">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info">
                    Belum ada produk tersedia. Silakan konfigurasi Google Sheets terlebih dahulu.
                </div>
            </div>
        <?php endif; ?>
    </div>
    
    <?php if (!empty($products) && count($products) > 8): ?>
    <div class="row mt-4">
        <div class="col-12 text-center">
            <a href="<?php echo base_url('products'); ?>" class="btn btn-outline-primary btn-lg">
                Lihat Semua Produk <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
    <?php endif; ?>
</div>
