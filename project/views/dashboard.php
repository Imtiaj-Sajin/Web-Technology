<?php
session_start();
require "parts.php";

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
    
    <?php header_show(); ?>
    <br>
    
        <table width="100%"> 
            <tr>
                <td width="150px">
                
                    <ul>
                        <li><a href="#">Courses</a></li>
                        <li><a href="#">Communication</a></li>
                        <li><a href="profile.php">Profile</a></li>
                        <li><a href="changePass.php">change Pass</a></li>
                        <li><a href="../controllers/logout.php">Logout</a></li>
                    </ul>
                </td>
                <td align="center">
                 asdfasdffadsf
                </td>
            </tr>
        </table>
    <?php
 

    footer_show();
        ?>
    
</body>
</html>
