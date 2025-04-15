<?php
session_start();
include '../Backend/config.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['cart_item_id'])) {
    $cart_item_id = $_POST['cart_item_id'];
    
    $select_cart_sql = "SELECT cart_id FROM cart_items WHERE cart_item_id = '$cart_item_id'";
    $result = mysqli_query($conn, $select_cart_sql);
    $cart_id = 0;
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $cart_id = $row['cart_id'];
    }
    
    $delete_sql = "DELETE FROM cart_items WHERE cart_item_id = '$cart_item_id'";
    
    if (mysqli_query($conn, $delete_sql)) {
        if ($cart_id > 0) {
            $update_cart_sql = "UPDATE cart SET updated_at = CURRENT_TIMESTAMP WHERE cart_id = '$cart_id'";
            mysqli_query($conn, $update_cart_sql);
        }
        
        header("Location: index.php?page=cart&success=Item removed from cart successfully!");
    } else {
        header("Location: index.php?page=cart&error=Failed to remove item from cart. Please try again.");
    }
} else {
    header("Location: index.php?page=cart&error=Invalid request.");
}
?>