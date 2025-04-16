<?php
include '../Backend/config.php';

$userHasOrders = false;
$recommendedProducts = [];

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    
    try {
        // Check if user has any orders using orders table
        $stmt = $conn->prepare("SELECT COUNT(*) AS order_count FROM orders WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $orderCount = $row['order_count'];
        $stmt->close();
        
        if ($orderCount > 0) {
            $userHasOrders = true;
            
            // Get latest order's products through ordered_items
            $stmt = $conn->prepare("
                SELECT p.category 
                FROM ordered_items oi
                JOIN products p ON oi.product_id = p.id
                WHERE oi.order_id = (
                    SELECT order_id FROM orders 
                    WHERE user_id = ? 
                    ORDER BY created_at DESC 
                    LIMIT 1
                )
                ORDER BY RAND() 
                LIMIT 1
            ");
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $category = $row['category'];
                $stmt->close();
                
                // Get recommended products excluding previously ordered items
                $stmt = $conn->prepare("
                    SELECT p.id, p.title, p.price, p.image 
                    FROM products p
                    WHERE p.category = ? 
                    AND p.id NOT IN (
                        SELECT product_id FROM ordered_items
                        JOIN orders ON ordered_items.order_id = orders.order_id
                        WHERE orders.user_id = ?
                    )
                    ORDER BY RAND() 
                    LIMIT 4
                ");
                $stmt->bind_param("si", $category, $userId);
                $stmt->execute();
                $recommendedProducts = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                $stmt->close();
            }
        }
    } catch (Exception $e) {
        error_log("Recommendation error: " . $e->getMessage());
        $recommendedProducts = []; // Fallback to empty array
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion Store Dashboard</title>
    <link rel="stylesheet" href="./output.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Amarante&family=Anton&family=Creepster&family=Dancing+Script:wght@400..700&family=Marcellus&family=Pacifico&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Rubik+Wet+Paint&display=swap');
        #t2{
            font-family: "Marcellus", serif;
            font-style: normal;
            font-weight: 600;
        }
        .arrow-btn {
            top: 40%;
            transform: translateY(-50%);
        }
    </style>
</head>
<body class="">
    <div class="bg-rose-100 p-16 mt-20 text-center">
        <h1 id="t2" class="text-5xl mb-8 font-sans">New Collections</h1>
        <p class="max-w-2xl mx-auto text-gray-500 px-4">
            Discover the latest trends in our new collection. From stylish apparel to must-have accessories, find everything you need to elevate your wardrobe. Shop now and redefine your style with our exclusive range!
        </p>
    </div>
    <div id="recommended-products" class="bg-white  px-4 md:px-8 lg:px-4 container mx-auto py-8" style="<?= $userHasOrders ? '' : 'display: none;' ?>">
    <div class="max-w-full mx-auto">
        <!-- Section Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 id="t2" class="text-3xl font-bold tracking-wide text-gray-900">RECOMMENDED FOR YOU</h2>
            <a href="index.php?page=shop" class="uppercase text-sm tracking-wider text-gray-700 hover:underline">View all</a>
        </div>

        <!-- Recommended Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php foreach($recommendedProducts as $recm) { ?>
    
            <div class="p-4">
                <div class="mb-4">
                    <img src="<?= $recm['image'] ?>" alt="<?= $recm['title'] ?>" 
                        class="w-full h-64 md:h-80 object-cover">
                </div>
                
                <h3 class="text-sm font-medium text-gray-800 mb-1 line-clamp-2 h-10">
                    <a href="product.php?id=<?= $recm['id'] ?>" class="hover:text-blue-600 transition-colors">
                        <?= $recm['title'] ?>
                    </a>
                </h3>
                
                <div class="flex flex-col space-y-2 mt-2">
                    <!-- Price Display -->
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-bold text-gray-900">
                            ₹<?= number_format($recm['price'], 2) ?>
                        </span>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex space-x-2">
                        <form action="Payment.php" class="w-full">
                            <input type="hidden" name="product_id" value="<?= $recm['id'] ?>">
                            <button type="submit" 
                                    class="w-full bg-rose-600 text-white py-2 px-3 text-sm uppercase tracking-wider hover:bg-rose-700 transition-colors">
                                Buy Now
                            </button>
                        </form>
                        <form action="Addtocart.php" class="w-full" method="post">
                            <input type="hidden" name="product_id" value="<?= $recm['id'] ?>">
                            <input type="hidden" name="quantity" value="1" min="1">
                            <button type="submit" 
                                    class="w-full bg-black text-white py-2 px-3 text-sm uppercase tracking-wider hover:bg-gray-800 transition-colors">
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
    

    
    <div class="flex flex-col md:flex-row justify-between items-center px-4 md:px-20 py-10 space-y-8 md:space-y-0" style="<?= $userHasOrders ? 'display: none;' : '' ?>">
        <!-- Book An Appointment -->
        <div class="text-center w-full md:w-1/4 mx-4">
            <div class="flex justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <h1 id="t2" class="text-xl font-bold mb-2">Book An Appointment</h1>
            <p class="text-gray-500 text-sm">Discover a seamless shopping experience tailored to your needs. Schedule a personalized session with our fashion experts today!</p>
        </div>

        <!-- Pick Up In Store -->
        <div class="text-center w-full md:w-1/4 mx-4">
            <div class="flex justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
            </div>
            <h1 class="text-xl font-bold mb-2">Pick Up In Store</h1>
            <p class="text-gray-500 text-sm">Enjoy the convenience of picking up your curated fashion pieces at your nearest store. Shop effortlessly today!</p>
        </div>

        <!-- Special Packaging -->
        <div class="text-center w-full md:w-1/4 mx-4">
            <div class="flex justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10" />
                </svg>
            </div>
            <h1 class="text-xl font-bold mb-2">Special Packaging</h1>
            <p class="text-gray-500 text-sm">Make your gifts unforgettable with our exclusive packaging options. Perfect for every special occasion!</p>
        </div>

        <!-- Free Global Returns -->
        <div class="text-center w-full md:w-1/4 mx-4">
            <div class="flex justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
            </div>
            <h1 class="text-xl font-bold mb-2">Free Global Returns</h1>
            <p class="text-gray-500 text-sm">Shop with confidence knowing you can return your fashion finds effortlessly, no matter where you are!</p>
        </div>
    </div>


    <!-- Shop Categories Section -->
    <div class="bg-rose-50">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between gap-6 p-6 md:p-8">
            <div class="group cursor-pointer text-center">
                <a href="index.php?page=men">
                    <div class="overflow-hidden mb-3">
                        <img 
                        src="./photos/cat-item1.jpg" 
                        alt="Men's Fashion" 
                        class="w-full transition-transform duration-500 group-hover:scale-95"
                        >
                    </div>
                    <p class="uppercase text-gray-500 tracking-wider text-sm md:text-base font-light">Shop for men</p>
                </a>
            </div>
        
            <div class="group cursor-pointer text-center">
                <a href="index.php?page=women">
                    <div class="overflow-hidden mb-3">
                        <img 
                        src="./photos/cat-item2.jpg" 
                        alt="Women's Fashion" 
                        class="w-full transition-transform duration-500 group-hover:scale-95"
                        >
                    </div>
                    <p class="uppercase text-gray-500 tracking-wider text-sm md:text-base font-bold">Shop for women</p>
                </a>
            </div>
        
            <div class="group cursor-pointer text-center">
                <a href="index.php?page=accessories">
                    <div class="overflow-hidden mb-3">
                        <img 
                        src="./photos/cat-item3.jpg" 
                        alt="Accessories" 
                        class="w-full transition-transform duration-500 group-hover:scale-95"
                        >
                    </div>
                    <p class="uppercase text-gray-500 tracking-wider text-sm md:text-base font-light">Shop accessories</p>
                </a>
            </div>
        </div>
    </div>
    
    <!-- New Arrivals Section -->
    <div class="font-serif">
        <div class="container mx-auto px-4 py-8">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold tracking-wide text-gray-900">OUR NEW ARRIVALS</h2>
                <a href="index.php?page=shop" class="uppercase text-sm tracking-wider text-gray-700 hover:underline">View all products</a>
            </div>
        
            <!-- Product Carousel -->
            <div class="relative overflow-hidden">
                <!-- Left Arrow -->
                <button class="arrow-btn absolute left-0 top-1/2 z-10 bg-white bg-opacity-70 w-10 h-10 rounded-full flex items-center justify-center shadow-md hover:bg-opacity-100 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
            
                <!-- Products Grid -->
                <div class="carousel-container overflow-hidden">
                    <div id="products-container" class="flex transition-transform duration-500 ease-in-out">
                        <!-- Products will be inserted here via JavaScript -->
                    </div>
                </div>
            
                <!-- Right Arrow -->
                <button class="arrow-btn absolute right-0 top-1/2 z-10 bg-white bg-opacity-70 w-10 h-10 rounded-full flex items-center justify-center shadow-md hover:bg-opacity-100 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Winter Collection Banner -->
    <div class="bg-gray-200 pt-10">
        <div class="container mx-auto max-w-7xl px-4 md:px-6 py-8">
            <div class="flex flex-col md:flex-row bg-white overflow-hidden">
                <!-- Left side - Image -->
                <div class="w-full md:w-1/2">
                    <img src="./photos/single-image-2.jpg" alt="Classic Winter Collection" class="w-full h-full object-cover" />
                </div>
                
                <!-- Right side - Content -->
                <div class="w-full md:w-1/2 p-8 md:p-16 flex flex-col justify-center">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6 tracking-wide">
                        CLASSIC WINTER<br />COLLECTION
                    </h1>
                    
                    <p class="text-gray-600 mb-8">
                        Embrace the warmth and elegance of our Classic Winter Collection. Designed to keep you cozy and stylish, each piece is crafted with premium materials and timeless designs. Elevate your winter wardrobe with our exclusive range, perfect for every occasion.
                    </p>
                    
                    <div>
                        <button 
                            onclick="window.location.href='index.php?page=collection&id=winter'" 
                            class="bg-black text-white px-8 py-3 uppercase font-medium tracking-wide hover:bg-gray-800 transition duration-300">
                            Shop Collection
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-gradient-to-r from-gray-200 to-pink-900 py-16 mb-16">
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
    </div>
    <script>
        // Product data
        const products = [
            {
                id:1,
                name: "DARK FLORISH ONEPIECE",
                price: 250.00,
                image: "https://images.unsplash.com/photo-1621184455862-c163dfb30e0f?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60",
                category: "women"
            },
            {
                id: 2,
                name: "BAGGY SHIRT",
                price: 55.00,
                image: "https://images.unsplash.com/photo-1618244972963-dbee1a7edc95?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60",
                category: "men"
            },
            {
                id: 3,
                name: "COTTON OFF-WHITE SHIRT",
                price: 65.00,
                image: "https://images.unsplash.com/photo-1622445275576-721325763afe?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60",
                category: "men"
            },
            {
                id: 4,
                name: "CROP SWEATER",
                price: 50.00,
                image: "https://images.unsplash.com/photo-1519058082700-08a0b56da9b4?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60",
                category: "women"
            },
            {
                id: 5,
                name: "SUMMER DRESS",
                price: 75.00,
                image: "https://images.unsplash.com/photo-1583846783214-7229a91b20ed?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60",
                category: "women"
            },
            {
                id: 6,
                name: "CASUAL BLAZER",
                price: 95.00,
                image: "https://images.unsplash.com/photo-1611312449408-fcece27cdbb7?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60",
                category: "men"
            }
        ];
        
        
        const userHasOrders = <?= $userHasOrders ? 'true' : 'false' ?>;
    const recommendedProducts = <?= json_encode($recommendedProducts) ?>;

    // Display New Arrivals products function (original)
    function displayProducts() {
        const container = document.getElementById('products-container');
        container.innerHTML = '';
        
        products.forEach(product => {
            const productCard = document.createElement('div');
            productCard.className = 'w-full sm:w-1/2 md:w-1/4 flex-shrink-0 px-2';
            
            productCard.innerHTML = `
                <div>
                    <img src="${product.image}" alt="${product.name}" 
                        class="w-full h-96 object-cover mb-4">
                    
                        <h3 class="text-lg font-medium text-gray-900">${product.name}</h3>
                        <div class="mt-2 mb-3">
                            <span class="text-gray-700">${product.price ? '$' + product.price.toFixed(2) : 'Contact for price'}</span>
                        </div>
                        <div class="flex space-x-2">
                        <form action="Payment.php" class="w-full"">
                            <input type="hidden" name="product_id" value="${product.id}">
                            <button type="submit" 
                                    class="w-full bg-rose-600 text-white py-2 px-3 text-sm uppercase tracking-wider hover:bg-rose-700 transition-colors">
                                Buy Now
                            </button>
                        </form>
                        <form class="w-full" action="Addtocart.php" method="post">
                            <input type="hidden" name="product_id" value="${product.id}">
                            <input type="hidden" name="quantity" value="1" min="1">
                        <button  class="w-full bg-black text-white py-2 px-3 text-sm uppercase tracking-wider hover:bg-gray-800 transition-colors">
                            Add to Cart
                        </button>
                        </form>
                        </div>
                </div>
            `;
            
            container.appendChild(productCard);
        });
    }


    // Original carousel logic
    let currentIndex = 0;
    const container = document.getElementById('products-container');
    const prevButton = document.querySelector('.arrow-btn:first-child');
    const nextButton = document.querySelector('.arrow-btn:last-child');

    function slideCarousel(direction) {
        const maxIndex = products.length - 4;
        
        if (direction === 'next') {
            currentIndex = Math.min(currentIndex + 1, maxIndex);
        } else {
            currentIndex = Math.max(currentIndex - 1, 0);
        }
        
        const offset = -(currentIndex * (100/4));
        container.style.transform = `translateX(${offset}%)`;
    }

    // Original event listeners
    prevButton.addEventListener('click', () => slideCarousel('prev'));
    nextButton.addEventListener('click', () => slideCarousel('next'));

    // Original responsive handling
    function updateCarousel() {
        const width = window.innerWidth;
        let itemsPerView;
        
        if (width < 640) {
            itemsPerView = 1;
        } else if (width < 768) {
            itemsPerView = 2;
        } else {
            itemsPerView = 4;
        }
    }

    // Initialization
    displayProducts();
    displayRecommendedProducts();
    window.addEventListener('resize', updateCarousel);
    updateCarousel();
        
    </script>    
</body>
</html>