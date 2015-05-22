<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Ensemble</title>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="res/css/landing.css">
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	
	<?php include "api/includes/dev.php" ?>
	<body style="font-family: 'Roboto', sans-serif; background: #333; color: white; text-align: center; font-size: 18px;">
		<h1 style="font-family: 'Lobster', cursive; color: #f2f2f2; font-size: 100px;">Whoops</h1>
		<p>Ensemble encountered an error and was unable to recover. Here's what we know:</p>
		<?php
			if(isset($_SERVER['HTTP_REFERER'])) {
				echo "Last visited page: " . $_SERVER['HTTP_REFERER'];
			} else {
				echo "Last visited page is unknown. Did an error really occur?";
			}
		?>

		<?php if(isset($_GET['error']) && $_GET['error'] == "1") { ?>
			<p>Error code 1: Failed to connect to database.</p>
		<?php } else if(isset($_GET['error'])) { ?>
			<p>Unknown error code <?php echo $_GET['error']; ?></p>
		<?php } else { ?>
			<p>No error code reported.</p>
		<?php } ?>

		<div class="buttons">
			<a href="index.php" class="button download">Home</a>
			<a href="app/index.php" class="button github">Return to Ensemble</a> 
			<!-- &nbsp;
			<a href="" class="button register">Register</a> &nbsp;
			<a href="" class="button login">Login</a> -->
		</div>

		<div style="margin-top: 50px;">
			Still having problems? Please <a href="https://github.com/EnsemblePlayer/chorus/issues/new">file an issue</a> on GitHub!
		</div>

		<div style="margin-top: 50px; font-size: 12px;">
			&copy; 2015 Ensemble
		</div>
	</body>
</html>