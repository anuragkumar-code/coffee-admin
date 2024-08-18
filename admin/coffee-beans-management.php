<?php include ('partials/header.php'); ?>
<?php include ('partials/sidebar.php'); ?>

<?php 
$add_alert = '';
if(isset($_POST['addCoffee'])){

    $coffee_name = isset($_POST['coffeeNameInp']) ? $_POST['coffeeNameInp'] : '';
    $type_of_coffee = isset($_POST['selectTypeOfCoffee']) ? $_POST['selectTypeOfCoffee'] : '';
    $type_of_beans = isset($_POST['selectTypeOfBeans']) ? $_POST['selectTypeOfBeans'] : '';
    $price = isset($_POST['priceInp']) ? $_POST['priceInp'] : '';
    $shortDescription = isset($_POST['shortDescriptionInp']) ? $_POST['shortDescriptionInp'] : '';
    $description = isset($_POST['descriptionInp']) ? $_POST['descriptionInp'] : '';

    $image = ''; 
    $status = 'A';

    if (isset($_FILES['imageInp'])) {
        $fileTmpPath = $_FILES['imageInp']['tmp_name'];
        $fileName = $_FILES['imageInp']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

        $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $uploadFileDir = '../api/v1/uploads/coffee_images/';
            $dest_path = $uploadFileDir . $newFileName;

            if(move_uploaded_file($fileTmpPath, $dest_path)) {
                $image = $newFileName;
            } else {
                $add_alert = 2; // Error in moving the uploaded file
            }
        } else {
            $add_alert = 2; // Invalid file type
        }
    }

    $sql = "INSERT INTO coffee (coffee_name, type, description, price, image, beans_type, short_description, status) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

	if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("ssssssss", $coffee_name, $type_of_coffee, $description, $price, $image, $type_of_beans, $shortDescription, $status);

	if ($stmt->execute()) {
		$add_alert = 1;
        // echo "New coffee added successfully!";
    } else {
		$add_alert = 2;
        // echo "Error: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();

	echo "<script>if ( window.history.replaceState ) {  window.history.replaceState( null, null, window.location.href ); }</script>";
}

$edit_alert = '';
if(isset($_POST['editBtn'])){
	// echo "heu";exit;
    $coffee_name = isset($_POST['edit_coffee_name']) ? $_POST['edit_coffee_name'] : '';
    $type_of_coffee = isset($_POST['edit_type_of_coffee']) ? $_POST['edit_type_of_coffee'] : '';
    $type_of_beans = isset($_POST['edit_type_of_beans']) ? $_POST['edit_type_of_beans'] : '';
    $price = isset($_POST['editPrice']) ? $_POST['editPrice'] : '';
    $short_description = isset($_POST['editShortDescription']) ? $_POST['editShortDescription'] : '';
    $description = isset($_POST['editDescription']) ? $_POST['editDescription'] : '';

    $coffee_id = isset($_POST['editId']) ? $_POST['editId'] : '';
    $hiddenImgName = isset($_POST['hiddenImgName']) ? $_POST['hiddenImgName'] : '';
	$image = $hiddenImgName;

	if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $fileSize = $_FILES['image']['size'];
        $fileType = $_FILES['image']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

        $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $uploadFileDir = '../api/v1/uploads/coffee_images/';
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $image = $newFileName;

            } else {
                $edit_alert = 2; // Error in moving the uploaded file
            }
        } else {
            $edit_alert = 2; // Invalid file type
        }
    }

	$sql = "UPDATE coffee SET coffee_name = ?, type = ?, beans_type = ?, price = ?, image = ?, short_description = ?, description = ? WHERE id = ?";

	if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssssssi", $coffee_name, $type_of_coffee, $type_of_beans, $price, $image, $short_description, $description, $coffee_id);

        if ($stmt->execute()) {
            // echo '1'; 
			$edit_alert = 1;
        } else {
            // echo '0'; 
			$edit_alert = 2;

        }

        $stmt->close();
    } else {
        // echo '0'; // Failed to prepare statement
		$edit_alert = 2;
    }

	echo "<script>if ( window.history.replaceState ) {  window.history.replaceState( null, null, window.location.href ); }</script>";

}
?>

<div class="main-content app-content">
	<div class="main-container container-fluid">
		<div class="breadcrumb-header justify-content-between">
			<div>
				<h4 class="content-title mb-2" style="text-transform: uppercase;">Coffee Beans</h4>
			</div>
			<div class="d-flex my-auto">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
						<li class="breadcrumb-item active " aria-current="page">Coffee Beans Management </li>
					</ol>
				</nav>
			</div>
		</div>
		<div class="row row-sm">
			<div class="col-lg-12">
				<div class="card overflow-hidden">
					<div class="card-header pd-b-0 pd-t-20 bd-b-0 bg-head">
						<div class="d-flex justify-content-between">
							<h3 class="card-title mg-b-10">Coffee Beans Table</h3>
							<div class="dropdown" style="margin-bottom:10px">
								<a href="javascript:void(0)" class="btn btn-sm bg-primary-gradient" title="Add new coffee" data-bs-target="#modaldemo1" data-bs-toggle="modal"><b> + Coffee Beans</b></a>
							</div>
						</div>
					</div>
					<div class="card-body">
						<?php if($add_alert == '1'){ ?>
						<div class="alert alert-success" role="alert">
							<span class="alert-inner--icon"><i class="fa fa-thumbs-up  d-inline-flex"></i></span>
							<span class="alert-inner--text"><strong> Success!</strong> New coffee beans has been added.</span>
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

						<?php if($edit_alert == '1'){ ?>
						<div class="alert alert-success" role="alert">
							<span class="alert-inner--icon"><i class="fa fa-thumbs-up  d-inline-flex"></i></span>
							<span class="alert-inner--text"><strong> Success!</strong> Coffee beans details has been edited.</span>
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
										<th class="text-center wd-15p border-bottom-0">Coffee Beans Name</th>
										<th class="text-center wd-20p border-bottom-0">Type</th>
										<th class="text-center wd-15p border-bottom-0">Price</th>
										<th class="text-center wd-10p border-bottom-0">Roast Type</th>
										<th class="text-center wd-10p border-bottom-0">Image</th>
										<th class="text-center wd-25p border-bottom-0">Status</th>
										<th class="text-center wd-25p border-bottom-0">Action</th>
									</tr>
								</thead>
								<tbody>
								<?php 
								$query = "SELECT * FROM coffee where status != 'D' order by id desc";
								$result = $conn->query($query);
								$sno = '';
								if ($result->num_rows > 0) {
									while($row = $result->fetch_assoc()) {
										$sno++;
								?>
									<tr>
										<td class="text-center"><?php echo $sno; ?></td>
										<td class="text-center"><?php echo $row['coffee_name']; ?></td>
										<td class="text-center"><?php echo $row['type']; ?></td>
										<td class="text-center">$ <?php echo $row['price']; ?></td>
										<td class="text-center"><?php echo $row['beans_type']; ?></td>
										<td class="text-center">
											<a target="_blank" href="../api/v1/uploads/coffee_images/<?php echo $row['image']; ?>"><i class="fa fa-download"></i></a>
										</td>
										<td class="text-center">
											<div style="display: inline-block;">
												<div class="main-toggle main-toggle-success <?php if($row['status'] == 'A'){ ?> on <?php }?>" style="border-radius: 22px;" data-id="<?php echo $row['id']; ?>">
													<span style="border-radius: 22px;"></span>
													<input type="hidden" id="statusId_<?php echo $row['id']; ?>" value="<?php echo $row['status']; ?>">
											</div>
										</div>
										</td>
										<td class="text-center">
											<a href="javascript:void(0)" class="btn btn-sm bg-info" title="Edit details" onclick="openEditPopup(<?php echo $row['id']; ?>)"><i class="fa fa-edit" ></i></a>
											<a href="javascript:void(0)" class="btn btn-sm bg-danger" title="Delete coffee beans" onclick="deleteCoffee(<?php echo $row['id']; ?>)"><i class="fa fa-trash" ></i></a>
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

<!-- modal box to add coffee -->
<div class="modal" id="modaldemo1">
	<div class="modal-dialog" role="document">
		<div class="modal-content modal-content-demo">
			<form id="addCoffeeForm" method="post" enctype="multipart/form-data">
				<div class="modal-header bg-head">
					<h6 class="modal-title text-center">Add New Coffee Beans</h6>
					<button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				</div>

				<div class="modal-body" style="background-color: #fff9f9;">
					<div class="form-group">
						<label class="main-content-label tx-11 tx-medium">Enter Coffee Beans Name</label> 
						<input class="form-control" type="text" id="coffeeNameInp" name="coffeeNameInp" placeholder="Enter coffee beans name">
						<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="coffeeNameError">This field can not be empty.</p>
					</div>
										
					<div class="form-group">
						<div class="row row-sm">
							<div class="col-sm-6">
								<label class="main-content-label tx-11 tx-medium">Select Coffee Beans</label>
								<div class="row row-sm">
									<div class="col-sm-12">
										<select class="form-control select2-no-search" id="selectTypeOfCoffee" name="selectTypeOfCoffee">
											<option label="Select coffee beans"></option>
											<option value="Single Origin">Single Origin</option>
											<option value="Blend">Blend</option>
										</select>
										<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="typeOfCoffeeError">Please select type of coffee beans.</p>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<label class="main-content-label tx-11 tx-medium">Select Roast</label>
								<div class="row row-sm">
									<div class="col-sm-12">
										<select class="form-control select2-no-search" id="selectTypeOfBeans" name="selectTypeOfBeans">
											<option label="Select type of roast"></option>
											<option value="Medium Roasted">Medium Roasted</option>
											<option value="Highly Roasted">Highly Roasted</option>
										</select>
										<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="typeofBeansError">Please select type of roast.</p>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row row-sm">
							<div class="col-sm-6">
								<label class="main-content-label tx-11 tx-medium">Enter Price</label>
								<div class="row row-sm">
									<div class="col-sm-12">
										<div class="d-flex">
											<a href="javascript:void(0)" class="btn btn-info"><i class="fas fa-dollar-sign"></i></a>
											<input class="form-control" id="priceInp" name="priceInp" type="text" placeholder="Enter coffee price">
										</div>
										<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="priceError">Enter price</p>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<label class="main-content-label tx-11 tx-medium">Upload Image</label>
								<div class="row row-sm">
									<div class="col-sm-12">
										<input class="form-control" id="imageInp" name="imageInp" type="file">
										<p class="text-muted mb-0">Only .jpeg, .jpg, .png & .gif</p>
										<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="imageError">Upload</p>
									</div>
								</div>
							</div>
						</div>
					</div>
										
					<div class="form-group">
						<label class="main-content-label tx-11 tx-medium">Enter Short Description</label> 
						<textarea class="form-control" id="shortDescriptionInp" name="shortDescriptionInp" placeholder="Enter short description of coffee..."></textarea>
						<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="shortDescriptionError">Please enter short description.</p>
					</div>

					<div class="form-group">
						<label class="main-content-label tx-11 tx-medium">Enter Description</label> 
						<textarea class="form-control" id="descriptionInp" name="descriptionInp" placeholder="Enter full description of coffee..."></textarea>
						<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="descriptionError">Please enter description.</p>
					</div>
				</div>
				
				<div class="modal-footer bg-head">
					<a class="btn btn-secondary" onclick="resetForm(event)">Reset </a>
					<button type="submit" class="btn btn-primary" name="addCoffee"> + Add</a>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- modal box to edit coffee -->
<div class="modal" id="modaldemo2">
	<div class="modal-dialog" role="document">
		<div class="modal-content modal-content-demo">
			<form id="editCoffeeForm" method="post" enctype="multipart/form-data">
				<div class="modal-header bg-head">
					<h6 class="modal-title text-center">Edit Coffee Beans Details</h6>
					<button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				</div>

				<div class="modal-body" id="editPopup" style="background-color: #fff9f9;">
					
				</div>
				
				<div class="modal-footer bg-head">
					<input class="form-control" name="coffee_id" id="coffee_id" type="hidden">
					<a href="javascript:void(0)" class="btn btn-primary" onclick="editCoffee()">Update</a>
					<button type="submit" id="editBtn" name="editBtn" class="d-none">Edit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">

	function deleteCoffee(id) {
		if (confirm("Are you sure you want to delete this coffee beans?")) {
			$.ajax({
				type: 'POST',
				url: 'functions/coffee/delete_coffee_beans.php',
				data: {
					id: id,
				},
				success: function(result) {
					alert("Coffee beans deleted successfully.");
					location.reload();
				}
			});
		} else {
			alert("Coffee beans not deleted.");
		}
	}


	//function to edit the coffee
	function editCoffee(){
		var coffee = $('#coffeeNameEditInp').val();
		var typeOfCoffee = $('#selectTypeOfCoffeeEdit').val();
		var typeOfBeans = $('#selectTypeOfBeansEdit').val();
		var price = $('#priceEditInp').val();
		var shortDescription = $('#shortDescriptionEditInp').val();
		var description = $('#descriptionEditInp').val();

		if(coffee == ''){
			$('#coffeeNameEditInp').focus();
			$('#coffeeNameEditError').text('Please enter coffee name.');
			$('#coffeeNameEditError').removeClass('d-none');
			return;
		}else{
			$('#coffeeNameEditError').addClass('d-none');
		}

		if(typeOfCoffee == ''){
			$('#selectTypeOfCoffeeEdit').focus();
			$('#typeOfCoffeeEditError').removeClass('d-none');
			return;
		}else{
			$('#typeOfCoffeeEditError').addClass('d-none');
		}

		if(typeOfBeans == ''){
			$('#selectTypeOfBeansEdit').focus();
			$('#typeofBeansEditError').removeClass('d-none');
			return;
		}else{
			$('#typeofBeansEditError').addClass('d-none');
		}

		if(price == ''){
			$('#priceEditInp').focus();
			$('#priceEditError').removeClass('d-none');
			return;
		}else{
			$('#priceEditError').addClass('d-none');
		}

		if(shortDescription == ''){
			$('#shortDescriptionEditInp').focus();
			$('#shortDescriptionEditError').removeClass('d-none');
			return;
		}else{
			$('#shortDescriptionEditError').addClass('d-none');
		}

		if(description == ''){
			$('#descriptionEditInp').focus();
			$('#descriptionEditError').removeClass('d-none');
			return;
		}else{
			$('#descriptionEditError').addClass('d-none');
		}

		//submit form
		$('#editBtn').click();
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

	//fucntion to update the status of coffee
	function updateStatus(status,id){
		$.ajax({
			type: 'POST',
			url: 'functions/coffee/update_status.php',
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
			url: 'functions/coffee/load_details.php',
			data: {
				id:id,
			},
			success: function(result){
				$('#editPopup').html(result);
				$('#modaldemo2').modal('show');
			}
	  	});
  	}

</script>
<?php include ('partials/footer.php'); ?>
