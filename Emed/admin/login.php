<?php
session_start();
$conn = new mysqli("localhost", "root", "", "password"); // Adjust credentials as needed

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM password_table WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $_SESSION["username"] = $username;
        header("Location: /FP/admin/admin_dashboard.php");
        exit();
    } else {
        echo "<script>alert('Incorrect username or password');</script>";
    }
    
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #004d00, #66cc66);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.3);
            text-align: center;
        }
        .login-container img {
            width: 80px;
            border-radius: 50%;
            margin-bottom: 20px;
        }
        .input-field {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .login-btn {
            width: 100%;
            padding: 10px;
            background: #006600;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .remember-me {
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: #fff;
            font-size: 14px;
        }
    </style>

</head>
<body>
    <div class="login-container">
        <img src="./admin.PNG" alt="User Avatar">
        <form method="POST" action="">
            <input class="input-field" type="text" name="username" placeholder="Username" required>
            <input class="input-field" type="password" name="password" placeholder="Password" required>
            <div class="remember-me">
            
            </div>
            <button class="login-btn" type="submit">LOGIN</button>
        </form>
    </div>

</body>
</html>
