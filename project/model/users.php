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
        $stmt = $conn->prepare("SELECT instructor_id FROM instructors WHERE instructor_name = ? AND instructor_pass = ?");
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

function insertRecord($username, $instructor_pass, $email, $website, $bio) {
    global $conn;
    try {
        $stmt = $conn->prepare("INSERT INTO instructors (instructor_name, instructor_pass, email, website, bio) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            throw new Exception($conn->error);
        }
        $stmt->bind_param("sssss", $username, $instructor_pass, $email, $website, $bio);
        $stmt->execute();
        echo "<p style='color: green;'>New record created successfully</p><br>"; 
        $stmt->close();
    } catch (Exception $e) {
        echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>"; 
    }
}


function updateName($instructor_id, $username) {
    global $conn;
    try {
        $stmt = $conn->prepare("UPDATE instructors SET instructor_name = ? WHERE instructor_id = ?");
        if (!$stmt) {
            throw new Exception($conn->error); 
        }
        $stmt->bind_param("si", $username, $instructor_id);
        $stmt->execute();
        echo "<p style='color: green;'>User Name updated successfully</p><br>";  
        $stmt->close();
    } catch (Exception $e) {
        echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>"; 
    }
}

function updatePass($instructor_id, $new_pass) {
    global $conn;
    try {
        $stmt = $conn->prepare("UPDATE instructors SET instructor_pass = ? WHERE instructor_id = ?");
        if (!$stmt) {
            throw new Exception($conn->error); 
        }
        $stmt->bind_param("si", $new_pass, $instructor_id);
        $stmt->execute();
        echo "<p style='color: green;'>Password updated successfully</p><br>"; 
        $stmt->close();
    } catch (Exception $e) {
        echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>"; 
    }
}

function updateEmail($instructor_id, $new_email) {
    global $conn;
    try {
        $stmt = $conn->prepare("UPDATE instructors SET email = ? WHERE instructor_id = ?");
        if (!$stmt) {
            throw new Exception($conn->error); 
        }
        $stmt->bind_param("si", $new_email, $instructor_id);
        $stmt->execute();
        echo "<p style='color: green;'>Email updated successfully</p><br>"; 
        $stmt->close();
    } catch (Exception $e) {
        echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>"; 
    }
}

function updateBio($instructor_id, $new_bio) {
    global $conn;
    try {
        $stmt = $conn->prepare("UPDATE instructors SET bio = ? WHERE instructor_id = ?");
        if (!$stmt) {
            throw new Exception($conn->error); 
        }
        $stmt->bind_param("si", $new_bio, $instructor_id);
        $stmt->execute();
        echo "<p style='color: green;'>Bio updated successfully</p><br>"; 
        $stmt->close();
    } catch (Exception $e) {
        echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>"; 
    }
}

function updateWebsite($instructor_id, $new_website) {
    global $conn;
    try {
        $stmt = $conn->prepare("UPDATE instructors SET website = ? WHERE instructor_id = ?");
        if (!$stmt) {
            throw new Exception($conn->error); 
        }
        $stmt->bind_param("si", $new_website, $instructor_id);
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
        $stmt = $conn->prepare("DELETE FROM instructors WHERE instructor_id = ?");
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
        $stmt = $conn->prepare("SELECT instructor_id, instructor_name, instructor_pass FROM instructors");
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

function getValById($instructor_id) {
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT instructor_id, instructor_name, instructor_pass, email, bio, website FROM instructors WHERE instructor_id = ?");
        if (!$stmt) {
            throw new Exception($conn->error); 
        }
        $stmt->bind_param("i", $instructor_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return array(
                "instructor_id" => $row['instructor_id'],
                "instructor_name" => $row['instructor_name'],
                "instructor_pass" => $row['instructor_pass'],
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

function getValByUserName($instructor_name) {
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT instructor_id, instructor_name, instructor_pass, email, bio, website FROM instructors WHERE instructor_name = ?");
        if (!$stmt) {
            throw new Exception($conn->error); 
        }
        $stmt->bind_param("s", $instructor_name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return array(
                "instructor_id" => $row['instructor_id'],
                "instructor_name" => $row['instructor_name'],
                "instructor_pass" => $row['instructor_pass'],
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
        $stmt = $conn->prepare("SELECT instructor_id, instructor_name, instructor_pass, email, bio, website  FROM instructors WHERE email = ?");
        if (!$stmt) {
            throw new Exception($conn->error); 
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return array(
                "instructor_id" => $row['instructor_id'],
                "instructor_name" => $row['instructor_name'],
                "instructor_pass" => $row['instructor_pass'],
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

function getCoursesByUserId($instructor_id) {
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT * FROM courses WHERE instructor_id = ?");
        if (!$stmt) {
            throw new Exception($conn->error); 
        }
        $stmt->bind_param("i", $instructor_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $courses = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $courses[] = $row;
            }
        }
        return $courses;
    } catch (Exception $e) {
        echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>"; 
        return array();
    }
}

function createCourse($title, $description, $category, $sub_category, $price, $thumbnail, $instructor_id) {
    global $conn;
    try {
        $stmt = $conn->prepare("INSERT INTO courses (course_title, description, category, sub_category, price, thumbnail, course_status, instructor_id) VALUES (?, ?, ?, ?, ?, ?, 'published', ?)");
        if (!$stmt) {
            throw new Exception($conn->error);
        }
        $stmt->bind_param("ssssdss", $title, $description, $category, $sub_category, $price, $thumbnail, $instructor_id);
        $success = $stmt->execute();
        $stmt->close();
        
        return $success;
    } catch (Exception $e) {
        echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
        return false;
    }
}

function getAllUsers() {
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT user_id, user_name, user_photo FROM users");
        if (!$stmt) {
            throw new Exception($conn->error);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $allUsers = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $imageData = base64_encode($row['user_photo']); 
                $imageSrc = 'data:image/jpeg;base64,' . $imageData;
                $user = array(
                    'user_id' => $row['user_id'],
                    'user_name' => $row['user_name'],
                    'user_photo' => $imageSrc 
                );
                $allUsers[] = $user;
            }
        }
        return $allUsers;
    } catch (Exception $e) {
        echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
        return array();
    }
}




function InstructorId_ToUserId($instructorId) {
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE instructor_id = ?");
        if (!$stmt) {
            throw new Exception($conn->error); 
        }
        $stmt->bind_param("i", $instructorId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return $row['user_id'];
        } else {
            return null; 
        }
    } catch (Exception $e) {
        echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>"; 
        return null;
    }
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
        echo "<p style='color: green;'>Personal chat message inserted successfully</p>";
        $stmt->close();
    } catch (Exception $e) {
        echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
    }
}

?>
