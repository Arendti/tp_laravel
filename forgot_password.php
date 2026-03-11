<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Ticketing Service</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h1>Ticketing Service</h1>
            <form class="login-form" id="forgot-password-form">
                <div class="form-group">
                    <label for="forgot-email">Email: <span class="required">*</span></label>
                    <input type="email" id="forgot-email" name="email">
                    <div id="forgot-email-error" class="error-text titanic">Please enter the email associated with your account.</div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Send Reset Link</button>
                </div>
                <p class="login-footer"><a href="login.php">Back to login</a></p>
            </form>
        </div>
    </div>
    <script src="js/script.js"></script>
</body>
</html>
