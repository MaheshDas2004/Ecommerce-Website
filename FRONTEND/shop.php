<?php
    // include '../Backend/api.php';
    include '../Backend/config.php';
    $sql = "SELECT id, title, price, description, category, image, rating_rate, rating_count FROM products";
    $result = mysqli_query($conn, $sql);

    // Store results in an array
    $products = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
    }

    // Helper function to format ratings display
    function formatRating($rate, $count) {
        $rate = number_format($rate, 1);
        return "$rate ★ ($count)";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VEYRA - Shop</title>
    <link rel="stylesheet" href="./output.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        h1, h2, h3, .logo-text {
            font-family: 'Playfair Display', serif;
        }
        
        .product-card {
            transition: all 0.3s ease;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        .product-image-wrapper {
            overflow: hidden;
            position: relative;
            aspect-ratio: 1/1;
            background-color: #f9fafb;
        }
        
        .product-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 12px;
            transition: transform 0.5s ease;
        }
        
        .product-card:hover .product-image {
            transform: scale(1.05);
        }
        
        .category-pill {
            transition: all 0.3s ease;
        }
        
        .category-pill:hover {
            transform: scale(1.05);
        }
        
        .hero-gradient {
            background: linear-gradient(to right, rgba(254, 226, 226, 0.9), rgba(252, 231, 243, 0.6));
        }
        
        .section-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background-color: #f43f5e;
            margin-top: 8px;
        }
    </style>
</head>
<body class="bg-gray-50">
   
    
    <!-- Hero Section -->
    <div class="hero-gradient py-12 mb-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="md:w-1/2 mb-8 md:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Discover Your Style</h1>
                    <p class="text-lg text-gray-700 mb-6">Explore our curated collection of premium fashion and lifestyle products.</p>
                    <div class="flex space-x-4">
                        <a href="#new-arrivals" class="bg-rose-600 hover:bg-rose-700 text-white px-6 py-3 rounded-md transition-colors shadow-md">
                            Shop Now
                        </a>
                        <a href="#categories" class="bg-transparent border-2 border-gray-800 text-gray-800 hover:bg-gray-800 hover:text-white px-6 py-3 rounded-md transition-colors">
                            Explore Categories
                        </a>
                    </div>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    <img src="./images/hero-fashion.png" alt="Fashion Collection" class="max-w-full h-auto rounded-lg shadow-xl">
                </div>
            </div>
        </div>
    </div>
    
    <!-- Categories Section -->
    <section id="categories" class="container mx-auto px-4 mb-12">
        <h2 class="section-title text-2xl md:text-3xl font-bold text-gray-800 mb-8">Shop by Category</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="#" class="category-pill bg-gradient-to-r from-rose-50 to-rose-100 p-4 rounded-lg shadow-sm flex flex-col items-center justify-center text-center hover:shadow-md transition-all">
                <div class="w-16 h-16 bg-rose-200 rounded-full flex items-center justify-center mb-3">
                    <i class="fas fa-tshirt text-rose-600 text-xl"></i>
                </div>
                <span class="font-medium text-gray-800">Men's Clothing</span>
            </a>
            <a href="#" class="category-pill bg-gradient-to-r from-purple-50 to-purple-100 p-4 rounded-lg shadow-sm flex flex-col items-center justify-center text-center hover:shadow-md transition-all">
                <div class="w-16 h-16 bg-purple-200 rounded-full flex items-center justify-center mb-3">
                    <i class="fas fa-female text-purple-600 text-xl"></i>
                </div>
                <span class="font-medium text-gray-800">Women's Clothing</span>
            </a>
            <a href="#" class="category-pill bg-gradient-to-r from-amber-50 to-amber-100 p-4 rounded-lg shadow-sm flex flex-col items-center justify-center text-center hover:shadow-md transition-all">
                <div class="w-16 h-16 bg-amber-200 rounded-full flex items-center justify-center mb-3">
                    <i class="fas fa-gem text-amber-600 text-xl"></i>
                </div>
                <span class="font-medium text-gray-800">Jewelry</span>
            </a>
            <a href="#" class="category-pill bg-gradient-to-r from-blue-50 to-blue-100 p-4 rounded-lg shadow-sm flex flex-col items-center justify-center text-center hover:shadow-md transition-all">
                <div class="w-16 h-16 bg-blue-200 rounded-full flex items-center justify-center mb-3">
                    <i class="fas fa-laptop text-blue-600 text-xl"></i>
                </div>
                <span class="font-medium text-gray-800">Electronics</span>
            </a>
        </div>
    </section>
    
    <!-- Filters Section -->
    <div class="container mx-auto px-4 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-md">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center mb-4 md:mb-0">
                    <span class="text-gray-600 mr-3 font-medium">Filter by:</span>
                    <div class="flex flex-wrap gap-2">
                        <select class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-rose-300 focus:border-rose-300">
                            <option>All Categories</option>
                            <option>Men's Clothing</option>
                            <option>Women's Clothing</option>
                            <option>Jewelry</option>
                            <option>Electronics</option>
                        </select>
                        <select class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-rose-300 focus:border-rose-300">
                            <option>Price Range</option>
                            <option>Under $25</option>
                            <option>$25 - $50</option>
                            <option>$50 - $100</option>
                            <option>$100+</option>
                        </select>
                    </div>
                </div>
                <div class="flex items-center">
                    <span class="text-gray-600 mr-3 font-medium">Sort by:</span>
                    <select class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-rose-300 focus:border-rose-300">
                        <option>Featured</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                        <option>Rating</option>
                        <option>Newest</option>
                    </select>
                </div>
            </div>
            <!-- Active Filters -->
            <div class="mt-4 flex flex-wrap gap-2">
                <span class="text-sm text-gray-600">Active filters:</span>
                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs flex items-center">
                    All Products
                    <button class="ml-1 text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </span>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <section id="new-arrivals" class="container mx-auto px-4 mb-16">
        <h2 class="section-title text-2xl md:text-3xl font-bold text-gray-800 mb-8">Our Collection</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php foreach ($products as $product) { ?>
            <div class="product-card bg-white overflow-hidden shadow-md">
                <!-- Product Image Container with white bg -->
                <div class="product-image-wrapper border-b border-gray-100">
                    <!-- Product Image -->
                    <img src="<?php echo $product['image']; ?>" 
                         alt="<?php echo $product['title']; ?>" 
                         class="product-image">
                    
                    <!-- Category Tag -->
                    <div class="absolute top-2 left-2">
                        <span class="bg-rose-100 text-rose-600 px-2 py-1 rounded-full text-xs font-medium">
                            <?php echo ucfirst($product['category']); ?>
                        </span>
                    </div>
                    
                    <!-- Quick Action Buttons -->
                    <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        <button class="bg-white p-1.5 rounded-full shadow-sm hover:bg-gray-50 transition-colors">
                            <i class="far fa-heart text-gray-600 text-sm"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Product Info -->
                <div class="p-4">
                    <div class="flex items-center text-amber-400 text-xs mb-1">
                        <?php echo formatRating($product['rating_rate'], $product['rating_count']); ?>
                    </div>
                    <h3 class="text-sm font-medium text-gray-800 mb-1 line-clamp-2 h-10">
                        <a href="product.php?id=<?php echo $product['id']; ?>" class="hover:text-blue-600 transition-colors">
                            <?php echo $product['title']; ?>
                        </a>
                    </h3>
                    <div class="flex flex-col space-y-2 mt-2">
                        <!-- Price Display -->
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-bold text-gray-900">₹<?php echo number_format($product['price'], 2); ?></span>
                            <button onclick="addToWishlist(<?php echo $product['id']; ?>)" 
                                    class="text-gray-400 hover:text-red-500 transition-colors">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <!-- Action Buttons -->
                        <div class="flex space-x-2">
                            <form action="Payment.php">
                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                <button onclick="" 
                                        class="flex-1 bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded transition-colors">
                                    Buy Now
                                </button>
                            </form>
                            
                            <button onclick="addToCart(<?php echo $product['id']; ?>)" 
                                    class="flex-1 border border-indigo-500 text-indigo-500 hover:bg-indigo-50 px-4 py-2 rounded transition-colors">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>

    <!-- Pagination -->
    <div class="container mx-auto px-4 pb-16 flex justify-center">
        <div class="inline-flex rounded-md shadow-sm">
            <a href="#" class="px-4 py-2 rounded-l-md border border-gray-300 bg-white text-gray-700 hover:bg-gray-50">
                <i class="fas fa-chevron-left text-xs mr-2"></i>
                Previous
            </a>
            <a href="#" class="px-4 py-2 border-t border-b border-gray-300 bg-rose-500 text-white">1</a>
            <a href="#" class="px-4 py-2 border-t border-b border-gray-300 bg-white text-gray-700 hover:bg-gray-50">2</a>
            <a href="#" class="px-4 py-2 border-t border-b border-gray-300 bg-white text-gray-700 hover:bg-gray-50">3</a>
            <span class="px-2 py-2 border-t border-b border-gray-300 bg-white text-gray-700">...</span>
            <a href="#" class="px-4 py-2 border-t border-b border-gray-300 bg-white text-gray-700 hover:bg-gray-50">10</a>
            <a href="#" class="px-4 py-2 rounded-r-md border border-gray-300 bg-white text-gray-700 hover:bg-gray-50">
                Next
                <i class="fas fa-chevron-right text-xs ml-2"></i>
            </a>
        </div>
    </div>

    <!-- Newsletter Section -->
    <section class="bg-gradient-to-r from-rose-100 to-pink-100 py-16 mb-16">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto text-center">
                <h3 class="text-3xl font-bold text-gray-900 mb-4">Join Our Newsletter</h3>
                <p class="text-gray-700 mb-8">Subscribe to receive updates, access to exclusive deals, and more.</p>
                <form class="flex flex-col sm:flex-row gap-2 max-w-lg mx-auto">
                    <input type="email" placeholder="Enter your email address" class="flex-1 px-4 py-3 rounded-lg border-2 border-gray-200 focus:outline-none focus:ring-2 focus:ring-rose-400 focus:border-transparent">
                    <button type="submit" class="bg-rose-600 text-white px-6 py-3 rounded-lg hover:bg-rose-700 transition-colors shadow-md font-medium">
                        Subscribe Now
                    </button>
                </form>
                <p class="text-xs text-gray-600 mt-4">By subscribing, you agree to our Privacy Policy and consent to receive updates from our company.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="text-2xl font-bold text-white mb-4">VEYRA<span class="text-rose-400">.co</span></h3>
                    <p class="text-sm mb-6">Premium fashion and lifestyle products for the modern consumer.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="bg-gray-800 hover:bg-rose-600 w-10 h-10 rounded-full flex items-center justify-center transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="bg-gray-800 hover:bg-rose-600 w-10 h-10 rounded-full flex items-center justify-center transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="bg-gray-800 hover:bg-rose-600 w-10 h-10 rounded-full flex items-center justify-center transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="bg-gray-800 hover:bg-rose-600 w-10 h-10 rounded-full flex items-center justify-center transition-colors">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="text-white font-medium mb-4 uppercase tracking-wider">Shop</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="hover:text-rose-400 transition-colors flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-rose-400"></i>Men's Clothing</a></li>
                        <li><a href="#" class="hover:text-rose-400 transition-colors flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-rose-400"></i>Women's Clothing</a></li>
                        <li><a href="#" class="hover:text-rose-400 transition-colors flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-rose-400"></i>Jewelry</a></li>
                        <li><a href="#" class="hover:text-rose-400 transition-colors flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-rose-400"></i>Electronics</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-medium mb-4 uppercase tracking-wider">Information</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="hover:text-rose-400 transition-colors flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-rose-400"></i>About Us</a></li>
                        <li><a href="#" class="hover:text-rose-400 transition-colors flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-rose-400"></i>Contact Us</a></li>
                        <li><a href="#" class="hover:text-rose-400 transition-colors flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-rose-400"></i>Terms & Conditions</a></li>
                        <li><a href="#" class="hover:text-rose-400 transition-colors flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-rose-400"></i>Returns & Exchanges</a></li>
                        <li><a href="#" class="hover:text-rose-400 transition-colors flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-rose-400"></i>Shipping & Delivery</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-medium mb-4 uppercase tracking-wider">Contact Us</h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-rose-400"></i>
                            <span>123 Fashion Street, New York, NY 10001</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt mr-3 text-rose-400"></i>
                            <span>+1 (555) 123-4567</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-rose-400"></i>
                            <span>support@veyra.co</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-clock mr-3 text-rose-400"></i>
                            <span>Mon-Fri: 9:00 AM - 6:00 PM</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm">&copy; 2025 VEYRA. All rights reserved.</p>
                <div class="flex space-x-4 mt-4 md:mt-0">
                    <img src="./images/payment-visa.svg" alt="Visa" class="h-6">
                    <img src="./images/payment-mastercard.svg" alt="Mastercard" class="h-6">
                    <img src="./images/payment-paypal.svg" alt="PayPal" class="h-6">
                    <img src="./images/payment-apple.svg" alt="Apple Pay" class="h-6">
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Back to top button -->
    <a href="#" class="fixed bottom-6 right-6 bg-rose-600 text-white w-12 h-12 rounded-full flex items-center justify-center shadow-lg hover:bg-rose-700 transition-colors">
        <i class="fas fa-chevron-up"></i>
    </a>
</body>
</html>