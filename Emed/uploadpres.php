<?php
    $servername = "localhost"; // Database server (e.g., localhost)
    $username = "root";        // Database username
    $password = "";            // Database password
    $dbname = "go"; 
    $conn="";      // Database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Database connected successfully!";
?>
