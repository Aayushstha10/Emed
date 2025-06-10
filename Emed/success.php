<?php
    session_start();

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'esewa');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // eSewa response (assuming this comes via POST)
    $response = $_POST; 

    // Check if the response contains necessary fields and the payment was successful
    if (isset($response['status']) && $response['status'] == 'success') {
        // Extract relevant data from the response
        $transaction_id = $response['transaction_id']; // This is the unique transaction ID
        $amount = $response['amount']; // The amount paid by the customer
        $product_code = $response['product_code']; // The product code or reference
        $invoice_no = "INV" . strtoupper(uniqid()); // Generate a unique invoice number, you can customize it
        $status = 'completed'; // You can set it to 'completed' or 'paid'

        // Insert order data into the orders table
        $stmt = $conn->prepare("INSERT INTO orders (invoice_no, product_id, total, status, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())");
        $stmt->bind_param("ssds", $invoice_no, $product_code, $amount, $status);

        if ($stmt->execute()) {
            // Optionally, clear the cart after successful order creation
            unset($_SESSION['cart']);

            echo "<h1>Payment Successful!</h1>";
            echo "<p>Your payment was successful. Thank you for your purchase!</p>";
            echo "<p>Transaction ID: " . $transaction_id . "</p>";
            echo "<p>Amount Paid: NPR " . $amount . "</p>";
            echo "<p>Invoice No: " . $invoice_no . "</p>";
            echo "<p>Product Code: " . $product_code . "</p>";

            // You can redirect to a thank you page or order details page
            // header("Location: thank_you.php"); // Uncomment this to redirect
        } else {
            echo "<h1>Error</h1>";
            echo "<p>There was an error processing your order. Please try again later.</p>";
        }
    } else {
        echo "<h1>Payment Failed!</h1>";
        echo "<p>Sorry, something went wrong with your payment. Please try again later.</p>";
    }
?>
