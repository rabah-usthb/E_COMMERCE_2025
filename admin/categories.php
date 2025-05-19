<?php
require_once 'admin.php';
?>

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
         <?php  printCategories(); ?>
        </div>
      </div>

      <div class="empty-state" id="empty-state">
        <i class='bx bx-category empty-icon'></i>
        <p>No categories found. Add a new category to get started.</p>
      </div>
    </div>
  </div>
</div>



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
      <button id="confirm-delete">Delete</button>
    </div>
  </div>
</div>

<script> 


  const categoriesList = document.getElementById('categories-list');
  const emptyState = document.getElementById('empty-state');
  const newCategoryInput = document.getElementById('new-category-input');
  const addCategoryBtn = document.getElementById('add-category-btn');
 
  const confirmDeleteBtn = document.getElementById('confirm-delete');
  const editBtn = document.getElementById('save-edit');
  
 
  const editModal = document.getElementById('edit-modal');
  const deleteModal = document.getElementById('delete-modal');
  const editNameInput = document.getElementById('edit-category-name');
  const editIdInput = document.getElementById('edit-category-id');
  const deleteNameSpan = document.getElementById('delete-category-name');
  const deleteIdInput = document.getElementById('delete-category-id');

  let current_editName = '';
  

  function sendCreateRequest(name) {

    fetch('checkCat.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
          action: 'add',   
          name: name
        })
      })
      .then(res => res.json())  
      .then(data => {            
       updateAfterCreateRequest(data);
     
      });
}


function sendEditRequest(name) {

  fetch('checkCat.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: new URLSearchParams({
        action: 'edit',   
        old: current_editName,
        new: name
      })
    })
    .then(res => res.json())  
    .then(data => {            
    updateAfterEditRequest(data);
  
    });
}


function sendDeleteRequest(name) {

fetch('checkCat.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: new URLSearchParams({
      action:   'delete',   
      name: name
    })
  })
  .then(res => res.json())  
  .then(data => {            
   updateAfterDeleteRequest(data);
 
  });
}

function updateAfterDeleteRequest(data) {
    if(data.error!=='') {
      alert(data.error);
      return;
    }
    else {
      deleteModal.style.display = 'none';
      showNotification('Category deleted successfully').then(() => window.location.reload());
    }
  }


function updateAfterEditRequest(data) {
    if(data.error!=='') {
      alert(data.error);
      return;
    }
    else {
      editModal.style.display = 'none';
      showNotification('Category updated successfully').then(() => window.location.reload());
    }
  }

  function updateAfterCreateRequest(data) {
    if(data.error!=='') {
      alert(data.error);
      return;
    }
    else {
      newCategoryInput.value = '';
      showNotification('Category added successfully').then(() => window.location.reload());
    }
  }

  function addCategory() {
    const name = newCategoryInput.value.trim();
    
    if (name === '') {
      alert('Please Enter A Category Name');
      return;
    }

    else {
      sendCreateRequest(name.trim());
    }
    
    
  }


  function isEmpty(){
    const list = document.querySelectorAll('.category-item');
    return list.length === 0;
  }

  function initView() {
    
    if(!isEmpty()) {emptyState.style.display = 'none';}


    // Add event listeners to edit/delete buttons
    document.querySelectorAll('.btn-edit').forEach(btn => {
      btn.addEventListener('click', editCategory);
    });
    
    document.querySelectorAll('.btn-delete').forEach(btn => {
      btn.addEventListener('click',deleteCategory);
    });
  }

  function getCategoryName(e) {
    const clicked = e.target;
    let innerParent = clicked.parentElement;
    if (clicked.tagName.toLowerCase() === 'i') { 
      innerParent = innerParent.parentElement;
    }
    const outerParent = innerParent.parentElement;
    const divChild = outerParent.querySelector('.category-name');
    const textNode = divChild.firstElementChild.nextSibling;
    return textNode.textContent.trim();     
  }

  function editCategory(e) {
    current_editName = getCategoryName(e);     
    editModal.style.display = 'flex';
    editNameInput.value = current_editName;
  }

  function deleteCategory(e) {
    const name = getCategoryName(e);
    deleteNameSpan.innerHTML  = name;     
    deleteModal.style.display = 'flex';
  }

  function confirmDelete() {
    const name = deleteNameSpan.innerHTML; 
    sendDeleteRequest(name);

  }

  function confirmEdit() {
    const newName = editNameInput.value.trim(); 
    
    if (newName === '') {
      alert('Please Enter A Category Name');
      return;
    }

    else if(newName === current_editName ){
      alert('Please Enter An Updated Category Name');
      return;
    }

    else {
    sendEditRequest(newName);
    }
  }
  
  
  
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
  
  // Initial render
  initView();
  addCategoryBtn.addEventListener('click',addCategory);
  confirmDeleteBtn.addEventListener('click',confirmDelete);
  editBtn.addEventListener('click',confirmEdit);
  
  
  


</script>