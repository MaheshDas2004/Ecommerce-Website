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
</head>
<body class="bg-rose-50">
    
    <!-- Page Title -->
    <div class="bg-white shadow-sm">
      <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Our Collection</h1>
        <div class="flex items-center text-sm text-gray-500 mt-2">
          <a href="index.php" class="hover:text-rose-600">Home</a>
          <span class="mx-2">/</span>
          <span class="text-gray-700">Our Collection</span>
        </div>
      </div>
    </div>
    <!-- Filters -->
    <div class="container mx-auto px-4 py-6">
        <div class="flex flex-col md:flex-row justify-between items-center bg-white p-4 rounded-lg shadow-sm">
            <div class="flex items-center mb-4 md:mb-0">
                <span class="text-gray-600 mr-2">Filter:</span>
                <select class="border rounded px-2 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-rose-300">
                    <option>All Categories</option>
                    <option>Men's Clothing</option>
                    <option>Women's Clothing</option>
                    <option>Jewelry</option>
                    <option>Electronics</option>
                </select>
            </div>
            <div class="flex items-center">
                <span class="text-gray-600 mr-2">Sort by:</span>
                <select class="border rounded px-2 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-rose-300">
                    <option>Featured</option>
                    <option>Price: Low to High</option>
                    <option>Price: High to Low</option>
                    <option>Rating</option>
                    <option>Newest</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <section class="container mx-auto px-2 sm:px-4 py-6 sm:py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4">
            <?php foreach ($products as $product) { ?>
            <div class="group border-2 border-rose-50 shadow-lg overflow-hidden bg-white rounded-lg">
                <div class="relative overflow-hidden">
                    <!-- Product Image -->
                    <img src="<?php echo $product['image']; ?>" 
                         alt="<?php echo $product['title']; ?>" 
                         class="w-96 h-96 border-b-4 object-cover object-center transition-transform duration-300 group-hover:scale-105">
                    
                    <!-- Category Tag -->
                    <div class="absolute top-3 left-3">
                        <span class="bg-rose-100 text-rose-600 px-2 py-1 rounded text-xs font-medium">
                            <?php echo ucfirst($product['category']); ?>
                        </span>
                    </div>
                    
                    <!-- Hover Options -->
                    <div class="hover-options absolute top-4 right-4 flex flex-col gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <button class="bg-white p-2 rounded-full shadow-md hover:bg-gray-100 transition-colors" title="Add to cart">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </button>
                        
                    </div>

                    <!-- Quick Shop Overlay -->
                    <div class="absolute bottom-0 left-0 right-0 bg-white bg-opacity-95 py-4 px-6 transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                        <button class="w-full bg-black text-white py-2 px-4 rounded hover:bg-gray-800 transition-colors text-sm uppercase tracking-wider">
                            Quick Shop
                        </button>
                    </div>
                </div>
                
                <!-- Product Info -->
                <div class="p-4 text-center">
                    <h3 class="text-lg font-medium text-gray-900 mb-2 line-clamp-2 hover:text-rose-600 transition-colors">
                        <a href="product.php?id=<?php echo $product['id']; ?>">
                            <?php echo $product['title']; ?>
                        </a>
                    </h3>
                    <div class="flex justify-center items-center text-amber-400 text-sm mb-2">
                        <?php echo formatRating($product['rating_rate'], $product['rating_count']); ?>
                    </div>
                    <div class="mt-2">
                        <span class="text-gray-700 font-semibold">
                            $<?php echo number_format($product['price'], 2); ?>
                        </span>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>

    <!-- Pagination -->
    <!-- <div class="container mx-auto px-4 py-8 flex justify-center">
        <div class="flex space-x-1">
            <a href="#" class="px-3 py-1 rounded border border-gray-300 text-gray-600 hover:bg-rose-100 hover:text-rose-600">
                <i class="fas fa-chevron-left text-xs"></i>
            </a>
            <a href="#" class="px-3 py-1 rounded border border-rose-500 bg-rose-500 text-white">1</a>
            <a href="#" class="px-3 py-1 rounded border border-gray-300 text-gray-600 hover:bg-rose-100 hover:text-rose-600">2</a>
            <a href="#" class="px-3 py-1 rounded border border-gray-300 text-gray-600 hover:bg-rose-100 hover:text-rose-600">3</a>
            <span class="px-3 py-1 text-gray-600">...</span>
            <a href="#" class="px-3 py-1 rounded border border-gray-300 text-gray-600 hover:bg-rose-100 hover:text-rose-600">10</a>
            <a href="#" class="px-3 py-1 rounded border border-gray-300 text-gray-600 hover:bg-rose-100 hover:text-rose-600">
                <i class="fas fa-chevron-right text-xs"></i>
            </a>
        </div>
    </div> -->

    <!-- Footer
    <footer class="bg-gray-900 text-gray-300 py-10">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold text-white mb-4">VEYRA</h3>
                    <p class="text-sm mb-4">Premium fashion and lifestyle products for the modern consumer.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="text-white font-medium mb-4">Shop</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-rose-400 transition-colors">Men's Clothing</a></li>
                        <li><a href="#" class="hover:text-rose-400 transition-colors">Women's Clothing</a></li>
                        <li><a href="#" class="hover:text-rose-400 transition-colors">Jewelry</a></li>
                        <li><a href="#" class="hover:text-rose-400 transition-colors">Electronics</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-medium mb-4">Information</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-rose-400 transition-colors">About Us</a></li>
                        <li><a href="#" class="hover:text-rose-400 transition-colors">Contact Us</a></li>
                        <li><a href="#" class="hover:text-rose-400 transition-colors">Terms & Conditions</a></li>
                        <li><a href="#" class="hover:text-rose-400 transition-colors">Returns & Exchanges</a></li>
                        <li><a href="#" class="hover:text-rose-400 transition-colors">Shipping & Delivery</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-medium mb-4">Newsletter</h4>
                    <p class="text-sm mb-4">Subscribe to receive updates, access to exclusive deals, and more.</p>
                    <form class="flex">
                        <input type="email" placeholder="Enter your email" class="w-full bg-gray-800 border-gray-700 rounded-l px-3 py-2 focus:outline-none focus:ring-1 focus:ring-rose-400 text-sm">
                        <button class="bg-rose-600 text-white px-3 py-2 rounded-r hover:bg-rose-700 transition-colors">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-10 pt-6 flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm">&copy; 2025 VEYRA. All rights reserved.</p>
                <div class="flex space-x-4 mt-4 md:mt-0">
                    <img src="./images/payment-visa.svg" alt="Visa" class="h-6">
                    <img src="./images/payment-mastercard.svg" alt="Mastercard" class="h-6">
                    <img src="./images/payment-paypal.svg" alt="PayPal" class="h-6">
                    <img src="./images/payment-apple.svg" alt="Apple Pay" class="h-6">
                </div>
            </div>
        </div>
    </footer> -->
</body>
</html>