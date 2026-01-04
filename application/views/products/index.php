<div class="container mt-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h2>
                <?php 
                if (isset($current_category)) {
                    echo 'Kategori: ' . $current_category['name'];
                } elseif (isset($search_term)) {
                    echo 'Hasil Pencarian: "' . htmlspecialchars($search_term) . '"';
                } else {
                    echo 'Semua Produk';
                }
                ?>
            </h2>
            <?php if (isset($current_category) && !empty($current_category['description'])): ?>
                <p class="text-muted"><?php echo $current_category['description']; ?></p>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Search and Filter -->
    <div class="row mb-4">
        <div class="col-md-6">
            <form method="get" action="<?php echo base_url('products'); ?>" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Cari produk..." 
                       value="<?php echo isset($search_term) ? htmlspecialchars($search_term) : ''; ?>">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>
    
    <!-- Categories Filter -->
    <?php if (!empty($categories)): ?>
    <div class="row mb-4">
        <div class="col-12">
            <h5>Filter Kategori:</h5>
            <div class="d-flex flex-wrap">
                <a href="<?php echo base_url('products'); ?>" 
                   class="category-badge <?php echo !isset($current_category) ? 'active' : ''; ?>">
                    Semua
                </a>
                <?php foreach ($categories as $category): ?>
                    <a href="<?php echo base_url('products?category=' . $category['id']); ?>" 
                       class="category-badge <?php echo (isset($current_category) && $current_category['id'] == $category['id']) ? 'active' : ''; ?>">
                        <?php echo $category['name']; ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Products Grid -->
    <div class="row">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): 
                $images = array();
                if (!empty($product['image1'])) $images[] = $product['image1'];
                if (!empty($product['image2'])) $images[] = $product['image2'];
                if (!empty($product['image3'])) $images[] = $product['image3'];
                
                $default_image = !empty($images) ? $images[0] : 'https://via.placeholder.com/300x200?text=No+Image';
            ?>
            <div class="col-6 col-md-4 col-lg-3 mb-4">
                <div class="card product-card">
                    <img src="<?php echo $default_image; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <div class="card-body">
                        <h6 class="card-title text-truncate" title="<?php echo htmlspecialchars($product['name']); ?>">
                            <?php echo $product['name']; ?>
                        </h6>
                        <p class="price mb-2">Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></p>
                        <?php if (isset($product['stock']) && $product['stock'] !== '' && intval($product['stock']) <= 0): ?>
                            <button class="btn btn-secondary btn-sm btn-add-to-cart" disabled>
                                Stok Habis
                            </button>
                        <?php else: ?>
                            <a href="<?php echo base_url('product/' . $product['id']); ?>" class="btn btn-primary btn-sm btn-add-to-cart">
                                Lihat Detail
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle"></i> 
                    <?php 
                    if (isset($search_term)) {
                        echo 'Tidak ada produk yang sesuai dengan pencarian Anda.';
                    } else {
                        echo 'Tidak ada produk dalam kategori ini.';
                    }
                    ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
