<?php
require "includes/connect.php";

//TOFIX: change to currently selected player $_SESSION['player']
$player = 1; 
if ($player > 0) {
	$qs = $m->query("SELECT * FROM `queueData` WHERE `PlayerId`='$player' AND `Position`>0 ORDER BY `Position` ASC") or die($m->error);
	if ($qs->num_rows > 0) {
		while ($qf = $qs->fetch_array(MYSQLI_ASSOC)) {
			$entryid = $qf['entryId'];
			$song = $qf['SongId'];
			$uid = $qf['UserId'];
			$us = $m->query("SELECT * FROM `users` WHERE `userId`='$uid'") or die($m->error);
			$uf = $us->fetch_array(MYSQLI_ASSOC);
			$user = $uf['Name'];
			$s = $m->query("SELECT * FROM `songs` WHERE `songId`='$song'") or die($m->error);
			$f = $s->fetch_array(MYSQLI_ASSOC);
			$objects[] = (object)array("id"=>$entryid,
										"title"=>$f['Title'],
										"artist"=>$f['Artist'],
										"album"=>$f['Album'],
										"service"=>$SERVICENAMES[$f['Service']],
										"album_art"=>$f['AlbumArt'],
										"artist_art"=>$f['ArtistArt'],
										"user"=>$user);
		}
		echo json_encode($objects);
	} else {
		echo"[]";
	}
} else {
	header("Location: ../app/player.php?error=1");
}


$m->close();
?>