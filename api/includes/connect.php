<?php
if (!isset($ignoress)) {
	session_start();
}

$m = new mysqli("localhost", "DB_USER", "DB_PASSWORD", "ensemble");

if ($m->connect_errno) {
	echo "Database connection failed: " . $m->connect_error() . "<br>Blame the administrator of this website, Thomas Gaubert.";
}

//CONSTANTS
$SERVICENAMES = array("YouTube", "Google Play", "Spotify");
$QUEUEMODES = array("Normal", "Smart");
$STATUSNAMES = array("Pause", "Play");

?>