<div class="header">
    <h1><i class="bi bi-box-seam"></i> Semua Produk</h1>
</div>

<div class="search-box">
    <form action="<?php echo base_url('products'); ?>" method="get">
        <input type="text" name="search" class="search-input" placeholder="Cari produk..." value="<?php echo isset($search_term) ? $search_term : ''; ?>">
    </form>
</div>

<div class="categories">
    <a href="<?php echo base_url('products'); ?>" class="category-chip <?php echo !isset($current_category) ? 'active' : ''; ?>">Semua</a>
    <?php if(isset($categories)): ?>
        <?php foreach($categories as $cat): ?>
            <a href="<?php echo base_url('products?category=' . $cat['id']); ?>" class="category-chip <?php echo (isset($current_category) && $current_category['id'] == $cat['id']) ? 'active' : ''; ?>">
                <?php echo $cat['name']; ?>
            </a>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<div class="product-list">
    <?php if(isset($products) && !empty($products)): ?>
        <?php foreach($products as $product): ?>
            <a href="<?php echo site_url($product['slug']); ?>" class="product-item">
                <div class="product-img">
                     <?php if(filter_var($product['thumbnail_image'], FILTER_VALIDATE_URL)): ?>
                        <img src="<?php echo $product['thumbnail_image']; ?>" alt="<?php echo $product['name']; ?>">
                    <?php else: ?>
                        <i class="<?php echo $product['thumbnail_image']; ?>"></i>
                    <?php endif; ?>
                </div>
                <div class="list-info">
                    <div class="list-title"><?php echo $product['name']; ?></div>
                    <div class="list-desc"><?php echo substr($product['description'], 0, 50) . '...'; ?></div>
                    <div class="product-price">Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></div>
                </div>
            </a>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="empty-state">
            <div><i class="bi bi-search"></i></div>
            <p>Produk tidak ditemukan</p>
        </div>
    <?php endif; ?>
</div>
