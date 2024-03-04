<?php
session_start();

function setFormCookies() {
    $inputFields = array('firstname', 'lastname', 'fathername', 'mothername', 'bloodgroup', 'religion', 'email', 'phonenum', 'website', 'country','city','addressbox', 'postcode', 'uname', 'pass', 'conpass', 'gender');
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

include '../controllers/validate.php';

$firstNameErr=$lastNameErr=$genderErr=$fatherNameErr=$motherNameErr=$bloodGroupErr=$religionErr=$emailErr=$phoneNumErr=$websiteErr=$addressBoxErr=$postcodeErr='';
$unameErr=$conPassErr=$passErr='';

if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['save_with_cookies'])) {
    setFormCookies();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['registerbtn'])) {

$firstname = validateFirstName(sanitize ($_POST['firstname']));
$lastname = validateLastName(sanitize ($_POST['lastname']));
$fathername = validateFatherName(sanitize ($_POST['fathername']));
$mothername = validateMotherName(sanitize ($_POST['mothername']));
$bloodgroup = validateBloodGroup(sanitize ($_POST['bloodgroup']));
$religion = validateReligion(sanitize ($_POST['religion']));
$email = validateEmail(sanitize ($_POST['email']));
$phonenum = validatePhoneNumber(sanitize ($_POST['phonenum']));
$website = validateWebsite(sanitize ($_POST['website']));
$addressbox = validateAddress(sanitize ($_POST['addressbox']));
$postcode = validatePostcode(sanitize ($_POST['postcode']));
$uname = validateUsername(sanitize ($_POST['uname']));
$pass = validatePassword(sanitize ($_POST['pass']));
$conPass = validateConfirmPassword(sanitize ($_POST['pass']), sanitize ($_POST['conpass']));

    $firstNameErr = $firstname;
    $lastNameErr = $lastname;
    $fatherNameErr = $fathername;
    $motherNameErr = $mothername;
    $bloodGroupErr = $bloodgroup;
    $religionErr = $religion;
    $emailErr = $email;
    $phoneNumErr = $phonenum;
    $websiteErr = $website;
    $addressBoxErr = $addressbox;
    $postcodeErr = $postcode;
    $unameErr = $uname;
    $passErr = $pass;
    $conPassErr = $conPass;

    if (isset($_POST['gender'])) {
        $genderErr = validateGender($_POST['gender']);
    } else {
        $genderErr = "Gender is required";
    }

    

    success();
    
    
}
?> 

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>
<table>
    <tr>
        <td>
            <fieldset>
                <legend>General Information:</legend>
                <table>
                    <tr>
                        <td>First name</td>
                        <td>:</td>
                        <td><input type="text" id="firstname" name="firstname" value="<?php echo getCookieValue('firstname'); ?>">
                        <?php echo $firstNameErr; ?>
                    </td>
                        
                    </tr>
                    <tr>
                        <td>Last name</td>
                        <td>:</td>
                        <td><input type="text" id="lastname" name="lastname" value="<?php echo getCookieValue('lastname'); ?>">
                        <?php echo $lastNameErr; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td>:</td>
                        <td><input type="radio" id="male" name="gender" value="male"<?php echo (getCookieValue('gender') === 'male') ? ' checked' : ''; ?>>
                            <label for="male">Male</label>
                            <input type="radio" id="female" name="gender" value="female"<?php echo (getCookieValue('gender') === 'female') ? ' checked' : ''; ?>>
                            <label for="female">Female</label>
                            <?php echo '<br>'.$genderErr; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Father's name</td>
                        <td>:</td>
                        <td><input type="text" id="fathername" name="fathername" value="<?php echo getCookieValue('fathername'); ?>">
                        <?php echo $fatherNameErr; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Mother's name</td>
                        <td>:</td>
                        <td><input type="text" id="mothername" name="mothername" value="<?php echo getCookieValue('mothername'); ?>">
                        <?php echo $motherNameErr; ?>
                    </td>
                    </tr>
                    <tr>
                        <td>Blood Group</td>
                        <td>:</td>
                        <td>
                            <select id="bloodgroup" name="bloodgroup">
                                <option value="b+"<?php echo (getCookieValue('bloodgroup')==='b+')? 'selected': ''?>>B+</option>
                                <option value="b-"<?php echo (getCookieValue('bloodgroup')==='b-')? 'selected': ''?>>B-</option>
                                <option value="o+"<?php echo (getCookieValue('bloodgroup')==='o+')? 'selected': ''?>>O+</option>
                                <option value="o-"<?php echo (getCookieValue('bloodgroup')==='o-')? 'selected': ''?>>O-</option>
                                <option value="a+"<?php echo (getCookieValue('bloodgroup')==='a+')? 'selected': ''?>>A+</option>
                                <option value="ab+"<?php echo (getCookieValue('bloodgroup')==='ab+')? 'selected': ''?>>AB+</option>
                            </select>
                            <?php echo $bloodGroupErr; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Religion</td>
                        <td>:</td>
                        <td>
                            <select id="religion" name="religion">
                                <option value="islam"<?php echo (getCookieValue('religion')==='islam')? 'selected': ''?>>Islam</option>
                                <option value="hindu"<?php echo (getCookieValue('religion')==='hindu')? 'selected': ''?>>Hindu</option>
                                <option value="christianity"<?php echo (getCookieValue('religion')==='christianity')? 'selected': ''?>>Christianity</option>
                            </select>
                            <?php echo $religionErr; ?>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </td>

        <td>
            <fieldset>
                <legend>Contact Information:</legend>
                <table>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><input type="email" id="email" name="email" value="<?php echo getCookieValue('email'); ?>">
                        <?php echo $emailErr; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Phone/Mobile</td>
                        <td>:</td>
                        <td><input type="tel" id="phonenum" name="phonenum" value="<?php echo getCookieValue('phonenum'); ?>">
                        <?php echo $phoneNumErr; ?></td>
                    </tr>
                    <tr>
                        <td>Website</td>
                        <td>:</td>
                        <td><input type="url" id="website" name="website"value="<?php echo getCookieValue('website'); ?>">
                        <?php echo $websiteErr; ?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>:</td>
                        <td>
                            <fieldset>
                                <legend>Present Address</legend>
                                <select id="country" name="country">
                                    <option value="Bangladesh" <?php echo (getCookieValue('country')==='Bangladesh')? 'selected': ''?>>Bangladesh</option>
                                    <option value="Japan"<?php echo (getCookieValue('country')==='Japan')? 'selected': ''?>>Japan</option>
                                    <option value="England"<?php echo (getCookieValue('country')==='England')? 'selected': ''?>>England</option>
                                </select>

                                <select id="city" name="city">
                                    <option value="Dhaka"<?php echo (getCookieValue('city')==='Dhaka')? 'selected': ''?>>Dhaka</option>
                                    <option value="Comilla"<?php echo (getCookieValue('city')==='Comilla')? 'selected': ''?>>Comilla</option>
                                    <option value="Chittagong"<?php echo (getCookieValue('city')==='Chittagong')? 'selected': ''?>>Chittagong</option>
                                </select>
                                <br>
                                <textarea id="addressbox" name="addressbox" placeholder="Road/Street/City" rows="5" cols="20"><?php echo getCookieValue('addressbox'); ?></textarea>
                                <br><?php echo $addressBoxErr; ?>
                                <br>
                                <input type="text" id="postcode" name="postcode" placeholder="Post Code" value="<?php echo getCookieValue('postcode'); ?>">
                                <br><?php echo $postcodeErr; ?>
                            </fieldset>
                        </td>
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
<p>Last modified: <?php echo getCookieValue('last_modified'); ?></p>

</body>
</html>
