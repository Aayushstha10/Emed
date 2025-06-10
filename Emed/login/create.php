<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('Background.jpg');
            background-size: contain;
            background-position: center;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .container {
            background: white;
            padding: 60px;
            border-radius: 16px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 500px;
        }
        .container h2 {
            color: #001f8e;
            font-size: 32px;
        }
        .input-box {
            margin: 30px 0;
            width: 100%;
        }
        .input-box input {
            width: 95%;
            padding: 16px;
            margin-top: 8px;
            border: 1px solid #ccc;
            border-radius: 8px;
            outline: none;
            font-size: 16px;
        }
        .btn-container button {
            padding: 16px 32px;
            margin: 20px 10px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-container .signup {
            background: linear-gradient(to right, #1e90ff, #00bfff)
            color: white;
        }
        .btn-container .signin {
            background: #f0f0f0;
            color: #666;
        }
    </style>

</head>
<body>
    <div class="container">
        <h2>Create Account</h2>
        <form action="" method="POST" onsubmit="return validateForm()">
            <div class="input-box">
                <input type="text" name="name" id="name" placeholder="Name" required>
            </div>
            <div class="input-box">
                <input type="email" name="email" id="email" placeholder="E-mail" required>
            </div>
            <div class="input-box">
                <input type="password" name="password" id="password" placeholder="Password" required>
            </div>
            <div class="btn-container">
                <button type="submit" class="signup">SIGN UP</button>
                <button type="button" class="signin" onclick="location.href='/FP/login/login_form.php';">SIGN IN</button>
            </div>
        </form>
    </div>

    <script>
        function validateForm() {
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();

            if (!name || !email || !password) {
                alert('All fields are required.');
                return false;
            }

            return true;
        }
    </script>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = htmlspecialchars(trim($_POST['name']));
        $email = htmlspecialchars(trim($_POST['email']));
        $password = trim($_POST['password']);

        if (empty($name) || empty($email) || empty($password)) {
            echo "<script>alert('All fields are required.');</script>";
            exit();
        }

        $conn = new mysqli("localhost", "root", "", "password");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO password_table1 (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);

        if ($stmt->execute()) {
            echo "<script>alert('Account created successfully!'); window.location.href='/FP/login/login_form.php';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
    ?>

</body>
</html>
