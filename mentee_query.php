<?php

//session started
//connection is established to database
//file containing neccessary functions is included
session_start();
include('db_tango.php');
include('mentee_funct.php');

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
            //selecting all the mentors from database to display in a select list
            $sql = "Select user_id, u_name from user where role_id=1";
            $retval = mysql_query($sql, $link);
            ?>
            <select id="list" name="mentor_list" value="mentor_list">
                <option selected disabled>Select Any Mentor</option>

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
        logout();           //logout link echo  
        ?>
    </div>
    <?php

    //restoring session variables
    $e = $_SESSION["email_id"];
    $role_id = $_SESSION["role_id"];
    $user_id = $_SESSION["user_id"];
    // $u = $_SESSION["user_type"];

    //extracting user id from data base
    $array = extract_userid( $e );
    $user_id_db = $array['a'];
    $role_id_db = $array['b'];


    //Validating the user_id (session) of user from that of one selected from db using email
    if ($user_id_db==$user_id && $role_id==2) {

        //Display all queries of this particular mentee        
        extract_query($user_id);

    }

    ?>


</body>
</html>
