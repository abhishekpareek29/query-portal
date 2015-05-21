<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>signup page</title>
</head>
<body>

	<?php
	$link = mysql_connect('localhost:/var/run/mysqld/mysqld.sock', 'root', 'Astro@boy29');
	if (!$link) 
	{
		die('Could not connect: ' . mysql_error());
	}
	echo 'Connected successfully';

	$db_selected = mysql_select_db('tango', $link);
	if (!$db_selected) 
	{
		die ('Can\'t use tango : ' . mysql_error());
	}

	if (isset($_POST['submitl'])) 
	{
		$email = $_POST["email"];
		$psw = $_POST["psw"];
		$user_type = $_POST["user_type"];
		echo " <br> $email<br>";
		$sql = "select role_id from user where u_email='$email'";
		$sqlp = "select u_pass from user where u_email='$email'";

		$retval = mysql_query($sql, $link);
		$pass = mysql_query($sqlp, $link);
		$flag = mysql_num_rows($retval);

		while($row = mysql_fetch_assoc($retval))
		{
			echo "<br> role :{$row['role_id']} <br>";
			$role = $row['role_id'];
		} 

//echo $retval;
//echo '///////'.$flag;
//echo $pass; 

		while($row = mysql_fetch_assoc($pass))
		{
			echo "<br> password :{$row['u_pass']} <br>";
			$password = $row['u_pass'];
		} 

		if($flag == 0)
		{
			echo " YOUR ENTERED EMAIL DOES NOT EXIST";
		}
		else if ($psw==$password && $role==2 && $user_type=="mentee")
		{
			$_SESSION["email_id"] = $email;
			$_SESSION["password"] = $psw;
			$_SESSION["user_type"] = $user_type;
			header("Location: http://mysite1.local/mentee_query.php");
		}
		else if ($psw==$password && $role==1 && $user_type=="mentor") 
		{
			$_SESSION["email_id"] = $email;
			$_SESSION["password"] = $psw;
			$_SESSION["user_type"] = $user_type;
			header("Location: http://mysite1.local/mentor_page.htm");
		}
		else if ($psw != $password && $user_type=="mentee")
		{
			echo "Wrong password ENTERED by mentee";
		}
		else if ($psw != $password && $user_type=="mentor")
		{
			echo "Wrong password ENTERED by mentor";
		}
		else
		{
			echo "You are not authorised for this";
		}
	}




	?>

</body>
</html>