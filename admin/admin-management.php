<?php include ('partials/header.php'); ?>
<?php include ('partials/sidebar.php'); ?>

<div class="main-content app-content">
	<div class="main-container container-fluid">
		<div class="breadcrumb-header justify-content-between">
			<div>
				<h4 class="content-title mb-2" style="text-transform: uppercase;">Admins</h4>
			</div>
			<div class="d-flex my-auto">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
						<li class="breadcrumb-item active " aria-current="page">Admin Management </li>
					</ol>
				</nav>
			</div>
		</div>

		<div class="row row-sm">
			<div class="col-lg-12">
				<div class="card overflow-hidden">
					<div class="card-header pd-b-0 pd-t-20 bd-b-0 bg-head">
						<div class="d-flex justify-content-between">
							<h3 class="card-title mg-b-10">Admins Table</h3>
							<div class="dropdown" style="margin-bottom:10px">
								<a href="javascript:void(0)" class="btn btn-sm bg-primary-gradient" title="Add new business customer" data-bs-target="#modaldemo1" data-bs-toggle="modal"><b> + Admin</b></a>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table border-top-0  table-bordered text-nowrap border-bottom" id="responsive-datatable">
								<thead>
									<tr>
										<th class="text-center wd-15p border-bottom-0">S. No.</th>
										<th class="text-center wd-15p border-bottom-0">Name</th>
										<th class="text-center wd-20p border-bottom-0">Email</th>
										<th class="text-center wd-10p border-bottom-0">Status</th>
										<th class="text-center wd-25p border-bottom-0">Action</th>
									</tr>
								</thead>
								<tbody>
								<?php 
								$query = "SELECT * FROM admins where status != 'D'";
								$result = $conn->query($query);
								$sno = '';
								if ($result->num_rows > 0) {
									while($row = $result->fetch_assoc()) {
										$sno++;
								?>
									<tr>
										<td class="text-center"><?php echo $sno; ?></td>
										<td class="text-center"><?php echo $row['name']; ?></td>
										<td class="text-center"><?php echo $row['email']; ?></td>
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
											<a href="javascript:void(0)" class="btn btn-sm bg-danger" title="Delete this admin" onclick="deleteAdmin(<?php echo $row['id']; ?>)"><i class="fa fa-trash" ></i></a>
										</td>
									</tr>
								<?php } }?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- modal box to add admin -->
<div class="modal" id="modaldemo1">
	<div class="modal-dialog" role="document">
		<div class="modal-content modal-content-demo">
			<form id="addAdminForm" method="post">
				<div class="modal-header bg-head">
					<h6 class="modal-title text-center">Add New Admin</h6>
					<button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				</div>

				<div class="modal-body" style="background-color: #fff9f9;">
					<div class="form-group">
						<label class="main-content-label tx-11 tx-medium">Enter Admin Name</label> 
						<input class="form-control" type="text" id="adminNameInp" name="adminNameInp" placeholder="Enter admin name">
						<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="adminNameError">This field can not be empty.</p>
					</div>

					<div class="form-group">
						<label class="main-content-label tx-11 tx-medium">Enter Admin Email</label> 
						<input class="form-control" type="text" id="adminEmailInp" name="adminEmailInp" placeholder="Enter admin email" onkeyup="chkAvailability(this.value,'add')">
						<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="adminEmailError">This field can not be empty.</p>
					</div>

					<div class="form-group">
						<label class="main-content-label tx-11 tx-medium">Enter New Password</label> 
						<div class="d-flex">
							<input class="form-control" type="text" id="adminPasswordInp" name="adminPasswordInp" placeholder="Enter admin new password">
							<a href="javascript:void(0)" onclick="generateRandomPassword('adminPasswordInp')" title="Click here to generate password" class="btn btn-info"><i class="fas fa-key"></i></a>
							<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="adminPasswordError">This field can not be empty.</p>
						</div>
					</div>
										
					<div class="form-group">
						<label class="main-content-label tx-11 tx-medium">Select Admin Roles</label> 
						<div class="row row-sm">
							<div class="col-md-6" style="margin-bottom:10px">
								<label class="ckbox"><input type="checkbox" name="roles[]" value="superadmin"><span><b>Super Admin</b></span></label>
							</div>
							<div class="col-md-6" style="margin-bottom:10px">
								<label class="ckbox"><input type="checkbox" name="roles[]" value="coffeebeansmanagement"><span><b>Coffee Management</b></span></label>
							</div>
							<div class="col-md-6" style="margin-bottom:10px">
								<label class="ckbox"><input type="checkbox" name="roles[]" value="customermanagement"><span><b>Customer Management</b></span></label>
							</div>
							<div class="col-md-6" style="margin-bottom:10px">
								<label class="ckbox"><input type="checkbox" name="roles[]" value="businessmanagement"><span><b>Business Management</b></span></label>
							</div>
							<div class="col-md-6" style="margin-bottom:10px">
								<label class="ckbox"><input type="checkbox" name="roles[]" value="ordersmanagement"><span><b>Order Management</b></span></label>
							</div>
							<div class="col-md-6" style="margin-bottom:10px">
								<label class="ckbox"><input type="checkbox" name="roles[]" value="offermanagement"><span><b>Offer Management</b></span></label>
							</div>
						</div>
						<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="adminRoleError">Please select atleast one role for admin.</p>
					</div>

				</div>
				
				<div class="modal-footer bg-head">
					<a class="btn btn-secondary" onclick="resetForm(event,'addAdminForm')">Reset </a>
					<a class="btn btn-primary" onclick="addAdmin()" > + Add</a>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- modal box to edit admin -->
<div class="modal" id="modaldemo2">
	<div class="modal-dialog" role="document">
		<div class="modal-content modal-content-demo">
			<form id="editAdminForm" method="post">
				<div class="modal-header bg-head">
					<h6 class="modal-title text-center">Edit Admin</h6>
					<button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				</div>

				<div class="modal-body" id="modelBodyId" style="background-color: #fff9f9;">

				</div>
				
				<div class="modal-footer bg-head">
					<a class="btn btn-primary" onclick="editAdmin()" >Update</a>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">

	function deleteAdmin(id) {
		if (confirm("Are you sure you want to delete this admin?")) {
			$.ajax({
				type: 'POST',
				url: 'functions/admins/delete_admin.php',
				data: {
					id: id,
				},
				success: function(result) {
					alert("Admin deleted successfully.");
					location.reload();
				}
			});
		} else {
			alert("Admin has not been deleted.");
		}
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

	//function to update the admin status
	function updateStatus(status,id){
		$.ajax({
			type: 'POST',
			url: 'functions/admins/update_status.php',
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

	//to generate random password
  	function generateRandomPassword(inp) {
	    var length = 8;
	    var charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	    var password = "";
	    for (var i = 0; i < length; i++) {
	        var randomIndex = Math.floor(Math.random() * charset.length);
	        password += charset[randomIndex];
	    }

	    $('#'+inp).val(password);
	}

	//function to check username availability
	function chkAvailability(email,type){
		var currentEmail = '';
		if(type == 'edit'){
			currentEmail = $('#hiddenEmail').val();
		}

		$.ajax({
			type: 'POST',
			url: 'functions/admins/check_email.php',
			data: {
				email:email,
				currentEmail:currentEmail,
				type:type
			},
			success: function(result){
				if(result == 0){
					if(type == 'add'){
						$('#adminEmailInp').val('');
						$('#adminEmailInp').focus();
						$('#adminEmailError').html('This email id '+email+' is already in use.');
						$('#adminEmailError').removeClass('d-none');
					}else{
						$('#editAdminEmailInp').val('');
						$('#editAdminEmailInp').focus();
						$('#editAdminEmailError').html('This email id '+email+' is already in use.');
						$('#editAdminEmailError').removeClass('d-none');
					}
				}else{
					if(type == 'add'){
						$('#adminEmailError').addClass('d-none');
					}else{
						$('#editAdminEmailError').addClass('d-none');
					}
				}
			}
	  	});
	}

	//function to add users
	function addAdmin(){
		var name = $('#adminNameInp').val();
		var email = $('#adminEmailInp').val();
		var password = $('#adminPasswordInp').val();
		var roles = [];

		$('input[name="roles[]"]:checked').each(function() {
	        roles.push($(this).val());
	    });

		if(name == ''){
			$('#adminNameError').removeClass('d-none');
			$('#adminNameInp').focus();
			return;
		}else{
			$('#adminNameError').addClass('d-none');
		}

		var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

		if(email == ''){
			$('#adminEmailError').html('This field can not be empty.');
	        $('#adminEmailError').removeClass('d-none');
			$('#adminEmailInp').focus();
			return;
		} else if (!emailRegex.test(email)) {
	        $('#adminEmailError').html('Invalid email format.');
	        $('#adminEmailError').removeClass('d-none');
			$('#adminEmailInp').focus();

	        return;
	    } else {
	        $('#adminEmailError').addClass('d-none');
	    }

		if(password == ''){
			$('#adminPasswordError').removeClass('d-none');
			$('#adminEmailInp').focus();
			return;
		}else{
			$('#adminPasswordError').addClass('d-none');
		}

		if (roles.length == 0) {
	        $('#adminRoleError').removeClass('d-none');
	        return;
	    } else {
	        $('#adminRoleError').addClass('d-none');
	    }

		$.ajax({
			type: 'POST',
			url: 'functions/admins/add_admin.php',
			data: {
				name:name,
				password:password,
				email:email,
				roles: roles.join(',')
			},
			success: function(result){
				if(result == '1'){
					resetForm(event,'addAdminForm');
					location.reload();
					$('#modaldemo1').modal('hide');
				}else{
					alert('Something went wrong!');
				}
			}
	  	});
	}

	function resetForm(e,form){
		$('#adminNameError').addClass('d-none');
		$('#adminEmailError').addClass('d-none');
		$('#adminPasswordError').addClass('d-none');
		$('#adminRoleError').addClass('d-none');

		$('#editAdminNameError').addClass('d-none');
		$('#editAdminEmailError').addClass('d-none');
		$('#editAdminPasswordError').addClass('d-none');
		$('#editAdminRoleError').addClass('d-none');

  		e.preventDefault();
  		var form = document.getElementById(form);
	    form.reset();
  	}

	//function to open edit popup
  	function openEditPopup(id){
  		$.ajax({
			type: 'POST',
			url: 'functions/admins/load_edit_popup.php',
			data: {
				id:id,
			},
			success: function(result){
				$('#modelBodyId').html(result);
				$('#modaldemo2').modal('show');
			}
	  	});
  	}

	function editAdmin(){
		var name = $('#editAdminNameInp').val();
		var email = $('#editAdminEmailInp').val();
		var password = $('#editAdminPasswordInp').val();
		var encryptPassword = $('#hiddenPassword').val();

		var id = $('#editId').val();

		var roles = [];

		$('input[name="editRoles[]"]:checked').each(function() {
	        roles.push($(this).val());
	    });

		if(name == ''){
			$('#editAdminNameError').removeClass('d-none');
			$('#editAdminNameInp').focus();
			return;
		}else{
			$('#editAdminNameError').addClass('d-none');
		}

		var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

		if(email == ''){
			$('#editAdminEmailError').html('This field can not be empty.');
	        $('#editAdminEmailError').removeClass('d-none');
			$('#editAdminEmailInp').focus();
			return;
		} else if (!emailRegex.test(email)) {
	        $('#editAdminEmailError').html('Invalid email format.');
	        $('#editAdminEmailError').removeClass('d-none');
			$('#editAdminEmailInp').focus();

	        return;
	    } else {
	        $('#editAdminEmailError').addClass('d-none');
	    }

		if (roles.length == 0) {
	        $('#editAdminRoleError').removeClass('d-none');
	        return;
	    } else {
	        $('#editAdminRoleError').addClass('d-none');
	    }

		$.ajax({
			type: 'POST',
			url: 'functions/admins/edit_admin.php',
			data: {
				name:name,
				password:password,
				email:email,
				encryptPassword:encryptPassword,
				roles: roles.join(','),
				id:id
			},
			success: function(result){
				if(result == '1'){
					resetForm(event,'editAdminForm');
					location.reload();
					$('#modaldemo2').modal('hide');
				}else{
					alert('Something went wrong!');
				}
			}
	  	});
	}


</script>
<?php include('partials/footer.php'); ?>