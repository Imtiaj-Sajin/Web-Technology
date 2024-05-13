<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webtech";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function insertPersonalChat($fromId, $toId, $message) {
    global $conn;
    try {
        $stmt = $conn->prepare("INSERT INTO personal_chats (sender_id, receiver_id, message) VALUES (?, ?, ?)");
        if (!$stmt) {
            throw new Exception($conn->error);
        }
        $stmt->bind_param("iis", $fromId, $toId, $message);
        $stmt->execute();
        echo "Chat message inserted successfully";
        $stmt->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

$fromId = $_POST['fromId'];
$toId = $_POST['toId'];
$message = $_POST['message'];

insertPersonalChat($fromId, $toId, $message);
?>
