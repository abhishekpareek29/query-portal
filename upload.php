<!DOCTYPE html>
<html>
<head>
<title>Upload mentors details</title>
</head>
<body>
<div id="container">
<div id="form">

<?php

//include "connection.php"; //Connect to Database


$link = mysql_connect('localhost:/var/run/mysqld/mysqld.sock', 'root', 'Astro@boy29');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully';

$db_selected = mysql_select_db('tango', $link);
if (!$db_selected) {
    die ('Can\'t use tango : ' . mysql_error());
}




//Upload File
if (isset($_POST['submit'])) {
	if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
		echo "<h1>" . "File ". $_FILES['filename']['name'] ." uploaded successfully." . "</h1>";
		echo "<h2>Displaying contents:</h2>";
		readfile($_FILES['filename']['tmp_name']);
	}

	//Import uploaded file to Database
	$handle = fopen($_FILES['filename']['tmp_name'], "r");

	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		$import="INSERT into user(u_name,u_email,u_pass,role_id) values('$data[0]','$data[1]','$data[2]','$data[3]')";

		mysql_query($import) or die(mysql_error());
	}

	fclose($handle);

	print "Import done";

	//view upload form
}else {

	print "Upload new csv by browsing to file and clicking on Upload<br />\n";

	print "<form enctype='multipart/form-data' action='upload.php' method='post'>";

	print "File name to import:<br />\n";

	print "<input size='50' type='file' name='filename'><br />\n";

	print "<input type='submit' name='submit' value='Upload'></form>";

}

?>

</div>
</div>
</body>
</html>

