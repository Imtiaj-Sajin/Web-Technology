

<?php

require "../model/users.php";
$isValid = 1;

function sanitize($data) {
    $data = htmlspecialchars($data);
    return $data;
}

function validateFirstName($firstName) {
    global $isValid;
    if (empty($firstName)) {
        $isValid = 0;
        return "First name is empty";
    }
    return "";
}

function validateLastName($lastName) {
    global $isValid;
    if (empty($lastName)) {
        $isValid = 0;
        return "Last name is empty";
    }

    return "";
}

function validateGender($gender) {
   # global $isValid;
    if (empty($gender)) {
        #$isValid = 0;
        return "Gender is required";
    } else {
        return '';
    }

}




function validateBloodGroup($bloodGroup) {
    global $isValid;
    if (empty($bloodGroup)) {
        $isValid = 0;
        return "Blood group is empty";
    }

    return "";
}

function validateReligion($religion) {
    global $isValid;
    if (empty($religion)) {
        $isValid = 0;
        return "Religion is empty";
    }

    return "";
}

function validateEmail($email) {
    global $isValid;
    if (empty($email)) {
        $isValid = 0;
        return "Email is empty";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $isValid = 0;
        return "Invalid email format";
    }

    
    return "";
}

function validatePhoneNumber($phoneNumber) {
    global $isValid;
    if (empty($phoneNumber)) {
        $isValid = 0;
        return "Phone number is empty";
    } 
    if (!preg_match('/^\+880[1-9]\d{9}$/', $phoneNumber)) {
        $isValid = false;
        return "Invalid phone number format. Please enter a valid number with country code +880.";
    }
    return "";
}


function validateWebsite($website) {
    global $isValid;
    if (empty($website)) {
        $isValid = 0;
        return "Empty";
    } elseif (!filter_var($website, FILTER_VALIDATE_URL)) {
        $isValid = 0;
        return "Invalid website URL";
    }
    return "";
}



function validateUsername($username) {
    global $isValid;
    if (empty($username)) {
        $isValid = 0;
        return "Username is empty";
    }
    return "";
}

function validatePassword($password) {
    global $isValid;
    if (empty($password)) {
        $isValid = 0;
        return "Password is empty";
    }

    $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/'; 
    if (!preg_match($pattern, $password)) { 
        $isValid = 0;
        return "Password must contain at least one uppercase letter, one lowercase letter, one number,one special character, and be at least 8 characters long.";
 
}
    return "";
}

function validateConfirmPassword($password, $confirmPassword) {
    global $isValid;
    if (empty($confirmPassword)) {
        $isValid = 0;
        return "Confirm password is empty";
    } elseif ($password !== $confirmPassword) {
        $isValid = 0;
        return "Passwords do not match";
    }
    return "";
}

function success(){
    global $isValid;

    if ($isValid) {
        insertRecord($uname, $pass, $email, $website, $bio);
        header("Location: ../views/dashboard.php");

    }
}
?>