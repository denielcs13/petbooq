<html>
<?php require_once 'inc/head-content.php';  ?>
<body>
<?php require_once 'inc/header.php';  ?>

<?php
session_start();
//print_r($_SESSION["pet_unique_id"]);die;
$parent_id = $_SESSION["pet_unique_id"];
require './dbcon.php';
$display = "SELECT * FROM `addfriends` JOIN user_inf on addfriends.child_id = user_inf.pet_unique_id WHERE addfriends.parent_id ='$parent_id'";
$result = mysqli_query($conn, $display);
if(mysqli_num_rows($result))
{
?>
<div class="main-content">
<div class="main-content-inn col-three main-content-full usr-feed-page">
<div class="main-content-inn-left">
<div class="col-first">
<div class="stat-textarea post-f">

<div class="uplbtn-btm">
<h2 class="p-hdng">Share your new experience</h2>
<div class="upl-btm-text"><input placeholder="Experience" type="text"></div>
<div class="upl-btm-text"><textarea placeholder="Share your pets"></textarea></div>
</div>
<div class="upload-btn uplbtn-top uplbtn-btm-t">
<div class="upload-btn-hld">
<input placeholder="Type your URL" class="typ-t" type="text">
</div>
<div class="upload-btn-hld upload-btn-hld-top">
<input value="upload" class="fl-img" type="file">
<input class="fl-upld" value="upload" type="submit"><a href="#" class="ad-m">+</a> <input value="Post" class="fl-subm" type="submit">
</div>
</div>
</div>
<?php while($row = mysqli_fetch_assoc($result))
    {?>
<div class="two-col-post">

<div class="left">
<div class="post-in-c">
<div class="post-image">
<a class="example-image-link" data-lightbox="example-1" data-title="<?php echo $row["content"]?>" href="<?php echo $row["image"]?>" data-lightbox="example-1">
<img class="example-image" src="<?php echo $row["image"]?>" alt="image-1" />
</a>

</div>
<div class="post-content">
<h2><span class="user-icn-img"><img src="images/user-img-icon.png" alt="user image" /></span><p class="user-nm"><a href="#"><?php echo $row["pet_name"]?></a></p></h2>
<p class="pst-text"><?php echo $row["content"]?>
<a href="<?php echo $row["image"]?>" class="r-mr example-image-link" data-title="<?php echo $row["content"]?>" data-lightbox="example-1" data-lightbox="example-1" >Read More...</a>
<p>
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


<div class="right">
<div class="post-in-c">
<div class="post-imag post-video">
<a class="example-image-link" data-lightbox="example-1" data-title=" lorem ipsum is a filler text or greeking commonly used to demonstrate the textual" href="images/user_image08.jpg" data-lightbox="example-1">
<iframe src="<?php echo $row["video"]?>" allowfullscreen="" width="100%" height="100%" frameborder="0" autoplay="false"></iframe>



</a>

</div>
<div class="post-content">
<h2><span class="user-icn-img">
<img src="images/user-img-icon.png" alt="user image" /></span><p class="user-nm"><a href="#"><?php echo $row["pet_name"]?></a></p></h2>
<p class="pst-text"><?php echo $row["content"]?>
<a href="<?php echo $row["image"]?>" class="r-mr example-image-link" data-title="<?php echo $row["content"]?>" data-lightbox="example-1" data-lightbox="example-1" >Read More...</a>
<p>

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
<?php 
  }
}
?>
<!-- <div class="one-col-post">
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
</div> -->

<!-- <div class="one-col-post">
<div class="one-col-inn">
<div class="post-in-c">
<div class="post-image post-video">
<div class="post-mul-image">
<div class="post-mul-image-box">
<a class="example-image-link" data-lightbox="example-set" data-title=" lorem ipsum is a filler text or greeking commonly used to demonstrate the textual" href="images/user_image01.jpg" data-lightbox="example-1">
<img src="images/user_image01.jpg" alt="user post image/video" />
</a>
</div>
<div class="post-mul-image-box">
<a class="example-image-link" data-lightbox="example-set" data-title=" lorem ipsum is a filler text or greeking commonly used to demonstrate the textual" href="images/user_image02.jpg" data-lightbox="example-1">
<img src="images/user_image02.jpg" alt="user post image/video" />
</a>
</div>
<div class="post-mul-image-box">
<a class="example-image-link" data-lightbox="example-set" data-title=" lorem ipsum is a filler text or greeking commonly used to demonstrate the textual" href="images/user_image04.jpg" data-lightbox="example-1">
<img src="images/user_image04.jpg" alt="user post image/video" />
</a>
</div>
<div class="post-mul-image-box">
<iframe src="https://www.youtube.com/embed/M1djO19aSFQ" allowfullscreen="" width="100%" height="152px" frameborder="0"></iframe>
</div>
<div class="post-mul-image-box">
<a class="example-image-link" data-lightbox="example-set" data-title=" lorem ipsum is a filler text or greeking commonly used to demonstrate the textual" href="images/user_image07.jpg" data-lightbox="example-1">
<img src="images/user_image07.jpg" alt="user post image/video" />
</a>
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
</div> -->
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

<script type="text/javascript">
	$(document).ready(function() {
  $('#play-video').on('click', function(ev) {
 
    $("#video")[0].src += "&autoplay=1";
    ev.preventDefault();
 
  });
});
</script>

</body>
</html>