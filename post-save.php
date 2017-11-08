<?php
include("dbcon.php");
session_start();
$title=$_POST['title'];
$description=$_POST['description'];
$addlink=$_POST['post-url'];
$uniqueid=$_SESSION['pet_unique_id'];
date_default_timezone_set("Asia/Calcutta"); 
$post_datetime=date('Y-m-d H:i:s');
if(is_array($_FILES)) {
	
if(is_uploaded_file($_FILES['post_image']['tmp_name'])) {
	
//$path = pathinfo($_FILES['post_image']['name']);
        //$ext = strtolower($p['extension']);
		//$new_name= $p['filename'].".".$ext;
		
$sourcePath = $_FILES['post_image']['tmp_name'];
$targetPath = $_SESSION['pet_unique_id']."/post_images/".$_FILES['post_image']['name'];
if(move_uploaded_file($sourcePath,$targetPath)) {
?>
<!--<img class="image-preview" src="<?php //echo $targetPath; ?>" class="upload-preview">-->
<?php
}
}
}

$savepost="INSERT INTO post(child_post_id,title,posts,url,image,time)VALUES('$uniqueid','$title','$description','$addlink','$targetPath','$post_datetime')";
mysqli_query($conn,$savepost);

$userinfo="SELECT * FROM user_inf WHERE pet_unique_id='$uniqueid'";
$res=mysqli_query($conn,$userinfo);
$petinfo=mysqli_fetch_assoc($res);
?>

<div class="two-col-post">
                                    <div class="left">
                                        <div class="post-in-c">
                                            <div class="post-image">
                                                <a class="example-image-link" data-lightbox="example-1" data-title=" lorem ipsum is a filler text or greeking commonly used to demonstrate the textual" href="images/user_image08.jpg" data-lightbox="example-1">
                                                    <img class="example-image" src="<?= $targetPath ?>" alt="image-1" />
                                                </a>

                                            </div>
                                            <div class="post-content">
                                                <h2><span class="user-icn-img"><img src="images/user-img-icon.png" alt="user image" /></span><p class="user-nm"><a href="#"><?php echo $petinfo['powner_name'] . '-' . $uniqueid ?></a></p></h2>
                                                <p class="pst-text"><?= $description ?><p>
                                                <p class="ttl-lks"><a href="#">likes</a></p>
                                            </div>
                                            <div class="post-act-btn">

                                                <div class="post-act-ins">
                                                    <a href="#" title="">like
                                                    </a><a href="#" title="">Comment</a>
                                                    <a href="#" title="">Share</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
</div>