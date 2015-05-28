<!DOCTYPE html>
<html>
<head>
	<title>Upload mentors details</title>
	<link rel="stylesheet" type="text/css" href="query.css" />
</head>

<body>

	<div class="top_layer">
		<p id="top_slogan">Query Portal</p>
	</div>

	<div id="container2">
		<div id="form2">

			<?php
		//database connection established 
			include('db_tango.php');

		//Upload File upon submit
			if (isset($_POST['submit'])) {

				if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
					echo "<h1>" . "File ". $_FILES['filename']['name'] ." Uploaded Successfully." . "</h1>";
					echo "<h2>Displaying Contents:</h2>";
					readfile($_FILES['filename']['tmp_name']);
				}

			//Import uploaded file to Database
				$handle = fopen($_FILES['filename']['tmp_name'], "r");
				$i 		= 0;
				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

					if($i>=1) {	
						$psw = md5($data[2]);
						$import="INSERT into user(u_name,u_email,u_pass,role_id) values('$data[0]','$data[1]','$psw',1)";
						mysql_query($import) or die(mysql_error());

					}$i++;
				}

				fclose($handle);

				print "Import done";

				$to 		= "abhishekpareek29@gmail.com";
				$subject = "This is a mail from local host";
				$message = "Sign up as mentor at query portal";
				$header  = "From:abhishek.pareek@innoraft.com \r\n";
				$retval  = mail ($to,$subject,$message,$header);

				if( $retval == true ) {
					echo "\nMentors Uploaded Successfully";
				}
				else {
					echo "\nMentors Could Not be Uploaded Successfully";
				}

			}

			else {

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

