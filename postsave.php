<?php
include("dbconn.php");
session_start();
$userid=$_SESSION['unique_id'];
$title=$_POST['title'];
$description=$_POST['description'];
$addlink=$_POST['addlink'];

if(is_array($_FILES)) {
if(is_uploaded_file($_FILES['post_image']['tmp_name'])) {
$sourcePath = $_FILES['post_image']['tmp_name'];
$targetPath = $_SESSION['unique_id']."/post_images/".$_FILES['post_image']['name'];
if(move_uploaded_file($sourcePath,$targetPath)) {
?>
<!--<img class="image-preview" src="<?php //echo $targetPath; ?>" class="upload-preview">-->
<?php
}
}
}

//echo $title."<br>".$description."<br>".$addlink."<br>".$targetPath;
$user_email=$_SESSION['login_user'];
$savepost="INSERT INTO user_post(user_email,title,description,url,image,pet_unique_id,craetedOn)VALUES('$user_email','$title','$description','$addlink','$targetPath','$userid',NOW())";
mysqli_query($conn,$savepost);
echo "<script>alert('Post Updated Successfully !!!!!')</script>";
?>
<!--<div class="show-post">
<div class="title">
<?= $title ?>
</div>
<div class="description">
<?= $description ?>
<span><?= $addlink ?></span>
</div>
<div class="post-image">
<img class="image-preview" src="<?= $targetPath; ?>">
</div>

<h1>SUCCESS!</h1>-->