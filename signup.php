<!DOCTYPE html>
<html>
<head>
	<title>signup page</title>
</head>
<body>



<?php
$link = mysql_connect('localhost:/var/run/mysqld/mysqld.sock', 'root', 'Astro@boy29');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully';

$db_selected = mysql_select_db('tango', $link);
if (!$db_selected) {
    die ('Can\'t use tango : ' . mysql_error());
}

if (isset($_POST['submits'])) {
	$name = $_POST["fname"];
	$lname = $_POST["lname"];
	$email = $_POST["email"];
	echo $email;
	$psw = $_POST["psw"];
$see = "Select u_email from user where u_email='$email'";
echo $see;	
$sql = "INSERT into user(u_name,u_email,u_pass,role_id) values('$name','$email','$psw',2)";
$retval = mysql_query($see, $link);
echo $retval;

$flag = mysql_num_rows($retval);
if ($flag != 0)
{
	echo "email is already used";
}
else
{
$filled = mysql_query($sql, $link);
if(! $filled)
{
	die("can not insert user data:" . mysql_error());
}
echo "successfully registered";
}
}
?>
</body>
</html>