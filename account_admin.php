<?php

//session started
//connection is established to database
//file containing neccessary functions is included
session_start();
include('db_tango.php');
include('mentee_funct.php');

//restoring session variables
$e = $_SESSION["email_id"];
$role_id = $_SESSION["role_id"];
$user_id = $_SESSION["user_id"];

$u_name = getu_name($user_id);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Account</title>
    <link rel="stylesheet" type="text/css" href="query.css" />
</head>


<body>

<div class="top_layer">
        <p id="top_slogan">Query Portal</p>

    <div class="nav_bar">
        <ul>

           <li><a href="upload.php">Upload Mentors</a></li>
           <li><a href="mentorlist.php">Mentor & Mentee List</a></li>
           <li><a href="account_admin.php">My Account</a></li>
           <li><a href="logout.php">Log Out</a></li>
           <?php echo "Welcome  " . $u_name;   ?>
        </ul>
    </div>

</div>


<?php
// $sql    = "Select u_name, u_email from user where u_email=$e";
// $retval = mysql_query($sql, $link);
// while ($row = mysql_fetch_assoc($retval)) {
// 	$u_name = $row['u_name'];
// 	$u_email = $row['u_email'];
// }

?>

<div class="query_label">
<?php
echo "Name: " . $u_name;

echo "<br><br>Email Address: " . $e;
?>
</div>


</body>
</html>