<?php
require "includes/connect.php";

function exitNull() {
	header('Content-Type: application/json');
	$json = array();
	$json['entryId'] = -1;
	$json['service'] = -1;
	$json['url'] = -1;
	$json['status'] = -1;
	$json['songName'] = -1;
	$json['artist'] = -1;
	echo json_encode($json, JSON_FORCE_OBJECT);
	exit;
}

if (isset($_GET['id']) && $_GET['id'] > 0) {
	$player = $m->real_escape_string($_GET['id']);
	$next = (isset($_GET['next'])) ? $m->real_escape_string($_GET['next']) : 0;

	$s = $m->query("SELECT * FROM `players` WHERE `playerID`='$player'") or die($m->error);
	if ($s->num_rows == 1) {
		if ($next == 1) {
			$qs = $m->query("SELECT * FROM `queues` WHERE `PlayerId`='$player' AND `Position`>0 ORDER BY `Position` ASC") or die($m->error);
			if ($qs->num_rows == 0) {
				exitNull();
			} else {
				//TOFIX: CHANGE TO UPDATE NEGATIVE LATER ON
				$qf = $qs->fetch_array(MYSQLI_ASSOC);
				$lsid = $qf['SongId']; //last song id
				$m->query("DELETE FROM `songs` WHERE `songId`='$lsid'") or die($m->error);
				$m->query("DELETE FROM `queues` WHERE `PlayerId`='$player' AND `Position`>0 ORDER BY `Position` ASC LIMIT 1") or die($m->error);
				//only was 1 left!
				if ($qs->num_rows == 1) {
					exitNull();
				}
			}
		}
		//get current status/song
		$qs = $m->query("SELECT * FROM `queues` WHERE `PlayerId`='$player' AND `Position`>0 ORDER BY `Position` ASC LIMIT 1") or die($m->error);
		if ($qs->num_rows == 0) {
			exitNull();
		}
		$qf = $qs->fetch_array(MYSQLI_ASSOC); //pull data from queue table
		$song = $qf['SongId'];
		$u = $qf['UserId'];
		$entryid = $qf['entryId'];
		$f = $s->fetch_array(MYSQLI_ASSOC);
		$status = $f['Status'];
		$ss = $m->query("SELECT * FROM `songs` WHERE `songID`='$song'") or die($m->error); //pull data from song table
		$sf = $ss->fetch_array(MYSQLI_ASSOC);
		$service = $sf['Service'];
		$url = $sf['Url'];
		$apiid = $sf['ApiSongId'];
		$sname = $sf['Title'];
		$sartist = $sf['Artist'];
		$cs = $m->query("SELECT * FROM `credentials` WHERE `UserId`='$u' AND `Service`='$service'") or die($m->error); //pull login information based on userid from queue
		$cf = $cs->fetch_array(MYSQLI_ASSOC);
		$un = $cf['Username'];
		$pw = $cf['Password'];
		$di = $cf['DeviceId'];

		//url check for APIs
		if ($service == 1 && $url == "") {
			exec("python includes/url.py 1 '$apiid' '$un' '$pw' '$di'",$out);
			if (count($out) > 0) {
				$url = addslashes($out[0]);
				$m->query("UPDATE `songs` SET `Url`='$url' WHERE `songId`='$song'") or die($m->error);
			} else {
				echo"ERROR: Could not generate stream URL.";
			}
		}

		echo $url."\n";

		//json output
		$json = array();
		$json['entryId'] = intval($entryid);
		$json['service'] = intval($service);
		$json['url'] = stripslashes($url);
		$json['songName'] = $sname;
		$json['artist'] = $sartist;
		$json['status'] = intval($status);
		header('Content-Type: application/json');
		echo json_encode($json, JSON_FORCE_OBJECT);
	} else {
		echo"ERROR: Invalid player.";
	}
} else {
	echo"ERROR: Missing player ID in request.";
}
$m->close();
?>