<!doctype html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<link rel="stylesheet" href="res/css/reset.css"> <!-- CSS reset -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="res/css/newplayer.css"> <!-- Resource style -->
		<link rel="stylesheet" href="res/css/newplayermodal.css">
		<link rel="stylesheet" href="res/css/newmusic.css">
		<script src="res/js/modernizr.js"></script> <!-- Modernizr -->
	  	
		<title>Ensemble</title>
	</head>
	<body>
		<main>
			<div class="music-services">
				<div class="music-service music-service-gpm">
					<h1>Google Play Music <small>tpgaubert@gmail.com</small></h1>
					<form class="form" id="gpform" method="POST" action="../api/addsong.php">
						<div class="form-group">
							<input type="hidden" class="form-control" name="service" value="1" required>
							<input type="text" class="form-control" name="song" placeholder="Search Query" required>
						</div>
						<a id="submit" class="button primary" href="javascript:submitGPM()">Submit</a>
						<input type="submit" style="display:none;"> <!--EDIT THIS LATER-->
					</form>
				</div>
				<div class="music-service music-service-spotify">
					<h1>Spotify <small>Coming soon!</small></h1>
				</div>
				<div class="music-service music-service-yt">
					<h1>YouTube</h1>
					<form class="form" id="ytform" method="POST" action="../api/addsong.php">
						<div class="form-group">
							<input type="hidden" class="form-control" name="service" value="0" required>
							<input type="text" class="form-control" name="song" placeholder="YouTube URL or Video ID" required>
						</div>
						<a id="submit" class="button primary" href="javascript:submitYouTube()">Submit</a>
						<input type="submit" style="display:none;"> <!--EDIT THIS LATER-->
					</form>
				</div>
			</div>
		</main>

		<div class="music-bar colorize-dominant colorize-bg">
			<img class="album-art" src="res/img/album.png"/>
			<div class="song-metadata">
				<p class="song-title">Happy (From "Despicable Me 2")</p>
				<p class="song-subtitle">Pharrell Williams - G I R L - tgaubert - Google Play Music</p>
			</div>
		</div>

		<a href="#cd-nav" class="cd-nav-trigger colorize-dominant colorize-bg">Menu 
			<span class="cd-nav-icon"></span>

			<svg x="0px" y="0px" width="54px" height="54px" viewBox="0 0 54 54">
				<circle fill="transparent" stroke="#ffffff" stroke-width="1" cx="27" cy="27" r="25" stroke-dasharray="157 157" stroke-dashoffset="157"></circle>
			</svg>
		</a>
		
		<div id="cd-nav" class="cd-nav colorize-dominant colorize-img" style="background-image: url(<?php echo "'" . $artist_art . "'";?>); background-size: cover;">
			<div class="cd-navigation-wrapper">
				<div class="cd-half-block">
					<nav>
						<ul class="cd-primary-nav">
							<li><a href="newindex.php">Home</a></li>
							<li><a href="#" class="selected">Music</a></li>
							<li><a href="#0">Settings</a></li>
							<li><a href="logout.php">Logout</a></li>
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
		<script type="text/javascript">
		    //var imageData = "<?php echo getImageData($album_art); ?>";
		</script>
		<script src="res/js/color-thief.min.js"></script>
		<script src="res/js/playercolorize.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		<script>
			function submitYouTube() {
				document.getElementById("ytform").submit();
			}

			function submitGPM() {
				document.getElementById("gpform").submit();
			}
    	</script>

		<?php
			function getImageData($url) {
				$image = file_get_contents($url);
				if ($image != false) {
				    return 'data:image/jpg;base64,'.base64_encode($image);
				}
			}
		?>
	</body>
</html>