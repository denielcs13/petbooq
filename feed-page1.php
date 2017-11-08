<html>
<?php require_once 'inc/head-content.php';  ?>
<body>
<?php require_once 'inc/header.php';  ?>
<?php
include("dbconn.php");
session_start();
$uname=$_SESSION['login_user'];
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
<div class="main-content">
<div class="main-content-inn col-three main-content-full">
<div class="main-content-inn-left">
<div class="col-first">
<div class="stat-textarea post-f">
<form method="post" id="postform">
<div class="uplbtn-btm">
<h2 class="p-hdng">Share your new experience</h2>

<div class="upl-btm-text"><input placeholder="Experience" name="title" type="text"></div>
<div class="upl-btm-text"><textarea name="description" placeholder="Share your pets"></textarea></div>
</div>
<div class="upload-btn uplbtn-top uplbtn-btm-t">
<div class="upload-btn-hld">
<input placeholder="Type your URL" class="typ-t" name="addlink" type="text">
</div>
<div class="upload-btn-hld upload-btn-hld-top">
<input value="upload" class="fl-img" type="file" name="post_image">
<input class="fl-upld" value="upload" type="submit"><a href="#" class="ad-m">+</a> <input value="Post" class="fl-subm" type="submit">
</div>
</div>
</form>
</div>

<div class="two-col-post">
<div class="left">
<div class="post-in-c">
<div class="post-image"><img src="<?= $targetPath; ?>" alt="user post image/video" /></div>
<div class="post-content">
<h2><span class="user-icn-img"><img src="<?php if(isset($_POST['image'])){echo $_POST['image'];}?>" alt="user image" /></span><p class="user-nm"><a href="#"><?= $uname ?></a></p></h2>
<p class="pst-text"><?= $description ?></br><?= $addlink ?><p>
<p class="ttl-lks"><a href="#">435 likes</a></p>
</div>
<div class="post-act-btn">
<div class="post-act-ins">
<a href="#" title="like"><img src="images/like-icon.png" alt="like"/></a>
<a href="#" title="smiley"><img src="images/smily-icon.png" alt="smiley"/></a>
<a href="#" title="comment"><img src="images/comment-icon.png" alt="comment"/></a>
</div>
</div>
</div>
</div>

<div class="right">
<div class="post-in-c">
<div class="post-image"><iframe src="https://www.youtube.com/embed/M1djO19aSFQ" allowfullscreen="" width="100%" height="152px" frameborder="0"></iframe></div>
<div class="post-content">
<h2><span class="user-icn-img"><a href="#"><img src="images/user-img-icon.png" alt="user image"></a></span><p class="user-nm"><a href="#">User Name</a></p></h2>
<p class="pst-text">The #dog is the most faithful of #animals The 
<a href="#">#dog</a> is the most faithful of #animals</p>
<p class="ttl-lks"><a href="#">435 likes</a></p>
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

<div class="one-col-post">
<div class="one-col-inn">
<div class="post-in-c">

<div class="post-content">
<h2><span class="user-icn-img"><a href="#"><img src="images/user-img-icon.png" alt="user image"></a></span><p class="user-nm"><a href="#">User Name</a></p></h2>
<p class="pst-text">The #dog is the most faithful of #animals The 
<a href="#">#dog</a> is the most faithful of #animals</p>
<p class="ttl-lks"><a href="#">435 likes</a></p>
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

<div class="one-col-post">
<div class="one-col-inn">
<div class="post-in-c">
<div class="post-image post-video">
<div class="post-mul-image">
<div class="post-mul-image-box">
<img src="images/img1.jpg" alt="user post image/video" />
</div>
<div class="post-mul-image-box">
<img src="images/img3.jpg" alt="user post image/video" />
</div>
<div class="post-mul-image-box">
<img src="images/img5.jpg" alt="user post image/video" />
</div>
<div class="post-mul-image-box">
<iframe src="https://www.youtube.com/embed/M1djO19aSFQ" allowfullscreen="" width="100%" height="152px" frameborder="0"></iframe>
</div>
<div class="post-mul-image-box">
<img src="images/img2.jpg" alt="user post image/video" />
</div>
<div class="post-mul-image-box">
<div class="post-mr-imgupld">
<input type="file" value="Add More" class="ad-mr"/>
<span class="upl-img">Add More</span></div>
</div>
</div>
</div>
<div class="post-content">
<h2><span class="user-icn-img"><a href="#"><img src="images/user-img-icon.png" alt="user image"></a></span><p class="user-nm"><a href="#">User Name</a></p></h2>
<p class="pst-text">The #dog is the most faithful of #animals The 
<a href="#">#dog</a> is the most faithful of #animals</p>
<p class="ttl-lks"><a href="#">435 likes</a></p>
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
</div>

<div class="col-second">
<div class="fr-list">
<h2 class="fr-headnig"><span class="user-icn-img"><a href="#">
<img src="images/fr-li-icon.png" alt="user image"></a>
</span><p class="user-nm"><a href="#">Friend List</a></p></h2>
<div class="fr-li-cont">
<div class="fr-li-row">
<div class="fr-t-l">
<a href="#"><span class="user-icn-img"><img src="images/fr-img-icon.png" alt="user image"><span class="fr-nm">Friend Name</span></span></a>
</div>
<div class="user-nm"><a href="#">Add Friend</a></p></div>
</div>
<div class="fr-li-row">
<div class="fr-t-l">
<a href="#"><span class="user-icn-img"><img src="images/fr-img-icon.png" alt="user image"><span class="fr-nm">Friend Name</span></span></a>
</div>
<div class="user-nm"><a href="#">Add Friend</a></p></div>
</div>
<div class="fr-li-row">
<div class="fr-t-l">
<a href="#"><span class="user-icn-img"><img src="images/fr-img-icon.png" alt="user image"><span class="fr-nm">Friend Name</span></span></a>
</div>
<div class="user-nm"><a href="#">Add Friend</a></p></div>
</div>
<div class="fr-li-row">
<div class="fr-t-l">
<a href="#"><span class="user-icn-img"><img src="images/fr-img-icon.png" alt="user image"><span class="fr-nm">Friend Name</span></span></a>
</div>
<div class="user-nm"><a href="#">Add Friend</a></p></div>
</div>
</div>
</div>

<div class="fr-list fr-req">
<h2 class="fr-headnig"><span class="user-icn-img"><a href="#">
<img src="images/fr-req-icon.png" alt="user image"></a>
</span><p class="user-nm"><a href="#">Friend Request</a></p></h2>
<div class="fr-li-cont">
<div class="fr-li-row">
<div class="fr-t-l">
<a href="#"><span class="user-icn-img"><img src="images/fr-img-icon.png" alt="user image"><span class="fr-nm">Friend Name</span></span></a>
</div>
<div class="user-nm"><a href="#" class="inv-icon"><img src="images/fr-inv-icon.png" alt=""></a></p></div>
</div>
<div class="fr-li-row">
<div class="fr-t-l">
<a href="#"><span class="user-icn-img"><img src="images/fr-img-icon.png" alt="user image"><span class="fr-nm">Friend Name</span></span></a>
</div>
<div class="user-nm"><a href="#" class="inv-icon"><img src="images/fr-inv-icon.png" alt=""></a></p></div>
</div>
<div class="fr-li-row">
<div class="fr-t-l">
<a href="#"><span class="user-icn-img"><img src="images/fr-img-icon.png" alt="user image"><span class="fr-nm">Friend Name</span></span></a>
</div>
<div class="user-nm"><a href="#" class="inv-icon"><img src="images/fr-inv-icon.png" alt=""></a></p></div>
</div>
<div class="fr-li-row">
<div class="fr-t-l">
<a href="#"><span class="user-icn-img"><img src="images/fr-img-icon.png" alt="user image"><span class="fr-nm">Friend Name</span></span></a>
</div>
<div class="user-nm"><a href="#" class="inv-icon"><img src="images/fr-inv-icon.png" alt=""></a></p></div>
</div>
</div>
</div>

<div class="fr-list fr-sug">
<h2 class="fr-headnig"><span class="user-icn-img"><a href="#">
<img src="images/fr-sug-icon.png" alt="user image"></a>
</span><p class="user-nm"><a href="#">Friend Suggestion </a></p></h2>
<div class="fr-li-cont">
<div class="fr-li-row">
<div class="fr-t-l">
<a href="#"><span class="user-icn-img"><img src="images/fr-img-icon.png" alt="user image"><span class="fr-nm">Friend Name</span></span></a>
</div>
<div class="user-nm"><a href="#" class="dlt-icn">X</a></p></div>
</div>
<div class="fr-li-row">
<div class="fr-t-l">
<a href="#"><span class="user-icn-img"><img src="images/fr-img-icon.png" alt="user image"><span class="fr-nm">Friend Name</span></span></a>
</div>
<div class="user-nm"><a href="#" class="dlt-icn">X</a></p></div>
</div>
<div class="fr-li-row">
<div class="fr-t-l">
<a href="#"><span class="user-icn-img"><img src="images/fr-img-icon.png" alt="user image"><span class="fr-nm">Friend Name</span></span></a>
</div>
<div class="user-nm"><a href="#" class="dlt-icn">X</a></p></div>
</div>
<div class="fr-li-row">
<div class="fr-t-l">
<a href="#"><span class="user-icn-img"><img src="images/fr-img-icon.png" alt="user image"><span class="fr-nm">Friend Name</span></span></a>
</div>
<div class="user-nm"><a href="#" class="dlt-icn">X</a></p></div>
</div>
</div>
</div>
</div>
</div>
<div class="pro-right-sec">
<div class="sidebar">
<ul>
<li><a href="#"><span class="icn"><img src="images/create-page-icon.png" alt="icon" /></span>Create Page</a></li>
<li><a href="#"><span class="icn"><img src="images/create-grp-icon.png" alt="icon" /></span>Create Groups</a></li>
<li><a href="#"><span class="icn"><img src="images/event-icon.png" alt="icon" /></span>Events</a></li>
<li><a href="#"><span class="icn"><img src="images/create-grp-icon.png" alt="icon" /></span>Create Ads</a></li>
<li><a href="#"><span class="icn"><img src="images/notes-icon.png" alt="icon" /></span>Create Notes</a></li>
<li><a href="#"><span class="icn"><img src="images/rec-icon.png" alt="icon" /></span>Recommendations</a></li>
</ul>
</div>
</div>


</div>
</div>

<?php require_once 'inc/footer.php';  ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
$('#postimage').change(function() {
	var im=$(this).val();
	$('#imgname').html(im);
	
});
</script>
<div id="post_display"></div>

	<script type="text/javascript">
$(document).ready(function() {
	$("#postform").on('submit',(function(e)  {
		
           e.preventDefault();
		$.ajax({
        	url: "postsave.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,			
			success: function(data)
		    {
	
				$('#post_display').html(data);
		
		    },
		  	error: function() 
	    	{
				
	    	} 	        
	   });
	}));
});
</script>
</body>
</html>