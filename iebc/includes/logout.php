<?php
include 'database/config.php';


session_destroy();
$_SESSION = [];
session_unset();
header("Location: /iebc/landingPage.php");
    
?> 