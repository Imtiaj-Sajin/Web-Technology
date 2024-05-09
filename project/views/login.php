<?php
session_start();

require "../model/users.php";
require "../controllers/validation.php";
require "parts.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = sanitize($_POST['username']);
    $password = sanitize($_POST['password']);

    if (credentials($username, $password)) {
        $_SESSION['hasLoggedIn'] = true;

        $userData = getValByUserName($username);
        $_SESSION['$userData'] = $userData;

        $_SESSION['username'] = $userData['instructor_name'];
        $_SESSION['userid'] = $userData['instructor_id'];
        $_SESSION['userpass'] = $userData['instructor_pass'];
        $_SESSION['bio'] = $userData['bio'];
        $_SESSION['email'] = $userData['email'];
        $_SESSION['website'] = $userData['website'];

        header("Location: dashboard.php");
        exit();
    } else if (empty($username) or empty($password)) {
        $error_message = "Please fill up the form properly";
    } else {
        $error_message = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Courseway</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<fieldset style="margin: 5px;border-radius: 10px;box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);">
        <table width="100%">
            <tr>
                <td align="left">
                    <img width="150px" src="../public/imgs/Creative.png" alt="Courseway Logo">
                </td>
                <td align="right">
                    Welcome to Courseway!
                </td>
            </tr>
        </table>
    </fieldset>
    
    
    <div class="login-container">
        <h2>Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm()" method="post" novalidate>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" ><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" ><br>
            <input type="submit" value="Login">
            <div class="forgot-signup-links">
                <a href="forgotPass.php">Forgot Password?</a>
                <span>|</span>
                <a href="signup.php">Sign Up</a>
            </div>
        </form>
        <?php if (isset($error_message)) echo "<p class='error-message'>$error_message</p>"; ?>
    </div>



    <script src="validation.js"></script>
<?php footer_show();?>
</body>
</html>
