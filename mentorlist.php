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
	<title>Upload mentors details</title>
	<link rel="stylesheet" type="text/css" href="query.css" />
</head>

<body>

	<div class="top_layer">
		<p id="top_slogan">Query Portal</p>
		<div class="nav_bar">
        <ul>
           <li><a href="dummy_project_modified.htm">Back</a></li>
           <li><a href="mentorlist.php">Mentor & Mentee List</a></li>
            <li><a href="logout.php">Log Out</a></li>
           <li><a href="account.php">My Account</a></li>
           <?php echo "Welcome  " . $u_name;   ?>
        </ul>
    	</div>
	</div>

<?php
$sql = "Select u_name, u_email from user where role_id=1";
$retval = mysql_query($sql, $link);
while ($row = mysql_fetch_assoc($retval)) {
	$u_name = $row['u_name'];
	$u_email = $row['u_email'];
	?>


	<table class="mentor_talks">
	<tr>
		<td class="query_from">Mentor</td>
		<td class="title">
				<?php 
				// $title = myTruncate2($row['query_title'], 25);
				echo "Name: " . $u_name;
				?>
		</td>
		<td class="desc">
				<?php
				// $description = myTruncate2($row['query_desc'], 80);
				echo "Email: " . $u_email; 
				?>
		</td>
	</tr>
	</table>


	<?php

}

$sql = "Select u_name, u_email from user where role_id=2";
$retval = mysql_query($sql, $link);
while ($row = mysql_fetch_assoc($retval)) {
	$u_name = $row['u_name'];
	$u_email = $row['u_email'];
	?>


	<table class="mentor_talks">
	<tr>
		<td class="query_from">Mentee</td>
		<td class="title">
				<?php 
				// $title = myTruncate2($row['query_title'], 25);
				echo "Name: " . $u_name;
				?>
		</td>
		<td class="desc">
				<?php
				// $description = myTruncate2($row['query_desc'], 80);
				echo "Email: " . $u_email; 
				?>
		</td>
	</tr>
	</table>
	<?php

}
?>


</body>
</html>