<?php
include("dbcon.php");
session_start();
$title=$_POST['title'];
$description=$_POST['description'];
$addlink=$_POST['post-url'];
$uniqueid=$_SESSION['pet_unique_id'];
date_default_timezone_set("Asia/Calcutta"); 
$post_datetime=date('Y-m-d H:i:s');

if(array_sum($_FILES['file']['error']) == 0) {
$j = 0;     
$loc_path = $_SESSION['pet_unique_id']."/post_images/";    
$img_count=count($_FILES['file']['name']);
for ($i = 0; $i < count($_FILES['file']['name']); $i++) {

$validextensions = array("jpeg", "jpg", "png","gif");      // Extensions which are allowed.
$ext = explode('.', basename($_FILES['file']['name'][$i]));   // Explode file name from dot(.)
$file_extension = end($ext); // Store extensions in the variable.
$file_name=$_FILES['file']['name'][$i];
$target_path = $loc_path . md5($file_name) . "." . $ext[count($ext) - 1];     // Set the target path with a new name of image.
$all_path[$i]=$target_path;
$j = $j + 1;      // Increment the number of uploaded images according to the files in array.
if (($_FILES["file"]["size"][$i] < 10000000)     // Approx. 100kb files can be uploaded.
&& in_array($file_extension, $validextensions)) {
if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) {
// If file moved to uploads folder.
//echo $j. ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
} else {     //  If File Was Not Moved.
echo $j. ').<span id="error">please try again!.</span><br/><br/>';
}
} else {     //   If File Size And File Type Was Incorrect.
echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
}
}

$im_path=implode(',',$all_path);

}

if(isset($img_count)) {
$savepost="INSERT INTO post(child_post_id,title,posts,url,image,img_count,time)VALUES('$uniqueid','$title','$description','$addlink','$im_path','$img_count','$post_datetime')";
}
else {
	$savepost="INSERT INTO post(child_post_id,title,posts,url,time)VALUES('$uniqueid','$title','$description','$addlink','$post_datetime')";
	
}
mysqli_query($conn,$savepost);

$userinfo="SELECT * FROM user_inf WHERE pet_unique_id='$uniqueid'";
$res=mysqli_query($conn,$userinfo);
$petinfo=mysqli_fetch_assoc($res);
?>

<div class="two-col-post">
                                    <div class="left">
                                        <div class="post-in-c">
										<?php if(isset($img_count)) {
											if($img_count>1) {
											for($i=0;$i<$img_count; $i++) { 
											?>
                                            <div class="post-image">
											
         <a class="example-image-link" data-lightbox="example-1" data-title="" href="images/user_image08.jpg" data-lightbox="example-1">
                           <img class="example-image" src="<?= $all_path[$i] ?>" alt="image-1" />
                                                </a>

                                            </div>
										<?php } }  
										else if($img_count==1){
										?>
										 <div class="post-image">
											
         <a class="example-image-link" data-lightbox="example-1" data-title="" href="images/user_image08.jpg" data-lightbox="example-1">
                           <img class="example-image" src="<?= $all_path['0'] ?>" alt="image-1" />
                                                </a>
                                        
                                            </div>
										<?php } }?>
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