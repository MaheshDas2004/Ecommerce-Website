<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./output.css">
    <style>
  @import url('https://fonts.googleapis.com/css2?family=Amarante&family=Anton&family=Creepster&family=Dancing+Script:wght@400..700&family=Marcellus&family=Pacifico&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Rubik+Wet+Paint&display=swap');
  #t2{
    font-family: "Marcellus", serif;

    font-style: normal;
    font-weight: 600;
  }
  .product-card:hover .hover-options {
      opacity: 1;
    }
    
    .product-card .hover-options {
      opacity: 0;
      transition: opacity 0.3s ease;
    }
    
    .arrow-btn {
      top: 40%;
      transform: translateY(-50%);
    }
  </style>
</head>
<body>
    <div class=" bg-rose-100 p-16 text-center">
        <h1 id="t2" class="text-5xl mb-8 font-sans">New Collections</h1>
        <p class="max-w-2xl mx-auto text-gray-500 px-4">
            Discover the latest trends in our new collection. From stylish apparel to must-have accessories, find everything you need to elevate your wardrobe. Shop now and redefine your style with our exclusive range!
        </p>
    </div>
    <div class="bg-cream">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-4"></div>

        </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between items-center px-4 md:px-20 py-10 space-y-8 md:space-y-0">
        <!-- Book An Appointment -->
        <div class="text-center w-full md:w-1/4 mx-4">
            <div class="flex justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <h1 id="t2" class="text-xl font-bold mb-2">Book An Appointment</h1>
            <p class="text-gray-500 text-sm">At imperdiet dui accumsan sit amet nulla risus est ultricies quis.</p>
        </div>

        <!-- Pick Up In Store -->
        <div class="text-center w-full md:w-1/4 mx-4">
            <div class="flex justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
            </div>
            <h1 class="text-xl font-bold mb-2">Pick Up In Store</h1>
            <p class="text-gray-500 text-sm">At imperdiet dui accumsan sit amet nulla risus est ultricies quis.</p>
        </div>

        <!-- Special Packaging -->
        <div class="text-center w-full md:w-1/4 mx-4">
            <div class="flex justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10" />
                </svg>
            </div>
            <h1 class="text-xl font-bold mb-2">Special Packaging</h1>
            <p class="text-gray-500 text-sm">At imperdiet dui accumsan sit amet nulla risus est ultricies quis.</p>
        </div>

        <!-- Free Global Returns -->
        <div class="text-center w-full md:w-1/4 mx-4">
            <div class="flex justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
            </div>
            <h1 class="text-xl font-bold mb-2">Free Global Returns</h1>
            <p class="text-gray-500 text-sm">At imperdiet dui accumsan sit amet nulla risus est ultricies quis.</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between gap-6 p-6 md:p-8">
        <div class="group cursor-pointer text-center">
            <div class="overflow-hidden mb-3">
                <img 
                src="./photos/cat-item1.jpg" 
                alt="Men's Fashion" 
                class="w-full transition-transform duration-500 group-hover:scale-95"
                >
            </div>
            <p class="uppercase text-gray-500 tracking-wider text-sm md:text-base font-light">Shop for men</p>
        </div>
    
        <div class="group cursor-pointer text-center">
            <div class="overflow-hidden mb-3">
                <img 
                src="./photos/cat-item2.jpg" 
                alt="Women's Fashion" 
                class="w-full transition-transform duration-500 group-hover:scale-95"
                >
            </div>
            <p class="uppercase text-gray-500 tracking-wider text-sm md:text-base font-light">Shop for women</p>
        </div>
    
        <div class="group cursor-pointer text-center">
            <div class="overflow-hidden mb-3">
                <img 
                src="./photos/cat-item3.jpg" 
                alt="Accessories" 
                class="w-full transition-transform duration-500 group-hover:scale-95"
                >
            </div>
            <p class="uppercase text-gray-500 tracking-wider text-sm md:text-base font-light">Shop accessories</p>
        </div>
    </div>

    
<div class="bg-white font-serif">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold tracking-wide text-gray-900">OUR NEW ARRIVALS</h2>
            <a href="#" class="uppercase text-sm tracking-wider text-gray-700 hover:underline">View all products</a>
        </div>
        
        <!-- Product Carousel -->
        <div class="relative">
            <!-- Left Arrow -->
            <button class="arrow-btn absolute left-0 z-10 bg-white bg-opacity-70 w-10 h-10 rounded-full flex items-center justify-center shadow-md hover:bg-opacity-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            
            <!-- Products Grid -->
            <div id="products-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                <!-- Products will be inserted here via JavaScript -->
            </div>
            
            <!-- Right Arrow -->
            <button class="arrow-btn absolute right-0 z-10 bg-white bg-opacity-70 w-10 h-10 rounded-full flex items-center justify-center shadow-md hover:bg-opacity-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
</div>
<script>
        // Product data
        const products = [
            {
                id: 1,
                name: "DARK FLORISH ONEPIECE",
                price: null, // No price displayed, only "ADD TO CART"
                image: "https://images.unsplash.com/photo-1621184455862-c163dfb30e0f?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60",
                addToCart: true
            },
            {
                id: 2,
                name: "BAGGY SHIRT",
                price: 55.00,
                image: "https://images.unsplash.com/photo-1618244972963-dbee1a7edc95?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
            },
            {
                id: 3,
                name: "COTTON OFF-WHITE SHIRT",
                price: 65.00,
                image: "https://images.unsplash.com/photo-1622445275576-721325763afe?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
            },
            {
                id: 4,
                name: "CROP SWEATER",
                price: 50.00,
                image: "https://images.unsplash.com/photo-1519058082700-08a0b56da9b4?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
            },
            // Add more products if needed for carousel functionality
            {
                id: 5,
                name: "SUMMER DRESS",
                price: 75.00,
                image: "https://images.unsplash.com/photo-1583846783214-7229a91b20ed?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
            },
            {
                id: 6,
                name: "CASUAL BLAZER",
                price: 95.00,
                image: "https://images.unsplash.com/photo-1611312449408-fcece27cdbb7?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
            }
        ];
        
        // Display products function
        function displayProducts(startIndex = 0) {
            const container = document.getElementById('products-container');
            container.innerHTML = '';
            
            // Display 4 products starting from startIndex
            for (let i = startIndex; i < startIndex + 4; i++) {
                const index = i % products.length; // Cycle through products if needed
                const product = products[index];
                
                const productCard = document.createElement('div');
                productCard.className = 'product-card relative';
                
                // Product image and hover options
                productCard.innerHTML = `
                    <div class="relative overflow-hidden group">
                        <img src="${product.image}" alt="${product.name}" class="w-full h-96 object-cover">
                        
                        <!-- Hover Options -->
                        <div class="hover-options absolute top-4 right-4 flex flex-col gap-2">
                            <button class="bg-white p-2 rounded-full shadow-md hover:bg-gray-100 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Product Info -->
                    <div class="mt-4">
                        <h3 class="text-lg font-medium text-gray-900">${product.name}</h3>
                        <p class="mt-1 text-gray-700 group-hover:hidden">$${product.price ? product.price.toFixed(2) : ''}</p>
                        <div class="hidden group-hover:block">
                            <button class="mt-1 text-sm font-medium text-gray-700 uppercase tracking-wider hover:text-black">ADD TO CART</button>
                            <button class="mt-1 text-sm font-medium text-gray-700 uppercase tracking-wider hover:text-black">WISHLIST</button>
                        </div>
                    </div>
                `;
                
                container.appendChild(productCard);
            }
        }
        
        // Initialize with first 4 products
        displayProducts(0);
        
        // Set up carousel navigation
        let currentIndex = 0;
        const prevButton = document.querySelector('.arrow-btn:first-child');
        const nextButton = document.querySelector('.arrow-btn:last-child');
        
        prevButton.addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + products.length) % products.length;
            displayProducts(currentIndex);
        });
        
        nextButton.addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % products.length;
            displayProducts(currentIndex);
        });
    </script>    
</body>
</html>