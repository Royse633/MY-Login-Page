<?php
session_start();
require 'db.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $stmt = $pdo ->prepare("SELECT * FROM users WHERE username = ? AND PASSWORD = ?");
    $stmt->execute([$username, $password]);

    if($stmt ->rowCount() > 0){
        $_SESSION['user'] = $username;
        header("Location : dashboard.php");
        exit();
    } else{
        $error = "Invalid Username or Password";
    }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #000;
            margin: 0;
            padding: 0;
        }

        .header {
            width: 100%;
            padding: 20px 0;
            text-align: center;
            background: #111;
            color: #fff;
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 2px;
            border-bottom: 1px solid #444;
        }

        .login-container {
            background: #fff;
            width: 320px;
            margin: 80px auto;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(255,255,255,0.1);
            text-align: center;
        }

        .login-container h2 {
            margin-bottom: 20px;
            color: #000;
        }

        .login-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #000;
            border-radius: 4px;
            outline: none;
            background: #fff;
            color: #000;
        }

        .login-container input:focus {
            border-color: #555;
        }

        .login-container button {
            width: 100%;
            padding: 10px;
            background: #000;
            border: none;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
            transition: 0.3s;
        }

        .login-container button:hover {
            background: #333;
        }

        .error {
            color: #000;
            background: #eee;
            margin-top: 10px;
            padding: 5px;
        }

        .success {
            color: #fff;
            background: #000;
            margin-top: 10px;
            padding: 5px;
        }
    </style>
</head>
<body>

<div class="header">
    Royce S. Mañabo
</div>

<div class="login-container">
    <h2>Login</h2>

    <form method="POST">
       <label> User Name:</label> <br>
       <input type="text" name="username"> <br>
       <label> Password</label> <br>
       <input type= "password" name="password"> <br>
       <button type= "">Login</button>
    </form>

    <?php
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $correct_username = "admin";
        $correct_password = "1234";

        if ($username === $correct_username && $password === $correct_password) {
            echo "<p class='success'>Login successful!</p>";
        } else {
            echo "<p class='error'>Invalid username or password</p>";
        }
    }
    ?>
</div>

</body>
</html>