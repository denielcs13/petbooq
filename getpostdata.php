<?php

                       WHILE($postres=mysqli_fetch_assoc($disprun))  {
								
                                $par_name=mysqli_query($conn,"SELECT * FROM user_inf WHERE pet_unique_id='$postres[child_post_id]'");
								$pname_res=mysqli_fetch_assoc($par_name);
								
								
								?>
								
								
                                <div class="two-col-post" id="<?= $postres['id'] ?>">
                                    <div class="left">
                                        <div class="post-in-c">
										
                                          
<div class="post-image fbphotobox">


<?php if($postres['img_count'] > 1) { 
$post_images=explode(",",$postres['image']); 
for($i=0;$i<count($post_images); $i++) { 
?>
	<div class="many_images">
	
	<a class="example-image-link" data-lightbox="example-1" data-title="" href="<?php echo $id . "/post_images/" . $row["img_name"] ?>">
	
<img class="photo" fbphotobox-src="<?= $post_images[$i] ?>" alt="" src="<?= $post_images[$i] ?>"/>

</a>

</div>

<?php } }

else if($postres['img_count'] == 1){
	
	?>
	
	<a class="example-image-link" data-lightbox="example-1" data-title=" lorem ipsum is a filler text or greeking commonly used to demonstrate the textual" href="<?php echo $id . "/post_images/" . $row["img_name"] ?>">
	
<img class="photo" fbphotobox-src="<?= $postres['image'] ?>" alt="" src="<?= $postres['image'] ?>"/>

</a>
	
	
<?php } ?>
</div>
<div class="post_video">
<?php
if($postres['vid_count']>0) {
	$post_videos=explode(",",$postres['video']);
	for($i=0;$i<count($post_videos);$i++) {
?>
<div class="display_videos">
<video width="230" height="200" controls>
  <source src="<?= $post_videos[$i] ?>" type="video/mp4">
 
</video>


</div>

<?php } } ?>
</div>
                                            
											<?php
											$likecount=mysqli_query($conn,"SELECT * FROM likes WHERE post_id='$postres[id]'");
												$likenum=mysqli_num_rows($likecount);
												?>
                                            <div class="post-content">
         <h2><span class="user-icn-img"><img src="images/pet-icon.png" alt="user image" /></span><p class="user-nm"><a href="#"><?= $pname_res['powner_name']  ?></a></p></h2>
		 <h3><?= $postres['title'] ?></h3>
		 <span class="post-link"><a href="<?= $postres['url'] ?>" target="blank"><?= $postres['url'] ?></a></span>
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
													<span class="post-time"><?= $postres['time'] ?></span>
                                                </div>
												
												<div class="comment-head"><h3>Comments:</h3></div>
								
												<div class="comment-area">
												<?php
												
								$commentqry=mysqli_query($conn,"SELECT * FROM comments WHERE post_id='$postres[id]'");
								
												if(mysqli_num_rows($commentqry)>0) {
													WHILE($commentresult=mysqli_fetch_assoc($commentqry)) {
														?>
														
													<div class="user-comments"><?= $userinfo['pet_name'].":-".$commentresult['comment'] ?></div>
													
													<?php
													}	
												}
												
												?>
												<div class="post-comment-box" id="<?= $postres['id'] ?>" style="display:none;">
												<textarea class='comment-box' placeholder='Enter your comments'></textarea><button class='comment-submit'>Submit</button>
												</div>
												
												</div>                                     </div>
                                        </div>
                                    </div>
									
									
									
                                </div> 
								
                                <?php
                           
                        }
						 //mysql_close($conn);
                        ?>
						
						
