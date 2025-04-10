<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VEYRA - Shopping Cart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#FFE4E4',
                        secondary: '#9B8069',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">
    
    <!-- Cart Container -->
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-semibold mb-6">My Bag <span id="itemCount" class="text-gray-500 font-normal text-lg">(2 items)</span></h2>
        
        <div class="lg:flex lg:space-x-8">
            <!-- Cart Items -->
            <div class="lg:w-2/3">
                <!-- Cart Item 1 -->
                <div class="border border-gray-200 rounded-md mb-4 p-4 flex flex-col md:flex-row" data-id="1">
                    <div class="flex-shrink-0 w-full md:w-32 h-40 bg-gray-100 rounded-md overflow-hidden mb-4 md:mb-0">
                        <img src="https://via.placeholder.com/150" alt="Product" class="w-full h-full object-cover object-center">
                    </div>
                    
                    <div class="flex-grow md:ml-6 flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-medium mb-1">Women Logo Applique Hooded Sweatshirt</h3>
                            <p class="text-gray-500 text-sm mb-2">Size: S</p>
                            
                            <div class="flex items-center mb-3">
                                <p class="item-price text-secondary font-medium">₹ 1,500.00</p>
                                <p class="text-gray-400 line-through text-sm ml-2">₹ 2,999.00</p>
                                <span class="ml-2 bg-green-100 text-green-800 text-xs px-2 py-0.5 rounded">50% OFF</span>
                            </div>
                            
                            <div class="flex items-center mb-3">
                                <span class="text-sm font-medium mr-3">Qty:</span>
                                <select class="quantity-select border border-gray-300 rounded-md px-2 py-1 text-sm" data-price="1500" data-original-price="2999">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="flex mt-3">
                            <button class="delete-item text-red-500 text-sm font-medium mr-4">
                                <i class="far fa-trash-alt mr-1"></i> Delete
                            </button>
                            <button class="text-gray-600 text-sm font-medium flex items-center">
                                <i class="far fa-heart mr-1"></i> Move to Wishlist
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Cart Item 2 -->
                <div class="border border-gray-200 rounded-md mb-4 p-4 flex flex-col md:flex-row" data-id="2">
                    <div class="flex-shrink-0 w-full md:w-32 h-40 bg-gray-100 rounded-md overflow-hidden mb-4 md:mb-0">
                        <img src="https://via.placeholder.com/150" alt="Product" class="w-full h-full object-cover object-center">
                    </div>
                    
                    <div class="flex-grow md:ml-6 flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-medium mb-1">Women Mid-Wash Skinny Fit High-Rise Jeans</h3>
                            <p class="text-gray-500 text-sm mb-2">Size: 26</p>
                            
                            <div class="flex items-center mb-3">
                                <p class="item-price text-secondary font-medium">₹ 1,250.00</p>
                                <p class="text-gray-400 line-through text-sm ml-2">₹ 2,499.00</p>
                                <span class="ml-2 bg-green-100 text-green-800 text-xs px-2 py-0.5 rounded">50% OFF</span>
                            </div>
                            
                            <div class="flex items-center mb-3">
                                <span class="text-sm font-medium mr-3">Qty:</span>
                                <select class="quantity-select border border-gray-300 rounded-md px-2 py-1 text-sm" data-price="1250" data-original-price="2499">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="flex mt-3">
                            <button class="delete-item text-red-500 text-sm font-medium mr-4">
                                <i class="far fa-trash-alt mr-1"></i> Delete
                            </button>
                            <button class="text-gray-600 text-sm font-medium flex items-center">
                                <i class="far fa-heart mr-1"></i> Move to Wishlist
                            </button>
                        </div>
                    </div>
                </div>
                
                <button class="w-full py-3 border border-gray-300 rounded-md text-center text-sm font-medium hover:bg-gray-50 mt-4">
                    + Add from Wishlist
                </button>
            </div>
            
            <!-- Order Summary -->
            <div class="lg:w-1/3 mt-8 lg:mt-0">
                <div class="bg-white border border-gray-200 rounded-md p-6">
                    <h3 class="text-xl font-semibold mb-4">Order Details</h3>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Bag Total</span>
                            <span id="bagTotal" class="font-medium">₹5,498.00</span>
                        </div>
                        <div class="flex justify-between text-green-600">
                            <span>Bag discount</span>
                            <span id="bagDiscount">-₹2,748.00</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 flex items-center">
                                Convenience Fee
                                <span class="text-blue-500 text-xs ml-1 cursor-pointer">What's this?</span>
                            </span>
                            <span class="font-medium">₹0</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Delivery Fee</span>
                            <span class="text-green-600">Free <span class="line-through text-gray-400 text-sm">₹99.00</span></span>
                        </div>
                        <div id="couponDiscount" class="flex justify-between text-green-600 hidden">
                            <span>Coupon discount</span>
                            <span id="couponDiscountValue">-₹0.00</span>
                        </div>
                        <div class="border-t border-gray-200 pt-3 flex justify-between font-semibold">
                            <span>Order Total</span>
                            <span id="orderTotal">₹2,750.00</span>
                        </div>
                    </div>
                    
                    <button class="w-full bg-secondary hover:bg-secondary/90 text-white py-3 rounded-md font-medium uppercase tracking-wide">
                        Proceed to Shipping
                    </button>
                    
                    <!-- Coupon Section -->
                    <div class="mt-6 border border-gray-200 rounded-md p-4">
                        <h4 class="font-medium mb-3">Apply Coupon</h4>
                        <div class="flex">
                            <input type="text" id="couponInput" placeholder="Enter coupon code" class="flex-grow border border-gray-300 rounded-l-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-secondary">
                            <button id="applyCoupon" class="bg-gray-800 text-white px-4 py-2 rounded-r-md text-sm font-medium">APPLY</button>
                        </div>
                        <div id="couponMessage" class="mt-2 text-sm hidden"></div>
                        
                        <div class="mt-4">
                            <h5 class="font-medium mb-2">Applicable Coupons</h5>
                            <div class="space-y-3">
                                <!-- Coupon 1 -->
                                <div class="flex items-start">
                                    <input type="radio" id="coupon1" name="coupon" class="coupon-radio mt-1 mr-2" data-code="NEW125" data-discount="125">
                                    <div>
                                        <label for="coupon1" class="block font-medium text-sm">Savings: ₹125.00</label>
                                        <p class="text-sm text-gray-600">NEW125</p>
                                        <p class="text-xs text-gray-500">Get Flat Rs.125 off on cart value of 500 & Above</p>
                                        <p class="text-xs text-blue-500 cursor-pointer">View T & C</p>
                                    </div>
                                </div>
                                
                                <!-- Coupon 2 -->
                                <div class="flex items-start">
                                    <input type="radio" id="coupon2" name="coupon" class="coupon-radio mt-1 mr-2" data-code="FREEDEL" data-discount="99">
                                    <div>
                                        <label for="coupon2" class="block font-medium text-sm">Savings: ₹99.00</label>
                                        <p class="text-sm text-gray-600">FREEDEL</p>
                                        <p class="text-xs text-gray-500">Free Shipping on 799 and above. Just for you.</p>
                                        <p class="text-xs text-blue-500 cursor-pointer">View T & C</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Return Policy -->
                    <div class="mt-6">
                        <h4 class="font-medium mb-2">Return/Refund policy</h4>
                        <p class="text-sm text-gray-600">In case of return, we ensure quick refunds. Full amount will be refunded excluding Convenience Fee.</p>
                        <a href="#" class="text-sm text-blue-500 mt-1 inline-block">Read Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Trust Badges -->
    <div class="container mx-auto px-4 py-6 border-t border-gray-200 mt-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
            <div class="flex flex-col items-center">
                <div class="w-12 h-12 flex items-center justify-center rounded-full border border-gray-200 mb-2">
                    <i class="fas fa-shield-alt text-xl text-gray-600"></i>
                </div>
                <span class="text-sm font-medium uppercase">Secure Payments</span>
            </div>
            
            <div class="flex flex-col items-center">
                <div class="w-12 h-12 flex items-center justify-center rounded-full border border-gray-200 mb-2">
                    <i class="fas fa-exchange-alt text-xl text-gray-600"></i>
                </div>
                <span class="text-sm font-medium uppercase">Easy Exchange</span>
            </div>
            
            <div class="flex flex-col items-center">
                <div class="w-12 h-12 flex items-center justify-center rounded-full border border-gray-200 mb-2">
                    <i class="fas fa-check-circle text-xl text-gray-600"></i>
                </div>
                <span class="text-sm font-medium uppercase">Assured Quality</span>
            </div>
            
            <div class="flex flex-col items-center">
                <div class="w-12 h-12 flex items-center justify-center rounded-full border border-gray-200 mb-2">
                    <i class="fas fa-sync-alt text-xl text-gray-600"></i>
                </div>
                <span class="text-sm font-medium uppercase">Free Returns</span>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize cart state
            let cart = {
                items: [
                    { id: 1, name: "Women Logo Applique Hooded Sweatshirt", price: 1500, originalPrice: 2999, quantity: 1 },
                    { id: 2, name: "Women Mid-Wash Skinny Fit High-Rise Jeans", price: 1250, originalPrice: 2499, quantity: 1 }
                ],
                couponDiscount: 0,
                activeCoupon: null
            };
            
            // Available coupons - defined globally for easy access
            const coupons = [
                { code: "NEW125", discount: 125, minValue: 500 },
                { code: "FREEDEL", discount: 99, minValue: 799 }
            ];
            
            // Cache DOM elements
            const quantitySelects = document.querySelectorAll('.quantity-select');
            const deleteButtons = document.querySelectorAll('.delete-item');
            const bagTotalEl = document.getElementById('bagTotal');
            const bagDiscountEl = document.getElementById('bagDiscount');
            const orderTotalEl = document.getElementById('orderTotal');
            const itemCountEl = document.getElementById('itemCount');
            const couponRadios = document.querySelectorAll('.coupon-radio');
            const applyCouponBtn = document.getElementById('applyCoupon');
            const couponInput = document.getElementById('couponInput');
            const couponMessageEl = document.getElementById('couponMessage');
            const couponDiscountEl = document.getElementById('couponDiscount');
            const couponDiscountValueEl = document.getElementById('couponDiscountValue');
            
            // Format currency
            function formatCurrency(amount) {
                return '₹' + amount.toLocaleString('en-IN', { 
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            }
            
            // Calculate totals
            function calculateTotals() {
                // Calculate item totals
                let bagTotal = 0;
                let bagOriginalTotal = 0;
                let totalItems = 0;
                
                cart.items.forEach(item => {
                    bagTotal += item.price * item.quantity;
                    bagOriginalTotal += item.originalPrice * item.quantity;
                    totalItems += item.quantity;
                });
                
                const bagDiscount = bagOriginalTotal - bagTotal;
                let orderTotal = bagTotal - cart.couponDiscount;
                
                // Update DOM with the new values
                bagTotalEl.textContent = formatCurrency(bagOriginalTotal);
                bagDiscountEl.textContent = "-" + formatCurrency(bagDiscount);
                orderTotalEl.textContent = formatCurrency(orderTotal);
                itemCountEl.textContent = `(${totalItems} item${totalItems !== 1 ? 's' : ''})`;
                
                // Update coupon discount display
                if (cart.couponDiscount > 0) {
                    couponDiscountEl.classList.remove('hidden');
                    couponDiscountValueEl.textContent = "-" + formatCurrency(cart.couponDiscount);
                } else {
                    couponDiscountEl.classList.add('hidden');
                }
                
                // Return current cart value for coupon validation
                return { bagTotal, orderTotal, totalItems };
            }
            
            // Show coupon message
            function showCouponMessage(message, type) {
                couponMessageEl.textContent = message;
                couponMessageEl.classList.remove('hidden', 'text-red-500', 'text-green-500');
                
                if (type === "error") {
                    couponMessageEl.classList.add('text-red-500');
                } else {
                    couponMessageEl.classList.add('text-green-500');
                }
            }
            
            // Apply coupon function
            function applyCoupon(code) {
                const { bagTotal } = calculateTotals();
                
                // Reset previous coupon
                cart.couponDiscount = 0;
                cart.activeCoupon = null;
                
                // Find coupon
                const coupon = coupons.find(c => c.code === code);
                
                if (!coupon) {
                    showCouponMessage("Invalid coupon code", "error");
                    calculateTotals(); // Recalculate without coupon
                    return false;
                }
                
                // Check minimum value
                if (bagTotal < coupon.minValue) {
                    showCouponMessage(`This coupon is applicable on orders above ₹${coupon.minValue}`, "error");
                    calculateTotals(); // Recalculate without coupon
                    return false;
                }
                
                // Apply coupon
                cart.couponDiscount = coupon.discount;
                cart.activeCoupon = coupon.code;
                
                // Update radio buttons to match the applied coupon
                couponRadios.forEach(radio => {
                    radio.checked = (radio.dataset.code === coupon.code);
                });
                
                showCouponMessage(`Coupon ${coupon.code} applied successfully!`, "success");
                calculateTotals();
                return true;
            }
            
            // Handle quantity change
            quantitySelects.forEach(select => {
                select.addEventListener('change', function() {
                    const itemId = parseInt(this.closest('[data-id]').dataset.id);
                    const quantity = parseInt(this.value);
                    
                    // Update cart state
                    const item = cart.items.find(item => item.id === itemId);
                    if (item) {
                        item.quantity = quantity;
                        
                        // Update item price display in the DOM
                        const itemContainer = this.closest('[data-id]');
                        const itemPriceEl = itemContainer.querySelector('.item-price');
                        itemPriceEl.textContent = `₹ ${(item.price * quantity).toLocaleString('en-IN')}.00`;
                    }
                    
                    // Recalculate totals
                    calculateTotals();
                    
                    // If there was an active coupon, check if it's still valid
                    if (cart.activeCoupon) {
                        const { bagTotal } = calculateTotals();
                        const activeCoupon = coupons.find(c => c.code === cart.activeCoupon);
                        
                        if (activeCoupon && bagTotal < activeCoupon.minValue) {
                            // Coupon is no longer valid
                            cart.couponDiscount = 0;
                            cart.activeCoupon = null;
                            showCouponMessage(`Coupon ${activeCoupon.code} removed - cart value below minimum requirement of ₹${activeCoupon.minValue}`, "error");
                            calculateTotals();
                            
                            // Uncheck radio buttons
                            couponRadios.forEach(radio => {
                                radio.checked = false;
                            });
                        }
                    }
                });
            });
            
            // Handle delete item
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const itemContainer = this.closest('[data-id]');
                    const itemId = parseInt(itemContainer.dataset.id);
                    
                    // Remove from cart state
                    cart.items = cart.items.filter(item => item.id !== itemId);
                    
                    // Remove from DOM
                    itemContainer.remove();
                    
                    // If cart is empty, could redirect or show empty message
                    if (cart.items.length === 0) {
                        // Show empty cart message or redirect
                    }
                    
                    // Recalculate totals
                    calculateTotals();
                    
                    // If there was an active coupon, check if it's still valid
                    if (cart.activeCoupon) {
                        const { bagTotal } = calculateTotals();
                        const activeCoupon = coupons.find(c => c.code === cart.activeCoupon);
                        
                        if (activeCoupon && bagTotal < activeCoupon.minValue) {
                            // Coupon is no longer valid
                            cart.couponDiscount = 0;
                            cart.activeCoupon = null;
                            showCouponMessage(`Coupon ${activeCoupon.code} removed - cart value below minimum requirement of ₹${activeCoupon.minValue}`, "error");
                            calculateTotals();
                            
                            // Uncheck radio buttons
                            couponRadios.forEach(radio => {
                                radio.checked = false;
                            });
                        }
                    }
                });
            });
            
            // Apply coupon button click
            applyCouponBtn.addEventListener('click', function() {
                const code = couponInput.value.trim();
                if (!code) {
                    showCouponMessage("Please enter a coupon code", "error");
                    return;
                }
                
                applyCoupon(code.toUpperCase());
            });
            
            // Coupon input enter key
            couponInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    applyCouponBtn.click();
                    e.preventDefault();
                }
            });
            
            // Coupon radio button change - Just fill the input field, don't apply automatically
            couponRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.checked) {
                        const code = this.dataset.code;
                        couponInput.value = code;
                        // Don't apply automatically - user must click APPLY button
                    }
                });
            });
            
            // Clear coupon message when typing
            couponInput.addEventListener('input', function() {
                couponMessageEl.classList.add('hidden');
            });
            
            // Initialize calculations
            calculateTotals();
        });
    </script>
</body>
</html>