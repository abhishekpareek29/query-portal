<?php
session_start();
include('db_tango.php');
?>


<!DOCTYPE html>
<html>
<head>
	<title>Replies</title>
</head>
<body>
	<form action="replies.php" method="POST">
		<br>
		Reply Here:
		<textarea name="message" rows="10" cols="30"></textarea>
		<br><br>
		<input type="submit" value="submit" name="submit">
	</form>

	<?php


//---------------------logout link----------------------
echo "<br><a href=logout.php>LOG OUT</a><br>"; 
	

//------upon click or re-reply over query-----------------------
	if (isset($_POST['submit'])) 
	{
		$reply = $_POST["message"];
		echo $reply;
		$id = $_SESSION["id"];
		// echo 'id no:'.$id;
		// $_SESSION["id2"] = $id;
		$user_id = $_SESSION["user_id"];
		$sql = "INSERT INTO replies (query_id,reply_desc,author) values('$id','$reply','$user_id')";
		$retval = mysql_query($sql, $link);
		if(! $retval)
		{
			// echo $id;			
			die(mysql_error());
		}

		header("Location: replies.php?id=$id");
	}



// getting id from previous page
	$id = $_GET['id'];    
	// echo $id;
	$_SESSION["id"] = $id;
	// $id2 = $_SESSION["id"];
	// echo $id2;


//-------------------------------------------------------------------------
//restoring previous session variables
	$e = $_SESSION["email_id"];
	$role_id = $_SESSION["role_id"];
    $user_id = $_SESSION["user_id"];
    // echo $user_id;
	// $u = $_SESSION["user_type"];
	// echo $e;

//extracting user id and role id
	$sql5 = "Select user_id,role_id from user where u_email='$e'";
	$retval = mysql_query($sql5, $link);
	while($row = mysql_fetch_assoc($retval))
	{
		// echo "<br> user id :{$row['user_id']} <br>";
		$user_id_db = $row['user_id'];
		$role_id_db = $row['role_id'];
	}

	// $user_id = $_SESSION["author"];
	if ($user_id == $user_id_db && $role_id==$role_id_db) 
	{

	


	// // extracting & matching email id------------------
	// $sql0 = "Select u_email from user where u_email='$e'";
	// $retval = mysql_query($sql0, $link);
	// $flag1 = mysql_num_rows($retval);
	// if($flag1 == 0)
	// {
	// 	echo "<br>You are not logged IN<br>";
	// 	mysql_close($link);
	// }

	// // matching password below-------------------------
	// $p = $_SESSION["password"];
	// $sql2 = "Select u_pass from user where u_email='$e'";
	// $retval = mysql_query($sql2, $link);
	// $flag2 = mysql_num_rows($retval);
	// if($flag2 == 0)
	// {
	// 	echo "<br>Entered wrong password<br>";
	// 	mysql_close($link);
	// }
//-------logged confirmed----------------
//-------------------------------------------------------------------------------



//extracting query title below
	$sql = "Select query_title,query_desc from queries where query_id='$id'";
	$retval = mysql_query($sql, $link);
	while ($row = mysql_fetch_assoc($retval)) 
	{
		echo "<br>Query: {$row['query_title']}";
		echo "<br>Description: {$row['query_desc']}<br>";
	}




//extracting replies of aforesaid query

	// $id = $_SESSION["id2"];
	// $_SESSION["id"] = $_SESSION["id2"];

	$sql = "Select reply_desc,author from replies where query_id='$id'";
	$retval = mysql_query($sql, $link);
	while ($row = mysql_fetch_assoc($retval)) 
	{	
		$author = $row['author'];
		$sql2 = "Select u_name from user where user_id='$author'";
		$retval2 = mysql_query($sql2, $link);
		while ($row2 = mysql_fetch_assoc($retval2)) 
		{
			$name = $row2['u_name'];
			echo "<br>$name: {$row['reply_desc']}<br>";
		}

	}

}

else {
	echo "You Are Not Logged In";
	mysql_close($link);
}

?>


</body>
</html>