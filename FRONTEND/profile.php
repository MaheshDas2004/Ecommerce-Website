<?php
include '../Backend/config.php';

// Check if user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: Login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch orders with product details
$sql = "SELECT o.order_id, o.total_amount, o.payment_method, o.order_status, o.created_at,
               GROUP_CONCAT(p.title SEPARATOR ', ') AS products,
               COUNT(oi.product_id) AS item_count
        FROM orders o
        JOIN ordered_items oi ON o.order_id = oi.order_id
        JOIN products p ON oi.product_id = p.id
        WHERE o.user_id = ?
        GROUP BY o.order_id
        ORDER BY o.created_at DESC
        LIMIT 5";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$orders = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Fetch user details
$user_sql = "SELECT Name, Email FROM users WHERE Sno = ?";
$stmt = $conn->prepare($user_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user_result = $stmt->get_result();
$user = $user_result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Keep the head section the same -->
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
            <!-- Sidebar (Keep the sidebar the same) -->
            
            <!-- Main Content -->
            <main class="flex-grow min-w-[300px]">
                <!-- Profile Information Card -->
                    <div class="bg-white rounded-lg shadow-md p-8 mb-8 sm:p-5">
                        <div class="flex justify-between items-center mb-5">
                            <h3 class="text-xl font-semibold text-black relative pb-3 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-12 after:h-0.5 after:bg-soft-pink">Profile Information</h3>
                            
                        </div>
                        
                        <div class="flex flex-wrap mb-4">
                            <div class="w-38 font-medium text-gray-600 mr-5">Email</div>
                            <div class="flex-1 min-w-[200px] text-gray-800">
                                <?= htmlspecialchars($user['Email']) ?>
                            </div>
                        </div>

                        
                        <div class="flex flex-wrap mb-4">
                            <div class="w-38 font-medium text-gray-600 mr-5">Phone Number</div>
                            <div class="flex-1 min-w-[200px] text-gray-800">
                                <?= htmlspecialchars($user['phone'] ?? 'Not provided') ?>
                            </div>
                        </div>
                        <!-- Logout Button -->
                         <div class="flex justify-between mt-5">
                            <a href="update_profile.php" class="inline-block px-4 py-2 rounded border border-gray-800 text-gray-800 text-sm font-medium no-underline transition-all hover:bg-gray-800 hover:text-white mr-3">
                                Update Profile
                            </a>
                            
                            <a href="change_password.php" class="inline-block px-4 py-2 rounded border border-gray-800 text-gray-800 text-sm font-medium no-underline transition-all hover:bg-gray-800 hover:text-white mr-3">
                                Change Password
                            </a>
                         <a href="logout.php" class="inline-block px-4 py-2 rounded bg-soft-pink text-white text-sm font-medium no-underline transition-all bg-gray-800 hover:text-white">
                                Logout
                            </a>
                         </div>
                        
                    </div>
                
                <!-- Recent Orders Card -->
                <div class="bg-white rounded-lg shadow-md p-8 mb-8 sm:p-5">
                    <h3 class="text-xl font-semibold mb-5 text-black relative pb-3 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-12 after:h-0.5 after:bg-soft-pink">Recent Orders</h3>
                    <?php if (empty($orders)): ?>
                        <p class="text-gray-600">No recent orders found.</p>
                    <?php else: ?>
                    <table class="w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="text-left py-4 px-3 font-medium text-gray-600 border-b border-gray-100">Order</th>
                                <th class="text-left py-4 px-3 font-medium text-gray-600 border-b border-gray-100">Items</th>
                                <th class="text-left py-4 px-3 font-medium text-gray-600 border-b border-gray-100 md:table-cell sm:hidden">Date</th>
                                <th class="text-left py-4 px-3 font-medium text-gray-600 border-b border-gray-100">Total</th>
                                <th class="text-left py-4 px-3 font-medium text-gray-600 border-b border-gray-100 sm:hidden md:table-cell">Status</th>
                                <th class="text-left py-4 px-3 font-medium text-gray-600 border-b border-gray-100">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($orders as $order): ?>
                                <tr>
                                    <td class="py-4 px-3 border-b border-gray-100 font-medium text-gray-800">
                                        #<?= htmlspecialchars($order['order_id']) ?>
                                    </td>
                                    <td class="py-4 px-3 border-b border-gray-100">
                                        <?= htmlspecialchars($order['item_count']) ?> items
                                    </td>
                                    <td class="py-4 px-3 border-b border-gray-100 md:table-cell sm:hidden">
                                        <?= date('M j, Y', strtotime($order['created_at'])) ?>
                                    </td>
                                    <td class="py-4 px-3 border-b border-gray-100">
                                        ₹<?= number_format($order['total_amount'], 2) ?>
                                    </td>
                                    <td class="py-4 px-3 border-b border-gray-100 sm:hidden md:table-cell">
                                        <span class="capitalize"><?= htmlspecialchars($order['order_status']) ?></span>
                                    </td>
                                    <td class="py-4 px-3 border-b border-gray-100">
                                        <a href="order_confirmation.php?order_id=<?= $order['order_id'] ?>" 
                                           class="inline-block px-4 py-2 rounded border border-gray-800 text-gray-800 text-sm font-medium no-underline transition-all hover:bg-gray-800 hover:text-white">
                                            View Details
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php endif; ?>
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
