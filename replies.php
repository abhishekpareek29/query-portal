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
	<title>Replies</title>
	<link rel="stylesheet" type="text/css" href="query.css" />
</head>


<body>


	<div class="top_layer">
		<p id="top_slogan">Query Portal</p>
	</div>

	
	<div class="logout2">
		<?php
		logout();		//logout link
		?>	
	</div>


<?php

//When Reply button clicked, receive reply description
if (isset($_POST['submit'])) 
{
		$reply   = $_POST["message"];					//reply description received
		$id 	 = $_SESSION["id"];						//query_id restored from session
		$user_id = $_SESSION["user_id"];				//user_id from session
		insert_replies( $id, $reply, $user_id );		//insert reply description, query_id ($id) & user_id 
		header("Location: replies.php?id=$id");			//redirected to same page inorder to reload
	}


// getting query id from previous page (again)
// so as to know which query is selected
	$id 			= $_GET['id'];    
	$_SESSION["id"] = $id;


//restoring previous session variables email, role_id & user_id
	$e 		 = $_SESSION["email_id"];
	$role_id = $_SESSION["role_id"];
	$user_id = $_SESSION["user_id"];

//extracting user id and role id from database
	$array 		= extract_userid( $e );
	$user_id_db = $array['a'];
	$role_id_db = $array['b'];



	if ($user_id == $user_id_db && $role_id==$role_id_db) {

	//extracting query title and display it
		query_title( $id );

	//extracting replies of aforesaid query and display it
		extract_replies( $id );


		?>
		<div class="reply_form">
			<form action="replies.php" method="POST">
				<br>
				<textarea id="reply_box" placeholder="Reply Here Please" name="message" rows="10" cols="30"></textarea>
				<br>
				<input id="reply_submit_button" type="submit" value="REPLY" name="submit">
			</form>
		</div>
		<?php

	}

// if found illegal user then display message and terminate execution
	else {
		echo "You Are Not Logged In";
		exit();
	}

	?>

</body>
</html>