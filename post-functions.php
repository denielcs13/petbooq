<?php
session_start();
require 'dbcon.php';
$uniqueid = $_SESSION['pet_unique_id'];
        

if(isset($_POST['id'])) {
	$uniqueid=$_SESSION['pet_unique_id'];
	
	$likechq="SELECT * FROM likes WHERE post_id='$_POST[id]' AND liker_unique_id='$uniqueid'";
	$likerun=mysqli_query($conn,$likechq);
	$count= mysqli_num_rows($likerun);
	
	

	
if($count>0) {
	
	$unlikeqry="DELETE FROM likes WHERE post_id='$_POST[id]' AND liker_unique_id='$uniqueid'";
	$unlikerun=mysqli_query($conn,$unlikeqry);
	
}
else {
	
	$likeqry="INSERT INTO likes(post_id,liker_unique_id)VALUES('$_POST[id]','$uniqueid')"; 
	$likerun=mysqli_query($conn,$likeqry);
	
}
$totallikes=mysqli_query($conn,"SELECT * FROM likes WHERE post_id='$_POST[id]'");
$finalcount=mysqli_num_rows($totallikes);
echo $finalcount;
	
}


if(isset($_POST['commentid'])) {
	
$cominsqry="INSERT INTO comments(post_id,commenter_unique_id,comment)VALUES('$_POST[commentid]','$uniqueid','$_POST[commenttext]')";
$commentinsert=mysqli_query($conn,$cominsqry);	

echo $_SESSION['user_name']."--".$_POST['commenttext'];


}	
	
	
?>
