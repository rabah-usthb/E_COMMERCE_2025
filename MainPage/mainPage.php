<?php

require_once 'main.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['id'])) {
	header('Location: ../form/login.php');
}
$products = getAllProducts();
$json = json_encode($products, JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP | JSON_INVALID_UTF8_IGNORE | JSON_PARTIAL_OUTPUT_ON_ERROR );
if ($json === false) {
    die('JSON encode error: ' . json_last_error_msg());
}
$page = $_GET['page'] ?? 'main';
$allowed = ['main', 'basket', 'history','favourite'];
if (!in_array($page, $allowed, true)) {
    $page = 'main';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce 2025</title>
    <!-- BOXICONS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="mainPage.css" />
</head>
<body>
    <!-- HEADER -->
    <header>
        <div class="container header-container">
            <a href="?page=main" class="logo"> 
                <i class='bx bxs-shopping-bags'></i>
                <span>E-Commerce 2025</span>
            </a>
            <div class="search-bar">
                <input type="text" placeholder="Search products.">
                <i class='bx bx-search'></i>
            </div>
            <div class="nav-links">
                <a href="#" title="Filter"><i class='bx bx-filter'></i></a>
                <a href="#" title="Wishlist"><i class='bx bx-heart'></i></a>
                <a href="?page=basket" class="<?= $page==='basket'?'active':'' ?>"> 
                    <i class='bx bx-cart'></i>
                    <span class="badge">3</span>
                </a>
                <a href="../admin/logOut.php"> <i class='bx bxs-log-out-circle icon'></i></a>
            </div>
            <div class="mobile-toggle">
                <i class='bx bx-menu'></i>
            </div>
        </div>
    </header>

    <!-- FEATURED PRODUCTS -->
    <main id="main-content">
    <?php
            switch ($page) {
                case 'basket':
                    include 'basket.php';
                    break;

                case 'appendClient':
                    include 'appendClient.php';
                    break;

                case 'client' :
                    include 'client.php';
                    break;
                
                case 'categories' :
                    include 'categories.php';
                    break;

                case 'products' :
                    include 'productList.php';
                    break;
                
                case 'orders' :
                    include 'orders.php';
                    break;

                default:
                printAllProducts($products);
                }
            ?>
        
        <
    </main>

    <!-- PRODUCT DETAIL MODAL -->
    <div id="productDetailModal" class="product-detail-modal">
        <div class="product-detail-container">
        <div class="product-detail-close"><i class='bx bx-x'></i></div>

        <div class="product-detail-content">
            <div class="product-detail-gallery">
            <div class="product-detail-img">
                <img id="productDetailImage" src="" alt="Product">
            </div>
        </div>
        <div class="product-detail-info">
        <div class="product-detail-category" id="productDetailCategory"></div>
        <h1 class="product-detail-title" id="productDetailTitle"></h1>

        <!-- price + sold info -->
        <div class="product-detail-price">
          <span  id="productDetailPrice"></span>
          <span id="productDetailSold" style="margin-left:8px;"></span>
          <span id="productDetailAfterSold" style="margin-left:8px;"></span>
        </div>

        <div class="product-detail-qtn" id="productDetailQtn"></div>
        <div class="product-detail-description" id="productDetailDescription"></div>
        <div class="product-detail-tags" id="productDetailTags"></div>
        <div class="product-brief-description" id="productBriefDescription"></div>

        <div class="product-detail-actions">
          <button class="detail-btn add-to-cart-btn" id="productDetailAddToCart">
            <i class='bx bx-cart-add'></i> Add to Cart
          </button>
          <button class="detail-btn add-to-fav-btn" id="productDetailAddToFav">
            <i class='bx bx-heart'></i>
          </button>
        </div>
      </div>
    </div>

    <!-- title before detailed description -->
    <h2 style="font-size:16px; margin:12px 10px 6px;">Detailed Description</h2>
    <div class="product-tab-content active" id="descriptionTab">
      <!-- Detailed description content will be loaded here -->
    </div>

  </div>
</div>



    <!-- FOOTER -->
    <footer>
        <div class="container">
            <div class="footer-container">
                <div class="footer-col">
                    <h3>Shop</h3>
                    <ul>
                        <li><a href="#">New Arrivals</a></li>
                        <li><a href="#">Best Sellers</a></li>
                        <li><a href="#">Featured Products</a></li>
                        <li><a href="#">All Collections</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h3>Information</h3>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Shipping & Returns</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h3>Customer Service</h3>
                    <ul>
                        <li><a href="#">My Account</a></li>
                        <li><a href="#">Order Tracking</a></li>
                        <li><a href="#">Wishlist</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Help Desk</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h3>Follow Us</h3>
                    <div class="social-links">
                        <a href="#"><i class='bx bxl-facebook'></i></a>
                        <a href="#"><i class='bx bxl-twitter'></i></a>
                        <a href="#"><i class='bx bxl-instagram'></i></a>
                        <a href="#"><i class='bx bxl-pinterest'></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 E-Commerce. All rights reserved. Designed with <i class='bx bxs-heart'></i></p>
            </div>
        </div>
    </footer>

    <!-- JAVASCRIPT -->
    <script>


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
      }, 80);
    }, 500);
}


      const modal    = document.getElementById('productDetailModal');          
      const products = <?= $json ?>;


      function  updateAfterAddCartRequest(data) {
    if(data.error!=='') {
      alert(data.error);
      return;
    }
    else {
      showNotification('Product Added To Basket Successfully');
    }
  }



  function sendAddCartRequest(name) {
      
      const formData = new FormData();
      formData.append('action',   'addCart');
      formData.append('name', name);


      fetch('checkMain.php', {
        method: 'POST',
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        updateAfterAddCartRequest(data);
      });
}

     function initView() {

        document.querySelectorAll('.add-cart').forEach(btn => {
          btn.addEventListener('click', function() {
             const name =this.getAttribute('data-product');
             sendAddCartRequest(name);
          });
        });

        document.querySelectorAll('.zoom-btn').forEach(btn => {
          btn.addEventListener('click', function() {
             const name =this.getAttribute('data-product');
             showProduct(name);
          });
        });

        document.querySelectorAll('.product-detail-close').forEach(btn => {
          btn.addEventListener('click', function() {
            modal.classList.remove('active');
            document.body.style.overflow = '';
          });
        });

     }

     function showProduct(name) {
            const product = findProduct(name);
            if (!product) return;

            console.log(modal);
            document.getElementById('productDetailImage').src       = product.image_data;
            document.getElementById('productBriefDescription').textContent = product.brief_description;
            document.getElementById('productDetailCategory').textContent = product.category;
            document.getElementById('productDetailTitle').textContent    = product.title;
            
            const priceEl = document.getElementById('productDetailPrice');
            document.getElementById('productDetailPrice').textContent    = '$' + product.price.toFixed(2);
            document.getElementById('productDetailQtn').textContent     ='Available '+ product.quantity;
            document.getElementById('descriptionTab').textContent = product.detailed_description;
            document.getElementById('productDetailSold').style.visibility     = 'hidden';
            document.getElementById('productDetailAfterSold').style.visibility   = 'hidden';

            priceEl.style.textDecoration  = 'none';

            if(product.sold > 0){
                document.getElementById('productDetailSold').style.visibility = 'visible';
                document.getElementById('productDetailAfterSold').style.visibility = 'visible';
              priceEl.style.textDecoration  = 'line-through';
             document.getElementById('productDetailSold').textContent  = '%' + product.sold.toFixed(2) + " off";
             const soldValue = product.price * product.sold /100;
             const priceAfterSold = product.price - soldValue;
             document.getElementById('productDetailAfterSold').textContent    = '$' +  priceAfterSold.toFixed(2);
            }
            // Tags
            const tagsContainer = modal.querySelector('#productDetailTags');
            tagsContainer.innerHTML = '';
            (product.tags || []).forEach(tag => {
                const span = document.createElement('span');
                span.className = 'product-tag-item';
                span.textContent = tag;
                tagsContainer.appendChild(span);
            });

            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
     }

     function findProduct(name) {
        return products.find(p => p.product_name=== name) || null;
     }

     document.addEventListener('DOMContentLoaded', function() {
        // Mobile menu toggle
        const mobileToggle = document.querySelector('.mobile-toggle');
        const navLinks = document.querySelector('.nav-links');
        if (mobileToggle) {
            mobileToggle.addEventListener('click', () => {
                navLinks.classList.toggle('active');
                mobileToggle.innerHTML = navLinks.classList.contains('active')
                  ? '<i class="bx bx-x"></i>'
                  : '<i class="bx bx-menu"></i>';
            });
        }

        // Grab modal elements
    
      /*  modal.addEventListener('click', e => {
            if (e.target === modal) {
                modal.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
        */

        // Add to Cart inside modal
        const detailAddCartBtn = document.getElementById('productDetailAddToCart');
        detailAddCartBtn.addEventListener('click', () => {
            detailAddCartBtn.innerHTML = '<i class="bx bx-check"></i> Added';
            setTimeout(() => {
                detailAddCartBtn.innerHTML = '<i class="bx bx-cart-add"></i> Add to Cart';
            }, 2000);
        });

        // Tabs (Description/Specs/Reviews)
        const tabs     = document.querySelectorAll('.product-tab');
        const panels   = document.querySelectorAll('.product-tab-content');
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => t.classList.remove('active'));
                panels.forEach(p => p.classList.remove('active'));
                tab.classList.add('active');
                document.getElementById(tab.dataset.tab + 'Tab').classList.add('active');
            });
        });
    });
    initView();
    </script>
</body>
</html>
