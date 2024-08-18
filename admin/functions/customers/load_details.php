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
        $customers = $result->fetch_assoc();
    } 
}

?>

<div class="form-group">
	<label class="main-content-label tx-11 tx-medium">Enter Customer Name</label> 
	<input class="form-control" type="text" name="editName" id="editName" value="<?php echo htmlspecialchars($customers['name']); ?>" placeholder="Enter customers name">
	<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="nameError">This field can not be empty.</p>
</div>

<div class="form-group">
	<label class="main-content-label tx-11 tx-medium">Enter Customer Email</label> 
	<input class="form-control" type="text" name="editEmail" id="editEmail" value="<?php echo htmlspecialchars($customers['email']); ?>" placeholder="Enter customers name" onkeyup="chkAvailability(this.value)">
	<input type="hidden" id="currentEmail" value="<?php echo htmlspecialchars($customers['email']); ?>">
	<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="emailError">This field can not be empty.</p>
</div>

<div class="form-group">
	<label class="main-content-label tx-11 tx-medium">Enter Customer Phone</label> 
	<input class="form-control" type="text" name="editPhone" id="editPhone" value="<?php echo htmlspecialchars($customers['phone']); ?>" placeholder="Enter customers name">
	<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="phoneError">This field can not be empty.</p>
</div>


<input type="hidden" id="editId" name="editId" value="<?php echo $id; ?>">
