<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log In</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-image: url('Background.jpg');
            background-size: contain;
            background-position: center;
            font-family: Arial, sans-serif;
        }
        .container {
            display: flex;
            background: white;
            border-radius: 16px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 900px;
        }
        .left-panel {
            flex: 1;
            padding: 60px;
            background-image: url('medicine.jpg');
            background-size: contain;
            background-position: center;
            color: white;
            text-align: center;
        }
        .right-panel {
            flex: 1;
            padding: 60px;
            text-align: center;
        }
        h2 {
            color: #001f8e;
        }
        .input-box {
            margin: 20px 0;
        }
        .input-box input {
            width: 80%;
            padding: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
            outline: none;
            font-size: 16px;
        }
        .btn {
            padding: 16px 32px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            background: linear-gradient(to right, #1e90ff, #00bfff);
            color: white;
        }
        .links {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-panel">
            <h1>WELCOME TO THE E-MED</h1>
        
        </div>
        <div class="right-panel">
            <h2>Log In</h2>
            <form action="login_form.php" method="POST">
                <div class="input-box">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn">SIGN IN</button>
            </form>
        
        </div>
    </div>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        die("Please fill in all fields.");
    }

    $conn = new mysqli("localhost", "root", "", "password");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT password FROM password_table1 WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Compare plain text passwords directly
        if ($password === $row['password']) {
            header("Location: /FP/frontpage.php");
            exit();
        } else {
            echo "<script>alert('Invalid password');</script>";
        }
    } else {
        echo "<script>alert('No account found with that email');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
