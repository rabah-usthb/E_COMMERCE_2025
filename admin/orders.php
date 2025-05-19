<div id="commands-section">
  <h1 class="title">Command Management</h1>
  <ul class="breadcrumbs">
    <li><a href="#">Home</a></li>
    <li class="divider">/</li>
    <li><a href="#" class="active">Commands</a></li>
  </ul>

  <div class="data">
    <div class="content-data">
      <div class="head">
        <h3>Command List</h3>
        <div class="filter-group">
          <select id="status-filter" class="status-filter">
            <option value="all">All Status</option>
            <option value="awaiting">Awaiting</option>
            <option value="shipped">Shipped</option>
            <option value="canceled">Canceled</option>
          </select>
        </div>
      </div>
      
      <!-- Commands Table -->
      <div class="table-responsive">
        <table class="commands-table">
          <thead>
            <tr>
              <th>Command ID</th>
              <th>Client</th>
              <th>Total</th>
              <th>Ordered At</th>
              <th>Ship Time</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody id="commands-list">
            <!-- Commands will be populated here -->
          </tbody>
        </table>
      </div>

      <div class="empty-state" id="empty-state" style="display: none;">
        <i class='bx bx-cart empty-icon'></i>
        <p>No commands found.</p>
      </div>

      <!-- Pagination -->
      <div class="pagination">
        <button class="pagination-button" id="prev-page" disabled><i class='bx bx-chevron-left'></i></button>
        <span id="page-info">Page 1 of 1</span>
        <button class="pagination-button" id="next-page" disabled><i class='bx bx-chevron-right'></i></button>
      </div>
    </div>
  </div>
</div>

<!-- Command Details Modal -->
<div class="command-modal" id="command-detail-modal">
  <div class="modal-content">
    <div class="modal-header">
      <h3>Command Details - #<span id="detail-command-id"></span></h3>
      <span class="modal-close">&times;</span>
    </div>
    <div class="modal-body">
      <div class="command-info">
        <div class="info-group">
          <div class="info-item">
            <span class="info-label">Client:</span>
            <span id="detail-client" class="info-value"></span>
          </div>
          <div class="info-item">
            <span class="info-label">Ordered At:</span>
            <span id="detail-ordered-at" class="info-value"></span>
          </div>
          <div class="info-item">
            <span class="info-label">Status:</span>
            <span id="detail-status" class="info-value"></span>
          </div>
          <div class="info-item">
            <span class="info-label">Ship Time:</span>
            <span id="detail-ship-time" class="info-value"></span>
          </div>
        </div>
      </div>

      <div class="command-items">
        <h4>Command Items</h4>
        <table class="items-table">
          <thead>
            <tr>
              <th>Product</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody id="command-items-list">
            <!-- Command items will be populated here -->
          </tbody>
          <tfoot>
            <tr>
              <td colspan="3" class="total-label">Total</td>
              <td id="detail-total" class="total-value"></td>
            </tr>
          </tfoot>
        </table>
      </div>

      <div class="command-actions" id="command-actions">
        <!-- Action buttons will be added here based on status -->
      </div>
    </div>
  </div>
</div>

<style>
/* Command Management Styles */
.filter-group {
  display: flex;
  gap: 10px;
}

.status-filter {
  padding: 8px 12px;
  border-radius: 5px;
  border: 1px solid var(--grey);
  font-size: 14px;
  outline: none;
  cursor: pointer;
}

.table-responsive {
  overflow-x: auto;
  margin-top: 20px;
}

.commands-table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
}

.commands-table th {
  background: var(--blue);
  color: var(--light);
  padding: 12px 15px;
  text-align: left;
  font-weight: 600;
  font-size: 14px;
}

.commands-table td {
  padding: 12px 15px;
  border-bottom: 1px solid var(--grey);
  font-size: 14px;
  background-color: var(--light);
}

.commands-table tr:hover td {
  background-color: rgba(22, 153, 176, 0.05);
}

.command-status {
  display: inline-block;
  padding: 4px 10px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 500;
}

.status-awaiting {
  background: #FFF4DE;
  color: #FFA800;
}

.status-shipped {
  background: var(--light-green);
  color: var(--green);
}

.status-canceled {
  background: #FFE2E5;
  color: var(--red);
}

.detail-btn {
  background: var(--blue);
  color: var(--light);
  padding: 4px 10px;
  border-radius: 5px;
  border: none;
  font-size: 12px;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 5px;
  transition: all 0.3s ease;
}

.detail-btn:hover {
  background: var(--dark-blue);
}

.empty-state {
  padding: 40px 20px;
  text-align: center;
  margin-top: 20px;
}

.empty-icon {
  font-size: 48px;
  color: var(--dark-grey);
  margin-bottom: 10px;
}

.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 20px;
  gap: 15px;
}

.pagination-button {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 32px;
  height: 32px;
  border: 1px solid var(--grey);
  border-radius: 5px;
  background: var(--light);
  cursor: pointer;
  transition: all 0.3s ease;
}

.pagination-button:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.pagination-button:not(:disabled):hover {
  background: var(--grey);
}

/* Modal Styles */
.command-modal {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 1000;
  justify-content: center;
  align-items: center;
}

.modal-content {
  background: var(--light);
  border-radius: 10px;
  width: 700px;
  max-width: 90%;
  max-height: 80vh;
  overflow-y: auto;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px 20px;
  border-bottom: 1px solid var(--grey);
  position: sticky;
  top: 0;
  background: var(--light);
  z-index: 1;
}

.modal-header h3 {
  font-size: 18px;
  font-weight: 600;
  margin: 0;
}

.modal-close {
  font-size: 24px;
  cursor: pointer;
  color: var(--dark-grey);
}

.modal-body {
  padding: 20px;
}

.command-info {
  margin-bottom: 20px;
}

.info-group {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 15px;
}

.info-item {
  margin-bottom: 10px;
}

.info-label {
  font-weight: 600;
  margin-right: 5px;
}

.command-items h4 {
  margin-bottom: 15px;
  font-size: 16px;
  font-weight: 600;
}

.items-table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
}

.items-table th {
  background: var(--grey);
  padding: 10px;
  text-align: left;
  font-weight: 600;
  font-size: 14px;
}

.items-table td {
  padding: 10px;
  border-bottom: 1px solid var(--grey);
  font-size: 14px;
}

.total-label {
  text-align: right;
  font-weight: 600;
}

.total-value {
  font-weight: 700;
  color: var(--blue);
}

.command-actions {
  display: flex;
  justify-content: flex-end;
  gap: 10px;
  margin-top: 20px;
}

.action-btn {
  padding: 8px 15px;
  border-radius: 5px;
  font-size: 14px;
  cursor: pointer;
  border: none;
  display: flex;
  align-items: center;
  gap: 5px;
  transition: all 0.3s ease;
}

.btn-ship {
  background: var(--blue);
  color: var(--light);
}

.btn-ship:hover {
  background: var(--dark-blue);
}

.btn-cancel {
  background: var(--red);
  color: var(--light);
}

.btn-cancel:hover {
  opacity: 0.9;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Sample commands data (in a real app, this would come from your database)
  const commands = [
    {
      id: 1001,
      client: "John Smith",
      total: 249.99,
      ordered_at: "2025-05-14T09:35:22",
      ship_time: "2025-05-16T12:00:00",
      status: "awaiting",
      items: [
        { product: "Premium Wireless Headphones", quantity: 1, price: 199.99 },
        { product: "USB-C Charging Cable", quantity: 2, price: 25.00 }
      ]
    },
    {
      id: 1002,
      client: "Sarah Johnson",
      total: 349.95,
      ordered_at: "2025-05-13T15:22:10",
      ship_time: "2025-05-14T14:30:00",
      status: "shipped",
      items: [
        { product: "Smart Fitness Tracker", quantity: 2, price: 89.95 },
        { product: "Wireless Earbuds", quantity: 1, price: 149.99 },
        { product: "Screen Protector", quantity: 2, price: 9.99 }
      ]
    },
    {
      id: 1003,
      client: "Michael Brown",
      total: 1299.00,
      ordered_at: "2025-05-12T11:45:37",
      ship_time: null,
      status: "canceled",
      canceled_time: "2025-05-12T14:20:11",
      items: [
        { product: "Professional DSLR Camera", quantity: 1, price: 1299.00 }
      ]
    },
    {
      id: 1004,
      client: "Emma Wilson",
      total: 499.97,
      ordered_at: "2025-05-11T16:05:42",
      ship_time: "2025-05-12T10:15:00",
      status: "shipped",
      items: [
        { product: "Smart Home Speaker", quantity: 1, price: 199.99 },
        { product: "Wireless Charging Pad", quantity: 2, price: 49.99 },
        { product: "Smart Light Bulbs", quantity: 4, price: 49.99 }
      ]
    },
    {
      id: 1005,
      client: "David Martinez",
      total: 149.97,
      ordered_at: "2025-05-10T09:18:55",
      ship_time: "2025-05-17T11:30:00",
      status: "awaiting",
      items: [
        { product: "Wireless Mouse", quantity: 1, price: 49.99 },
        { product: "Bluetooth Keyboard", quantity: 1, price: 99.98 }
      ]
    }
  ];
  
  // DOM elements
  const commandsList = document.getElementById('commands-list');
  const emptyState = document.getElementById('empty-state');
  const statusFilter = document.getElementById('status-filter');
  const prevPageBtn = document.getElementById('prev-page');
  const nextPageBtn = document.getElementById('next-page');
  const pageInfo = document.getElementById('page-info');
  const commandDetailModal = document.getElementById('command-detail-modal');
  
  // Pagination state
  let currentPage = 1;
  const itemsPerPage = 10;
  let filteredCommands = [...commands];
  
  // Format date
  function formatDate(dateString) {
    if (!dateString) return 'N/A';
    
    const date = new Date(dateString);
    return date.toLocaleString('en-US', {
      year: 'numeric',
      month: 'short',
      day: 'numeric',
      hour: '2-digit',
      minute: '2-digit'
    });
  }
  
  // Capitalize first letter
  function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
  }
  
  // Render commands
  function renderCommands() {
    // Apply filters
    const selectedStatus = statusFilter.value;
    if (selectedStatus && selectedStatus !== 'all') {
      filteredCommands = commands.filter(cmd => cmd.status === selectedStatus);
    } else {
      filteredCommands = [...commands];
    }
    
    // Calculate pagination
    const totalPages = Math.ceil(filteredCommands.length / itemsPerPage);
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = Math.min(startIndex + itemsPerPage, filteredCommands.length);
    const currentCommands = filteredCommands.slice(startIndex, endIndex);
    
    // Update pagination controls
    pageInfo.textContent = `Page ${currentPage} of ${totalPages || 1}`;
    prevPageBtn.disabled = currentPage <= 1;
    nextPageBtn.disabled = currentPage >= totalPages;
    
    // Show empty state if no commands
    if (filteredCommands.length === 0) {
      commandsList.innerHTML = '';
      emptyState.style.display = 'block';
      return;
    }
    
    // Hide empty state
    emptyState.style.display = 'none';
    
    // Render commands
    commandsList.innerHTML = '';
    
    currentCommands.forEach(command => {
      const row = document.createElement('tr');
      
      // Create status badge
      const statusClass = `status-${command.status}`;
      
      row.innerHTML = `
        <td>#${command.id}</td>
        <td>${command.client}</td>
        <td>$${command.total.toFixed(2)}</td>
        <td>${formatDate(command.ordered_at)}</td>
        <td>${formatDate(command.ship_time)}</td>
        <td><span class="command-status ${statusClass}">${capitalizeFirstLetter(command.status)}</span></td>
        <td>
          <button class="detail-btn" data-id="${command.id}">
            <i class='bx bx-detail'></i> View Details
          </button>
        </td>
      `;
      
      commandsList.appendChild(row);
    });
    
    // Add event listeners to detail buttons
    document.querySelectorAll('.detail-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        const commandId = parseInt(this.getAttribute('data-id'));
        openCommandDetails(commandId);
      });
    });
  }
  
  // Open command details modal
  function openCommandDetails(commandId) {
    const command = commands.find(cmd => cmd.id === commandId);
    if (!command) return;
    
    // Set basic command details
    document.getElementById('detail-command-id').textContent = command.id;
    document.getElementById('detail-client').textContent = command.client;
    document.getElementById('detail-ordered-at').textContent = formatDate(command.ordered_at);
    document.getElementById('detail-ship-time').textContent = formatDate(command.ship_time);
    
    // Set status with appropriate class
    const statusElement = document.getElementById('detail-status');
    statusElement.textContent = capitalizeFirstLetter(command.status);
    statusElement.className = 'command-status ' + 'status-' + command.status;
    
    // Set total
    document.getElementById('detail-total').textContent = `$${command.total.toFixed(2)}`;
    
    // Render command items
    const itemsList = document.getElementById('command-items-list');
    itemsList.innerHTML = '';
    
    command.items.forEach(item => {
      const itemRow = document.createElement('tr');
      const itemTotal = item.price * item.quantity;
      
      itemRow.innerHTML = `
        <td>${item.product}</td>
        <td>${item.quantity}</td>
        <td>$${item.price.toFixed(2)}</td>
        <td>$${itemTotal.toFixed(2)}</td>
      `;
      
      itemsList.appendChild(itemRow);
    });
    
    // Add action buttons based on status
    const actionsContainer = document.getElementById('command-actions');
    actionsContainer.innerHTML = '';
    
    if (command.status === 'awaiting') {
      // For awaiting commands, add ship and cancel buttons
      const shipBtn = document.createElement('button');
      shipBtn.className = 'action-btn btn-ship';
      shipBtn.innerHTML = '<i class="bx bx-package"></i> Mark as Shipped';
      shipBtn.onclick = () => markAsShipped(command.id);
      
      const cancelBtn = document.createElement('button');
      cancelBtn.className = 'action-btn btn-cancel';
      cancelBtn.innerHTML = '<i class="bx bx-x"></i> Cancel Command';
      cancelBtn.onclick = () => cancelCommand(command.id);
      
      actionsContainer.appendChild(shipBtn);
      actionsContainer.appendChild(cancelBtn);
    }
    
    // Show modal
    commandDetailModal.style.display = 'flex';
  }
  
  // Mark command as shipped
  function markAsShipped(commandId) {
    const commandIndex = commands.findIndex(cmd => cmd.id === commandId);
    if (commandIndex === -1) return;
    
    // Update command status
    commands[commandIndex].status = 'shipped';
    commands[commandIndex].ship_time = new Date().toISOString();
    
    // Close modal
    commandDetailModal.style.display = 'none';
    
    // Re-render commands
    renderCommands();
    
    // Show confirmation message
    alert(`Command #${commandId} marked as shipped.`);
  }
  
  // Cancel command
  function cancelCommand(commandId) {
    const commandIndex = commands.findIndex(cmd => cmd.id === commandId);
    if (commandIndex === -1) return;
    
    // Update command status
    commands[commandIndex].status = 'canceled';
    commands[commandIndex].canceled_time = new Date().toISOString();
    commands[commandIndex].ship_time = null;
    
    // Close modal
    commandDetailModal.style.display = 'none';
    
    // Re-render commands
    renderCommands();
    
    // Show confirmation message
    alert(`Command #${commandId} has been canceled.`);
  }
  
  // Event listeners
  
  // Status filter
  statusFilter.addEventListener('change', function() {
    currentPage = 1; // Reset to first page when filter changes
    renderCommands();
  });
  
  // Pagination
  prevPageBtn.addEventListener('click', function() {
    if (currentPage > 1) {
      currentPage--;
      renderCommands();
    }
  });
  
  nextPageBtn.addEventListener('click', function() {
    const totalPages = Math.ceil(filteredCommands.length / itemsPerPage);
    if (currentPage < totalPages) {
      currentPage++;
      renderCommands();
    }
  });
  
  // Close modal
  document.querySelector('.modal-close').addEventListener('click', function() {
    commandDetailModal.style.display = 'none';
  });
  
  // Close modal when clicking outside
  window.addEventListener('click', function(event) {
    if (event.target === commandDetailModal) {
      commandDetailModal.style.display = 'none';
    }
  });
  
  // Initial render
  renderCommands();
});
</script>