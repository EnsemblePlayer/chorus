<?php
require "includes/connect.php";

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
		$m->query("DELETE FROM `songs` WHERE `songId`='$song'");
		$m->query("DELETE FROM `queues` WHERE `entryId`='$entry'");
	}
	if (isset($_SERVER['HTTP_REFERER'])) {
		header("Location: ".$_SERVER['HTTP_REFERER']);
	} else {
		echo"Deleted song from queue.";
	}
} else {
	header("Location: ../app/player.php?error=1");
}


$m->close();
?>