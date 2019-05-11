<?php 
	session_start(); 
	
	require_once "connect.php";
	$connect = @new mysqli($host, $db_user, $db_password, $db_name);
	if ($connect->connect_errno!=0)
	{
		echo "Error: ".$connect->connect_errno;
	}else
	{
		if($connect->query("DELETE FROM todotab"))
		{
			header('location: index.php');
		}
	}
	$connect-> close();
?>