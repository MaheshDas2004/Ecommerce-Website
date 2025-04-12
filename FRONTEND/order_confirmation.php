<?php
// Initialize the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Include config file
require_once "../Backend/config.php";

// Check if order ID exists in URL
if (!isset($_GET['order_id']) || empty($_GET['order_id'])) {
    header("location: index.php");
    exit;
}

$order_id = trim($_GET['order_id']);
$user_id = $_SESSION['user_id'];

try {
    // Get order details
    $sql = "SELECT o.*, 
                   GROUP_CONCAT(p.title SEPARATOR ', ') AS products,
                   SUM(oi.quantity * oi.unit_price) AS total_price 
            FROM orders o
            JOIN ordered_items oi ON o.order_id = oi.order_id
            JOIN products p ON oi.product_id = p.id
            WHERE o.order_id = ? AND o.user_id = ?
            GROUP BY o.order_id";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $order_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        throw new Exception("Order not found");
    }
    
    $order = $result->fetch_assoc();
    $stmt->close();

    $items_sql = "SELECT oi.*, p.title 
                 FROM ordered_items oi
                 JOIN products p ON oi.product_id = p.id
                 WHERE oi.order_id = ?";
    
    $stmt = $conn->prepare($items_sql);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

} catch (Exception $e) {
    // Log error and redirect
    error_log("Order confirmation error: " . $e->getMessage());
    header("location: error.php");
    exit;
}

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
                    <span class="font-medium">#<?= htmlspecialchars($order_id) ?></span>
                </div>
                <div class="flex justify-between mb-2">
                    <span class="text-gray-600">Total Amount:</span>
                    <span class="font-medium">₹<?= number_format($order['total_price'], 2) ?></span>
                </div>
                <div class="flex justify-between mb-2">
                    <span class="text-gray-600">Payment Method:</span>
                    <span class="font-medium"><?= htmlspecialchars(strtoupper($order['payment_method'])) ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Order Status:</span>
                    <span class="font-medium uppercase"><?= htmlspecialchars($order['order_status']) ?></span>
                </div>
            </div>
            
            <div class="mb-6">
                <h2 class="font-semibold text-lg mb-2">Order Details</h2>
                <?php foreach ($items as $item): ?>
                <div class="flex justify-between mb-2">
                    <span class="text-gray-600">
                        <?= htmlspecialchars($item['title']) ?>
                        <span class="text-sm">(x<?= $item['quantity'] ?>)</span>
                    </span>
                    <span>₹<?= number_format($item['unit_price'] * $item['quantity'], 2) ?></span>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="mb-6">
                    <h2 class="font-semibold text-lg mb-2">Shipping Address</h2>
                    <?php
                    // Decode the JSON shipping address
                    $shipping_address = json_decode($order['shipping_address'], true);
                    if ($shipping_address && is_array($shipping_address)) :
                    ?>
                        <p class="text-gray-700">
                            <?= htmlspecialchars($shipping_address['name'] ?? '') ?><br>
                            <?= htmlspecialchars($shipping_address['address_line1'] ?? '') ?><br>
                            <?php if (!empty($shipping_address['address_line2'])) : ?>
                                <?= htmlspecialchars($shipping_address['address_line2']) ?><br>
                            <?php endif; ?>
                            <?= htmlspecialchars($shipping_address['city'] ?? '') ?>, 
                            <?= htmlspecialchars($shipping_address['state'] ?? '') ?> - 
                            <?= htmlspecialchars($shipping_address['zipcode'] ?? '') ?>
                        </p>
                    <?php else : ?>
                        <p class="text-gray-700 whitespace-pre-line">
                            <?= htmlspecialchars($order['shipping_address']) ?>
                        </p>
                    <?php endif; ?>
                </div>
            
            <div class="text-center">
                <a href="index.php?page=shop" class="inline-block bg-indigo-500 hover:bg-indigo-600 text-white py-2 px-6 rounded transition-colors">
                    Continue Shopping
                </a>
            </div>
        </div>
    </div>
</body>
</html>