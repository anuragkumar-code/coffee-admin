<?php
include('../../config/db.php');

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $type = $_POST['type'];
    $currentEmail = isset($_POST['currentEmail']) ? $_POST['currentEmail'] : '';

    $sql = "SELECT * FROM admins WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '0'; 
    } else {
        echo '1';
    }

    if ($result->num_rows > 0) {
        if ($type == 'edit' && $email == $currentEmail) {
            echo '1'; 
        } else {
            echo '0'; 
        }
    } else {
        echo '1'; 
    }

    $stmt->close();
    $conn->close();
}

?>
