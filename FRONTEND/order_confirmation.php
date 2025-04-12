<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    header("location: Login.php");
    exit;
}

// Include config file
require_once "../Backend/config.php";  // Adjust this path if needed

// Make sure we have a valid user ID
$user_id = isset($_SESSION["id"]) ? $_SESSION["id"] : 
          (isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : null);

// If no user ID is found, redirect to login
if ($user_id === null) {
    header("location: login.php");
    exit;
}

// Define variables
$order_id = "";
$order = [];
$product = [];

// Get the order details


// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - Your E-commerce Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-800">Order Confirmed!</h1>
                <p class="text-gray-600 mt-2">Thank you for your purchase. Your order has been received and is being processed.</p>
            </div>
            
            <div class="border-t border-b border-gray-200 py-4 mb-6">
                <div class="flex justify-between mb-2">
                    <span class="text-gray-600">Order ID:</span>
                    <span class="font-medium">#<?php echo htmlspecialchars($order_id); ?></span>
                </div>
                <div class="flex justify-between mb-2">
                    <span class="text-gray-600">Product:</span>
                    <span class="font-medium"><?php echo htmlspecialchars($product["title"]); ?></span>
                </div>
                <div class="flex justify-between mb-2">
                    <span class="text-gray-600">Price:</span>
                    <span class="font-medium">₹<?php echo htmlspecialchars($order["total_price"]); ?></span>
                </div>
                <div class="flex justify-between mb-2">
                    <span class="text-gray-600">Payment Method:</span>
                    <span class="font-medium"><?php echo htmlspecialchars(strtoupper($order["payment_method"])); ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Order Status:</span>
                    <span class="font-medium uppercase"><?php echo htmlspecialchars($order["order_status"]); ?></span>
                </div>
            </div>
            
            <div class="mb-6">
                <h2 class="font-semibold text-lg mb-2">Shipping Address</h2>
                <p class="text-gray-700 whitespace-pre-line"><?php echo htmlspecialchars($order["address"]); ?></p>
            </div>
            
            <div class="text-center">
                <a href="index.php?page=shop" class="inline-block bg-indigo-500 hover:bg-indigo-600 text-white py-2 px-6 rounded transition-colors">Continue Shopping</a>
            </div>
        </div>
    </div>
</body>
</html>