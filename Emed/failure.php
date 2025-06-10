<?php
    session_start();

    // eSewa response (for demo purposes, you'd get these from eSewa's callback)
    $response = $_POST; // Assuming eSewa sends the response via POST method

    // Check if the response contains necessary fields
    if (isset($response['status']) && $response['status'] == 'failure') {
        // Payment failed
        echo "<h1>Payment Failed</h1>";
        echo "<p>We're sorry, your payment could not be processed. Please try again later.</p>";
        echo "<p>Error Message: " . $response['error_message'] . "</p>";
        echo "<p>Transaction ID: " . $response['transaction_id'] . "</p>";
    } else {
        // Unknown error
        echo "<h1>Payment Error</h1>";
        echo "<p>Sorry, we encountered an error while processing your payment. Please try again later.</p>";
    }
?>
