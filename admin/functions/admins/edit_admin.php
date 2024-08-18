<?php include('../../config/db.php'); 

$id=isset($_POST['id'])?$_POST['id']:'';

$name=isset($_POST['name'])?$_POST['name']:'';
$email=isset($_POST['email'])?$_POST['email']:'';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$roles=isset($_POST['roles'])?$_POST['roles']:'';

if($password == ''){
    $newPassword = $_POST['encryptPassword'];
}else{
    $newPassword = md5($password);
}


$sql = "UPDATE admins SET name = ?, email = ?, password = ?, role = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $name, $email, $newPassword, $roles, $id);

if ($stmt->execute()) {
    echo '1';
} else {
    echo '0';
}

$stmt->close();
$conn->close();

?>