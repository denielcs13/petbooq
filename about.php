<?php
session_start();
if (!(isset($_SESSION['pet_unique_id']))) {   
    header('Location:index.php');
}
?>
<html>
<?php require_once 'inc/head-content.php';  ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<body>
<?php require_once 'inc/header.php';  ?>
    <?php
        $parent_id = $_SESSION['pet_unique_id'];
        require 'dbcon.php';
        $userqry = mysqli_query($conn, "SELECT * FROM user_inf WHERE pet_unique_id='$parent_id'");
        $userinf = mysqli_fetch_assoc($userqry);

        $display = "SELECT * FROM(SELECT post.id,post.child_post_id,post.title,post.posts,post.url,post.image,post.time FROM addfriend JOIN post on addfriend.parent_id=post.child_post_id WHERE addfriend.child_id='$parent_id' AND addfriend.status='1' UNION SELECT post.id,post.child_post_id,post.title,post.posts,post.url,post.image,post.time FROM addfriend JOIN post on addfriend.child_id=post.child_post_id WHERE addfriend.parent_id='$parent_id' AND addfriend.status='1') AS u ORDER BY u.id DESC LIMIT 5";

        $disprun = mysqli_query($conn, $display);
        ?>


        <style>
            #filediv0, #filediv1, #filediv2, #filediv3 {
                width:80%;
                float:left;
            }
            .frn_req_acc, .frn_req_rej {
                float:left;
            }
            #add-more-img {
                display:none;
            }
            input[id="video_upload"] {
                display:none;
            }
            .vid-upl {
                -webkit-appearance: button;
                padding: 6px;
                background: #2c86bf;
                color: WHITE;
            }
            .post-video-upl {
                float:left;
            }
			.post-row .pro-post-content {
				height:64%;
			}
			.two-col-post-brdr .left .post-row .post-img {
				width:96%;
			}
			.post-row .post-img img {
				width:45%;
				float:left;
			}
			.post-image .photo {
				width:100%;
				
			}
			.videos {
				height:30%;
			}
			.one-col-post {
				width:50%;
			}
        </style>


<div class="main-content user-pro-dtls-page usr-feed-page-nw about-page  create-new-page create-grp ">
<div class="main-content-inn col-three main-content-full">
<div class="col-first-side">
<div class="pro-right-sec">
<div class="sidebar">
<ul>
<li><a href="#"><span class="icn"><img src="images/create-page-icon.png" alt="icon"></span>Create Page</a></li>
<li><a href="#"><span class="icn"><img src="images/create-grp-icon.png" alt="icon"></span>Create Groups</a></li>
<li><a href="#"><span class="icn"><img src="images/event-icon.png" alt="icon"></span>Events</a></li>
<li><a href="#"><span class="icn"><img src="images/create-grp-icon.png" alt="icon"></span>Create Ads</a></li>
<li><a href="#"><span class="icn"><img src="images/notes-icon.png" alt="icon"></span>Create Notes</a></li>
<li><a href="#"><span class="icn"><img src="images/rec-icon.png" alt="icon"></span>Recommendations</a></li>
</ul>
</div>
</div>
</div>
                               <?php
				$profileqry=mysqli_query($conn,"SELECT * FROM user_inf WHERE pet_unique_id='$parent_id'");
				$profileinfo=mysqli_fetch_assoc($profileqry);
				
				?>
<div class="main-content-inn-left">
<div class="col-first">

<div class="two-col-post two-col-post-brdr">
<div class="user-pro-dtls">
<div class="usr-pro-img"><?php if($profileinfo['profile_pic']=="") {
							echo "<img src='images/fr-pro-big-img.jpg'>";
							}
							else {
							?>
							<img src="<?= $profileinfo['profile_pic'] ?>" alt="user image" />
							<?php } ?></div>
<div class="usr-pro-dtl-r">
<h2><?= $profileinfo['pet_name']; ?></h2>
<p>Choosing a purebred is the best way to know what a dog's looks and personality might be like, but it's never...</p>
<div class="usr-anc-l">
<span>Name : <?= $profileinfo['powner_name']; ?></span>
                                    <span>DOB : <?= $profileinfo['dob']; ?></span>
<!--                                    <span>Breed : <//?= $profileinfo['breed']; ?></span>-->
</div>
<div class="usr-cnct-l"><!--<a href="#">Connect</a>--> <a href="profile-edit.php" class="edit">Edit</a></div>
</div>
</div>

<div class="pst-hld">
<div class="divide-line">
</div>
<div class="two-col-post ">
<div class="stat-textarea post-f left item">


<div class="uplbtn-btm">


<div class="sel-cat">

</div>

<div class="cr-form">
<div class="reg-form-sec">
<form action="">
<div class="pt-dt">



<div class="form-row">
<label>Name your group</label>
<input type="text" name="Page name">
</div>

<div class="form-row">
<label>Add some people</label>
<input type="text" name="Page name" placeholder="Enter Name or email address">
</div>



<div class="form-row">
<label>Select privacy</label>
<select class="d-sml" required="">
<option value="">Public Group</option>
<option value="">Close Group</option>
<option value="">Secret Group</option>

</select>
</div>


</div>

<div class="sub-btn">
<div class="sub-left"><input type="checkbox" value="Create" id="pin_short"><span for="pin_short">Pin to Shortcuts</span></div>
<div class="sub-right"><input type="submit" value="Create"></div>
</div>

</form>
</div>
</div>

</div>
</div>
<?php $propostqry=mysqli_query($conn,"SELECT * FROM post WHERE child_post_id='$parent_id' ORDER BY id DESC LIMIT 4");
								WHILE($propost=mysqli_fetch_assoc($propostqry)) {
								?>
<div class="left item">
<div class="post-in-c ">
<div class="post-content">
<h2><span class="user-icn-img"><a href="#"><img src="images/pet-icon.png" alt="user image"></a></span><p class="user-nm"><a href="#"><?= $_SESSION['user_name'] ?></a></p></h2>
<p class="pst-text" id="post_desc"><?= $propost['posts'] ?></p>
<a href="<?= $propost['url'] ?>"><?= $propost['url'] ?></a>
</div>
<div class="post-image fbphotobox">

<?php if($propost['img_count']>0) {
												$proimages=explode(",",$propost['image']);
                                                for($i=0;$i<count($proimages);$i++) {   
											?>
											<img class="photo" fbphotobox-src="<?= $proimages[$i] ?>" src="<?= $proimages[$i] ?>" alt="">
												<?php } }  ?>
</div>

											<?php if($propost['vid_count']>0) {
												$provid=explode(",",$propost['video']);
												for($i=0;$i<count($provid);$i++) { 
												
												?>   
												<div class="videos">
											<video width="230" height="200" controls>
                                            <source src="<?= $provid[$i] ?>" type="video/mp4">
 
                                            </video>
											</div>
											<?php } } ?>
											
											
<p class="ttl-lks">
<?php $user_like=mysqli_query($conn,"SELECT * FROM likes WHERE post_id='$postres[id]' AND liker_unique_id='$parent_id'"); 
										if(mysqli_num_rows($user_like) > 0) {     ?>
												<i class="fa fa-paw paw-like" id="paw-likes"></i>
										<?php } else { ?>
										<i class="fa fa-paw " id="paw-likes"></i>
										<?php } ?>
</p>
<div class="post-act-btn">

<div class="post-act-ins">
<a href="#" title="">like
</a><a href="javascript:" title="" class="cmnt_anc">Comment</a>
<a href="#" title="">Share</a>
</div>
<textarea class="cmnt_div" style="display:none;width:100%;" placeholder="Comment here"></textarea>
</div>
</div>
</div>

								<?php } ?>
<?php include 'shared-post-about.php'; ?>

</div>
</div>

</div>
</div>

<div class="col-second">
                        <div class="fr-list" id="friends-list">
                            <?php

$id = $_SESSION["pet_unique_id"];

$display2 = "SELECT user_inf.pet_name,user_inf.pet_unique_id,addfriend.parent_id as sender,addfriend.child_id as recepient,addfriend.status FROM addfriend JOIN user_inf ON addfriend.child_id = user_inf.pet_unique_id WHERE addfriend.parent_id ='$parent_id' and addfriend.status = '1' UNION SELECT user_inf.pet_name,user_inf.pet_unique_id,addfriend.child_id as sender,addfriend.parent_id as recepient,addfriend.status FROM addfriend JOIN user_inf ON addfriend.parent_id = user_inf.pet_unique_id WHERE addfriend.child_id ='$parent_id' and addfriend.status = '1'";
$show_result = mysqli_query($conn, $display2);
if (mysqli_num_rows($show_result)) {

            ?>
                            <h2 class="fr-headnig"><span class="user-icn-img"><a href="#">
                                        <img src="images/fr-li-icon.png" alt="user image"></a>
                                </span><p class="user-nm"><a href="#">Friend List</a></p></h2>
                                <?php while ($row = mysqli_fetch_assoc($show_result)) {
                                ?>
                            <div class="fr-li-cont">
                                <div class="fr-li-row">
                                    <div class="fr-t-l">
           <span class="user-icn-img"><img src="images/pet-icon.png" alt="user image"><span class="fr-nm"><a href="profile-page1.php?id=<?= $row['pet_unique_id'] ?>" class="frn_profile"><?= $row['pet_name'] ?></a></span></span>
                                    </div>                                   
                                </div>                              
                            </div>
                             <?php
                            }
                        }
                        ?>
                            
                            
                        </div>

                        <div class="fr-list fr-req">
                            <h2 class="fr-headnig"><span class="user-icn-img"><a href="#">
                                        <img src="images/fr-req-icon.png" alt="user image"></a>
                                </span><p class="user-nm"><a href="#">Friend Request</a></p></h2>
								<?php
								$fr_req="SELECT pet_name,email,parent_id,STATUS,child_id FROM user_inf JOIN addfriend ON addfriend.`parent_id` = user_inf.`pet_unique_id` WHERE (parent_id='$parent_id' OR child_id='$parent_id') AND(parent_id!='$parent_id') AND STATUS=1";
								$frn_req=mysqli_query($conn,$fr_req);
								WHILE($frnd_req=mysqli_fetch_assoc($frn_req)) {
								?>
								
                            <div class="fr-li-cont" id="friend-req-show">
                                <div class="fr-li-row">
                                    <div class="fr-t-l">
                                   
                                        <a href="#"><span class="user-icn-img"><img src="images/pet-icon.png" alt="user image"><span class="fr-nm"><?= $frnd_req['pet_name'] ?></span></span></a>
                                    </div>
									
                                    <div class="user-nm"><a href="#" class="frn_req_acc" id="<?=$frnd_req['parent_id'] ?>">Accept</a><a href="#" class="frn_req_rej" id="<?=$frnd_req['parent_id'] ?>">Reject</a></div>
                                </div>
                                
                            </div>
								<?php } ?>
                        </div>

				<script type="text/javascript">
				$(document).ready(function() {
					$('.frn_req_acc').on('click',function(e) {
						e.preventDefault();
						var acc_id=$(this).attr('id');
						
						$.ajax({
        	        url: "friend_req_fun.php",
			type: "POST",
			data: { accept: acc_id },
            cache: false,
			success: function(data) {
	          
			  $('#'+acc_id+'.frn_req_acc').parent().html("ACCEPTED");
			  
		      $('#friend-req-show').load(document.URL +  ' #friend-req-show');
			  $('#friends-list').load(document.URL +  ' #friends-list');
		    }        
		});
						
					}),
					
					$('.frn_req_rej').on('click',function(e) {
						e.preventDefault();
						var rej_id=$(this).attr('id');
						
						$.ajax({
        	        url: "friend_req_fun.php",
			type: "POST",
			data: { reject: rej_id },
            cache: false,
			success: function(data) {
	          
			  $('#'+rej_id+'.frn_req_rej').parent().html("REJECTED");
			  $('#friend-req-show').load(document.URL +  ' #friend-req-show');
		        
		    }        
		});
						
					});
					
					
				});
				</script>
<script type="text/javascript">
$(document).ready(function(e) {
	$(document).on('click','.add_friend_bttn',function(e) {
e.preventDefault();
		
                 var user_id=$(this).prev('input').val();
                 
                 $.ajax({
        	        url: "add_friend.php",
			type: "POST",
			data: { addid: user_id },
            cache: false,
			success: function(data) {
	          
			  $('#add-friend-action'+user_id).html(data);
			  
		        
		    },
		  	error: function() 
	    	      {
				
	    	         } 	        
		});
});
});

</script>
                            
                        
                    </div>
</div>



</div>
</div>

<?php require_once 'inc/footer.php';  ?>
</body>
</html>