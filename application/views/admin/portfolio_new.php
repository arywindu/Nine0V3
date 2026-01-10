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
        
        <main class="col-md-10 admin-content">
            <div class="content-header d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h2 mb-0">
                        <i class="fas fa-folder-open me-2"></i>Portfolio Management
                    </h1>
                    <p class="text-muted mb-0">Create and manage your creative portfolio</p>
                </div>
                <button class="btn btn-wp-primary" data-bs-toggle="modal" data-bs-target="#portfolioModal" onclick="resetForm()">
                    <i class="fas fa-plus-circle me-2"></i>Create New Portfolio
                </button>
            </div>
            
            <div class="px-4">
                <!-- Portfolio Grid View -->
                <div class="row g-4">
                    <?php if (!empty($portfolios)): ?>
                        <?php foreach ($portfolios as $portfolio): ?>
                            <div class="col-lg-4 col-md-6">
                                <div class="wp-card h-100">
                                    <?php 
                                    $image_src = '';
                                    if (isset($portfolio->images) && $portfolio->images) {
                                        $images = json_decode($portfolio->images, true);
                                        if (!empty($images)) {
                                            $image_src = base_url('uploads/' . $images[0]['image']);
                                        }
                                    } elseif ($portfolio->image) {
                                        $image_src = base_url('uploads/' . $portfolio->image);
                                    }
                                    ?>
                                    
                                    <?php if ($image_src): ?>
                                        <img src="<?= $image_src ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                                    <?php else: ?>
                                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                            <i class="fas fa-image text-muted fa-3x"></i>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="card-body d-flex flex-column">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h5 class="card-title mb-0"><?= $portfolio->title ?></h5>
                                            <span class="badge bg-<?= $portfolio->status == 'active' ? 'success' : 'secondary' ?>">
                                                <?= ucfirst($portfolio->status) ?>
                                            </span>
                                        </div>
                                        
                                        <p class="card-text text-muted small mb-2">
                                            <i class="fas fa-tag me-1"></i><?= $portfolio->category ?>
                                            <?php if ($portfolio->client): ?>
                                                • <i class="fas fa-user me-1"></i><?= $portfolio->client ?>
                                            <?php endif ?>
                                            • <i class="fas fa-calendar me-1"></i><?= $portfolio->year ?>
                                        </p>
                                        
                                        <p class="card-text flex-grow-1"><?= substr($portfolio->description, 0, 100) ?>...</p>
                                        
                                        <div class="mt-auto">
                                            <div class="btn-group w-100 mb-2">
                                                <button class="btn btn-outline-primary btn-sm" onclick="editPortfolio(<?= $portfolio->id ?>)">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <a href="<?= base_url('admin/image_manager?id=' . $portfolio->id) ?>" class="btn btn-outline-warning btn-sm">
                                                    <i class="fas fa-images"></i> Images
                                                </a>
                                                <a href="<?= base_url('portfolio/detail/' . $portfolio->id) ?>" class="btn btn-outline-info btn-sm" target="_blank">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                            </div>
                                            <form method="post" style="display: inline;" class="w-100">
                                                <input type="hidden" name="action" value="delete">
                                                <input type="hidden" name="id" value="<?= $portfolio->id ?>">
                                                <button type="submit" class="btn btn-outline-danger btn-sm w-100 btn-delete">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <div class="wp-card text-center py-5">
                                <i class="fas fa-folder-open text-muted" style="font-size: 4rem;"></i>
                                <h4 class="mt-3 text-muted">No Portfolio Items</h4>
                                <p class="text-muted">Start by creating your first portfolio item</p>
                                <button class="btn btn-wp-primary" data-bs-toggle="modal" data-bs-target="#portfolioModal" onclick="resetForm()">
                                    <i class="fas fa-plus"></i> Create First Portfolio
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>
</div>
<!-- Advanced Portfolio Modal -->
<div class="modal fade" id="portfolioModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" id="portfolioForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Create New Portfolio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="action" id="formAction" value="add">
                    <input type="hidden" name="id" id="portfolioId">
                    
                    <div class="row">
                        <!-- Left Column - Basic Info -->
                        <div class="col-md-6">
                            <div class="card border-0 bg-light">
                                <div class="card-header bg-transparent">
                                    <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Basic Information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Title *</label>
                                        <input type="text" name="title" id="title" class="form-control" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" id="description" class="form-control" rows="4" placeholder="Describe your project..."></textarea>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Category *</label>
                                            <input type="text" name="category" id="category" class="form-control" required placeholder="e.g. Web Design">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Client</label>
                                            <input type="text" name="client" id="client" class="form-control" placeholder="Client name">
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
                                        <input type="url" name="url" id="url" class="form-control" placeholder="https://example.com">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Right Column - Images -->
                        <div class="col-md-6">
                            <div class="card border-0 bg-light">
                                <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0"><i class="fas fa-images me-2"></i>Project Images</h6>
                                    <button type="button" class="btn btn-sm btn-wp-primary" onclick="addImageUpload()">
                                        <i class="fas fa-plus"></i> Add Image
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div id="imageUploadList">
                                        <!-- Image upload items will be added here -->
                                    </div>
                                    
                                    <div id="currentImages" class="mt-3"></div>
                                    
                                    <div class="text-center mt-3">
                                        <small class="text-muted">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Supported: JPG, PNG, GIF, WebP (Max 5MB each)
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-wp-primary">
                        <i class="fas fa-save"></i> Save Portfolio
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.image-upload-item {
    background: white;
    border: 2px dashed #dee2e6;
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 15px;
    transition: all 0.3s ease;
    position: relative;
}

.image-upload-item:hover {
    border-color: var(--primary-color);
    background: #fff8f5;
}

.image-upload-item.has-image {
    border-style: solid;
    border-color: var(--success-color);
    background: #f0fff4;
}

.image-preview {
    width: 100%;
    height: 120px;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 10px;
}

.remove-image {
    position: absolute;
    top: 5px;
    right: 5px;
    background: var(--danger-color);
    color: white;
    border: none;
    border-radius: 50%;
    width: 25px;
    height: 25px;
    font-size: 12px;
    cursor: pointer;
}
</style>

<script>
let imageUploadCounter = 0;

function resetForm() {
    document.getElementById('portfolioForm').reset();
    document.getElementById('formAction').value = 'add';
    document.getElementById('modalTitle').textContent = 'Create New Portfolio';
    document.getElementById('currentImages').innerHTML = '';
    document.getElementById('portfolioId').value = '';
    document.getElementById('imageUploadList').innerHTML = '';
    imageUploadCounter = 0;
    addImageUpload(); // Add first upload field
}

function addImageUpload() {
    imageUploadCounter++;
    const uploadList = document.getElementById('imageUploadList');
    
    const uploadItem = document.createElement('div');
    uploadItem.className = 'image-upload-item';
    uploadItem.id = `upload-item-${imageUploadCounter}`;
    
    uploadItem.innerHTML = `
        <button type="button" class="remove-image" onclick="removeImageUpload(${imageUploadCounter})">
            <i class="fas fa-times"></i>
        </button>
        <div class="text-center mb-3">
            <i class="fas fa-cloud-upload-alt fa-2x text-muted"></i>
            <p class="mb-2 text-muted">Click to upload image</p>
        </div>
        <input type="file" name="images[]" class="form-control" accept="image/*" 
               onchange="previewImage(this, ${imageUploadCounter})" id="file-${imageUploadCounter}">
        <div id="preview-${imageUploadCounter}" class="mt-2"></div>
    `;
    
    uploadList.appendChild(uploadItem);
}

function removeImageUpload(id) {
    const item = document.getElementById(`upload-item-${id}`);
    if (item) {
        item.remove();
    }
}

function previewImage(input, id) {
    const preview = document.getElementById(`preview-${id}`);
    const uploadItem = document.getElementById(`upload-item-${id}`);
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `<img src="${e.target.result}" class="image-preview">`;
            uploadItem.classList.add('has-image');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function editPortfolio(id) {
    fetch('<?= base_url('admin/get_portfolio/') ?>' + id)
        .then(response => response.json())
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
            
            // Show current images with drag and drop
            let imagesHtml = '';
            if (data.images && data.images.length > 0) {
                imagesHtml = `
                    <h6 class="text-muted mb-3">Current Images:</h6>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <small class="text-muted">Drag images to reorder</small>
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="saveImageOrder(${data.id})">
                            <i class="fas fa-save"></i> Save Order
                        </button>
                    </div>
                    <div id="sortableImages" class="image-container">`;
                
                data.images.forEach((img, index) => {
                    imagesHtml += `
                        <div class="image-item" draggable="true" data-image="${img.image}" data-index="${index}">
                            <div class="image-order">${index + 1}</div>
                            <img src="<?= base_url('uploads/') ?>${img.image}" alt="Portfolio Image">
                            <div class="image-controls">
                                <button type="button" onclick="moveImageUp(${index})" ${index === 0 ? 'disabled' : ''}>↑</button>
                                <button type="button" onclick="moveImageDown(${index})" ${index === data.images.length - 1 ? 'disabled' : ''}>↓</button>
                            </div>
                        </div>`;
                });
                imagesHtml += '</div>';
            }
            document.getElementById('currentImages').innerHTML = imagesHtml;
            
            // Initialize drag and drop
            if (data.images && data.images.length > 0) {
                initImageDragDrop();
            }
            
            // Reset upload list and add one field
            document.getElementById('imageUploadList').innerHTML = '';
            imageUploadCounter = 0;
            addImageUpload();
            
            new bootstrap.Modal(document.getElementById('portfolioModal')).show();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to load portfolio data: ' + error.message);
        });
}

// Initialize with one upload field
document.addEventListener('DOMContentLoaded', function() {
    addImageUpload();
});

// Image drag and drop functions
let currentImages = [];

function initImageDragDrop() {
    const container = document.getElementById('sortableImages');
    if (!container) return;
    
    // Get current images order
    const imageItems = container.querySelectorAll('.image-item');
    currentImages = Array.from(imageItems).map(item => ({
        image: item.dataset.image,
        caption: ''
    }));
    
    // Add drag event listeners
    imageItems.forEach(item => {
        item.addEventListener('dragstart', handleDragStart);
        item.addEventListener('dragend', handleDragEnd);
    });
    
    container.addEventListener('dragover', handleDragOver);
    container.addEventListener('drop', handleDrop);
}

function handleDragStart(e) {
    e.dataTransfer.setData('text/plain', e.target.dataset.index);
    e.target.classList.add('dragging');
}

function handleDragEnd(e) {
    e.target.classList.remove('dragging');
}

function handleDragOver(e) {
    e.preventDefault();
    document.getElementById('sortableImages').classList.add('drop-zone');
}

function handleDrop(e) {
    e.preventDefault();
    document.getElementById('sortableImages').classList.remove('drop-zone');
    
    const fromIndex = parseInt(e.dataTransfer.getData('text/plain'));
    const toElement = e.target.closest('.image-item');
    
    if (toElement && toElement.dataset.index !== undefined) {
        const toIndex = parseInt(toElement.dataset.index);
        moveImage(fromIndex, toIndex);
    }
}

function moveImage(fromIndex, toIndex) {
    const item = currentImages.splice(fromIndex, 1)[0];
    currentImages.splice(toIndex, 0, item);
    updateImageDisplay();
}

function moveImageUp(index) {
    if (index > 0) {
        moveImage(index, index - 1);
    }
}

function moveImageDown(index) {
    if (index < currentImages.length - 1) {
        moveImage(index, index + 1);
    }
}

function updateImageDisplay() {
    const container = document.getElementById('sortableImages');
    container.innerHTML = '';
    
    currentImages.forEach((img, index) => {
        const div = document.createElement('div');
        div.className = 'image-item';
        div.draggable = true;
        div.dataset.image = img.image;
        div.dataset.index = index;
        
        div.innerHTML = `
            <div class="image-order">${index + 1}</div>
            <img src="<?= base_url('uploads/') ?>${img.image}" alt="Portfolio Image">
            <div class="image-controls">
                <button type="button" onclick="moveImageUp(${index})" ${index === 0 ? 'disabled' : ''}>↑</button>
                <button type="button" onclick="moveImageDown(${index})" ${index === currentImages.length - 1 ? 'disabled' : ''}>↓</button>
            </div>
        `;
        
        div.addEventListener('dragstart', handleDragStart);
        div.addEventListener('dragend', handleDragEnd);
        
        container.appendChild(div);
    });
}

function saveImageOrder(portfolioId) {
    fetch('<?= base_url('admin/update_image_order') ?>', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            portfolio_id: portfolioId,
            images: currentImages
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Image order saved successfully!');
        } else {
            alert('Error saving order: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error saving order');
    });
}
</script>

<style>
.image-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 10px;
    padding: 15px;
    border: 2px dashed #ddd;
    border-radius: 8px;
    min-height: 150px;
}

.image-item {
    position: relative;
    background: white;
    border-radius: 6px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    cursor: move;
    transition: all 0.2s;
    overflow: hidden;
}

.image-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.image-item.dragging {
    opacity: 0.5;
    transform: rotate(2deg) scale(0.95);
}

.image-item img {
    width: 100%;
    height: 80px;
    object-fit: cover;
    display: block;
}

.image-order {
    position: absolute;
    top: 3px;
    left: 3px;
    background: rgba(0,0,0,0.8);
    color: white;
    padding: 1px 4px;
    border-radius: 3px;
    font-size: 10px;
    font-weight: bold;
}

.image-controls {
    position: absolute;
    top: 3px;
    right: 3px;
    display: flex;
    gap: 1px;
}

.image-controls button {
    background: rgba(255,255,255,0.9);
    border: none;
    width: 18px;
    height: 18px;
    border-radius: 3px;
    cursor: pointer;
    font-size: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.image-controls button:hover {
    background: white;
}

.image-controls button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.drop-zone {
    border-color: #007cba;
    background: rgba(0,124,186,0.05);
}
</style>

<?php $this->load->view('admin/layout/footer'); ?>
