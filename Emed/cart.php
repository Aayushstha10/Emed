<?php
    session_start();

    // Database connection
    $host = 'localhost';
    $dbname = 'esewa';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }

    // Fetch cart items from session
    $cart = $_SESSION['cart'] ?? [];

    // Calculate total amount
    $amount = array_reduce($cart, function ($total, $item) {
        return $total + ($item['amount'] * $item['quantity']);
    }, 0);

    $tax_amount = 10; // Fixed tax amount for testing
    $total_amount = $amount + $tax_amount;

    // Generate transaction UUID
    $transaction_uuid = date("ymdHis") . uniqid(); // Format: YYMMDD-HHmmss-unique

    // Product code
    $product_code = "CART_" . time(); // Unique product code for the cart

    // eSewa secret key
    $secret_key = '8gBm/:&EnhH.1/q'; // For testing

    // Signed field names and signature generation
    $signed_field_names = "total_amount,transaction_uuid,product_code";
    $data_to_sign = "total_amount=$total_amount&transaction_uuid=$transaction_uuid&product_code=$product_code";
    $signature = base64_encode(hash_hmac('sha256', $data_to_sign, $secret_key, true));

    // eSewa payment URL for testing
    $esewa_url = "https://rc-epay.esewa.com.np/api/epay/main/v2/form";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin-top: 20px;
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
        }
        .panel-heading {
            background-color: #007bff;
            color: white;
            padding: 15px;
            border-radius: 10px 10px 0 0;
        }
    </style>

</head>
<body>

    <div class="container">
        <h2>Your Shopping Cart</h2>
        <div class="panel panel-info">
            <div class="panel-heading">Items</div>
            <div class="panel-body">
                <?php if (!empty($cart)): ?>
                    <?php foreach ($cart as $item): ?>
                        <div class="row">
                            <div class="col-xs-6">
                                <strong><?php echo htmlspecialchars($item['title']); ?></strong> - 
                                Rs. <?php echo htmlspecialchars($item['amount']); ?> 
                                x <?php echo htmlspecialchars($item['quantity']); ?>
                            </div>
                            <div class="col-xs-6">
                                <a href="remove_from_cart.php?product_id=<?php echo htmlspecialchars($item['id']); ?>" class="btn btn-danger btn-sm">Remove</a>
                            </div>
                        </div>
                        <hr>
                    <?php endforeach; ?>
                    <h4>Total Amount: Rs. <?php echo $total_amount; ?></h4>
                    <form action="checkout.php" method="POST">
                        <input type="hidden" name="total_amount" value="<?php echo $total_amount; ?>">
                        <button type="submit" class="btn btn-success">Checkout with eSewa</button>
                    </form>
                    <?php else: ?>
                        <h4>Your cart is empty.</h4>
                    <?php endif; ?>
            </div>
        </div>
    </div>

</body>
</html>
