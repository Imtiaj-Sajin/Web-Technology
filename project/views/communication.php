<?php
session_start();
require "parts.php";
require "../model/users.php"; 

if(!isset($_SESSION['hasLoggedIn'])){
    header("Location: login.php");
    exit();
}

$instructor_id = $_SESSION['userid'];

$user_courses = getCoursesByUserId($instructor_id);

function filterCourses($courses, $searchQuery) {
    $filteredCourses = array();

    foreach ($courses as $course) {
        if (strpos(strtolower($course['course_title']), strtolower($searchQuery)) !== false ||
            strpos(strtolower($course['course_status']), strtolower($searchQuery)) !== false ||
            strpos(strtolower($course['price']), strtolower($searchQuery)) !== false) {
            $filteredCourses[] = $course;
        }
    }

    return $filteredCourses;
}

if (isset($_GET['searchCourses'])) {
    $searchQuery = $_GET['searchCourses'];
    $user_courses = filterCourses($user_courses, $searchQuery);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Courseway</title>
    <link rel="stylesheet" href="styleForCommunication.css">
    <link rel="stylesheet" href="sidebar.css">
    <script src="https://kit.fontawesome.com/aedd1f342b.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            loadPage('personal_chat.php');

            $('.communicationSidebar-content a').click(function(e) {
                e.preventDefault();
                var page = $(this).attr('href');
                loadPage(page);
            });

            function loadPage(page) {
                $.ajax({
                    url: page,
                    success: function(data) {
                        $('.contentDiv').html(data);
                    }
                });
            }
        });
    </script>
</head>
<body>

<div id="communicationSidebar" class="communicationSidebar">
    <div class="communicationSidebar-content">
        <a href="quizzes.php" title="Quizzes"><i class="fas fa-question-circle"></i><span>QA</span></a>
        <a href="discussion.php" title="Courses"><i class="fas fa-comments"></i><span>Discussion</span></a>
        <a href="personal_chat.php" title="Courses"><i class="fas fa-comment-dots"></i><span>Personal Chat</span></a>
    </div>
</div>

<div style="margin-left:190px;">
    <?php header_show(); 
        side_bar_show();
    ?>
</div>

<div class="dashboard-container">
    <br>
    <div class="contentDiv">
        
    </div>
</div>

<?php footer_show(); ?>

</body>
</html>
