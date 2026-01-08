<?php if(isset($product)): ?>
    <div class="header" style="position: relative; top: auto; z-index: 1;">
        <a href="<?php echo base_url('products'); ?>" class="back-btn"><i class="bi bi-arrow-left"></i></a>
        <h1>Detail Produk</h1>
    </div>

    <div class="product-hero">
        <div class="main-image-container" id="mainImage">
            <?php $mainImage = $product['thumbnail_image']; ?>
            <?php if(filter_var($mainImage, FILTER_VALIDATE_URL)): ?>
                <img src="<?php echo $mainImage; ?>" alt="<?php echo $product['name']; ?>">
            <?php else: ?>
                <i class="<?php echo $mainImage; ?>"></i>
            <?php endif; ?>
        </div>
    </div>

    <?php if(isset($images) && count($images) > 1): ?>
    <div class="thumbnails">
        <?php foreach($images as $url => $alt): ?>
            <div class="thumb <?php echo $url === $product['thumbnail_image'] ? 'active' : ''; ?>" onclick="changeImage(this)" data-img="<?php echo $url; ?>">
                <img src="<?php echo $url; ?>" alt="<?php echo $alt; ?>">
            </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <div class="product-details">
        <div class="product-price">Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></div>
        <h2 class="product-title"><?php echo $product['name']; ?></h2>
        <p class="product-desc"><?php echo $product['description']; ?></p>
        
        <div class="section-header">Stok</div>
        <p><?php echo $product['stock']; ?> unit tersedia</p>
    </div>

    <div style="height: 10px;"></div> <!-- Spacer for action bar -->

    <button class="btn-cart" onclick="addToCart(<?php echo $product['id']; ?>)">
        <i class="bi bi-cart-plus"></i> Tambah Keranjang
    </button>
<?php else: ?>
    <div class="empty-state">
        <div><i class="bi bi-exclamation-circle"></i></div>
        <p>Produk tidak ditemukan</p>
    </div>
<?php endif; ?>

<script>
    function changeImage(element) {
        var mainImgParam = element.getAttribute('data-img');
        var mainImgContainer = document.querySelector('#mainImage img');
        if(!mainImgContainer && document.querySelector('#mainImage')) {
            document.querySelector('#mainImage').innerHTML = '<img src="'+mainImgParam+'">';
        } else if (mainImgContainer) {
            mainImgContainer.src = mainImgParam;
        }

        document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
        element.classList.add('active');
    }
</script>