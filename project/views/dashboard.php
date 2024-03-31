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
    <fieldset>
    <table width="100%" border="0">
        <tr>
            <td align="left">
                <img width="150px" src="../public/imgs/Creative.png" alt="Courseway Logo">
            </td>
            <td align="right">
                Hello, <?php echo $_SESSION['username']; ?>!
            </td>
        </tr>
    </table>
    </fieldset>
    <br>
    <fieldset>
        <table > 
            <tr>
                <td width="150px" valign="top">
                
                    <ul>
                        <li><a href="#">Courses</a></li>
                        <li><a href="#">Communication</a></li>
                        <li><a href="#">Profile</a></li>
                        <li><a href="../controllers/logout.php">Logout</a></li>
                    </ul>
                </td>
                <td>
                <p>asdfasdffadsf</p>
                </td>
            </tr>
        </table>
        
    </fieldset>

    <footer>
        <!-- Add footer content here -->
    </footer>
</body>
</html>
