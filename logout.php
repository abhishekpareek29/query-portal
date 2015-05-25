<?php

session_start();
session_destroy();

header("Location: http://mysite1.local/dummy_project_modified.htm");

?>