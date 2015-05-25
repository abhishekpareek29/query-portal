<?php
// Start the session
session_start();
//connected to db
include('db_tango.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Mentor_Page</title>
	<link rel="stylesheet" type="text/css" href="query.css" />
</head>
<body>

<?php

//---------------------logout link----------------------
echo "<br><a href=logout.php>LOG OUT</a><br>";



//----------------Validation of logged user----------------------------

	$email = $_SESSION["email_id"];
	// $psw = $_SESSION["password"];
	$user_id = $_SESSION["user_id"];
	$role_id = $_SESSION["role_id"];
	// echo 'user_id: '.$user_id;

	$sql = "Select user_id,role_id from user where u_email='$email'";
	$retval = mysql_query($sql, $link);
	if (! $retval) 
	{
		die(mysql_error());
	}
	while ($row = mysql_fetch_assoc($retval)) 
	{
		// $psw2 = $row['u_pass'];
		$role_id_db = $row['role_id'];
		$user_id_db = $row['user_id'];
	}



	if ($user_id==$user_id_db && $role_id==1) 
	{

		$sql = "Select query_id,query_title,query_desc,author from queries where mentor_id='$user_id_db'";
		$retval = mysql_query($sql, $link);
		if (! $retval) 
		{
			die('<br>query fetching error:  ' . mysql_error());
		}

// queries are printed below
		echo "<br><br>Please answer these Queries:<br>";
		while ($row = mysql_fetch_assoc($retval)) 
		{
			$query_id = $row['query_id'];
			echo "<br><a href=mentor_reply.php?id=$query_id> {$row['query_title']} </a>";
			echo "<br> {$row['query_desc']}";

			$mentee_id = $row['author'];
			$sql = "Select u_name from user where user_id=$mentee_id";
			$retval1 = mysql_query($sql, $link);
			while ($row = mysql_fetch_assoc($retval1)) 
			{
				$name = $row['u_name'];		
			}	
			echo "<br>Asked by: ". $name."<br>";
		}
	}
	else
	{
		echo "You are not authorised user of this account";
	}


	?>



</body>
</html>