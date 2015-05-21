<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>mentee_query_page</title>
</head>
<body>
    <form action="mentee_query.php" method="POST">
        Query Title:<br>
        <input type="text" name="querytitle" value="Title">
        <br></br>
        <input type="text" name="tags" value="tags">
        <br></br>
        Description:
        <textarea name="message" rows="10" cols="30"></textarea>
        <br><br>
        <input type="submit" value="submit" name="submit">
    </form> 

    <?php

    $link = mysql_connect('localhost:/var/run/mysqld/mysqld.sock', 'root', 'Astro@boy29');
    if (!$link) 
    {
       echo 'connection_aborted';
       die('Could not connect: ' . mysql_error());
   }
//echo 'Connected successfully';

   $db_selected = mysql_select_db('tango', $link);
   if (!$db_selected) 
   {
    die ('Can\'t use tango : ' . mysql_error());
}

//----------------connected to Data Base-------------------

//echo "<br>session value:".$_SESSION["email_id"]."<br>";

//matching previous session variables below
$e = $_SESSION["email_id"];
$u = $_SESSION["user_type"];
echo $e;
//extracting user id
$sql5 = "Select user_id from user where u_email='$e'";
$retval = mysql_query($sql5, $link);

while($row = mysql_fetch_assoc($retval))
{
    echo "<br> user id :{$row['user_id']} <br>";
    $user_id = $row['user_id'];
}
$_SESSION["user_id"] = $user_id;

$sql0 = "Select u_email from user where u_email='$e'";
$retval = mysql_query($sql0, $link);
$flag1 = mysql_num_rows($retval);
if($flag1 == 0)
{
    echo "<br>You are not logged IN<br>";
    mysql_close($link);
}
// matching password below
$p = $_SESSION["password"];
$sql2 = "Select u_pass from user where u_email='$e'";
$retval = mysql_query($sql2, $link);
$flag2 = mysql_num_rows($retval);
if($flag2 == 0)
{
    echo "<br>entered wrong password<br>";
    mysql_close($link);
}

// ---------------matching or validation of logged user completed -------------------

$sql = "Select query_id,query_title,query_desc from queries where author='$user_id'";
$retval = mysql_query($sql, $link);
if (!retval)
{
    echo "failed to load query list";
}
while($row = mysql_fetch_assoc($retval))
{
    $var = $row['query_id'];
    echo "<br><a href=replies.php?id=$var> {$row['query_title']} </a>";
    echo "<br> {$row['query_desc']} <br><br>";
}

if (isset($_POST['submit'])) 
{

    $query = $_POST["querytitle"]; 
    $description = $_POST["message"];
    $tags = $_POST["tags"];
    $tagid = "Select tag_id from tags where tag_keywords='$tags'";
    $retval = mysql_query( $tagid, $link );
//echo " <br> retval:  $retval <br> ";
    if(! $retval)
    {
        die('Can not find tag:'. mysql_error());
    }

// if (!mysql_query($tagid,$link)) {
// 	$in_tag = "INSERT into tags(tag_keywords) values('$tags')";
// 	mysql_query($in_tag,$link);



    $flag = mysql_num_rows($retval);
    echo "<br> flag value: $flag <br>";
    if($flag == 0)
    {

      $intag = "INSERT into tags(tag_keywords) values('$tags')";
      $sql = mysql_query( $intag, $link );
      $tagid = "Select tag_id from tags where tag_keywords='$tags'";
      $retval = mysql_query( $tagid, $link );
//  echo " <br>retval: $retval<br>";

  }

// if(! $sql )
// {
//   	die('Could not insert tag:' . mysql_error());
// }
  while($row = mysql_fetch_assoc($retval))
  {
    echo "<br> tag id :{$row['tag_id']} <br>";
    $tag_id = $row['tag_id'];
}





$import="INSERT into queries(query_title,query_desc,tag_id,author) values('$query','$description','$tag_id','$user_id')";
$jojo = mysql_query($import,$link);

if(! $jojo )
{
   die('Could not insert: ' . mysql_error());
}
else 
{
    echo "<br>Your Query is Submitted<br>";
}

mysql_close($link);

}
?>


</body>
</html>
