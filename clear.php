<?php 
	session_start(); 
	$_SESSION['clear'] = true;	
	header('location: index.php');
?>