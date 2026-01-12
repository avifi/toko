<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Tenant Management</h2>
            <div class="pull-right">
                <a href="<?= site_url('admin/tenant_create'); ?>" class="btn btn-primary">Add New Tenant</a>
                <a class="btn btn-danger" href="<?= site_url('admin/logout'); ?>">Logout</a>
            </div>
        </div>

        <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
        <?php endif; ?>
        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Domain</th>
                                <th>Ends On</th>
                                <th>Contact</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($tenants)): ?>
                                <?php foreach($tenants as $tenant): ?>
                                    <tr>
                                        <td><?= $tenant->id; ?></td>
                                        <td><?= $tenant->domain; ?></td>
                                        <td><?= $tenant->ends_on ? date('d M Y H:i', strtotime($tenant->ends_on)) : '-'; ?></td>
                                        <td>
                                            <?= $tenant->username; ?><br>
                                            <small class="text-muted"><?= $tenant->email; ?></small>
                                        </td>
                                        <td><?= date('d M Y', strtotime($tenant->created_at)); ?></td>
                                        <td>
                                            <a href="<?= site_url('admin/tenant_edit/'.$tenant->id); ?>" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="<?= site_url('admin/tenant_delete/'.$tenant->id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this tenant?');">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">No tenants found.</td>
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
