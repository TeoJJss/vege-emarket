<?php
	session_destroy();
	header("Location: ".$_SERVER['DOCUMENT_ROOT']."/index.php");
?>