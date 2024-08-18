<?php include ('partials/header.php'); ?>
<?php include ('partials/sidebar.php'); ?>

<?php 
$get_id = base64_decode($_GET['user-id']);

$query = "SELECT * from users where id = '$get_id'";
$result = $conn->query($query);
$row = $result->fetch_assoc();

?>
<div class="main-content app-content">
	<div class="main-container container-fluid">
		<div class="breadcrumb-header justify-content-between">
			<div>
				<h4 class="content-title mb-2">Customer Details</h4>
			</div>
			<div class="d-flex my-auto">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="customer-management.php">Customers</a></li>
						<li class="breadcrumb-item active " aria-current="page">Customer Details</li>
					</ol>
				</nav>
			</div>
		</div>
		<div class="row row-sm">
			<div class="col-xl-4">
				<div class="card mg-b-20">
					<div class="card-body">
						<div class="ps-0">
							<div class="main-profile-overview">
								<div class="d-flex">
									<div class="main-img-user profile-user">
										<img alt="" src="../api/v1/<?php echo $row['profile_pic']; ?>">
									</div>
									<div class="d-flex justify-content-between mg-b-20 mt-5 ms-3">
			    						<div>
											<h5 class="main-profile-name"><?php echo $row['name']; ?></h5>
											<p class="main-profile-name-text"><b>Customer Since</b> <?php echo date('d/m/Y', strtotime($row['created_at'])); ?></p>
										</div>
									</div>
								</div>
                                <div class="main-profile-social-list">
									<div class="media">
										<div class="media-icon bg-primary-transparent text-primary">
											<i class="fa fa-envelope"></i>
										</div>
										<div class="media-body">
											<span><b>Email Id</b></span><a href="javascript:void(0)"><?php echo $row['email']; ?></a>
										</div>
									</div>
                                    <div class="media">
										<div class="media-icon bg-primary-transparent text-primary">
											<i class="fa fa-mobile"></i>
										</div>
										<div class="media-body">
											<span><b>Mobile</b></span><a href="javascript:void(0)"><?php echo $row['phone']; ?></a>
										</div>
									</div>
                                    <div class="media">
										<div class="media-icon bg-primary-transparent text-primary">
											<i class="fa fa-check-circle"></i>
										</div>
										<div class="media-body">
											<span><b>Status</b></span><a href="javascript:void(0)"><?php if($row['status'] == 'A'){ echo "Active";}else {echo "Inactive";}; ?></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-8">
                <div class="card overflow-hidden">
				    <div class="card-header pd-b-0 pd-t-20 bd-b-0 bg-head">
					    <div class="d-flex justify-content-between">
						    <h3 class="card-title mg-b-10">Order History</h3>
						    <div class="dropdown d-none" style="margin-bottom:10px">
						    	<a href="javascript:void(0)" class="btn btn-sm bg-primary-gradient" title="Add new business customer" data-bs-target="#modaldemo1" data-bs-toggle="modal"><b> + Business Customer</b></a>
						    </div>
					    </div>
				    </div>
			        <div class="card-body">
			        	<div class="table-responsive">
			        		<table class="table border-top-0  table-bordered text-nowrap border-bottom" id="responsive-datatable">
			        			<thead>
			        				<tr>
			        					<th class="text-center wd-15p border-bottom-0">S. No.</th>
			        					<th class="text-center wd-15p border-bottom-0">Order ID</th>
			        					<th class="text-center wd-20p border-bottom-0">Coffee Beans</th>
			        					<th class="text-center wd-15p border-bottom-0">Quantity</th>
			        					<th class="text-center wd-10p border-bottom-0">Price</th>
			        					<th class="text-center wd-25p border-bottom-0">Status</th>
			        				</tr>
			        			</thead>
			        			<tbody>
                                    <?php 
                                    $query = "SELECT orders.*, coffee.coffee_name AS coffee_name FROM orders JOIN coffee ON orders.coffee_id = coffee.id where orders.user_id = '$get_id' order by orders.id desc";
                                    $result = $conn->query($query);
                                    $sno = '';
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            $sno++;
                                    ?>
                                    <tr id="tr_<?php echo $sno; ?>">
                                        <td class="text-center"><?php echo $sno; ?></td>
                                        <td class="text-center">
                                            <a class="badge bg-pill bg-primary-transparent" href="javascript:void(0)"><?php echo $row["order_id"]; ?></a>
                                        </td>
                                        <td class="text-center"><?php echo $row["coffee_name"]; ?></td>
                                        <td class="text-center"><?php echo $row["quantity"]; ?></td>
                                        <td class="text-center">$ <?php echo $row["price"]; ?></td>
                                        <td class="text-center">
                                            <span class="badge bg-primary"><?php echo $row["status"]; ?></span>
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


<?php include ('partials/footer.php'); ?>
