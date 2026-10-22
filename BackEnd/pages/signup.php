
<?php
// Add your PHP registration code here.
// The form sends its data using POST.
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
                <label for="first_name">First Name</label>
                <input type="text" id="first_name"
                       name="first_name"
                       placeholder="Enter your first name"
                       required>
            </div>

            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name"
                       name="last_name"
                       placeholder="Enter your last name"
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
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone"
                       name="phone"
                       placeholder="Enter your phone number"
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

