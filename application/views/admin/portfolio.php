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
                        <a class="nav-link active" href="<?= base_url('admin/portfolio') ?>">
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
            <div class="content-header d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h2 mb-0">
                        <i class="fas fa-folder-open me-2"></i>Portfolio Management
                    </h1>
                    <p class="text-muted mb-0">Manage your creative portfolio items</p>
                </div>
                <button class="btn btn-wp-primary" data-bs-toggle="modal" data-bs-target="#portfolioModal" onclick="resetForm()">
                    <i class="fas fa-plus-circle me-2"></i>Add New Portfolio
                </button>
            </div>
            
            <div class="px-4">
                <div class="wp-card">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 80px;">Image</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Client</th>
                                    <th style="width: 80px;">Year</th>
                                    <th style="width: 100px;">Status</th>
                                    <th style="width: 120px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($portfolios)): ?>
                                    <?php foreach ($portfolios as $portfolio): ?>
                                        <tr>
                                            <td>
                                                <?php 
                                                $has_image = false;
                                                $image_src = '';
                                                
                                                // Check for images in JSON format first
                                                if (isset($portfolio->images) && $portfolio->images) {
                                                    $images = json_decode($portfolio->images, true);
                                                    if (!empty($images) && isset($images[0]['image'])) {
                                                        $image_src = base_url('uploads/' . $images[0]['image']);
                                                        $has_image = file_exists('./uploads/' . $images[0]['image']);
                                                    }
                                                }
                                                
                                                // Fallback to single image field
                                                if (!$has_image && $portfolio->image) {
                                                    $image_src = base_url('uploads/' . $portfolio->image);
                                                    $has_image = file_exists('./uploads/' . $portfolio->image);
                                                }
                                                
                                                if ($has_image): ?>
                                                    <img src="<?= $image_src ?>" 
                                                         class="rounded-3 shadow-sm" width="60" height="60" style="object-fit: cover;"
                                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                    <div class="bg-light rounded-3 d-flex align-items-center justify-content-center shadow-sm" 
                                                         style="width: 60px; height: 60px; display: none;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="bg-light rounded-3 d-flex align-items-center justify-content-center shadow-sm" 
                                                         style="width: 60px; height: 60px;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <strong class="text-dark"><?= $portfolio->title ?></strong>
                                                <br><small class="text-muted"><?= substr($portfolio->description, 0, 50) ?>...</small>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary bg-opacity-10 text-primary">
                                                    <?= $portfolio->category ?>
                                                </span>
                                            </td>
                                            <td><?= $portfolio->client ?: '-' ?></td>
                                            <td><?= $portfolio->year ?></td>
                                            <td>
                                                <span class="badge <?= $portfolio->status == 'active' ? 'bg-success' : 'bg-secondary' ?>">
                                                    <?= ucfirst($portfolio->status) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <button class="btn btn-outline-primary" onclick="editPortfolio(<?= $portfolio->id ?>)" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <form method="post" style="display: inline;">
                                                        <input type="hidden" name="action" value="delete">
                                                        <input type="hidden" name="id" value="<?= $portfolio->id ?>">
                                                        <button type="submit" class="btn btn-outline-danger btn-delete" title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <i class="fas fa-folder-open text-muted" style="font-size: 3rem;"></i>
                                            <p class="text-muted mt-3 mb-0">No portfolio items found</p>
                                            <button class="btn btn-wp-primary mt-3" data-bs-toggle="modal" data-bs-target="#portfolioModal" onclick="resetForm()">
                                                <i class="fas fa-plus"></i> Add Your First Portfolio
                                            </button>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Portfolio Modal -->
<div class="modal fade" id="portfolioModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" id="portfolioForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add Portfolio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="action" id="formAction" value="add">
                    <input type="hidden" name="id" id="portfolioId">
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label">Title *</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="4"></textarea>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Category *</label>
                                    <input type="text" name="category" id="category" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Client</label>
                                    <input type="text" name="client" id="client" class="form-control">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Year</label>
                                    <input type="number" name="year" id="year" class="form-control" value="<?= date('Y') ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Project URL</label>
                                <input type="url" name="url" id="url" class="form-control">
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Images</label>
                                <input type="file" name="images[]" class="form-control" multiple accept="image/*" id="imageInput">
                                <small class="text-muted">Select multiple images (Max 5MB each). Supported: JPG, PNG, GIF, WebP</small>
                                <div id="imagePreview" class="mt-2"></div>
                            </div>
                            
                            <div id="currentImages" class="mt-3"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-wp-primary">
                        <i class="fas fa-save"></i> Save Portfolio
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function resetForm() {
    document.getElementById('portfolioForm').reset();
    document.getElementById('formAction').value = 'add';
    document.getElementById('modalTitle').textContent = 'Add Portfolio';
    document.getElementById('currentImages').innerHTML = '';
    document.getElementById('portfolioId').value = '';
    document.getElementById('imagePreview').innerHTML = '';
}

// Image preview functionality
document.getElementById('imageInput').addEventListener('change', function(e) {
    const preview = document.getElementById('imagePreview');
    preview.innerHTML = '';
    
    if (e.target.files.length > 0) {
        const previewHtml = '<h6 class="text-muted mb-2">Preview:</h6><div class="row g-2">';
        
        Array.from(e.target.files).forEach((file, index) => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'col-4';
                    div.innerHTML = `<img src="${e.target.result}" class="img-thumbnail w-100" style="height: 80px; object-fit: cover;">`;
                    preview.appendChild(div);
                };
                reader.readAsDataURL(file);
            }
        });
    }
});

function editPortfolio(id) {
    fetch('<?= base_url('admin/get_portfolio/') ?>' + id)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                alert('Error: ' + data.error);
                return;
            }
            
            document.getElementById('formAction').value = 'edit';
            document.getElementById('portfolioId').value = data.id;
            document.getElementById('modalTitle').textContent = 'Edit Portfolio';
            document.getElementById('title').value = data.title || '';
            document.getElementById('description').value = data.description || '';
            document.getElementById('category').value = data.category || '';
            document.getElementById('client').value = data.client || '';
            document.getElementById('year').value = data.year || '';
            document.getElementById('status').value = data.status || 'active';
            document.getElementById('url').value = data.url || '';
            
            // Show current images
            let imagesHtml = '';
            if (data.images && data.images.length > 0) {
                imagesHtml = '<h6 class="text-muted mb-2">Current Images:</h6><div class="row g-2">';
                data.images.forEach(img => {
                    imagesHtml += `
                        <div class="col-6">
                            <img src="<?= base_url('uploads/') ?>${img.image}" 
                                 class="img-thumbnail w-100" 
                                 style="height: 80px; object-fit: cover;"
                                 onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgZmlsbD0iI2VlZSIvPjx0ZXh0IHg9IjUwJSIgeT0iNTAlIiBmb250LXNpemU9IjE4IiBmaWxsPSIjYWFhIiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBkeT0iLjNlbSI+Tm8gSW1hZ2U8L3RleHQ+PC9zdmc+';">
                        </div>`;
                });
                imagesHtml += '</div>';
            }
            document.getElementById('currentImages').innerHTML = imagesHtml;
            
            new bootstrap.Modal(document.getElementById('portfolioModal')).show();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to load portfolio data: ' + error.message);
        });
}

// Form validation
document.getElementById('portfolioForm').addEventListener('submit', function(e) {
    const title = document.getElementById('title').value.trim();
    const category = document.getElementById('category').value.trim();
    
    if (!title || !category) {
        e.preventDefault();
        alert('Please fill in all required fields (Title and Category)');
        return false;
    }
    
    // Show loading state
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
    submitBtn.disabled = true;
    
    // Re-enable after 3 seconds (fallback)
    setTimeout(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    }, 3000);
});
</script>

<?php $this->load->view('admin/layout/footer'); ?>
