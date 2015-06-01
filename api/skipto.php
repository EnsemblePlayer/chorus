<?php
require "includes/connect.php";

$entryid = (isset($_GET['entryid'])) ? intval($_GET['entryid']) : 0;
//TOFIX: change to currently selected player $_SESSION['player']
$player = 1;
if ($player > 0) {
	if ($entryid > 0) {
		$qs = $m->query("SELECT * FROM `queueData` WHERE `PlayerId`='$player' AND `Position`>0 ORDER BY `Position` ASC") or die($m->error);
		if ($qs->num_rows > 0) {
			while ($qf = $qs->fetch_array(MYSQLI_ASSOC)) {
				$entry = $qf['entryId'];
				$song = $qf['SongId'];
				if ($entry == $entryid) {
					break;
				}
				$m->query("DELETE FROM `songs` WHERE `songId`='$song'");
				$m->query("DELETE FROM `queueData` WHERE `entryId`='$entry'");
			}
		}
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