<?php
session_start();
include('db_tango.php');
?>


<!DOCTYPE html>
<html>
<head>
	<title>Replies</title>
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
//------upon click or re-reply over query-----------------------
	if (isset($_POST['submit'])) 
	{
		$reply = $_POST["message"];
		echo $reply;
		$id = $_SESSION["id"];
		$user_id = $_SESSION["user_id"];
		$sql = "INSERT INTO replies (query_id,reply_desc,author) values('$id','$reply','$user_id')";
		$retval = mysql_query($sql, $link);
		if(! $retval)
		{	
			die(mysql_error());
		}

		header("Location: replies.php?id=$id");
	}



// getting id from previous page
	$id = $_GET['id'];    
	$_SESSION["id"] = $id;


//-------------------------------------------------------------------------
//restoring previous session variables
	$e = $_SESSION["email_id"];
	$role_id = $_SESSION["role_id"];
    $user_id = $_SESSION["user_id"];

//extracting user id and role id
	$sql5 = "Select user_id,role_id from user where u_email='$e'";
	$retval = mysql_query($sql5, $link);
	while($row = mysql_fetch_assoc($retval))
	{
		$user_id_db = $row['user_id'];
		$role_id_db = $row['role_id'];
	}


	if ($user_id == $user_id_db && $role_id==$role_id_db) 
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

//extracting replies of aforesaid query
	$sql = "Select reply_desc,author from replies where query_id='$id'";
	$retval = mysql_query($sql, $link);
	while ($row = mysql_fetch_assoc($retval)) 
	{	
		$author = $row['author'];
		$sql2 = "Select u_name from user where user_id='$author'";
		$retval2 = mysql_query($sql2, $link);
		while ($row2 = mysql_fetch_assoc($retval2)) 
		{
			?>
			<div class="comments"><?php
			$name = $row2['u_name'];
			echo "$name: {$row['reply_desc']}<br>";
			?></div><br><?php
		}

	}
	?>
	<div class="reply_form">
	<form action="replies.php" method="POST">
		<br>
		<textarea id="reply_box" placeholder="Reply Here Please" name="message" rows="10" cols="30"></textarea>
		<br>
		<input id="reply_submit_button" type="submit" value="REPLY" name="submit">
	</form>
</div>
	<?php

}

else {
	echo "You Are Not Logged In";
	mysql_close($link);
}

?>

</body>
</html>