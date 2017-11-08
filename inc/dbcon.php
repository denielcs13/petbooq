<?php
//This file contains the database access information. It will included on every file requiring database access.
if($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == 'localhost:82')
{
	//For localhost checking
	$conn = @mysqli_connect('localhost','root','','pet') OR die ('could not connect:' . mysqli_connect_error());
	
	//echo "hi";
}
else
{
	//For online site
	$conn = @mysqli_connect('localhost','user_petbooq','petbooq@123','petbooq') OR die ('Sorry, could not connect:');
}
	?>
