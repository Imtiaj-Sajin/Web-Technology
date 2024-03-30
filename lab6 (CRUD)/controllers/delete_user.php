<?php
include '../model/users.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];
    deleteRecord($userId);
    header("Location: ../views/records.php"); 
    exit(); 
}
2?>
