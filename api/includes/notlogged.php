<?php
	session_start();
	if ($_SESSION['id'] > 0) {
		header("Location: ../app/index.php");
		exit;
	}
?>