<?php
require "includes/connect.php";

$entryid = (isset($_GET['entryid'])) ? intval($_GET['entryid']) : 0;
$direction = (isset($_GET['dir'])) ? intval($_GET['dir']) : 0;
//TOFIX: change to currently selected player $_SESSION['player']
$player = 1;
if ($player > 0) {
	$qs = $m->query("SELECT * FROM `queues` WHERE `PlayerId`='$player'") or die($m->error);
	if ($qs->num_rows > 0) {
		while ($qf = $qs->fetch_array(MYSQLI_ASSOC)) {
			$cur[$qf['entryId']] = $qf['Position'];
		}
		asort($cur);
		$indexed = array_values($cur);
		print_r($indexed);

		if (array_key_exists($entryid,$cur)) {
			$total = count($cur);
			$ct = 0;
			foreach ($cur as $e=>$p) {
				if ($entryid == $e) {
					$pos = $p;
					if ($ct == 1 && $direction == 0) {
						$pos = round($indexed[0]/2);
					} elseif ($ct > 1 && $direction == 0) {
						$pos = round(($indexed[$ct-1]+$indexed[$ct-2])/2);
					} elseif ($ct == ($total-2) && $direction == 1) {
						$pos = $indexed[$total-1]+1000;
					} elseif ($ct < ($total-2) && $direction == 1) {
						$pos = round(($indexed[$ct+2]+$indexed[$ct+1])/2);
					}
					echo "~".$ct."~".($total-2)."~".$direction."~";
					$pos = max($pos,1);
				}
				$ct++;
			}
			$m->query("UPDATE `queues` SET `Position`='$pos' WHERE `entryId`='$entryid'") or die($m->error);

			if (isset($_SERVER['HTTP_REFERER'])) {
				header("Location: ".$_SERVER['HTTP_REFERER']);
			} else {
				echo"Moved song.";
			}
		} else {
			if (isset($_SERVER['HTTP_REFERER'])) {
				header("Location: ".$_SERVER['HTTP_REFERER']);
			} else {
				echo"Invalid entry ID.";
			}
		}
	} else {
		if (isset($_SERVER['HTTP_REFERER'])) {
			header("Location: ".$_SERVER['HTTP_REFERER']);
		} else {
			echo"Entry ID missing.";
		}
	}
} else {
	header("Location: ../app/player.php?error=1");
}


$m->close();
?>