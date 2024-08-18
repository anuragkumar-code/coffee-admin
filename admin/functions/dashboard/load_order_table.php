<?php include('../../config/db.php'); ?>

<table class="table border-top-0  table-bordered text-nowrap border-bottom" id="responsive-datatable">
	<thead>
		<tr>
			<th class="text-center wd-15p border-bottom-0">S. No.</th>
			<th class="text-center wd-15p border-bottom-0">Order ID</th>
			<th class="text-center wd-20p border-bottom-0">Coffee</th>
			<th class="text-center wd-15p border-bottom-0">Customer Name</th>
			<th class="text-center wd-15p border-bottom-0">Quantity</th>
		</tr>
	</thead>
	<tbody>

<?php $sno = '';
$query = "SELECT orders.order_id AS order_id, orders.quantity, coffee.coffee_name AS coffee_name, users.name AS user_name FROM orders JOIN coffee ON orders.coffee_id = coffee.id JOIN users ON orders.user_id = users.id";
$result = $conn->query($query);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$sno++;
?>
		<tr>
			<td class="text-center"><?php echo $sno; ?></td>
			<td class="text-center"><?php echo $row['order_id'] ?></td>
			<td class="text-center"><?php echo $row['coffee_name'] ?></td>
			<td class="text-center"><?php echo $row['user_name'] ?></td>
			<td class="text-center"><?php echo $row['quantity'] ?></td>
		</tr>
<?php }} ?>
	</tbody>
</table>

<script>
	$('#responsive-datatable').DataTable({
   		language: {
       		searchPlaceholder: 'Search...',
       		scrollX: "100%",
       		sSearch: '',
   		}
  	});
</script>