    </div>
    <nav class="bottom-nav">
        <a href="<?php echo base_url(); ?>" class="nav-item <?php echo ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'home') ? 'active' : ''; ?>">
            <div class="nav-icon"><i class="bi bi-house-door-fill"></i></div>
            <div>Beranda</div>
        </a>
        <a href="<?php echo base_url('products'); ?>" class="nav-item <?php echo ($this->uri->segment(1) == 'products') ? 'active' : ''; ?>">
            <div class="nav-icon"><i class="bi bi-box-seam"></i></div>
            <div>Produk</div>
        </a>
        <a href="<?php echo base_url('cart'); ?>" class="nav-item <?php echo ($this->uri->segment(1) == 'cart') ? 'active' : ''; ?>">
            <div class="nav-icon"><i class="bi bi-cart"></i></div>
            <div>Keranjang</div>
            <?php if (isset($cart_count) && $cart_count > 0): ?>
                <div class="nav-badge"><?php echo $cart_count; ?></div>
            <?php endif; ?>
        </a>
        <a href="<?php echo base_url('about'); ?>" class="nav-item <?php echo ($this->uri->segment(1) == 'about') ? 'active' : ''; ?>">
            <div class="nav-icon"><i class="bi bi-info-circle"></i></div>
            <div>Tentang</div>
        </a>
    </nav>

    <div id="alert" class="toast"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="<?php echo base_url('assets/main.js'); ?>"></script>
    
    <script>
        // --- Global Actions ---
        function addToCart(productId) {
            $.ajax({
                url: '<?php echo base_url('cart/add'); ?>',
                type: 'POST',
                data: {
                    product_id: productId,
                    quantity: 1 // Default 1 for quick add
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        showAlert("success", "Berhasil masuk keranjang! <i class='bi bi-cart-check'></i>");
                        // Refresh page or update badge if needed. 
                        // For simplicity, we just reload if logic allows, but better to update badge dynamically
                        if(response.cart_count) {
                            var badge = $('.nav-badge');
                            if(badge.length) {
                                badge.text(response.cart_count);
                            } else {
                                $('.nav-item i.bi-cart').parent().parent().append('<div class="nav-badge">'+response.cart_count+'</div>');
                            }
                        }
                    } else {
                        showAlert("danger", "Gagal: " + response.message);
                    }
                },
                error: function() {
                    showAlert("danger", "Terjadi kesalahan.");
                }
            });
        }

        // Update cart item quantity
        function updateCartItem(productId, quantity) {
            $.ajax({
                url: '<?php echo base_url('cart/update'); ?>',
                type: 'POST',
                data: {
                    product_id: productId,
                    quantity: quantity
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Reload page to update totals
                        location.reload();
                    }
                }
            });
        }
        
        // Remove item from cart
        function removeCartItem(productId) {
            if (confirm('Hapus produk dari keranjang?')) {
                $.ajax({
                    url: '<?php echo base_url('cart/remove'); ?>',
                    type: 'POST',
                    data: {
                        product_id: productId
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        }
                    }
                });
            }
        }

    </script>
</body>
</html>
