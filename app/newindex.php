<!doctype html>
<html lang="en" class="no-js">
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

		<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<link rel="stylesheet" href="res/css/reset.css"> <!-- CSS reset -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="res/css/newplayer.css"> <!-- Resource style -->
		<link rel="stylesheet" href="res/css/newplayermodal.css">
		<link rel="stylesheet" href="res/css/table.css">
		<script src="res/js/modernizr.js"></script> <!-- Modernizr -->
	  	
		<title>Ensemble</title>
	</head>
	<?php 
		$data = file_get_contents("http://ensembleplayer.me/api/queue.php");
		$array = json_decode($data, true);

		if(count($array) == 0) {
			$title = "Nothing is in the Queue";
			$subtitle = "Use Music tab to play a song.";
			$album_art = "res/img/icon.png";
			$artist_art = "res/img/albums.jpg";
		} else {
			$title = $array[0]['title'];
			$artist = $array[0]['artist'];
			$album = $array[0]['album'];
			$service = $array[0]['service'];
			$user = $array[0]['user'];
			$album_art = $array[0]['album_art'];
			$artist_art = $array[0]['artist_art'];
			if ($service == "Google Play" && $artist_art != "") {
				$artist_art .= "=w1920-c-h1080-e100";
			}

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
			<?php if(count($array) == 0) { ?>
				<h3 style="text-align: center;">Nothing is in the Queue</h3>
			<?php } else { ?>
			<table class="table table-striped queue">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Artist</th>
						<th>Service</th>
						<th>User</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$id = 1;
						foreach ($array as $v) { $e = $v['id']; ?>
					<tr>
						<th><?php echo $id; ?></th>
						<td><?php echo $v['title']; ?></td>
						<td><?php echo $v['artist']; ?></td>
						<td><?php echo $v['service']; ?></td>
						<td><?php echo $v['user']; ?></td>
						<td>
							<a class="colorize-darkest colorize-text" style="color:black;" href="../api/move.php?entryid=<?=$e?>&dir=0"><i class="fa fa-chevron-up fa-2x"></i></a> &nbsp;
							<a class="colorize-darkest colorize-text" style="color:black;" href="../api/move.php?entryid=<?=$e?>&dir=1"><i class="fa fa-chevron-down fa-2x"></i></a> &nbsp;
							<a class="colorize-darkest colorize-text" style="color:black;" href="../api/<?=(($id==1) ? 'pause.php"><i class="fa fa-pause' : 'skipto.php?entryid='.$e.'"><i class="fa fa-play')?> fa-2x"></i></a> &nbsp;
							<a class="colorize-darkest colorize-text" style="color:black;" href="../api/duplicate.php?entryid=<?=$e?>"><i class="fa fa-repeat fa-2x"></i></a> &nbsp;
							<a class="colorize-darkest colorize-text" style="color:black;" href="../api/delete.php?entryid=<?=$e?>"><i class="fa fa-trash fa-2x"></i></a>
						</td>
						</tr>
						<?php $id++;
						} ?>
					</tbody>
				</table>
			<?php } ?>
		</main>

		<div class="music-bar colorize-dominant colorize-bg">
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
		<script type="text/javascript">
			$(window).load(function() {
		    	var imageData = "<?php echo getImageData($album_art); ?>";
		    });
		</script>
		<script src="res/js/color-thief.min.js"></script>
		<script src="res/js/playercolorize.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

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