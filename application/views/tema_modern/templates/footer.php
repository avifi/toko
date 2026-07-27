    </div>

    <!-- Bottom Navigation Bar -->
    <nav class="bottom-nav">
        <a href="<?php echo base_url(); ?>" class="nav-item <?php echo ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'home') ? 'active' : ''; ?>">
            <div class="nav-icon"><i class="bi bi-house-door-fill"></i></div>
            <div>Beranda</div>
        </a>
        <a href="<?php echo base_url('products'); ?>" class="nav-item <?php echo ($this->uri->segment(1) == 'products') ? 'active' : ''; ?>">
            <div class="nav-icon"><i class="bi bi-grid-fill"></i></div>
            <div>Produk</div>
        </a>
        <a href="<?php echo base_url('cart'); ?>" class="nav-item <?php echo ($this->uri->segment(1) == 'cart') ? 'active' : ''; ?>">
            <div class="nav-icon"><i class="bi bi-bag-fill"></i></div>
            <div>Keranjang</div>
            <?php if (isset($cart_count) && $cart_count > 0): ?>
                <div class="nav-badge"><?php echo $cart_count; ?></div>
            <?php endif; ?>
        </a>
        <a href="<?php echo base_url('about'); ?>" class="nav-item <?php echo ($this->uri->segment(1) == 'about') ? 'active' : ''; ?>">
            <div class="nav-icon"><i class="bi bi-info-circle-fill"></i></div>
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
                        showAlert("success", "<i class='bi bi-check-circle-fill me-1'></i> Berhasil ditambahkan ke keranjang!");

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
                    showAlert("danger", "Terjadi kesalahan koneksi.");
                }
            });
        }

        function showAlert(type, message) {
            $('.alert').remove();
            var alert = $(
                '<div class="alert alert-' + type + '">' +
                message +
                '</div>'
            );

            $('body').append(alert);

            setTimeout(function() {
                alert.fadeOut(300, function() {
                    $(this).remove();
                });
            }, 2500);
        }
    </script>
</body>
</html>
