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
$tagid = "Select tag_id from tags where tag_keywords='$tags'";


// if (!mysql_query($tagid,$link)) {
// 	$in_tag = "INSERT into tags(tag_keywords) values('$tags')";
// 	mysql_query($in_tag,$link);
// }
$retval = mysql_query( $tagid, $link );

if(! $retval )
{
  $intag = 'INSERT into tags(tag_keywords) values("$tags")';
  $sql = mysql_query( $intag, $link );
}  
// if(! $sql )
// {
//   	die('Could not insert tag:' . mysql_error());
// }
$retval = mysql_query( $tagid, $link );
if(! $retval)
{
  	die('Can not find tag:' . mysql_error());
}


$row = mysql_fetch_array($retval, MYSQL_ASSOC);
echo "<br>{$row['tag_id']}";
$import="INSERT into queries(query_title,query_desc,tag_id) values('$query','$description',{$row['tag_id']})";
$jojo = mysql_query($import,$link);
if(! $jojo )
{
 die('Could not insert: ' . mysql_error());
}
}

else 
{
        echo "FAILED";
}

mysql_close($link);
?>


</body>
</html>
