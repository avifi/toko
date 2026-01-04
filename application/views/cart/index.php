<div class="container mt-4">
    <h2 class="mb-4">
        <i class="fas fa-shopping-cart"></i> Keranjang Belanja
    </h2>
    
    <?php if (!empty($cart_items)): ?>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <?php foreach ($cart_items as $item): ?>
                    <div class="cart-item">
                        <div class="row align-items-center">
                            <div class="col-3 col-md-2">
                                <img src="<?php echo !empty($item['image']) ? $item['image'] : 'https://via.placeholder.com/80x80?text=No+Image'; ?>" 
                                     class="cart-item-image" alt="<?php echo htmlspecialchars($item['name']); ?>">
                            </div>
                            <div class="col-9 col-md-4">
                                <h6><?php echo htmlspecialchars($item['name']); ?></h6>
                                <p class="text-muted mb-0">Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></p>
                            </div>
                            <div class="col-6 col-md-3 mt-2 mt-md-0">
                                <div class="input-group quantity-input">
                                    <button class="btn btn-outline-secondary btn-sm" type="button" 
                                            onclick="updateQuantity('<?php echo $item['id']; ?>', <?php echo $item['quantity'] - 1; ?>)">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="number" class="form-control form-control-sm text-center" 
                                           value="<?php echo $item['quantity']; ?>" 
                                           id="qty-<?php echo $item['id']; ?>"
                                           onchange="updateQuantity('<?php echo $item['id']; ?>', this.value)"
                                           min="1">
                                    <button class="btn btn-outline-secondary btn-sm" type="button" 
                                            onclick="updateQuantity('<?php echo $item['id']; ?>', <?php echo $item['quantity'] + 1; ?>)">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-4 col-md-2 mt-2 mt-md-0 text-end">
                                <strong>Rp <?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?></strong>
                            </div>
                            <div class="col-2 col-md-1 mt-2 mt-md-0 text-end">
                                <button class="btn btn-outline-danger btn-sm" 
                                        onclick="removeCartItem('<?php echo $item['id']; ?>')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="mt-3">
                <a href="<?php echo base_url('products'); ?>" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left"></i> Lanjut Belanja
                </a>
                <a href="<?php echo base_url('cart/clear'); ?>" class="btn btn-outline-danger" 
                   onclick="return confirm('Hapus semua item dari keranjang?')">
                    <i class="fas fa-trash"></i> Kosongkan Keranjang
                </a>
            </div>
        </div>
        
        <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ringkasan Belanja</h5>
                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal (<?php echo $cart_count; ?> item)</span>
                        <strong>Rp <?php echo number_format($cart_total, 0, ',', '.'); ?></strong>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <h5>Total</h5>
                        <h5 class="text-primary">Rp <?php echo number_format($cart_total, 0, ',', '.'); ?></h5>
                    </div>
                    
                    <div class="alert alert-info">
                        <small>
                            <i class="fas fa-info-circle"></i> 
                            Untuk melanjutkan pembelian, silakan hubungi kami melalui WhatsApp atau telepon.
                        </small>
                    </div>
                    
                    <?php if (isset($store['phone']) || isset($store['whatsapp'])): ?>
                    <div class="d-grid gap-2">
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
                        <a href="<?php echo $whatsapp_link; ?>" class="btn btn-success btn-lg" target="_blank">
                            <i class="fab fa-whatsapp"></i> Pesan via WhatsApp
                        </a>
                        <?php endif; ?>
                        
                        <?php if (isset($store['phone']) && !empty($store['phone'])): ?>
                        <a href="tel:<?php echo $store['phone']; ?>" class="btn btn-primary">
                            <i class="fas fa-phone"></i> Hubungi via Telepon
                        </a>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info text-center py-5">
                <i class="fas fa-shopping-cart fa-3x mb-3"></i>
                <h4>Keranjang Belanja Kosong</h4>
                <p>Anda belum menambahkan produk apapun ke keranjang.</p>
                <a href="<?php echo base_url('products'); ?>" class="btn btn-primary mt-3">
                    <i class="fas fa-shopping-bag"></i> Mulai Belanja
                </a>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<script>
    function updateQuantity(productId, quantity) {
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
