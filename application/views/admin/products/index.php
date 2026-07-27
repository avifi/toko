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
        .img-thumb { width: 50px; height: 50px; object-fit: cover; border-radius: 8px; }
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
                        <a class="nav-link active" href="<?= site_url('admin/products'); ?>"><i class="bi bi-box-seam"></i> Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('admin/categories'); ?>"><i class="bi bi-tags"></i> Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('admin/settings'); ?>"><i class="bi bi-gear"></i> Pengaturan Toko</a>
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

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold mb-0">Daftar Produk Toko</h4>
            <a href="<?= site_url('admin/product_add'); ?>" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah Produk Baru</a>
        </div>

        <div class="card card-custom">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Foto</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Fitur Prime</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($products)): ?>
                                <?php foreach($products as $p): ?>
                                    <tr>
                                        <td>
                                            <?php 
                                            $imgSrc = base_url($p['thumbnail_image']);
                                            if (filter_var($p['thumbnail_image'], FILTER_VALIDATE_URL)) {
                                                $imgSrc = $p['thumbnail_image'];
                                            }
                                            ?>
                                            <img src="<?= $imgSrc; ?>" class="img-thumb" alt="<?= $p['name']; ?>">
                                        </td>
                                        <td>
                                            <span class="fw-semibold text-dark"><?= $p['name']; ?></span><br>
                                            <small class="text-muted"><?= $p['slug']; ?></small>
                                        </td>
                                        <td><span class="badge bg-info text-dark"><?= $p['category_name'] ?: 'Tanpa Kategori'; ?></span></td>
                                        <td class="fw-bold text-success">Rp <?= number_format($p['price'], 0, ',', '.'); ?></td>
                                        <td><?= $p['stock']; ?> pcs</td>
                                        <td>
                                            <?php if($p['prime'] == 'Ya'): ?>
                                                <span class="badge bg-warning text-dark"><i class="bi bi-star-fill"></i> Prime</span>
                                            <?php else: ?>
                                                <span class="badge bg-light text-secondary">Biasa</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-end">
                                            <a href="<?= site_url('admin/product_edit/'.$p['id']); ?>" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil-square"></i> Edit</a>
                                            <a href="<?= site_url('admin/product_delete/'.$p['id']); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus produk ini?');"><i class="bi bi-trash"></i> Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">Belum ada produk. Klik 'Tambah Produk Baru' untuk menambah.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
