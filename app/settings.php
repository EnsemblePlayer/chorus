<!DOCTYPE html>
<html lang="en">
	<?php
	require '../api/includes/logged.php';
	$ignoress = true;
	require '../api/includes/connect.php';
	//TOFIX: player association
	$player = 1;
	$s = $m->query("SELECT * FROM `players` WHERE `playerId`='$player'") or die($m->error);
	$f = $s->fetch_array(MYSQLI_ASSOC);
	$startpause = ($f['Status'] == 1) ? "pause" : "";
	$m->close();
	?>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="theme-color" content="#333">

		<link href='//fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic' rel='stylesheet' type='text/css'>
		<link href='//fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<link rel="stylesheet" href="res/css/reset.css"> <!-- CSS reset -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="res/css/newplayer.css"> <!-- Resource style -->
		<link rel="stylesheet" href="res/css/newplayermodal.css">
		<link rel="stylesheet" href="res/css/alerts.css">
		<link rel="icon" sizes="500x500" href="res/img/icon.png">

		<script src="res/js/modernizr.js"></script> <!-- Modernizr -->
	  	
		<title>Ensemble</title>
	</head>
	<?php 
		$data = file_get_contents("https://ensembleplayer.me/api/queue.php");
		$array = json_decode($data, true);

		if(count($array) == 0) {
			$title = "Nothing is in the Queue";
			$subtitle = "Use Music tab to play a song.";
			$album_art = "res/img/icon.png";
			$artist_art = "";
		} else {
			$title = $array[0]['title'];
			$artist = $array[0]['artist'];
			$album = $array[0]['album'];
			$service = $array[0]['service'];
			$user = $array[0]['user'];
			$album_art = $array[0]['album_art'];
			$artist_art = $array[0]['artist_art'];

			if($album_art == "") {
				$album_art = "res/img/icon.png";
			}

			if($artist_art == "") {
				$artist_art = "res/img/albums.jpg";
			}

			if($service == "YouTube" || $artist == "") {
				$subtitle = $artist . " - " . $user . " - " . $service;
				if($service == "YouTube")
					$album = "res/img/youtube.png";
			} else {
				$subtitle = $artist . " - " . $album . " - " . $user . " - " . $service;
			}
		}
	?>
	<body>
		<main>
			<?php if(isset($_GET['success']) && $_GET['success'] == "1") { ?>
				<div class="alert alert-success">
					<b>Changes saved</b>
				</div>
			<?php } ?>
			<?php if(isset($_GET['error']) && $_GET['error'] == "1") { ?>
				<div class="alert alert-danger">
					<b>Error:</b> No input
				</div>
			<?php } ?>
			<?php if(isset($_GET['error']) && $_GET['error'] == "2") { ?>
				<div class="alert alert-danger">
					<b>Error:</b> Invalid ID
				</div>
			<?php } ?>
			<?php if(isset($_GET['error']) && $_GET['error'] == "3") { ?>
				<div class="alert alert-danger">
					<b>Error:</b> Unable to get GPM device ID
				</div>
			<?php } ?>
			<form role="form" id="form" method="POST" action="../api/settings.php">
				<h1>Music Accounts</h1>
				<h3>Google Play Music</h3>
				<input type="email" class="form-control" name="gpusername" placeholder="Google Play Music Email" value="<?=$_SESSION['googleplay']?>">
				<input type="password" class="form-control" name="gppassword" placeholder="Google Play Music Password">
				<br>
				<h3>Spotify</h3>
				<input type="email" class="form-control" name="susername" placeholder="Spotify Email" value="<?=$_SESSION['spotify']?>">
				<input type="password" class="form-control" name="spassword" placeholder="Spotify Password">
				<br>
				<div class="buttons">
					<a id="submit" class="btn btn-primary" href="javascript:submitForm()">Save</a>
					<input type="submit" style="display:none;"> <!--EDIT THIS LATER-->
				</div>
			</form>
		</main>

		<div class="music-bar colorize-dominant colorize-bg">
			<?php include "../api/includes/dev.php" ?>
			<img class="album-art" src=<?php echo '"' . $album_art . '"'; ?>/>
			<div class="song-metadata">
				<p class="song-title"><?php echo $title; ?></p>
				<p class="song-subtitle"><?php echo $subtitle; ?></p>
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
							<li><a href="index.php">Home</a></li>
							<li><a href="music.php">Music</a></li>
							<li><a href="#" class="selected">Settings</a></li>
							<li><a href="logout.php">Logout</a></li>
						</ul>
					</nav>

					<a href="#" onclick="toggleFullScreen()" class="fullscreen"><i class="fa fa-expand"></i></a>
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
		    var imageData = "<?php echo getImageData($album_art); ?>";
		</script>
		<script src="res/js/color-thief.min.js"></script>
		<script src="res/js/playercolorize.js"></script>
		<script src="res/js/fullscreen.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		<script>
			function submitForm() {
				document.getElementById("form").submit();
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