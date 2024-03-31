<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "test";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

function insertRecord($username, $user_pass) {
    global $conn;
    try {
        $stmt = $conn->prepare("INSERT INTO users (user_name, user_pass) VALUES (?, ?)");
        if (!$stmt) {
            throw new Exception($conn->error);
        }
        $stmt->bind_param("ss", $username, $user_pass);
        $stmt->execute();
        echo "<p style='color: green;'>New record created successfully</p><br>"; 
        $stmt->close();
    } catch (Exception $e) {
        echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>"; 
    }
}

function updateName($user_id, $username) {
    global $conn;
    try {
        $stmt = $conn->prepare("UPDATE users SET user_name = ? WHERE user_id = ?");
        if (!$stmt) {
            throw new Exception($conn->error); 
        }
        $stmt->bind_param("si", $username, $user_id);
        $stmt->execute();
        echo "<p style='color: green;'>User Name updated successfully</p><br>";  
        $stmt->close();
    } catch (Exception $e) {
        echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>"; 
    }
}

function updatePass($user_id, $new_pass) {
    global $conn;
    try {
        $stmt = $conn->prepare("UPDATE users SET user_pass = ? WHERE user_id = ?");
        if (!$stmt) {
            throw new Exception($conn->error); 
        }
        $stmt->bind_param("si", $new_pass, $user_id);
        $stmt->execute();
        echo "<p style='color: green;'>Password updated successfully</p><br>"; 
        $stmt->close();
    } catch (Exception $e) {
        echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>"; 
    }
}

function deleteRecord($userId) {
    global $conn;
    try {
        $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
        if (!$stmt) {
            throw new Exception($conn->error); 
        }
        $stmt->bind_param("s", $userId);
        $stmt->execute();
        echo "<p style='color: green;'>Record deleted successfully</p><br>"; 
        $stmt->close();
    } catch (Exception $e) {
        echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>"; 
    }
}

function getAll() {
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT user_id, user_name, user_pass FROM users");
        if (!$stmt) {
            throw new Exception($conn->error); 
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $arr1 = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $arr1[] = $row;
            }
        }

        return $arr1;
    } catch (Exception $e) {
        echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>"; 
    }
}

function getVal($user_id) {
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT user_name, user_pass FROM users WHERE user_id = ?");
        if (!$stmt) {
            throw new Exception($conn->error); 
        }
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return array("user_name" => $row['user_name'], "user_pass" => $row['user_pass']);
        } else {
            return null; 
        }
    } catch (Exception $e) {
        echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>"; 
    }
}
?>
