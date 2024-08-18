<?php include ('partials/header.php'); ?>
<?php include ('partials/sidebar.php'); ?>


<?php 
$query = "SELECT * from peak_hour";
$result = $conn->query($query);
$row = $result->fetch_assoc();

?>

<div class="main-content app-content">
	<div class="main-container container-fluid">
		<div class="breadcrumb-header justify-content-between">
			<div>
				<h4 class="content-title mb-2" style="text-transform: uppercase;">Peak Hours</h4>
			</div>
			<div class="d-flex my-auto">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
						<li class="breadcrumb-item active " aria-current="page">Peak Hours Management </li>
					</ol>
				</nav>
			</div>
		</div>
		<div class="row row-sm mt-35">
			<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<div class="card overflow-hidden">
					<div class="card-header pd-b-0 pd-t-20 bd-b-0 bg-head">
						<div class="d-flex justify-content-between">
							<h3 class="card-title mg-b-10">Offer</h3>
							<div class="dropdown" style="margin-bottom:10px">
								<a href="javascript:void(0)" class="btn btn-sm bg-primary-gradient d-none" title="Add new peak hours" data-bs-target="#modaldemo1" data-bs-toggle="modal"><b> + Peak Hours</b></a>
							</div>
						</div>
					</div>
					<div class="alert alert-success d-none" id="successAlert" style="margin-top:10px" role="alert">
						<span class="alert-inner--icon"><i class="fa fa-thumbs-up  d-inline-flex"></i></span>
						<span class="alert-inner--text"><strong> Success!</strong> Peak hours has been updated.</span>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="alert alert-danger d-none" id="failAlert" style="margin-top:10px" role="alert">
						<span class="alert-inner--icon"><i class="fa fa-exclamation-triangle d-inline-flex"></i></span>
						<span class="alert-inner--text"><strong> Error!</strong> Something went wrong. Please try again or contact admin.</span>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="card-body">
						<form action="post">
							<div class="form-group">
								<label class="main-content-label tx-11 tx-medium">Select Date</label> 
								<input class="form-control" type="date" id="dateInp" name="dateInp" value="<?php echo $row['date']; ?>">
								<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="dateError">Please select date.</p>
							</div>

							<div class="form-group">
								<label class="main-content-label tx-11 tx-medium">Discount</label> 
								<input class="form-control" type="text" id="discountInp" name="discountInp" value="<?php echo $row['discount']; ?>" placeholder="Enter discount">
								<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="discountError">Please enter discount.</p>
							</div>
										
							<div class="form-group">	
							<div class="row row-sm">
								<div class="col-sm-6">
									<label class="main-content-label tx-11 tx-medium">From Time</label>
									<div class="row row-sm">
										<div class="col-sm-12">
											<select class="form-control" id="fromTimeInp" name="fromTimeInp">
												<option label="Select 'from' time"></option>
												<option <?php if($row['from_time'] == '00:00 AM'){ echo "selected"; } ?> value="00:00 AM">12:00 AM</option>
												<option <?php if($row['from_time'] == '01:00 AM'){ echo "selected"; } ?> value="01:00 AM">01:00 AM</option>
												<option <?php if($row['from_time'] == '02:00 AM'){ echo "selected"; } ?> value="02:00 AM">02:00 AM</option>
												<option <?php if($row['from_time'] == '03:00 AM'){ echo "selected"; } ?> value="03:00 AM">03:00 AM</option>
												<option <?php if($row['from_time'] == '04:00 AM'){ echo "selected"; } ?> value="04:00 AM">04:00 AM</option>
												<option <?php if($row['from_time'] == '05:00 AM'){ echo "selected"; } ?> value="05:00 AM">05:00 AM</option>
												<option <?php if($row['from_time'] == '06:00 AM'){ echo "selected"; } ?> value="06:00 AM">06:00 AM</option>
												<option <?php if($row['from_time'] == '07:00 AM'){ echo "selected"; } ?> value="07:00 AM">07:00 AM</option>
												<option <?php if($row['from_time'] == '08:00 AM'){ echo "selected"; } ?> value="08:00 AM">08:00 AM</option>
												<option <?php if($row['from_time'] == '09:00 AM'){ echo "selected"; } ?> value="09:00 AM">09:00 AM</option>
												<option <?php if($row['from_time'] == '10:00 AM'){ echo "selected"; } ?> value="10:00 AM">10:00 AM</option>
												<option <?php if($row['from_time'] == '11:00 AM'){ echo "selected"; } ?> value="11:00 AM">11:00 AM</option>
												<option <?php if($row['from_time'] == '12:00 PM'){ echo "selected"; } ?> value="12:00 PM">12:00 PM</option>
												<option <?php if($row['from_time'] == '01:00 PM'){ echo "selected"; } ?> value="01:00 PM">01:00 PM</option>
												<option <?php if($row['from_time'] == '02:00 PM'){ echo "selected"; } ?> value="02:00 PM">02:00 PM</option>
												<option <?php if($row['from_time'] == '03:00 PM'){ echo "selected"; } ?> value="03:00 PM">03:00 PM</option>
												<option <?php if($row['from_time'] == '04:00 PM'){ echo "selected"; } ?> value="04:00 PM">04:00 PM</option>
												<option <?php if($row['from_time'] == '05:00 PM'){ echo "selected"; } ?> value="05:00 PM">05:00 PM</option>
												<option <?php if($row['from_time'] == '06:00 PM'){ echo "selected"; } ?> value="06:00 PM">06:00 PM</option>
												<option <?php if($row['from_time'] == '07:00 PM'){ echo "selected"; } ?> value="07:00 PM">07:00 PM</option>
												<option <?php if($row['from_time'] == '08:00 PM'){ echo "selected"; } ?> value="08:00 PM">08:00 PM</option>
												<option <?php if($row['from_time'] == '09:00 PM'){ echo "selected"; } ?> value="09:00 PM">09:00 PM</option>
												<option <?php if($row['from_time'] == '10:00 PM'){ echo "selected"; } ?> value="10:00 PM">10:00 PM</option>
												<option <?php if($row['from_time'] == '11:00 PM'){ echo "selected"; } ?> value="11:00 PM">11:00 PM</option>
											</select>
											<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="fromTimeError">Please select from time.</p>
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<label class="main-content-label tx-11 tx-medium">To Time</label>
									<div class="row row-sm">
										<div class="col-sm-12">
											<select class="form-control" id="toTimeInp" name="toTimeInp">
												<option label="Select 'to' time"></option>
												<option <?php if($row['to_time'] == '00:00 AM'){ echo "selected"; } ?> value="00:00 AM">12:00 AM</option>
												<option <?php if($row['to_time'] == '01:00 AM'){ echo "selected"; } ?> value="01:00 AM">01:00 AM</option>
												<option <?php if($row['to_time'] == '02:00 AM'){ echo "selected"; } ?> value="02:00 AM">02:00 AM</option>
												<option <?php if($row['to_time'] == '03:00 AM'){ echo "selected"; } ?> value="03:00 AM">03:00 AM</option>
												<option <?php if($row['to_time'] == '04:00 AM'){ echo "selected"; } ?> value="04:00 AM">04:00 AM</option>
												<option <?php if($row['to_time'] == '05:00 AM'){ echo "selected"; } ?> value="05:00 AM">05:00 AM</option>
												<option <?php if($row['to_time'] == '06:00 AM'){ echo "selected"; } ?> value="06:00 AM">06:00 AM</option>
												<option <?php if($row['to_time'] == '07:00 AM'){ echo "selected"; } ?> value="07:00 AM">07:00 AM</option>
												<option <?php if($row['to_time'] == '08:00 AM'){ echo "selected"; } ?> value="08:00 AM">08:00 AM</option>
												<option <?php if($row['to_time'] == '09:00 AM'){ echo "selected"; } ?> value="09:00 AM">09:00 AM</option>
												<option <?php if($row['to_time'] == '10:00 AM'){ echo "selected"; } ?> value="10:00 AM">10:00 AM</option>
												<option <?php if($row['to_time'] == '11:00 AM'){ echo "selected"; } ?> value="11:00 AM">11:00 AM</option>
												<option <?php if($row['to_time'] == '12:00 PM'){ echo "selected"; } ?> value="12:00 PM">12:00 PM</option>
												<option <?php if($row['to_time'] == '01:00 PM'){ echo "selected"; } ?> value="01:00 PM">01:00 PM</option>
												<option <?php if($row['to_time'] == '02:00 PM'){ echo "selected"; } ?> value="02:00 PM">02:00 PM</option>
												<option <?php if($row['to_time'] == '03:00 PM'){ echo "selected"; } ?> value="03:00 PM">03:00 PM</option>
												<option <?php if($row['to_time'] == '04:00 PM'){ echo "selected"; } ?> value="04:00 PM">04:00 PM</option>
												<option <?php if($row['to_time'] == '05:00 PM'){ echo "selected"; } ?> value="05:00 PM">05:00 PM</option>
												<option <?php if($row['to_time'] == '06:00 PM'){ echo "selected"; } ?> value="06:00 PM">06:00 PM</option>
												<option <?php if($row['to_time'] == '07:00 PM'){ echo "selected"; } ?> value="07:00 PM">07:00 PM</option>
												<option <?php if($row['to_time'] == '08:00 PM'){ echo "selected"; } ?> value="08:00 PM">08:00 PM</option>
												<option <?php if($row['to_time'] == '09:00 PM'){ echo "selected"; } ?> value="09:00 PM">09:00 PM</option>
												<option <?php if($row['to_time'] == '10:00 PM'){ echo "selected"; } ?> value="10:00 PM">10:00 PM</option>
												<option <?php if($row['to_time'] == '11:00 PM'){ echo "selected"; } ?> value="11:00 PM">11:00 PM</option>
											</select>
											<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="toTimeError">Please select to time.</p>
										</div>
									</div>
								</div>
							</div>
							</div>

							<div class="form-group">
								<label class="main-content-label tx-11 tx-medium">Enter Offer Description</label> 
								<textarea class="form-control" id="descriptionInp" name="offerDescription" placeholder="Enter full description of offer..."><?php echo $row['description']; ?></textarea>
								<p class="tx-13 text-muted mb-2 text-danger mt-2 d-none" id="descriptionError">Please enter offer description.</p>
							</div>

							<div class="form-group" style="text-align: right;">
								<input type="hidden" value="<?php echo $row['id']; ?>" id="editId" name="editId">
								<a href="javascript:void(0)" class="btn btn-primary" onclick="updateOffer()">Update</a>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-lg-3"></div>
		</div>
	</div>
</div>

<script type="text/javascript">

function updateOffer(){

	$('#successAlert').addClass('d-none');
	$('#failAlert').addClass('d-none');

	var date = $('#dateInp').val();
	var discount = $('#discountInp').val();
	var from = $('#fromTimeInp').val();
	var to = $('#toTimeInp').val();
	var description = $('#descriptionInp').val();

	var id = $('#editId').val();

	if(date == ''){
		$('#dateInp').focus();
		$('#dateError').text('Please select date.');
		$('#dateError').removeClass('d-none');
		return;
	}else{
		$('#dateError').addClass('d-none');
	}

	if(discount == ''){
		$('#discountInp').focus();
		$('#discountError').text('Please enter discount.');
		$('#discountError').removeClass('d-none');
		return;
	}else{
		$('#discountError').addClass('d-none');
	}

	if(from == ''){
		$('#fromTimeInp').focus();
		$('#fromTimeError').text('Please select time.');
		$('#fromTimeError').removeClass('d-none');
		return;
	}else{
		$('#fromTimeError').addClass('d-none');
	}

	if(to == ''){
		$('#toTimeInp').focus();
		$('#toTimeError').text('Please select time.');
		$('#toTimeError').removeClass('d-none');
		return;
	}else{
		$('#toTimeError').addClass('d-none');
	}

	if(description == ''){
		$('#descriptionInp').focus();
		$('#descriptionError').text('Please enter description.');
		$('#descriptionError').removeClass('d-none');
		return;
	}else{
		$('#descriptionError').addClass('d-none');
	}

	$.ajax({
		type: 'POST',
		url: 'functions/offers/update_offer.php',
		data: {
			date:date,
			discount:discount,
			from:from,
			to:to,
			description:description,
			id:id
		},
		success: function(result){
			if(result == '1'){
				$('#successAlert').removeClass('d-none');
			}else{
				$('#failAlert').removeClass('d-none');
			}
		}
	});
}

</script>
<?php include ('partials/footer.php'); ?>
