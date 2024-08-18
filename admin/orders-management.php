<?php include ('partials/header.php'); ?>
<?php include ('partials/sidebar.php'); ?>

<?php 
$add_alert = '';
if(isset($_POST['updateOrder'])){
	$order_id = $_POST['orderIdInp'];
	$title = $_POST['titleInp'];
	$status = $_POST['statusInp'];
	$description = $_POST['descriptionInp'];

	$id = $_POST['id'];

    $update_stmt = $conn->prepare("UPDATE `orders` SET `status` = ? WHERE `order_id` = ?");

    if ($update_stmt) {
        $update_stmt->bind_param("ss", $status, $order_id);
        
        if ($update_stmt->execute()) {

    		$file = ""; 

        	if (isset($_FILES['fileInp'])) {
			    $fileTmpPath = $_FILES['fileInp']['tmp_name'];
			    $fileName = $_FILES['fileInp']['name'];
			    $fileSize = $_FILES['fileInp']['size'];
			    $fileType = $_FILES['fileInp']['type'];
			    $fileNameCmps = explode(".", $fileName);
			    $fileExtension = strtolower(end($fileNameCmps));

			    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

			    $uploadFileDir = '../api/v1/uploads/notificationfile/'; 
			    $dest_path = $uploadFileDir . $newFileName;

			    if (move_uploaded_file($fileTmpPath, $dest_path)) {
			        $file = $newFileName; 
			    } else {
			        $add_alert = 2; // Error in moving the uploaded file
			    }
			}

            $insert_stmt = $conn->prepare("INSERT INTO `order_status` (`order_id`, `title`, `message`, `status`, `file`) VALUES (?, ?, ?, ?, ?)");

            if ($insert_stmt) {
                $insert_stmt->bind_param("sssss", $order_id, $title, $description, $status, $file);

                if ($insert_stmt->execute()) {
                    // echo "Order status updated and new status inserted successfully.";
                    $add_alert = '1';
                } else {
                    echo "Error inserting into order_status: " . $insert_stmt->error;
                }

				$insert_stmt->close();
            } else {
                echo "Error preparing insert statement: " . $conn->error;
            }
        } else {
            echo "Error updating orders table: " . $update_stmt->error;
        }

        $update_stmt->close();
    } else {
        echo "Error preparing update statement: " . $conn->error;
    }

} 

echo "<script>if ( window.history.replaceState ) {  window.history.replaceState( null, null, window.location.href ); }</script>";

?>

<div class="main-content app-content">
	<div class="main-container container-fluid">
		<div class="breadcrumb-header justify-content-between">
			<div>
				<h4 class="content-title mb-2" style="text-transform: uppercase;">Orders Table</h4>
			</div>
			<div class="d-flex my-auto">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
						<li class="breadcrumb-item active " aria-current="page">Orders Management </li>
					</ol>
				</nav>
			</div>
		</div>

		<div class="row row-sm">
			<div class="col-lg-12">
				<div class="card overflow-hidden">
					<div class="card-header pd-b-0 pd-t-20 bd-b-0 bg-head">
						<div class="d-flex justify-content-between">
							<h3 class="card-title mg-b-10">Orders</h3>
							<div class="dropdown d-none" style="margin-bottom:10px">
								<a href="javascript:void(0)" class="btn btn-sm bg-primary-gradient" title="Add new business customer" data-bs-target="#modaldemo1" data-bs-toggle="modal"><b> + Business Customer</b></a>
							</div>
						</div>
					</div>
					<div class="card-body">
						<?php if($add_alert == '1'){ ?>
						<div class="alert alert-success" role="alert">
							<span class="alert-inner--icon"><i class="fa fa-thumbs-up  d-inline-flex"></i></span>
							<span class="alert-inner--text"><strong> Success!</strong> Order status has been updated.</span>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<?php }else if($add_alert == '2'){ ?>
						<div class="alert alert-danger" role="alert">
							<span class="alert-inner--icon"><i class="fa fa-exclamation-triangle d-inline-flex"></i></span>
							<span class="alert-inner--text"><strong> Error!</strong> Something went wrong. Please try again or contact admin.</span>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<?php } ?>
						<div class="table-responsive">
							<table class="table border-top-0  table-bordered text-nowrap border-bottom" id="responsive-datatable">
								<thead>
									<tr>
										<th class="text-center wd-15p border-bottom-0">S. No.</th>
										<th class="text-center wd-15p border-bottom-0">Order ID</th>
										<th class="text-center wd-20p border-bottom-0">Coffee</th>
										<th class="text-center wd-15p border-bottom-0">Customer Name</th>
										<th class="text-center wd-15p border-bottom-0">Quantity</th>
										<th class="text-center wd-10p border-bottom-0">Price</th>
										<th class="text-center wd-25p border-bottom-0">Status</th>
										<th class="text-center wd-25p border-bottom-0">Action</th>
									</tr>
								</thead>
								<tbody>
								<?php 
								$query = "SELECT orders.*, coffee.coffee_name AS coffee_name, users.name AS user_name FROM orders JOIN coffee ON orders.coffee_id = coffee.id JOIN users ON orders.user_id = users.id";
								$result = $conn->query($query);
								$sno = '';
								if ($result->num_rows > 0) {
									while($row = $result->fetch_assoc()) {
										$sno++;
								?>
									<tr id="tr_<?php echo $sno; ?>">
										<td class="text-center"><?php echo $sno; ?></td>
										<td class="text-center">
											<a class="badge bg-pill bg-primary-transparent" onclick="loadOrderDetails('<?php echo $row['order_id']; ?>','<?php echo $sno; ?>')" title="Click here to check order status" href="javascript:void(0)"><?php echo $row["order_id"]; ?></a>
										</td>
										<td class="text-center"><?php echo $row["coffee_name"]; ?></td>
										<td class="text-center"><?php echo $row["user_name"]; ?></td>
										<td class="text-center"><?php echo $row["quantity"]; ?></td>
										<td class="text-center">$ <?php echo $row["price"]; ?></td>
										<td class="text-center">
											<span class="badge bg-primary"><?php echo $row["status"]; ?></span>
										</td>
										<td class="text-center">
											<a href="javascript:void(0)" onclick="openEditPopUp(<?php echo $row['id']; ?>)" class="btn btn-sm bg-info" title="Click here to update order status"><i class="fa fa-edit" ></i></a>
										</td>
									</tr>
								<?php } } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- modal box to update order status -->
<div class="modal" id="modaldemo1">
	<div class="modal-dialog" role="document">
		<div class="modal-content modal-content-demo">
			<form id="updateOrderForm" method="post" enctype="multipart/form-data">
				<div class="modal-header bg-head">
					<h6 class="modal-title text-center">Update Status</h6>
					<button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				</div>

				<div class="modal-body" id="popupBody" style="background-color: #fff9f9;">
					
				</div>
				
				<div class="modal-footer bg-head">
					<button type="submit" class="btn btn-primary" name="updateOrder">Update</a>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	function openEditPopUp(id){
		$.ajax({
			type: 'POST',
			url: 'functions/orders/load_order.php',
			data: {
				id:id,
			},
			success: function(response){
				$('#popupBody').html(response);

				$('#modaldemo1').modal('show');

			}
	  	});
	}

	function loadOrderDetails(orderid,row){
		$('.subOrderTable').html('');
		$.ajax({
			type: 'POST',
			url: 'functions/orders/load_order_details.php',
			data: {
				orderid:orderid,
				row:row
			},
			success: function(response){
				$('#tr_'+row).after(response);
			}
	  	});
	}
	
</script>
<?php include('partials/footer.php'); ?>