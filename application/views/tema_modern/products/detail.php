<?php if(isset($product)): ?>
    <!-- Header -->
    <div class="header">
        <a href="<?php echo base_url('products'); ?>" class="back-btn"><i class="bi bi-arrow-left"></i></a>
        <h1>Detail Produk</h1>
    </div>

    <!-- Product Image Hero -->
    <div class="product-hero">
        <div class="main-image-container" id="mainImage">
            <?php 
            $mainImage = $product['thumbnail_image']; 
            $imgSrc = base_url($mainImage);
            if (filter_var($mainImage, FILTER_VALIDATE_URL)) {
                $imgSrc = $mainImage;
            }
            ?>
            <?php if(!empty($mainImage)): ?>
                <img src="<?php echo $imgSrc; ?>" alt="<?php echo $product['name']; ?>">
            <?php else: ?>
                <i class="bi bi-box-seam display-1 text-muted"></i>
            <?php endif; ?>
        </div>
    </div>

    <!-- Thumbnails Gallery -->
    <?php if(isset($images) && count($images) > 1): ?>
    <div class="thumbnails">
        <?php foreach($images as $url => $alt): ?>
            <?php 
            $thumbSrc = base_url($url);
            if (filter_var($url, FILTER_VALIDATE_URL)) {
                $thumbSrc = $url;
            }
            ?>
            <div class="thumb <?php echo $url === $product['thumbnail_image'] ? 'active' : ''; ?>" onclick="changeImage(this)" data-img="<?php echo $thumbSrc; ?>">
                <img src="<?php echo $thumbSrc; ?>" alt="<?php echo $alt; ?>">
            </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- Product Info Details -->
    <div class="product-details">
        <div class="product-price">Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></div>
        <h2 class="product-title"><?php echo $product['name']; ?></h2>
        
        <div class="stock-badge">
            <i class="bi bi-check-circle-fill"></i> Stok Tersedia (<?php echo $product['stock']; ?> pcs)
        </div>

        <div style="font-size: 14px; font-weight: 700; color: var(--text-primary); margin-bottom: 6px;">Deskripsi Produk</div>
        <p class="product-desc"><?php echo nl2br($product['description']); ?></p>
    </div>

    <!-- Spacer for fixed action bar -->
    <div style="height: 90px;"></div>

    <!-- Action Buttons Bar -->
    <div class="btn-wrapper">
        <button class="btn-cart" onclick="addToCart(<?php echo $product['id']; ?>)">
            <i class="bi bi-cart-plus-fill"></i> Keranjang
        </button>
        <?php
        $whatsapp = isset($store['whatsapp']) ? $store['whatsapp'] : (isset($store['phone']) ? $store['phone'] : '6281234567890');
        if (!empty($whatsapp)):
            $message = "Halo ".$store['name'].", saya berminat pesan produk berikut:\n\n".
                       "📌 *Nama Produk:* ".$product['name']."\n".
                       "💰 *Harga:* Rp " . number_format($product['price'], 0, ',', '.') . "\n".
                       "🔗 *Link Produk:* " . site_url($product['slug']) . "\n\n".
                       "Mohon info ketersediaan stok & cara pembayarannya. Terima kasih!";
            $whatsapp_link = "https://wa.me/" . preg_replace('/[^0-9]/', '', $whatsapp) . "?text=" . urlencode($message);
        ?>
        <button class="btn-order" onclick="window.open('<?php echo $whatsapp_link; ?>', '_blank')">
            <i class="bi bi-whatsapp"></i> Beli via WA
        </button>
        <?php endif; ?>
    </div>

<?php else: ?>
    <div class="text-center py-5">
        <i class="bi bi-exclamation-circle display-2 text-danger"></i>
        <p class="mt-3 text-muted">Produk tidak ditemukan.</p>
        <a href="<?php echo base_url('products'); ?>" class="btn btn-primary mt-2">Kembali ke Katalog</a>
    </div>
<?php endif; ?>

<script>
    function changeImage(element) {
        var mainImgParam = element.getAttribute('data-img');
        var mainImgContainer = document.querySelector('#mainImage img');
        if (!mainImgContainer && document.querySelector('#mainImage')) {
            document.querySelector('#mainImage').innerHTML = '<img src="' + mainImgParam + '">';
        } else if (mainImgContainer) {
            mainImgContainer.src = mainImgParam;
        }

        document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
        element.classList.add('active');
    }
</script>