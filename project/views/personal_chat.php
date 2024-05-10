<?php
session_start();
require "parts.php";
require "../model/users.php"; 

if(!isset($_SESSION['hasLoggedIn'])){
    header("Location: login.php");
    exit();
}
?>

<div class="right-sidebar">
    <!-- Search box -->
    <div class="search-box">
        <input type="text" placeholder="Search">
        <button class="search-button"><i class="fas fa-search"></i></button>
    </div>
    
    <!-- List of instructors -->
    <div class="instructors-list">
        <?php
        $instructors = getAllUsers();
        foreach ($instructors as $instructor) {
            echo "<button class='instructor-button' data-instructor-id='" . $instructor['instructor_id'] . "' onclick='myFunction(" . json_encode($instructor) . ")'>";
            echo "<div class='profile-photo'>";
            echo "<img src='" . $instructor['instructor_photo'] . "' alt='Profile Photo'>";
            echo "</div>";
            echo "<div class='instructor-name'>" . $instructor['instructor_name'] . "</div>";
            echo "</button>";
        }
        ?>
    </div>
</div>

<div class="message-box">
    <div class="msg-info">
    </div>
    <div class="msg-content">

    </div>
</div>

<script>
    function myFunction(instructor) {
        var msgInfo = document.querySelector('.msg-info');
        msgInfo.innerHTML = ''; 
        
        var button = document.createElement('button');
        button.classList.add('instructor-button');
        
        var profilePhoto = document.createElement('div');
        profilePhoto.classList.add('profile-photo');
        var img = document.createElement('img');
        img.src = instructor.instructor_photo;
        img.alt = 'Profile Photo';
        profilePhoto.appendChild(img);
        
        var instructorName = document.createElement('div');
        instructorName.classList.add('instructor-name');
        instructorName.textContent = instructor.instructor_name;
        
        var hiddenId = document.createElement('input');
        hiddenId.type = 'hidden';
        hiddenId.value = instructor.instructor_id;
        
        button.appendChild(profilePhoto);
        button.appendChild(instructorName);
        button.appendChild(hiddenId);
        
        msgInfo.appendChild(button);
    }
</script>
