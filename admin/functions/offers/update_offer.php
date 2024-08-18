<?php include('../../config/db.php'); 

$date = $_POST['date'];
$discount = $_POST['discount'];
$from = $_POST['from'];
$to = $_POST['to'];
$description = $_POST['description'];

$id = $_POST['id'];

$sql = "UPDATE peak_hour SET from_time = ?, to_time = ?, date = ?, discount = ?, description = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $from, $to, $date, $discount, $description, $id);

if ($stmt->execute()) {
    $result = "1";
} else {
    $result= "2";
}

echo $result;
$stmt->close();

?>