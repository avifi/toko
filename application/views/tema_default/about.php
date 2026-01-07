<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h2 class="mb-4">Tentang Kami</h2>
            <div class="card shadow-sm">
                <div class="card-body p-5">
                    <h1 class="h3 mb-3"><?php echo isset($store['name']) ? $store['name'] : 'Toko Online'; ?></h1>
                    <p class="lead text-muted mb-4">
                        <?php echo isset($store['about']) ? $store['about'] : 'Deskripsi toko belum tersedia.'; ?>
                    </p>
                    
                    <hr>
                    
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <h5>Alamat</h5>
                            <p><?php echo isset($store['address']) ? $store['address'] : '-'; ?></p>
                        </div>
                        <div class="col-md-4">
                            <h5>Email</h5>
                            <p><?php echo isset($store['email']) ? $store['email'] : '-'; ?></p>
                        </div>
                        <div class="col-md-4">
                            <h5>Telepon</h5>
                            <p><?php echo isset($store['phone']) ? $store['phone'] : '-'; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
