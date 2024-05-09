<?php
session_start();
require "parts.php";
require "../model/users.php"; 

if (!isset($_SESSION['hasLoggedIn'])) {
    header("Location: login.php");
    exit();
}

$instructor_id = $_SESSION['userid'];

$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $sub_category = $_POST['sub_category'];
    $price = $_POST['price'];
    
    if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
        $thumbnail_tmp_name = $_FILES['thumbnail']['tmp_name'];

        $thumbnail_content = file_get_contents($thumbnail_tmp_name);

        $success = createCourse($title, $description, $category, $sub_category, $price, $thumbnail_content, $instructor_id);

        if ($success) {
            $successMessage = "Course created successfully!";
        } else {
            $successMessage = "Failed to create course.";
        }
    } else {
        $successMessage = "Failed to upload image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Course | Courseway</title>
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="sidebar.css">
    <script src="https://kit.fontawesome.com/aedd1f342b.js" crossorigin="anonymous"></script>

    <script>
        function validateForm() {
            let title = document.getElementById("title").value.trim();
            let description = document.getElementById("description").value.trim();
            let category = document.getElementById("category").value.trim();
            let price = document.getElementById("price").value.trim();
            let thumbnail = document.getElementById("thumbnail").value.trim();

            if (title === "") {
                alert("Please enter a course title.");
                return false;
            }
            if (description === "") {
                alert("Please enter a course description.");
                return false;
            }
            if (category === "") {
                alert("Please enter a category.");
                return false;
            }
            if (price === "") {
                alert("Please enter a price.");
                return false;
            }
            if (thumbnail === "") {
                alert("Please select a thumbnail image.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>

<?php header_show(); 
          side_bar_show();
?>

<div class="create_course">
    <h2>Create Courses</h2>
    <?php if (!empty($successMessage)) { ?>
            <p style="color: <?php echo $success ? 'green' : 'red'; ?>"><?php echo $successMessage; ?></p>
    <?php } ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm()" enctype="multipart/form-data" method="post" novalidate>
        <label for="title">Course Title:</label><br>
        <input type="text" id="title" name="title" ><br>
        <label for="description">Description:</label><br>
        <textarea id="description" name="description" ></textarea><br>
        <label for="category">Category:</label><br>
        <input type="text" id="category" name="category" ><br>
        <label for="sub_category">Sub-Category:</label><br>
        <input type="text" id="sub_category" name="sub_category"><br>
        <label for="price">Price:</label><br>
        <input type="number" id="price" name="price" ><br>
        <label for="thumbnail">Thumbnail:</label><br>
        <input type="file" id="thumbnail" name="thumbnail" accept="image/*" ><br><br>
        <input type="submit" value="Create Course">
    </form>
</div>

<?php footer_show(); ?>

</body>
</html>
