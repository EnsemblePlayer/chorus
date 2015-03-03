<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Ensemble - Login</title>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="res/css/login.css">
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div style="width: 100%; height: 100%;">
			<div class="album-banner">
				<h1 class="title" href="music.html">Login</h1>
			</div>
		</div>

		<form class="form-signin" role="form" id="form" method="POST" action="../api/login.php">
			<?php if(isset($_GET['error']) && $_GET['error'] == "1") { ?>
				<div class="alert alert-danger">
					<b>Login failed:</b> Invalid credentials
				</div>
			<?php } ?>
			<?php if(isset($_GET['error']) && $_GET['error'] == "2") { ?>
				<div class="alert alert-danger">
					<b>Login failed:</b> No POSTed input
				</div>
			<?php } ?>
			<?php if(isset($_GET['success']) && $_GET['success'] == "1") { ?>
				<div class="alert alert-success">
					<b>Account created:</b> You may now login
				</div>
			<?php } ?>
			<input id="top" type="text" class="form-control" name="username" placeholder="Username" maxlength="30" required autofocus>
			<input id="bottom" type="password" class="form-control" name="password" placeholder="Password" maxlength="30" required>
			<div class="buttons pull-right">
				<a class="button secondary" href="register.php">Register</a>
				<a id="submit" class="button primary" href="javascript:submitForm()">Login</a>
				<input type="submit" style="display:none;"> <!--EDIT THIS LATER-->
			</div>
		</form>

		<p class="footer">&copy; 2015 Ensemble</p>
		<script>
			function submitForm() {
				document.getElementById("form").submit();
			}
    	</script>
	</body>
</html>