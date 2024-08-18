<?php
include('../../config/db.php');

$statusCounts = [];

$query = "SELECT status, COUNT(*) as count FROM orders GROUP BY status";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $statusCounts[$row['status']] = $row['count'];
    }
}

$data = [];
foreach ($statusCounts as $status => $count) {
    $data[] = [$status, $count];
}

echo json_encode($data);

$conn->close();
?>
