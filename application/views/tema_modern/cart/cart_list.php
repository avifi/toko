<?php if(!empty($cart_items)): ?>
    <div style="display: flex; flex-direction: column; gap: 12px; margin-bottom: 120px;">
        <?php 
        $wa_message_items = "";
        $item_index = 1;
        ?>
        <?php foreach($cart_items as $item): ?>
            <?php 
            $subtotal = $item['price'] * $item['quantity'];
            $imgSrc = base_url($item['image']);
            if (filter_var($item['image'], FILTER_VALIDATE_URL)) {
                $imgSrc = $item['image'];
            }
            
            // Build WhatsApp order list string
            $wa_message_items .= $item_index . ". " . $item['name'] . " (" . $item['quantity'] . " x Rp " . number_format($item['price'], 0, ',', '.') . ") = Rp " . number_format($subtotal, 0, ',', '.') . "\n";
            $item_index++;
            ?>
            <div style="display: flex; align-items: center; gap: 14px; background: white; padding: 14px 16px; border-radius: 14px; border: 1px solid #e2e8f0; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
                <!-- Image -->
                <div style="width: 70px; height: 70px; border-radius: 10px; background: #f8fafc; overflow: hidden; flex-shrink: 0; display: flex; align-items: center; justify-content: center; border: 1px solid #e2e8f0;">
                    <?php if(!empty($item['image'])): ?>
                        <img src="<?php echo $imgSrc; ?>" alt="<?php echo $item['name']; ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    <?php else: ?>
                        <i class="bi bi-box-seam" style="font-size: 28px; color: #94a3b8;"></i>
                    <?php endif; ?>
                </div>

                <!-- Info -->
                <div style="flex: 1; min-width: 0;">
                    <div style="font-size: 14.5px; font-weight: 700; color: #0f172a; margin-bottom: 4px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                        <?php echo $item['name']; ?>
                    </div>
                    <div style="font-size: 15px; font-weight: 800; color: #6366f1;">
                        Rp <?php echo number_format($item['price'], 0, ',', '.'); ?>
                    </div>
                </div>

                <!-- Quantity Controls -->
                <div style="display: flex; align-items: center; gap: 6px; background: #f8fafc; padding: 4px 8px; border-radius: 999px; border: 1px solid #e2e8f0;">
                    <button style="width: 26px; height: 26px; border-radius: 50%; border: none; background: white; font-weight: 800; font-size: 14px; color: #0f172a; cursor: pointer; box-shadow: 0 1px 3px rgba(0,0,0,0.1); display: flex; align-items: center; justify-content: center;" onclick="updateCartItem(<?php echo $item['id']; ?>, <?php echo $item['quantity'] - 1; ?>)">-</button>
                    
                    <span style="font-size: 14px; font-weight: 700; min-width: 20px; text-align: center; color: #0f172a;"><?php echo $item['quantity']; ?></span>
                    
                    <button style="width: 26px; height: 26px; border-radius: 50%; border: none; background: white; font-weight: 800; font-size: 14px; color: #0f172a; cursor: pointer; box-shadow: 0 1px 3px rgba(0,0,0,0.1); display: flex; align-items: center; justify-content: center;" onclick="updateCartItem(<?php echo $item['id']; ?>, <?php echo $item['quantity'] + 1; ?>)">+</button>
                </div>

                <!-- Remove Button -->
                <div style="color: #ef4444; cursor: pointer; font-size: 18px; padding: 6px; border-radius: 50%;" onclick="removeCartItem(<?php echo $item['id']; ?>)" title="Hapus dari keranjang">
                    <i class="bi bi-trash3-fill"></i>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Floating Summary Card -->
    <div style="position: fixed; bottom: 60px; left: 0; right: 0; max-width: 850px; margin: 0 auto; background: white; padding: 16px 20px; box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.08); border-top: 1px solid #e2e8f0; border-top-left-radius: 16px; border-top-right-radius: 16px; z-index: 900;">
        <div style="display: flex; justify-content: space-between; margin-bottom: 6px; font-size: 14px; color: #64748b; font-weight: 500;">
            <span>Total Item Produk</span>
            <span style="font-weight: 700; color: #0f172a;"><?php echo $cart_count; ?> pcs</span>
        </div>
        
        <div style="display: flex; justify-content: space-between; font-weight: 800; color: #0f172a; font-size: 17px; margin-bottom: 12px; padding-top: 6px; border-top: 1px dashed #e2e8f0;">
            <span>Total Pembayaran</span>
            <span style="color: #6366f1;">Rp <?php echo number_format($cart_total, 0, ',', '.'); ?></span>
        </div>

        <?php 
        $whatsapp = isset($store['whatsapp']) ? $store['whatsapp'] : (isset($store['phone']) ? $store['phone'] : '6281234567890');
        $store_name = isset($store['name']) ? $store['name'] : 'Toko Modern Shop';
        
        $wa_full_message = "Halo " . $store_name . ", saya ingin melakukan pemesanan dari keranjang belanja:\n\n" . 
                           $wa_message_items . "\n" .
                           "📦 *Total Barang:* " . $cart_count . " pcs\n" .
                           "💰 *Total Bayar:* Rp " . number_format($cart_total, 0, ',', '.') . "\n\n" .
                           "Mohon petunjuk pembayaran dan konfirmasi pengiriman. Terima kasih!";
        $wa_checkout_link = "https://wa.me/" . preg_replace('/[^0-9]/', '', $whatsapp) . "?text=" . urlencode($wa_full_message);
        ?>

        <button style="width: 100%; padding: 14px; border-radius: 12px; background: linear-gradient(135deg, #25d366 0%, #128c7e 100%); color: white; border: none; font-weight: 800; font-size: 15px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 4px 14px rgba(37, 211, 102, 0.35);" onclick="window.open('<?php echo $wa_checkout_link; ?>', '_blank')">
            <i class="bi bi-whatsapp" style="font-size: 19px;"></i> Checkout via WhatsApp (Rp <?php echo number_format($cart_total, 0, ',', '.'); ?>)
        </button>
    </div>

<?php else: ?>
    <!-- Empty Cart State -->
    <div style="background: white; border-radius: 16px; padding: 40px 20px; text-align: center; border: 1px solid #e2e8f0; box-shadow: 0 4px 12px rgba(0,0,0,0.03); max-width: 600px; margin: 20px auto;">
        <div style="width: 80px; height: 80px; border-radius: 50%; background: #f1f5f9; color: #94a3b8; display: flex; align-items: center; justify-content: center; font-size: 38px; margin: 0 auto 16px;">
            <i class="bi bi-basket3-fill"></i>
        </div>
        <h3 style="font-size: 18px; font-weight: 800; color: #0f172a; margin-bottom: 6px;">Keranjang Belanja Anda Kosong</h3>
        <p style="font-size: 13.5px; color: #64748b; margin-bottom: 20px; line-height: 1.5;">
            Sepertinya Anda belum menambahkan produk apapun ke keranjang. Yuk jelajahi katalog produk pilihan kami sekarang!
        </p>
        <a href="<?php echo base_url('products'); ?>" style="display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%); color: white; padding: 12px 26px; border-radius: 999px; font-weight: 700; font-size: 14px; text-decoration: none; box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25);">
            <i class="bi bi-shop"></i> Mulai Belanja Sekarang
        </a>
    </div>
<?php endif; ?>