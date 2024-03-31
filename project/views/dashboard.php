<?php
session_start();
if(!isset($_SESSION['hasLoggedIn'])){
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Courseway</title>
</head>
<body>
    <table width="100%" cellspacing="0" cellpadding="0" border="1">
        <tr>
            <td align="left" style="padding: 10px;">
                <img src="path_to_your_logo" alt="Courseway Logo">
            </td>
            <td align="right" style="padding: 10px;">
                Hello, <?php echo $_SESSION['username']; ?>!
            </td>
        </tr>
    </table>

    <fieldset>
        <legend>Welcome to Courseway Dashboard</legend>
        <p>Hello, !</p>
        <!-- Add your dashboard content here -->
    </fieldset>

    <footer>
        <!-- Add footer content here -->
    </footer>
</body>
</html>
