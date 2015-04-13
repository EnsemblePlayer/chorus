<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Ensemble - Login</title>

		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="res/css/login.css">
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>

		<script src="res/js/jquery-2.1.1.js"></script>
		<script src="res/js/login.js"></script>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<?php include "../api/includes/dev.php" ?>
	<body>
    	<hgroup>
			<h1>Login</h1>
		</hgroup>
		<?php if(isset($_GET['error']) && $_GET['error'] == "1") { ?>
			<div class="alert alert-error">
				<i class="fa fa-exclamation-triangle"></i> Invalid credentials
			</div>
		<?php } ?>
		<?php if(isset($_GET['error']) && $_GET['error'] == "2") { ?>
			<div class="alert alert-error">
				<i class="fa fa-exclamation-triangle"></i> No POSTed input
			</div>
		<?php } ?>
		<?php if(isset($_GET['success']) && $_GET['success'] == "1") { ?>
			<div class="alert alert-success">
				<i class="fa fa-info"></i> Account created
			</div>
		<?php } ?>
		<?php if(isset($_GET['success']) && $_GET['success'] == "2") { ?>
			<div class="alert alert-warning">
				<i class="fa fa-exclamation-triangle"></i> Unable to acquire GPM device ID
			</div>
		<?php } ?>
		<form class="form-signin" role="form" id="form" method="POST" action="../api/login.php">
			<div class="group">
				<input type="email"><span class="highlight"></span><span class="bar"></span>
				<label>Username</label>
			</div>
			<div class="group">
				<input type="password"><span class="highlight"></span><span class="bar"></span>
				<label>Password</label>
			</div>
			<button type="button" class="button buttonBlue" onclick="submitForm()">Login
				<div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
			</button>
			<button type="button" class="button buttonRed" onclick="toRegister()">Register
				<div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
			</button>
			<input type="submit" style="display:none;">
		</form>
		<footer>&copy; 2015 Ensemble</footer>
		<script>
			function submitForm() {
				document.getElementById("form").submit();
			}

			function toRegister() {
				window.location.href = "register.php";
			}
    	</script>
</html>