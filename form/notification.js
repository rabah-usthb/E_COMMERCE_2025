 export function showNotification(className,message) {
    // Check if notification container exists
    let notifContainer = document.querySelector('.notification-container');
    
    if (!notifContainer) {
      notifContainer = document.createElement('div');
      notifContainer.className = 'notification-container';
      document.body.appendChild(notifContainer);
    }
    
    // Create notification
    const notification = document.createElement('div');
    notification.className = className;
    
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