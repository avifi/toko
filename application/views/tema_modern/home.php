    <!-- Modern Header -->
    <div class="header">
        <h1><i class="bi bi-shop-window"></i> <?php echo isset($store['name']) ? $store['name'] : 'TOKO MODERN SHOP'; ?></h1>
        <p><?php echo isset($store['slogan']) ? $store['slogan'] : 'Pusat belanja online terpercaya dengan harga & kualitas terbaik'; ?></p>
    </div>
    
    <!-- Hero Banner Promo -->
    <div class="banner">
        <div class="banner-badge"><i class="bi bi-fire"></i> Special Offer</div>
        <h2><?php echo isset($store['hero_title']) ? $store['hero_title'] : 'Promo Hemat Hingga 40%! 🔥'; ?></h2>
        <p><?php echo isset($store['hero_subtitle']) ? $store['hero_subtitle'] : 'Dapatkan penawaran terbatas untuk koleksi produk terfavorit bulan ini.'; ?></p>
    </div>

    <!-- Category Chips -->
    <div class="section-title">
        <span><i class="bi bi-grid"></i> Kategori Produk</span>
        <a href="<?php echo base_url('products'); ?>" style="font-size: 13px; font-weight: 600; text-decoration: none; color: var(--primary-color);">Semua <i class="bi bi-chevron-right"></i></a>
    </div>

    <div class="categories">
        <a href="<?php echo base_url('products'); ?>" class="category-chip active">🔥 Semua Populer</a>
        <?php 
        $categories = $this->category_model->get_all();
        if(!empty($categories)): 
            foreach($categories as $cat): 
        ?>
            <a href="<?php echo base_url('products?category=' . $cat['id']); ?>" class="category-chip">
                <?php echo $cat['name']; ?>
            </a>
        <?php 
            endforeach; 
        endif; 
        ?>
    </div>

    <!-- Popular Products Grid -->
    <div class="section-title">
        <span><i class="bi bi-stars"></i> Produk Terfavorit</span>
    </div>

    <div class="product-grid">
        <?php if(isset($products) && !empty($products)): ?>
            <?php foreach($products as $product): ?>
                <a href="<?php echo site_url($product['slug']); ?>" class="product-card">
                    <?php if($product['prime'] == 'Ya'): ?>
                        <div class="badge-prime"><i class="bi bi-star-fill me-1"></i> Prime</div>
                    <?php endif; ?>

                    <div class="product-image">
                        <?php 
                        $imgSrc = base_url($product['thumbnail_image']);
                        if (filter_var($product['thumbnail_image'], FILTER_VALIDATE_URL)) {
                            $imgSrc = $product['thumbnail_image'];
                        }
                        ?>
                        <?php if(!empty($product['thumbnail_image'])): ?>
                            <img src="<?php echo $imgSrc; ?>" alt="<?php echo $product['name']; ?>">
                        <?php else: ?>
                            <i class="bi bi-box-seam"></i>
                        <?php endif; ?>
                    </div>
                    <div class="product-info">
                        <div class="product-name"><?php echo $product['name']; ?></div>
                        <div class="product-price">Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></div>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state text-center py-5" style="grid-column: 1 / -1;">
                <i class="bi bi-box-seam display-4 text-muted"></i>
                <p class="mt-2 text-muted">Belum ada produk saat ini.</p>
            </div>
        <?php endif; ?>

        <a href="<?php echo base_url('products'); ?>" class="view-all-btn">
            Lihat Semua Produk Katalog <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    <!-- Trust Badges Section -->
    <div class="section-title" style="margin-top: 10px;">
        <span><i class="bi bi-shield-check"></i> Keunggulan Layanan Kami</span>
    </div>

    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon"><i class="bi bi-lightning-charge-fill"></i></div>
            <div class="feature-title">Pengiriman Cepat</div>
            <div class="feature-desc">Pesanan dikirim langsung setelah konfirmasi pembayaran</div>
        </div>
        <div class="feature-card">
            <div class="feature-icon"><i class="bi bi-patch-check-fill"></i></div>
            <div class="feature-title">Original & Bergaransi</div>
            <div class="feature-desc">Semua barang melalui pemeriksaan Quality Check ketat</div>
        </div>
        <div class="feature-card">
            <div class="feature-icon"><i class="bi bi-whatsapp"></i></div>
            <div class="feature-title">Order WhatsApp Instan</div>
            <div class="feature-desc">Beli langsung tanpa ribet melalui konfirmasi WhatsApp</div>
        </div>
    </div>
