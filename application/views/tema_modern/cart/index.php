<div class="header" style="position: relative; top: auto; z-index: 1;">
    <h1><i class="bi bi-basket"></i> Keranjang Belanja</h1>
</div>

<div id="cart-list" style="padding: 20px;">
    <!-- diisi oleh ajax -->
</div>

<script>
    $(document).ready(function () {
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
    });

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
                    $('#cart-list').html(response.html);
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
                        $('#cart-list').html(response.html);
                    }
                }
            });
        }
    }
</script>

