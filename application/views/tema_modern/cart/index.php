<div class="header">
    <h1><i class="bi bi-bag-fill me-2"></i> Keranjang Belanja</h1>
    <p>Kelola item pilihan Anda sebelum melakukan order</p>
</div>

<div class="cart-wrapper" style="padding: 20px 20px 100px;">
    <div id="cart-list">
        <!-- Loaded asynchronously by loadCart() -->
    </div>
</div>

<script>
    $(document).ready(function () {
        loadCart();
    });

    function loadCart() {
        $.ajax({
            url: '<?php echo base_url('cart/get_list'); ?>',
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#cart-list').html(response.html);
                }
            }
        });
    }

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
                    $('#cart-list').html(response.html);
                }
            }
        });
    }
    
    function removeCartItem(productId) {
        if (confirm('Hapus produk ini dari keranjang belanja?')) {
            $.ajax({
                url: '<?php echo base_url('cart/remove'); ?>',
                type: 'POST',
                data: {
                    product_id: productId
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#cart-list').html(response.html);
                        showAlert("success", "<i class='bi bi-trash3-fill me-1'></i> Item berhasil dihapus!");
                    }
                }
            });
        }
    }
</script>
