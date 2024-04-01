<?php
session_start();
if(!isset($_SESSION['hasLoggedIn'])){
    header("Location: login.php");
    exit();
}

include '../model/users.php';
include 'parts.php';

$userData = getValById($_SESSION['userid']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update_username'])) {
        $newUsername = $_POST['new_username'];
        updateName($_SESSION['userid'], $newUsername);
    }
    if (isset($_POST['update_email'])) {
        $newEmail = $_POST['new_email'];
        updateEmail($_SESSION['userid'], $newEmail);
    }
    if (isset($_POST['update_bio'])) {
        $newBio = $_POST['new_bio'];
        updateBio($_SESSION['userid'], $newBio);
    }
    if (isset($_POST['update_website'])) {
        $newWebsite = $_POST['new_website'];
        updateWebsite($_SESSION['userid'], $newWebsite);
    }

    $userData = getValById($_SESSION['userid']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Courseway</title>
</head>
<body>
    <?php header_show(); ?>
    <br>
    <fieldset>
        <table width="100%"> 
            <tr>
                <td width="150px">
                    <ul>
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="#">Courses</a></li>
                        <li><a href="#">Communication</a></li>
                        <li><a href="profile.php">Profile</a></li>
                        <li><a href="changePass.php">change Pass</a></li>
                        <li><a href="../controllers/logout.php">Logout</a></li>
                    </ul>
                </td>
                <td align="center">
                    <h2>User Profile</h2>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <p>User ID: <?php echo $userData['user_id']; ?></p>

                        <label for="new_username">Username:</label>
                        <input type="text" id="new_username" name="new_username" value="<?php echo $userData['user_name']; ?>">
                        <button type="submit" name="update_username">Update</button><br>

                        <label for="new_email">Email:</label>
                        <input type="email" id="new_email" name="new_email" value="<?php echo $userData['email']; ?>">
                        <button type="submit" name="update_email">Update</button><br>

                        <label for="new_bio">Bio:</label>
                        <textarea id="new_bio" name="new_bio"><?php echo $userData['bio']; ?></textarea>
                        <button type="submit" name="update_bio">Update</button><br>

                        <label for="new_website">Website:</label>
                        <input type="text" id="new_website" name="new_website" value="<?php echo $userData['website']; ?>">
                        <button type="submit" name="update_website">Update</button><br>
                    </form>
                </td>
            </tr>
        </table>
    </fieldset>
    
    <?php
    

    footer_show();
    ?>
</body>
</html>
