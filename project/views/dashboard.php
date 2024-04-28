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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="sidebar.css">
    <script src="https://kit.fontawesome.com/aedd1f342b.js" crossorigin="anonymous"></script>
    
</head>
<body>

<div class="dashboard-container">
    <?php header_show(); 
          side_bar_show();
    ?>

    

    <div class="content">
        <h2>Dashboard Content</h2>
    </div>
</div>

<?php footer_show(); ?>

</body>
</html>
