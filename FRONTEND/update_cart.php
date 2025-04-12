<?php
session_start();
include '../Backend/config.php';

// Check if user is logged in
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

// Validate inputs
if(isset($_POST['cart_item_id']) && isset($_POST['quantity'])) {
    $cart_item_id = $_POST['cart_item_id'];
    $quantity = (int)$_POST['quantity'];
    
    // Validate quantity
    if($quantity < 1) {
        $quantity = 1;
    } elseif($quantity > 10) {
        $quantity = 10;
    }
    
    $update_sql = "UPDATE cart_items SET quantity = '$quantity' WHERE cart_item_id = '$cart_item_id'";
    
    if(mysqli_query($conn, $update_sql)) {
        // Update cart's timestamp
        $select_cart_sql = "SELECT cart_id FROM cart_items WHERE cart_item_id = '$cart_item_id'";
        $result = mysqli_query($conn, $select_cart_sql);
        
        if($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $cart_id = $row['cart_id'];
            
            $update_cart_sql = "UPDATE cart SET updated_at = CURRENT_TIMESTAMP WHERE cart_id = '$cart_id'";
            mysqli_query($conn, $update_cart_sql);
        }
        
        header("Location: index.php?page=cart&success=Cart updated successfully!");
    } else {
        header("Location: index.php?page=cart&error=Failed to update cart. Please try again.");
    }
} else {
    header("Location: index.php?page=cart&error=Invalid request.");
}
?>