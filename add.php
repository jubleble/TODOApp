<?php 
	session_start(); 
	
	$title = $_POST['title'];
	$description = $_POST['description'];
	
	if ((strlen($title)<10) || (strlen($title)>255))
	{
		$_SESSION['alert'] = true;
		header('location: index.php');
	}else
	{
		if(strlen($description)>255)
		{
			$_SESSION['description'] = true;
			header('location: index.php');
		}
		require_once "connect.php";
		$connect = @new mysqli($host, $db_user, $db_password, $db_name);
		if ($connect->connect_errno!=0)
		{
			echo "Error: ".$connect->connect_errno;
		}else
		{
			if($connect->query("INSERT INTO todotab VALUES (null,'$title','$description')"))
			{
				$_SESSION['ok'] = true;
				header('location: index.php');
			}
		}
	}
	$connect-> close();
?>