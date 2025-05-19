<?php
require_once 'admin.php';

$products =  getAllProducts();

?>

<div id="products-section">
  <h1 class="title">Manage Products</h1>
  <ul class="breadcrumbs">
    <li><a href="#">Home</a></li>
    <li class="divider">/</li>
    <li><a href="#" class="active">Products</a></li>
  </ul>

  <div class="data">
    <div class="content-data">
      <div class="head">
        <h3>Product List</h3>
        <div class="product-actions">
          <button id="add-product-btn" class="btn-primary">
            <i class='bx bx-plus'></i> Add New Product
          </button>
        </div>
      </div>
      
      <!-- Products Container -->
      <div class="products-container" id="products-list">
        <?php if (empty($products)): ?>
          <div class="empty-state">
            <i class='bx bx-package empty-icon'></i>
            <p>No products found. Add a new product to get started.</p>
          </div>
        <?php else: ?>
          <?php foreach ($products as $prod): ?>
            <?php
              // Determine stock class
              if ((int)$prod['available'] === 0) {
                  $stockClass = 'stock-low';
              } elseif ((int)$prod['available'] < 10) {
                  $stockClass = 'stock-medium';
              } else {
                  $stockClass = 'stock-high';
              }
              // Prepare image data URI
              $imgSrc = 'data:image/jpeg;base64,' . base64_encode($prod['image_data']);
            ?>
            <div class="product-item">
              <div class="product-info">
                <img src="<?= htmlspecialchars($imgSrc) ?>"
                     alt="<?= htmlspecialchars($prod['product_name']) ?>"
                     class="product-image">
                <div class="product-details">
                  <div class="product-header">
                    <div class="product-name"><?= htmlspecialchars($prod['product_name']) ?></div>
                    <div class="product-price">
                      $<?= number_format($prod['price'], 2) ?>
                    </div>
                  </div>
                  <div class="product-brief">
                    <?= htmlspecialchars($prod['brief']) ?>
                  </div>
                  <div class="product-metrics">
                    <div class="product-metric <?= $stockClass ?>">
                      <i class='bx bx-box'></i> Available: <?= (int)$prod['available'] ?>
                    </div>
                    <div class="product-metric">
                      <i class='bx bx-chart'></i> Max Stock: <?= (int)$prod['maxStock'] ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="product-actions">
                <a href="editProduct.php?id=<?= $prod['id'] ?>" class="action-btn btn-edit" title="Edit">
                  <i class='bx bx-edit'></i>
                </a>
                <a href="deleteProduct.php?id=<?= $prod['id'] ?>" class="action-btn btn-delete" title="Delete">
                  <i class='bx bx-trash'></i>
                </a>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

      <div class="empty-state" id="empty-state" style="display: none;">
        <i class='bx bx-package empty-icon'></i>
        <p>No products found. Add a new product to get started.</p>
      </div>
    </div>
  </div>
</div>

<!-- Add/Edit Product Modal -->
<div class="product-modal" id="product-form-modal">
  <div class="modal-content">
    <div class="modal-header">
      <h3 id="form-title">Add New Product</h3>
      <span class="modal-close">&times;</span>
    </div>
    <div class="modal-body">
      <form id="product-form">
        <input type="hidden" id="edit-product-id">
        <div class="form-group">
          <label for="product-name">Product Name</label>
          <input type="text" id="product-name" required>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="product-price">Price ($)</label>
            <input type="number" id="product-price" step="0.01" min="0" required>
          </div>
          <div class="form-group">
            <label for="product-available">Available Stock</label>
            <input type="number" id="product-available" min="0" required>
          </div>
          <div class="form-group">
            <label for="product-max">Max Stock</label>
            <input type="number" id="product-max" min="0" required>
          </div>
        </div>
        <div class="form-group">
          <label for="product-image-file">Product Image</label>
          <input type="file" id="product-image-file" accept="image/*">
          <div style="margin-top: 10px;">
            <img id="image-preview" src="https://via.placeholder.com/100" alt="Image preview" style="max-width: 100px; max-height: 100px; border: 1px solid #ddd; border-radius: 5px;">
          </div>
        </div>
        <div class="form-group">
          <label>Tags</label>
          <div class="tags-input-container">
            <div class="tags-input" id="tags-input">
              <!-- Tags will be added here -->
            </div>
            <input type="text" id="tag-input" placeholder="Add tag and press Enter">
          </div>
        </div>
        <div class="form-group">
          <label for="product-brief">Brief Description</label>
          <textarea id="product-brief" maxlength="255" required></textarea>
          <div class="char-counter"><span id="brief-counter">0</span>/255</div>
        </div>
        <div class="form-group">
          <label for="product-detailed">Detailed Description</label>
          <textarea id="product-detailed" rows="5" required></textarea>
        </div>
      </form>
    </div>
    <div class="modal-footer">
      <button class="btn-cancel" id="cancel-form">Cancel</button>
      <button class="btn-primary" id="save-product">Save Product</button>
    </div>
  </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="product-modal" id="delete-modal">
  <div class="modal-content">
    <div class="modal-header">
      <h3>Delete Product</h3>
      <span class="modal-close">&times;</span>
    </div>
    <div class="modal-body">
      <p>Are you sure you want to delete "<span id="delete-product-name"></span>"?</p>
      <p style="color: var(--red); margin-top: 10px;">This action cannot be undone.</p>
      <input type="hidden" id="delete-product-id">
    </div>
    <div class="modal-footer">
      <button class="btn-cancel" id="cancel-delete">Cancel</button>
      <button class="btn-delete" id="confirm-delete">Delete</button>
    </div>
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
  // Sample products data (in a real app, this would come from the server)
  const products = [
    {
      id: 1,
      name: "Premium Wireless Headphones",
      price: 199.99,
      available: 45,
      maxStock: 100,
      tags: ["Electronics", "Audio", "Wireless"],
      brief: "High-quality wireless headphones with noise cancellation feature.",
      detailed: "Experience immersive sound with our premium wireless headphones. Featuring active noise cancellation, 40-hour battery life, and comfortable over-ear design.",
      image: "https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=300&q=80"
    },
    {
      id: 2,
      name: "Smart Fitness Tracker",
      price: 89.95,
      available: 78,
      maxStock: 150,
      tags: ["Electronics", "Fitness", "Wearable"],
      brief: "Track your fitness goals with this smart wearable device.",
      detailed: "Monitor your health and fitness with our smart fitness tracker. Features include heart rate monitoring, sleep tracking, step counter, and waterproof design.",
      image: "https://images.unsplash.com/photo-1575311373937-040b8e1fd5b5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=300&q=80"
    },
    {
      id: 3,
      name: "Ergonomic Office Chair",
      price: 249.00,
      available: 12,
      maxStock: 30,
      tags: ["Home & Garden", "Furniture", "Office"],
      brief: "Comfortable ergonomic chair designed for long work hours.",
      detailed: "Enhance your workspace with our ergonomic office chair. Designed with lumbar support, adjustable height, breathable mesh back, and smooth-rolling casters.",
      image: "https://images.unsplash.com/photo-1505843490538-5133c6c7d0e1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=300&q=80"
    },
    {
      id: 4,
      name: "Organic Cotton T-Shirt",
      price: 29.99,
      available: 135,
      maxStock: 200,
      tags: ["Clothing", "Sustainable", "Fashion"],
      brief: "Eco-friendly t-shirt made from 100% organic cotton.",
      detailed: "Look good while doing good with our organic cotton t-shirt. Made from 100% sustainably sourced organic cotton, this t-shirt is soft, durable, and kind to the planet.",
      image: "https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=300&q=80"
    },
    {
      id: 5,
      name: "Professional DSLR Camera",
      price: 1299.00,
      available: 8,
      maxStock: 25,
      tags: ["Electronics", "Photography", "Professional"],
      brief: "High-performance DSLR camera for professional photography.",
      detailed: "Capture stunning images with our professional DSLR camera. Features a 24.2MP sensor, 4K video recording, 45-point autofocus system, and weather-sealed body.",
      image: "https://images.unsplash.com/photo-1502920917128-1aa500764cbd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=300&q=80"
    }
  ];
  
  const productsList = document.getElementById('products-list');
  const emptyState = document.getElementById('empty-state');
  const addProductBtn = document.getElementById('add-product-btn');
  
  // Modals
  const formModal = document.getElementById('product-form-modal');
  const deleteModal = document.getElementById('delete-modal');
  
  // Form elements
  const productForm = document.getElementById('product-form');
  const productNameInput = document.getElementById('product-name');
  const productPriceInput = document.getElementById('product-price');
  const productAvailableInput = document.getElementById('product-available');
  const productMaxInput = document.getElementById('product-max');
  const productBriefInput = document.getElementById('product-brief');
  const productDetailedInput = document.getElementById('product-detailed');
  const productImageInput = document.getElementById('product-image-file');
  const imagePreview = document.getElementById('image-preview');
  const briefCounter = document.getElementById('brief-counter');
  const tagsInput = document.getElementById('tags-input');
  const tagInput = document.getElementById('tag-input');
  
  // Current tags for the form
  let currentTags = [];
  
  // Store the currently selected image data
  let currentImageData = '';
  
  // Image preview functionality
  productImageInput.addEventListener('change', function(e) {
    const file = e.target.files[0];
    
    if (file && file.type.match('image.*')) {
      const reader = new FileReader();
      
      reader.onload = function(e) {
        imagePreview.src = e.target.result;
        currentImageData = e.target.result;
      };
      
      reader.readAsDataURL(file);
    }
  });
  
 
  // Render tags in the form
  function renderTags() {
    tagsInput.innerHTML = '';
    
    currentTags.forEach((tag, index) => {
      const tagElement = document.createElement('div');
      tagElement.classList.add('tag-item');
      tagElement.innerHTML = `
        ${tag}
        <span class="tag-close" data-index="${index}">&times;</span>
      `;
      tagsInput.appendChild(tagElement);
    });
    
    // Add event listeners to remove tags
    document.querySelectorAll('.tag-close').forEach(closeBtn => {
      closeBtn.addEventListener('click', function() {
        const index = parseInt(this.getAttribute('data-index'));
        currentTags.splice(index, 1);
        renderTags();
      });
    });
  }
  
  // Open edit product form
  function editProduct(id) {
    const product = products.find(p => p.id === id);
    
    if (!product) return;
    
    // Set form title
    document.getElementById('form-title').textContent = 'Edit Product';
    
    // Fill form fields
    document.getElementById('edit-product-id').value = product.id;
    productNameInput.value = product.name;
    productPriceInput.value = product.price;
    productAvailableInput.value = product.available;
    productMaxInput.value = product.maxStock;
    productBriefInput.value = product.brief;
    productDetailedInput.value = product.detailed;
    imagePreview.src = product.image;
    currentImageData = product.image;
    
    // Reset file input
    productImageInput.value = '';
    
    // Set tags
    currentTags = [...product.tags];
    renderTags();
    
    // Update brief counter
    briefCounter.textContent = product.brief.length;
    
    // Show modal
    formModal.style.display = 'flex';
  }
  
  // Open add product form
  function addProduct() {
    // Set form title
    document.getElementById('form-title').textContent = 'Add New Product';
    
    // Reset form
    productForm.reset();
    document.getElementById('edit-product-id').value = '';
    briefCounter.textContent = '0';
    imagePreview.src = 'https://via.placeholder.com/100';
    currentImageData = '';
    
    // Clear tags
    currentTags = [];
    renderTags();
    
    // Show modal
    formModal.style.display = 'flex';
  }
  
  // Open delete confirmation modal
  function confirmDeleteProduct(id) {
    const product = products.find(p => p.id === id);
    
    if (!product) return;
    
    // Set product name and ID
    document.getElementById('delete-product-name').textContent = product.name;
    document.getElementById('delete-product-id').value = product.id;
    
    // Show modal
    deleteModal.style.display = 'flex';
  }
  
  // Save product (add or edit)
  function saveProduct() {
    // Get form values
    const id = document.getElementById('edit-product-id').value;
    const name = productNameInput.value.trim();
    const price = parseFloat(productPriceInput.value);
    const available = parseInt(productAvailableInput.value);
    const maxStock = parseInt(productMaxInput.value);
    const brief = productBriefInput.value.trim();
    const detailed = productDetailedInput.value.trim();
    
    // Validate form
    if (name === '' || isNaN(price) || isNaN(available) || isNaN(maxStock) || brief === '' || detailed === '' || currentTags.length === 0) {
      alert('Please fill in all fields and add at least one tag');
      return;
    }
    
    // Validate image when adding new product
    if (!id && !currentImageData) {
      alert('Please select an image for the product');
      return;
    }
    
    // Create product object
    const productData = {
      name,
      price,
      available,
      maxStock,
      tags: [...currentTags],
      brief,
      detailed,
      image: currentImageData || 'https://via.placeholder.com/300'
    };
    
    if (id) {
      // Edit existing product
      const index = products.findIndex(p => p.id === parseInt(id));
      if (index !== -1) {
        // If no new image was selected, keep the existing one
        if (!currentImageData) {
          productData.image = products[index].image;
        }
        
        products[index] = { ...products[index], ...productData };
        showNotification('Product updated successfully');
      }
    } else {
      // Add new product
      const newId = products.length > 0 ? Math.max(...products.map(p => p.id)) + 1 : 1;
      products.push({ id: newId, ...productData });
      showNotification('Product added successfully');
    }
    
    // Close modal and refresh product list
    formModal.style.display = 'none';
    renderProducts();
  }
  
  // Delete product
  function deleteProduct() {
    const id = parseInt(document.getElementById('delete-product-id').value);
    
    // Remove product
    const index = products.findIndex(p => p.id === id);
    if (index !== -1) {
      products.splice(index, 1);
      showNotification('Product deleted successfully');
    }
    
    // Close modal and refresh product list
    deleteModal.style.display = 'none';
    renderProducts();
  }
  
  // Show notification
  function showNotification(message) {
    // Check if notification container exists
    let notifContainer = document.querySelector('.notification-container');
    
    if (!notifContainer) {
      notifContainer = document.createElement('div');
      notifContainer.className = 'notification-container';
      document.body.appendChild(notifContainer);
    }
    
    // Create notification
    const notification = document.createElement('div');
    notification.className = 'notification';
    
    notification.innerHTML = `
      <i class='bx bx-check-circle' style="margin-right: 10px; font-size: 18px;"></i>
      ${message}
    `;
    
    notifContainer.appendChild(notification);
    
    // Remove notification after 3 seconds
    setTimeout(() => {
      notification.style.opacity = '0';
      notification.style.transform = 'translateY(10px)';
      setTimeout(() => {
        notification.remove();
      }, 300);
    }, 3000);
  }
  
  // Event listeners
  
  // Add product button
  addProductBtn.addEventListener('click', addProduct);
  
  // Form submission
  document.getElementById('save-product').addEventListener('click', saveProduct);
  
  // Delete confirmation
  document.getElementById('confirm-delete').addEventListener('click', deleteProduct);
  
  // Brief description character counter
  productBriefInput.addEventListener('input', function() {
    const length = this.value.length;
    briefCounter.textContent = length;
    
    if (length > 255) {
      this.value = this.value.substring(0, 255);
      briefCounter.textContent = 255;
    }
  });
  
  // Add tag on Enter key
  tagInput.addEventListener('keydown', function(e) {
    if (e.key === 'Enter') {
      e.preventDefault();
      
      const tag = this.value.trim();
      
      if (tag && !currentTags.includes(tag)) {
        currentTags.push(tag);
        this.value = '';
        renderTags();
      }
    }
  });
  
  // Close modals
  document.querySelectorAll('.modal-close, #cancel-form, #cancel-delete').forEach(elem => {
    elem.addEventListener('click', function() {
      formModal.style.display = 'none';
      deleteModal.style.display = 'none';
    });
  });
  
  // Close modal when clicking outside
  window.addEventListener('click', function(e) {
    if (e.target === formModal) {
      formModal.style.display = 'none';
    }
    if (e.target === deleteModal) {
      deleteModal.style.display = 'none';
    }
  });
  

});
</script>