<?php
include '../model/users.php';

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['instructor_id'])) {
    $userId = $_POST['instructor_id'];
    $userData = getValById($userId);
    echo "<h2>Old Profile</h2>";
    if ($userData) {
        echo "User Name: " . $userData['instructor_name'] . "<br>";
        echo "User Password: " . $userData['instructor_pass'] . "<br>";
    } else {
        echo " ";
    }
}



if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['update_username'])) {
    $userId = $_POST['instructor_id'];
    $newUsername = $_POST['new_username'];
   
    updateName($userId, $newUsername);

    $userId = $_POST['instructor_id'];
    $userData = getValById($userId);
    
    echo "<h2>New Profile</h2>";

    if ($userData) {
        echo "User Name: " . $userData['instructor_name'] . "<br>";
        echo "User Password: " . $userData['instructor_pass'] . "<br>";
    } else {
        echo " ";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['update_password'])) {
    $userId = $_POST['instructor_id'];
    $newPassword = $_POST['new_password'];
    
        updatePass($userId, $newPassword);$userId = $_POST['instructor_id'];
    $userData = getValById($userId);

    echo "<h2>New Profile</h2>";

    if ($userData) {
        echo "User Name: " . $userData['instructor_name'] . "<br>";
        echo "User Password: " . $userData['instructor_pass'] . "<br>";
    } else {
        echo " ";
    }
    
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
</head>
<body>
    <h2>Update User</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="instructor_id" value="<?php echo $_POST['instructor_id']; ?>">
        New Username: <input type="text" name="new_username">
        <button type="submit" name="update_username">Update Username</button>
        <br>
        <br>
        <br>
        New Password: <input type="password" name="new_password">
        <button type="submit" name="update_password">Update Password</button>
    </form>
    <a href="../views/records.php">All Records</a>

</body>
</html>
