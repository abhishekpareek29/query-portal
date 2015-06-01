<?php

// Start the session
//connection established to database
//function file included
session_start();
include('db_tango.php');
include('mentee_funct.php');

//restoring session variables
$email   = $_SESSION["email_id"];
$role_id = $_SESSION["role_id"];
$user_id = $_SESSION["user_id"];

$u_name = getu_name($user_id);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Mentor_Page</title>
	<link rel="stylesheet" type="text/css" href="query.css" />
</head>
<body>

	<div class="top_layer">
		<p id="top_slogan">Query Portal</p>
		<div class="nav_bar">
        <ul>
           <li><a href="dummy_project_modified.htm">Back</a></li>
           <li><a href="mentor_page.php">Queries for Me</a></li>
           <li><a href="account.php">My Account</a></li>
           <li><a href="logout.php">Log Out</a></li>
           <?php echo "Welcome  " . $u_name;   ?>
        </ul>
    	</div>
	</div>

<?php


//extracting user id, role_id from data base using email
$array 	    = extract_userid( $email );
$user_id_db = $array['a'];
$role_id_db = $array['b'];


//matching both user_id from session and from database
//also check for role_id to match that of mentor i.e. 1
if ($user_id == $user_id_db && $role_id == 1) 
{

	?>
	<div class="query_label">
		<?php
		echo "Please answer these Queries<br>";
		?>
	</div>
	<?php

	//Display only those queries asked from that mentor
	queries_for_mentor( $user_id_db );
}
else
{ 
	?>
	<div class="query_label">
		<?php 
		//if found illegal  user display message and exit
		echo "You are not authorised user of this account";
		exit();
		?>
	</div>
	<?php
}


?>



</body>
</html>