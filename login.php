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

if (isset($_POST['submitl'])) {
	$email = $_POST["email"];
	$psw = $_POST["psw"];

$sql = "select * from user where u_email='$email'";
$retval = mysql_query($sql, $link);
if(!$retval)
{
	echo " Username match does not exist ";
	mysql_close($link);
}



?>
</body>
</html>