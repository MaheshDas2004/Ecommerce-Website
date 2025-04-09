<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VEYRA.co - Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'montserrat': ['Montserrat', 'sans-serif'],
                    },
                    colors: {
                        'pink-light': '#FFE4E1',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-white text-gray-800 font-montserrat leading-relaxed">
    <header class="flex justify-between items-center px-12 py-5 bg-white shadow-sm sticky top-0 z-10 md:px-6 sm:px-4">
        <a href="#" class="text-2xl font-bold tracking-wide text-black no-underline">
            VEYRA<span class="text-base align-middle">.co</span>
        </a>
        
        <nav class="hidden md:flex gap-8 md:hidden">
            <a href="#" class="no-underline text-gray-700 font-medium text-sm tracking-wider hover:text-gray-400 transition-colors duration-300">HOME</a>
            <a href="#" class="no-underline text-gray-700 font-medium text-sm tracking-wider hover:text-gray-400 transition-colors duration-300">SHOP</a>
            <a href="#" class="no-underline text-gray-700 font-medium text-sm tracking-wider hover:text-gray-400 transition-colors duration-300">BLOG</a>
            <a href="#" class="no-underline text-gray-700 font-medium text-sm tracking-wider hover:text-gray-400 transition-colors duration-300">CONTACT</a>
        </nav>
        
        <div class="flex items-center gap-5 sm:gap-3">
            <a href="#" class="no-underline text-gray-700 font-medium text-sm tracking-wider">LOGIN</a>
            <div class="relative">
                <div class="w-6 h-6 border border-gray-700 rounded-full flex items-center justify-center text-xs font-medium text-gray-700">(0)</div>
            </div>
            <div class="text-lg cursor-pointer">⌕</div>
        </div>
    </header>
    
    <section class="bg-pink-light py-16 px-5 text-center">
        <h1 class="text-4xl font-semibold mb-5 text-black sm:text-3xl">My Account</h1>
        <p class="max-w-3xl mx-auto text-gray-600 leading-relaxed text-base sm:text-sm">
            Manage your account details, view your orders, and update your preferences all in one place.
        </p>
    </section>
    
    <div class="max-w-6xl mx-auto px-5 py-10">
        <div class="flex flex-wrap gap-8 mb-12 md:flex-col">
            <aside class="flex-1 min-w-[280px] bg-white rounded-lg shadow-md p-8 h-fit md:min-w-full">
                <div class="w-32 h-32 rounded-full bg-gray-100 mx-auto mb-5 flex items-center justify-center overflow-hidden">
                    <div class="w-[70px] h-[70px] rounded-full bg-gray-300 relative">
                        <div class="absolute w-3/5 h-2/5 rounded-full bg-gray-300 -top-1/4 left-1/5"></div>
                    </div>
                </div>
                
                <h2 class="text-xl font-semibold text-center mb-8">John Doe</h2>
                
                <ul class="list-none">
                    <li class="mb-4 pb-4 border-b border-gray-100">
                        <a href="#" class="flex items-center justify-between no-underline text-gray-700 font-medium hover:text-gray-400 transition-all duration-300">
                            <span>Account Overview</span>
                            <span class="text-sm transition-transform duration-300 group-hover:translate-x-1">›</span>
                        </a>
                    </li>
                    <li class="mb-4 pb-4 border-b border-gray-100">
                        <a href="#" class="flex items-center justify-between no-underline text-gray-700 font-medium hover:text-gray-400 transition-all duration-300">
                            <span>Orders</span>
                            <span class="text-sm transition-transform duration-300 group-hover:translate-x-1">›</span>
                        </a>
                    </li>
                    <li class="mb-4 pb-4 border-b border-gray-100">
                        <a href="#" class="flex items-center justify-between no-underline text-gray-700 font-medium hover:text-gray-400 transition-all duration-300">
                            <span>Address Book</span>
                            <span class="text-sm transition-transform duration-300 group-hover:translate-x-1">›</span>
                        </a>
                    </li>
                    <li class="mb-4 pb-4 border-b border-gray-100">
                        <a href="#" class="flex items-center justify-between no-underline text-gray-700 font-medium hover:text-gray-400 transition-all duration-300">
                            <span>Payment Methods</span>
                            <span class="text-sm transition-transform duration-300 group-hover:translate-x-1">›</span>
                        </a>
                    </li>
                    <li class="mb-4 pb-4 border-b border-gray-100">
                        <a href="#" class="flex items-center justify-between no-underline text-gray-700 font-medium hover:text-gray-400 transition-all duration-300">
                            <span>Wishlist</span>
                            <span class="text-sm transition-transform duration-300 group-hover:translate-x-1">›</span>
                        </a>
                    </li>
                    <li class="mb-4 pb-4 border-b border-gray-100">
                        <a href="#" class="flex items-center justify-between no-underline text-gray-700 font-medium hover:text-gray-400 transition-all duration-300">
                            <span>Account Settings</span>
                            <span class="text-sm transition-transform duration-300 group-hover:translate-x-1">›</span>
                        </a>
                    </li>
                    <li class="mb-4 pb-4 border-b border-gray-100">
                        <a href="#" class="flex items-center justify-between no-underline text-gray-700 font-medium hover:text-gray-400 transition-all duration-300">
                            <span>Coupons</span>
                            <span class="text-sm transition-transform duration-300 group-hover:translate-x-1">›</span>
                        </a>
                    </li>
                    <li class="mb-4 pb-4 border-b border-gray-100">
                        <a href="#" class="flex items-center justify-between no-underline text-gray-700 font-medium hover:text-gray-400 transition-all duration-300">
                            <span>Reviews & Ratings</span>
                            <span class="text-sm transition-transform duration-300 group-hover:translate-x-1">›</span>
                        </a>
                    </li>
                    <li class="mb-0">
                        <a href="#" class="flex items-center justify-between no-underline text-gray-700 font-medium hover:text-gray-400 transition-all duration-300">
                            <span>Help & Support</span>
                            <span class="text-sm transition-transform duration-300 group-hover:translate-x-1">›</span>
                        </a>
                    </li>
                </ul>
            </aside>
            
            <main class="flex-grow min-w-[300px]">
                <div class="bg-white rounded-lg shadow-md p-8 mb-8 sm:p-5">
                    <h3 class="text-xl font-semibold mb-5 text-black relative pb-2.5 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-12 after:h-0.5 after:bg-pink-light">
                        Profile Information
                    </h3>
                    
                    <div class="flex flex-wrap mb-4 sm:block">
                        <div class="w-[150px] font-medium text-gray-500 mr-5 sm:w-full sm:mb-1">Email</div>
                        <div class="flex-1 min-w-[200px] text-gray-700 sm:w-full">
                            john.doe@example.com
                            <a href="#" class="no-underline text-gray-400 text-sm ml-2.5 hover:text-gray-600 transition-colors duration-300">Edit</a>
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap mb-4 sm:block">
                        <div class="w-[150px] font-medium text-gray-500 mr-5 sm:w-full sm:mb-1">Phone Number</div>
                        <div class="flex-1 min-w-[200px] text-gray-700 sm:w-full">+1 234 567 8901</div>
                    </div>
                    
                    <div class="flex flex-wrap mb-4 sm:block">
                        <div class="w-[150px] font-medium text-gray-500 mr-5 sm:w-full sm:mb-1">Date of Birth</div>
                        <div class="flex-1 min-w-[200px] text-gray-700 sm:w-full">January 1, 1980</div>
                    </div>
                    
                    <a href="#" class="inline-block mt-5 no-underline text-gray-700 text-sm hover:text-gray-400 transition-colors duration-300">
                        Change password
                    </a>
                </div>
                
                <div class="bg-white rounded-lg shadow-md p-8 sm:p-5">
                    <h3 class="text-xl font-semibold mb-5 text-black relative pb-2.5 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-12 after:h-0.5 after:bg-pink-light">
                        Recent Orders
                    </h3>
                    
                    <table class="w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="text-left py-4 px-2.5 font-medium text-gray-500 border-b border-gray-100">Order</th>
                                <th class="text-left py-4 px-2.5 font-medium text-gray-500 border-b border-gray-100 sm:hidden">Date</th>
                                <th class="text-left py-4 px-2.5 font-medium text-gray-500 border-b border-gray-100 md:hidden">Status</th>
                                <th class="text-left py-4 px-2.5 font-medium text-gray-500 border-b border-gray-100">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-4 px-2.5 border-b border-gray-100 font-medium text-gray-700">Order #12345</td>
                                <td class="py-4 px-2.5 border-b border-gray-100 sm:hidden">April 20, 2024</td>
                                <td class="py-4 px-2.5 border-b border-gray-100 md:hidden">
                                    <span class="inline-block py-1 px-3 rounded-full bg-pink-light text-gray-700 text-xs font-medium">Processing</span>
                                </td>
                                <td class="py-4 px-2.5 border-b border-gray-100">
                                    <a href="#" class="inline-block py-2 px-4 rounded border border-gray-700 text-gray-700 text-sm font-medium no-underline hover:bg-gray-700 hover:text-white transition-all duration-300">View Order</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-4 px-2.5 border-b border-gray-100 font-medium text-gray-700">Order #12346</td>
                                <td class="py-4 px-2.5 border-b border-gray-100 sm:hidden">April 18, 2024</td>
                                <td class="py-4 px-2.5 border-b border-gray-100 md:hidden">
                                    <span class="inline-block py-1 px-3 rounded-full bg-pink-light text-gray-700 text-xs font-medium">Processing</span>
                                </td>
                                <td class="py-4 px-2.5 border-b border-gray-100">
                                    <a href="#" class="inline-block py-2 px-4 rounded border border-gray-700 text-gray-700 text-sm font-medium no-underline hover:bg-gray-700 hover:text-white transition-all duration-300">View Order</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-4 px-2.5 border-b border-gray-100 font-medium text-gray-700">Order #12347</td>
                                <td class="py-4 px-2.5 border-b border-gray-100 sm:hidden">April 15, 2024</td>
                                <td class="py-4 px-2.5 border-b border-gray-100 md:hidden">
                                    <span class="inline-block py-1 px-3 rounded-full bg-pink-light text-gray-700 text-xs font-medium">Processing</span>
                                </td>
                                <td class="py-4 px-2.5 border-b border-gray-100">
                                    <a href="#" class="inline-block py-2 px-4 rounded border border-gray-700 text-gray-700 text-sm font-medium no-underline hover:bg-gray-700 hover:text-white transition-all duration-300">View Order</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-4 px-2.5 font-medium text-gray-700">Order #12348</td>
                                <td class="py-4 px-2.5 sm:hidden">April 10, 2024</td>
                                <td class="py-4 px-2.5 md:hidden">
                                    <span class="inline-block py-1 px-3 rounded-full bg-pink-light text-gray-700 text-xs font-medium">Processing</span>
                                </td>
                                <td class="py-4 px-2.5">
                                    <a href="#" class="inline-block py-2 px-4 rounded border border-gray-700 text-gray-700 text-sm font-medium no-underline hover:bg-gray-700 hover:text-white transition-all duration-300">View Order</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
    
    <footer class="bg-pink-light py-8 px-5 text-center mt-12">
        <p class="text-gray-500 text-sm">© 2025 VEYRA.co All Rights Reserved.</p>
    </footer>
    
    <script>
        document.querySelectorAll('.flex.items-center.justify-between').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                console.log('Navigating to:', link.querySelector('span').textContent);
            });
        });
        
        document.querySelectorAll('a[href="#"].inline-block.py-2.px-4').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                console.log('Button clicked:', e.target.textContent);
            });
        });
        
        document.querySelector('a[href="#"].no-underline.text-gray-400').addEventListener('click', (e) => {
            e.preventDefault();
            console.log('Editing profile information');
        });
        
        document.querySelector('a[href="#"].inline-block.mt-5').addEventListener('click', (e) => {
            e.preventDefault();
            console.log('Changing password');
        });
        
        // Mobile responsive menu toggle functionality could be added here
    </script>
</body>
</html>