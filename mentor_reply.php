<?php
// Start the session
session_start();
//connected to db
include('db_tango.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Mentor_reply_Page</title>
</head>
<body>


<?php

//---------------------logout link----------------------
echo "<br><a href=logout.php>LOG OUT</a><br>"; 

//------------------Restoring session variables----------------------
	$email = $_SESSION["email_id"];
	$psw = $_SESSION["password"];
	$user_id = $_SESSION["mentor_id"];
	echo '<br>mentor_id: '.$user_id;
	echo '<br>mentor email:'.$email;

if (isset($_POST['submit'])) 
	{
		$id = $_SESSION['id_mentor'];
		$reply = $_POST['message'];
		$sql = "INSERT INTO replies (query_id,reply_desc,author) values('$id','$reply','$user_id')";
		$retval = mysql_query($sql, $link);
		if (! $retval) 
		{
			die('could not insert:'.mysql_error());
		}
		header("Location: http://mysite1.local/mentor_reply.php?id=$id");
	}


$id = $_GET['id'];
$_SESSION["id_mentor"] = $id;
//----------------------Validation of logged user------------------


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


	if ($psw2==$psw && $user_id==$user_id2 && $role_id==1) 
	{
		
?>

	<form action="mentor_reply.php" method="POST">
		<br>
		Reply Here:
		<textarea name="message" rows="10" cols="30"></textarea>
		<br><br>
		<input type="submit" value="submit" name="submit">
	</form>


	<?php

	$sql = "Select reply_desc,author from replies where query_id='$id'";
	$retval = mysql_query($sql, $link);
	while ($row = mysql_fetch_assoc($retval)) 
	{
		$author = $row['author'];
		$sql = "Select u_name from user where user_id='$author'";
		$retval2 = mysql_query($sql, $link);
		if (! $retval) 
		{
			die('Could not fetch '.mysql_error());
		}
		while ($row2 = mysql_fetch_assoc($retval2)) 
		{
			$name = $row2['u_name'];
			echo "<br>$name: {$row['reply_desc']}<br>";
		}
	}


}
?>

</body>
</html>