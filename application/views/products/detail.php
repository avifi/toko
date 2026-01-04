<div class="container mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Beranda</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url('products'); ?>">Produk</a></li>
            <?php if (isset($category)): ?>
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url('products?category=' . $category['id']); ?>">
                        <?php echo $category['name']; ?>
                    </a>
                </li>
            <?php endif; ?>
            <li class="breadcrumb-item active"><?php echo htmlspecialchars($product['name']); ?></li>
        </ol>
    </nav>
    
    <div class="row">
        <!-- Product Images -->
        <div class="col-md-6 mb-4">
            <div class="product-image-gallery">
                <!-- Main Image -->
                <img id="mainImage" src="<?php echo !empty($images) ? $images[0] : 'https://via.placeholder.com/400x400?text=No+Image'; ?>" 
                     class="main-product-image mb-3" alt="<?php echo htmlspecialchars($product['name']); ?>">
                
                <!-- Thumbnail Images -->
                <?php if (count($images) > 1): ?>
                <div class="row">
                    <?php foreach ($images as $index => $image): ?>
                    <div class="col-3">
                        <img src="<?php echo $image; ?>" 
                             class="img-thumbnail <?php echo $index === 0 ? 'active' : ''; ?>" 
                             alt="Image <?php echo $index + 1; ?>"
                             onclick="changeMainImage('<?php echo $image; ?>', this)">
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Product Details -->
        <div class="col-md-6">
            <h2><?php echo htmlspecialchars($product['name']); ?></h2>
            
            <?php if (isset($category)): ?>
            <p class="text-muted">
                <i class="fas fa-tag"></i> 
                <a href="<?php echo base_url('products?category=' . $category['id']); ?>">
                    <?php echo $category['name']; ?>
                </a>
            </p>
            <?php endif; ?>
            
            <h3 class="price mb-4">Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></h3>
            
            <?php if (isset($product['description']) && !empty($product['description'])): ?>
            <div class="mb-4">
                <h5>Deskripsi</h5>
                <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
            </div>
            <?php endif; ?>
            
            <?php if (isset($product['stock']) && $product['stock'] !== ''): ?>
            <div class="mb-3">
                <strong>Stok:</strong> 
                <?php if (intval($product['stock']) > 0): ?>
                    <span class="text-success"><?php echo $product['stock']; ?> tersedia</span>
                <?php else: ?>
                    <span class="text-danger">Habis</span>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            
            <!-- Add to Cart Form -->
            <div class="mb-4">
                <?php if (!isset($product['stock']) || $product['stock'] === '' || intval($product['stock']) > 0): ?>
                <div class="row g-3">
                    <div class="col-auto">
                        <label for="quantity" class="col-form-label">Jumlah:</label>
                    </div>
                    <div class="col-auto">
                        <input type="number" id="quantity" class="form-control" value="1" min="1" 
                               <?php if (isset($product['stock']) && $product['stock'] !== ''): ?>
                               max="<?php echo $product['stock']; ?>"
                               <?php endif; ?>
                               style="width: 80px;">
                    </div>
                </div>
                
                <button onclick="addToCart('<?php echo $product['id']; ?>', '<?php echo htmlspecialchars($product['name']); ?>')" 
                        class="btn btn-primary btn-lg mt-3">
                    <i class="fas fa-shopping-cart"></i> Tambah ke Keranjang
                </button>
                <?php else: ?>
                <button class="btn btn-secondary btn-lg" disabled>
                    <i class="fas fa-times-circle"></i> Stok Habis
                </button>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Related Products -->
    <?php if (!empty($related_products)): ?>
    <div class="row mt-5">
        <div class="col-12">
            <h3 class="mb-4">Produk Terkait</h3>
        </div>
    </div>
    <div class="row">
        <?php foreach ($related_products as $related): 
            $related_images = array();
            if (!empty($related['image1'])) $related_images[] = $related['image1'];
            if (!empty($related['image2'])) $related_images[] = $related['image2'];
            if (!empty($related['image3'])) $related_images[] = $related['image3'];
            
            $related_image = !empty($related_images) ? $related_images[0] : 'https://via.placeholder.com/300x200?text=No+Image';
        ?>
        <div class="col-6 col-md-3 mb-4">
            <div class="card product-card">
                <img src="<?php echo $related_image; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($related['name']); ?>">
                <div class="card-body">
                    <h6 class="card-title text-truncate"><?php echo $related['name']; ?></h6>
                    <p class="price mb-2">Rp <?php echo number_format($related['price'], 0, ',', '.'); ?></p>
                    <a href="<?php echo base_url('product/' . $related['id']); ?>" class="btn btn-primary btn-sm btn-add-to-cart">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<script>
    function changeMainImage(imageSrc, element) {
        document.getElementById('mainImage').src = imageSrc;
        
        // Remove active class from all thumbnails
        var thumbnails = document.querySelectorAll('.product-image-gallery .img-thumbnail');
        thumbnails.forEach(function(thumb) {
            thumb.classList.remove('active');
        });
        
        // Add active class to clicked thumbnail
        element.classList.add('active');
    }
</script>
