<?php
include('../../config/db.php');

if (isset($_POST['ein'])) {
    $ein = $_POST['ein'];

    $sql = "SELECT * FROM users WHERE ein = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $ein);
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
