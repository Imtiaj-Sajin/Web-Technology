<?php
session_start();
require "parts.php";
require "../model/users.php"; 

if(!isset($_SESSION['hasLoggedIn'])){
    header("Location: login.php");
    exit();
}
?>

<div class="message-container">
    <h2>Personal Chat</h2>
    <div class="message-list">
        <div class="message">
            <div class="message-sender">Alice</div>
            <div class="message-body">Hi Bob, how are you?</div>
            <div class="message-time">10:00 AM</div>
        </div>
        <div class="message">
            <div class="message-sender">Bob</div>
            <div class="message-body">Hey Alice, I'm good. How about you?</div>
            <div class="message-time">10:05 AM</div>
        </div>
        <!-- Add more messages here -->
    </div>
    <div class="message-input">
        <input type="text" placeholder="Type your message...">
        <button>Send</button>
    </div>
</div>