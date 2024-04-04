<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "webtech";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

function credentials($username, $password) {
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE user_name = ? AND user_pass = ?");
        if (!$stmt) {
            throw new Exception($conn->error);
        }
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return ($num_rows == 1); 
    } catch (Exception $e) {
        echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
        return false; 
    }
}

function insertRecord($username, $user_pass, $email, $website, $bio) {
    global $conn;
    try {
        $stmt = $conn->prepare("INSERT INTO users (user_name, user_pass, email, website, bio) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            throw new Exception($conn->error);
        }
        $stmt->bind_param("sssss", $username, $user_pass, $email, $website, $bio);
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

function updateEmail($user_id, $new_email) {
    global $conn;
    try {
        $stmt = $conn->prepare("UPDATE users SET email = ? WHERE user_id = ?");
        if (!$stmt) {
            throw new Exception($conn->error); 
        }
        $stmt->bind_param("si", $new_email, $user_id);
        $stmt->execute();
        echo "<p style='color: green;'>Email updated successfully</p><br>"; 
        $stmt->close();
    } catch (Exception $e) {
        echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>"; 
    }
}

function updateBio($user_id, $new_bio) {
    global $conn;
    try {
        $stmt = $conn->prepare("UPDATE users SET bio = ? WHERE user_id = ?");
        if (!$stmt) {
            throw new Exception($conn->error); 
        }
        $stmt->bind_param("si", $new_bio, $user_id);
        $stmt->execute();
        echo "<p style='color: green;'>Bio updated successfully</p><br>"; 
        $stmt->close();
    } catch (Exception $e) {
        echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>"; 
    }
}

function updateWebsite($user_id, $new_website) {
    global $conn;
    try {
        $stmt = $conn->prepare("UPDATE users SET website = ? WHERE user_id = ?");
        if (!$stmt) {
            throw new Exception($conn->error); 
        }
        $stmt->bind_param("si", $new_website, $user_id);
        $stmt->execute();
        echo "<p style='color: green;'>Website updated successfully</p><br>"; 
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

function getValById($user_id) {
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT user_id, user_name, user_pass, email, bio, website FROM users WHERE user_id = ?");
        if (!$stmt) {
            throw new Exception($conn->error); 
        }
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return array(
                "user_id" => $row['user_id'],
                "user_name" => $row['user_name'],
                "user_pass" => $row['user_pass'],
                "email" => $row['email'],
                "bio" => $row['bio'],
                "website" => $row['website']
            );
        } else {
            return null; 
        }
    } catch (Exception $e) {
        echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>"; 
    }
}

function getValByUserName($user_name) {
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT user_id, user_name, user_pass, email, bio, website FROM users WHERE user_name = ?");
        if (!$stmt) {
            throw new Exception($conn->error); 
        }
        $stmt->bind_param("s", $user_name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return array(
                "user_id" => $row['user_id'],
                "user_name" => $row['user_name'],
                "user_pass" => $row['user_pass'],
                "email" => $row['email'],
                "bio" => $row['bio'],
                "website" => $row['website']
            );
        } else {
            return null; 
        }
    } catch (Exception $e) {
        echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>"; 
    }
}

function getValByEmail($email) {
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT user_id, user_name, user_pass, email, bio, website  FROM users WHERE email = ?");
        if (!$stmt) {
            throw new Exception($conn->error); 
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return array(
                "user_id" => $row['user_id'],
                "user_name" => $row['user_name'],
                "user_pass" => $row['user_pass'],
                "email" => $row['email'],
                "bio" => $row['bio'],
                "website" => $row['website']
            );
        } else {
            return null; 
        }
    } catch (Exception $e) {
        echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>"; 
        return null;
    }
}
?>
