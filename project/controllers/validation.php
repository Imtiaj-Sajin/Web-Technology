
<?php
$isValid = 1;
function sanitize($data) {
    $data = htmlspecialchars($data);
    return $data;
}

function validateUserName($username) {
    global $isValid;
    if (empty($username)) {
        $isValid = 0;
        return 0;
    }
    return 1;
}

?>