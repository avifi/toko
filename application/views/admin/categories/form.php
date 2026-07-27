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
        .card-custom { border: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.03); }
        .preview-img { width: 100px; height: 100px; object-fit: cover; border-radius: 8px; border: 1px solid #ddd; }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="<?= site_url('admin/dashboard'); ?>">
                <i class="bi bi-bag-heart-fill"></i> TOKO ADMIN PANEL
            </a>
        </div>
    </nav>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-custom">
                    <div class="card-header bg-white py-3">
                        <h4 class="fw-bold mb-0"><?= $title; ?></h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Kategori <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" required value="<?= isset($category) ? $category['name'] : ''; ?>" placeholder="Contoh: Pakaian, Elektronik">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Upload Gambar Kategori (disimpan ke assets/uploads/)</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                                <?php if(isset($category) && !empty($category['image'])): ?>
                                    <div class="mt-2">
                                        <span class="d-block small text-muted mb-1">Gambar saat ini:</span>
                                        <img src="<?= base_url($category['image']); ?>" class="preview-img" alt="Preview">
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Deskripsi Singkat</label>
                                <textarea name="description" class="form-control" rows="3" placeholder="Tuliskan deskripsi singkat kategori..."><?= isset($category) ? $category['description'] : ''; ?></textarea>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="<?= site_url('admin/categories'); ?>" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Batal</a>
                                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan Kategori</button>
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
