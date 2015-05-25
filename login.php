<?php
session_start();
include("db_tango.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>signup page</title>
</head>
<body>

	<?php
	

	if (isset($_POST['submitl'])) 
	{
		$email = $_POST["email"];
		$psw = $_POST["psw"];
		$user_type = $_POST["user_type"];
		
		$sql = "select role_id,u_pass,user_id from user where u_email='$email'";
		$retval = mysql_query($sql, $link);		
		$flag = mysql_num_rows($retval);

		while($row = mysql_fetch_assoc($retval))
		{
			// echo "<br> role :{$row['role_id']} <br>";
			$role_id = $row['role_id'];
			$password = $row['u_pass'];
			$user_id = $row['user_id'];
		} 





		if($flag == 0)
		{
			echo " YOUR ENTERED EMAIL DOES NOT EXIST ";
		}
		else if ($psw==$password)
		{
 
			$_SESSION["email_id"] = $email;
			// $_SESSION["password"] = $psw;
			// $_SESSION["user_type"] = $user_type;
			$_SESSION["user_id"] = $user_id;
			$_SESSION["role_id"] = $role_id;

			if ($role_id==2) {
			header("Location: mentee_query.php");
			}
			elseif ($role_id==1) {
			header("Location: mentor_page.php");	
			}
		}



		// else if ($psw==$password && $role==1 && $user_type=="mentor") 
		// {
		// 	$sql = "select user_id from user where u_email='$email'";
		// 	$retval = mysql_query($sql, $link);
		// 	while($row = mysql_fetch_assoc($retval))
		// 	{
		// 		$user_id = $row['user_id'];
		// 	} 
		// 	$_SESSION["email_id"] = $email;
		// 	$_SESSION["password"] = $psw;
		// 	$_SESSION["user_type"] = $user_type;
		// 	$_SESSION["mentor_id"] = $user_id;
			
		// }
		// else if ($psw != $password && $user_type=="mentee")
		// {
		// 	echo "Wrong password ENTERED by mentee";
		// }
		// else if ($psw != $password && $user_type=="mentor")
		// {
		// 	echo "Wrong password ENTERED by mentor";
		// }
		else
		{
			echo "You are not authorised for this";
		}
	}




	?>

</body>
</html>