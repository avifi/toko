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
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4><?= $title; ?></h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <h5 class="mb-3">Config</h5>
                            <div class="mb-3">
                                <label for="domain" class="form-label">Domain <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="domain" name="domain" required value="<?= isset($tenant) ? $tenant->domain : ''; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="google_sheet_id" class="form-label">Google Sheet ID <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="google_sheet_id" name="google_sheet_id" required value="<?= isset($tenant) ? $tenant->google_sheet_id : ''; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="google_api_key" class="form-label">Google API Key <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="google_api_key" name="google_api_key" required value="<?= isset($tenant) ? $tenant->google_api_key : ''; ?>">
                            </div>
                            
                            <h5 class="mt-4 mb-3">Owner Info</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" value="<?= isset($tenant) ? $tenant->username : ''; ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= isset($tenant) ? $tenant->email : ''; ?>">
                                </div>
                            </div>
                             <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="<?= isset($tenant) ? $tenant->phone : ''; ?>">
                            </div>

                             <h5 class="mt-4 mb-3">Subscription</h5>
                             <div class="mb-3">
                                <label for="ends_on" class="form-label">Ends On</label>
                                <input type="datetime-local" class="form-control" id="ends_on" name="ends_on" value="<?= isset($tenant) && $tenant->ends_on ? date('Y-m-d\TH:i', strtotime($tenant->ends_on)) : ''; ?>">
                            </div>

                            <div class="mt-4 d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Save Tenant</button>
                                <a href="<?= site_url('admin/dashboard'); ?>" class="btn btn-danger">Cancel</a>
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
