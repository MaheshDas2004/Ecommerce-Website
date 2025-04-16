<?php
session_start();
include '../Backend/config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>veyra-navbar</title>
  <link rel="stylesheet" href="./output.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
  @import url('https://fonts.googleapis.com/css2?family=Amarante&family=Anton&family=Creepster&family=Dancing+Script:wght@400..700&family=Marcellus&family=Pacifico&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Rubik+Wet+Paint&display=swap');
  #t1 {
    font-family: "Marcellus", serif;
    font-style: normal;
    font-weight: 600;
  }
  </style>
</head>
<body class="pt-20">
<header class="fixed top-0 left-0 right-0 w-full bg-rose-50 shadow-xl border-0 z-50">
    <div class="container-fluid px-2 sm:px-3 md:px-4 py-4 flex justify-between items-center">
        <div id="t1" class="text-3xl font-bold tracking-wider ml-2 md:ml-4">VEYRA<sub>.co</sub></div>
        <button class="md:hidden flex items-center justify-center border border-gray-300 rounded p-2 mx-2" id="mobile-menu-button">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <nav class="hidden md:flex items-center space-x-4 lg:space-x-6">
            <div class="">
                <a href="index.php" class="text-gray-700 hover:text-black flex items-center">
                    HOME <i class="text-xs ml-1"></i>
                </a>
            </div>
            <div class="">
                <a href="index.php?page=shop" class="text-gray-700 hover:text-black flex items-center">
                    SHOP <i class="text-xs ml-1"></i>
                </a>
            </div>
            <div class="">
                <a href="index.php?page=blog" class="text-gray-700 hover:text-black flex items-center">
                    BLOG <i class="text-xs ml-1"></i>
                </a>
            </div>
            <div class="">
                <a href="index.php?page=contact" class="text-gray-700 hover:text-black flex items-center">
                    CONTACT <i class="text-xs ml-1"></i>
                </a>
            </div>
        </nav>
        <div class="flex items-center space-x-3 md:space-x-4 mr-2 md:mr-4">
            <?php
            if(!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)){
                // echo '<a href="Logout.php" class="hidden md:block text-gray-700 hover:text-black">LOGOUT</a>';
                echo '<a href="Login.php" class="hidden md:block text-gray-700 hover:text-black">LOGIN</a>';
            }
            ?>
            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                echo '<div class="bg-stone-100 rounded-xl border-2 border-stone-200 p-2 flex items-center">';
                echo '<a href="index.php?page=profile" class="text-gray-700 hover:text-black flex text-lg items-center" aria-label="Profile">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>';
                if (isset($_SESSION['email'])) {
                    include '../Backend/config.php';
                    $email = $_SESSION['email'];
                    $sql = "SELECT Name FROM users WHERE Email = ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, "s", $email);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $name);
                        if (mysqli_stmt_fetch($stmt)) {
                            $initial="";
                            $word=explode(" ", $name);
                            foreach($word as $w) {
                                $initial .= $w[0];
                            }
                            echo " " . $initial;

                        } else {
                            echo " User";
                        }
                        mysqli_stmt_close($stmt);
                    } else {
                        echo " User";
                    }
                } else {
                    echo " User";
                }
                echo '</a>';
                echo '</div>';
            }
            ?>
            <?php
                if((isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)){
                    echo '<a href="index.php?page=cart" class="text-gray-700 hover:text-black flex text-xl items-center" aria-label="Cart">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>';
                    echo'</a>';
                }
                else{
                    echo '<a href="Login.php" class="text-gray-700 hover:text-black flex text-xl items-center" aria-label="Cart">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>';
                    echo'</a>';

                }
            ?>
            <a href="#" class="text-gray-700 hover:text-black" aria-label="Search" id="search-toggle">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </a>
        </div>
        <div id="mobile-menu" class="hidden absolute top-16 left-0 right-0 bg-white shadow-md w-full md:hidden z-50">
            <nav class="flex flex-col py-3">
                <a href="index.php" class="text-gray-700 hover:text-black py-2 px-4">HOME</a>
                <a href="index.php?page=shop" class="text-gray-700 hover:text-black py-2 px-4">SHOP</a>
                <a href="index.php?page=blog" class="text-gray-700 hover:text-black py-2 px-4">BLOG</a>
                <a href="index.php?page=contact" class="text-gray-700 hover:text-black py-2 px-4">CONTACT</a>
            </nav>
        </div>
    </div>
</header>
<div id="search-overlay" class="fixed inset-0 bg-white z-50 transform translate-y-full transition-transform duration-500 ease-in-out">
    <div class="container mx-auto px-4 h-full flex flex-col">
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
        <button id="close-search" class="absolute top-4 right-4 p-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }
        const searchToggle = document.getElementById('search-toggle');
        const searchOverlay = document.getElementById('search-overlay');
        const closeSearch = document.getElementById('close-search');
        if (searchToggle && searchOverlay && closeSearch) {
            searchToggle.addEventListener('click', function(e) {
                e.preventDefault();
                document.body.style.overflow = 'hidden';
                searchOverlay.classList.remove('translate-y-full');
                searchOverlay.querySelector('input').focus();
            });
            closeSearch.addEventListener('click', function() {
                searchOverlay.classList.add('translate-y-full');
                document.body.style.overflow = '';
                setTimeout(function() {
                    searchToggle.focus();
                }, 500);
            });
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !searchOverlay.classList.contains('translate-y-full')) {
                    closeSearch.click();
                }
            });
        }
    });
</script>
</body>
</html>