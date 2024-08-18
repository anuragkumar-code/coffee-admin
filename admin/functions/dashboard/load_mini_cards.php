<?php
include('../../config/db.php');

$query = "SELECT COUNT(*) AS all_orders, SUM(CASE WHEN status = 'Packed' THEN 1 ELSE 0 END) AS packed, SUM(CASE WHEN status = 'Shipped' THEN 1 ELSE 0 END) AS shipped, SUM(CASE WHEN status = 'Delivered' THEN 1 ELSE 0 END) AS delivered FROM orders";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // echo json_encode($row);
} else {
    // echo json_encode([
    //     "all_orders" => 0,
    //     "packed" => 0,
    //     "shipped" => 0,
    //     "delivered" => 0
    // ]);
}

$conn->close();
?>

<div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
	<div class="card">
		<div class="card-body">
			<div class="float-end bg-primary shadow-primary stamp stamp-lg">
				<i class="bx bx-cart tx-24"></i>
			</div>
			<div class="text-muted">
				<h5>All Orders</h5>
			</div>
			<span class="mb-1 tx-26 font-weight-semibold"><?php echo $row['all_orders']; ?></span>
		</div>
	</div>
</div>

<div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
	<div class="card">
		<div class="card-body">
			<div class="float-end bg-primary shadow-primary stamp stamp-lg">
				<i class="bx bx-package tx-24"></i>
			</div>
			<div class="text-muted">
				<h5>Packed</h5>
			</div>
			<span class="mb-1 tx-26 font-weight-semibold"><?php echo $row['packed']; ?></span>
		</div>
	</div>
</div>

<div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
	<div class="card">
		<div class="card-body">
			<div class="float-end bg-primary shadow-primary stamp stamp-lg">
				<i class="bx bxs-truck tx-24"></i>
			</div>
			<div class="text-muted">
				<h5>Shipped</h5>
			</div>
			<span class="mb-1 tx-26 font-weight-semibold"><?php echo $row['shipped']; ?></span>
		</div>
	</div>
</div>

<div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
	<div class="card">
		<div class="card-body">
			<div class="float-end bg-primary shadow-primary stamp stamp-lg">
				<i class="bx bx-check-circle tx-24"></i>
			</div>
			<div class="text-muted">
				<h5>Delivered</h5>
			</div>
			<span class="mb-1 tx-26 font-weight-semibold"><?php echo $row['delivered']; ?></span>
		</div>
	</div>
</div>
