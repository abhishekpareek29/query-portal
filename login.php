<?php

//session started 
//and also connection established to database
session_start();
include("db_tango.php");

?>


<!DOCTYPE html>
<html>
<head>
	<title>Query Portal</title>
</head>
<body>


	<?php
	
//receive all details from login form upon submit 
	if (isset($_POST['submitl'])) {

		//email & password are received
		$email = $_POST["email"];				
		$psw1 = $_POST["psw"];

		//role_id, user_id & user_password is extracted from database using entered email 		
		$sql = "select role_id,u_pass,user_id from user where u_email='$email'";
		$retval = mysql_query($sql, $link);		
		$flag = mysql_num_rows($retval);
		while($row = mysql_fetch_assoc($retval))
		{
			$role_id = $row['role_id'];
			$password = $row['u_pass'];
			$user_id = $row['user_id'];
		}

		//password entered by user is changed to md5 encryption
		$psw = md5($psw1);

		// if no row detected in database corresponding to entered email,
		// then display a message and exit
		if ($flag==0) {
			echo " YOUR ENTERED EMAIL DOES NOT EXIST ";
			exit();
		}
	
		// but if a row is received from DB then match both passwords
		elseif ($psw==$password) {
 			
 			// variables are stored into session
			$_SESSION["email_id"] = $email;
			$_SESSION["user_id"] = $user_id;
			$_SESSION["role_id"] = $role_id;

			// check whether mentee or mentor and redirect correspondingly
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