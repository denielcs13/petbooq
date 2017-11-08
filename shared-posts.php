<?php
/*session_start();
 require 'dbcon.php';
 $parent_id = $_SESSION['pet_unique_id'];
 $userqry=mysqli_query($conn,"SELECT * FROM user_inf WHERE pet_unique_id='$parent_id'");
$userinfo=mysqli_fetch_assoc($userqry);*/
	   //include 'dbcon.php';
	   /*function getusername($uid) {
		   $getunqry="SELECT * FROM user_inf WHERE pet_unique_id='$uid'";
		   $getun=mysqli_query($conn,$getunqry);
		   $getunres=mysqli_fetch_assoc($getun);
		   echo $getunres['pet_name'];
		     
	   }*/
	   
	   
	   $shareqry=mysqli_query($conn,"SELECT * FROM shares JOIN user_inf ON shares.sharer_id=user_inf.pet_unique_id WHERE shares.share_with_id = '$parent_id' ORDER BY time DESC ");
	   WHILE($shareres=mysqli_fetch_assoc($shareqry)) {
	   
	  $sharedisp=mysqli_query($conn,"SELECT * FROM post WHERE id='$shareres[post_id]'");
	   
	   $share_usr=mysqli_query($conn,"SELECT * FROM user_inf WHERE pet_unique_id='$shareres[sharer_id]'");
	   $share_usrname=mysqli_fetch_assoc($share_usr);
	   
	   WHILE($postres=mysqli_fetch_assoc($sharedisp))  {
								
                                ?>
	
 <h2><?= $shareres['powner_name'] ?> Shared A Post With You</h2>
 
 <div class="two-col-post" id="<?= $postres['id'] ?>">
                                    <div class="left">
                                        <div class="post-in-c">
                                            <div class="post-image fbphotobox">
											<?php 
											if($postres['img_count'] > 1) { 
$post_images=explode(",",$postres['image']); 
for($i=0;$i<count($post_images); $i++) { 
?>
	<div class="postm_images">
                                                <a class="example-image-link" data-lightbox="example-1" data-title="" href="images/user_image08.jpg" data-lightbox="example-1">
                                                    <img class="example-image" src="<?= $post_images[$i] ?>" alt="image-1">
                                                </a>
</div>
<?php } }

else if($postres['img_count'] == 1){
	
	?>
	<a class="example-image-link" data-lightbox="example-1" data-title="" href="images/user_image08.jpg" data-lightbox="example-1">
                                                    <img class="example-image" src="<?= $postres['image'] ?>" alt="image-1" />
                                                </a>
<?php } ?>
	
	
                                            </div>
											<?php
											$likecount=mysqli_query($conn,"SELECT * FROM likes WHERE post_id='$postres[id]'");
												$likenum=mysqli_num_rows($likecount);
												?>
                                            <div class="post-content">
                                                <h2><span class="user-icn-img"><img src="images/user-img-icon.png" alt="user image" /></span><p class="user-nm"><a href="#"><?= $share_usrname['powner_name'] ?></a></p></h2>
                                                <p class="pst-text"><?= $postres['posts'] ?><p>
												
                                                <p class="ttl-lks">
												
												<?php $user_like=mysqli_query($conn,"SELECT * FROM likes WHERE post_id='$postres[id]' AND liker_unique_id='$parent_id'"); 
										if(mysqli_num_rows($user_like) > 0) {     ?>
												<i class="fa fa-paw paw-like" id="paw-likes"></i>
										<?php } else { ?>
										<i class="fa fa-paw " id="paw-likes"></i>
										<?php } ?>
												
												
												<span class="number-likes<?= $postres['id'] ?>"><?= $likenum ?></span> Likes</p>
                                            </div>
                                            <div class="post-act-btn">

                                                <div class="post-act-ins">
												
                                                    <?php
											$likeqry=mysqli_query($conn,"SELECT * FROM likes WHERE post_id='$postres[id]' AND liker_unique_id='$parent_id'");
												$likecount=mysqli_num_rows($likeqry);
												
													if($likecount > 0) {	
													?>
													<button class="post-like-button liked" id="<?= $postres['id'] ?>">Unlike</button>
												<?php }
												else {
													?>
													<button class="post-like-button" id="<?= $postres['id'] ?>">Like</button>
												<?php } ?>
													
													
                                                    <button class="post-comment-btn" id="<?= $postres['id'] ?>">Comment</button>
													
                                                    <button class="post-share-btn" id="<?= $postres['id'] ?>">Share</button>
													
													<span class="share-time"><?= $shareres['time'] ?></span>
                                                </div>
												
												<div class="comment-head"><h3>Comments:</h3></div>
								
												<div class="comment-area">
												<?php
												
								$commentqry=mysqli_query($conn,"SELECT * FROM comments WHERE post_id='$postres[id]' AND commenter_unique_id='$parent_id'");
								
												if(mysqli_num_rows($commentqry)>0) {
													WHILE($commentresult=mysqli_fetch_assoc($commentqry)) {
														?>
														
													<div class="user-comments"><?= $userinfo['pet_name'].":-".$commentresult['comment'] ?></div>
													
													<?php
													}	
												}
												
												?>
												
												
												</div>                                     </div>
                                        </div>
                                    </div>
									
									
									
                                </div>
 
 
	   <?php }
	   }
 ?>