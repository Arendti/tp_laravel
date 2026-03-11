<?php
    class LoginForm {

        private $email;

        private $password;

        function __construct($user)
        {
            $this->email = htmlspecialchars($user["email"]);
            $this->password = htmlspecialchars($user["password"]);
        }

        function checkEmail() {
            if (empty($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                return false;
            }
            return true;
        }

        function checkPassword() {
            if (empty($this->password) || strlen($this->password) < 8) {
                return false;
            }
            return true;
        }


    }

    $lf = new LoginForm($_POST);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Ticketing Service</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h1>Ticketing Service</h1>
            <form class="login-form" id="login-form" action="" method="Post">
                <div class="form-group">
                    <label for="email">Email: <span class="required">*</span></label>
                    <input type="email" id="email" name="email">
                    <div id="email_error" class="error-text <?=(!$lf->checkEmail()) ? 'titanic' : ''?>">Email is required and must be valid.</div>
                </div>
                <div class="form-group">
                    <label for="password">Password: <span class="required">*</span></label>
                    <input type="password" id="password" name="password">
                    <div id="password_error" class="error-text <?=(!$lf->checkPassword()) ? 'titanic' : ''?>">Password is required and must be at least 8 characters long.</div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
                <p class="login-footer"><a href="dashboard.php">Enter as a guest</a></p>
                <p class="login-footer">Forgot your password? <a href="forgot_password.php">click here</a></p>
                <p class="login-footer">Don't have an account? <a href="signup.php">Sign up</a></p>
            </form>
        </div>
    </div>
    <script src="js/script.js"></script>
</body>
</html>
