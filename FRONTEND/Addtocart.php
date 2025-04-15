<?php
session_start();
if(!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)){
   header("Location: login.php");
   exit();
} 
else{
   include '../Backend/config.php';
   $user_id = $_SESSION['user_id'];
   $product_id = $_POST['product_id'];
   $quantity = $_POST['quantity'];
   
   $sql = "SELECT cart_id FROM cart WHERE user_id = '$user_id' AND status = 'active'";
   $result = mysqli_query($conn, $sql);
   
   if (mysqli_num_rows($result) > 0) {
       $row = mysqli_fetch_assoc($result);
       $cart_id = $row['cart_id'];
   } else {
       $insert_cart_sql = "INSERT INTO cart (user_id, status) VALUES ('$user_id', 'active')";
       mysqli_query($conn, $insert_cart_sql);
       $cart_id = mysqli_insert_id($conn); 
   }
   
   $sql = "SELECT cart_item_id, quantity FROM cart_items WHERE cart_id = '$cart_id' AND product_id = '$product_id'";
   $result = mysqli_query($conn, $sql);
   
   if (mysqli_num_rows($result) > 0) {
       $row = mysqli_fetch_assoc($result);
       $new_quantity = $row['quantity'] + $quantity;
       $update_sql = "UPDATE cart_items SET quantity = '$new_quantity' WHERE cart_id = '$cart_id' AND product_id = '$product_id'";
       mysqli_query($conn, $update_sql);
   } else {
       $insert_sql = "INSERT INTO cart_items (cart_id, product_id, quantity) VALUES ('$cart_id', '$product_id', '$quantity')";
       mysqli_query($conn, $insert_sql);
   }
   
   $update_cart_sql = "UPDATE cart SET updated_at = CURRENT_TIMESTAMP WHERE cart_id = '$cart_id'";
   mysqli_query($conn, $update_cart_sql);
   
   header("Location: index.php?page=cart&success=Product added to cart successfully!");
}
?>