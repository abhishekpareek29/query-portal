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
		$sql = "select role_id,u_pass,user_id from user where u_email='$email'";
		$retval = mysql_query($sql, $link);		
		$flag = mysql_num_rows($retval);

		while($row = mysql_fetch_assoc($retval))
		{
			$role_id = $row['role_id'];
			$password = $row['u_pass'];
			$user_id = $row['user_id'];
		} 





		if($flag==0)
		{
			echo " YOUR ENTERED EMAIL DOES NOT EXIST ";
		}
		else if ($psw==$password)
		{
 
			$_SESSION["email_id"] = $email;
			$_SESSION["user_id"] = $user_id;
			$_SESSION["role_id"] = $role_id;

			if ($role_id==2) {
			header("Location: mentee_query.php");
			}
			elseif ($role_id==1) {
			header("Location: mentor_page.php");	
			}
		}

		else
		{
			echo "You are not authorised for this";
		}
	}
	
	?>

</body>
</html>