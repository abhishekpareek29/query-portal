<?php

//start session
session_start();
//destroy session 
session_destroy();
//redirect to login page
header("Location: http://mysite1.local/dummy_project_modified.htm");

?>