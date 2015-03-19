<?php
require "includes/connect.php";

$pause = (isset($_GET['set'])) ? "'".$_GET['set']."'" : "MOD(Status+1,2)";

//TOFIX: change to currently selected player $_SESSION['player']
$player = 1;
if ($player > 0) {
	$qs = $m->query("SELECT * FROM `players` WHERE `playerId`='$player'") or die($m->error);
	if ($qs->num_rows > 0) {
		$m->query("UPDATE `players` SET `Status`=$pause WHERE `playerId`='$player'");
		if (isset($_SERVER['HTTP_REFERER'])) {
			header("Location: ".$_SERVER['HTTP_REFERER']);
		} else {
			echo"Toggled pause.";
		}
	} else {
		header("Location: ../app/player.php?error=1");
	}
} else {
	header("Location: ../app/player.php?error=1");
}


$m->close();
?>