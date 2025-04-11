<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Include config file
require_once "../Backend/config.php";  // Adjust this path if needed

// Define variables and initialize with empty values
$address = $payment_method = "";
$address_err = $payment_method_err = "";
$product_id = "";

// Get the product details
if(isset($_GET["product_id"])) {
    $product_id = trim($_GET["product_id"]);
    
    // Prepare a select statement
    $sql = "SELECT * FROM products WHERE id = ?";
    
    if($stmt = $conn->prepare($sql)) {  // Changed $mysqli to $conn
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);
        
        // Set parameters
        $param_id = $product_id;
        
        // Attempt to execute the prepared statement
        if($stmt->execute()) {
            $result = $stmt->get_result();
            
            if($result->num_rows == 1) {
                $product = $result->fetch_array(MYSQLI_ASSOC);
            } else {
                // Product not found
                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        $stmt->close();
    }
} else {
    // No product ID provided
    header("location: shop.php");
    exit();
}

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validate address
    if(empty(trim($_POST["address"]))) {
        $address_err = "Please enter an address.";
    } else {
        $address = trim($_POST["address"]);
    }
    
    // Validate payment method
    if(empty($_POST["payment_method"])) {
        $payment_method_err = "Please select a payment method.";
    } else {
        $payment_method = $_POST["payment_method"];
    }
    
    // Check input errors before creating order
    if(empty($address_err) && empty($payment_method_err)) {
        
        
        // Prepare an insert statement
        $sql = "INSERT INTO orders (user_id, product_id, quantity, total_price, address, payment_method) VALUES (?, ?, ?, ?, ?, ?)";
        
        if($stmt = $conn->prepare($sql)) {  // Changed $mysqli to $conn
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("iiidss", $param_user_id, $param_product_id, $param_quantity, $param_total_price, $param_address, $param_payment_method);
            
            // Set parameters
            $param_user_id = $_SESSION['user_id'];
            
            
            $param_product_id = $product_id;
            $param_quantity = 1; // Default quantity
            $param_total_price = $product["price"];
            $param_address = $address;
            $param_payment_method = $payment_method;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()) {
                $order_id = $conn->insert_id;  // Changed $mysqli to $conn
                
                // If payment method is COD, redirect to order confirmation
                if($payment_method == "cod") {
                    header("location: order_confirmation.php?order_id=" . $order_id);
                } else {
                    // For UPI, redirect to UPI payment page
                    header("location: upi_payment.php?order_id=" . $order_id);
                }
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Close connection
    $conn->close();  // Changed $mysqli to $conn
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Your E-commerce Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <h1 class="text-2xl font-bold mb-6 text-center">Complete Your Purchase</h1>
            
            <div class="mb-6 p-4 bg-gray-50 rounded">
                <h2 class="font-semibold text-lg mb-2">Product Details</h2>
                <div class="flex justify-between mb-2">
                    <span>Product:</span>
                    <span class="font-medium"><?php echo htmlspecialchars($product["title"]); ?></span>
                </div>
                <div class="flex justify-between">
                    <span>Price:</span>
                    <span class="font-medium">₹<?php echo htmlspecialchars($product["price"]); ?></span>
                </div>
            </div>
            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?product_id=" . $product_id; ?>" method="post">
                <div class="mb-4">
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Shipping Address</label>
                    <textarea id="address" name="address" rows="3" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500 <?php echo (!empty($address_err)) ? 'border-red-500' : ''; ?>"><?php echo $address; ?></textarea>
                    <span class="text-xs text-red-500"><?php echo $address_err; ?></span>
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Payment Method</label>
                    <div class="space-y-2">
                        <div class="flex items-center">
                            <input id="cod" name="payment_method" type="radio" value="cod" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                            <label for="cod" class="ml-2 block text-sm text-gray-700">Cash on Delivery (COD)</label>
                        </div>
                        <div class="flex items-center">
                            <input id="upi" name="payment_method" type="radio" value="upi" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                            <label for="upi" class="ml-2 block text-sm text-gray-700">UPI Payment</label>
                        </div>
                    </div>
                    <span class="text-xs text-red-500"><?php echo $payment_method_err; ?></span>
                </div>
                
                <div class="flex justify-between">
                    <a href="index.php?page=shop" class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded transition-colors">Cancel</a>
                    <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white py-2 px-4 rounded transition-colors">Continue</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>