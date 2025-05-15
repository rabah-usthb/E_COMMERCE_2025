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
                <input type="text" placeholder="Search products...">
                <i class='bx bx-search'></i>
            </div>
            
            <div class="nav-links">
                <a href="#" title="Filter"><i class='bx bx-filter'></i></a>
                <a href="#" title="Wishlist"><i class='bx bx-heart'></i></a>
                <a href="basket.php" title="Cart">
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

    <!-- CATEGORIES SECTION -->
    <section class="container">
        <h2 class="section-title" style ="margin-top:30px;">Browse Categories</h2>
        <div class="categories">
            <div class="category">
                <div class="category-icon">
                    <i class='bx bx-laptop'></i>
                </div>
                <h3>Electronics</h3>
            </div>
            <div class="category">
                <div class="category-icon">
                    <i class='bx bx-closet'></i>
                </div>
                <h3>Fashion</h3>
            </div>
            <div class="category">
                <div class="category-icon">
                    <i class='bx bx-home'></i>
                </div>
                <h3>Home & Garden</h3>
            </div>
            <div class="category">
                <div class="category-icon">
                    <i class='bx bx-joystick'></i>
                </div>
                <h3>Toys & Games</h3>
            </div>
            <div class="category">
                <div class="category-icon">
                    <i class='bx bx-book'></i>
                </div>
                <h3>Books</h3>
            </div>
            <div class="category">
                <div class="category-icon">
                    <i class='bx bx-dumbbell'></i>
                </div>
                <h3>Sports</h3>
            </div>
            <div class="category">
                <div class="category-icon">
                    <i class='bx bx-diamond'></i>
                </div>
                <h3>Jewelry</h3>
            </div>
            <div class="category">
                <div class="category-icon">
                    <i class='bx bx-plus-medical'></i>
                </div>
                <h3>Health</h3>
            </div>
        </div>
    </section>

    <!-- FEATURED PRODUCTS -->
    <section class="container featured-products">
        <h2 class="section-title">Featured Products</h2>
        <div class="products-grid">
            <!-- Product 1 -->
            <div class="product-card">
                <div class="product-img">
                    <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Product">
                    <div class="product-actions">
                        <div class="action-btn"><i class='bx bx-heart'></i></div>
                        <div class="action-btn"><i class='bx bx-fullscreen'></i></div>
                    </div>
                    <div class="product-tag">-20%</div>
                </div>
                <div class="product-info">
                    <div class="product-cat">Shoes</div>
                    <h3 class="product-title">Nike Air Max 270 React</h3>
                    <div class="product-price">
                        <div class="price">$99.99</div>
                        <div class="add-cart"><i class='bx bx-cart-add'></i></div>
                    </div>
                </div>
            </div>
            
            <!-- Product 2 -->
            <div class="product-card">
                <div class="product-img">
                    <img src="https://images.unsplash.com/photo-1504274066651-8d31a536b11a?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Product">
                    <div class="product-actions">
                        <div class="action-btn"><i class='bx bx-heart'></i></div>
                        <div class="action-btn"><i class='bx bx-fullscreen'></i></div>
                    </div>
                </div>
                <div class="product-info">
                    <div class="product-cat">Electronics</div>
                    <h3 class="product-title">Apple iPhone 13 Pro Max</h3>
                    <div class="product-price">
                        <div class="price">$1,099.00</div>
                        <div class="add-cart"><i class='bx bx-cart-add'></i></div>
                    </div>
                </div>
            </div>
            
            <!-- Product 3 -->
            <div class="product-card">
                <div class="product-img">
                    <img src="https://images.unsplash.com/photo-1560343090-f0409e92791a?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Product">
                    <div class="product-actions">
                        <div class="action-btn"><i class='bx bx-heart'></i></div>
                        <div class="action-btn"><i class='bx bx-fullscreen'></i></div>
                    </div>
                    <div class="product-tag">New</div>
                </div>
                <div class="product-info">
                    <div class="product-cat">Fashion</div>
                    <h3 class="product-title">Casual Summer Dress</h3>
                    <div class="product-price">
                        <div class="price">$45.50</div>
                        <div class="add-cart"><i class='bx bx-cart-add'></i></div>
                    </div>
                </div>
            </div>
            
            <!-- Product 4 -->
            <div class="product-card">
                <div class="product-img">
                    <img src="https://images.unsplash.com/photo-1578874691223-64558a3ca096?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Product">
                    <div class="product-actions">
                        <div class="action-btn"><i class='bx bx-heart'></i></div>
                        <div class="action-btn"><i class='bx bx-fullscreen'></i></div>
                    </div>
                </div>
                <div class="product-info">
                    <div class="product-cat">Home</div>
                    <h3 class="product-title">Modern Coffee Table</h3>
                    <div class="product-price">
                        <div class="price">$199.99</div>
                        <div class="add-cart"><i class='bx bx-cart-add'></i></div>
                    </div>
                </div>
            </div>
            
            <!-- Product 5 -->
            <div class="product-card">
                <div class="product-img">
                    <img src="https://images.unsplash.com/photo-1572635196237-14b3f281503f?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Product">
                    <div class="product-actions">
                        <div class="action-btn"><i class='bx bx-heart'></i></div>
                        <div class="action-btn"><i class='bx bx-fullscreen'></i></div>
                    </div>
                    <div class="product-tag">Hot</div>
                </div>
                <div class="product-info">
                    <div class="product-cat">Accessories</div>
                    <h3 class="product-title">Rayban Sunglasses</h3>
                    <div class="product-price">
                        <div class="price">$129.00</div>
                        <div class="add-cart"><i class='bx bx-cart-add'></i></div>
                    </div>
                </div>
            </div>
            
            <!-- Product 6 -->
            <div class="product-card">
                <div class="product-img">
                    <img src="https://images.unsplash.com/photo-1585298723682-7115561c51b7?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Product">
                    <div class="product-actions">
                        <div class="action-btn"><i class='bx bx-heart'></i></div>
                        <div class="action-btn"><i class='bx bx-fullscreen'></i></div>
                    </div>
                </div>
                <div class="product-info">
                    <div class="product-cat">Electronics</div>
                    <h3 class="product-title">Smart Watch Series 5</h3>
                    <div class="product-price">
                        <div class="price">$349.99</div>
                        <div class="add-cart"><i class='bx bx-cart-add'></i></div>
                    </div>
                </div>
            </div>
            
            <!-- Product 7 -->
            <div class="product-card">
                <div class="product-img">
                    <img src="https://images.unsplash.com/photo-1600086827875-a63b01f1335c?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Product">
                    <div class="product-actions">
                        <div class="action-btn"><i class='bx bx-heart'></i></div>
                        <div class="action-btn"><i class='bx bx-fullscreen'></i></div>
                    </div>
                </div>
                <div class="product-info">
                    <div class="product-cat">Beauty</div>
                    <h3 class="product-title">Premium Skincare Set</h3>
                    <div class="product-price">
                        <div class="price">$89.99</div>
                        <div class="add-cart"><i class='bx bx-cart-add'></i></div>
                    </div>
                </div>
            </div>
            
            <!-- Product 8 -->
            <div class="product-card">
                <div class="product-img">
                    <img src="https://images.unsplash.com/photo-1611186871348-b1ce696e52c9?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Product">
                    <div class="product-actions">
                        <div class="action-btn"><i class='bx bx-heart'></i></div>
                        <div class="action-btn"><i class='bx bx-fullscreen'></i></div>
                    </div>
                    <div class="product-tag">-10%</div>
                </div>
                <div class="product-info">
                    <div class="product-cat">Kitchen</div>
                    <h3 class="product-title">Professional Knife Set</h3>
                    <div class="product-price">
                        <div class="price">$79.99</div>
                        <div class="add-cart"><i class='bx bx-cart-add'></i></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

   


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
                        <li><a href="#">Special Offers</a></li>
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
                    <h3>Contact Us</h3>
                    <ul>
                        <li><a href="#"><i class='bx bx-map'></i> 123 Main Street, City, Country</a></li>
                        <li><a href="#"><i class='bx bx-phone'></i> +1 234 567 890</a></li>
                        <li><a href="#"><i class='bx bx-envelope'></i> info@ecommerce2025.com</a></li>
                    </ul>
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
        // Mobile menu toggle
        const mobileToggle = document.querySelector('.mobile-toggle');
        const navLinks = document.querySelector('.nav-links');
        
        mobileToggle.addEventListener('click', () => {
            navLinks.classList.toggle('active');
            if (navLinks.classList.contains('active')) {
                mobileToggle.innerHTML = '<i class="bx bx-x"></i>';
            } else {
                mobileToggle.innerHTML = '<i class="bx bx-menu"></i>';
            }
        });
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!navLinks.contains(e.target) && !mobileToggle.contains(e.target) && navLinks.classList.contains('active')) {
                navLinks.classList.remove('active');
                mobileToggle.innerHTML = '<i class="bx bx-menu"></i>';
            }
        });
        
        // Product action buttons
        const actionBtns = document.querySelectorAll('.action-btn');
        actionBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                if (btn.querySelector('i').classList.contains('bx-heart')) {
                    btn.querySelector('i').classList.toggle('bxs-heart');
                    if (btn.querySelector('i').classList.contains('bxs-heart')) {
                        btn.querySelector('i').style.color = '#FC3B56';
                    } else {
                        btn.querySelector('i').style.color = '';
                    }
                }
            });
        });
        
        // Add to cart animation
        const addCartBtns = document.querySelectorAll('.add-cart');
        addCartBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                btn.classList.add('animate');
                setTimeout(() => {
                    btn.classList.remove('animate');
                    // Update cart count
                    const cartBadge = document.querySelector('.nav-links a[title="Cart"] .badge');
                    let count = parseInt(cartBadge.textContent);
                    cartBadge.textContent = count + 1;
                }, 300);
            });
        });
        
        // Newsletter form submission
        const newsletterForm = document.querySelector('.newsletter-form');
        newsletterForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const email = newsletterForm.querySelector('input').value;
            if (email) {
                alert('Thank you for subscribing to our newsletter!');
                newsletterForm.reset();
            } else {
                alert('Please enter a valid email address.');
            }
        });
    </script>