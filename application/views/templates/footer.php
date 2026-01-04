    <!-- Footer -->
    <footer class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5><?php echo isset($store['name']) ? $store['name'] : 'Toko Online'; ?></h5>
                    <p><?php echo isset($store['about']) ? $store['about'] : 'Toko online terpercaya'; ?></p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Kontak</h5>
                    <?php if (isset($store['phone'])): ?>
                        <p><i class="fas fa-phone"></i> <?php echo $store['phone']; ?></p>
                    <?php endif; ?>
                    <?php if (isset($store['email'])): ?>
                        <p><i class="fas fa-envelope"></i> <?php echo $store['email']; ?></p>
                    <?php endif; ?>
                    <?php if (isset($store['address'])): ?>
                        <p><i class="fas fa-map-marker-alt"></i> <?php echo $store['address']; ?></p>
                    <?php endif; ?>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Navigasi</h5>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo base_url(); ?>" class="text-white text-decoration-none">Beranda</a></li>
                        <li><a href="<?php echo base_url('products'); ?>" class="text-white text-decoration-none">Produk</a></li>
                        <li><a href="<?php echo base_url('cart'); ?>" class="text-white text-decoration-none">Keranjang</a></li>
                    </ul>
                </div>
            </div>
            <hr class="bg-white">
            <div class="text-center">
                <p>&copy; <?php echo date('Y'); ?> <?php echo isset($store['name']) ? $store['name'] : 'Toko Online'; ?>. All rights reserved.</p>
            </div>
        </div>
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        // Add to cart functionality
        function addToCart(productId, productName) {
            $.ajax({
                url: '<?php echo base_url('cart/add'); ?>',
                type: 'POST',
                data: {
                    product_id: productId,
                    quantity: $('#quantity').val() || 1
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Update cart badge
                        updateCartBadge(response.cart_count);
                        
                        // Show success message
                        showAlert('success', response.message);
                    } else {
                        showAlert('danger', response.message);
                    }
                },
                error: function() {
                    showAlert('danger', 'Terjadi kesalahan. Silakan coba lagi.');
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
        
        // Update cart badge
        function updateCartBadge(count) {
            var badge = $('.cart-badge');
            if (count > 0) {
                if (badge.length) {
                    badge.text(count);
                } else {
                    $('.nav-link.position-relative').append('<span class="cart-badge">' + count + '</span>');
                }
            } else {
                badge.remove();
            }
        }
        
        // Show alert message
        function showAlert(type, message) {
            var alert = $('<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert">' +
                message +
                '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
                '</div>');
            
            $('.container').first().prepend(alert);
            
            setTimeout(function() {
                alert.alert('close');
            }, 3000);
        }
        
        // Format currency
        function formatCurrency(amount) {
            return 'Rp ' + parseInt(amount).toLocaleString('id-ID');
        }
    </script>
</body>
</html>
