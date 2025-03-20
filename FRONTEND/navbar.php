<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./output.css">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<header class="w-full bg-white shadow-lg">
    <div class="container-fluid px-2 sm:px-3 md:px-4 py-4 flex justify-between items-center">
        <!-- Logo - moved closer to left edge -->
        <div class="text-3xl font-bold tracking-wider ml-2 md:ml-4">KAIRA</div>
        
        <!-- Mobile menu button - centered hamburger icon in a button -->
        <button class="md:hidden flex items-center justify-center border border-gray-300 rounded p-2 mx-2" id="mobile-menu-button">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        
        <!-- Navigation - only visible on larger screens -->
        <nav class="hidden md:flex items-center space-x-4 lg:space-x-6">
            <div class="group relative">
                <a href="#" class="text-gray-700 hover:text-black flex items-center">
                    HOME <i class="fas fa-chevron-down text-xs ml-1"></i>
                </a>
            </div>
            <div class="group relative">
                <a href="#" class="text-gray-700 hover:text-black flex items-center">
                    SHOP <i class="fas fa-chevron-down text-xs ml-1"></i>
                </a>
            </div>
            <div class="group relative">
                <a href="#" class="text-gray-700 hover:text-black flex items-center">
                    BLOG <i class="fas fa-chevron-down text-xs ml-1"></i>
                </a>
            </div>
            <div class="group relative">
                <a href="#" class="text-gray-700 hover:text-black flex items-center">
                    PAGES <i class="fas fa-chevron-down text-xs ml-1"></i>
                </a>
            </div>
            <a href="#" class="text-gray-700 hover:text-black">BLOG</a>
            <a href="#" class="text-gray-700 hover:text-black">CONTACT</a>
        </nav>
        
        <!-- User actions - moved closer to right edge -->
        <div class="flex items-center space-x-3 md:space-x-4 mr-2 md:mr-4">
            <a href="#" class="hidden md:block text-gray-700 hover:text-black">WISHLIST</a>
            <a href="#" class="text-gray-700 hover:text-black" aria-label="Wishlist">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
            </a>
            <a href="#" class="text-gray-700 hover:text-black" aria-label="Cart">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
            </a>
            <a href="#" class="text-gray-700 hover:text-black" aria-label="Search" id="search-toggle">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </a>

        </div>
        
        <!-- Mobile menu (hidden by default) -->
        <div id="mobile-menu" class="hidden absolute top-16 left-0 right-0 bg-white shadow-md w-full md:hidden z-50">
            <nav class="flex flex-col py-3">
                <a href="#" class="text-gray-700 hover:text-black py-2 px-4">HOME</a>
                <a href="#" class="text-gray-700 hover:text-black py-2 px-4">SHOP</a>
                <a href="#" class="text-gray-700 hover:text-black py-2 px-4">BLOG</a>
                <a href="#" class="text-gray-700 hover:text-black py-2 px-4">PAGES</a>
                <a href="#" class="text-gray-700 hover:text-black py-2 px-4">CONTACT</a>
                <a href="#" class="text-gray-700 hover:text-black py-2 px-4">WISHLIST</a>
            </nav>
        </div>
    </div>
</header>

<!-- Search overlay - hidden by default -->
<div id="search-overlay" class="fixed inset-0 bg-white z-50 transform translate-y-full transition-transform duration-500 ease-in-out">
    <div class="container mx-auto px-4 h-full flex flex-col">
        <!-- Search input area -->
        <div class="flex justify-center items-center py-16 md:py-24">
            <div class="w-full max-w-3xl relative">
                <input type="text" placeholder="Type and press enter" class="w-full px-4 py-3 text-xl border-b border-gray-300 focus:outline-none focus:border-black">
                <button class="absolute right-0 top-1/2 transform -translate-y-1/2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Categories section -->
        <div class="text-center mt-8">
            <h3 class="uppercase text-sm tracking-wider text-gray-500 mb-6">Browse Categories</h3>
            <div class="text-2xl md:text-3xl space-x-2 md:space-x-4">
                <a href="#" class="inline-block">Jackets</a>
                <span class="text-gray-300">/</span>
                <a href="#" class="inline-block">T-shirts</a>
                <span class="text-gray-300">/</span>
                <a href="#" class="inline-block">Handbags</a>
                <span class="text-gray-300">/</span>
                <a href="#" class="inline-block">Accessories</a>
                <span class="text-gray-300">/</span>
            </div>
            <div class="text-2xl md:text-3xl space-x-2 md:space-x-4 mt-4">
                <a href="#" class="inline-block">Cosmetics</a>
                <span class="text-gray-300">/</span>
                <a href="#" class="inline-block">Dresses</a>
                <span class="text-gray-300">/</span>
                <a href="#" class="inline-block">Jumpsuits</a>
            </div>
        </div>
        
        <!-- Close button -->
        <button id="close-search" class="absolute top-4 right-4 p-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchToggle = document.getElementById('search-toggle');
        const searchOverlay = document.getElementById('search-overlay');
        const closeSearch = document.getElementById('close-search');
        
        // Open search overlay with smooth transition
        searchToggle.addEventListener('click', function(e) {
            e.preventDefault();
            document.body.style.overflow = 'hidden'; // Prevent scrolling
            searchOverlay.classList.remove('translate-y-full');
            searchOverlay.querySelector('input').focus();
        });
        
        // Close search overlay
        closeSearch.addEventListener('click', function() {
            searchOverlay.classList.add('translate-y-full');
            document.body.style.overflow = '';
            
            // Wait for transition to complete before focusing back
            setTimeout(function() {
                searchToggle.focus();
            }, 500);
        });
        
        // Close on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !searchOverlay.classList.contains('translate-y-full')) {
                closeSearch.click();
            }
        });
    });
</script>

  
</body>
</html>