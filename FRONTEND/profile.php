<?php
 include '../Backend/config.php';
 $user_id = $_SESSION['user_id'];
 $sql= "SELECT id, user_id ,product_id, order_status,created_at FROM orders WHERE user_id = $user_id ORDER BY created_at DESC LIMIT 5";
 $result = mysqli_query($conn, $sql);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    
    $orders =[];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $orders[] = $row;
        }
    }
?>

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
                        montserrat: ['Montserrat', 'sans-serif'],
                    },
                    colors: {
                        'soft-pink': '#FFE4E1',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-white text-gray-800 font-montserrat leading-relaxed">    
    <!-- Hero Section -->
    <section class="bg-soft-pink py-16 px-5 text-center">
        <h1 class="text-4xl font-semibold mb-5 text-black sm:text-3xl">My Account</h1>
        <p class="max-w-3xl mx-auto text-gray-600 leading-relaxed text-base sm:text-sm">
            Manage your account details, view your orders, and update your preferences all in one place.
        </p>
    </section>
    
    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-5 py-10">
        <div class="flex flex-wrap gap-8 mb-12 md:flex-col">
            <!-- Sidebar -->
            <aside class="flex-1 min-w-[280px] bg-white rounded-lg shadow-md p-8 h-fit">
                <div class="w-32 h-32 rounded-full bg-gray-100 mx-auto mb-5 flex items-center justify-center overflow-hidden">
                    <div class="w-20 h-20 rounded-full bg-gray-300 relative">
                        <div class="absolute w-3/5 h-2/5 rounded-full bg-gray-300 -top-1/4 left-1/5"></div>
                    </div>
                </div>
                
                <h2 class="text-xl font-semibold text-center mb-8"><?php 
                    if (isset($_SESSION['email'])) {
                        $sql= "SELECT name FROM users WHERE Email = ?";
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_bind_param($stmt, "s", $_SESSION['email']);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        if ($result && mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            echo htmlspecialchars($row['name']);
                        } else {
                            echo "User";
                        }
                    }
                ?></h2>
                
                <ul class="list-none">
                    <li class="mb-4 pb-4 border-b border-gray-100 last:border-b-0 last:mb-0 last:pb-0">
                        <a href="#" class="flex items-center justify-between no-underline text-gray-800 font-medium transition hover:text-gray-500">
                            <span>Account Overview</span>
                            <span class="text-sm transition-transform group-hover:translate-x-1">›</span>
                        </a>
                    </li>
                    <li class="mb-4 pb-4 border-b border-gray-100 last:border-b-0 last:mb-0 last:pb-0">
                        <a href="#" class="flex items-center justify-between no-underline text-gray-800 font-medium transition hover:text-gray-500">
                            <span>Orders</span>
                            <span class="text-sm transition-transform group-hover:translate-x-1">›</span>
                        </a>
                    </li>
                    <li class="mb-4 pb-4 border-b border-gray-100 last:border-b-0 last:mb-0 last:pb-0">
                        <a href="#" class="flex items-center justify-between no-underline text-gray-800 font-medium transition hover:text-gray-500">
                            <span>Address Book</span>
                            <span class="text-sm transition-transform group-hover:translate-x-1">›</span>
                        </a>
                    </li>
                    <li class="mb-4 pb-4 border-b border-gray-100 last:border-b-0 last:mb-0 last:pb-0">
                        <a href="#" class="flex items-center justify-between no-underline text-gray-800 font-medium transition hover:text-gray-500">
                            <span>Account Settings</span>
                            <span class="text-sm transition-transform group-hover:translate-x-1">›</span>
                        </a>
                    </li>
                    <li class="mb-4 pb-4 border-b border-gray-100 last:border-b-0 last:mb-0 last:pb-0">
                        <a href="#" class="flex items-center justify-between no-underline text-gray-800 font-medium transition hover:text-gray-500">
                            <span>Coupons</span>
                            <span class="text-sm transition-transform group-hover:translate-x-1">›</span>
                        </a>
                    </li>
                    <li class="mb-4 pb-4 border-b border-gray-100 last:border-b-0 last:mb-0 last:pb-0">
                        <a href="#" class="flex items-center justify-between no-underline text-gray-800 font-medium transition hover:text-gray-500">
                            <span>Reviews & Ratings</span>
                            <span class="text-sm transition-transform group-hover:translate-x-1">›</span>
                        </a>
                    </li>
                    <li class="mb-4 pb-4 border-b border-gray-100 last:border-b-0 last:mb-0 last:pb-0">
                        <a href="#" class="flex items-center justify-between no-underline text-gray-800 font-medium transition hover:text-gray-500">
                            <span>Help & Support</span>
                            <span class="text-sm transition-transform group-hover:translate-x-1">›</span>
                        </a>
                    </li>
                    <li class="mt-8">
                        <a href="Logout.php" class="flex items-center justify-center no-underline bg-gray-800 text-white py-3 px-4 rounded transition hover:bg-gray-700">
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </aside>
            
            <!-- Main Content -->
            <main class="flex-grow min-w-[300px]">
                <!-- Profile Information Card -->
                <div class="bg-white rounded-lg shadow-md p-8 mb-8 sm:p-5">
                    <h3 class="text-xl font-semibold mb-5 text-black relative pb-3 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-12 after:h-0.5 after:bg-soft-pink">Profile Information</h3>
                    
                    <div class="flex flex-wrap mb-4">
                        <div class="w-38 font-medium text-gray-600 mr-5">Email</div>
                        <div class="flex-1 min-w-[200px] text-gray-800">
                            <?php echo $_SESSION['email']; ?>
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap mb-4">
                        <div class="w-38 font-medium text-gray-600 mr-5">Phone Number</div>
                        <div class="flex-1 min-w-[200px] text-gray-800">+1 234 567 8901</div>
                    </div>
                                    </div>
                
                <!-- Recent Orders Card -->
                <div class="bg-white rounded-lg shadow-md p-8 mb-8 sm:p-5">
                    <h3 class="text-xl font-semibold mb-5 text-black relative pb-3 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-12 after:h-0.5 after:bg-soft-pink">Recent Orders</h3>
                    
                    <table class="w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="text-left py-4 px-3 font-medium text-gray-600 border-b border-gray-100">Order</th>
                                <th class="text-left py-4 px-3 font-medium text-gray-600 border-b border-gray-100 md:table-cell sm:hidden">Date</th>
                                <th class="text-left py-4 px-3 font-medium text-gray-600 border-b border-gray-100 sm:hidden md:table-cell">Status</th>
                                <th class="text-left py-4 px-3 font-medium text-gray-600 border-b border-gray-100">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($orders as $order){ ?>
                                <tr>
                                <td class="py-4 px-3 border-b border-gray-100 font-medium text-gray-800">Order: <?php echo $order['id']?></td>
                                <td class="py-4 px-3 border-b border-gray-100 md:table-cell sm:hidden">
                                    <?php echo date('j M Y', strtotime($order['created_at'])); ?>
                                </td>

                                <td class="py-4 px-3 border-b border-gray-100 sm:hidden md:table-cell">
                                    <?php echo $order['order_status']; ?>
                                </td>
                                <td class="py-4 px-3 border-b border-gray-100">
                                    <form action="">
                                        <input type="hidden" name="order_id" value="<?php echo $order['id']?>">
                                        <input type="hidden" name="user_id" value="<?php echo $user_id?>">
                                        <button action="" class="inline-block px-4 py-2 rounded border border-gray-800 text-gray-800 text-sm font-medium no-underline transition-all hover:bg-gray-800 hover:text-white">
                                        View Order
                                    </button>
                                    </form>
                                    
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="bg-soft-pink py-8 px-5 text-center mt-12">
        <p class="text-gray-600 text-sm">© 2025 VEYRA.co All Rights Reserved.</p>
    </footer>
    
    <script>
        document.querySelectorAll('a[href="#"]').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                console.log('Link clicked:', e.target.textContent);
            });
        });
    </script>
</body>
</html>