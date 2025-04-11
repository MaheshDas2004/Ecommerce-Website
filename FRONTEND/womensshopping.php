<?php
  include '../BACKEND/config.php';
  $sql = "SELECT id, title, price, description, category, image, rating_rate, rating_count FROM products WHERE category = 'women\'s clothing'";
$result = mysqli_query($conn, $sql);

// Store results in an array
$menproducts = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $menproducts[] = $row;
    }
}

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
<body class="bg-pink-50">
    
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
            <?php foreach ($menproducts as $menproduct) { ?>
            <div class="product-card bg-white overflow-hidden shadow-md">
                <!-- Product Image Container with white bg -->
                <div class="product-image-wrapper border-b border-gray-100">
                    <!-- Product Image -->
                    <img src="<?php echo $menproduct['image']; ?>" 
                         alt="<?php echo $menproduct['title']; ?>" 
                         class="product-image">
                    
                    <!-- Category Tag -->
                    <div class="absolute top-2 left-2">
                        <span class="bg-rose-100 text-rose-600 px-2 py-1 rounded-full text-xs font-medium">
                            <?php echo ucfirst($menproduct['category']); ?>
                        </span>
                    </div>
                    
                    
                </div>
                
                <!-- Product Info -->
                <div class="p-4">
                    <!-- <div class="flex items-center text-amber-400 text-xs mb-1">
                        <?php echo formatRating($menproduct['rating_rate'], $menproduct['rating_count']); ?>
                    </div> -->
                    <h3 class="text-sm font-medium text-gray-800 mb-1 line-clamp-2 h-10">
                        <a href="product.php?id=<?php echo $menproduct['id']; ?>" class="hover:text-blue-600 transition-colors">
                            <?php echo $menproduct['title']; ?>
                        </a>
                    </h3>
                    <div class="flex flex-col space-y-2 mt-2">
                        <!-- Price Display -->
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-bold text-gray-900">₹<?php echo number_format($menproduct['price'], 2); ?></span>
                            
                        </div>
                        <!-- Action Buttons -->
                        <div class="flex space-x-2">
                            <form action="Payment.php" class="w-full">
                                <input type="hidden" name="product_id" value="<?php echo $menproduct['id']; ?>">
                                <button type="submit" 
                                        class="w-full bg-rose-600 text-white py-2 px-3 text-sm uppercase tracking-wider hover:bg-rose-700 transition-colors">
                                    Buy Now
                                </button>
                            </form>
                            
                            <button onclick="addToCart(<?php echo $menproduct['id']; ?>)" 
                                    class="w-full bg-black text-white py-2 px-3 text-sm uppercase tracking-wider hover:bg-gray-800 transition-colors">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>


</body>
</html>