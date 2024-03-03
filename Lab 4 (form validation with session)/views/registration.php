<?php
session_start();
?>


<!DOCTYPE html>
<html>
<body>

<h1>Registration</h1>
<?php

include '../controllers/validate.php';

$firstNameErr=$lastNameErr=$genderErr=$fatherNameErr=$motherNameErr=$bloodGroupErr=$religionErr=$emailErr=$phoneNumErr=$websiteErr=$addressBoxErr=$postcodeErr='';
$unameErr=$conPassErr=$passErr='';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

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
                        <td><input type="text" id="firstname" name="firstname">
                        <?php echo $firstNameErr; ?>
                    </td>
                        
                    </tr>
                    <tr>
                        <td>Last name</td>
                        <td>:</td>
                        <td><input type="text" id="lastname" name="lastname">
                        <?php echo $lastNameErr; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td>:</td>
                        <td><input type="radio" id="male" name="gender" value="male">
                            <label for="male">Male</label>
                            <input type="radio" id="female" name="gender" value="female">
                            <label for="female">Female</label>
                            <?php echo '<br>'.$genderErr; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Father's name</td>
                        <td>:</td>
                        <td><input type="text" id="fathername" name="fathername">
                        <?php echo $fatherNameErr; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Mother's name</td>
                        <td>:</td>
                        <td><input type="text" id="mothername" name="mothername">
                        <?php echo $motherNameErr; ?>
                    </td>
                    </tr>
                    <tr>
                        <td>Blood Group</td>
                        <td>:</td>
                        <td>
                            <select id="bloodgroup" name="bloodgroup">
                                <option value="b+">B+</option>
                                <option value="o+">O+</option>
                                <option value="a+">A+</option>
                            </select>
                            <?php echo $bloodGroupErr; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Religion</td>
                        <td>:</td>
                        <td>
                            <select id="religion" name="religion">
                                <option value="islam">Islam</option>
                                <option value="islam">Islam</option>
                                <option value="islam">Islam</option>
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
                        <td><input type="email" id="email" name="email">
                        <?php echo $emailErr; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Phone/Mobile</td>
                        <td>:</td>
                        <td><input type="tel" id="phonenum" name="phonenum">
                        <?php echo $phoneNumErr; ?></td>
                    </tr>
                    <tr>
                        <td>Website</td>
                        <td>:</td>
                        <td><input type="url" id="website" name="website">
                        <?php echo $websiteErr; ?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>:</td>
                        <td>
                            <fieldset>
                                <legend>Present Address</legend>
                                <select id="country" name="country">
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Japan">Japan</option>
                                    <option value="England">England</option>
                                </select>

                                <select id="city" name="city">
                                    <option value="Dhaka">Dhaka</option>
                                    <option value="Comilla">Comilla</option>
                                    <option value="Chittagong">Chittagong</option>
                                </select>
                                <br>
                                <textarea id="addressbox" name="addressbox" placeholder="Road/Street/City" rows="5" cols="20"></textarea>
                                <br><?php echo $addressBoxErr; ?>
                                <br>
                                <input type="text" id="postcode" name="postcode" placeholder="Post Code">
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
                        <td><input type="text" id="uname" name="uname">
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
            
        </td>
    </tr>
</table>
</form>

</body>
</html>
