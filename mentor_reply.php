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
	<link rel="stylesheet" type="text/css" href="query.css" />
</head>
<body>

<div class="top_layer">
    <p id="top_slogan">Query Portal</p>
</div>

<div class="logout2">
<?php
//---------------------logout link----------------------
echo "<br><a href=logout.php>LOG OUT</a><br>";
?>
</div>

<?php

//------------------Restoring session variables----------------------
	$email = $_SESSION["email_id"];
	// $psw = $_SESSION["password"];
	$user_id = $_SESSION["user_id"];
	$role_id = $_SESSION["role_id"];
	// echo '<br>mentor_id: '.$user_id;
	// echo '<br>mentor email:'.$email;

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
		
	//extracting query title below
	$sql = "Select query_title,query_desc from queries where query_id='$id'";
	$retval = mysql_query($sql, $link);
	while ($row = mysql_fetch_assoc($retval)) 
	{
		?>
		<div class="query_label"><?php
		echo "Query: {$row['query_title']}";
		echo "<br>Description: {$row['query_desc']}<br>";
		?></div>
		<?php		
	}


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
			?>
			<div class="comments">
			<?php
			echo "$name: {$row['reply_desc']}<br>";
			?>
			</div><br>
			<?php
		}
	}

	?>

	<div class="reply_form">
	<form action="mentor_reply.php" method="POST">
		<br>
		<textarea id="reply_box" placeholder="Reply Here Please" name="message" rows="10" cols="30"></textarea>
		<br><br>
		<input id="reply_submit_button" type="submit" value="REPLY" name="submit">
	</form>
	</div>

	<?php


}
?>

</body>
</html>