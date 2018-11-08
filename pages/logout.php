<?php

session_start();

//REDIRECT TO LOGIN WHEN A USER LOGS OUT
if(session_destroy()) {
    header("Location: login.php");
}

?>