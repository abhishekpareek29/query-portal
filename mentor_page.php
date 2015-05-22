<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Mentor_Page</title>
</head>
<body>
	<?php


//----------Establishing Link and DATABASE connection----------

	$link = mysql_connect('localhost:/var/run/mysqld/mysqld.sock', 'root', 'Astro@boy29');
	if (!$link) 
	{
		echo 'connection_aborted';
		die('Could not connect: ' . mysql_error());
	}
//echo 'Connected successfully';

	$db_selected = mysql_select_db('tango', $link);
	if (!$db_selected) 
	{
		die ('Can\'t use tango : ' . mysql_error());
	}

//----------------Link & Connection finish -------------------

//----------------Validation of logged user----------------------------

	$email = $_SESSION["email_id"];
	$psw = $_SESSION["password"];
	$user_type = $_SESSION["user_type"];
	$user_id = $_SESSION["mentor_id"];

	$sql = "Select user_id,u_pass,role_id from user where u_email='$email'";
	$retval = mysql_query($sql, $link);
	if (! $retval) 
	{
		die(mysql_error());
	}
	while ($row = mysql_fetch_assoc($retval)) 
	{
		$psw2 = $row['u_pass'];
		$role_id = $row['role_id'];
		$user_id2 = $row['user_id'];
	}



	if ($psw2==$psw && $user_type==$user_id2 && $role_id==1) 
	{

		$sql = "Select query_id,query_title,query_desc from queries where author='$user_id2'";
		$retval = mysql_query($sql, $link);
		if (! retval) 
		{
			die('<br>query fetch error:  ' . mysql_error());
		}
		while ($row = mysql_fetch_assoc($retval)) 
		{
			$query_title = $row['query_title'];
			$query_desc = $row['query_desc'];
			$query_id = $row['query_id'];

			echo "<br><a href=replies.php?id=$query_id> {$row['query_title']} </a>";
			echo "<br> {$row['query_desc']}";
			$ = $row['author'];
			echo "<br>By: {$name}<br>";	
		}

	}
	else
	{
		echo "You are not authorised user of this account";
	}


	?>



</body>
</html>