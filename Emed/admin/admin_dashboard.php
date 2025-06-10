<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: a.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "esewa");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handling table creation
    if (isset($_POST["create_table"])) {
        $table_name = mysqli_real_escape_string($conn, $_POST["table_name"]);
        $sql = "CREATE TABLE $table_name (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    title VARCHAR(255) NOT NULL,
                    description VARCHAR(255) NOT NULL,
                    image VARCHAR(255) NOT NULL,
                    amount FLOAT NOT NULL
                )";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Table $table_name created successfully');</script>";
        } else {
            echo "<script>alert('Error creating table: " . $conn->error . "');</script>";
        }
    }

    // Handling item insertion (with image upload)
    if (isset($_POST["insert_item"])) {
        $table_name = mysqli_real_escape_string($conn, $_POST["table_name"]);
        $title = $_POST["title"];
        $description = $_POST["description"];
        $amount = $_POST["amount"];

        // Handle file upload
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (getimagesize($_FILES["image"]["tmp_name"]) !== false) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "File " . htmlspecialchars(basename($_FILES["image"]["name"])) . " uploaded.";
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "File is not an image.";
        }

        $image = basename($_FILES["image"]["name"]);
        $sql = "INSERT INTO $table_name (title, description, image, amount) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssd", $title, $description, $image, $amount);

        if ($stmt->execute()) {
            echo "<script>alert('Item added successfully');</script>";
        } else {
            echo "<script>alert('Error adding item');</script>";
        }
        $stmt->close();
    }

    // Handling item deletion
    if (isset($_POST["delete_item"])) {
        $table_name = mysqli_real_escape_string($conn, $_POST["table_name"]);
        $item_id = intval($_POST["item_id"]);

        $sql = "DELETE FROM $table_name WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $item_id);

        if ($stmt->execute()) {
            echo "<script>alert('Item deleted successfully'); window.location.href = window.location.href;</script>";
        } else {
            echo "<script>alert('Error deleting item');</script>";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #004d00, #66cc66);
            color: white;
            text-align: center;
        }
        .container {
            max-width: 900px;
            margin: 50px auto;
            background: rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 15px;
        }
        input, button {
            padding: 15px;
            margin: 10px;
            width: 90%;
            border-radius: 8px;
            border: none;
        }
        button {
            background: #006600;
            color: white;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }
        th, td {
            border: 1px solid white;
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #008000;
        }
    </style>

</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>
        
        <form method="POST">
            <input type="text" name="table_name" placeholder="Enter table name" required>
            <button type="submit" name="create_table">Create Table</button>
        </form>

        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="table_name" placeholder="Table Name" required>
            <input type="text" name="title" placeholder="Item Name" required>
            <input type="text" name="description" placeholder="Item Description" required>
            <input type="file" name="image" accept="image/*" required>
            <input type="number" step="0.01" name="amount" placeholder="Item Price" required>
            <button type="submit" name="insert_item">Insert Item</button>
        </form>

        <h3>View Items</h3>
        <form method="GET">
            <input type="text" name="view_table" placeholder="Enter table name to view items" required>
            <button type="submit">View Items</button>
        </form>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            <?php
            if (isset($_GET["view_table"])) {
                $table_name = mysqli_real_escape_string($conn, $_GET["view_table"]);
                if (preg_match('/^[a-zA-Z0-9_]+$/', $table_name)) {
                    $result = $conn->query("SELECT * FROM $table_name");
                    if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['title']}</td>
                                    <td>{$row['description']}</td>
                                    <td>{$row['amount']}</td>
                                    <td><img src='uploads/{$row['image']}' alt='Item Image' width='100'></td>
                                    <td>
                                        <form method='POST'>
                                            <input type='hidden' name='table_name' value='$table_name'>
                                            <input type='hidden' name='item_id' value='{$row['id']}'>
                                            <button type='submit' name='delete_item' >Delete</button>
                                        </form>
                                    </td>
                                </tr>";
                        }
                    }
                }
            }
            ?>
        </table>
    </div>
</body>
</html>

<?php $conn->close(); ?>
