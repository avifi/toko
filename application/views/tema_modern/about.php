    <div class="header" style="position: relative; top: auto; z-index: 1;">
        <h1><i class="bi bi-info-circle"></i> Tentang Kami</h1>
    </div>

    <div class="tentang-content">
        <div class="logo-section"><?php echo isset($store['logo']) ? '<img src="' . $store['logo'] . '" alt="Logo">' : '<i class="bi bi-bag-heart-fill"></i>'; ?></div>
        <div class="store-name"><?php echo isset($store['name']) ? $store['name'] : 'Toko Elektronik'; ?></div>
        <div class="tagline">"<?php echo isset($store['slogan']) ? $store['slogan'] : 'Belanja mudah, harga terjangkau'; ?>"</div>

        <div class="section-title">Tentang Kami</div>
        <div class="tentang-desc">
            <?php echo isset($store['about']) ? $store['about'] : 'Deskripsi toko belum tersedia.'; ?>
        </div>

        <?php if(isset($features) && !empty($features)): ?>
        <div class="section-title">Keunggulan Kami</div>
        <div class="features-grid">
            <?php foreach($features as $feature): ?>
            <div class="feature-card">
                <div class="feature-icon"><i class="<?php echo $feature['icon'] ?>"></i></div>
                <div class="feature-title"><?php echo $feature['name']; ?></div>
                <div class="feature-desc"><?php echo $feature['description']; ?></div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div class="section-title">Hubungi Kami</div>
        <div class="contact-info">
            <?php if(isset($store['address'])): ?>
            <div class="contact-item">
                <div class="contact-icon"><i class="bi bi-geo-alt-fill"></i></div>
                <div class="contact-text">
                    <div class="contact-label">Alamat</div>
                    <div class="contact-value"><?php echo $store['address']; ?></div>
                </div>
            </div>
            <?php endif; ?>

            <?php if(isset($store['phone'])): ?>
            <div class="contact-item">
                <div class="contact-icon"><i class="bi bi-telephone-fill"></i></div>
                <div class="contact-text">
                    <div class="contact-label">Telepon</div>
                    <div class="contact-value"><?php echo $store['phone']; ?></div>
                </div>
            </div>
            <?php endif; ?>

            <?php if(isset($store['email'])): ?>
            <div class="contact-item">
                <div class="contact-icon"><i class="bi bi-envelope-fill"></i></div>
                <div class="contact-text">
                    <div class="contact-label">Email</div>
                    <div class="contact-value"><?php echo $store['email']; ?></div>
                </div>
            </div>
            <?php endif; ?>

            <div class="contact-item">
                <div class="contact-icon"><i class="bi bi-clock-fill"></i></div>
                <div class="contact-text">
                    <div class="contact-label">Jam Operasional</div>
                    <div class="contact-value"><?php echo $store['operational'] ?? 'Senin - Sabtu, 09:00 - 18:00 WIB'; ?></div>
                </div>
            </div>
        </div>

        <?php if(isset($sosmed) && !empty($sosmed)): ?>
        <div class="section-title">Ikuti Kami</div>
        <div class="social-links">
            <?php foreach($sosmed as $social): ?>
                <?php if(isset($social['url'])): ?>
                     <a href="<?php echo $social['url']; ?>" class="social-icon" target="_blank"><i class="bi bi-<?php echo $social['name']; ?>"></i></a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
