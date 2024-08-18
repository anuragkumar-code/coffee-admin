<?php
include('../../config/db.php');

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '0'; 
    } else {
        echo '1';
    }

    $stmt->close();
    $conn->close();
}

?>
