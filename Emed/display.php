<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "details";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch records from the database
    $sql = "SELECT * FROM records";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        echo "<div>";
        while ($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<p><strong>Patient Name:</strong> " . $row['patient_name'] . "</p>";
            echo "<p><strong>Age:</strong> " . $row['age'] . "</p>";
            echo "<p><strong>Date:</strong> " . $row['date'] . "</p>";
            echo "<div style='display: flex; flex-direction: column; align-items: center; gap: 20px;'>";
            echo "<img src='" . $row['image'] . "' alt='Prescription Image' style='width:100%; height:auto; max-width:200px;' />";
            echo "</div><hr>";
        }
        echo "</div>";
    } else {
        echo "No records found.";
    }
    $conn->close();
?>
