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
            <div class="content-header">
                <h1 class="h2 mb-0">
                    <i class="fas fa-images me-2"></i>Image Manager
                </h1>
                <p class="text-muted mb-0">Drag and drop to reorder images</p>
            </div>
            
            <div class="px-4">
                <div class="wp-card">
                    <div class="card-body">
                        <div id="imageContainer" class="sortable-container">
                            <!-- Images will be loaded here -->
                        </div>
                        <button id="saveOrder" class="btn btn-wp-primary mt-3">
                            <i class="fas fa-save me-2"></i>Save Order
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<style>
.sortable-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 20px;
    min-height: 200px;
    padding: 20px;
    border: 2px dashed #ddd;
    border-radius: 8px;
}

.image-item {
    position: relative;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    cursor: move;
    transition: transform 0.2s;
}

.image-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(0,0,0,0.15);
}

.image-item.dragging {
    opacity: 0.5;
    transform: rotate(5deg);
}

.image-item img {
    width: 100%;
    height: 150px;
    object-fit: cover;
    border-radius: 8px 8px 0 0;
}

.image-info {
    padding: 10px;
}

.image-order {
    position: absolute;
    top: 5px;
    left: 5px;
    background: rgba(0,0,0,0.7);
    color: white;
    padding: 2px 6px;
    border-radius: 4px;
    font-size: 12px;
}

.drop-zone {
    border: 2px dashed #007cba;
    background: rgba(0,124,186,0.1);
}
</style>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('imageContainer');
    
    // Load images
    loadImages();
    
    // Initialize Sortable
    const sortable = new Sortable(container, {
        animation: 150,
        ghostClass: 'dragging',
        onStart: function(evt) {
            container.classList.add('drop-zone');
        },
        onEnd: function(evt) {
            container.classList.remove('drop-zone');
            updateOrderNumbers();
        }
    });
    
    // Save order button
    document.getElementById('saveOrder').addEventListener('click', saveOrder);
    
    function loadImages() {
        // Get portfolio ID from URL or set default
        const portfolioId = new URLSearchParams(window.location.search).get('id') || 1;
        
        fetch(`<?= base_url('admin/get_portfolio/') ?>${portfolioId}`)
            .then(response => response.json())
            .then(data => {
                if (data.images) {
                    renderImages(data.images);
                }
            })
            .catch(error => console.error('Error:', error));
    }
    
    function renderImages(images) {
        container.innerHTML = '';
        images.forEach((image, index) => {
            const imageItem = createImageItem(image, index + 1);
            container.appendChild(imageItem);
        });
    }
    
    function createImageItem(image, order) {
        const div = document.createElement('div');
        div.className = 'image-item';
        div.dataset.image = image.image;
        
        div.innerHTML = `
            <div class="image-order">${order}</div>
            <img src="<?= base_url('uploads/') ?>${image.image}" alt="Portfolio Image">
            <div class="image-info">
                <small class="text-muted">${image.image}</small>
            </div>
        `;
        
        return div;
    }
    
    function updateOrderNumbers() {
        const items = container.querySelectorAll('.image-item');
        items.forEach((item, index) => {
            const orderElement = item.querySelector('.image-order');
            orderElement.textContent = index + 1;
        });
    }
    
    function saveOrder() {
        const items = container.querySelectorAll('.image-item');
        const orderedImages = Array.from(items).map(item => ({
            image: item.dataset.image,
            caption: ''
        }));
        
        const portfolioId = new URLSearchParams(window.location.search).get('id') || 1;
        
        fetch(`<?= base_url('admin/update_image_order') ?>`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                portfolio_id: portfolioId,
                images: orderedImages
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Image order saved successfully!');
            } else {
                alert('Error saving order: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error saving order');
        });
    }
});
</script>

<?php $this->load->view('admin/layout/footer'); ?>
