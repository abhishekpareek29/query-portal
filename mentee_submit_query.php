

<?php
session_start();
include('db_tango.php');

    $e = $_SESSION["email_id"];
    $role_id = $_SESSION["role_id"];
    $user_id = $_SESSION["user_id"];

    if (isset($_POST['submit'])) 
    {

        $query = $_POST["querytitle"]; 
        $description = $_POST["message"];
        $tags = $_POST["tags"];
        $mentor_id = $_POST["mentor_list"];
        $tagid = "Select tag_id from tags where tag_keywords='$tags'";
        $retval = mysql_query( $tagid, $link );
//echo " <br> retval:  $retval <br> ";
        if(! $retval)
        {
            die('Can not find tag:'. mysql_error());
        }


        $flag = mysql_num_rows($retval);
        // echo "<br> flag value: $flag <br>";
        if($flag == 0)
        {

          $intag = "INSERT into tags(tag_keywords) values('$tags')";
          $sql = mysql_query( $intag, $link );

        }
          $tagid = "Select tag_id from tags where tag_keywords='$tags'";
          $retval = mysql_query( $tagid, $link );

      while($row = mysql_fetch_assoc($retval))
      {
        $tag_id = $row['tag_id'];
      }


    $import="INSERT into queries(query_title,query_desc,tag_id,author,mentor_id) values('$query','$description','$tag_id','$user_id','$mentor_id')";
    $jojo = mysql_query($import,$link);

    if(! $jojo ) {
       die('Could not insert: ' . mysql_error());
   }
   else {
    mysql_close($link);
    echo "aaaaaaaaaaaaaaaa";
    header("Location: mentee_query.php");

   }


}
?>