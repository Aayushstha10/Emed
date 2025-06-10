<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Successful</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #4CAF50, #2E7D32);
            color: white;
            text-align: center;
        }

        .container {
            background: rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        h1 {
            font-size: 3rem;
            margin: 0;
        }

        p {
            font-size: 1.2rem;
            margin: 20px 0;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 30px;
            background: white;
            color: #2E7D32;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-size: 1rem;
            transition: background 0.3s;
        }

        .btn:hover {
            background: #A5D6A7;
        }

        .icon {
            font-size: 5rem;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="icon">✅</div>
        <h1>Payment Successful!</h1>
        <p>Thank you for your purchase. Your transaction was completed successfully.</p>

        <?php
        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'esewa');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Generate unique invoice
        $invoice = 'INV-' . strtoupper(uniqid());

        // Get current timestamp
        $time = date('Y-m-d H:i:s');

        // Insert invoice and timestamp into orders_3 table
        $stmt = $conn->prepare("INSERT INTO orders (invoice, time) VALUES (?, ?)");
        $stmt->bind_param("ss", $invoice, $time);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        ?>

        <a href="frontpage.php" class="btn">E-MED</a>
    </div>

</body>
</html>
