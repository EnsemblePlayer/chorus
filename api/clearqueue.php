<?php
require "includes/connect.php";

//TOFIX: change to currently selected player $_SESSION['player']
$player = 1;
if ($player > 0) {
	$qs = $m->query("SELECT * FROM `queueData` WHERE `PlayerId`='$player' AND `Position`>0 ORDER BY `Position` ASC") or die($m->error);
	if ($qs->num_rows > 0) {
		while ($qf = $qs->fetch_array(MYSQLI_ASSOC)) {
			$song = $qf['SongId'];
			$m->query("DELETE FROM `songs` WHERE `songId`='$song'");
		}
		$m->query("DELETE FROM `queueData` WHERE `PlayerId`='$player'");
	}
	if (isset($_SERVER['HTTP_REFERER'])) {
		header("Location: ".$_SERVER['HTTP_REFERER']);
	} else {
		echo"Cleared queue & related songs.";
	}
} else {
	header("Location: ../app/player.php?error=1");
}

$m->close();
?>