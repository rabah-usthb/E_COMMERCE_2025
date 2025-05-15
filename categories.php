<div id="categories-section">
  <h1 class="title">Manage Categories</h1>
  <ul class="breadcrumbs">
    <li><a href="#">Home</a></li>
    <li class="divider">/</li>
    <li><a href="#" class="active">Categories</a></li>
  </ul>

  <div class="data">
    <div class="content-data">
      <div class="head">
        <h3>Product Categories</h3>
        <div class="add-category-form">
          <input type="text" id="new-category-input" placeholder="Enter category name">
          <button id="add-category-btn" class="btn-primary">
            <i class='bx bx-plus'></i> Add Category
          </button>
        </div>
      </div>

      <!-- Categories Container -->
      <div class="categories-container">
        <div id="categories-list">
          <!-- Categories will be populated here -->
        </div>
      </div>

      <div class="empty-state" id="empty-state" style="display: none;">
        <i class='bx bx-category empty-icon'></i>
        <p>No categories found. Add a new category to get started.</p>
      </div>
    </div>
  </div>
</div>

<style>
/* Category Management Styles - Consistent with Admin Dashboard */
.add-category-form {
  display: flex;
  gap: 10px;
  align-items: center;
}

.add-category-form input {
  flex: 1;
  height: 38px;
  padding: 0 12px;
  border: 1px solid var(--grey);
  border-radius: 5px;
  font-size: 14px;
  outline: none;
  transition: all .3s ease;
}

.add-category-form input:focus {
  border-color: var(--blue);
  box-shadow: 0 0 0 2px rgba(22, 153, 176, 0.1);
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

.categories-container {
  margin-top: 20px;
}

.category-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px 15px;
  background: var(--light);
  border-radius: 5px;
  margin-bottom: 10px;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
  transition: all .3s ease;
}

.category-item:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
}

.category-name {
  font-weight: 500;
  font-size: 15px;
  color: var(--dark);
  display: flex;
  align-items: center;
}

.category-name i {
  margin-right: 10px;
  font-size: 18px;
  color: var(--blue);
}

.category-actions {
  display: flex;
  gap: 8px;
}

.category-actions button {
  width: 32px;
  height: 32px;
  border-radius: 5px;
  display: flex;
  align-items: center;
  justify-content: center;
  border: none;
  cursor: pointer;
  transition: all .3s ease;
}

.btn-edit {
  background: var(--grey);
  color: var(--dark);
}

.btn-edit:hover {
  background: #e2e8f0;
}

.btn-delete {
  background: #fff0f0;
  color: var(--red);
}

.btn-delete:hover {
  background: #ffe0e0;
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

.badge-count {
  background: var(--light-blue);
  color: var(--blue);
  padding: 2px 8px;
  border-radius: 12px;
  font-size: 12px;
  font-weight: 500;
  margin-left: 8px;
}

/* Modal Styles */
.category-modal {
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
  width: 400px;
  max-width: 90%;
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

/* Animation */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-10px); }
  to { opacity: 1; transform: translateY(0); }
}

.category-item {
  animation: fadeIn 0.3s ease forwards;
}
</style>

<div class="category-modal" id="edit-modal">
  <div class="modal-content">
    <div class="modal-header">
      <h3>Edit Category</h3>
      <span class="modal-close">&times;</span>
    </div>
    <div class="modal-body">
      <input type="text" id="edit-category-name" placeholder="Category name" style="width: 100%; padding: 10px; border: 1px solid var(--grey); border-radius: 5px;">
      <input type="hidden" id="edit-category-id">
    </div>
    <div class="modal-footer">
      <button class="btn-cancel" id="cancel-edit">Cancel</button>
      <button class="btn-primary" id="save-edit">Save Changes</button>
    </div>
  </div>
</div>

<div class="category-modal" id="delete-modal">
  <div class="modal-content">
    <div class="modal-header">
      <h3>Delete Category</h3>
      <span class="modal-close">&times;</span>
    </div>
    <div class="modal-body">
      <p>Are you sure you want to delete the category "<span id="delete-category-name"></span>"?</p>
      <p style="color: var(--red); margin-top: 10px;">This action cannot be undone.</p>
      <input type="hidden" id="delete-category-id">
    </div>
    <div class="modal-footer">
      <button class="btn-cancel" id="cancel-delete">Cancel</button>
      <button class="btn-delete" id="confirm-delete">Delete</button>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Initial example categories
  const categories = [
    { id: 1, name: 'Electronics' },
    { id: 2, name: 'Apparel' },
    { id: 3, name: 'Home & Garden' },
    { id: 4, name: 'Books' },
    { id: 5, name: 'Sports' },
  ];
  
  const categoriesList = document.getElementById('categories-list');
  const emptyState = document.getElementById('empty-state');
  const newCategoryInput = document.getElementById('new-category-input');
  const addCategoryBtn = document.getElementById('add-category-btn');
  
  // Modal elements
  const editModal = document.getElementById('edit-modal');
  const deleteModal = document.getElementById('delete-modal');
  const editNameInput = document.getElementById('edit-category-name');
  const editIdInput = document.getElementById('edit-category-id');
  const deleteNameSpan = document.getElementById('delete-category-name');
  const deleteIdInput = document.getElementById('delete-category-id');
  
  // Render categories
  function renderCategories() {
    categoriesList.innerHTML = '';
    
    if (categories.length === 0) {
      emptyState.style.display = 'block';
      return;
    }
    
    emptyState.style.display = 'none';
    
    categories.forEach((category, index) => {
      const categoryItem = document.createElement('div');
      categoryItem.classList.add('category-item');
      categoryItem.style.animationDelay = `${index * 0.05}s`;
      
      categoryItem.innerHTML = `
        <div class="category-name">
          <i class='bx bx-category'></i>
          ${category.name}
          <span class="badge-count">0</span>
        </div>
        <div class="category-actions">
          <button class="btn-edit" data-id="${category.id}" title="Edit">
            <i class='bx bx-edit'></i>
          </button>
          <button class="btn-delete" data-id="${category.id}" title="Delete">
            <i class='bx bx-trash'></i>
          </button>
        </div>
      `;
      
      categoriesList.appendChild(categoryItem);
    });
    
    // Add event listeners to edit/delete buttons
    document.querySelectorAll('.btn-edit').forEach(btn => {
      btn.addEventListener('click', function() {
        const id = parseInt(this.getAttribute('data-id'));
        const category = categories.find(cat => cat.id === id);
        
        editIdInput.value = id;
        editNameInput.value = category.name;
        editModal.style.display = 'flex';
      });
    });
    
    document.querySelectorAll('.btn-delete').forEach(btn => {
      btn.addEventListener('click', function() {
        const id = parseInt(this.getAttribute('data-id'));
        const category = categories.find(cat => cat.id === id);
        
        deleteIdInput.value = id;
        deleteNameSpan.textContent = category.name;
        deleteModal.style.display = 'flex';
      });
    });
  }
  
  // Add new category
  addCategoryBtn.addEventListener('click', function() {
    const name = newCategoryInput.value.trim();
    
    if (name === '') {
      alert('Please enter a category name');
      return;
    }
    
    // Check for duplicate
    if (categories.some(cat => cat.name.toLowerCase() === name.toLowerCase())) {
      alert('This category already exists');
      return;
    }
    
    // Generate new ID (in a real app, this would come from the server)
    const newId = categories.length > 0 ? Math.max(...categories.map(cat => cat.id)) + 1 : 1;
    
    // Add new category
    categories.push({ id: newId, name: name });
    
    // Clear input
    newCategoryInput.value = '';
    
    // Render updated list
    renderCategories();
    
    // Show success message
    showNotification('Category added successfully');
  });
  
  // Save edit
  document.getElementById('save-edit').addEventListener('click', function() {
    const id = parseInt(editIdInput.value);
    const newName = editNameInput.value.trim();
    
    if (newName === '') {
      alert('Please enter a category name');
      return;
    }
    
    // Check for duplicate (excluding the current category)
    if (categories.some(cat => cat.id !== id && cat.name.toLowerCase() === newName.toLowerCase())) {
      alert('This category name already exists');
      return;
    }
    
    // Update category
    const index = categories.findIndex(cat => cat.id === id);
    if (index !== -1) {
      categories[index].name = newName;
    }
    
    // Close modal
    editModal.style.display = 'none';
    
    // Render updated list
    renderCategories();
    
    // Show success message
    showNotification('Category updated successfully');
  });
  
  // Confirm delete
  document.getElementById('confirm-delete').addEventListener('click', function() {
    const id = parseInt(deleteIdInput.value);
    
    // Remove category
    const index = categories.findIndex(cat => cat.id === id);
    if (index !== -1) {
      categories.splice(index, 1);
    }
    
    // Close modal
    deleteModal.style.display = 'none';
    
    // Render updated list
    renderCategories();
    
    // Show success message
    showNotification('Category deleted successfully');
  });
  
  // Close modals
  document.querySelectorAll('.modal-close, #cancel-edit, #cancel-delete').forEach(elem => {
    elem.addEventListener('click', function() {
      editModal.style.display = 'none';
      deleteModal.style.display = 'none';
    });
  });
  
  // Close modal when clicking outside
  window.addEventListener('click', function(e) {
    if (e.target === editModal) {
      editModal.style.display = 'none';
    }
    if (e.target === deleteModal) {
      deleteModal.style.display = 'none';
    }
  });
  
  // Enter key to add category
  newCategoryInput.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
      addCategoryBtn.click();
    }
  });
  
  // Show notification
  function showNotification(message) {
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
      }, 300);
    }, 3000);
  }
  
  // Initial render
  renderCategories();
});
</script>