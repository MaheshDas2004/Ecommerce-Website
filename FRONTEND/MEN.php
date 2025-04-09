<?php
  include '../BACKEND/config.php';
  $sql = "SELECT id, title, price, description, category, image, rating_rate, rating_count FROM products WHERE category = 'men\'s clothing'";
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
                        <?php echo formatRating($menproduct['rating_rate'], $menproduct['rating_count']); ?>
                    </div>
                    <h3 class="text-sm font-medium text-gray-800 mb-1 line-clamp-2 h-10">
                        <a href="product.php?id=<?php echo $menproduct['id']; ?>" class="hover:text-rose-600 transition-colors">
                            <?php echo $menproduct['title']; ?>
                        </a>
                    </h3>
                    <div class="flex justify-between items-center mt-2">
                        <span class="text-gray-900 font-semibold">
                            $<?php echo number_format($menproduct['price'], 2); ?>
                        </span>
                        <button class="bg-rose-500 hover:bg-rose-600 text-white px-3 py-1 rounded-full text-xs transition-colors">
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>

</body>
</html>