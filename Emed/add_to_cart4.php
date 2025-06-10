<?php
    session_start();

    // Database connection
    $host = 'localhost';
    $db = 'esewa';
    $user = 'root';
    $password = '';

    $conn = new mysqli($host, $user, $password, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
        $productId = intval($_POST['product_id']);

        // Fetch product details
        $sql = "SELECT * FROM products4 WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();

            // Add to session cart
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            // Check if product already in cart
            if (isset($_SESSION['cart'][$productId])) {
                $_SESSION['cart'][$productId]['quantity'] += 1;
            } else {
                $_SESSION['cart'][$productId] = [
                    'id' => $product['id'],
                    'title' => $product['title'],
                    'description' => $product['description'],
                    'image' => $product['image'],
                    'amount' => $product['amount'],
                    'quantity' => 1
                ];
            }
        }

        $stmt->close();
        $conn->close();

        // Redirect to cart
        header("Location: cart.php");
        exit();
    }
?>
