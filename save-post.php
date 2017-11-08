<?php
include("dbcon.php");
session_start();
$title=$_POST['title'];
$description=$_POST['description'];
$addlink=$_POST['post-url'];
$uniqueid=$_SESSION['pet_unique_id'];
date_default_timezone_set("Asia/Calcutta"); 
$post_datetime=date('Y-m-d H:i:s');
$im_path="";
$vid_path="";
    
$im_count=0;
$vid_count=0;
$loc_path = $_SESSION['pet_unique_id']."/post_images/";   
$vid_loc_path =  $_SESSION['pet_unique_id']."/Videos/";


for ($i = 0; $i < count($_FILES['files']['name']); $i++) {

$validextensions = array("jpeg", "jpg", "png","gif");      // Extensions which are allowed.
$videoextensions = array("mp4","avi","mov","3gp","mpeg");
$ext = explode('.', basename($_FILES['files']['name'][$i]));   // Explode file name from dot(.)
$file_extension = end($ext); // Store extensions in the variable.

if(in_array($file_extension, $validextensions)) {
	$im_count+=1;
$file_name=$_FILES['files']['name'][$i];
$img_ext = pathinfo($file_name, PATHINFO_EXTENSION);
$target_path = $loc_path . md5(uniqid(rand(), true)) . "." . $img_ext;     

   
if (in_array($file_extension, $validextensions) && ($_FILES["files"]["size"][$i] < 10000000)) {
if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $target_path)) {

//echo  ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
$all_images[$i]=$target_path;

} 
} 
}


	if(in_array($file_extension, $videoextensions)) {
	$vid_count+=1;
	$file_name=$_FILES['files']['name'][$i];
	$vid_ext = pathinfo($file_name, PATHINFO_EXTENSION);
$target_path = $vid_loc_path . md5(uniqid(rand(), true)) . "." . $vid_ext; 

if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $target_path)) {

//echo ').<span id="noerror">Video uploaded successfully!.</span><br/><br/>';
$all_videos[$i]=$target_path;
}	 
}


}

if($im_count>0) {
$im_path=implode(',',$all_images);
}
if($vid_count>0) {
$vid_path=implode(',',$all_videos);
}

if($im_count==0 && $vid_count==0) {
	$savepost="INSERT INTO post(child_post_id,title,posts,url,time)VALUES('$uniqueid','$title','$description','$addlink','$post_datetime')";
}
else {
	$savepost="INSERT INTO post(child_post_id,title,posts,url,image,img_count,video,vid_count,time)VALUES('$uniqueid','$title','$description','$addlink','$im_path','$im_count','$vid_path','$vid_count','$post_datetime')";
}
//mysqli_query($conn,$savepost);
//echo $im_count."--".$vid_count;

if ($conn->query($savepost) === TRUE) {
    $posted_id = $conn->insert_id;
    
}

$disp_post=mysqli_query($conn,"SELECT * FROM post WHERE id='$posted_id'");
$display_post=mysqli_fetch_assoc($disp_post);
?>


<div class="two-col-post" id="<?= $display_post['id']?>">
                                    <div class="left">
                                        <div class="post-in-c">
                                            <?php if($display_post['img_count']>=1) {
												$post_images=explode(",",$display_post['image']);
												for($i=0;$i<count($post_images); $i++) {
												?>
											<div class="post-image fbphotobox">
											
											
    <a class="example-image-link" data-lightbox="example-1" data-title="" href="images/user_image08.jpg" data-lightbox="example-1">
                        <img class="photo" fbphotobox-src="<?= $post_images[$i] ?>" alt="" src="<?= $post_images[$i] ?>">
                                                </a>

                                            </div>
											<?php } } ?>
											
											<div class="post_video">
											<?php if($display_post['vid_count']>=1) { 
											$post_videos=explode(",",$display_post['video']);
											for($i=0;$i<count($post_videos); $i++) {
											?>
											<div class="display_videos">
											<video width="230" height="200" controls>
  <source src="<?= $post_videos[$i] ?>" type="video/mp4">
 
</video>

											</div>
											<?php } }?>
											</div>
                                            
											
											
											
											
											<div class="post-content">
                                                <h2><span class="user-icn-img"><img src="images/user-img-icon.png" alt="user image" /></span><p class="user-nm"><a href="#"></a></p></h2>
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

