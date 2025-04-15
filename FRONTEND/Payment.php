<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

require_once "../Backend/config.php";

$address = $payment_method = "";
$address_err = $payment_method_err = "";
$order_source = isset($_GET['source']) ? $_GET['source'] : 'direct';

if (!in_array($order_source, ['cart', 'direct'])) {
    header("location: error.php");
    exit;
}

$order_items = [];
$total_amount = 0;
$bag_total = 0;

if ($order_source === 'direct') {
    if (!isset($_GET["product_id"])) {
        header("location: index.php?page=shop&error=Product ID is required.");
        exit;
    }
    
    $product_id = trim($_GET["product_id"]);
    $quantity = isset($_GET["quantity"]) ? (int)$_GET["quantity"] : 1;

    $sql = "SELECT * FROM products WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();
        $stmt->close();
        
        if (!$product) {
            header("location: error.php");
            exit;
        }
        
        $order_items[] = [
            'product_id' => $product['id'],
            'title' => $product['title'],
            'price' => $product['price'],
            'quantity' => $quantity
        ];
        $bag_total = $product['price'] * $quantity;
        $total_amount = $bag_total;
    }
} else {
    $sql = "SELECT ci.*, p.title, p.price 
    FROM cart_items ci
    JOIN cart c ON ci.cart_id = c.cart_id
    JOIN products p ON ci.product_id = p.id
    WHERE c.user_id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            $order_items[] = $row;
            $bag_total += $row['price'] * $row['quantity'];
        }
        $total_amount = $bag_total;
        $stmt->close();
        
        if (empty($order_items)) {
            header("location: index.php?page=cart&error=Your cart is empty.");
            exit;
        }
    }
}

$coupon_discount = $_SESSION['discount_amount'] ?? 0;
$total_amount = $bag_total - $coupon_discount;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $address = [
        'name' => trim($_POST['name']),
        'phone' => trim($_POST['phone']),
        'line1' => trim($_POST['address_line1']),
        'line2' => trim($_POST['address_line2']),
        'city' => trim($_POST['city']),
        'state' => trim($_POST['state']),
        'zipcode' => trim($_POST['zipcode'])
    ];
    
    $payment_method = $_POST['payment_method'] ?? '';

    if (empty($address['name'])) $address_err = "Full name is required";
    if (empty($address['phone'])) $address_err = "Phone number is required";
    if (empty($address['line1'])) $address_err = "Address line 1 is required";
    if (empty($address['city'])) $address_err = "City is required";
    if (empty($address['state'])) $address_err = "State is required";
    if (empty($address['zipcode'])) $address_err = "ZIP code is required";
    if (empty($payment_method)) $payment_method_err = "Payment method is required";

    if (empty($address_err) && empty($payment_method_err)) {
        $conn->begin_transaction();
        try {
            $sql = "INSERT INTO orders (user_id, total_amount,payment_status,payment_method,order_status,shipping_address)
                    VALUES ( ?, ?, 'pending', ?,'processing', ?)";
            
            $stmt = $conn->prepare($sql);
            $shipping_address = json_encode($address);
            $stmt->bind_param("idss", 
                $_SESSION['user_id'], 
                $total_amount, 
                $payment_method, 
                $shipping_address
            );
            $stmt->execute();
            $order_id = $conn->insert_id;
            $stmt->close();

            foreach ($order_items as $item) {
                $sql = "INSERT INTO ordered_items (order_id, product_id, quantity, unit_price)
                        VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("iiid", $order_id, $item['product_id'], $item['quantity'], $item['price']);
                $stmt->execute();
                $stmt->close();
            }

            if ($order_source === 'cart') {
                $sql = "DELETE ci
                FROM cart_items ci
                JOIN cart c ON ci.cart_id = c.cart_id
                WHERE c.user_id = ?";
        
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $_SESSION['user_id']);
                $stmt->execute();
                $stmt->close();
            }

            $conn->commit();

            if ($payment_method == "cod") {
                header("Location: order_confirmation.php?order_id=" . $order_id);
            } else {
                header("Location: upi_payment.php?order_id=" . $order_id);
            }
            exit();
            
        } catch (Exception $e) {
            $conn->rollback();
            die("Error processing order: " . $e->getMessage());
        }
    }
}

$user_sql = "SELECT * FROM users WHERE Sno = ?";
$stmt = $conn->prepare($user_sql);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VEYRA - Payment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#FFE4E4',
                        secondary: '#9B8069',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-semibold mb-6">Complete Your Order</h2>
        
        <div class="lg:flex lg:space-x-8">
            <div class="lg:w-2/3">
                <div class="bg-white border border-gray-200 rounded-md p-6 mb-6">
                    <h3 class="text-xl font-semibold mb-4">Payment Details</h3>
                    
                    <form id="payment-form" class="space-y-4" method="POST">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                <input type="text" name="name" required
                                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-secondary/50"
                                       value="<?= htmlspecialchars($user['name'] ?? '') ?>">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                <input type="tel" name="phone" required pattern="[0-9]{10}"
                                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-secondary/50"
                                       value="<?= htmlspecialchars($user['phone'] ?? '') ?>">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Address Line 1</label>
                            <input type="text" name="address_line1" required
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-secondary/50">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Address Line 2 (Optional)</label>
                            <input type="text" name="address_line2"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-secondary/50">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                <input type="text" name="city" required
                                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-secondary/50">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">State</label>
                                <input type="text" name="state" required
                                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-secondary/50">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">ZIP Code</label>
                                <input type="text" name="zipcode" required pattern="[0-9]{6}"
                                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-secondary/50">
                            </div>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-md p-6 mt-6">
                            <h3 class="text-xl font-semibold mb-4">Payment Method</h3>
                            <div class="space-y-3">
                                <div class="border border-gray-200 rounded-md p-4">
                                    <div class="flex items-start">
                                        <input type="radio" name="payment_method" value="cod" required 
                                               class="mt-1 mr-3" id="cod">
                                        <div>
                                            <label for="cod" class="block font-medium">Cash on Delivery (COD)</label>
                                            <p class="text-sm text-gray-600">Pay when you receive the order</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="border border-gray-200 rounded-md p-4">
                                    <div class="flex items-start">
                                        <input type="radio" name="payment_method" value="upi" required 
                                               class="mt-1 mr-3" id="upi">
                                        <div>
                                            <label for="upi" class="block font-medium">UPI Payment</label>
                                            <p class="text-sm text-gray-600">Instant payment using UPI</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span class="text-xs text-red-500"><?= $payment_method_err ?></span>
                        </div>

                        <button type="submit" 
                                class="w-full bg-secondary hover:bg-secondary/90 text-white py-3 rounded-md font-medium uppercase tracking-wide">
                            Complete Payment
                        </button>
                    </form>
                </div>
            </div>

            <div class="lg:w-1/3 mt-8 lg:mt-0">
                <div class="bg-white border border-gray-200 rounded-md p-6 sticky top-6">
                    <h3 class="text-xl font-semibold mb-4">Order Summary</h3>
                    
                    <div class="space-y-3 mb-6">
                        <?php foreach ($order_items as $item): ?>
                        <div class="flex justify-between">
                            <span class="text-gray-600">
                                <?= htmlspecialchars($item['title']) ?>
                                <span class="text-sm">x<?= $item['quantity'] ?></span>
                            </span>
                            <span>₹<?= number_format($item['price'] * $item['quantity'], 2) ?></span>
                        </div>
                        <?php endforeach; ?>
                        
                        <div class="border-t pt-3">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal</span>
                                <span>₹<?= number_format($bag_total, 2) ?></span>
                            </div>
                            
                            <?php if($coupon_discount > 0): ?>
                            <div class="flex justify-between text-green-600">
                                <span>Coupon Discount</span>
                                <span>-₹<?= number_format($coupon_discount, 2) ?></span>
                            </div>
                            <?php endif; ?>
                            <div class="flex justify-between font-semibold mt-3">
                                <span>Total</span>
                                <span>₹<?= number_format($total_amount, 2) ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h4 class="font-medium mb-2">Payment Security</h4>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-lock text-green-500 mr-2"></i>
                            <span>Secure SSL Encryption</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>