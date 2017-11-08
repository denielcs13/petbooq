<?php
session_start();
//$parent_id = $_SESSION['pet_unique_id'];
$friend_id = $_POST['addid'];
//$friend_id = $_GET['id'];
require 'dbcon.php';
$result=mysqli_query($conn,"SELECT * FROM followers JOIN user_info ON user_info.pet_unique_id = addfriend.parent_id WHERE (addfriend.parent_id='$parent_id' OR addfriend.child_id='$parent_id') AND (addfriend.parent_id='$friend_id' OR addfriend.child_id='$friend_id')");
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
if($row['parent_id']=='$parent_id' && $row['status']=='0')
{
    echo 'following';
//if(isset($_POST['addid'])) {
	
//$req_qry=mysqli_query($conn,"INSERT INTO addfriend(parent_id,child_id,status)VALUES('$parent_id','$_POST[addid]','0')");
//$req_qry = mysqli_query($conn,"SELECT * FROM addfriend JOIN user_inf ON user_inf.pet_unique_id = addfriend.parent_id WHERE (addfriend.parent_id='1155933' OR addfriend.parent_id='1155933') AND (addfriend.child_id='1119053' OR addfriend.child_id='1119053') AND status =1");	
}
 else {
     $req_qry=mysqli_query($conn,"INSERT INTO followers(parent_id,child_id)VALUES('$parent_id','$parent_id')");
    echo '<span>Following</span>';
}
?>