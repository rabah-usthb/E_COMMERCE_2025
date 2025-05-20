<?php 
require_once 'admin.php';
$products = getAllProducts();
$json = json_encode($products, JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP | JSON_INVALID_UTF8_IGNORE | JSON_PARTIAL_OUTPUT_ON_ERROR );
if ($json === false) {
    die('JSON encode error: ' . json_last_error_msg());
}
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
      <div class="products-container">
        <div id="products-list">
          <?php
           printProducts($products);
          ?>
        </div>
      </div>

      <div class="empty-state" id="empty-state" >
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
      <form id="product-form" enctype="multipart/form-data">
        <input type="hidden" id="edit-product-id">
        <div class="form-group">
          <label for="product-image">Product Image</label>
          <img id="product-image-preview" alt="Image preview">
          <input type="file" id="product-image" accept="image/*" required>
        </div>
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
          <div class="form-group">
            <label for="product-sold">Sold (%)</label>
            <input type="number" id="product-sold" min="0" max="100" step="0.01" required>
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
      <button  id="confirm-delete">Delete</button>
    </div>
  </div>
</div>

<style>
/* Product Management Styles - Consistent with Admin Dashboard */
.product-actions {
  display: flex;
  justify-content: flex-end;
}

.btn-primary {
  display: flex;
  align-items: center;
  gap: 5px;
  padding: 8px 16px;
  background: var(--blue);
  color: var(--light);
  border-radius: 5px;
  font-weight: 500;
  font-size: 14px;
  cursor: pointer;
  border: none;
  transition: all .3s ease;
}

.btn-primary:hover {
  background: var(--dark-blue);
}

.products-container {
  margin-top: 20px;
}

.product-item {
  display: flex;
  justify-content: space-between;
  padding: 15px;
  background: var(--light);
  border-radius: 10px;
  margin-bottom: 15px;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
  transition: all .3s ease;
}

.product-item:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.product-info {
  display: flex;
  align-items: flex-start;
  gap: 15px;
  flex: 1;
}

.product-image {
  width: 70px;
  height: 70px;
  border-radius: 8px;
  object-fit: cover;
  border: 1px solid var(--grey);
}

#product-image-preview {
  height:80px;
  border-radius: 8px;
  object-fit: cover;
  border: 1px solid var(--grey);
}

.product-details {
  display: flex;
  flex-direction: column;
  flex: 1;
}


.product-header {
  display: flex;
  justify-content: flex-start;
  align-items: baseline;
  gap: 20px;
  margin-bottom: 8px;
}

.product-price {
  display: flex;
  align-items: baseline;
  gap: 8px;
}

.no-sale-price {
  color: #28a745;          /* green */
  font-weight: bold;
}

.original-price {
  text-decoration: line-through;
  color: #888;
  margin-right: 6px;
}

.discounted-price {
  color: #dc3545;          /* red */
  font-weight: bold;
}
.product-sold {
  font-size: 13px;
  color: var(--dark-grey);
  margin-left: 0;
}


.product-name {
  font-weight: 600;
  margin-right: 140px;
  font-size: 16px;
  color: var(--dark);
}

.product-tags {
  display: flex;
  flex-wrap: wrap;
  gap: 5px;
  margin-bottom: 8px;
}

.product-tag {
  display: inline-block;
  padding: 3px 10px;
  background: var(--light-blue);
  color: var(--blue);
  border-radius: 12px;
  font-size: 12px;
}

.product-price {
  display: flex;
  align-items: baseline;
  gap: 8px;
}

.original-price {
  text-decoration: line-through;
  color: var(--dark-grey);
  font-size: 14px;
}

.discounted-price {
  color: var(--red);
  font-weight: bold;
  font-size: 16px;
}



.product-metrics {
  display: flex;
  gap: 15px;
  margin-top: 8px;
}

.product-metric {
  display: flex;
  align-items: center;
  font-size: 13px;
  color: var(--dark-grey);
}

.product-metric i {
  margin-right: 5px;
  font-size: 16px;
}

.stock-low {
  color: var(--red);
}

.stock-medium {
  color: #FFA800;
}

.stock-high {
  color: var(--green);
}

.product-brief {
  color: var(--dark-grey);
  font-size: 14px;
  margin-top: 5px;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  max-width: 400px;
}

.product-actions {
  display: flex;
  gap: 8px;
  align-items: flex-start;
}

.action-btn {
  width: 36px;
  height: 36px;
  background: var(--grey);
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all .3s ease;
  border: none;
}

.action-btn:hover {
  background: var(--blue);
  color: var(--light);
}

.btn-edit {
  color: var(--dark);
}

.btn-delete,#confirm-delete {
  color: var(--red);
  background: #FFE2E5;
}

.btn-delete:hover,#confirm-delete:hover {
  background: var(--red);
  color: var(--light);
}

.empty-state {
  padding: 40px 0;
  text-align: center;
  color: var(--dark-grey);
}

.empty-icon {
  font-size: 48px;
  color: var(--grey);
  margin-bottom: 15px;
}

.empty-state p {
  font-size: 15px;
}

/* Modal Styles */
.product-modal {
  display: none;
  position: fixed;
  z-index: 1000;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  justify-content: center;
  align-items: center;
}

.modal-content {
  background: var(--light);
  padding: 25px;
  border-radius: 10px;
  width: 700px;
  max-width: 90%;
  max-height: 90vh;
  overflow-y: auto;
  box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.modal-header h3 {
  font-size: 18px;
  font-weight: 600;
}

.modal-close {
  font-size: 20px;
  cursor: pointer;
  color: var(--dark-grey);
}

.modal-body {
  margin-bottom: 20px;
}

.modal-footer {
  display: flex;
  justify-content: flex-end;
  gap: 10px;
}

.btn-cancel {
  padding: 8px 16px;
  background: var(--grey);
  color: var(--dark);
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.form-group {
  margin-bottom: 15px;
}

.form-row {
  display: flex;
  gap: 15px;
}

.form-row .form-group {
  flex: 1;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
  font-size: 14px;
  font-weight: 500;
}

.form-group input,
.form-group select,
.form-group textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid var(--grey);
  border-radius: 5px;
  font-size: 14px;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
  border-color: var(--blue);
  outline: none;
}

/* Tags Input */
.tags-input-container {
  width:70%;
  border: 1px solid var(--grey);
  border-radius: 5px;
  padding: 10px;
  background: var(--light);
}

.tags-input {
  display: flex;
  flex-wrap: wrap;
  gap: 5px;
  margin-bottom: 8px;
}

.tag-item {
  display: flex;
  align-items: center;
  padding: 2px 8px;
  background: var(--light-blue);
  color: var(--blue);
  border-radius: 12px;
  font-size: 14px;
}

.tag-item .tag-close {
  margin-left: 5px;
  cursor: pointer;
  font-size: 16px;
}

#tag-input {
  width: 50%;
  border: none;
  outline: none;
  flex-grow: 1;
  padding: 5px 15px;
  
  font-size: 14px;
}

.char-counter {
  text-align: right;
  font-size: 12px;
  color: var(--dark-grey);
  margin-top: 5px;
}

/* Animation */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-10px); }
  to { opacity: 1; transform: translateY(0); }
}

.product-item {
  animation: fadeIn 0.3s ease forwards;
}

/* Notification */
.notification-container {
  position: fixed;
  bottom: 20px;
  right: 20px;
  z-index: 9999;
}

.notification {
  background: var(--blue);
  color: var(--light);
  padding: 12px 20px;
  border-radius: 5px;
  margin-top: 10px;
  box-shadow: 0 3px 10px rgba(0,0,0,0.1);
  display: flex;
  align-items: center;
  animation: fadeIn 0.3s ease forwards;
}

/* Responsive */
@media screen and (max-width: 768px) {
  .product-info {
    flex-direction: column;
    align-items: flex-start;
  }
  
  .form-row {
    flex-direction: column;
  }
  
  .product-metrics {
    flex-direction: column;
    gap: 5px;
  }
}
</style>

<script>

  const products = <?= $json ?>;
  console.log('Products FINALS:', products);

  const confirmDeleteBtn = document.getElementById('confirm-delete');

  const productsList = document.getElementById('products-list');
  const emptyState = document.getElementById('empty-state');
  const addProductBtn = document.getElementById('add-product-btn');
  const confirmBtn = document.getElementById('save-product');
  
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
  const productImagePreview = document.getElementById('product-image-preview');
  const productImage = document.getElementById('product-image');
  const productSold = document.getElementById('product-sold');
  const briefCounter = document.getElementById('brief-counter');
  const tagsInput = document.getElementById('tags-input');
  const tagInput = document.getElementById('tag-input');
  var product = null;
  
  // Current tags for the form
  let currentTags = [];
  
  function isEmpty(){
    const list = document.querySelectorAll('.product-item');
    return list.length === 0;
  }

 
  function initView() {
    
    if(!isEmpty()) {emptyState.style.display = 'none';}

    // Add event listeners to buttons
    document.querySelectorAll('.btn-edit').forEach(btn => {
      btn.addEventListener('click', function() {
        const name =this.getAttribute('data-id');
        editProduct(name);
      });
    });
    
    document.querySelectorAll('.btn-delete').forEach(btn => {
      btn.addEventListener('click', function() {
        const name =this.getAttribute('data-id');
         DeleteProduct(name);
      });
    });
  }
  

  function findProduct(name) {
  return products.find(p => p.product_name=== name) || null;
}


  // Open edit product form
  async function editProduct(name) {
    product = findProduct(name); 
    
    
    if (product ===null)  {return;}
    else {
    
    // Set form title
    document.getElementById('form-title').textContent = 'Edit Product';
    
    productNameInput.value = product.product_name;

    productPriceInput.value = product.price;
    productSold.value  = product.sold;
    productAvailableInput.value = product.quantity;
    productMaxInput.value = product.max;
    productBriefInput.value =  product.brief_description;
    productDetailedInput.value = product.detailed_description;

    // Set tags
    currentTags = [...product.tags];
    renderTags();
    
    // Update brief counter
    briefCounter.textContent = product.brief_description.length;
 

    const dt = new DataTransfer();

    // 2) Fetch the data URI (built-in browser decoder)
    const response = await fetch(product.image_data);
    const blob     = await response.blob();

    // 3) Wrap in a File with the original filename
    const file = new File(
      [blob],
      product.image_name,
      { type: blob.type }
    );

    // 4) Inject it into the <input>
    dt.items.add(file);
    productImage.files = dt.files;

    productImagePreview.src = URL.createObjectURL(file);

    formModal.style.display = 'flex';
    }
  }
  
  // Open add product form
  function addProduct() {
    currentTags = [];
    renderTags();
    productImage.value = '';  
    productImagePreview.src = '';
    // Set form title
    document.getElementById('form-title').textContent = 'Add New Product';
    
    // Reset form
    productForm.reset();
    document.getElementById('edit-product-id').value = '';
    briefCounter.textContent = '0';
    
    // Show modal
    formModal.style.display = 'flex';
  }
  
  // Open delete confirmation modal
  function DeleteProduct(name) {
    product = products.find(p => p.product_name === name);
    
    if (!product) return;
  
    document.getElementById('delete-product-name').textContent = product.product_name;
    
    deleteModal.style.display = 'flex';
  }
  

  function updateAfterAddRequest(data) {
    if(data.error!=='') {
      alert(data.error);
      return;
    }
    else {
      formModal.style.display = 'none';
      showNotification('Product Added Successfully').then(() => window.location.reload());
    }
  }

  function updateAfterEditRequest(data) {
    if(data.error!=='') {
      alert(data.error);
      return;
    }
    else {
      formModal.style.display = 'none';
      showNotification('Product Updated Successfully').then(() => window.location.reload());
    }
  }

  function updateAfterDeleteRequest(data) {
    if(data.error!=='') {
      alert(data.error);
      return;
    }
    else {
      deleteModal.style.display = 'none';
      showNotification('Product Deleted Successfully').then(() => window.location.reload());
    }
  }



  function sendDeleteRequest(id) {
      
      const formData = new FormData();
      formData.append('action',   'delete');
      formData.append('id', id);


      fetch('checkProd.php', {
        method: 'POST',
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        updateAfterDeleteRequest(data);
      });
}

  function sendEditRequest(name, imageFile, price, available, max, tags, sold, brief, detailed,same,id) {
      
      const formData = new FormData();
      formData.append('action',   'edit');
      formData.append('name',name);
      formData.append('image',imageFile);        
      formData.append('price',price);
      formData.append('qtn',available);
      formData.append('max',max);
      tags.forEach(tag => formData.append('tags[]', tag));
      formData.append('sold',     sold);
      formData.append('brief',    brief);
      formData.append('detailed', detailed);
      formData.append('same', same);
      formData.append('id', id);


      fetch('checkProd.php', {
        method: 'POST',
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        updateAfterEditRequest(data);
      });
}

  function sendAddRequest(name, imageFile, price, available, max, tags, sold, brief, detailed) {
  
    const formData = new FormData();
    formData.append('action',   'add');
    formData.append('name',name);
    formData.append('image',imageFile);        
    formData.append('price',price);
    formData.append('qtn',available);
    formData.append('max',max);
    tags.forEach(tag => formData.append('tags[]', tag));
    formData.append('sold',     sold);
    formData.append('brief',    brief);
    formData.append('detailed', detailed);


    fetch('checkProd.php', {
      method: 'POST',
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      updateAfterAddRequest(data);
    });
}

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


  function updatePreview() {
    const file = productImage.files[0];
    if (file) {
      productImagePreview.src = URL.createObjectURL(file);
    } 
    else {
      productImagePreview.src = '';
    }
  }

  productImage.addEventListener('change',updatePreview);

  // Save product (add or edit)
  function saveProduct() {
  
    const name = productNameInput.value.trim();
    const price = parseFloat(productPriceInput.value);
    const available = parseInt(productAvailableInput.value);
    const maxStock = parseInt(productMaxInput.value);
    const sold = parseFloat(productSold.value);
    const brief = productBriefInput.value.trim();
    const detailed = productDetailedInput.value.trim();
    const image = productImage.files[0];

    
    // Validate form
    if (name === '' || !image || isNaN(price) || isNaN(available) || isNaN(maxStock) || brief === '' || detailed === '' || currentTags.length === 0) {
      alert('Please fill in all fields and add at least one tag');
      return;
    }
    else if(price==0) {
      alert('Price Can\'t Be 0');
    }
    else if(maxStock < available) {
      alert('Available Stock Can\'t > Max Stock');
    }
    else {

      if(document.getElementById('form-title').textContent === 'Edit Product') {
        const same =  product.product_name.toLowerCase() === name.toLowerCase();
        sendEditRequest(name,image,price,available,maxStock,currentTags,sold,brief,detailed,same,product.id);
      }
      else {
      sendAddRequest(name,image,price,available,maxStock,currentTags,sold,brief,detailed);
      }
    }
    
  
  }

  function confirmDeleteProduct () {
    sendDeleteRequest(product.id); 
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
  
  function showNotification(message) {
  // Show notification
  return new Promise((resolve) => {
        // Check if notification container exists
        let notifContainer = document.querySelector('.notification-container');
        
        if (!notifContainer) {
          notifContainer = document.createElement('div');
          notifContainer.className = 'notification-container';
          notifContainer.style.position = 'fixed';
          notifContainer.style.bottom = '20px';
          notifContainer.style.right = '20px';
          notifContainer.style.zIndex = '9999';
          document.body.appendChild(notifContainer);
        }
        
        // Create notification
        const notification = document.createElement('div');
        notification.className = 'notification';
        notification.style.background = 'var(--blue)';
        notification.style.color = 'var(--light)';
        notification.style.padding = '12px 20px';
        notification.style.borderRadius = '5px';
        notification.style.marginTop = '10px';
        notification.style.boxShadow = '0 3px 10px rgba(0,0,0,0.1)';
        notification.style.display = 'flex';
        notification.style.alignItems = 'center';
        notification.style.animation = 'fadeIn 0.3s ease forwards';
        
        notification.innerHTML = `
          <i class='bx bx-check-circle' style="margin-right: 10px; font-size: 18px;"></i>
          ${message}
        `;
        
        notifContainer.appendChild(notification);
        
        // Remove notification after 3 seconds
        setTimeout(() => {
          notification.style.opacity = '0';
          notification.style.transform = 'translateX(100%)';
          setTimeout(() => {
            notification.remove();
            // Resolve the promise after notification is completely removed
            resolve();
          }, 80);
        }, 500);
    });
}
  
  // Event listeners
  
  // Add product button
  addProductBtn.addEventListener('click', addProduct);
  
  // Form submission
  confirmBtn.addEventListener('click', saveProduct);
  
  // Delete confirmation
  confirmDeleteBtn.addEventListener('click', confirmDeleteProduct);
  
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
  
  // Render initial products
  initView();

</script>