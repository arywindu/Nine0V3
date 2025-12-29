// Image Drag and Drop Manager
class ImageDragDrop {
    constructor(containerId) {
        this.container = document.getElementById(containerId);
        this.images = [];
        this.init();
    }
    
    init() {
        if (!this.container) return;
        
        this.container.addEventListener('dragover', this.handleDragOver.bind(this));
        this.container.addEventListener('drop', this.handleDrop.bind(this));
    }
    
    loadImages(portfolioId) {
        fetch(`admin/get_portfolio/${portfolioId}`)
            .then(response => response.json())
            .then(data => {
                if (data.images) {
                    this.images = data.images;
                    this.render();
                }
            });
    }
    
    render() {
        this.container.innerHTML = '';
        this.images.forEach((image, index) => {
            const imageEl = this.createImageElement(image, index);
            this.container.appendChild(imageEl);
        });
    }
    
    createImageElement(image, index) {
        const div = document.createElement('div');
        div.className = 'image-item';
        div.draggable = true;
        div.dataset.index = index;
        
        div.innerHTML = `
            <div class="image-order">${index + 1}</div>
            <img src="uploads/${image.image}" alt="Portfolio Image">
            <div class="image-controls">
                <button onclick="imageManager.moveUp(${index})" ${index === 0 ? 'disabled' : ''}>↑</button>
                <button onclick="imageManager.moveDown(${index})" ${index === this.images.length - 1 ? 'disabled' : ''}>↓</button>
            </div>
        `;
        
        div.addEventListener('dragstart', this.handleDragStart.bind(this));
        div.addEventListener('dragend', this.handleDragEnd.bind(this));
        
        return div;
    }
    
    handleDragStart(e) {
        e.dataTransfer.setData('text/plain', e.target.dataset.index);
        e.target.classList.add('dragging');
    }
    
    handleDragEnd(e) {
        e.target.classList.remove('dragging');
    }
    
    handleDragOver(e) {
        e.preventDefault();
    }
    
    handleDrop(e) {
        e.preventDefault();
        const fromIndex = parseInt(e.dataTransfer.getData('text/plain'));
        const toElement = e.target.closest('.image-item');
        
        if (toElement) {
            const toIndex = parseInt(toElement.dataset.index);
            this.moveImage(fromIndex, toIndex);
        }
    }
    
    moveImage(fromIndex, toIndex) {
        const item = this.images.splice(fromIndex, 1)[0];
        this.images.splice(toIndex, 0, item);
        this.render();
    }
    
    moveUp(index) {
        if (index > 0) {
            this.moveImage(index, index - 1);
        }
    }
    
    moveDown(index) {
        if (index < this.images.length - 1) {
            this.moveImage(index, index + 1);
        }
    }
    
    saveOrder(portfolioId) {
        fetch('admin/update_image_order', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                portfolio_id: portfolioId,
                images: this.images
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Order saved!');
            }
        });
    }
}

// Initialize
let imageManager;
document.addEventListener('DOMContentLoaded', function() {
    imageManager = new ImageDragDrop('imageContainer');
});
