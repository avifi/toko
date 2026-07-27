<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?> - Toko Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background-color: #f4f6f9; font-family: 'Segoe UI', system-ui, -apple-system, sans-serif; }
        .navbar-brand { font-weight: 700; color: #4f46e5 !important; }
        .card-custom { border: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.03); }
        .logo-preview { width: 80px; height: 80px; object-fit: contain; border-radius: 8px; background: #fff; padding: 5px; border: 1px solid #ddd; }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="<?= site_url('admin/dashboard'); ?>">
                <i class="bi bi-bag-heart-fill"></i> TOKO ADMIN PANEL
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="adminNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('admin/dashboard'); ?>"><i class="bi bi-speedometer2"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('admin/products'); ?>"><i class="bi bi-box-seam"></i> Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('admin/categories'); ?>"><i class="bi bi-tags"></i> Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= site_url('admin/settings'); ?>"><i class="bi bi-gear"></i> Pengaturan Toko</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center gap-3">
                    <a href="<?= base_url(); ?>" target="_blank" class="btn btn-outline-light btn-sm"><i class="bi bi-globe"></i> Lihat Toko</a>
                    <a href="<?= site_url('admin/logout'); ?>" class="btn btn-danger btn-sm"><i class="bi bi-box-arrow-right"></i> Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container py-4">

        <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> <?= $this->session->flashdata('success'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card card-custom">
                    <div class="card-header bg-white py-3">
                        <h4 class="fw-bold mb-0"><i class="bi bi-sliders me-2"></i> Pengaturan Informasi Toko</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            
                            <h5 class="fw-bold text-primary mb-3"><i class="bi bi-shop me-1"></i> Identitas Toko</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Nama Toko <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" required value="<?= isset($store['name']) ? $store['name'] : ''; ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Slogan Toko</label>
                                    <input type="text" name="slogan" class="form-control" value="<?= isset($store['slogan']) ? $store['slogan'] : ''; ?>">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Deskripsi Toko</label>
                                <textarea name="description" class="form-control" rows="3"><?= isset($store['description']) ? $store['description'] : ''; ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Logo Toko (disimpan ke assets/uploads/)</label>
                                <input type="file" name="logo" class="form-control" accept="image/*">
                                <?php if(isset($store['logo']) && !empty($store['logo'])): ?>
                                    <div class="mt-2 d-flex align-items-center gap-3">
                                        <img src="<?= base_url($store['logo']); ?>" class="logo-preview" alt="Logo Preview">
                                        <span class="small text-muted">File: <?= $store['logo']; ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <hr class="my-4">
                            <h5 class="fw-bold text-primary mb-3"><i class="bi bi-badge-ad me-1"></i> Banner Promo (Hero)</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Judul Hero Banner</label>
                                    <input type="text" name="hero_title" class="form-control" value="<?= isset($store['hero_title']) ? $store['hero_title'] : ''; ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Subjudul Hero Banner</label>
                                    <input type="text" name="hero_subtitle" class="form-control" value="<?= isset($store['hero_subtitle']) ? $store['hero_subtitle'] : ''; ?>">
                                </div>
                            </div>

                            <hr class="my-4">
                            <h5 class="fw-bold text-primary mb-3"><i class="bi bi-telephone-outbound me-1"></i> Kontak & Alamat Toko</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Nomor WhatsApp Checkout <span class="text-danger">*</span></label>
                                    <input type="text" name="whatsapp" class="form-control" required value="<?= isset($store['whatsapp']) ? $store['whatsapp'] : ''; ?>" placeholder="Contoh: 6281234567890">
                                    <small class="text-muted">Gunakan format internasional tanpa + atau spasi (contoh: 62812...)</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Nomor Telepon Toko</label>
                                    <input type="text" name="phone" class="form-control" value="<?= isset($store['phone']) ? $store['phone'] : ''; ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Email Customer Service</label>
                                    <input type="email" name="email" class="form-control" value="<?= isset($store['email']) ? $store['email'] : ''; ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Alamat Lengkap Toko</label>
                                    <input type="text" name="address" class="form-control" value="<?= isset($store['address']) ? $store['address'] : ''; ?>">
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary btn-lg"><i class="bi bi-save me-1"></i> Simpan Pengaturan</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
