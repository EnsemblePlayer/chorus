<?php
require "includes/connect.php";

if (isset($_POST['service']) && isset($_POST['song'])) {
	$u = $_SESSION['id'];
	$service = $m->real_escape_string($_POST['service']);
	$song = $m->real_escape_string($_POST['song']);
	if ($service == 0) {
		if (strpos($song,"?v=") !== FALSE) {
			$song = explode("?v=",$song);
			$song = explode("&",$song[1]);
			$sid = trim($song[0]);
		} else {
			$song = explode("&",$song);
			$sid = trim($song[0]);
		}
		//check if valid by checking thumbnail
		$ytart = "http://i.ytimg.com/vi/$sid/0.jpg"; 
		$ytsz = getimagesize($ytart);
		if ($ytsz[0] == 480 && $ytsz[1] == 360) {
			//get title
			$url = "http://gdata.youtube.com/feeds/api/videos/". $sid;
			$doc = new DOMDocument;
			$doc->load($url);
			$stitle = addslashes($doc->getElementsByTagName("title")->item(0)->nodeValue);
			$m->query("INSERT INTO `songs` (`ApiId`,`Title`,`Artist`,`Album`,`AlbumArt`,`ArtistArt`,`Service`) VALUES ('$sid','$stitle','YouTube','','','$ytart',0)") or die($m->error);
			//cont
		} else {
			header("Location: /app/music.php?error=1");
			exit;
		}
	} elseif ($service == 1) {
		$s = $m->query("SELECT * FROM `credentials` WHERE `UserId`='$u'") or die($m->error);
		$f = $s->fetch_array(MYSQLI_ASSOC);
		$un = $f['Username'];
		$pw = $f['Password'];
		$song = str_replace("'","",$song);
		exec("python includes/api.py 1 '$song' '$un' '$pw'",$out);
		if (count($out) > 0) {
			$sid = $out[0];
			$sname = addslashes($out[1]);
			$sartist = addslashes($out[2]);
			$salbum = addslashes($out[3]);
			$salbumart = addslashes($out[4]);
			$sartistart = addslashes($out[5]);
			$m->query("INSERT INTO `songs` (`ApiId`,`Title`,`Artist`,`Album`,`AlbumArt`,`ArtistArt`,`Service`) VALUES ('$sid','$sname','$sartist','$salbum','$salbumart','$sartistart',1)") or die($m->error);
			//cont
		} else {
			header("Location: /app/music.php?error=1");
		}
	} else {
		header("Location: /app/music.php?error=3");
	}

	//cont
	if ($sid != "") {
		//get id of song just inserted
		$s = $m->query("SELECT * FROM `songs` WHERE `ApiId`='$sid' ORDER BY `songId` DESC LIMIT 1") or die($m->error); 
		$f = $s->fetch_array(MYSQLI_ASSOC);
		$i = $f['songId'];
		//TOFIX: CHECK WHICH PLAYER IS ASSOCIATED
		$p = 1;
		//add to queue
		$smax = $m->query("SELECT MAX(`Position`) AS `MaxPosition` FROM `queues` WHERE `PlayerId`='$p'") or die($m->error);
		$fmax = $smax->fetch_array(MYSQLI_ASSOC);
		$pos = $fmax['MaxPosition']+1000;
		$m->query("INSERT INTO `queues` (`PlayerId`,`SongId`,`UserId`,`Position`) VALUES ('$p','$i','$u', '$pos')") or die($m->error);
		header("Location: /app/index.php");
	}
} else {
	header("Location: /app/music.php?error=2");
}

$m->close();
?>