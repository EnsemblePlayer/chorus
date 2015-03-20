<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="res/css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="res/css/newplayer.css"> <!-- Resource style -->
	<link rel="stylesheet" href="res/css/newplayertest.css">
	<link rel="stylesheet" href="res/css/newplayermodal.css">
	<script src="res/js/modernizr.js"></script> <!-- Modernizr -->
  	
	<title>Ensemble</title>
</head>
<body>
	<main>
		<a href="#cd-nav-alt" class="cd-nav-trigger-alt">Menu 
		<span class="cd-nav-icon"></span>

		<svg x="0px" y="0px" width="54px" height="54px" viewBox="0 0 54 54">
			<circle fill="transparent" stroke="#656e79" stroke-width="1" cx="27" cy="27" r="25" stroke-dasharray="157 157" stroke-dashoffset="157"></circle>
		</svg>
	</a>
	
		<h1>Full-Screen Pushing Navigation</h1>

		<p>A full page menu, that replaces the current content by pushing it off the screen.</p>

	</main>

	<a href="#cd-nav" class="cd-nav-trigger">Menu 
		<span class="cd-nav-icon"></span>

		<svg x="0px" y="0px" width="54px" height="54px" viewBox="0 0 54 54">
			<circle fill="transparent" stroke="#656e79" stroke-width="1" cx="27" cy="27" r="25" stroke-dasharray="157 157" stroke-dashoffset="157"></circle>
		</svg>
	</a>
	
	<div id="cd-nav" class="cd-nav">
		<div class="cd-navigation-wrapper">
			<div class="cd-half-block">
				<nav>
					<ul class="cd-primary-nav">
						<li><a href="#0" class="selected">Home</a></li>
						<li><a href="#0">Music</a></li>
						<li><a href="#0">Settings</a></li>
						<li><a href="#0">Logout</a></li>
					</ul>
				</nav>
			</div><!-- .cd-half-block -->
			
			<div class="cd-half-block">
				<span class="logo">Ensemble</span>
			</div> <!-- .cd-half-block -->
		</div> <!-- .cd-navigation-wrapper -->
	</div> <!-- .cd-nav -->
	<script src="res/js/jquery-2.1.1.js"></script>
	<script src="res/js/velocity.min.js"></script>
	<script src="res/js/player.js"></script> <!-- Resource jQuery -->
</body>
</html>