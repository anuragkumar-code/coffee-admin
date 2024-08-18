<?php 
session_start();
include('config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

	// echo $password; exit;
    $query = "SELECT * FROM admins WHERE email = ? AND status = 'A'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $admin = $result->fetch_assoc();
        if ($password === $admin['password']) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['name'];
            $_SESSION['admin_role'] = explode(',', $admin['role']);

            header("Location: dashboard.php");
            exit();
			
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "No user found with this email!";
    }
}

echo "<script>if ( window.history.replaceState ) {  window.history.replaceState( null, null, window.location.href ); }</script>";

?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title>Login - Admin Panel</title>

		<link rel="icon" href="assets/img/brand/favicon.png" type="image/x-icon">
		<link href="assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet" id="style">
		<link href="assets/css/icons.css" rel="stylesheet">
		<link href="assets/css/style.css" rel="stylesheet">
		<link href="assets/css/plugins.css" rel="stylesheet">
		
	</head>
	<body class="main-body bg-light  login-img">
		<div id="global-loader">
			<img src="assets/img/loaders/loader-4.svg" class="loader-img" alt="Loader">
		</div>

		<div class="page" style="background-color: #ffcfcd;">
			<div class="my-auto page page-h">
				<div class="main-signin-wrapper">
					<div class="col-xl-3 col-lg-4 col-md-5 col-sm-8">
						<div class="card">
							<div class="card-body p-5">
								<div class="main-signin-header">
									<div class="text-center">
										<img src="assets/logo.jpg" alt="Logo" class="img-fluid logo-img mb-4">
									</div>
									<h2>Welcome back!</h2>
									<h4>Please sign in to continue</h4>

									<?php if (isset($error)){ ?>
										<div class="alert alert-danger mg-b-0" role="alert">
											<button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button">
												<span aria-hidden="true">×</span>
											</button>
											<strong><?php echo $error; ?></strong>
										</div>
									<?php } ?>

									<form method="post">
										<div class="form-group">
											<label>Email</label>
											<input class="form-control" name="email" placeholder="Enter your email" type="text" required>
										</div>
										<div class="form-group">
											<label>Password</label>
											<input class="form-control" name="password" placeholder="Enter your password" type="password" required>
										</div>
										<button class="btn btn-primary btn-block">Sign In</button>
									</form>
								</div>
								<div class="main-signin-footer mt-3 mg-t-5 d-none">
									<p><a href="">Forgot password?</a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script src="assets/plugins/jquery/jquery.min.js"></script>

		<script src="assets/plugins/bootstrap/popper.min.js"></script>
		<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

		<script src="assets/plugins/ionicons/ionicons.js"></script>

		<script src="assets/plugins/moment/moment.js"></script>

		<script src="assets/js/eva-icons.min.js"></script>

		<script src="assets/js/themecolor.js"></script>

		<script src="assets/js/swither-styles.js"></script>

		<script src="assets/js/custom.js"></script>

	</body>
</html>