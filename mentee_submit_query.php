  <?php
  //session started
  //connection established to DB
  session_start();
  include('db_tango.php');

  // Session Variables are restored
  $e       = $_SESSION["email_id"];
  $role_id = $_SESSION["role_id"];
  $user_id = $_SESSION["user_id"];

  // Upon submit on mentee_query.php page
  if (isset($_POST['submit'])) 
  {

    //receiving following details from query submit form
    $query       = $_POST["querytitle"]; 
    $description = $_POST["message"];
    $tags        = $_POST["tags"];
    $mentor_id   = $_POST["mentor_list"];

    // Check whether tag entered already exits or not
    $tagid       = "Select tag_id from tags where tag_keywords='$tags'";
    $retval      = mysql_query( $tagid, $link );
    if(! $retval) {
      die('Can not find tag:'. mysql_error());
    }
    $flag = mysql_num_rows($retval);

    // If no such tag found then insert that tag in tags table
    if($flag == 0) {
      $intag = "INSERT into tags(tag_keywords) values('$tags')";
      $sql = mysql_query( $intag, $link );
    }

    // Now select that tag's tag_id
    $tagid = "Select tag_id from tags where tag_keywords='$tags'";
    $retval = mysql_query( $tagid, $link );
    while($row = mysql_fetch_assoc($retval)) {
      $tag_id = $row['tag_id'];
    }

  // Insert that query_title, Query_desc, tag_id, author(user_id), mentor_id(as selected in form)
    $import="INSERT into queries(query_title,query_desc,tag_id,author,mentor_id) values('$query','$description','$tag_id','$user_id','$mentor_id')";
    $jojo = mysql_query($import,$link);

    if(! $jojo ) {
        //if insert query fails operation terminated with a message
     die('Could not insert: ' . mysql_error());
   }
   else {
        //otherwise on insertion close link and redirect to again mentee_query.php page 
    mysql_close($link);
    header("Location: mentee_query.php");
  }


  }
  ?>