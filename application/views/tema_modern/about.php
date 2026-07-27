<!-- Header -->
<div class="header">
    <h1><i class="bi bi-info-circle-fill me-2"></i> Tentang Kami</h1>
    <p>Kenal lebih dekat dengan toko online terpercaya pilihan Anda</p>
</div>

<div class="container-about" style="max-width: 800px; margin: 0 auto; padding: 20px 16px 80px;">
    
    <!-- Store Main Profile Card -->
    <div style="background: white; border-radius: 16px; padding: 28px 20px; text-align: center; border: 1px solid #e2e8f0; box-shadow: 0 4px 12px rgba(0,0,0,0.03); margin-bottom: 20px;">
        <div style="width: 90px; height: 90px; margin: 0 auto 14px; border-radius: 50%; padding: 4px; background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%); box-shadow: 0 8px 16px rgba(99, 102, 241, 0.2);">
            <?php if(isset($store['logo']) && !empty($store['logo'])): ?>
                <img src="<?php echo base_url($store['logo']); ?>" alt="Logo Toko" style="width: 100%; height: 100%; object-fit: contain; background: white; border-radius: 50%; padding: 4px;">
            <?php else: ?>
                <div style="width: 100%; height: 100%; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 38px; color: #6366f1;">
                    <i class="bi bi-bag-heart-fill"></i>
                </div>
            <?php endif; ?>
        </div>

        <h2 style="font-size: 22px; font-weight: 800; color: #0f172a; margin-bottom: 6px; display: flex; align-items: center; justify-content: center; gap: 6px;">
            <?php echo isset($store['name']) ? $store['name'] : 'TOKO MODERN SHOP'; ?>
            <i class="bi bi-patch-check-fill text-primary" style="font-size: 20px;" title="Toko Terverifikasi"></i>
        </h2>
        
        <p style="font-size: 13.5px; color: #64748b; font-style: italic; margin-bottom: 16px; line-height: 1.5;">
            "<?php echo isset($store['slogan']) ? $store['slogan'] : 'Pusat belanja online terpercaya dengan harga & kualitas terbaik'; ?>"
        </p>

        <!-- Profile Description Box -->
        <div style="background: #f8fafc; border-radius: 12px; padding: 16px; border: 1px solid #e2e8f0; text-align: left; margin-top: 10px;">
            <div style="font-size: 13px; font-weight: 800; color: #6366f1; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; display: flex; align-items: center; gap: 6px;">
                <i class="bi bi-shop"></i> Profil & Visi Toko
            </div>
            <p style="font-size: 14px; color: #334155; line-height: 1.6; margin: 0;">
                <?php echo isset($store['description']) ? $store['description'] : 'Kami adalah toko online terpercaya yang menyediakan berbagai macam produk pilihan berkualitas tinggi dengan harga yang sangat bersaing. Kami selalu mengedepankan kualitas produk, pelayanan cepat, dan kepuasan pelanggan.'; ?>
            </p>
        </div>
    </div>

    <!-- Trust Features Grid -->
    <?php if(isset($features) && !empty($features)): ?>
    <div style="background: white; border-radius: 16px; padding: 20px; border: 1px solid #e2e8f0; box-shadow: 0 4px 12px rgba(0,0,0,0.03); margin-bottom: 20px;">
        <h3 style="font-size: 16px; font-weight: 800; color: #0f172a; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
            <i class="bi bi-shield-check text-primary" style="font-size: 20px;"></i> Keunggulan Layanan Kami
        </h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 12px;">
            <?php foreach($features as $feature): ?>
            <div style="background: #f8fafc; padding: 16px 12px; border-radius: 12px; border: 1px solid #e2e8f0; text-align: center;">
                <div style="font-size: 30px; color: #6366f1; margin-bottom: 8px;">
                    <i class="<?php echo isset($feature['icon']) ? $feature['icon'] : 'bi bi-star-fill'; ?>"></i>
                </div>
                <div style="font-size: 13.5px; font-weight: 700; color: #0f172a; margin-bottom: 4px; line-height: 1.3;">
                    <?php echo isset($feature['title']) ? $feature['title'] : (isset($feature['name']) ? $feature['name'] : ''); ?>
                </div>
                <div style="font-size: 12px; color: #64748b; line-height: 1.4;">
                    <?php echo isset($feature['description']) ? $feature['description'] : ''; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Contact Information Cards -->
    <div style="background: white; border-radius: 16px; padding: 20px; border: 1px solid #e2e8f0; box-shadow: 0 4px 12px rgba(0,0,0,0.03); margin-bottom: 20px;">
        <h3 style="font-size: 16px; font-weight: 800; color: #0f172a; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
            <i class="bi bi-headset text-primary" style="font-size: 20px;"></i> Informasi Kontak & Operasional
        </h3>
        
        <div style="display: flex; flex-direction: column; gap: 10px;">
            
            <?php if(isset($store['address'])): ?>
            <div style="display: flex; align-items: center; gap: 14px; padding: 14px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px;">
                <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(99, 102, 241, 0.12); color: #6366f1; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <div style="display: flex; flex-direction: column;">
                    <span style="font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px;">Alamat Toko</span>
                    <span style="font-size: 14px; font-weight: 700; color: #0f172a; margin-top: 2px;"><?php echo $store['address']; ?></span>
                </div>
            </div>
            <?php endif; ?>

            <?php if(isset($store['phone']) || isset($store['whatsapp'])): ?>
            <div style="display: flex; align-items: center; gap: 14px; padding: 14px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px;">
                <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(37, 211, 102, 0.12); color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;">
                    <i class="bi bi-whatsapp"></i>
                </div>
                <div style="display: flex; flex-direction: column;">
                    <span style="font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px;">WhatsApp / Customer Support</span>
                    <span style="font-size: 14px; font-weight: 700; color: #0f172a; margin-top: 2px;"><?php echo $store['whatsapp'] ?? $store['phone']; ?></span>
                </div>
            </div>
            <?php endif; ?>

            <?php if(isset($store['email'])): ?>
            <div style="display: flex; align-items: center; gap: 14px; padding: 14px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px;">
                <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(14, 165, 233, 0.12); color: #0ea5e9; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;">
                    <i class="bi bi-envelope-fill"></i>
                </div>
                <div style="display: flex; flex-direction: column;">
                    <span style="font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px;">Email Resmi</span>
                    <span style="font-size: 14px; font-weight: 700; color: #0f172a; margin-top: 2px;"><?php echo $store['email']; ?></span>
                </div>
            </div>
            <?php endif; ?>

            <div style="display: flex; align-items: center; gap: 14px; padding: 14px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px;">
                <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(245, 158, 11, 0.12); color: #f59e0b; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;">
                    <i class="bi bi-clock-fill"></i>
                </div>
                <div style="display: flex; flex-direction: column;">
                    <span style="font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px;">Jam Operasional</span>
                    <span style="font-size: 14px; font-weight: 700; color: #0f172a; margin-top: 2px;">Senin - Sabtu, 09:00 - 18:00 WIB</span>
                </div>
            </div>

        </div>
    </div>

    <!-- Social Media Section -->
    <?php if(isset($sosmed) && !empty($sosmed)): ?>
    <div style="background: white; border-radius: 16px; padding: 20px; border: 1px solid #e2e8f0; box-shadow: 0 4px 12px rgba(0,0,0,0.03); text-align: center;">
        <h3 style="font-size: 16px; font-weight: 800; color: #0f172a; margin-bottom: 14px; display: flex; align-items: center; justify-content: center; gap: 8px;">
            <i class="bi bi-share-fill text-primary" style="font-size: 18px;"></i> Ikuti Media Sosial Kami
        </h3>
        <div style="display: flex; justify-content: center; gap: 14px;">
            <?php foreach($sosmed as $social): ?>
                <?php if(isset($social['url'])): ?>
                     <a href="<?php echo $social['url']; ?>" target="_blank" title="<?php echo $social['name']; ?>" style="width: 46px; height: 46px; border-radius: 50%; background: #f8fafc; color: #4f46e5; display: flex; align-items: center; justify-content: center; font-size: 22px; text-decoration: none; border: 1px solid #e2e8f0; box-shadow: 0 2px 6px rgba(0,0,0,0.04); transition: transform 0.2s;">
                        <i class="<?php echo !empty($social['icon']) ? $social['icon'] : 'bi bi-globe'; ?>"></i>
                     </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

</div>
