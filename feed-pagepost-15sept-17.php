<html>
    <?php require_once 'inc/head-content.php'; ?>	
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	
    <body>
        <?php require_once 'inc/header.php'; ?>
        <?php
        session_start();
//print_r($_SESSION);
        $parent_id = $_SESSION['pet_unique_id'];
        //print_r($parent_id);
        //echo '$parent_id';
//$child_id = $_SESSION["child_user_id"];
        require 'dbcon.php';
//$display = "SELECT * FROM `addfriends` JOIN user_inf on addfriends.child_id = user_inf.pet_unique_id WHERE addfriends.parent_id ='$parent_id'";
$userqry=mysqli_query($conn,"SELECT * FROM user_inf WHERE pet_unique_id='$parent_id'");
$userinfo=mysqli_fetch_assoc($userqry);

  $display = "SELECT * FROM addfriends JOIN post ON addfriends.child_id=post.child_post_id WHERE addfriends.parent_id = '$parent_id' ORDER BY post.id ASC LIMIT 3"; ///fetch data from database child id post comment
       $disprun=mysqli_query($conn,$display);
		
            ?>
			<style>
			input[name="post_image"] {
				display: none;
			}
			.upload-img-button {
				display: inline-block;
  position: relative;
  color:#fff;
  opacity: 1;
  height: auto;
  width: auto;
  border: 0;
  background: #2c86bf;
  padding: 10px 15px;
  text-transform: capitalize;
  
			}
			textarea.comment-box {
    width: 100%;
    height: 19%;
}
			</style>
            <div class="main-content">
                <div class="main-content-inn col-three main-content-full usr-feed-page">
                    <div class="main-content-inn-left">
                        <div class="col-first">
                            <div class="stat-textarea post-f">
							
                           <form method="post" id="post-form">
                                <div class="uplbtn-btm">
                                    <h2 class="p-hdng">Share your new experience</h2>
                                    <div class="upl-btm-text"><input name="title" placeholder="Experience" type="text"></div>
                                    <div class="upl-btm-text"><textarea name="description" placeholder="Share your pets"></textarea></div>
                                </div>
                                <div class="upload-btn uplbtn-top uplbtn-btm-t">
                                    <div class="upload-btn-hld">
                                        <input name="post-url" placeholder="Type your URL" class="typ-t" type="text">
                                    </div>
                                    <div class="upload-btn-hld upload-btn-hld-top">
                                        <label class="upload-img-button">UPLOAD<input name="post_image" value="upload" class="fl-img" type="file"></label>
                                        <!--<input class="fl-upld" value="upload" type="submit"><a href="#" class="ad-m">+</a>--> <input value="Post" class="fl-subm" type="submit">
                                    </div>
                                </div>
								</form>
								
                            </div>
							<div id="post-display">
      <div class="container"><?php include 'getpostdata.php'; ?></div>
						</div>
						<div class="ajax-load text-center" style="display:none">
    <p><img src="images/loader.gif">Loading More post</p>
</div>

						
<script type="text/javascript">
$(document).ready(function() {
	$("#post-form").on('submit',(function(e)  {
		
           e.preventDefault();
		$.ajax({
        	url: "post-save.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,			
			success: function(data)
		    {
	
				$('#post-display').prepend(data);
		
		    },
		  	error: function() 
	    	{
				
	    	} 	        
	   });
	}));
});
</script>
						

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
					
					
					
					
					
					
					
<script type="text/javascript">

    $(window).scroll(function() {
        if($(document).scrollTop() + window.innerHeight >= document.getElementsByTagName("body")[0].scrollHeight) {
            var last_id = $(".two-col-post:last").attr("id");
            loadMoreData(last_id);
        }
    });

    function loadMoreData(last_id){
      $.ajax(
            {
                url: 'loadmoredata.php?last_id=' + last_id,
                type: "get",
                beforeSend: function()
                {
                    $('.ajax-load').show();
                }
            })
            .done(function(data)
            {
				//alert(last_id);
                $('.ajax-load').hide();
                $("#post-display").append(data);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError)
            {
                  alert('server not responding...');
            });
    }
</script>

                    <div class="col-second">
                        <div class="fr-list">
                            <?php
session_start();
//print_r($_SESSION["pet_unique_id"]);die;
$id = $_SESSION["pet_unique_id"];
require './dbcon.php';
//$display = "SELECT pet_name,pet_unique_id FROM `user_inf` WHERE `pet_unique_id`<> $id limit 10";
//$display="SELECT DISTINCT addfriends.parent_id FROM addfriends WHERE addfriends.parent_id NOT in (SELECT parent_id FROM addfriends WHERE addfriends.parent_id='$id')";
//$display1="SELECT DISTINCT addfriends.parent_id FROM addfriends WHERE addfriends.parent_id NOT in (SELECT parent_id FROM addfriends WHERE addfriends.parent_id='$id')";
//$display="SELECT DISTINCT user_inf.pet_name FROM addfriends JOIN user_inf ON addfriends.child_id=user_inf.pet_unique_id WHERE addfriends.parent_id NOT in (SELECT parent_id FROM addfriends WHERE addfriends.parent_id ='$id')";
//$display1="SELECT DISTINCT user_inf.pet_unique_id,user_inf.pet_name FROM addfriends JOIN user_inf ON addfriends.child_id=user_inf.pet_unique_id WHERE addfriends.parent_id NOT in (SELECT parent_id FROM addfriends WHERE addfriends.parent_id='$id')";
//$display1 ="SELECT DISTINCT user_inf.pet_unique_id,user_inf.pet_name FROM addfriend JOIN user_inf ON addfriend.child_id=user_inf.pet_unique_id WHERE addfriend.parent_id NOT IN (SELECT parent_id FROM addfriend WHERE addfriend.parent_id='77777')";
$display2="SELECT user_inf.pet_unique_id,user_inf.pet_name FROM addfriend JOIN user_inf ON addfriend.child_id=user_inf.pet_unique_id WHERE addfriend.parent_id=77777";
$show_result = mysqli_query($conn, $display2);
if (mysqli_num_rows($show_result)) {
//
            ?>
                            <h2 class="fr-headnig"><span class="user-icn-img"><a href="#">
                                        <img src="images/fr-li-icon.png" alt="user image"></a>
                                </span><p class="user-nm"><a href="#">Friend List</a></p></h2>
                                <?php while ($row = mysqli_fetch_assoc($show_result)) {
                                ?>
                            <div class="fr-li-cont">
                                <div class="fr-li-row">
                                    <div class="fr-t-l">
                                        <a href="#"><span class="user-icn-img"><img src="images/fr-img-icon.png" alt="user image"><span class="fr-nm"><?php echo $row["pet_name"] ?></span></span></a>
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
                            <?php
session_start();
//print_r($_SESSION["pet_unique_id"]);die;
$id = $_SESSION["pet_unique_id"];
require './dbcon.php';
//$display = "SELECT pet_name,pet_unique_id FROM `user_inf` WHERE `pet_unique_id`<> $id limit 10";
//$display="SELECT DISTINCT addfriends.parent_id FROM addfriends WHERE addfriends.parent_id NOT in (SELECT parent_id FROM addfriends WHERE addfriends.parent_id='$id')";
//$display1="SELECT DISTINCT addfriends.parent_id FROM addfriends WHERE addfriends.parent_id NOT in (SELECT parent_id FROM addfriends WHERE addfriends.parent_id='$id')";
//$display="SELECT DISTINCT user_inf.pet_name FROM addfriends JOIN user_inf ON addfriends.child_id=user_inf.pet_unique_id WHERE addfriends.parent_id NOT in (SELECT parent_id FROM addfriends WHERE addfriends.parent_id ='$id')";
//$display1="SELECT DISTINCT user_inf.pet_unique_id,user_inf.pet_name FROM addfriends JOIN user_inf ON addfriends.child_id=user_inf.pet_unique_id WHERE addfriends.parent_id NOT in (SELECT parent_id FROM addfriends WHERE addfriends.parent_id='$id')";
//$display1 ="SELECT DISTINCT user_inf.pet_unique_id,user_inf.pet_name FROM addfriend JOIN user_inf ON addfriend.child_id=user_inf.pet_unique_id WHERE addfriend.parent_id NOT IN (SELECT parent_id FROM addfriend WHERE addfriend.parent_id='77777')<> $id limit 10";
$display3="SELECT DISTINCT user_inf.pet_unique_id,user_inf.pet_name FROM addfriend JOIN user_inf ON addfriend.child_id=user_inf.pet_unique_id WHERE addfriend.parent_id NOT IN (SELECT parent_id FROM addfriend WHERE addfriend.parent_id='77777')";
$show_result = mysqli_query($conn, $display3);
if (mysqli_num_rows($show_result)) 
    {
//
            ?>
                            <h2 class="fr-headnig"><span class="user-icn-img"><a href="#">
                                        <img src="images/fr-sug-icon.png" alt="user image"></a>
                                </span><p class="user-nm"><a href="#">Friend Suggestion </a></p></h2>
                                 <?php while ($row = mysqli_fetch_assoc($show_result)) {
                                ?>
                            <div class="fr-li-cont">
                                <div class="fr-li-row">
                                    <div class="fr-t-l">
                                        <a href="#"><span class="user-icn-img"><img src="images/fr-img-icon.png" alt="user image"><span class="fr-nm"><span class="fr-nm"><?php echo $row["pet_name"] ?></span></span></span></a>
                                    </div>
                                    <div class="user-nm"><input type="hidden" name="id" value="<?php echo $row['pet_unique_id']; ?>"/><a href="#">Add Friend</a></p></div>
                                </div>
                                
                            </div>
                            
                             <?php
                            }
                        }
                        ?>
                            
                            
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
<script type="text/javascript">

$(document).on('click', '.post-like-button', function() {
 
	var post_id=$(this).attr("id");
	
		$.ajax({
        	url: "post-functions.php",
			type: "POST",
			data: { id: post_id },
    	    cache: false,			
			success: function(data)
		    {
	          if(data > 0) {
				$('button#'+post_id+'.post-like-button').html("Liked").css("background","skyblue");
			  }
			  else {
				  $('button#'+post_id+'.post-like-button').html("Like").css("background","skyblue");
			  }
				//alert(parseInt($('#number-likes').html()));
				$('.number-likes'+post_id).html(data);
				
		        
		    },
		  	error: function() 
	    	{
				
	    	} 	        
	   });
});

</script>

	
<script type="text/javascript">

$(document).on('click', '.post-comment-btn', function() {
 
 $(this).parent().next('.comment-area').html("<textarea class='comment-box' placeholder='Enter your comments'></textarea><button class='comment-submit'>Submit</button>");
 
 });
 </script>
 <script>
 $(document).ready(function() {
 $(document).on('click', '.comment-submit', function() {
	var post_id=$(this).parent().prev().find('.post-comment-btn').attr("id");
	var comment_data=$(this).parent().find('.comment-box').val();
	//alert(comment_data);
	
		$.ajax({
        	url: "post-functions.php",
			type: "POST",
			data: { 
			commentid: post_id , commenttext: comment_data
			},
    	    cache: false,			
			success: function(data)
		    {
	          
			  $('.comment-box').parent().html(data);
		        
		    },
		  	error: function() 
	    	{
				
	    	} 	        
		});
 });
});

</script>	
        <?php require_once 'inc/footer.php'; ?>
    </body>
</html>