<?php
session_start();
  $parent_id=$_SESSION['pet_unique_id'];
   require('dbcon.php');
$last_id=$_GET['last_id'];

$userqry=mysqli_query($conn,"SELECT * FROM user_inf WHERE pet_unique_id='$parent_id'");
$userinfo=mysqli_fetch_assoc($userqry);


//$display = "SELECT * FROM(SELECT post.id,post.child_post_id,post.title,post.posts,post.url,post.image,post.time FROM addfriend JOIN post on addfriend.parent_id=post.child_post_id WHERE addfriend.child_id='$parent_id' AND addfriend.status='1' UNION SELECT post.id,post.child_post_id,post.title,post.posts,post.url,post.image,post.time FROM addfriend JOIN post on addfriend.child_id=post.child_post_id WHERE addfriend.parent_id='$parent_id' AND addfriend.status='1') AS u WHERE u.id < '$last_id' ORDER BY u.id DESC LIMIT 3";

$display = "SELECT * 
FROM addfriend
JOIN user_inf ON addfriend.child_id = user_inf.pet_unique_id
JOIN post ON post.child_post_id = addfriend.child_id
WHERE addfriend.parent_id = '$parent_id' AND post.id<'$last_id'
AND addfriend.status = '1'
ORDER BY post.id DESC LIMIT 3";

       $disprun=mysqli_query($conn,$display);
	
 
   $json = include('getpostdata.php');
   json_encode($json);
   
?>


