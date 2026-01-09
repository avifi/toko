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

    <script src="<?php echo base_url('assets/main.js'); ?>"></script>
    
    <script>
        function addToCart(productId) {
            $.ajax({
                url: '<?php echo base_url('cart/add'); ?>',
                type: 'POST',
                data: {
                    product_id: productId,
                    quantity: 1
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        showAlert("success", "Berhasil masuk keranjang <i class='bi bi-cart-check'></i>");

                        var cartNav = $('.nav-item[href*="cart"]');
                        var badge = cartNav.find('.nav-badge');

                        if (badge.length) {
                            badge.text(response.cart_count);
                        } else {
                            cartNav.append('<div class="nav-badge">'+response.cart_count+'</div>');
                        }
                    } else {
                        showAlert("danger", response.message);
                    }
                },
                error: function() {
                    showAlert("danger", "Terjadi kesalahan.");
                }
            });
        }

        function showAlert(type, message) {
            var alert = $(
                '<div class="alert alert-' + type + ' alert-dismissible fade show">' +
                message +
                '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
                '</div>'
            );

            $('body').prepend(alert);

            setTimeout(() => alert.alert('close'), 3000);
        }


    </script>
</body>
</html>
