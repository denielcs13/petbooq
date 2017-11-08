<?php
session_start();
 require 'dbcon.php';
 $parent_id = $_SESSION['pet_unique_id'];
     date_default_timezone_set("Asia/Calcutta"); 
$share_datetime=date('Y-m-d H:i:s');
	//print_r($_POST);
	$count=count($_POST);
	foreach($_POST as $name) {
	if(!next($_POST)) {
        continue;
    }
	$shareqry="INSERT INTO shares(post_id,sharer_id,share_with_id,time) VALUES ('$_POST[pid]','$parent_id','$name','$share_datetime')";
	$sharerun=mysqli_query($conn,$shareqry);
	
	}

?>
POST SHARED