<?php
session_start();
echo $_SESSION['user_name']."<br>";
date_default_timezone_set("Asia/Calcutta"); 
$today = date("Y-m-d H:i:s");  
echo $today;


?>