<?php 

include ('partials/header.php'); 
include ('partials/sidebar.php'); 

$edit_alert = '';
if(isset($_POST['editBtn'])){
	$name = $_POST['editName'];
	$email = $_POST['editEmail'];
	$phone = $_POST['editPhone'];

	$id = $_POST['editId'];

	$sql = "UPDATE users SET name = ?, email = ?, phone = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $phone, $id);

    if ($stmt->execute()) {
        $edit_alert = "1";
    } else {
        $edit_alert= "2";
    }

    $stmt->close();
}

echo "<script>if ( window.history.replaceState ) {  window.history.replaceState( null, null, window.location.href ); }</script>";

?>

<div class="main-content app-content">
	<div class="main-container container-fluid">
		<div class="breadcrumb-header justify-content-between">
			<div>
				<h4 class="content-title mb-2" style="text-transform: uppercase;">Customers</h4>
			</div>
			<div class="d-flex my-auto">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
						<li class="breadcrumb-item active " aria-current="page">Customers Management </li>
					</ol>
				</nav>
			</div>
		</div>

		<div class="row row-sm">
			<div class="col-lg-12">
				<div class="card overflow-hidden">
					<div class="card-header pd-b-0 pd-t-20 bd-b-0 bg-head">
						<div class="d-flex justify-content-between">
							<h3 class="card-title mg-b-10">Individual Customers</h3>
							<div class="dropdown" style="margin-bottom:10px">
								<!-- <a href="javascript:void(0)" class="btn btn-sm bg-primary-gradient" title="Add new customer" data-bs-target="#modaldemo1" data-bs-toggle="modal"><b> + Customer</b></a> -->
							</div>
						</div>
					</div>
					<div class="card-body">
					<?php if($edit_alert == '1'){ ?>
					<div class="alert alert-success" role="alert">
						<span class="alert-inner--icon"><i class="fa fa-thumbs-up  d-inline-flex"></i></span>
						<span class="alert-inner--text"><strong> Success!</strong> Customer details has been edited.</span>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php }else if($edit_alert == '2'){ ?>
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
										<th class="text-center wd-15p border-bottom-0">Name</th>
										<th class="text-center wd-20p border-bottom-0">Email</th>
										<th class="text-center wd-15p border-bottom-0">Phone</th>
										<th class="text-center wd-10p border-bottom-0">Status</th>
										<th class="text-center wd-25p border-bottom-0">Action</th>
									</tr>
								</thead>
								<tbody>
								<?php 
								$query = "SELECT * from users where user_type = 'individual' AND status != 'D' order by id desc";
								$result = $conn->query($query);
								$sno = '';
								if ($result->num_rows > 0) {
									while($row = $result->fetch_assoc()) {
										$sno++;
								?>
									<tr>
										<td class="text-center"><?php echo $sno; ?></td>
										<td class="text-center">
											<b><a title="Click here to view customer details" href="customer-details.php?user-id='<?php echo base64_encode($row['id']); ?>'"><?php echo $row['name'] ?></a></b>
										</td>
										<td class="text-center"><?php echo $row['email'] ?></td>
										<td class="text-center"><?php echo $row['phone'] ?></td>
										<td class="text-center">
											<div style="display: inline-block;">
												<div class="main-toggle main-toggle-success <?php if($row['status'] == 'A'){ ?> on <?php }?>" style="border-radius: 22px;" data-id="<?php echo $row['id']; ?>">
													<span style="border-radius: 22px;"></span>
													<input type="hidden" id="statusId_<?php echo $row['id']; ?>" value="<?php echo $row['status']; ?>">
												</div>
											</div>
										</td>
										<td class="text-center">
											<a href="javascript:void(0)" class="btn btn-sm bg-info" title="Edit details" onclick="openEditPopup('<?php echo $row['id'] ?>')"><i class="fa fa-edit" ></i></a>
											<a href="javascript:void(0)" class="btn btn-sm bg-danger" title="Delete this customer" onclick="deleteCustomer(<?php echo $row['id']; ?>)"><i class="fa fa-trash" ></i></a>
										</td> 
									</tr>
								<?php }} ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- modal box to edit customer -->
<div class="modal" id="modaldemo1">
	<div class="modal-dialog" role="document">
		<div class="modal-content modal-content-demo">
			<form id="editCustomerForm" method="post" enctype="multipart/form-data">
				<div class="modal-header bg-head">
					<h6 class="modal-title text-center">Edit Customer Details</h6>
					<button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				</div>

				<div class="modal-body" id="editPopup" style="background-color: #fff9f9;">
					
				</div>
				
				<div class="modal-footer bg-head">
					<input class="form-control" name="coffee_id" id="coffee_id" type="hidden">
					<a href="javascript:void(0)" class="btn btn-primary" onclick="updateCustomer()">Update</a>
					<button type="submit" class="btn btn-primary d-none" id="editBtn" name="editBtn">Update</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">

	function deleteCustomer(id) {
		if (confirm("Are you sure you want to delete this customer?")) {
			$.ajax({
				type: 'POST',
				url: 'functions/customers/delete_customers.php',
				data: {
					id: id,
				},
				success: function(result) {
					alert("Customer deleted successfully.");
					location.reload();
				}
			});
		} else {
			alert("Customer has not been deleted.");
		}
	}

	//function to check username availability
	function chkAvailability(email){
		var currentEmail = $('#currentEmail').val();

		if(currentEmail == email){
			return;
		}

		$.ajax({
			type: 'POST',
			url: 'functions/customers/check_email.php',
			data: {
				email:email,
			},
			success: function(result){
				if(result == 0){
					$('#editEmail').val('');
					$('#editEmail').focus();
					$('#emailError').html('This email id '+email+' is already in use.');
					$('#emailError').removeClass('d-none');
				}else{
					$('#emailError').addClass('d-none');
				}
			}
	  	});
	}

	//function to toggle the switch
	$('.main-toggle').on('click', function() {
		$(this).toggleClass('on');

		var id = $(this).data('id');

		var hiddenInput = $('#statusId_' + id);

		if ($(this).hasClass('on')) {
			hiddenInput.val('A'); 
			updateStatus('I',id)
		} else {
			hiddenInput.val('I'); 
			updateStatus('A',id)
		}
	})

	//fucntion to update the status of customer
	function updateStatus(status,id){
		$.ajax({
			type: 'POST',
			url: 'functions/customers/update_status.php',
			data: {
				status:status,
				id:id
			},
			success: function(result){
				if(result == '1'){
					console.log("status updated");
				}else{
					alert('Something went wrong! Please contact admin.');
				}
			}
	  	});
	}

	//function to open the popup button
	function openEditPopup(id){
  		$.ajax({
			type: 'POST',
			url: 'functions/customers/load_details.php',
			data: {
				id:id,
			},
			success: function(result){
				$('#editPopup').html(result);
				$('#modaldemo1').modal('show');
			}
	  	});
  	}

	function updateCustomer(){
		var name = $('#editName').val();
		var email = $('#editEmail').val();
		var phone = $('#editPhone').val();

		if(name == ''){
			$('#editName').focus();
			$('#nameError').text('Please enter customer name.');
			$('#nameError').removeClass('d-none');
			return;
		}else{
			$('#nameError').addClass('d-none');
		}

		if(email == ''){
			$('#editEmail').focus();
			$('#emailError').text('Please enter customer email.');
			$('#emailError').removeClass('d-none');
			return;
		}else{
			$('#emailError').addClass('d-none');
		}

		if(phone == ''){
			$('#editPhone').focus();
			$('#phoneError').text('Please enter customer phone.');
			$('#phoneError').removeClass('d-none');
			return;
		}else{
			$('#phoneError').addClass('d-none');
		}

		//trigger submit button
		$('#editBtn').click();

	}
</script>
<?php include('partials/footer.php'); ?>