<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="res/css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="res/css/newplayer.css"> <!-- Resource style -->
	<link rel="stylesheet" href="res/css/newplayermodal.css">
	<script src="res/js/modernizr.js"></script> <!-- Modernizr -->
  	
	<title>Ensemble</title>
</head>
<body>
	<main>

		<h1>Full-Screen Pushing Navigation</h1>

		<p>A full page menu, that replaces the current content by pushing it off the screen.</p>

	</main>

	<div class="music-bar colorize-dominant colorize-bg">
		<img class="album-art" src="res/img/album.png"/>
		<div class="song-metadata">
			<p class="song-title">Happy (From "Despicable Me 2")</p>
			<p class="song-subtitle">Pharrell Williams - G I R L - Thomas Gaubert - Google Play Music</p>
		</div>
	</div>

	<a href="#cd-nav" class="cd-nav-trigger colorize-dominant colorize-bg">Menu 
		<span class="cd-nav-icon"></span>

		<svg x="0px" y="0px" width="54px" height="54px" viewBox="0 0 54 54">
			<circle fill="transparent" stroke="#ffffff" stroke-width="1" cx="27" cy="27" r="25" stroke-dasharray="157 157" stroke-dashoffset="157"></circle>
		</svg>
	</a>
	
	<div id="cd-nav" class="cd-nav colorize-dominant colorize-img" style="background-image: url('res/img/bg.jpg'); background-size: cover;">
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

				<a href="#fullscreen" class="fullscreen"><i class="fa fa-expand"></i></a>
			</div><!-- .cd-half-block -->
			
			<div class="cd-half-block">
				<span class="logo">Ensemble</span>
			</div> <!-- .cd-half-block -->
		</div> <!-- .cd-navigation-wrapper -->
	</div> <!-- .cd-nav -->
	<script src="res/js/jquery-2.1.1.js"></script>
	<script src="res/js/velocity.min.js"></script>
	<script src="res/js/player.js"></script> <!-- Resource jQuery -->
	<script src="res/js/color-thief.min.js"></script>
	<script src="res/js/playercolorize.js"></script>
</body>
</html>