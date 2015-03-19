<?php

session_start();
if ($_SESSION['id'] == 0) {
	header("Location: ../app/login.php?error=1");
	exit;
}

?>