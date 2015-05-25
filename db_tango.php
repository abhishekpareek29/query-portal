
<?php
$link = mysql_connect('localhost:/var/run/mysqld/mysqld.sock', 'root', 'Astro@boy29');
if (!$link) 
{
   echo 'connection_aborted';
   die('Could not connect: ' . mysql_error());
}


$db_selected = mysql_select_db('tango', $link);
if (!$db_selected) 
{
    die ('Can\'t use tango : ' . mysql_error());
}

//----------------connected to Data Base-------------------
?>