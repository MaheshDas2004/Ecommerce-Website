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
        <h2 class="text-2xl font-semibold mb-6">My Bag <span class="text-gray-500 font-normal text-lg">(2 items)</span></h2>
        
        <div class="lg:flex lg:space-x-8">
            <!-- Cart Items -->
            <div class="lg:w-2/3">
                <!-- Cart Item 1 -->
                <div class="border border-gray-200 rounded-md mb-4 p-4 flex flex-col md:flex-row">
                    <div class="flex-shrink-0 w-full md:w-32 h-40 bg-gray-100 rounded-md overflow-hidden mb-4 md:mb-0">
                        <img src="https://via.placeholder.com/150" alt="Product" class="w-full h-full object-cover object-center">
                    </div>
                    
                    <div class="flex-grow md:ml-6 flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-medium mb-1">Women Logo Applique Hooded Sweatshirt</h3>
                            <p class="text-gray-500 text-sm mb-2">Size: S</p>
                            
                            <div class="flex items-center mb-3">
                                <p class="text-secondary font-medium">₹ 1,500.00</p>
                                <p class="text-gray-400 line-through text-sm ml-2">₹ 2,999.00</p>
                                <span class="ml-2 bg-green-100 text-green-800 text-xs px-2 py-0.5 rounded">50% OFF</span>
                            </div>
                            
                            <div class="flex items-center mb-3">
                                <span class="text-sm font-medium mr-3">Qty:</span>
                                <select class="border border-gray-300 rounded-md px-2 py-1 text-sm">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="flex mt-3">
                            <button class="text-red-500 text-sm font-medium mr-4">
                                <i class="far fa-trash-alt mr-1"></i> Delete
                            </button>
                            <button class="text-gray-600 text-sm font-medium flex items-center">
                                <i class="far fa-heart mr-1"></i> Move to Wishlist
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Cart Item 2 -->
                <div class="border border-gray-200 rounded-md mb-4 p-4 flex flex-col md:flex-row">
                    <div class="flex-shrink-0 w-full md:w-32 h-40 bg-gray-100 rounded-md overflow-hidden mb-4 md:mb-0">
                        <img src="https://via.placeholder.com/150" alt="Product" class="w-full h-full object-cover object-center">
                    </div>
                    
                    <div class="flex-grow md:ml-6 flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-medium mb-1">Women Mid-Wash Skinny Fit High-Rise Jeans</h3>
                            <p class="text-gray-500 text-sm mb-2">Size: 26</p>
                            
                            <div class="flex items-center mb-3">
                                <p class="text-secondary font-medium">₹ 1,250.00</p>
                                <p class="text-gray-400 line-through text-sm ml-2">₹ 2,499.00</p>
                                <span class="ml-2 bg-green-100 text-green-800 text-xs px-2 py-0.5 rounded">50% OFF</span>
                            </div>
                            
                            <div class="flex items-center mb-3">
                                <span class="text-sm font-medium mr-3">Qty:</span>
                                <select class="border border-gray-300 rounded-md px-2 py-1 text-sm">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="flex mt-3">
                            <button class="text-red-500 text-sm font-medium mr-4">
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
                            <span class="font-medium">₹5,498.00</span>
                        </div>
                        <div class="flex justify-between text-green-600">
                            <span>Bag discount</span>
                            <span>-₹2,748.00</span>
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
                        <div class="border-t border-gray-200 pt-3 flex justify-between font-semibold">
                            <span>Order Total</span>
                            <span>₹2,750.00</span>
                        </div>
                    </div>
                    
                    <button class="w-full bg-secondary hover:bg-secondary/90 text-white py-3 rounded-md font-medium uppercase tracking-wide">
                        Proceed to Shipping
                    </button>
                    
                    <!-- Coupon Section -->
                    <div class="mt-6 border border-gray-200 rounded-md p-4">
                        <h4 class="font-medium mb-3">Apply Coupon</h4>
                        <div class="flex">
                            <input type="text" placeholder="Enter coupon code" class="flex-grow border border-gray-300 rounded-l-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-secondary">
                            <button class="bg-gray-800 text-white px-4 py-2 rounded-r-md text-sm font-medium">APPLY</button>
                        </div>
                        
                        <div class="mt-4">
                            <h5 class="font-medium mb-2">Applicable Coupons</h5>
                            <div class="space-y-3">
                                <!-- Coupon 1 -->
                                <div class="flex items-start">
                                    <input type="radio" id="coupon1" name="coupon" class="mt-1 mr-2">
                                    <div>
                                        <label for="coupon1" class="block font-medium text-sm">Savings: ₹125.00</label>
                                        <p class="text-sm text-gray-600">NEW125</p>
                                        <p class="text-xs text-gray-500">Get Flat Rs.125 off on cart value of 500 & Above</p>
                                        <p class="text-xs text-blue-500 cursor-pointer">View T & C</p>
                                    </div>
                                </div>
                                
                                <!-- Coupon 2 -->
                                <div class="flex items-start">
                                    <input type="radio" id="coupon2" name="coupon" class="mt-1 mr-2">
                                    <div>
                                        <label for="coupon2" class="block font-medium text-sm">Savings: ₹1.00</label>
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
        // Simple cart functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Get all quantity selects
            const quantitySelects = document.querySelectorAll('select');
            
            // Add event listeners
            quantitySelects.forEach(select => {
                select.addEventListener('change', updateCart);
            });
            
            function updateCart() {
                // This would typically make an AJAX call to update the cart
                console.log('Cart updated');
            }
        });
    </script>
</body>
</html>