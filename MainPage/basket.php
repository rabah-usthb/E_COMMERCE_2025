<?php
// Sample data to simulate products from your database
$sampleProducts = [
    [
        'id' => 1,
        'product_name' => 'Nike Air Max 270 React',
        'price' => 199.99,
        'sold' => 20, // Percentage discount
        'quantity' => 15, // Available stock
        'max' => 30,
        'brief_description' => 'Comfortable athletic shoes with React cushioning technology',
        'detailed_description' => 'The Nike Air Max 270 React combines two innovative technologies for incredible comfort. The upper features Nike React technology for lightweight, durable, and responsive cushioning. The Max Air 270 unit in the heel delivers all-day comfort. Perfect for both athletic performance and casual wear.',
        'image_data' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff', // Sample image URL
        'image_name' => 'nike_air_max.jpg'
    ],
    [
        'id' => 2,
        'product_name' => 'Rayban Sunglasses Classic',
        'price' => 129.99,
        'sold' => 10,
        'quantity' => 8,
        'max' => 20,
        'brief_description' => 'Premium UV protection with classic style',
        'detailed_description' => 'Rayban Classic sunglasses combine timeless style with premium UV protection. These iconic frames feature polarized lenses that block 100% of harmful UV rays, reducing glare and increasing visual clarity. The high-quality frame ensures durability for years of use.',
        'image_data' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f',
        'image_name' => 'rayban_sunglasses.jpg'
    ],
    [
        'id' => 3,
        'product_name' => 'Sony WH-1000XM4 Headphones',
        'price' => 349.99,
        'sold' => 15,
        'quantity' => 5,
        'max' => 25,
        'brief_description' => 'Industry-leading noise cancellation headphones',
        'detailed_description' => 'Sony WH-1000XM4 wireless headphones deliver premium sound quality with industry-leading noise cancellation. Enjoy up to 30 hours of battery life, touch controls, and speak-to-chat technology that automatically pauses playback when you start a conversation.',
        'image_data' => 'https://images.unsplash.com/photo-1618366712010-f4ae9c647dcb',
        'image_name' => 'sony_headphones.jpg'
    ],
    [
        'id' => 4,
        'product_name' => 'Apple Watch Series 7',
        'price' => 399.99,
        'sold' => 5,
        'quantity' => 12,
        'max' => 40,
        'brief_description' => 'Advanced smartwatch with health monitoring',
        'detailed_description' => 'The Apple Watch Series 7 features the largest, most advanced display yet, with a refined design and faster charging. Track your daily activity, heart rate, and blood oxygen. Get notifications and access to thousands of apps. Water resistant up to 50 meters.',
        'image_data' => 'https://images.unsplash.com/photo-1600086427699-bfffb9550cc0',
        'image_name' => 'apple_watch.jpg'
    ]
];

// Simulate cart with some of these products
$cartItems = [
    [
        'product_id' => 1,
        'quantity' => 1,
        'selected' => true
    ],
    [
        'product_id' => 3,
        'quantity' => 1,
        'selected' => true
    ],
    [
        'product_id' => 4,
        'quantity' => 2,
        'selected' => true
    ]
];

// Function to get product details by ID
function getProductById($products, $id) {
    foreach ($products as $product) {
        if ($product['id'] == $id) {
            return $product;
        }
    }
    return null;
}

// Function to calculate discounted price
function getDiscountedPrice($price, $soldPercent) {
    return $price - ($price * $soldPercent / 100);
}

// Calculate cart totals
$subtotal = 0;
foreach ($cartItems as $item) {
    if ($item['selected']) {
        $product = getProductById($sampleProducts, $item['product_id']);
        if ($product) {
            $discountedPrice = getDiscountedPrice($product['price'], $product['sold']);
            $subtotal += $discountedPrice * $item['quantity'];
        }
    }
}
$shipping = 15.00;
$total = $subtotal + $shipping;
?>

<div class="cart-container">
    <div class="cart-main">
        <h2 class="section-title">Shopping Cart</h2>
        
        <?php if (empty($cartItems)): ?>
            <div class="empty-cart">
                <i class='bx bx-cart'></i>
                <p>Your cart is empty</p>
                <a href="?page=main" class="btn">Continue Shopping</a>
            </div>
        <?php else: ?>
            <!-- Cart items -->
            <div class="cart-items">
                <?php foreach ($cartItems as $index => $item): 
                    $product = getProductById($sampleProducts, $item['product_id']);
                    if ($product):
                        $discountedPrice = getDiscountedPrice($product['price'], $product['sold']);
                        $itemTotal = $discountedPrice * $item['quantity'];
                ?>
                <div class="cart-item">
                    <div class="cart-item-select">
                        <input type="checkbox" class="item-checkbox" data-index="<?php echo $index; ?>" <?php echo $item['selected'] ? 'checked' : ''; ?>>
                    </div>
                    
                    <div class="cart-item-image">
                        <img src="<?php echo $product['image_data']; ?>" alt="<?php echo $product['product_name']; ?>">
                    </div>
                    
                    <div class="cart-item-details">
                        <div class="item-header">
                            <h3 class="item-name"><?php echo $product['product_name']; ?></h3>
                            <div class="item-actions">
                                <button class="heart-btn <?php echo isset($item['favorite']) && $item['favorite'] ? 'active' : ''; ?>" data-index="<?php echo $index; ?>">
                                    <i class='bx <?php echo isset($item['favorite']) && $item['favorite'] ? 'bxs-heart' : 'bx-heart'; ?>'></i>
                                </button>
                                <button class="remove-btn" data-index="<?php echo $index; ?>">
                                    <i class='bx bx-trash'></i>
                                </button>
                            </div>
                        </div>
                        
                        <p class="item-brief"><?php echo $product['brief_description']; ?></p>
                        <a href="#" class="view-details" data-product-id="<?php echo $product['id']; ?>">View Details</a>
                        
                        <div class="item-bottom">
                            <div class="item-price">
                                <?php if ($product['sold'] > 0): ?>
                                <div class="discount-tag">-<?php echo $product['sold']; ?>%</div>
                                <div class="original-price">$<?php echo number_format($product['price'], 2); ?></div>
                                <?php endif; ?>
                                <div class="current-price">$<?php echo number_format($discountedPrice, 2); ?></div>
                            </div>
                            
                            <div class="item-quantity">
                                <button class="quantity-btn minus-btn" data-index="<?php echo $index; ?>">−</button>
                                <input type="text" value="<?php echo $item['quantity']; ?>" data-max="<?php echo $product['quantity']; ?>" readonly>
                                <button class="quantity-btn plus-btn" data-index="<?php echo $index; ?>">+</button>
                            </div>
                            
                            <div class="item-total">
                                $<?php echo number_format($itemTotal, 2); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    
    <!-- Order summary sidebar -->
    <div class="cart-sidebar">
        <div class="cart-summary">
            <h3>Order Summary</h3>
            
            <div class="summary-row">
                <span>Subtotal:</span>
                <span id="cart-subtotal">$<?php echo number_format($subtotal, 2); ?></span>
            </div>
            
            <div class="summary-row">
                <span>Shipping:</span>
                <span id="cart-shipping">$<?php echo number_format($shipping, 2); ?></span>
            </div>
            
            <div class="summary-divider"></div>
            
            <div class="summary-row total">
                <span>Total:</span>
                <span id="cart-total">$<?php echo number_format($total, 2); ?></span>
            </div>
            
            <button class="checkout-btn">Proceed to Checkout</button>
            <a href="?page=main" class="continue-shopping">Continue Shopping</a>
        </div>
    </div>
</div>

<!-- Product Details Modal -->
<div id="product-details-modal" class="modal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <div class="product-details-container">
            <div class="product-image">
                <img id="modal-product-image" src="" alt="Product">
            </div>
            <div class="product-details">
                <h2 id="modal-product-name"></h2>
                
                <div class="product-pricing">
                    <div class="pricing-row">
                        <span id="modal-original-price" class="original-price"></span>
                        <span id="modal-discount-price" class="current-price"></span>
                        <span id="modal-discount-percent" class="discount-tag"></span>
                    </div>
                    <div class="availability">
                        Availability: <span id="modal-product-stock"></span>
                    </div>
                </div>
                
                <p id="modal-product-brief" class="product-brief"></p>
                
                <div class="product-description">
                    <h3>Description</h3>
                    <p id="modal-product-description"></p>
                </div>
                
                <div class="product-actions">
                    <div class="quantity-control">
                        <button class="quantity-btn modal-minus-btn">−</button>
                        <input type="text" id="modal-quantity" value="1" readonly>
                        <button class="quantity-btn modal-plus-btn">+</button>
                    </div>
                    <button id="modal-add-to-cart" class="add-to-cart-btn">Add to Cart</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --grey: #F1F0F6;
    --dark-grey: #8D8D8D;
    --light: #fff;
    --dark: #000;
    --green: #81D43A;
    --light-green: #E3FFCB;
    --blue: #1699b0;
    --light-blue: #D0E4FF;
    --dark-blue: #0C5FCD;
    --red: #FC3B56;
    --transition-3s: 0.3s;
}

/* Cart layout */
.cart-container {
    display: flex;
    gap: 20px;
    padding: 0 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.cart-main {
    flex: 1;
    min-width: 0;
}

.cart-sidebar {
    width: 350px;
    flex-shrink: 0;
}

/* Section header */
.section-title {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 20px;
    padding-bottom: 10px;
    position: relative;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 60px;
    height: 3px;
    background: var(--blue);
}

/* Cart items styling */
.cart-items {
    margin-bottom: 30px;
}

.cart-item {
    display: flex;
    padding: 20px;
    background: var(--light);
    border-radius: 10px;
    margin-bottom: 15px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.cart-item-select {
    display: flex;
    align-items: center;
    margin-right: 15px;
}

.cart-item-select input[type="checkbox"] {
    width: 20px;
    height: 20px;
    cursor: pointer;
    accent-color: var(--blue);
}

.cart-item-image {
    width: 120px;
    height: 120px;
    border-radius: 8px;
    overflow: hidden;
    margin-right: 20px;
    flex-shrink: 0;
}

.cart-item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.cart-item-details {
    flex: 1;
    min-width: 0;
}

.item-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}

.item-name {
    font-size: 18px;
    font-weight: 600;
    margin: 0;
}

.item-actions {
    display: flex;
    gap: 10px;
}

.heart-btn, .remove-btn {
    background: transparent;
    border: none;
    cursor: pointer;
    font-size: 20px;
    color: var(--dark-grey);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
}

.heart-btn:hover, .remove-btn:hover {
    transform: scale(1.1);
}

.heart-btn.active, .heart-btn.active i {
    color: var(--red);
}

.remove-btn:hover {
    color: var(--red);
}

.item-brief {
    color: var(--dark-grey);
    margin: 5px 0 10px;
    font-size: 14px;
}

.view-details {
    color: var(--blue);
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
}

.view-details:hover {
    text-decoration: underline;
}

.item-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 15px;
}

.item-price {
    display: flex;
    flex-direction: column;
    position: relative;
}

.original-price {
    text-decoration: line-through;
    color: var(--dark-grey);
    font-size: 14px;
}

.current-price {
    font-weight: 600;
    font-size: 18px;
    color: var(--dark);
}

.discount-tag {
    position: absolute;
    top: -15px;
    left: 0;
    background: var(--red);
    color: var(--light);
    padding: 2px 6px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 600;
}

.item-quantity {
    display: flex;
    align-items: center;
    border: 1px solid var(--grey);
    border-radius: 4px;
    overflow: hidden;
}

.quantity-btn {
    width: 36px;
    height: 36px;
    background: var(--grey);
    border: none;
    font-size: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.2s;
}

.quantity-btn:hover {
    background: var(--blue);
    color: var(--light);
}

.item-quantity input {
    width: 40px;
    text-align: center;
    border: none;
    font-size: 16px;
    font-weight: 500;
    background: transparent;
}

.item-total {
    font-weight: 700;
    font-size: 18px;
    min-width: 80px;
    text-align: right;
}

/* Empty cart */
.empty-cart {
    text-align: center;
    padding: 60px 20px;
    background: var(--light);
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.empty-cart i {
    font-size: 48px;
    color: var(--dark-grey);
    margin-bottom: 15px;
}

.empty-cart p {
    font-size: 18px;
    color: var(--dark-grey);
    margin-bottom: 20px;
}

.btn {
    display: inline-block;
    padding: 12px 24px;
    background: var(--blue);
    color: var(--light);
    border-radius: 5px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn:hover {
    background: var(--dark-blue);
}

/* Cart summary */
.cart-summary {
    background: var(--light);
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    position: sticky;
    top: 20px;
}

.cart-summary h3 {
    font-size: 18px;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--grey);
}

.summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 12px;
    font-size: 16px;
}

.summary-divider {
    height: 1px;
    background: var(--grey);
    margin: 15px 0;
}

.summary-row.total {
    font-weight: 700;
    font-size: 18px;
}

.checkout-btn {
    width: 100%;
    padding: 14px;
    background: var(--blue);
    color: var(--light);
    border: none;
    border-radius: 5px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    margin-top: 20px;
    transition: background 0.3s;
}

.checkout-btn:hover {
    background: var(--dark-blue);
}

.continue-shopping {
    display: block;
    text-align: center;
    margin-top: 15px;
    color: var(--dark-grey);
    text-decoration: none;
}

.continue-shopping:hover {
    color: var(--blue);
}

/* Modal styling */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    overflow: auto;
}

.modal-content {
    background: var(--light);
    margin: 5% auto;
    width: 90%;
    max-width: 1000px;
    border-radius: 10px;
    position: relative;
    overflow: hidden;
}

.close-modal {
    position: absolute;
    top: 20px;
    right: 20px;
    font-size: 24px;
    color: var(--dark-grey);
    cursor: pointer;
    z-index: 10;
}

.product-details-container {
    display: flex;
    padding: 0;
}

.product-image {
    width: 50%;
    overflow: hidden;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.product-details {
    width: 50%;
    padding: 40px;
}

.product-details h2 {
    font-size: 28px;
    margin-bottom: 20px;
}

.product-pricing {
    margin-bottom: 20px;
}

.pricing-row {
    display: flex;
    align-items: center;
    gap: 15px;
    position: relative;
}

.availability {
    margin-top: 10px;
    color: var(--dark-grey);
}

.product-brief {
    font-size: 16px;
    color: var(--dark-grey);
    margin-bottom: 20px;
}

.product-description h3 {
    font-size: 18px;
    margin-bottom: 10px;
}

.product-description p {
    line-height: 1.6;
    color: var(--dark);
}

.product-actions {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-top: 30px;
}

.quantity-control {
    display: flex;
    align-items: center;
    border: 1px solid var(--grey);
    border-radius: 4px;
    overflow: hidden;
}

.add-to-cart-btn {
    padding: 12px 24px;
    background: var(--blue);
    color: var(--light);
    border: none;
    border-radius: 5px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s;
}

.add-to-cart-btn:hover {
    background: var(--dark-blue);
}

/* Responsive styles */
@media (max-width: 992px) {
    .cart-container {
        flex-direction: column;
    }
    
    .cart-sidebar {
        width: 100%;
    }
    
    .product-details-container {
        flex-direction: column;
    }
    
    .product-image, .product-details {
        width: 100%;
    }
    
    .product-image {
        height: 300px;
    }
}

@media (max-width: 768px) {
    .cart-item {
        flex-direction: column;
    }
    
    .cart-item-select {
        align-self: flex-start;
        margin-bottom: 10px;
    }
    
    .cart-item-image {
        width: 100%;
        height: 200px;
        margin-right: 0;
        margin-bottom: 15px;
    }
    
    .item-bottom {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }
    
    .item-price, .item-quantity, .item-total {
        width: 100%;
    }
    
    .item-total {
        text-align: left;
    }
}
</style>

<script>
// Sample data structure for JavaScript
const sampleProducts = <?php echo json_encode($sampleProducts); ?>;
let cartItems = <?php echo json_encode($cartItems); ?>;

// DOM elements
const modal = document.getElementById("product-details-modal");
const closeModal = document.querySelector(".close-modal");
const viewDetailsBtns = document.querySelectorAll(".view-details");
const minusBtns = document.querySelectorAll(".minus-btn");
const plusBtns = document.querySelectorAll(".plus-btn");
const removeBtns = document.querySelectorAll(".remove-btn");
const heartBtns = document.querySelectorAll(".heart-btn");
const checkboxes = document.querySelectorAll(".item-checkbox");
const modalMinusBtn = document.querySelector(".modal-minus-btn");
const modalPlusBtn = document.querySelector(".modal-plus-btn");
const modalAddToCartBtn = document.getElementById("modal-add-to-cart");

// Helper function to find product by ID
function getProductById(id) {
    return sampleProducts.find(product => product.id == id);
}

// Calculate discounted price
function getDiscountedPrice(price, discount) {
    return price - (price * discount / 100);
}

// Update cart totals
function updateCartTotals() {
    let subtotal = 0;
    cartItems.forEach(item => {
        if (item.selected) {
            const product = getProductById(item.product_id);
            if (product) {
                const discountedPrice = getDiscountedPrice(product.price, product.sold);
                subtotal += discountedPrice * item.quantity;
            }
        }
    });
    
    const shipping = 15.00;
    const total = subtotal + shipping;
    
    document.getElementById("cart-subtotal").textContent = `$${subtotal.toFixed(2)}`;
    document.getElementById("cart-shipping").textContent = `$${shipping.toFixed(2)}`;
    document.getElementById("cart-total").textContent = `$${total.toFixed(2)}`;
}

// Open product details modal
function openProductDetails(productId) {
    const product = getProductById(productId);
    if (!product) return;
    
    const discountedPrice = getDiscountedPrice(product.price, product.sold);
    
    document.getElementById("modal-product-image").src = product.image_data;
    document.getElementById("modal-product-name").textContent = product.product_name;
    document.getElementById("modal-original-price").textContent = `$${product.price.toFixed(2)}`;
    document.getElementById("modal-discount-price").textContent = `$${discountedPrice.toFixed(2)}`;
    
    if (product.sold > 0) {
        document.getElementById("modal-discount-percent").textContent = `-${product.sold}%`;
        document.getElementById("modal-discount-percent").style.display = 'inline-block';
    } else {
        document.getElementById("modal-discount-percent").style.display = 'none';
    }
    
    document.getElementById("modal-product-stock").textContent = `${product.quantity} available`;
    document.getElementById("modal-product-brief").textContent = product.brief_description;
    document.getElementById("modal-product-description").textContent = product.detailed_description;
    document.getElementById("modal-quantity").value = 1;
    
    modalAddToCartBtn.setAttribute("data-product-id", product.id);
    
    modal.style.display = "block";
}

// Update item quantity in cart
function updateQuantity(index, newQuantity) {
    const item = cartItems[index];
    const product = getProductById(item.product_id);
    
    if (!product) return;
    
    if (newQuantity < 1) newQuantity = 1;
    if (newQuantity > product.quantity) newQuantity = product.quantity;
    
    item.quantity = newQuantity;
    
    // Update DOM
    const quantityInputs = document.querySelectorAll(".cart-item .item-quantity input");
    quantityInputs[index].value = newQuantity;
    
    // Update item total
    const totalElements = document.querySelectorAll(".cart-item .item-total");
    const discountedPrice = getDiscountedPrice(product.price, product.sold);
    totalElements[index].textContent = `$${(discountedPrice * newQuantity).toFixed(2)}`;
    
    // Update cart totals
    updateCartTotals();
}

// Toggle favorite status
function toggleFavorite(index) {
    cartItems[index].favorite = !cartItems[index].favorite;
    
    // Update heart button
    const heartBtn = document.querySelectorAll(".heart-btn")[index];
    
    if (cartItems[index].favorite) {
        heartBtn.classList.add("active");
        heartBtn.querySelector("i").classList.remove("bx-heart");
        heartBtn.querySelector("i").classList.add("bxs-heart");
    } else {
        heartBtn.classList.remove("active");
        heartBtn.querySelector("i").classList.remove("bxs-heart");
        heartBtn.querySelector("i").classList.add("bx-heart");
    }
}

// Toggle item selection
function toggleSelection(index, checked) {
    cartItems[index].selected = checked;
    
    // Update cart totals
    updateCartTotals();
}

// Remove item from cart
function removeCartItem(index) {
    cartItems.splice(index, 1);
    
    // Remove from DOM
    const cartItem = document.querySelectorAll(".cart-item")[index];
    cartItem.style.opacity = "0";
    cartItem.style.transition = "opacity 0.3s";
    
    setTimeout(() => {
        cartItem.remove();
        
        // Update cart totals
        updateCartTotals();
        
        // Show empty cart message if no items left
        if (cartItems.length === 0) {
            document.querySelector(".cart-items").innerHTML = `
                <div class="empty-cart">
                    <i class='bx bx-cart'></i>
                    <p>Your cart is empty</p>
                    <a href="?page=main" class="btn">Continue Shopping</a>
                </div>
            `;
        }
    }, 300);
}

// Event Listeners

// View details buttons
viewDetailsBtns.forEach(btn => {
    btn.addEventListener("click", function(e) {
        e.preventDefault();
        const productId = parseInt(this.getAttribute("data-product-id"));
        openProductDetails(productId);
    });
});

// Close modal
closeModal.addEventListener("click", function() {
    modal.style.display = "none";
});

// Close modal when clicking outside
window.addEventListener("click", function(e) {
    if (e.target === modal) {
        modal.style.display = "none";
    }
});

// Decrease quantity buttons
minusBtns.forEach(btn => {
    btn.addEventListener("click", function() {
        const index = parseInt(this.getAttribute("data-index"));
        const currentQuantity = cartItems[index].quantity;
        updateQuantity(index, currentQuantity - 1);
    });
});

// Increase quantity buttons
plusBtns.forEach(btn => {
    btn.addEventListener("click", function() {
        const index = parseInt(this.getAttribute("data-index"));
        const currentQuantity = cartItems[index].quantity;
        updateQuantity(index, currentQuantity + 1);
    });
});

// Heart buttons
heartBtns.forEach(btn => {
    btn.addEventListener("click", function() {
        const index = parseInt(this.getAttribute("data-index"));
        toggleFavorite(index);
    });
});

// Checkbox selection
checkboxes.forEach(checkbox => {
    checkbox.addEventListener("change", function() {
        const index = parseInt(this.getAttribute("data-index"));
        toggleSelection(index, this.checked);
    });
});

// Remove buttons
removeBtns.forEach(btn => {
    btn.addEventListener("click", function() {
        const index = parseInt(this.getAttribute("data-index"));
        removeCartItem(index);
    });
});

// Modal quantity buttons
modalMinusBtn.addEventListener("click", function() {
    const quantityInput = document.getElementById("modal-quantity");
    const currentValue = parseInt(quantityInput.value);
    if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
    }
});

modalPlusBtn.addEventListener("click", function() {
    const quantityInput = document.getElementById("modal-quantity");
    const currentValue = parseInt(quantityInput.value);
    const productId = parseInt(modalAddToCartBtn.getAttribute("data-product-id"));
    const product = getProductById(productId);
    
    if (product && currentValue < product.quantity) {
        quantityInput.value = currentValue + 1;
    }
});

// Add to cart from modal
modalAddToCartBtn.addEventListener("click", function() {
    const productId = parseInt(this.getAttribute("data-product-id"));
    const quantity = parseInt(document.getElementById("modal-quantity").value);
    const product = getProductById(productId);
    
    if (!product) return;
    
    // Check if product already in cart
    const existingIndex = cartItems.findIndex(item => item.product_id === productId);
    
    if (existingIndex !== -1) {
        // Update quantity if already in cart
        const newQuantity = Math.min(cartItems[existingIndex].quantity + quantity, product.quantity);
        updateQuantity(existingIndex, newQuantity);
        alert(`Cart updated: ${product.product_name} (Quantity: ${newQuantity})`);
    } else {
        // Add new item to cart (would reload page in real implementation)
        alert(`Added to cart: ${quantity} × ${product.product_name}`);
    }
    
    // Close modal
    modal.style.display = "none";
});
</script>