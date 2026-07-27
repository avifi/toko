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
        .preview-img { width: 120px; height: 120px; object-fit: cover; border-radius: 8px; border: 1px solid #ddd; }
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
            <div class="col-md-8">
                <div class="card card-custom">
                    <div class="card-header bg-white py-3">
                        <h4 class="fw-bold mb-0"><?= $title; ?></h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Produk <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" required value="<?= isset($product) ? $product['name'] : ''; ?>" placeholder="Masukkan nama produk">
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                                    <select name="category_id" class="form-select" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        <?php if(!empty($categories)): ?>
                                            <?php foreach($categories as $cat): ?>
                                                <option value="<?= $cat['id']; ?>" <?= (isset($product) && $product['category_id'] == $cat['id']) ? 'selected' : ''; ?>>
                                                    <?= $cat['name']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Harga (Rp) <span class="text-danger">*</span></label>
                                    <input type="number" name="price" class="form-control" required value="<?= isset($product) ? $product['price'] : ''; ?>" placeholder="Contoh: 150000">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Stok <span class="text-danger">*</span></label>
                                    <input type="number" name="stock" class="form-control" required value="<?= isset($product) ? $product['stock'] : '50'; ?>">
                                </div>
                                <div class="col-md-6 mb-3 d-flex align-items-center mt-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="prime" id="primeCheck" <?= (isset($product) && $product['prime'] == 'Ya') ? 'checked' : ''; ?>>
                                        <label class="form-check-label fw-semibold" for="primeCheck">Tampilkan di Produk Populer (Prime)</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Upload Gambar Produk (disimpan ke assets/uploads/)</label>
                                <input type="file" name="thumbnail_image" class="form-control" accept="image/*">
                                <small class="text-muted">Format: JPG, PNG, WEBP. Maks 5MB.</small>
                                
                                <?php if(isset($product) && !empty($product['thumbnail_image'])): ?>
                                    <div class="mt-2">
                                        <span class="d-block small text-muted mb-1">Gambar saat ini:</span>
                                        <?php 
                                        $imgSrc = base_url($product['thumbnail_image']);
                                        if (filter_var($product['thumbnail_image'], FILTER_VALIDATE_URL)) {
                                            $imgSrc = $product['thumbnail_image'];
                                        }
                                        ?>
                                        <img src="<?= $imgSrc; ?>" class="preview-img" alt="Preview">
                                        <input type="hidden" name="existing_image" value="<?= $product['thumbnail_image']; ?>">
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Deskripsi Produk</label>
                                <textarea name="description" class="form-control" rows="4" placeholder="Tuliskan deskripsi lengkap produk..."><?= isset($product) ? $product['description'] : ''; ?></textarea>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="<?= site_url('admin/products'); ?>" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Batal</a>
                                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan Produk</button>
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
