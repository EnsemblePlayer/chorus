<?php
require "includes/connect.php";

if (isset($_POST['username']) && isset($_POST['password'])) {
	$un = $m->real_escape_string($_POST['username']);
	$pw = $m->real_escape_string($_POST['password']);
	$gpun = $m->real_escape_string($_POST['gpusername']);
	$gppw = $m->real_escape_string($_POST['gppassword']);
	$sun = $m->real_escape_string($_POST['susername']);
	$spw = $m->real_escape_string($_POST['spassword']);

	//strip
	$un_old = $un;
	$un = preg_replace("/[^A-Za-z0-9]/","",$un);

	if (strlen($pw) > 4 && strlen($pw) <= 30) {
		$s = $m->query("SELECT `Name` FROM `users` WHERE `Name`='$un'") or die($m->error);
		if (strlen($un) > 2 && strlen($un) <= 30 && $un_old == $un && $s->num_rows == 0) {
			$pw = password_hash($pw, PASSWORD_BCRYPT);
			if ($m->query("INSERT INTO `users` (`Name`,`Password`) VALUES ('$un','$pw')")) {
				$s = $m->query("SELECT `Name` FROM `users` WHERE `Name`='$un'") or die($m->error);
				$f = $s->fetch_array(MYSQLI_ASSOC);
				$id = $f['userId'];
				if ($id > 0) {
					if (strlen($sun) > 0 && strlen($spw) > 0) {
						$m->query("INSERT INTO `credentials` (`UserId`,`Service`,`Username`,`Password`) VALUES ('$id',2,'$sun','$spw')") or die($m->error);
					}
					if (strlen($gppun) > 0 && strlen($gppw) > 0) {
						$m->query("INSERT INTO `credentials` (`UserId`,`Service`,`Username`,`Password`) VALUES ('$id',1,'$gpun','$gppw')") or die($m->error);
					}
				}
				header("Location: /app/login.php?success=1");
			} else {
				header("Location: /app/register.php?error=4");
			}
		} else {
			header("Location: /app/register.php?error=1");
		}
	} else {
		header("Location: /app/register.php?error=2");
	}
} else {
	header("Location: /app/register.php?error=3");
}

$m->close();
?>