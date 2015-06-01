<?php

//extracts user_id using email address
function extract_userid( $e ) {
	global $link;

	$sql5 = "Select user_id,role_id from user where u_email='$e'";
	$retval = mysql_query($sql5, $link);
	while($row = mysql_fetch_assoc($retval)) {
        // echo "<br> user id :{$row['user_id']} <br>";
		$user_id_db = $row['user_id'];
		$role_id_db = $row['role_id'];
	}
	return $array = array('a' => $user_id_db, 'b' => $role_id_db);
}


// extracts all query of that particular user using user_id
function extract_query($user_id) {
	global $link;
	$sql = "Select query_id,query_title,query_desc from queries where author='$user_id'";
	$retval = mysql_query($sql, $link);
	if (!$retval) {
		echo "failed to load query list";
	}


	while($row = mysql_fetch_assoc($retval)) {
		
		$var = $row['query_id'];
		?>
		
		<table class="talks">
			<tr>
			<td class="title">
				<?php
				$title = myTruncate2($row['query_title'], 25);
				echo "<a href=replies.php?id=$var> {$title} </a>"; 
				?>
			</td>
			<td class="desc">
				<?php 
				$description = myTruncate2($row['query_desc'], 100);
				echo "{$description}"; 
				?>
			</td>
			</tr>
		</table>
		
		<?php      
	}
}

// Truncates the long strings to small.
function myTruncate2($string, $limit, $break=" ", $pad="...")
{
  // return with no change if string is shorter than $limit
  if(strlen($string) <= $limit) return $string;

  $string = substr($string, 0, $limit);
  if(false !== ($breakpoint = strrpos($string, $break))) {
    $string = substr($string, 0, $breakpoint);
  }

  return $string . $pad;
}


//logout funtion
function logout() {
	//redirects to another page which destroys session
	echo "<br><a href=logout.php>LOG OUT</a><br>";  
}


//display query title and its description
function query_title( $id ) {

	global $link;
	
	//select query_title and desc from DB using query_id
	$sql = "Select query_title,query_desc from queries where query_id='$id'";
	$retval = mysql_query($sql, $link);

	while ($row = mysql_fetch_assoc($retval)) {
		?>
		<div class="query_label">
			<?php
			echo "Query: {$row['query_title']}";
			echo "<br>Description: {$row['query_desc']}<br>";
			?>
		</div>
		<?php		
		}

	}


// extracts replies corresponding to a particular query using query_id ($id)
/*	function extract_replies($id, $user_id) {
		global $link;
		
		$sql = "Select reply_desc,author from replies where query_id='$id'";
		$retval = mysql_query($sql, $link);

		while ($row = mysql_fetch_assoc($retval)) {	
			$author = $row['author'];
			$sql2 = "Select u_name from user where user_id='$author'";
			$retval2 = mysql_query($sql2, $link);

			while ($row2 = mysql_fetch_assoc($retval2)) {
				?>
				<div class="comments">
				<?php 

					$name = $row2['u_name'];
    				echo "$name: {$row['reply_desc']}<br>"; 
				?>
				</div>
				<?php
				}
			}
		}
*/

function extract_replies($id, $user_id) {
		global $link;
		
		$sql = "Select reply_desc,author from replies where query_id='$id'";
		$retval = mysql_query($sql, $link);

		while ($row = mysql_fetch_assoc($retval)) {	
			$author = $row['author'];
				if ($user_id == $author) {
					?><div class="right">
					<?php
    				echo "{$row['reply_desc']}<br>";
    				?>
    				</div> 
    				<?php
    			}
    			else {
    					?><div class="left">
    					<?php
	    				echo "{$row['reply_desc']}<br>";
    					?>
    					</div>
    					<?php
    				}	
				}
			}
		



// Insert replies, Query_id and user_id(author of reply)
		function insert_replies($id, $reply, $user_id) {
			global $link;
			$sql 	= "INSERT INTO replies (query_id,reply_desc,author) values('$id','$reply','$user_id')";
			$retval = mysql_query($sql, $link);
			if (! $retval) {
				die('could not insert:'.mysql_error());
			}
		}


//Extracts Queries Asked from mentor
		function queries_for_mentor($user_id_db) {
			global $link;

			// Extracts all Query_title, description, author (who asked) using mentor's user_id
			$sql 	= "Select query_id,query_title,query_desc,author from queries where mentor_id='$user_id_db'";
			$retval = mysql_query($sql, $link);
			if (! $retval) {
				die('<br>query fetching error:  ' . mysql_error());
			}
			while ($row = mysql_fetch_assoc($retval)) {
				$query_id = $row['query_id'];

				//To display name under asked query as "Asked By: [mentee's name]"
				//Extract name of mentee from database
				$mentee_id = $row['author'];
				$sql_mentee_name = "Select u_name from user where user_id=$mentee_id";
				$retval1 = mysql_query($sql_mentee_name, $link);
				while ($row1 = mysql_fetch_assoc($retval1)) {
					$name = $row1['u_name'];		
				}

				?>
				
				<table class="mentor_talks">
				<tr>
					<td class="query_from"><?php echo $name; ?></td>
					<td class="title">
							<?php 
							$title = myTruncate2($row['query_title'], 25);
							echo "<a href=mentor_reply.php?id=$query_id> {$title} </a>";
							?>
					</td>
					<td class="desc">
							<?php
							$description = myTruncate2($row['query_desc'], 80);
							echo "{$description}"; 
							?>
					</td>
				</tr>
				</table>
			
				
				<?php
			}
		}

function getu_name($user_id) {
global $link;

$sql = "Select u_name from user where user_id=$user_id";
$retval = mysql_query($sql, $link);
while ($row = mysql_fetch_assoc($retval)) {
      $u_name = $row['u_name'];
} 
return $u_name;
}

		?>