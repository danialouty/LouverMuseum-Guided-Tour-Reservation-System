<?php

if (isset($_POST["submit"])) {
//grabbing the data
$username = $_POST["username"];
$password = $_POST["password"];
$email = $_POST["email"];

$result =$conn->query("SELECT * FROM users WHERE email = '$email'");

if ($result->num_rows > 0) {
 $user = $result->fetch_assoc();
 if(password_verify($password, $user["password"])) {
    $_SESSION["username"] = $user["username"];
    $_SESSION["email"] = $user["email"];
    
    if($user['role'] === 'admin') {
        header(" location: admin_page.php ");

    }
    else{
        header(" location: user_page.php ");

    }

    exit();
 

}
}
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="../../frontend/login.css">

</head>
<body>

    <div class="login-container">
        <h2>Account Login</h2>
        <form action="login.php" method="POST">
            
            <div class="form-group">
                <label for="username">Username or Email</label>
                <input type="text" id="username" name="username" required placeholder="Enter username or email">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="Enter password">
            </div>

            <button type="submit" name="submit" class="btn-submit">Log In</button>

            <div class="form-footer">
                <p>Don't have an account? <a href="#">Sign up</a></p>
            </div>
        </form>
    </div>

</body>
</html>




