<div class="header">
    <h1><i class="bi bi-box-seam-fill"></i> Katalog Produk</h1>
    <p>Temukan produk impian Anda dengan harga dan kualitas terbaik</p>
</div>

<!-- Search Input Box -->
<div class="search-box">
    <form action="<?php echo base_url('products'); ?>" method="get">
        <input type="text" name="search" class="search-input" placeholder="🔍 Cari nama produk..." value="<?php echo isset($search_term) ? htmlspecialchars($search_term) : ''; ?>">
    </form>
</div>

<!-- Categories Filter -->
<div class="categories">
    <a href="<?php echo base_url('products'); ?>" class="category-chip <?php echo !isset($current_category) ? 'active' : ''; ?>">Semua Kategori</a>
    <?php if(isset($categories) && !empty($categories)): ?>
        <?php foreach($categories as $cat): ?>
            <a href="<?php echo base_url('products?category=' . $cat['id']); ?>" class="category-chip <?php echo (isset($current_category) && $current_category['id'] == $cat['id']) ? 'active' : ''; ?>">
                <?php echo $cat['name']; ?>
            </a>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<!-- Section Header -->
<div class="section-title">
    <span>
        <?php if(isset($current_category)): ?>
            Kategori: <?php echo $current_category['name']; ?>
        <?php elseif(isset($search_term)): ?>
            Hasil Pencarian: "<?php echo htmlspecialchars($search_term); ?>"
        <?php else: ?>
            Semua Produk Katalog
        <?php endif; ?>
    </span>
    <span style="font-size: 12px; color: var(--text-muted);"><?php echo count($products ?? []); ?> Produk</span>
</div>

<!-- Product List Layout -->
<div class="product-list">
    <?php if(isset($products) && !empty($products)): ?>
        <?php foreach($products as $product): ?>
            <a href="<?php echo site_url($product['slug']); ?>" class="product-item">
                <div class="product-img">
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
                <div class="list-info">
                    <div class="list-title"><?php echo $product['name']; ?></div>
                    <div class="list-desc"><?php echo substr(strip_tags($product['description']), 0, 70) . '...'; ?></div>
                    <div class="product-price">Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></div>
                </div>
            </a>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="text-center py-5">
            <i class="bi bi-search display-3 text-muted"></i>
            <p class="mt-3 text-muted fw-semibold">Produk tidak ditemukan.</p>
            <a href="<?php echo base_url('products'); ?>" class="btn btn-outline-primary mt-2">Reset Pencarian</a>
        </div>
    <?php endif; ?>
</div>
