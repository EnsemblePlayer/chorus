<?php
require "includes/connect.php";

if ((isset($_POST['gpusername']) && isset($_POST['gppassword'])) || (isset($_POST['susername']) && isset($_POST['spassword']))) {
	$gpun = $m->real_escape_string($_POST['gpusername']);
	$gppw = $m->real_escape_string($_POST['gppassword']);
	$sun = $m->real_escape_string($_POST['susername']);
	$spw = $m->real_escape_string($_POST['spassword']);
	$u = $_SESSION['id'];

	if ($u > 0 && ((strlen($sun) > 0 && strlen($spw) > 0) || (strlen($gpun) > 0 && strlen($gppw) > 0))) {
		if (strlen($sun) > 0 && strlen($spw) > 0) {
			$s = $m->query("SELECT * FROM `credentials` WHERE `UserId`='$u' AND `Service`=2") or die($m->error);
			if ($s->num_rows > 0) {
				$m->query("UPDATE `credentials` SET `Username`='$sun', `Password`='$spw' WHERE `UserId`='$u' AND `Service`=2") or die($m->error);
			} else {
				$m->query("INSERT INTO `credentials` (`UserId`,`Service`,`Username`,`Password`) VALUES ('$u',2,'$sun','$spw')") or die($m->error);
			}
			$_SESSION['spotify'] = $sun;
		}
		if (strlen($gpun) > 0 && strlen($gppw) > 0) {
			$s = $m->query("SELECT * FROM `credentials` WHERE `UserId`='$u' AND `Service`=1") or die($m->error);
			if ($s->num_rows > 0) {
				$m->query("UPDATE `credentials` SET `Username`='$gpun', `Password`='$gppw' WHERE `UserId`='$u' AND `Service`=1") or die($m->error);
			} else {
				$m->query("INSERT INTO `credentials` (`UserId`,`Service`,`Username`,`Password`) VALUES ('$u',1,'$gpun','$gppw')") or die($m->error);
			}
			$_SESSION['googleplay'] = $gpun;
		}
		header("Location: ../app/settings.php?success=1");
	} else {
		header("Location: ../app/settings.php?error=2");
	}
} else {
	header("Location: ../app/settings.php?error=1");
}

$m->close();
?>