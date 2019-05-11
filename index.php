<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="utf-8">
	<title>TODO App</title>
	<meta name="description" content="Don't Forget About Important Things">
	
	<meta http-equiv="X-Ua-Compatible" content="IE=edge,chrome=1">
	
	<link rel="stylesheet" href="main.css">
	
</head>

<body>
	<div id="container">
	
		<div class="kurs">
			
			<div class="test"></div>
			
			<h1>TODO App</h1>
			
			<p>Don't Forget About Important Things!</p>
			<form action="add.php" method="post">
				Title: <br /> <input type="text" name="title" /> <br/>
				Description: <br /> <input type="text" name="description" /> <br/>
				<input type="submit" value="Add" /><br>
			</form>
			<form action="clear.php" method="post"><input type="submit" value="Clear"></form>
			<form action="remove.php" method="post"><input type="submit" value="Remove"></form>
			<?php
			session_start();
			if(isset ($_SESSION['ok']))
			{
				if($_SESSION['ok'] == true)
				{
					$_SESSION['ok'] = false;
					echo "<br/> Everything added!<br/><br/>";
				}
			}
			?>
		</div><br/>
		<div class="kurs">	
			<?php 
			
				if(isset($_SESSION['clear']))
				{
					if($_SESSION['clear'] == true)
					{
						$_SESSION['clear'] = false;
						echo "Clear everything!";
					}else
					{
						if(isset ($_SESSION['alert']))
						{
							if($_SESSION['alert'] == true)
							{
								$_SESSION['alert'] = false;
								echo "<script> alert('Title must have between 10 and 255 characters!');</script>";
							}
						}
						if(isset ($_SESSION['description']))
						{
							if($_SESSION['description'] == true)
							{
								$_SESSION['description'] = false;
								echo "<script> alert('Description must have less then 255 characters!');</script>";
							}
						}	
						require_once "connect.php";

						$connect = @new mysqli($host, $db_user, $db_password, $db_name);
						
						if ($connect->connect_errno!=0)
						{
							echo "Error: ".$connect->connect_errno;
						}
						else
						{
							$sql = "SELECT * FROM todotab";
							if($rezultat = $connect->query($sql))
							{
								
								while ($row = $rezultat->fetch_assoc()) 
								{
									echo $row['title'].", ".$row['description']."</br>";
								}
								
							}
							$connect-> close();
						}
					}
				}else
				{		
					if(isset ($_SESSION['alert']))
					{
						if($_SESSION['alert'] == true)
						{
							$_SESSION['alert'] = false;
							echo "<script> alert('Title must have between 10 and 255 characters!');</script>";
						}
					}	
					require_once "connect.php";

					$connect = @new mysqli($host, $db_user, $db_password, $db_name);
					
					if ($connect->connect_errno!=0)
					{
						echo "Error: ".$connect->connect_errno;
					}
					else
					{
						$sql = "SELECT * FROM todotab";
						if($rezultat = $connect->query($sql))
						{
							while ($row = $rezultat->fetch_assoc()) 
							{
								echo $row['title'].", ".$row['description']."</br>";
							}
						}
						$connect-> close();
					}
				}
			?>
		</div>
</body>
</html>