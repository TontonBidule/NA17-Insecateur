<?php 
	session_start();
	pg_close($vConn);
	// Suppression des variables de session et de la session
	$_SESSION = array();
	session_destroy();
	header('Location: index.html');
?>
