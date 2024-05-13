<?php
//session_start();
require_once "../model/ChatModel.php";

// if(!isset($_SESSION['hasLoggedIn'])){
//     header("Location: login.php");
//     exit();
// }

if(isset($_GET['user1']) && isset($_GET['user2'])) {
    //echo "fasdf";
    $user1 = $_GET['user1'];
    $user2 = $_GET['user2'];
    $messages = ChatModel::getChatHistory($user1, $user2);
    // echo $messages;;
    echo json_encode($messages);
} else {
    echo json_encode(['error' => 'Inddvalid request']);
}
?>
