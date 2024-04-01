<?php
session_start();

require "../model/users.php";
require "parts.php";
require "../controllers/validation.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $old_pass = sanitize($_POST['old_pass']);
    $new_pass = sanitize($_POST['new_pass']);

    if ($old_pass == $_SESSION['userpass']) {
        updatePass($_SESSION['userid'], $new_pass);
    } else {
        $error_message = "Old password does not match.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
</head>
<body>
    <?php header_show(); ?>
    <table width="100%"> 
            <tr>
                <td width="150px">
                    <ul>
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="#">Courses</a></li>
                        <li><a href="#">Communication</a></li>
                        <li><a href="profile.php">Profile</a></li>
                        <li><a href="changePass.php">change Pass</a></li>
                        <li><a href="../controllers/logout.php">Logout</a></li>
                    </ul>
                </td>
                <td align=center>
                    <br>
                    <h2>Change Password</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <label for="old_pass">Old Password:</label>
                        <input type="password" id="old_pass" name="old_pass"><br><br>
                        <label for="new_pass">New Password:</label>
                        <input type="password" id="new_pass" name="new_pass"><br><br>
                        <input type="submit" value="Change Password">
                    </form>
                    <?php if (isset($error_message)) echo "<p style='color: red;'>$error_message</p>"; ?>
                </td>
                    
</body>
</html>
