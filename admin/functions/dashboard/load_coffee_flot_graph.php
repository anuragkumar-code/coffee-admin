<?php
include('../../config/db.php');

$currentYear = date("Y");

$mediumRoastedData = array_fill(1, 12, 0);
$highlyRoastedData = array_fill(1, 12, 0);

// Query to get the count of orders by month and beans type
$query = "SELECT c.beans_type, MONTH(o.created_at) as month, COUNT(o.id) as count FROM orders o JOIN coffee c ON o.coffee_id = c.id
    WHERE YEAR(o.created_at) = ? GROUP BY c.beans_type, MONTH(o.created_at)";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $currentYear);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $month = (int)$row['month'];
    if ($row['beans_type'] === 'Medium Roasted') {
        $mediumRoastedData[$month] = (int)$row['count'];
    } elseif ($row['beans_type'] === 'Highly Roasted') {
        $highlyRoastedData[$month] = (int)$row['count'];
    }
}

$response = [
    'mediumRoasted' => array_map(function($key, $value) { return [$key, $value]; }, array_keys($mediumRoastedData), $mediumRoastedData),
    'highlyRoasted' => array_map(function($key, $value) { return [$key, $value]; }, array_keys($highlyRoastedData), $highlyRoastedData),
];

echo json_encode($response);

$conn->close();
?>
