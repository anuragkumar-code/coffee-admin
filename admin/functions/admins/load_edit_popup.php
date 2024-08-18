<?php 
include('../../config/db.php'); 

$id=isset($_POST['id'])?$_POST['id']:'';

if ($id) {
    $sql = "SELECT * FROM admins WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        $roles = explode(',', $admin['role']);
    }
}

?>

<div class="form-group">
	<label class="main-content-label tx-11 tx-medium">Enter Admin Name</label> 
	<input class="form-control" type="text" id="editAdminNameInp" name="editAdminNameInp" value="<?php echo htmlspecialchars($admin['name']); ?>" placeholder="Enter admin name">
	<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="editAdminNameError">This field can not be empty.</p>
</div>

<div class="form-group">
	<label class="main-content-label tx-11 tx-medium">Enter Admin Email</label> 
	<input class="form-control" type="text" id="editAdminEmailInp" name="editAdminEmailInp" value="<?php echo htmlspecialchars($admin['email']); ?>" placeholder="Enter admin email" onkeyup="chkAvailability(this.value,'edit')">
	<input type="hidden" id="hiddenEmail" value="<?php echo htmlspecialchars($admin['email']); ?>">
	<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="editAdminEmailError">This field can not be empty.</p>
</div>

<div class="form-group">
	<label class="main-content-label tx-11 tx-medium">Enter New Password</label> 
	<div class="d-flex">
		<input class="form-control" type="text" id="editAdminPasswordInp" name="editAdminPasswordInp" placeholder="Leave blank if password change is not required">
		<input type="hidden" id="hiddenPassword" value="<?php echo htmlspecialchars($admin['password']); ?>">
		<a href="javascript:void(0)" onclick="generateRandomPassword('editAdminPasswordInp')" title="Click here to generate password" class="btn btn-info"><i class="fas fa-key"></i></a>
	</div>
</div>
										
<div class="form-group">
	<label class="main-content-label tx-11 tx-medium">Select Admin Roles</label> 
	<div class="row row-sm">
		<div class="col-md-6" style="margin-bottom:10px">
			<label class="ckbox"><input type="checkbox" name="editRoles[]" <?php echo in_array('superadmin', $roles) ? 'checked' : ''; ?> value="superadmin"><span><b>Super Admin</b></span></label>
		</div>
		<div class="col-md-6" style="margin-bottom:10px">
			<label class="ckbox"><input type="checkbox" name="editRoles[]" <?php echo in_array('coffeebeansmanagement', $roles) ? 'checked' : ''; ?> value="coffeebeansmanagement"><span><b>Coffee Management</b></span></label>
		</div>
		<div class="col-md-6" style="margin-bottom:10px">
			<label class="ckbox"><input type="checkbox" name="editRoles[]" <?php echo in_array('customermanagement', $roles) ? 'checked' : ''; ?> value="customermanagement"><span><b>Customer Management</b></span></label>
		</div>
		<div class="col-md-6" style="margin-bottom:10px">
			<label class="ckbox"><input type="checkbox" name="editRoles[]" <?php echo in_array('businessmanagement', $roles) ? 'checked' : ''; ?> value="businessmanagement"><span><b>Business Management</b></span></label>
		</div>
		<div class="col-md-6" style="margin-bottom:10px">
			<label class="ckbox"><input type="checkbox" name="editRoles[]" <?php echo in_array('ordersmanagement', $roles) ? 'checked' : ''; ?> value="ordersmanagement"><span><b>Order Management</b></span></label>
		</div>
		<div class="col-md-6" style="margin-bottom:10px">
			<label class="ckbox"><input type="checkbox" name="editRoles[]" <?php echo in_array('offermanagement', $roles) ? 'checked' : ''; ?> value="offermanagement"><span><b>Offer Management</b></span></label>
		</div>
	</div>
	<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="editAdminRoleError">Please select atleast one role for admin.</p>
</div>

<input type="hidden" id="editId" value="<?php echo $id; ?>">