<?php
include '../Backend/config.php';
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
} else {
    $user_id = $_SESSION['user_id'];
    
    $cart_sql = "SELECT cart_id FROM cart WHERE user_id = '$user_id' AND status = 'active'";
    $cart_result = mysqli_query($conn, $cart_sql);
    
    $cart_items = [];
    $cart_id = 0;
    
    if (mysqli_num_rows($cart_result) > 0) {
        $cart_row = mysqli_fetch_assoc($cart_result);
        $cart_id = $cart_row['cart_id'];
        
        $items_sql = "
            SELECT ci.cart_item_id as id, ci.product_id, ci.quantity, p.title, p.price, p.image 
            FROM cart_items ci
            JOIN products p ON ci.product_id = p.id
            WHERE ci.cart_id = '$cart_id'
        ";
        $items_result = mysqli_query($conn, $items_sql);
        $cart_items = mysqli_fetch_all($items_result, MYSQLI_ASSOC);
    }
    
    $coupon_query = "SELECT * FROM coupons ORDER BY amount DESC";
    $coupon_result = mysqli_query($conn, $coupon_query);
    $coupons = mysqli_fetch_all($coupon_result, MYSQLI_ASSOC);
    
    $bag_total = 0;
    $total_items = 0;
    
    foreach ($cart_items as $item) {
        $bag_total += $item['price'] * $item['quantity'];
        $total_items += $item['quantity'];
    }
    
    $coupon_discount = 0;
    $coupon_message = '';
    $applied_coupon = null;
    
    if(isset($_POST['apply_coupon']) && !empty($_POST['coupon_code'])) {
        $coupon_code = mysqli_real_escape_string($conn, $_POST['coupon_code']);
        
        $stmt = $conn->prepare("SELECT * FROM coupons WHERE code = ?");
        $stmt->bind_param("s", $coupon_code);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $coupon = $result->fetch_assoc();
            
            if($bag_total >= $coupon['min_purchase']) {
                if($coupon['is_percentage'] == 1) {
                    $coupon_discount = $bag_total * ($coupon['amount'] / 100);
                } else {
                    $coupon_discount = $coupon['amount'];
                }
                
                if($coupon_discount > $bag_total) {
                    $coupon_discount = $bag_total;
                }
                
                $coupon_message = "<div class='text-green-600'>Coupon applied: {$coupon['description']}</div>";
                $applied_coupon = $coupon;
                
                $_SESSION['applied_coupon'] = $coupon['code'];
                $_SESSION['discount_amount'] = $coupon_discount;
            } else {
                $coupon_message = "<div class='text-red-500'>Minimum purchase of ₹" . number_format($coupon['min_purchase'], 2) . " required for this coupon.</div>";
            }
        } else {
            $coupon_message = "<div class='text-red-500'>Invalid coupon code.</div>";
        }
    }
    
    $order_total = $bag_total - $coupon_discount;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VEYRA - Shopping Cart</title>
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
        <h2 class="text-2xl font-semibold mb-6">My Bag <span id="itemCount" class="text-gray-500 font-normal text-lg">(<?php echo $total_items; ?> item<?php echo $total_items !== 1 ? 's' : ''; ?>)</span></h2>
        
        <?php if(isset($_GET['success'])): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <?php echo htmlspecialchars($_GET['success']); ?>
            </div>
        <?php endif; ?>
        
        <?php if(isset($_GET['error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>
        
        <div class="lg:flex lg:space-x-8">
            <div class="lg:w-2/3">
                <?php if(empty($cart_items)): ?>
                    <div class="border border-gray-200 rounded-md mb-4 p-6 text-center">
                        <p class="text-gray-600 mb-4">Your bag is empty.</p>
                        <a href="index.php" class="bg-secondary hover:bg-secondary/90 text-white px-6 py-2 rounded-md font-medium">
                            Continue Shopping
                        </a>
                    </div>
                <?php else: ?>
                    <?php foreach ($cart_items as $item): ?>
                        <div class="border border-gray-200 rounded-md mb-4 p-4 flex flex-col md:flex-row" data-id="<?php echo $item['id']; ?>">
                            <div class="flex-shrink-0 w-full md:w-32 h-40 bg-gray-100 rounded-md overflow-hidden mb-4 md:mb-0">
                                <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" class="w-full h-full object-cover object-center">
                            </div>
                            
                            <div class="flex-grow md:ml-6 flex flex-col justify-between">
                                <div>
                                    <h3 class="text-lg font-medium mb-1"><?php echo htmlspecialchars($item['title']); ?></h3>
                                    
                                    <div class="flex items-center mb-3">
                                        <p class="item-price text-secondary font-medium">₹ <?php echo number_format($item['price'], 2); ?></p>
                                    </div>
                                    
                                    <div class="flex items-center mb-3">
                                        <span class="text-sm font-medium mr-3">Qty:</span>
                                        <form action="update_cart.php" method="post" class="flex">
                                            <input type="hidden" name="cart_item_id" value="<?php echo $item['id']; ?>">
                                            <select name="quantity" class="quantity-select border border-gray-300 rounded-md px-2 py-1 text-sm" onchange="this.form.submit()">
                                                <?php for($i = 1; $i <= 10; $i++): ?>
                                                    <option value="<?php echo $i; ?>" <?php echo ($i == $item['quantity']) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </form>
                                    </div>
                                </div>
                                
                                <div class="flex mt-3">
                                    <form action="../Frontend/remove_from_cart.php" method="post">
                                        <input type="hidden" name="cart_item_id" value="<?php echo $item['id']; ?>">
                                        <button type="submit" class="text-red-500 text-sm font-medium mr-4">
                                            <i class="far fa-trash-alt mr-1"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <div class="lg:w-1/3 mt-8 lg:mt-0">
                <div class="bg-white border border-gray-200 rounded-md p-6">
                    <h3 class="text-xl font-semibold mb-4">Order Details</h3>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Bag Total</span>
                            <span id="bagTotal">₹<?php echo number_format($bag_total, 2); ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 flex items-center">
                                Convenience Fee
                                <span class="text-blue-500 text-xs ml-1 cursor-pointer">What's this?</span>
                            </span>
                            <span class="font-medium">₹0</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Delivery Fee</span>
                            <span class="text-green-600">Free <span class="line-through text-gray-400 text-sm">₹99.00</span></span>
                        </div>
                        <?php if($coupon_discount > 0): ?>
                        <div id="couponDiscount" class="flex justify-between text-green-600">
                            <span>Coupon discount</span>
                            <span id="couponDiscountValue">-₹<?php echo number_format($coupon_discount, 2); ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="border-t border-gray-200 pt-3 flex justify-between font-semibold">
                            <span>Order Total</span>
                            <span id="orderTotal">₹<?php echo number_format($order_total, 2); ?></span>
                        </div>
                    </div>
                    
                    <form action="payment.php">
                        <?php if(isset($applied_coupon)): ?>
                            <input type="hidden" name="applied_coupon" value="<?php echo $applied_coupon['code']; ?>">
                            <input type="hidden" name="coupon_discount" value="<?php echo $coupon_discount; ?>">
                        <?php endif; ?>
                        <input type="hidden" name="bag_total" value="<?php echo $bag_total; ?>">
                        <input type="hidden" name="order_total" value="<?php echo $order_total; ?>">
                        <input type="hidden" name="source" value="<?php echo 'cart'; ?>">
                        
                        <input type="hidden" name="cart_id" value="<?php echo $cart_id; ?>">
                        <button type="submit" class="w-full bg-secondary hover:bg-secondary/90 text-white py-3 rounded-md font-medium uppercase tracking-wide">
                            Proceed to Shipping
                        </button>
                    </form>
                    
                    <div class="mt-6 border border-gray-200 rounded-md p-4">
                        <h4 class="font-medium mb-3">Apply Coupon</h4>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="flex">
                            <input type="text" name="coupon_code" id="couponInput" placeholder="Enter coupon code" class="flex-grow border border-gray-300 rounded-l-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-secondary" value="<?php echo isset($applied_coupon) ? $applied_coupon['code'] : ''; ?>">
                            <button type="submit" name="apply_coupon" class="bg-gray-800 text-white px-4 py-2 rounded-r-md text-sm font-medium">APPLY</button>
                        </form>
                        <?php if(!empty($coupon_message)): ?>
                        <div id="couponMessage" class="mt-2 text-sm"><?php echo $coupon_message; ?></div>
                        <?php endif; ?>
                        
                        <?php if(!empty($coupons)): ?>
                        <div class="mt-4">
                            <h5 class="font-medium mb-2">Applicable Coupons</h5>
                            <div class="space-y-3">
                                <?php foreach($coupons as $index => $coupon): ?>
                                <div class="flex items-start">
                                    <input type="radio" id="coupon<?php echo $index; ?>" name="coupon" class="coupon-radio mt-1 mr-2" 
                                           data-code="<?php echo $coupon['code']; ?>" 
                                           <?php echo (isset($applied_coupon) && $applied_coupon['code'] === $coupon['code']) ? 'checked' : ''; ?>>
                                    <div>
                                        <label for="coupon<?php echo $index; ?>" class="block font-medium text-sm">
                                            Savings: <?php echo $coupon['is_percentage'] == 1 ? $coupon['amount'] . '%' : '₹' . number_format($coupon['amount'], 2); ?>
                                        </label>
                                        <p class="text-sm text-gray-600"><?php echo $coupon['code']; ?></p>
                                        <p class="text-xs text-gray-500"><?php echo htmlspecialchars($coupon['description']); ?></p>
                                        <p class="text-xs text-gray-500">
                                            <?php if($coupon['min_purchase'] > 0): ?>
                                                Minimum purchase: ₹<?php echo number_format($coupon['min_purchase'], 2); ?>
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="mt-6">
                        <h4 class="font-medium mb-2">Return/Refund policy</h4>
                        <p class="text-sm text-gray-600">In case of return, we ensure quick refunds. Full amount will be refunded excluding Convenience Fee.</p>
                        <a href="#" class="text-sm text-blue-500 mt-1 inline-block">Read Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container mx-auto px-4 py-6 border-t border-gray-200 mt-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
            <div class="flex flex-col items-center">
                <div class="w-12 h-12 flex items-center justify-center rounded-full border border-gray-200 mb-2">
                    <i class="fas fa-shield-alt text-xl text-gray-600"></i>
                </div>
                <span class="text-sm font-medium uppercase">Secure Payments</span>
            </div>
            
            <div class="flex flex-col items-center">
                <div class="w-12 h-12 flex items-center justify-center rounded-full border border-gray-200 mb-2">
                    <i class="fas fa-exchange-alt text-xl text-gray-600"></i>
                </div>
                <span class="text-sm font-medium uppercase">Easy Exchange</span>
            </div>
            
            <div class="flex flex-col items-center">
                <div class="w-12 h-12 flex items-center justify-center rounded-full border border-gray-200 mb-2">
                    <i class="fas fa-check-circle text-xl text-gray-600"></i>
                </div>
                <span class="text-sm font-medium uppercase">Assured Quality</span>
            </div>
            
            <div class="flex flex-col items-center">
                <div class="w-12 h-12 flex items-center justify-center rounded-full border border-gray-200 mb-2">
                    <i class="fas fa-sync-alt text-xl text-gray-600"></i>
                </div>
                <span class="text-sm font-medium uppercase">Free Returns</span>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const couponRadios = document.querySelectorAll('.coupon-radio');
            const couponInput = document.getElementById('couponInput');
            
            couponRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.checked) {
                        couponInput.value = this.dataset.code;
                        this.closest('form').submit();
                    }
                });
            });
        });
    </script>
</body>
</html>