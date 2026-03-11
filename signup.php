<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Ticketing Service</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h1>Ticketing Service</h1>
            <form class="login-form" id="signup-form">
                <div class="form-group">
                    <label for="signup-name">Full Name: <span class="required">*</span></label>
                    <input type="text" id="signup-name" name="name">
                    <div id="signup-name-error" class="error-text titanic">Full name is required.</div>
                </div>
                <div class="form-group">
                    <label for="signup-email">Email: <span class="required">*</span></label>
                    <input type="email" id="signup-email" name="email">
                    <div id="signup-email-error" class="error-text titanic">Valid email is required.</div>
                </div>
                <div class="form-group">
                    <label for="signup-password">Password: <span class="required">*</span></label>
                    <input type="password" id="signup-password" name="password">
                    <div id="signup-password-error" class="error-text titanic">Password must be at least 8 characters.</div>
                </div>
                <div class="form-group">
                    <label for="signup-confirm">Confirm Password: <span class="required">*</span></label>
                    <input type="password" id="signup-confirm" name="confirm_password">
                    <div id="signup-confirm-error" class="error-text titanic">Passwords must match.</div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Sign Up</button>
                </div>
                <p class="login-footer">Already have an account? <a href="login.php">Log in</a></p>
            </form>
        </div>
    </div>
    <script src="js/script.js"></script>
</body>
</html>
