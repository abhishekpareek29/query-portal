<!DOCTYPE html>
<html>
<head>
	<title>signup page</title>
	<link rel="stylesheet" type="text/css" href="query.css" />
</head>
<body>



	<?php

//connection established and database changed to tango
	include('db_tango.php');

//Gather all user info on click of submit button
	if (isset($_POST['submits'])) {
		$name  = $_POST["fname"];
		$lname = $_POST["lname"];
		$email = $_POST["email"];
		$psw1  = $_POST["psw"];	
		$psw   = md5($psw1);		//password encrypted through md5


//Watch for user email already existing in database 
	$see = "Select u_email from user where u_email='$email'";
	$retval = mysql_query($see, $link);


	$flag = mysql_num_rows($retval);
	if ($flag != 0)
	{

		?>


		<div class="query_label">
			<?php 
			echo "Email is already used";		//Display message of already registered and terminate execution
			exit();
			?>
		</div>


		<?php

	}

// but if new email then insert all details into database
	else {

		$sql = "INSERT into user(u_name,u_email,u_pass,role_id) values('$name','$email','$psw',2)";
		$filled = mysql_query($sql, $link);
		if(!$filled) {
			die("can not insert user data:" . mysql_error());
		}

		?>

		<div class="query_label">
			<?php 
			echo "Successfully registered";
			?>
		</div>

		<?php

	}

}

?>

</body>
</html>