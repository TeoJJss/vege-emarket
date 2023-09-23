<?php
	session_start();
	session_destroy();
	setcookie("email","");
	setcookie("password","");
	header("Location: ../index.php");
?>