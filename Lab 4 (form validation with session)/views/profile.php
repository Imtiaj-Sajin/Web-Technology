<?php session_start() ?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    
<h1>Profile</h1>

<form novalidate>
<table>
    <tr>
        <td>
            <fieldset>
                <legend>General Information:</legend>
                <table>
                    <tr>
                        <td><b>First name</b></td>
                        <td>:</td>
                        <td><?php echo $_SESSION['formData']['firstname'] ?>
                    </td>
                    </tr>
                    <tr>
                        <td><b>Last name</b></td>
                        <td>:</td>
                        <td><?php echo $_SESSION['formData']['lastname']  ; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Gender</b></td>
                        <td>:</td>
                        <td><?php echo $_SESSION['formData']['gender']  ; ?>   
                        </td>
                    </tr>
                    <tr>
                        <td><b>Father's name</b></td>
                        <td>:</td>
                        <td><?php echo $_SESSION['formData']['fathername']  ; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Mother's name</b></td>
                        <td>:</td>
                        <td><?php echo $_SESSION['formData']['mothername']  ; ?>
                    </td>
                    </tr>
                    <tr>
                        <td><b>Blood Group</b></td>
                        <td>:</td>
                        <td>
                            <?php echo $_SESSION['formData']['bloodgroup']  ; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Religion</b></td>
                        <td>:</td>
                        <td>
                            <?php echo $_SESSION['formData']['religion']  ; ?>
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
                        <td><b>Email</b></td>
                        <td>:</td>
                        <td><?php echo $_SESSION['formData']['email']  ; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Phone/Mobile</b></td>
                        <td>:</td>
                        <td><?php echo  $_SESSION['formData']['phonenum']  ; ?>
                    </tr>
                    <tr>
                        <td><b>Website</b></td>
                        <td>:</td>
                        <td><?php echo $_SESSION['formData']['website']  ; ?>
                    </tr>
                    <tr>
                        <td><b>Address</b></td>
                        <td>:</td>
                        <td>
                            <fieldset>
                                <legend><b>Present Address</b></legend>
                                    <select id="country" name="country">
                                        <option><?php echo $_SESSION['formData']['country'];?> </option>
                                    </select>
                                    <select id="city" name="city">
                                        <option><?php echo $_SESSION['formData']['city'];?> </option>
                                    </select>
                                <br>
                                    <?php echo  $_SESSION['formData']['addressbox']  ; ?>
                                <br>
                                <b>Post Code:</b>  <?php echo  $_SESSION['formData']['postcode']  ; ?>
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
                        <td><b>Username</b></td>
                        <td>:</td>
                        <td><?php echo   $_SESSION['formData']['uname']  ; ?>
                    </tr>
                    <tr>
                        <td><b>Password</b></td>
                        <td>:</td>
                        <td><?php echo  $_SESSION['formData']['pass']  ; ?>
                    </tr>
                    
                </table>
            </fieldset>
            <br>
            
        </td>
    </tr>
</table>
</form>

<?php
    session_unset();
    session_destroy();
?>
</body>
</html>
