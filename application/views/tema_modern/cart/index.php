<div class="header">
    <h1><i class="bi bi-basket"></i> Keranjang Belanja</h1>
</div>

<div id="cart-list" style="padding: 20px;">
    <?php if(isset($cart_items) && !empty($cart_items)): ?>
        <?php foreach($cart_items as $item): ?>
            <div class="cart-item">
                <div class="cart-item-img">
                     <?php 
                        $img = isset($item['options']['image']) ? $item['options']['image'] : (isset($item['image']) ? $item['image'] : 'bi bi-box');
                     ?>
                     <?php if(filter_var($img, FILTER_VALIDATE_URL)): ?>
                        <img src="<?php echo $img; ?>" alt="<?php echo $item['name']; ?>">
                    <?php else: ?>
                        <i class="<?php echo $img; ?>"></i>
                    <?php endif; ?>
                </div>
                <div class="cart-item-info">
                    <div class="cart-item-title"><?php echo $item['name']; ?></div>
                    <div class="cart-item-price">Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></div>
                </div>
                <div class="cart-controls">
                    <!-- Simple implementation: reload on change would be better handled by proper JS -->
                    <!-- For now, we reuse the theme's logic which might need a reload -->
                    <div class="qty-btn" onclick="updateQty(<?php echo $item['id']; ?>, <?php echo $item['quantity'] - 1; ?>)">-</div>
                    <div class="qty-val"><?php echo $item['quantity']; ?></div>
                    <div class="qty-btn" onclick="updateQty(<?php echo $item['id']; ?>, <?php echo $item['quantity'] + 1; ?>)">+</div>
                    <div class="delete-btn" onclick="removeItem('<?php echo $item['id']; ?>')"><i class="bi bi-trash"></i></div>
                </div>
            </div>
        <?php endforeach; ?>
        
        <div style="height: 150px;"></div> <!-- Spacer -->

        <div class="summary-card" id="summary-section">
            <div class="summary-row">
                <span>Total</span>
                <span class="summary-total" id="total">Rp <?php echo number_format($cart_total, 0, ',', '.'); ?></span>
            </div>
            <?php
            $whatsapp = isset($store['whatsapp']) ? $store['whatsapp'] : (isset($store['phone']) ? $store['phone'] : '');
            if (!empty($whatsapp)):
                // Generate WhatsApp message
                $message = "Halo, saya ingin memesan:\n\n";
                foreach ($cart_items as $item) {
                    $message .= "- " . $item['name'] . " (x" . $item['quantity'] . ") = Rp " . number_format($item['price'] * $item['quantity'], 0, ',', '.') . "\n";
                }
                $message .= "\nTotal: Rp " . number_format($cart_total, 0, ',', '.') . "\n\nTerima kasih!";
                $whatsapp_link = "https://wa.me/" . preg_replace('/[^0-9]/', '', $whatsapp) . "?text=" . urlencode($message);
            ?>
            <button class="checkout-btn" onclick="window.location.href = '<?php echo $whatsapp_link; ?>'">Checkout via WhatsApp</button>
            <?php endif; ?>
        </div>

    <?php else: ?>
        <div class="empty-state">
            <div><i class="bi bi-cart"></i></div>
            <h3>Keranjang Kosong</h3>
            <p>Yuk belanja dulu!</p>
            <br>
            <a href="<?php echo base_url(); ?>" style="color:#667eea; text-decoration:none; font-weight:bold;">Ke Beranda</a>
        </div>
    <?php endif; ?>
</div>

<script>
    function updateQty(productId, quantity) {
        quantity = parseInt(quantity);
        if (quantity < 1) {
            if (confirm('Hapus produk dari keranjang?')) {
                removeCartItem(productId);
            } else {
                document.getElementById('qty-' + productId).value = 1;
            }
            return;
        }
        
        updateCartItem(productId, quantity);
    }
</script>
