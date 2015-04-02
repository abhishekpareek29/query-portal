<!DOCTYPE html>
<html>
<head>
<title>mentee_query_page</title>
</head>
<body>

<?php

$link = mysql_connect('localhost:/var/run/mysqld/mysqld.sock', 'root', 'Astro@boy29');
if (!$link) {
	echo 'connection_aborted';
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully';

$db_selected = mysql_select_db('tango', $link);
if (!$db_selected) {
    die ('Can\'t use tango : ' . mysql_error());
}


if (isset($_POST['submit'])) {

$query = $_POST["querytitle"]; 
$description = $_POST["message"];
$tags = $_POST["tags"];
$tagid = 'Select tag_id from tags where tag_keyword="$tags"';
if (!mysql_query($tagid,$link)) {
	$in_tag = "INSERT into tags(tag_keyword) values('$tags')";
	mysql_query($in_tag,$link);
}

$import="INSERT into queries(query_title,query_desc,tags,) values('$query','$description','$tagid')";
mysql_query($import) or die(mysql_error());

}

else {

        print "Upload new csv by browsing to file and clicking on Upload<br />\n";

        print "<form enctype='multipart/form-data' action='upload.php' method='post'>";

        print "File name to import:<br />\n";

        print "<input size='50' type='file' name='filename'><br />\n";

        print "<input type='submit' name='submit' value='Upload'></form>";

}


?>


</body>
</html>
