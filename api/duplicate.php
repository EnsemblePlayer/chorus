<?php
require "includes/connect.php";

$u = $_SESSION['id'];
$entryid = (isset($_GET['entryid'])) ? intval($_GET['entryid']) : 0;
//TOFIX: change to currently selected player $_SESSION['player']
$player = 1;
if ($player > 0) {
	$where = ($entryid > 0) ? "AND `entryId`='$entryid'" : "";
	$qs = $m->query("SELECT * FROM `queues` WHERE `PlayerId`='$player' AND `Position`>0 $where ORDER BY `Position` ASC LIMIT 1") or die($m->error);
	if ($qs->num_rows == 1) {
		$qf = $qs->fetch_array(MYSQLI_ASSOC);
		$entry = $qf['entryId'];
		$song = $qf['SongId'];
		$ss = $m->query("SELECT * FROM `songs` WHERE `songId`='$song'");
		$fs = $ss->fetch_array(MYSQLI_ASSOC);
		$sname = addslashes($fs['Title']);
		$sartist = addslashes($fs['Artist']);
		$salbum = addslashes($fs['Album']);
		$salbumart = addslashes($fs['AlbumArt']);
		$sartistart = addslashes($fs['ArtistArt']);
		$surl = addslashes($fs['Url']);
		$sapiid = addslashes($fs['ApiSongId']);
		//TOFIX: save the ID since it'll cache
		$m->query("INSERT INTO `songs` (`Url`,`ApiSongId`,`Title`,`Artist`,`Album`,`AlbumArt`,`ArtistArt`,`Service`) VALUES ('$surl','$sapiid','$sname','$sartist','$salbum','$salbumart','$sartistart',1)") or die($m->error);
		//get id of song just inserted
		$s = $m->query("SELECT * FROM `songs` WHERE `ApiSongId`='$sapiid' AND `Url`='$surl' ORDER BY `songId` DESC LIMIT 1") or die($m->error); 
		$f = $s->fetch_array(MYSQLI_ASSOC);
		$i = $f['songId'];
		//TOFIX: CHECK WHICH PLAYER IS ASSOCIATED
		$p = 1;
		//add to queue
		$smax = $m->query("SELECT MAX(`Position`) AS `MaxPosition` FROM `queues` WHERE `PlayerId`='$p'") or die($m->error);
		$fmax = $smax->fetch_array(MYSQLI_ASSOC);
		$pos = $fmax['MaxPosition']+1000;
		$m->query("INSERT INTO `queues` (`PlayerId`,`SongId`,`UserId`,`Position`) VALUES ('$p','$i','$u', '$pos')") or die($m->error);
	}
	if (isset($_SERVER['HTTP_REFERER'])) {
		header("Location: ".$_SERVER['HTTP_REFERER']);
	} else {
		header("Location: ../app/index.php");
	}
} else {
	header("Location: ../app/player.php?error=1");
}


$m->close();
?>