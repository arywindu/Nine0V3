<?php $this->load->view('admin/layout/header'); ?>

<div class="container-fluid p-0">
    <div class="row g-0">
        <nav class="col-md-2 admin-sidebar">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/dashboard') ?>">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/portfolio') ?>">
                            <i class="fas fa-folder-open"></i> Portfolio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url('admin/deck_password') ?>">
                            <i class="fas fa-lock"></i> Deck Password
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/profile') ?>">
                            <i class="fas fa-user-cog"></i> Profile
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        
        <main class="col-md-10 admin-content">
            <div class="content-header">
                <h1 class="h2 mb-0">
                    <i class="fas fa-lock me-2"></i>Deck Password Settings
                </h1>
                <p class="text-muted mb-0">Manage access password and link for the deck presentation</p>
            </div>
            
            <div class="px-4">
                <?php if (isset($success)): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i><?= $success ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i><?= $error ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                
                <div class="row">
                    <!-- Current Password Info Card -->
                    <div class="col-lg-8 mb-4">
                        <div class="wp-card">
                            <div class="card-header bg-white border-bottom-0 py-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">
                                        <i class="fas fa-info-circle text-info me-2"></i>Current Deck Settings
                                    </h5>
                                    <button class="btn btn-sm btn-wp-primary" onclick="toggleEditForm()">
                                        <i class="fas fa-edit me-1"></i><?= $settings ? 'Edit' : 'Create' ?> Password
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php if ($settings): ?>
                                    <div class="table-responsive">
                                        <table class="table table-borderless mb-0">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 150px;"><strong><i class="fas fa-link text-primary"></i> Deck URL:</strong></td>
                                                    <td class="text-break">
                                                        <a href="<?= $settings->deck_url ?>" target="_blank" class="text-decoration-none">
                                                            <?= strlen($settings->deck_url) > 80 ? substr($settings->deck_url, 0, 80) . '...' : $settings->deck_url ?>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong><i class="fas fa-calendar text-warning"></i> Expires At:</strong></td>
                                                    <td>
                                                        <?php 
                                                        $expires = strtotime($settings->expires_at);
                                                        $now = time();
                                                        $diff_days = floor(($expires - $now) / 86400);
                                                        ?>
                                                        <strong><?= date('F d, Y H:i', $expires) ?></strong>
                                                        <br>
                                                        <span class="badge <?= $diff_days > 3 ? 'bg-success' : ($diff_days > 0 ? 'bg-warning' : 'bg-danger') ?>">
                                                            <?= $diff_days > 0 ? "$diff_days days remaining" : "Expired" ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong><i class="fas fa-clock text-secondary"></i> Last Updated:</strong></td>
                                                    <td><?= date('M d, Y H:i', strtotime($settings->updated_at)) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong><i class="fas fa-history text-secondary"></i> Created At:</strong></td>
                                                    <td><?= date('M d, Y H:i', strtotime($settings->created_at)) ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                    <div class="mt-3 pt-3 border-top">
                                        <a href="<?= base_url('deck') ?>" target="_blank" class="btn btn-outline-primary">
                                            <i class="fas fa-external-link-alt me-2"></i>View Deck Page
                                        </a>
                                    </div>
                                <?php else: ?>
                                    <div class="text-center py-5">
                                        <i class="fas fa-lock text-muted" style="font-size: 4rem;"></i>
                                        <h4 class="mt-3 text-muted">No Password Configured</h4>
                                        <p class="text-muted">Click "Create Password" to set up deck access</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tips Card -->
                    <div class="col-lg-4 mb-4">
                        <div class="wp-card">
                            <div class="card-header bg-white border-bottom-0 py-3">
                                <h5 class="mb-0">
                                    <i class="fas fa-lightbulb text-warning me-2"></i>Tips
                                </h5>
                            </div>
                            <div class="card-body">
                                <ul class="small mb-0 ps-3">
                                    <li class="mb-2">Use strong, unique passwords</li>
                                    <li class="mb-2"><strong>Google Slides:</strong> File → Share → Publish to web → Embed</li>
                                    <li class="mb-2"><strong>Canva:</strong> Share → Present → Copy embed URL</li>
                                    <li class="mb-0">Update password regularly for security</li>
                                </ul>
                            </div>
                        </div>
                        
                        <?php if ($settings): ?>
                        <div class="wp-card mt-3">
                            <div class="card-header bg-white border-bottom-0 py-3">
                                <h5 class="mb-0">
                                    <i class="fas fa-chart-bar text-success me-2"></i>Password Status
                                </h5>
                            </div>
                            <div class="card-body text-center">
                                <?php 
                                $diff_days = floor((strtotime($settings->expires_at) - time()) / 86400);
                                if ($diff_days > 7): ?>
                                    <i class="fas fa-check-circle text-success" style="font-size: 3rem;"></i>
                                    <p class="mt-2 mb-0 text-success"><strong>Active & Valid</strong></p>
                                <?php elseif ($diff_days > 0): ?>
                                    <i class="fas fa-exclamation-triangle text-warning" style="font-size: 3rem;"></i>
                                    <p class="mt-2 mb-0 text-warning"><strong>Expiring Soon</strong></p>
                                <?php else: ?>
                                    <i class="fas fa-times-circle text-danger" style="font-size: 3rem;"></i>
                                    <p class="mt-2 mb-0 text-danger"><strong>Expired</strong></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Edit Form (Hidden by default) -->
                <div id="editFormContainer" style="display: none;">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="wp-card">
                                <div class="card-header bg-white border-bottom-0 py-3">
                                    <h5 class="mb-0">
                                        <i class="fas fa-key text-primary me-2"></i><?= $settings ? 'Update' : 'Create' ?> Password & Link
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="<?= base_url('admin/deck_password') ?>">
                                        <input type="hidden" name="action" value="update">
                                        
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">
                                                <i class="fas fa-lock text-primary"></i> New Password
                                            </label>
                                            <input type="text" class="form-control" name="password" required 
                                                   placeholder="Enter new password" value="">
                                            <small class="text-muted">Leave existing if you don't want to change</small>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">
                                                <i class="fas fa-link text-primary"></i> Deck URL (Google Slides, Canva, etc.)
                                            </label>
                                            <input type="url" class="form-control" name="deck_url" required
                                                   value="<?= isset($settings->deck_url) ? $settings->deck_url : '' ?>"
                                                   placeholder="https://docs.google.com/presentation/d/e/...">
                                            <small class="text-muted">Use embed URL for Google Slides or presentation platforms</small>
                                        </div>
                                        
                                        <div class="mb-4">
                                            <label class="form-label fw-bold">
                                                <i class="fas fa-calendar-alt text-primary"></i> Password Expiration (Days)
                                            </label>
                                            <select class="form-select" name="expires_days">
                                                <option value="1">1 Day</option>
                                                <option value="3">3 Days</option>
                                                <option value="7" selected>7 Days</option>
                                                <option value="14">14 Days</option>
                                                <option value="30">30 Days</option>
                                                <option value="90">90 Days</option>
                                            </select>
                                        </div>
                                        
                                        <div class="d-flex gap-2">
                                            <button type="submit" class="btn btn-wp-primary">
                                                <i class="fas fa-save me-2"></i><?= $settings ? 'Update' : 'Create' ?> Settings
                                            </button>
                                            <button type="button" class="btn btn-secondary" onclick="toggleEditForm()">
                                                <i class="fas fa-times me-2"></i>Cancel
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
function toggleEditForm() {
    const form = document.getElementById('editFormContainer');
    if (form.style.display === 'none') {
        form.style.display = 'block';
        form.scrollIntoView({ behavior: 'smooth' });
    } else {
        form.style.display = 'none';
    }
}
</script>

<?php $this->load->view('admin/layout/footer'); ?>
