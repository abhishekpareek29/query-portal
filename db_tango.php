
<?php

//global variable declared
global $link;

//link established
$link = mysql_connect('localhost:/var/run/mysqld/mysqld.sock', 'root', 'astroboy');
if (!$link) {
	//if could not be esablished abort
	echo 'connection_aborted';
	die('Could not connect: ' . mysql_error());
}

//select DATABASE
$db_selected = mysql_select_db('tango', $link);
if (!$db_selected) {
	//if could not select DB then terminate
	die ('Can\'t use tango : ' . mysql_error());
}

//------------connected Data Base-------------------
?>
