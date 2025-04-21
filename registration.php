<?php
include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phone = mysqli_real_escape_string($conn, $_POST['Phonenumber']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if the user already exists
    $check = mysqli_query($conn, "SELECT * FROM food WHERE Phonenumber = '$phone'");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Phone number already registered. Please log in.'); window.location='login.php';</script>";
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $insert = mysqli_query($conn, "INSERT INTO food (Phonenumber, password) VALUES ('$phone', '$hashedPassword')");
    if ($insert) {
        echo "<script>alert('Registration successful! Please log in.'); window.location='login.php';</script>";
        exit();
    } else {
        echo "<script>alert('Registration failed. Try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | Food Ordering</title>
    <link rel="stylesheet" href="registration.css"> <!-- Use same styling file as login -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffe6e6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #fff0f5;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 90%;
        }

        h2 {
            color: #ff6b81;
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="password"] {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            background-color: #ff6b81;
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #ff4d6d;
        }

        .checkbox-container {
            margin: 10px 0;
            font-size: 14px;
        }

        a {
            color: #ff6b81;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        p {
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Register</h2>
        <form method="POST" action="">
            <input type="text" name="Phonenumber" placeholder="📱 Enter phone number" required>
            <br>
            <input type="password" name="password" id="password" placeholder="🔐 Create Password" required>
            <div class="checkbox-container">
                <input type="checkbox" onclick="togglePassword()"> Show Password
            </div>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>

    <script>
              if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/service-worker.js')
      .then(() => console.log('Service Worker registered!'))
      .catch((error) => console.log('Service Worker registration failed:', error));
  }

        function togglePassword() {
            const pass = document.getElementById("password");
            pass.type = pass.type === "password" ? "text" : "password";
        }
    </script>
</body>
</html>
