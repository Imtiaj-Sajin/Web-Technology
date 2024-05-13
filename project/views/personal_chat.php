    <?php
    session_start();
    require "parts.php";
    require "../model/users.php"; 
    //require "../controllers/get_chat_history.php";

    if(!isset($_SESSION['hasLoggedIn'])){
        header("Location: login.php");
        exit();
    }

    $loggedIndUserId=InstructorId_ToUserId($_SESSION['userid']);
  
    
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
            $allUsers = getAllUsers();
            foreach ($allUsers as $otherUser) {
                echo "<button class='instructor-button' data-instructor-id='".$otherUser['user_id']."' onclick='selectedChat(".json_encode($otherUser).")'>";
                echo "<div class='profile-photo'>";
                echo "<img src='" . $otherUser['user_photo'] . "' alt='Profile Photo'>";
                echo "</div>";
                echo "<div class='instructor-name'>" . $otherUser['user_name'] . "</div>";
                echo "</button>";
            }
            ?>
        </div>
    </div>

    <div class="message-box">
        <!-- person name willbe sohwn  heere -->
        <div class="msg-info"> 
        </div>
        <div class="msg-content">
            <div class="sender_name">

            </div>
        </div>
        <div class="send-msg">
            <input id="messageInput" type="text" placeholder="Type your message...">
            <?php echo '<button onclick="sendMessage(' . $loggedIndUserId . ')" >Send</button>'; ?>
        </div>
    </div>

    <script>

        var selectedOtherUser;
        var loggedIndUserId = <?php echo $loggedIndUserId; ?>;

        function selectedChat(user) {
            var msgInfo = document.querySelector('.msg-info');
            msgInfo.innerHTML = ''; 
            
            var button = document.createElement('button');
            button.classList.add('instructor-button');
            
            var profilePhoto = document.createElement('div');
            profilePhoto.classList.add('profile-photo');
            var img = document.createElement('img');
            img.src = user.user_photo;
            img.alt = 'Profile Photo';
            profilePhoto.appendChild(img);
            
            var instructorName = document.createElement('div');
            instructorName.classList.add('instructor-name');
            instructorName.textContent = user.user_name;
            
            var hiddenId = document.createElement('input');
            hiddenId.type = 'hidden';
            hiddenId.value = user.user_id;
            
            button.appendChild(profilePhoto);
            button.appendChild(instructorName);
            button.appendChild(hiddenId);
            
            msgInfo.appendChild(button);
            // alert("Please enter your email");

            
            selectedOtherUser=user.user_id;

            console.log(loggedIndUserId,selectedOtherUser);
            fetchMessages(loggedIndUserId, selectedOtherUser);

            
            
        }

        function fetchMessages(userId1, userId2) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '../controllers/get_chat_history.php?user1=' + userId1 + '&user2=' + userId2);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var messages = JSON.parse(xhr.responseText);
                    displayMessages(messages);
                    console.log(messages);
                } else {
                    console.error('Error fetching messagesq: ' + xhr.statusText);
                }
            };
            xhr.onerror = function() {
                console.error('Error ');
            };
            xhr.send();
        }

       
        fetchMessages(loggedIndUserId, selectedOtherUser);

        
        setInterval(function() {
            fetchMessages(loggedIndUserId, selectedOtherUser);
        }, 1000); 


        function displayMessages(messages) {
        var msgContent = document.querySelector('.msg-content');
        msgContent.innerHTML = '';

        if (messages.length > 0) {
            messages.forEach(function(message) {
                var lineBreak = document.createElement('br');
                var messageElement = document.createElement('div');

                if (message.sender_id === selectedOtherUser) {
                    messageElement.textContent = message.message; 
                    messageElement.classList.add('message-left'); 
                } else {
                    messageElement.textContent = message.message; 
                    messageElement.classList.add('message-right'); 
                }

                msgContent.appendChild(messageElement);
                msgContent.appendChild(lineBreak);
            });
        } else {
            var noMessagesElement = document.createElement('div');
            noMessagesElement.textContent = 'No messages found.';
            msgContent.appendChild(noMessagesElement);
        }
    }





    function sendMessage(loggedIndUserId) {
    var message = document.getElementById("messageInput").value;

    console.log('other:', selectedOtherUser);
    console.log('own :', loggedIndUserId);
    console.log('message :', message);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../model/insert_chat_message.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
        }
    };
        xhr.send("fromId=" + loggedIndUserId + "&toId=" + selectedOtherUser + "&message=" + encodeURIComponent(message));
    }


    </script>
