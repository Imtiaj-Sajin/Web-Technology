<?php
class ChatModel {
    public static function getChatHistory($user1, $user2) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "webtech";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM personal_chats WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiii", $user1, $user2, $user2, $user1);
        $stmt->execute();
        $result = $stmt->get_result();

        $chatHistory = [];
        while ($row = $result->fetch_assoc()) {
            $chatHistory[] = $row;
        }
        $stmt->close();
        $conn->close();

        return $chatHistory;
    }

    
}
?>
