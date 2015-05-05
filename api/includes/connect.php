<?php
if (!isset($ignoress)) {
	session_start();
}

$m = new mysqli("localhost", "root", "root", "ensemble");

if ($m->connect_errno) {
	header('Location: ../../error.php?error=1');
}

//CONSTANTS
$SERVICENAMES = array("YouTube", "Google Play", "Spotify");
$QUEUEMODES = array("Normal", "Smart");
$STATUSNAMES = array("Pause", "Play");

?>