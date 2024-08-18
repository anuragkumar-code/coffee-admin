<?php
include('../../config/db.php');

$currentYear = date("Y");

// here initialising data arrays
$individualData = array_fill(1, 12, 0);
$businessData = array_fill(1, 12, 0);

$query = "SELECT u.user_type, MONTH(o.created_at) as month, COUNT(o.id) as count FROM orders o JOIN users u ON o.user_id = u.id
    WHERE YEAR(o.created_at) = ? GROUP BY u.user_type, MONTH(o.created_at)";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $currentYear);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $month = (int)$row['month'];
    if ($row['user_type'] === 'individual') {
        $individualData[$month] = (int)$row['count'];
    } elseif ($row['user_type'] === 'business') {
        $businessData[$month] = (int)$row['count'];
    }
}

$response = [
    'individual' => array_map(function($key, $value) { return [$key, $value]; }, array_keys($individualData), $individualData),
    'business' => array_map(function($key, $value) { return [$key, $value]; }, array_keys($businessData), $businessData),
];

echo json_encode($response);

$conn->close();
?>
