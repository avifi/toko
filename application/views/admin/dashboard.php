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
        .stat-card { border: none; border-radius: 12px; transition: transform 0.2s; }
        .stat-card:hover { transform: translateY(-3px); }
        .icon-box { width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 24px; }
        .card-custom { border: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.03); }
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
                        <a class="nav-link active" href="<?= site_url('admin/dashboard'); ?>"><i class="bi bi-speedometer2"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('admin/products'); ?>"><i class="bi bi-box-seam"></i> Produk</a>
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
        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= $this->session->flashdata('error'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Stats Overview -->
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card stat-card card-custom p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small">Total Produk</span>
                            <h3 class="fw-bold mb-0 mt-1"><?= $total_products; ?></h3>
                        </div>
                        <div class="icon-box bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-box-seam"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card card-custom p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small">Total Kategori</span>
                            <h3 class="fw-bold mb-0 mt-1"><?= $total_categories; ?></h3>
                        </div>
                        <div class="icon-box bg-success bg-opacity-10 text-success">
                            <i class="bi bi-tags"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card card-custom p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small">Total Tenant</span>
                            <h3 class="fw-bold mb-0 mt-1"><?= count($tenants); ?></h3>
                        </div>
                        <div class="icon-box bg-warning bg-opacity-10 text-warning">
                            <i class="bi bi-buildings"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Action Buttons -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold mb-0">Manajemen Tenant / Domain</h4>
            <div class="d-flex gap-2">
                <a href="<?= site_url('admin/product_add'); ?>" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah Produk</a>
                <a href="<?= site_url('admin/tenant_create'); ?>" class="btn btn-outline-primary"><i class="bi bi-plus-lg"></i> Add Tenant</a>
            </div>
        </div>

        <div class="card card-custom">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Domain</th>
                                <th>Tenant Username</th>
                                <th>Contact</th>
                                <th>Ends On</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($tenants)): ?>
                                <?php foreach($tenants as $tenant): ?>
                                    <tr>
                                        <td><span class="badge bg-secondary"><?= $tenant->id; ?></span></td>
                                        <td class="fw-semibold"><?= $tenant->domain; ?></td>
                                        <td><?= $tenant->username ?: '-'; ?></td>
                                        <td><small class="text-muted"><?= $tenant->email; ?><br><?= $tenant->phone; ?></small></td>
                                        <td><?= $tenant->ends_on ? date('d M Y H:i', strtotime($tenant->ends_on)) : '<span class="badge bg-success">Selamanya</span>'; ?></td>
                                        <td class="text-end">
                                            <a href="<?= site_url('admin/tenant_edit/'.$tenant->id); ?>" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil-square"></i> Edit</a>
                                            <a href="<?= site_url('admin/tenant_delete/'.$tenant->id); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus tenant ini?');"><i class="bi bi-trash"></i> Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">Belum ada data tenant.</td>
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
