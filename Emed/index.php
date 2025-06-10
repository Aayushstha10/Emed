<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "details";

    include('conet.php');

    try {
        // Create database connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check for connection errors
        if ($conn->connect_error) {
            throw new Exception("Database connection failed: " . $conn->connect_error);
        }

        if (isset($_POST['submit'])) {
            // Retrieve form data
            $nmc_number = $_POST['nmc_number'];
            $file_name = $_FILES['image']['name'];
            $temp_name = $_FILES['image']['tmp_name'];
            $folder = 'Images/' . basename($file_name);
            $patient_name = $_POST['patient_name'];
            $age = $_POST['age'];
            $date = $_POST['date'];
            $medicines = $_POST['medicines'];
            $instruction = $_POST['instruction'];

            // Validate NMC number
            $sql = "SELECT full_name FROM doctors WHERE nmc_number = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $nmc_number);
            $stmt->execute();
            $result = $stmt->get_result();

            // Insert into record only if NMC number is valid
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<script>alert('Valid NMC Number: " . $row['full_name'] . "');</script>";

                // Move uploaded image to the Images directory
                if (move_uploaded_file($temp_name, $folder)) {
                    // Insert data into the record table
                    $insert_sql = "INSERT INTO records (nmc_number, image, patient_name, age, date, medicines, instruction) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?)";
                    $insert_stmt = $conn->prepare($insert_sql);
                    $insert_stmt->bind_param("ississs", $nmc_number, $folder, $patient_name, $age, $date, $medicines, $instruction);

                    if ($insert_stmt->execute()) {
                        echo '<script>alert("Prescription submitted successfully.");
                        window.location.href="/FP/CategoryB.php";</script>';
                    } else {
                        throw new Exception("Error submitting prescription: " . $insert_stmt->error);
                    }

                    $insert_stmt->close();
                } else {
                    echo "<script>alert('Error uploading image.');</script>";
                }
            } else {
                echo "<script>alert('Invalid NMC Number. Prescription not submitted.');</script>";
            }

            $stmt->close();
        }
        $conn->close();

    } catch (Exception $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .prescription-container {
            max-width: 600px;
            margin: auto;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            background-color: wheat;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            color: #333;
        }
        .form-section {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>

</head>
<body>

    <div class="prescription-container">
        <div class="header">
            <h1>Medical Prescription</h1>
        </div>

        <form method="POST" enctype="multipart/form-data">
            <div class="form-section">
                <h2>Doctor Information</h2>
                <label for="doctor-nmc">Doctor's NMC Number:</label>
                <input type="number" name="nmc_number" placeholder="Enter NMC number" required>
                <label for="pre_img">Prescription image</label>
                <input type="file" name="image" required>
            </div>
            <div class="form-section">
                <h2>Patient Information</h2>
                <label for="patient-name">Patient Name:</label>
                <input type="text" id="patient-name" name="patient_name" placeholder="Enter patient's name" required>

                <label for="age">Age:</label>
                <input type="number" id="age" name="age" placeholder="Enter patient's age" min="1" required>

                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>
            </div>

            <div class="form-section">
                <h2>Medications</h2>
                <label for="medication">Prescribed Medications:</label>
                <textarea id="medication" name="medicines" rows="5" placeholder="List medications and dosage" required></textarea>

                <label for="instructions">Special Instructions:</label>
                <textarea id="instructions" name="instruction" rows="5"
                    placeholder="Enter any specific instructions"></textarea>
            </div>

            <button type="submit" name="submit">Submit Prescription</button>
        </form>
    </div>

</body>
</html>
