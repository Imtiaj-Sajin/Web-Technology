<?php
session_start();
require "parts.php";
require "../model/users.php"; // Include the users model file

if(!isset($_SESSION['hasLoggedIn'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['userid'];

$user_courses = getCoursesByUserId($user_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Courseway</title>
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="sidebar.css">
    <script src="https://kit.fontawesome.com/aedd1f342b.js" crossorigin="anonymous"></script>
    
</head>
<body>

<?php header_show(); 
          side_bar_show();
    ?>
<div class="dashboard-container">
    <div class="contentDiv">
        <h1>Course Content</h1>
        <br>
        <input type="text" id="serachCourses" name="serachCourses" placeholder="Search Course">
        <input type="button" id="course_search_btn" value="Search">
        <a href="createCourse.php"><input type="button" id="course_create_btn" value="New Course"></a>

    </div>
    <div class="course_list">
    
    <div class="course-cards">
        <?php foreach($user_courses as $course): ?>
            <div class="course-card">
                <div class="course-thumbnail">
                    <?php
                        $base64_thumbnail = base64_encode($course['thumbnail']);
                        echo '<img src="data:image/jpeg;base64,' . $base64_thumbnail . '" alt="Course Thumbnail">';
                    ?>
                </div>
                <div class="course-details">
                    <h3><?php echo $course['course_title']; ?></h3>
                    <p class="course-status"><?php echo $course['course_status']; ?></p>
                </div>
                <div class="course-price">
                    <p>$<?php echo $course['price']; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</div>

<?php footer_show(); ?>

</body>
</html>
