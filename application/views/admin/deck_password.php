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
            <div class="content-header d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h2 mb-0">
                        <i class="fas fa-lock me-2"></i>Deck Management
                    </h1>
                    <p class="text-muted mb-0">Manage multiple access passwords and decks</p>
                </div>
                <button class="btn btn-wp-primary" onclick="openCreateForm()">
                    <i class="fas fa-plus me-2"></i>Create New Deck
                </button>
            </div>
            
            <div class="px-4">
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i><?= $this->session->flashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i><?= $this->session->flashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                
                <!-- Deck List -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="wp-card">
                            <div class="card-header bg-white border-bottom-0 py-3">
                                <h5 class="mb-0">
                                    <i class="fas fa-list text-primary me-2"></i>Active Decks
                                </h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th class="ps-4">Client Name</th>
                                                <th>Password</th>
                                                <th>Deck URL</th>
                                                <th>Expires At</th>
                                                <th class="text-end pe-4">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($decks)): ?>
                                                <?php foreach ($decks as $deck): ?>
                                                    <tr>
                                                        <td class="ps-4 fw-bold"><?= isset($deck->client_name) ? $deck->client_name : 'No Name' ?></td>
                                                        <td>
                                                            <div class="input-group input-group-sm" style="width: 200px;">
                                                                <input type="password" class="form-control" value="<?= $deck->password ?>" readonly id="pass-<?= $deck->id ?>">
                                                                <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('pass-<?= $deck->id ?>')">
                                                                    <i class="fas fa-eye"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                        <td class="text-truncate" style="max-width: 250px;">
                                                            <a href="<?= $deck->deck_url ?>" target="_blank" class="text-decoration-none">
                                                                <i class="fas fa-external-link-alt me-1"></i>Link
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                            $expires = strtotime($deck->expires_at);
                                                            $now = time();
                                                            $diff_days = floor(($expires - $now) / 86400);
                                                            ?>
                                                            <span class="badge <?= $diff_days > 3 ? 'bg-success' : ($diff_days > 0 ? 'bg-warning' : 'bg-danger') ?>">
                                                                <?= date('M d, Y', $expires) ?>
                                                            </span>
                                                            <small class="text-muted d-block"><?= $diff_days > 0 ? "$diff_days days left" : "Expired" ?></small>
                                                        </td>
                                                        <td class="text-end pe-4">
                                                            <button class="btn btn-sm btn-outline-primary me-1" onclick='editDeck(<?= json_encode($deck) ?>)'>
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <form action="<?= base_url('admin/deck_password') ?>" method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this deck?');">
                                                                <input type="hidden" name="action" value="delete">
                                                                <input type="hidden" name="id" value="<?= $deck->id ?>">
                                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="5" class="text-center py-5 text-muted">
                                                        <i class="fas fa-inbox fa-3x mb-3"></i>
                                                        <p>No decks found. Create one to get started.</p>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Container (Hidden by default, scrolls into view) -->
                <div id="formContainer" class="row mb-5" style="display: none;">
                    <div class="col-lg-8 mx-auto">
                        <div class="wp-card shadow-sm border-primary">
                            <div class="card-header bg-primary text-white py-3">
                                <h5 class="mb-0" id="formTitle">
                                    <i class="fas fa-plus-circle me-2"></i>Create New Deck
                                </h5>
                            </div>
                            <div class="card-body p-4">
                                <form method="post" action="<?= base_url('admin/deck_password') ?>">
                                    <input type="hidden" name="action" value="save">
                                    <input type="hidden" name="id" id="formId">
                                    
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Client Name</label>
                                        <input type="text" class="form-control" name="client_name" id="formClientName" required placeholder="e.g. Acme Corp">
                                        <small class="text-muted">Used to identify whom this deck is for.</small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Access Password</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="password" id="formPassword" required placeholder="Enter a secure password">
                                            <button class="btn btn-outline-secondary" type="button" onclick="generatePassword()">
                                                <i class="fas fa-random"></i> Gen
                                            </button>
                                        </div>
                                        <small class="text-muted">The client will use this password to access their specific deck.</small>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Deck URL</label>
                                        <input type="url" class="form-control" name="deck_url" id="formUrl" required placeholder="https://docs.google.com/presentation/...">
                                        <small class="text-muted">Direct link or embed URL.</small>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label class="form-label fw-bold">Expiration</label>
                                        <select class="form-select" name="expires_days" id="formExpires">
                                            <option value="1">1 Day</option>
                                            <option value="3">3 Days</option>
                                            <option value="7" selected>7 Days</option>
                                            <option value="14">14 Days</option>
                                            <option value="30">30 Days</option>
                                            <option value="90">90 Days</option>
                                        </select>
                                    </div>
                                    
                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="button" class="btn btn-secondary" onclick="closeForm()">Cancel</button>
                                        <button type="submit" class="btn btn-primary px-4">Save Deck</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
</div>

<script>
function togglePasswordVisibility(id) {
    const input = document.getElementById(id);
    if (input.type === "password") {
        input.type = "text";
    } else {
        input.type = "password";
    }
}

function openCreateForm() {
    document.getElementById('formContainer').style.display = 'block';
    document.getElementById('formTitle').innerHTML = '<i class="fas fa-plus-circle me-2"></i>Create New Deck';
    document.getElementById('formId').value = '';
    document.getElementById('formClientName').value = '';
    document.getElementById('formPassword').value = '';
    document.getElementById('formUrl').value = '';
    document.getElementById('formExpires').value = '7';
    
    document.getElementById('formContainer').scrollIntoView({ behavior: 'smooth' });
}

function editDeck(deck) {
    document.getElementById('formContainer').style.display = 'block';
    document.getElementById('formTitle').innerHTML = '<i class="fas fa-edit me-2"></i>Edit Deck';
    document.getElementById('formId').value = deck.id;
    document.getElementById('formClientName').value = deck.client_name || ''; // Handle potential null
    document.getElementById('formPassword').value = deck.password;
    document.getElementById('formUrl').value = deck.deck_url;
    // Expiration logic not easily reversible to select box without complex math, default to 7 or leave as is if not changing
    // Ideally we'd calculate days remaining or show the date, but for simplicity:
    document.getElementById('formExpires').value = '7'; 
    
    document.getElementById('formContainer').scrollIntoView({ behavior: 'smooth' });
}

function closeForm() {
    document.getElementById('formContainer').style.display = 'none';
}

function generatePassword() {
    const chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    let pass = "";
    for (let i = 0; i < 8; i++) {
        pass += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    document.getElementById('formPassword').value = pass;
}
</script>

<?php $this->load->view('admin/layout/footer'); ?>
