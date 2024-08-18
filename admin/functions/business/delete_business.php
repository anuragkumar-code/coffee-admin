<?php include('../../config/db.php'); 

$id=isset($_POST['id'])?$_POST['id']:'';
$status = 'D';

$sql = "UPDATE users SET status = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $status, $id);

if ($stmt->execute()) {
    echo '1'; 
} else {
    echo '0'; 
}

$stmt->close();
$conn->close();
?>