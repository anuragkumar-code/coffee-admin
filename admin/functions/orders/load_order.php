<?php 
include('../../config/db.php'); 

$id=isset($_POST['id'])?$_POST['id']:'';

$query = "SELECT * FROM orders where id = '$id'";
$result = $conn->query($query);
$row = $result->fetch_assoc();

?>

<div class="form-group">
	<label class="main-content-label tx-11 tx-medium">Order ID</label> 
	<input class="form-control" type="text" name="orderIdInp" id="orderInp" value="<?php echo $row['order_id']; ?>" readonly>
</div>
										
<div class="form-group">
	<div class="row row-sm">
		<div class="col-sm-6">
			<label class="main-content-label tx-11 tx-medium">Enter Title</label>
			<div class="row row-sm">
				<div class="col-sm-12">
					<input class="form-control" type="text" name="titleInp" id="titleInp" placeholder="Enter title">
					<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="titleError">Please enter title.</p>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<label class="main-content-label tx-11 tx-medium">Select Status</label>
			<div class="row row-sm">
				<div class="col-sm-12">
					<select class="form-control select2-no-search" id="statusInp" name="statusInp">
						<option label="Select Status"></option>
						<option value="Accepted">Accepted</option>
						<option value="Preparing">Preparing</option>
						<option value="Shipped">Shipped</option>
						<option value="Delivered">Delivered</option>
					</select>
					<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="statusError">Please select status.</p>
				</div>
			</div>
		</div>
	</div>
</div> 

<div class="form-group">
	<label class="main-content-label tx-11 tx-medium">Upload File</label> 
	<input class="form-control" type="file" name="fileInp" id="fileInp">
	<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="statusError">Please upload file.</p>
</div>

<div class="form-group">
	<label class="main-content-label tx-11 tx-medium">Enter Message Description</label> 
	<textarea class="form-control" id="descriptionInp" name="descriptionInp" placeholder="Enter full description of coffee..."></textarea>
	<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="descriptionError">Please enter coffee description.</p>
</div>

<input type="hidden" value="<?php echo $row['id']; ?>" name="id">