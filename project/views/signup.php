<?php
session_start();
require "../model/users.php";
function setFormCookies() {
    $inputFields = array( 'bio','email', 'website', 'uname', 'pass', 'conpass');
    foreach ($inputFields as $field) {
        if (isset($_POST[$field])) {
            $value = $_POST[$field];
            setcookie($field, $value, time() + (86400 * 30), "/"); 
        }
    }
    $currentDateTime = date("Y-m-d H:i:s");

    setcookie('last_modified', $currentDateTime, time() + (86400 * 30), "/"); 

}


function getCookieValue($name) {
    return isset($_COOKIE[$name]) ? $_COOKIE[$name] : '';

}
function getLastModifiedTime() {
    if (isset($_COOKIE['last_modified'])) {
        return $_COOKIE['last_modified'];
    }
    return null;
}


?>


<!DOCTYPE html>
<html>
<body >
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
    
<div class="signup-container">
<h2>Registration</h2>
<link rel="stylesheet" href="style.css">

<?php

include '../controllers/validation.php';

$bioErr=$emailErr=$websiteErr='';
$unameErr=$conPassErr=$passErr='';

if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['save_with_cookies'])) {
    setFormCookies();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['registerbtn'])) {

$bio = sanitize ($_POST['bio']);
$email = validateEmail(sanitize ($_POST['email']));
$website = validateWebsite(sanitize ($_POST['website']));
$uname = validateUsername(sanitize ($_POST['uname']));
$pass = validatePassword(sanitize ($_POST['pass']));
$conPass = validateConfirmPassword(sanitize ($_POST['pass']), sanitize ($_POST['conpass']));

    
    $emailErr = $email;
    $websiteErr = $website;
    $unameErr = $uname;
    $passErr = $pass;
    $conPassErr = $conPass;

    

    

    if (empty($emailErr) && empty($unameErr)) {
        $existingUser = getValByUserName($_POST['uname']);
        $existingEmail = getValByEmail($_POST['email']);

        if ($existingUser) {
            $registrationError = "Username already exists";
        } elseif ($existingEmail) {
            $registrationError = "Email already exists";
        } else {
            success();
        }
    } else {
        $registrationError = "Please fix the errors in the form";
    }    
    
}
?> 

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm()" method="post" novalidate>

<?php if (!empty($registrationError)) { ?>
    <p style="color: red;"><?php echo $registrationError; ?></p>
<?php } ?>


<table>
    <tr>
        <td>
            <fieldset>
                <legend>User Information:</legend>
                <table>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><input type="email" id="email" name="email" value="<?php echo getCookieValue('email'); ?>">
                        <?php echo $emailErr; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Bio</td>
                        <td>:</td>
                        <td><textarea id="bio" name="bio"><?php echo getCookieValue('bio'); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Website</td>
                        <td>:</td>
                        <td><input type="url" id="website" name="website"value="<?php echo getCookieValue('website'); ?>">
                        <?php echo $websiteErr; ?></td>
                    </tr>
                    
                </table>
            </fieldset>
        </td>

        
        <td>
            <fieldset>
                <legend>Account Information:</legend>
                <table>
                    <tr>
                        <td>Username</td>
                        <td>:</td>
                        <td><input type="text" id="uname" name="uname" value="<?php echo getCookieValue('uname'); ?>">
                        <?php echo $unameErr; ?></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td>:</td>
                        <td><input  id="pass" name="pass">
                        <?php echo $passErr; ?></td>
                    </tr>
                    <tr>
                        <td>Confirm Password</td>
                        <td>:</td>
                        <td><input  id="conpass" name="conpass">
                        <p class="error"><?php echo $conPassErr; ?></p>
                    </tr>
                </table>
            </fieldset>
            <br>
            

        </td>
        
    </tr>
    
</table>

<input type="submit" id="registerbtn" name="registerbtn" value="Register">
<button type="submit" id="cookiesBtn" name="save_with_cookies">Save Data as Draft</button>

</form>

<br>
<a href="login.php" >Login</a>
</div>
<p>Last modified: <?php echo getCookieValue('last_modified'); ?></p>



<script>
    function validateForm() {
        let email = document.getElementById("email").value;
        let bio = document.getElementById("bio").value;
        let website = document.getElementById("website").value;
        let uname = document.getElementById("uname").value;
        let pass = document.getElementById("pass").value;
        let conpass = document.getElementById("conpass").value;

        if (email === "") {
            alert("Please enter your email");
            return false;
        }else if (!validateEmail(email)) {
            alert("Please enter a valid email address");
            return false;
        }

        if (bio === "") {
            alert("Please enter your bio");
            return false;
        }

        if (website === "") {
            alert("Please enter your website");
            return false;
        }

        if (uname === "") {
            alert("Please enter your username");
            return false;
        }

        if (pass === "") {
            alert("Please enter your password");
            return false;
        }

        if (conpass === "") {
            alert("Please confirm your password");
            return false;
        }

        if (pass !== conpass) {
            alert("Passwords do not match");
            return false;
        }

        function validateEmail(email) {
        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

        return true;
    }
</script>
</body>

</html>