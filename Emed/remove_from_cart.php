<?php
    session_start();
    
    if (isset($_GET['product_id'])) {
        $productId = intval($_GET['product_id']);
        if (isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
        }
    }
    
    // Redirect back to cart
    header("Location: cart.php");
    exit();
?>
