<?php
require "includes/connect.php";

if (isset($_POST['username']) && isset($_POST['password'])) {
	$un = $m->real_escape_string($_POST['username']);
	$pw = $m->real_escape_string($_POST['password']);

	$s = $m->query("SELECT * FROM `users` WHERE `Name`='$un'");
	if ($s->num_rows == 1) {
		$f = $s->fetch_array(MYSQLI_ASSOC);
		if (password_verify($pw,$f['Password'])) {
			$_SESSION['id'] = $f['userId'];
			$id = $f['userId'];
			$_SESSION['name'] = $f['Name'];
			$s = $m->query("SELECT * FROM `credentials` WHERE `userId`='$id'") or die($m->error());
			if ($s->num_rows > 0) {
				while($f = $s->fetch_array(MYSQLI_ASSOC)) {
					if ($f['Service'] == 1) {
						$_SESSION['googleplay'] = $f['Username'];
					} else {
						$_SESSION['googleplay'] = "";
					}
					if ($f['Service'] == 2) {
						$_SESSION['spotify'] = $f['Username'];
					} else {
						$_SESSION['spotify'] = "";
					}
				}
			} else {
				$_SESSION['googleplay'] = "";
				$_SESSION['spotify'] = "";
			}

			header("Location: ../app/index.php");
		} else {
			header("Location: ../app/login.php?error=1");
		}
	} else {
		header("Location: ../app/login.php?error=1");
	}
} else {
	header("Location: ../app/login.php?error=3");
}

$m->close();
?>
