<?php
session_start();
include('db_tango.php');
?>


<!DOCTYPE html>
<html>
<head>
    <title>mentee_query_page</title>
    <link rel="stylesheet" type="text/css" href="query.css" />
</head>


<body>

<div class="top_layer">
    <p id="top_slogan">Query Portal</p>
</div>

<div class="form">

    <form action="mentee_submit_query.php" method="POST">
        <p id="query_slogan">Ask Any Question</p><br>
        <input id="title" type="text" name="querytitle" placeholder="Title">
        <br></br>
        <input id="tag" type="text" name="tags" placeholder="Add some Tags">
        <br></br>

        
        <textarea id="desc" name="message" rows="10" cols="30" placeholder="Enter Query Description"></textarea>
        <br><br>
        <?php
        $sql = "Select user_id, u_name from user where role_id=1";
        $retval = mysql_query($sql, $link);
        ?>
        <select id="list" name="mentor_list" value="mentor_list">
    <!--         <option selected disabled>Select Any Mentor</option> -->
            <?php
            
            while($row = mysql_fetch_assoc($retval)) 
            {
                ?>"<option value=<?php echo $row['user_id'] ?> > <?php echo $row['u_name'] ?> </option>"<?php
            }
        ?>
        </select>
        <input id="submit-button" type="submit" value="SUBMIT" name="submit">
    </form> 
</div>





<div class="logout">
<?php
//---------------------logout link----------------------
echo "<br><a href=logout.php>LOG OUT</a><br>";    
?>
</div>
<?php

//restoring session variables
    $e = $_SESSION["email_id"];
    $role_id = $_SESSION["role_id"];
    $user_id = $_SESSION["user_id"];
    // $u = $_SESSION["user_type"];

//extracting user id from data base
    $sql5 = "Select user_id,role_id from user where u_email='$e'";
    $retval = mysql_query($sql5, $link);
    while($row = mysql_fetch_assoc($retval))
    {
        // echo "<br> user id :{$row['user_id']} <br>";
        $user_id_db = $row['user_id'];
        $role_id_db = $row['role_id'];
    }

    if ($user_id_db==$user_id && $role_id==2) {
        
    
 
    // $_SESSION["user_id"] = $user_id;

    // $sql0 = "Select u_email from user where u_email='$e'";
    // $retval = mysql_query($sql0, $link);
    // $flag1 = mysql_num_rows($retval);
    // if($flag1 == 0)
    // {
    //     echo "<br>You are not logged IN<br>";
    //     mysql_close($link);
    // }
// matching password below
    // $p = $_SESSION["password"];
    // $sql2 = "Select u_pass from user where u_email='$e'";
    // $retval = mysql_query($sql2, $link);
    // $flag2 = mysql_num_rows($retval);
    // if($flag2 == 0)
    // {
    //     echo "<br>entered wrong password<br>";
    //     mysql_close($link);
    // }

// ---------------matching or validation of logged user completed -------------------

    $sql = "Select query_id,query_title,query_desc from queries where author='$user_id'";
    $retval = mysql_query($sql, $link);
    if (!$retval)
    {
        echo "failed to load query list";
    }

//---------showing queries---------------------------
    while($row = mysql_fetch_assoc($retval))
    {
        $var = $row['query_id'];
?><div class="talks">
        <?php        
        echo "<br><a href=replies.php?id=$var> {$row['query_title']} </a>";
        echo "<br> {$row['query_desc']} <br><br>";
        ?>
</div>
  <?php      
    }
}


// else {
//     echo("You Are Not an Authorized User");
//     mysql_close($link);



//     // echo "<br><a href=dummy_project_modified.htm>Click Here To Log In</a><br>";


   
// }



?>


</body>
</html>
