<?php 
include('../../config/db.php'); 

$id=isset($_POST['id'])?$_POST['id']:'';

if ($id) {
    $sql = "SELECT * FROM coffee WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $coffee = $result->fetch_assoc();
    } 
}

?>

<div class="form-group">
	<label class="main-content-label tx-11 tx-medium">Enter Coffee Beans Name</label> 
	<input class="form-control" type="text" name="edit_coffee_name" id="coffeeNameEditInp" value="<?php echo htmlspecialchars($coffee['coffee_name']); ?>" placeholder="Enter coffee beans name">
	<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="coffeeNameEditError">This field can not be empty.</p>
</div>
										
<div class="form-group">
	<div class="row row-sm">
		<div class="col-sm-6">
			<label class="main-content-label tx-11 tx-medium">Select Coffee Beans</label>
			<div class="row row-sm">
				<div class="col-sm-12">
					<select class="form-control select2-no-search" name="edit_type_of_coffee" id="selectTypeOfCoffeeEdit">
						<option label="Select coffee beans"></option>
						<option <?php if($coffee['type'] == 'Single Origin'){ echo "selected"; } ?> value="Single Origin">Single Origin</option>
						<option <?php if($coffee['type'] == 'Blend'){ echo "selected"; } ?> value="Blend">Blend</option>
					</select>
					<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="typeOfCoffeeEditError">Please select type of coffee beans.</p>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<label class="main-content-label tx-11 tx-medium">Select Roast</label>
			<div class="row row-sm">
				<div class="col-sm-12">
					<select class="form-control select2-no-search" name="edit_type_of_beans" id="selectTypeOfBeansEdit">
						<option label="Select Beans"></option>
						<option <?php if($coffee['beans_type'] == 'Medium Roasted'){ echo "selected"; } ?> value="Medium Roasted">Medium Roasted</option>
						<option <?php if($coffee['beans_type'] == 'Highly Roasted'){ echo "selected"; } ?> value="Highly Roasted">Highly Roasted</option>
					</select>
					<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="typeofBeansEditError">Please select type of roast.</p>
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
						<input class="form-control" name="editPrice" id="priceEditInp" type="text" value="<?php echo htmlspecialchars($coffee['price']); ?>" placeholder="Enter coffee price">
					</div>
					<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="priceEditError">Enter price</p>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<label class="main-content-label tx-11 tx-medium">Upload Image</label>
			<div class="row row-sm">
				<div class="col-sm-12">
					<input class="form-control" name="image" id="imageEditInp" type="file">
					<p class="text-muted mb-0">Only .jpeg, .jpg, .png & .gif</p>
					<input name="hiddenImgName" value="<?php echo htmlspecialchars($coffee['image']); ?>" type="hidden">
					<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="imageEditError">Upload</p>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="form-group">
	<label class="main-content-label tx-11 tx-medium">Enter Short Description</label> 
	<textarea class="form-control" name="editShortDescription" id="shortDescriptionEditInp" placeholder="Enter full description of coffee..."><?php echo htmlspecialchars($coffee['description']); ?></textarea>
	<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="shortDescriptionEditError">Please enter coffee description.</p>
</div>

<div class="form-group">
	<label class="main-content-label tx-11 tx-medium">Enter Coffee Description</label> 
	<textarea class="form-control" name="editDescription" id="descriptionEditInp" placeholder="Enter full description of coffee..."><?php echo htmlspecialchars($coffee['description']); ?></textarea>
	<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="descriptionEditError">Please enter coffee description.</p>
</div>

<input type="hidden" id="editId" name="editId" value="<?php echo $id; ?>">
