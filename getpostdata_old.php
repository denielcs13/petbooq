<?php

                       WHILE($postres=mysqli_fetch_assoc($disprun))  {
								
                                ?>
								
                                <div class="two-col-post" id="<?= $postres['id'] ?>">
                                    <div class="left">
                                        <div class="post-in-c">
                                            <div class="post-image">
                                                <a class="example-image-link" data-lightbox="example-1" data-title=" lorem ipsum is a filler text or greeking commonly used to demonstrate the textual" href="images/user_image08.jpg" data-lightbox="example-1">
                                                    <img class="example-image" src="<?= $postres['image'] ?>" alt="image-1" />
                                                </a>

                                            </div>
											<?php
											$likecount=mysqli_query($conn,"SELECT * FROM likes WHERE post_id='$postres[id]'");
												$likenum=mysqli_num_rows($likecount);
												?>
                                            <div class="post-content">
                                                <h2><span class="user-icn-img"><img src="images/user-img-icon.png" alt="user image" /></span><p class="user-nm"><a href="#"><?php echo $userinfo['pet_name'] . '-' . $postres["child_post_id"] ?></a></p></h2>
                                                <p class="pst-text"><?= $postres['posts'] ?><p>
                                                <p class="ttl-lks"><span class="number-likes<?= $postres['id'] ?>"><?= $likenum ?></span> Likes</p>
                                            </div>
                                            <div class="post-act-btn">

                                                <div class="post-act-ins">
												
                                                    <?php
											$likeqry=mysqli_query($conn,"SELECT * FROM likes WHERE post_id='$postres[id]' AND liker_unique_id='$parent_id'");
												$likecount=mysqli_num_rows($likeqry);
												
													if($likecount > 0) {	
													?>
													<button class="post-like-button liked" id="<?= $postres['id'] ?>">Liked</button>
												<?php }
												else {
													?>
													<button class="post-like-button" id="<?= $postres['id'] ?>">Like</button>
												<?php } ?>
													
													
                                                    <button class="post-comment-btn" id="<?= $postres['id'] ?>">Comment</button>
                                                    <a href="#" title="">Share</a>
                                                </div>
												
												Comments:
								
												<div class="comment-area">
												<?php
												
								$commentqry=mysqli_query($conn,"SELECT * FROM comments WHERE id='$postres[id]' AND commenter_unique_id='$parent_id'");
								
												if(mysqli_num_rows($commentqry)>0) {
													WHILE($commentresult=mysqli_fetch_assoc($commentqry)) {
														
													echo $userinfo['pet_name'].":-".$commentresult['comment'];
													
													}	
												}
												
												?>
												
												
												</div>                                     </div>
                                        </div>
                                    </div>
									
									
									
                                </div> 
								
                                <?php
                            
                        }
                        ?>
						
						
