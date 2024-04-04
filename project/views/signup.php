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
<body>

<h1>Registration</h1>
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

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>

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
                        <?php echo $conPassErr; ?></td>
                    </tr>
                </table>
            </fieldset>
            <br>
            <button type="submit" id="registerbtn" name="registerbtn">Register</button>
            <button type="submit" name="save_with_cookies">Save Data as Draft</button>

        </td>

    </tr>
</table>


</form>
<br>
<a href="login.php" >Login</a>
<p>Last modified: <?php echo getCookieValue('last_modified'); ?></p>

</body>
</html>