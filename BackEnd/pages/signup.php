
<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

$_username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirmpassword = $_POST["confirm_password"];

htmlspecialchars()


}
else{

 header("location: ../signup.php");
 die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Museum Tours</title>

    
</head>

<body>

    <div class="signup-container">

        <h1>Join Our Museum</h1>

        <p class="subtitle">
            Create an account to reserve your
            favorite guided museum tours.
        </p>

        <form action="signup.php" method="POST">

            <div class="form-group">
                <label for="username"> Name</label>
                <input type="text" id="username"
                       name="username"
                       placeholder="Enter your first name"
                       required>
            </div>

            

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email"
                       name="email"
                       placeholder="you@example.com"
                       required>
            </div>


            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password"
                       name="password"
                       minlength="8"
                       placeholder="At least 8 characters"
                       required>
            </div>

            <div class="form-group">
                <label for="confirm_password">
                    Confirm Password
                </label>
                <input type="password" id="confirm_password"
                       name="confirm_password"
                       minlength="8"
                       placeholder="Enter your password again"
                       required>
            </div>

            <button type="submit" name="signup">
                Create Account
            </button>

        </form>

        <p class="login-link">
            Already have an account?
            <a href="login.php">Log in</a>
        </p>

    </div>

</body>
</html>

