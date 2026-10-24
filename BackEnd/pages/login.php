<?php

session_start();
require_once '../../config.php';

if (isset($_POST["submit"])) {
//grabbing the data
$password = $_POST["password"];
$email = $_POST["email"];
$role = $_POST["role"];

$result =$conn->query("SELECT * FROM users WHERE email = '$email' AND role = '$role'");

if ($result->num_rows > 0) {
 $user = $result->fetch_assoc();
 if(password_verify($password, $user["password"]) && ($user["is_active"] ?? 1)) {
    $_SESSION["username"] = $user["username"];
    $_SESSION["email"] = $user["email"];
    $_SESSION["role"] = $user["role"];


    if ($user['role'] === 'admin') {
    header('Location: ../../FrontEnd/admin_page.php');
    } else {
    header('Location: ../../FrontEnd/landingPage.php');
    }

    exit();


    }
    }
    $_SERVER['login_error'] = 'incorrect email or password';
    $_SERVER['active_from'] = 'login';
    header("Location: signup.php");


    }
    ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In | Louvre Museum</title>
    <link rel="stylesheet" href="../../frontend/login.css?v=6">

</head>
<body>

    <div class="login-container">
        <a class="login-brand" href="../../FrontEnd/landingPage.php">
            <span class="login-brand-mark">M</span>
            <span>LOUVRE <em>PARIS</em></span>
        </a>
        <h1>Welcome Back</h1>

        <p class="subtitle">
            Log in to manage your Louvre tour reservations.
        </p>

        <form action="login.php" method="POST">
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required placeholder="you@example.com">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="Enter your password">
            </div>

            <div class="form-group">
                <label for="role">Log in as</label>
                <select id="role" name="role" required>
                    <option value="" disabled selected>Select your role</option>
                    <option value="user">Visitor</option>
                    <option value="admin">Administrator</option>
                </select>
            </div>

            <button type="submit" name="submit">Log In</button>
        </form>

        <p class="signup-link">
            Don't have an account?
            <a href="signup.php">Sign up</a>
        </p>
    </div>

</body>
</html>
