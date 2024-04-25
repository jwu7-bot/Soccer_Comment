<?php

/*******w******** 
    
    Name: Jiahui Wu
    Date: 4/23/2024
    Description: Logout 

****************/

// log out

session_start();

session_unset();

session_destroy();

header("Location: index.php");

?>