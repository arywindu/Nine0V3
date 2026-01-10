<?php $this->load->view('admin/layout/header'); ?>

<div class="container-fluid p-0">
    <div class="row g-0">
        <!-- Sidebar -->
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
                        <a class="nav-link" href="<?= base_url('admin/deck_password') ?>">
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
        
        <!-- Main Content -->
        <main class="col-md-10 admin-content">
            <!-- Page Header -->
            <div class="content-header">
                <h1 class="h2 mb-0">
                    <i class="fas fa-chart-line me-2"></i>Dashboard
                </h1>
                <p class="text-muted mb-0">Welcome back! Here's what's happening with your portfolio.</p>
            </div>
            
            <!-- Content -->
            <div class="px-4">
                <!-- Stats Cards -->
                <div class="row g-4 mb-4">
                    <!-- Total Portfolio -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="stats-card">
                            <i class="fas fa-folder-open"></i>
                            <h3><?= $total_portfolios ?></h3>
                            <p class="mb-0">Total Portfolio</p>
                        </div>
                    </div>
                    
                    <!-- Active Portfolio -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="stats-card" style="background: linear-gradient(135deg, #48bb78, #38a169);">
                            <i class="fas fa-eye"></i>
                            <h3><?= $active_portfolios ?></h3>
                            <p class="mb-0">Active Portfolio</p>
                        </div>
                    </div>
                    
                    <!-- Current Time -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="stats-card" style="background: linear-gradient(135deg, #ed8936, #dd6b20);">
                            <i class="fas fa-clock"></i>
                            <h3><?= date('H:i') ?></h3>
                            <p class="mb-0">Current Time</p>
                        </div>
                    </div>
                    
                    <!-- Current Date -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="stats-card" style="background: linear-gradient(135deg, #9f7aea, #805ad5);">
                            <i class="fas fa-calendar"></i>
                            <h3><?= date('d') ?></h3>
                            <p class="mb-0"><?= date('M Y') ?></p>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Actions & System Info -->
                <div class="row g-4">
                    <!-- Quick Actions -->
                    <div class="col-lg-8">
                        <div class="wp-card h-100">
                            <div class="card-header bg-white border-bottom">
                                <h5 class="mb-0">
                                    <i class="fas fa-rocket text-primary me-2"></i>Quick Actions
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <a href="<?= base_url('admin/portfolio') ?>" class="btn btn-wp-primary w-100 py-4 d-flex flex-column align-items-center gap-2">
                                            <i class="fas fa-plus-circle fa-2x"></i>
                                            <span class="fw-semibold">Add Portfolio</span>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="<?= base_url('portfolio') ?>" target="_blank" class="btn btn-outline-primary w-100 py-4 d-flex flex-column align-items-center gap-2">
                                            <i class="fas fa-external-link-alt fa-2x"></i>
                                            <span class="fw-semibold">View Site</span>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="<?= base_url('admin/profile') ?>" class="btn btn-outline-secondary w-100 py-4 d-flex flex-column align-items-center gap-2">
                                            <i class="fas fa-cog fa-2x"></i>
                                            <span class="fw-semibold">Settings</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- System Info -->
                    <div class="col-lg-4">
                        <div class="wp-card h-100">
                            <div class="card-header bg-white border-bottom">
                                <h5 class="mb-0">
                                    <i class="fas fa-info-circle text-info me-2"></i>System Info
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; background: rgba(241, 90, 41, 0.1);">
                                        <i class="fas fa-code text-primary"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Version</small>
                                        <strong>NINE 0 v3.0</strong>
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-center mb-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; background: rgba(72, 187, 120, 0.1);">
                                        <i class="fas fa-clock text-success"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Last Login</small>
                                        <strong><?= date('M d, Y H:i') ?></strong>
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; background: rgba(72, 187, 120, 0.1);">
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
                
                <!-- Recent Activity -->
                <div class="row mt-4 mb-4">
                    <div class="col-12">
                        <div class="wp-card">
                            <div class="card-header bg-white border-bottom">
                                <h5 class="mb-0">
                                    <i class="fas fa-chart-bar text-warning me-2"></i>Recent Activity
                                </h5>
                            </div>
                            <div class="card-body text-center py-5">
                                <i class="fas fa-chart-line text-muted" style="font-size: 4rem;"></i>
                                <p class="text-muted mt-3 mb-0">Activity tracking will be available soon</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php $this->load->view('admin/layout/footer'); ?>
