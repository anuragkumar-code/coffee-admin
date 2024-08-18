<?php include('../../config/db.php'); 

$name=isset($_POST['name'])?$_POST['name']:'';
$email=isset($_POST['email'])?$_POST['email']:'';
$password=isset($_POST['password'])?$_POST['password']:'';

$roles=isset($_POST['roles'])?$_POST['roles']:'';

$encrypt = md5($password);

$sql = "INSERT INTO admins (name, email, password, role) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $encrypt, $roles);

if ($stmt->execute()) {
    echo '1';
} else {
    echo '0';
}

$stmt->close();
$conn->close();

?>