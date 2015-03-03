<?php
require "includes/connect.php";

if (isset($_GET['id']) && $_GET['id'] > 0) {
	$player = $m->real_escape_string($_GET['id']);
	$next = (isset($_GET['next'])) ? $m->real_escape_string($_GET['next']) : 0;

	$s = $m->query("SELECT * FROM `players` WHERE `playerID`='$player'") or die($m->error);
	if ($s->num_rows == 1) {
		if ($next == 1) {
			$qs = $m->query("SELECT * FROM `queues` WHERE `PlayerId`='$player' AND `Position`>0 ORDER BY `Position` ASC") or die($m->error);
			if ($qs->num_rows == 0) {
				exit("-1~~-1~~~~~~~~-1");
			} else {
				//TOFIX: CHANGE TO UPDATE NEGATIVE LATER ON
				$qf = $qs->fetch_array(MYSQLI_ASSOC);
				$lsid = $qf['SongId']; //last song id
				$m->query("DELETE FROM `songs` WHERE `songId`='$lsid'") or die($m->error);
				$m->query("DELETE FROM `queues` WHERE `PlayerId`='$player' AND `Position`>0 ORDER BY `Position` ASC LIMIT 1") or die($m->error);
				//only was 1 left!
				if ($qs->num_rows == 1) {
					exit("-1~~-1~~~~~~~~-1");
				}
			}
		}
		//get current status/song
		$qs = $m->query("SELECT * FROM `queues` WHERE `PlayerId`='$player' AND `Position`>0 ORDER BY `Position` ASC LIMIT 1") or die($m->error);
		if ($qs->num_rows == 0) {
			exit("-1~~-1~~~~~~~~-1");
		}
		$qf = $qs->fetch_array(MYSQLI_ASSOC); //pull data from queue table
		$song = $qf['SongId'];
		$u = $qf['UserId'];
		$entryid = $qf['entryId'];
		$ss = $m->query("SELECT * FROM `songs` WHERE `songID`='$song'") or die($m->error); //pull data from song table
		$sf = $ss->fetch_array(MYSQLI_ASSOC);
		$service = $sf['Service'];
		$apiid = $sf['ApiId'];
		$f = $s->fetch_array(MYSQLI_ASSOC);
		$status = $f['Status'];
		$cs = $m->query("SELECT * FROM `credentials` WHERE `UserId`='$u' AND `Service`='$service'") or die($m->error); //pull login information based on userid from queue
		$cf = $cs->fetch_array(MYSQLI_ASSOC);
		$un = $cf['Username'];
		$pw = $cf['Password'];
		echo"$entryid~~$service~~$un~~$pw~~$apiid~~$status";
	} else {
		echo"ERROR: Invalid player.";
	}
} else {
	echo"ERROR: Missing player ID in request.";
}
$m->close();
?>