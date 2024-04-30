<?php

include '../controllers/validation.php';
include '../model/users.php';
$error_message = "";
$temp_pass="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = sanitize($_POST['email']);
    $uname = sanitize($_POST['username']);


    $temp_data=getValByEmail($email);
    $temp_email=$temp_data['email'];
    $temp_uname=$temp_data['user_name'];

    if ($email == $temp_email && $uname== $temp_uname) {
        $temp_pass='your pass is '.$temp_data['user_pass'];
    } else {
        $error_message = "Does not match.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | Courseway</title>
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
    
<br>
    <div class="login-container">
        <h2>Forgotten Pass</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm()" method="post" novalidate>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username">
            
            <br><br>
            <label for="email">email:</label>
            <input type="email" id="email" name="email">

            <br><br>
            <input type="submit" value="Find Password">
            

            <br>

            <br>
            <?php
            echo '<p style="color: green;">'.$temp_pass.'</p>';
            ?>
            <a href="login.php" >Login</a>

        </form>
        <?php if (isset($error_message)) echo "<p style='color: red;' class='error-message'>$error_message</p>"; ?>
    </div>
    <script> 
        function validateForm() {
            let username = document.getElementById("username").value;
            let email = document.getElementById("email").value;

            if (username === "") {
                alert("user Name must be filled out");
                return false;
            }

            if (email === "") {
                alert("Email must be filled out");
                return false;
            }

        return true;
        }</script>

</body>
</html>