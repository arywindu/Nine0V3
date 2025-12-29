<?php $this->load->view('admin/layout/header'); ?>

<div class="container-fluid p-0">
    <div class="row g-0">
        <nav class="col-md-2 admin-sidebar">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url('admin/dashboard') ?>">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/portfolio') ?>">
                            <i class="fas fa-folder-open"></i> Portfolio
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
                    <i class="fas fa-chart-line me-2"></i>Dashboard
                </h1>
                <p class="text-muted mb-0">Welcome back! Here's what's happening with your portfolio.</p>
            </div>
            
            <div class="px-4">
                <div class="row mb-4">
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="stats-card">
                            <i class="fas fa-folder-open"></i>
                            <h3><?= $total_portfolios ?></h3>
                            <p class="mb-0">Total Portfolio</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="stats-card" style="background: linear-gradient(135deg, #48bb78, #38a169);">
                            <i class="fas fa-eye"></i>
                            <h3><?= $active_portfolios ?></h3>
                            <p class="mb-0">Active Portfolio</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="stats-card" style="background: linear-gradient(135deg, #ed8936, #dd6b20);">
                            <i class="fas fa-clock"></i>
                            <h3><?= date('H:i') ?></h3>
                            <p class="mb-0">Current Time</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="stats-card" style="background: linear-gradient(135deg, #9f7aea, #805ad5);">
                            <i class="fas fa-calendar"></i>
                            <h3><?= date('d') ?></h3>
                            <p class="mb-0"><?= date('M Y') ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-8 mb-4">
                        <div class="wp-card">
                            <div class="card-header bg-white border-bottom-0 py-3">
                                <h5 class="mb-0">
                                    <i class="fas fa-rocket text-primary me-2"></i>Quick Actions
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <a href="<?= base_url('admin/portfolio') ?>" class="btn btn-wp-primary w-100 py-3">
                                            <i class="fas fa-plus-circle d-block mb-2" style="font-size: 1.5rem;"></i>
                                            Add Portfolio
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="<?= base_url('portfolio') ?>" class="btn btn-outline-primary w-100 py-3" target="_blank">
                                            <i class="fas fa-external-link-alt d-block mb-2" style="font-size: 1.5rem;"></i>
                                            View Site
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="<?= base_url('admin/profile') ?>" class="btn btn-outline-secondary w-100 py-3">
                                            <i class="fas fa-cog d-block mb-2" style="font-size: 1.5rem;"></i>
                                            Settings
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 mb-4">
                        <div class="wp-card">
                            <div class="card-header bg-white border-bottom-0 py-3">
                                <h5 class="mb-0">
                                    <i class="fas fa-info-circle text-info me-2"></i>System Info
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="fas fa-code text-primary"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Version</small>
                                        <strong>NINE 0 v3.0</strong>
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="fas fa-clock text-success"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Last Login</small>
                                        <strong><?= date('M d, Y H:i') ?></strong>
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-center">
                                    <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="fas fa-circle text-success"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Status</small>
                                        <strong class="text-success">Online</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <div class="wp-card">
                            <div class="card-header bg-white border-bottom-0 py-3">
                                <h5 class="mb-0">
                                    <i class="fas fa-chart-bar text-warning me-2"></i>Recent Activity
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="text-center py-4">
                                    <i class="fas fa-chart-line text-muted" style="font-size: 3rem;"></i>
                                    <p class="text-muted mt-3 mb-0">Activity tracking will be available soon</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php $this->load->view('admin/layout/footer'); ?>
