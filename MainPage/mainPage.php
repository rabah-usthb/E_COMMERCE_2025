<?php
/*if(!isset($_SESSION['id'])) {
	header('Location: ../form/login.php');
}*/
// adminDashBoard.php
// Determine which section to display (default to dashboard)
$page = $_GET['page'] ?? 'main';
$allowed = ['main', 'basket', 'history','favourite'];
if (!in_array($page, $allowed, true)) {
    $page = 'main';
}

// Sample product data - in a real app, this would come from a database
$products = [
    [
        'id' => 1,
        'title' => 'Nike Air Max 270 React',
        'category' => 'Shoes',
        'price' => 99.99,
        'discount' => 20,
        'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
        'sold' => 125,
        'description' => 'The Nike Air Max 270 React combines two of Nike\'s biggest innovations...',
        'detailed_description' => '<p>The Nike Air Max 270 React combines the exaggerated tongue...</p>',
        'tags' => ['Running','Lifestyle','Breathable','Comfortable']
    ],
    // … other products …
];
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
            <a href="#" class="logo">
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
                <a href="login.php" title="Account"><i class='bx bx-user'></i></a>
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
                    // Default Dashboard content
            ?>
        <section class="container featured-products">
            <h2 class="section-title">Featured Products</h2>
            <div class="products-grid">
                <?php foreach ($products as $index => $product): ?>
                <div class="product-card" data-product-id="<?= $product['id'] ?>">
                    <div class="product-img">
                        <img src="<?= $product['image'] ?>" alt="<?= htmlspecialchars($product['title']) ?>">
                        <div class="product-actions">
                            <div class="action-btn favorite-btn"><i class='bx bx-heart'></i></div>
                            <!-- UPDATED: attach onclick directly for fullscreen -->
                            <div class="action-btn zoom-btn"
                                 data-product-id="<?= $product['id'] ?>"
                                 onclick="openProductModal(<?= $product['id'] ?>)">
                                <i class='bx bx-fullscreen'></i>
                            </div>
                        </div>
                        <?php if ($product['discount'] > 0): ?>
                        <div class="product-tag">-<?= $product['discount'] ?>%</div>
                        <?php elseif ($index === 2): ?>
                        <div class="product-tag">New</div>
                        <?php elseif ($index === 4): ?>
                        <div class="product-tag">Hot</div>
                        <?php endif; ?>
                    </div>
                    <div class="product-info">
                        <div class="product-cat"><?= htmlspecialchars($product['category']) ?></div>
                        <h3 class="product-title"><?= htmlspecialchars($product['title']) ?></h3>
                        <div class="product-price">
                            <div class="price">$<?= number_format($product['price'], 2) ?></div>
                            <div class="add-cart" data-product-id="<?= $product['id'] ?>"><i class='bx bx-cart-add'></i></div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php
            }
            ?>
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
                    <div class="product-detail-price" id="productDetailPrice"></div>
                    <div class="product-detail-sold" id="productDetailSold"></div>
                    <div class="product-detail-description" id="productDetailDescription"></div>
                    <div class="product-detail-tags" id="productDetailTags"></div>
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
            <div class="product-detail-tabs">
                <div class="product-tab active" data-tab="description">Detailed Description</div>
                <div class="product-tab" data-tab="specifications">Specifications</div>
                <div class="product-tab" data-tab="reviews">Reviews</div>
            </div>
            <div class="product-tab-content active" id="descriptionTab">
                <!-- Detailed description content will be loaded here -->
            </div>
            <div class="product-tab-content" id="specificationsTab">
                <p>Product specifications will be available soon.</p>
            </div>
            <div class="product-tab-content" id="reviewsTab">
                <p>No reviews yet.</p>
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
        const modal    = document.getElementById('productDetailModal');
        const closeBtn = modal.querySelector('.product-detail-close');
        const products = <?= json_encode($products) ?>;

        // Open modal function
        window.openProductModal = function(id) {
            const product = products.find(p => p.id == id);
            if (!product) return;

            modal.querySelector('#productDetailImage').src       = product.image;
            modal.querySelector('#productDetailCategory').textContent = product.category;
            modal.querySelector('#productDetailTitle').textContent    = product.title;
            modal.querySelector('#productDetailPrice').textContent    = '$' + product.price.toFixed(2);
            modal.querySelector('#productDetailSold').textContent     = product.sold + ' sold';
            modal.querySelector('#productDetailDescription').textContent = product.description;

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
        };

        // Close modal
        closeBtn.addEventListener('click', () => {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        });
        modal.addEventListener('click', e => {
            if (e.target === modal) {
                modal.classList.remove('active');
                document.body.style.overflow = '';
            }
        });

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
    </script>
</body>
</html>
