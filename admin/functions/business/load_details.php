<?php 
include('../../config/db.php'); 

$id=isset($_POST['id'])?$_POST['id']:'';

if ($id) {
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $business = $result->fetch_assoc();
    } 
}

?>

<div class="form-group">
	<label class="main-content-label tx-11 tx-medium">Enter Business Name</label> 
	<input class="form-control" type="text" name="editName" id="editName" value="<?php echo htmlspecialchars($business['name']); ?>" placeholder="Enter business name">
	<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="nameError">This field can not be empty.</p>
</div>

<div class="form-group">
	<label class="main-content-label tx-11 tx-medium">Enter Business Email</label> 
	<input class="form-control" type="text" name="editEmail" id="editEmail" value="<?php echo htmlspecialchars($business['email']); ?>" placeholder="Enter business email" onkeyup="chkAvailability(this.value)">
	<input type="hidden" id="currentEmail" value="<?php echo htmlspecialchars($business['email']); ?>">
	<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="emailError">This field can not be empty.</p>
</div>

<div class="form-group">
	<label class="main-content-label tx-11 tx-medium">Enter Business Phone</label> 
	<input class="form-control" type="text" name="editPhone" id="editPhone" value="<?php echo htmlspecialchars($business['phone']); ?>" placeholder="Enter business phone">
	<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="phoneError">This field can not be empty.</p>
</div>

<div class="form-group">
	<label class="main-content-label tx-11 tx-medium">Enter Business EIN</label> 
	<input class="form-control" type="text" name="editEin" id="editEin" value="<?php echo htmlspecialchars($business['ein']); ?>" placeholder="Enter business EIN" onkeyup="chkEin(this.value)">
	<input type="hidden" id="currentEin" value="<?php echo htmlspecialchars($business['ein']); ?>">
	<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="einError">This field can not be empty.</p>
</div>

<input type="hidden" id="editId" name="editId" value="<?php echo $id; ?>">
