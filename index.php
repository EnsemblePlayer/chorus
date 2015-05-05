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
	<body style="font-family: 'Roboto', sans-serif; background: #333; color: white;">
		<div id="fullpage">
			<div class="section">
				<div style="width: 100%; height: 100%;">
					<div style="background-size: cover; background-image: url('res/img/albums.jpg'); height: 400px; padding: 25px; box-shadow: 0px 400px rgba(73, 73, 73, 0.6) inset;">
						<div style="padding-top: 15px; text-align: center;">
							<p><span style="font-family: 'Lobster', cursive; color: #f2f2f2; font-size: 128px;">Ensemble</span></p>
							<p><span style="color: #f2f2f2; font-size: 28px; font-weight: 300;">unified streaming music</span></p>
							<div class="buttons">
								<a href="app/register.php" class="button download">Register</a>
								<a href="app/login.php" class="button github">Login</a> 
								<!-- &nbsp;
								<a href="" class="button register">Register</a> &nbsp;
								<a href="" class="button login">Login</a> -->
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="container" style="text-align: center;">
				<h1>Your Music</h1>
				<p>Login to your music streaming services of choice and listen away.<p>
				
				<img src="res/img/playmusic.png" width="150" height="150" style="margin-right: 12px;"/> <i class="fa fa-plus fa-2x"></i>
				<img src="res/img/youtube.png" width="150" height="106" style="margin-left: 12px; margin-right: 12px;"/> <i class="fa fa-plus fa-2x"></i>
				<img src="res/img/spotify.png" width="150" height="150" style="margin-left: 12px;"/>
				
				<h1>Your Friends</h1>
				<p>Create and manage a queue made up of songs from different people and services.</p>
				<img src="res/img/list.png" width="150" height="150"/>
				
				<h1>Your Device</h1>
				<p>
					Designed with cross platform compatibility and performance in mind,<br>instantly create a music streamer wherever you are.
				</p>
				<img src="res/img/osx.png" width="100" height="100"/>
				<img src="res/img/pi.png" width="150" height="150"/>
				<img src="res/img/win.png" width="100" height="100"/>
			</div>
			
			<!-- FOOTER -->
			<div style="bottom: 0; width: 100%; text-align: center; margin-top: 100px;">
				<span>
					<i class="fa fa-code"></i> with <i class="fa fa-heart"></i> by Anthony Bauer and Thomas Gaubert and Grant Uy<br>
					HackDFW 2015 - The University of Texas at Austin</p>
				</span>
				<br>
				<a href="http://github.com/EnsemblePlayer" class="button github">
					<i class="fa fa-github" style="padding-top: 6px;"></i> GitHub
				</a>
				<img src="res/img/buildings.png" width="100%"/>
			</div>
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
		<script src="res/js/material.js"></script>
	</body>
</html>