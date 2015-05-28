<?php

// Start the session
//connection established to database
//function file included
session_start();
include('db_tango.php');
include('mentee_funct.php');

?>

<!DOCTYPE html>
<html>
<head>
	<title>Mentor_reply_Page</title>
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

//Restoring email, user_id & role_id from session variables
$email 	 = $_SESSION["email_id"];
$user_id = $_SESSION["user_id"];
$role_id = $_SESSION["role_id"];

//Reply button clicked, receive reply description and id of mentor(user_id from session) 
if (isset($_POST['submit'])) {
		$id    = $_SESSION['id_mentor'];									// query id from session
		$reply = $_POST['message'];											// reply description from form
		insert_replies( $id, $reply, $user_id );							// Insert reply, query_id & mentor_id
		header("Location: http://mysite1.local/mentor_reply.php?id=$id");	// Redirected to same page (reload)
	}

// query_id from mentor's page
	$id = $_GET['id'];
	$_SESSION["id_mentor"] = $id;


//Getting user_id & role_id from database using entered email
	$array 		= extract_userid( $email );
	$user_id_db = $array['a'];
	$role_id_db = $array['b'];

//Checking user_id and role_id(session) to match that obtained from database
	if ($user_id==$user_id_db && $role_id==1) 
	{

	//extracting query title and display it
		query_title( $id );

	//extracting replies and display it
		extract_replies( $id );

		?>

		<div class="reply_form">
			<form action="mentor_reply.php" method="POST">
				<br>
				<textarea id="reply_box" placeholder="Reply Here Please" name="message" rows="10" cols="30"></textarea>
				<br><br>
				<input id="reply_submit_button" type="submit" value="REPLY" name="submit">
			</form>
		</div>

	<?php

	}
	?>

</body>
</html>