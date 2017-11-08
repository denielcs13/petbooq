<?php
session_start();
	if(!(isset($_SESSION['pet_unique_id']))) {
		header('Location:index.php');
	}
	?>
	<html>
	<?php
	require_once 'inc/head-content.php'; ?>	

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <body>
        <?php require_once 'inc/header.php'; ?>
        <?php
        
//print_r($_SESSION);
        $parent_id = $_SESSION['pet_unique_id'];
        //print_r($parent_id);
        //echo '$parent_id';
//$child_id = $_SESSION["child_user_id"];
        require 'dbcon.php';
$userqry=mysqli_query($conn,"SELECT * FROM user_inf WHERE pet_unique_id='$parent_id'");
$userinfo=mysqli_fetch_assoc($userqry);

  //$display = "SELECT * FROM(SELECT post.id,post.child_post_id,post.title,post.posts,post.url,post.image,post.img_count,post.time FROM addfriend JOIN post on addfriend.parent_id=post.child_post_id WHERE addfriend.child_id='$parent_id' AND addfriend.status='1' UNION SELECT post.id,post.child_post_id,post.title,post.posts,post.url,post.image,post.img_count,post.time FROM addfriend JOIN post on addfriend.child_id=post.child_post_id WHERE addfriend.parent_id='$parent_id' AND addfriend.status='1') AS u ORDER BY u.id DESC LIMIT 3";
  $display = "SELECT * 
FROM addfriend
JOIN user_inf ON addfriend.child_id = user_inf.pet_unique_id
JOIN post ON post.child_post_id = addfriend.child_id
WHERE addfriend.parent_id = '$parent_id'
AND addfriend.status = '1'
ORDER BY post.id DESC LIMIT 3";

       $disprun=mysqli_query($conn,$display);
		
            ?>
<style>

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
    height: 14%;
}
.check-share {
display:none;
}
.marked{
		background-color:rgba(158, 191, 44, 0.55);
		color:#000000;
		font-weight:500;
	}
	
	.user-nm a {
	float:left;
    margin-left:4px;
    }
	#paw-likes.fa-paw {
		font-size:18px;
		padding:9px;
	}
	.paw-like {
		color:#2c86bf;
	}
	#myModal .fr-li-cont {
		height:60%;
	}
	#myModal .modal-body {
		overflow-y:auto;
	}
	.share-time, .post-time {
		float:right;
	}
	span.post-link {
		float:right;
	}
	.many_images {
		display: table-cell;
    /* height: 50%; 
    width: 35%;*/
	}
	.postm_images {
		height: 27%;
    display: inline-table;
    width: 24%;		
	}	
	#filediv0, #filediv1, #filediv2, #filediv3 {
		width:80%;
	float:left;
}
.frn_req_acc, .frn_req_rej {
	float:left;
}

.display_videos {
	display:inline-block;
}
#loading-post {
	
}
									
			</style>
            <div class="main-content">
            
                <div class="main-content-inn col-three main-content-full usr-feed-page usr-feed-page-nw">
                <div class="col-first-side">
				<div class="pro-pic-sec">
<div class="pht"><img src="images/user_image06.jpg" alt=""></div>
<div class="pet-info">
<p>Name</p>
<p>Breed</p>
<p>Age</p>
</div>
<div class="pet-info">
<p>Owner</p>
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
                    <div class="main-content-inn-left">
                        <div class="col-first">
                            <div class="stat-textarea post-f">
							
                          <form method="post" id="profile-post-form">
<div class="uplbtn-btm">
<h2 class="p-hdng">Share your new activity</h2>
<div class="upl-btm-text"><input name="title" placeholder="Experience" type="text" required></div>
<div class="upl-btm-text"><textarea name="description" placeholder="Share your pets" required></textarea></div>
</div>
<div class="upload-btn uplbtn-top uplbtn-btm-t">
<div class="upload-btn-hld">
<input name="post-url" placeholder="Type your URL" class="typ-t" type="text">
</div>
<div class="upload-btn-hld upload-btn-hld-top">
<div class="upload-btn-inhld" id="upload-post-img">

<input name="files[]" value="upload" class="fl-img" type="file" multiple/>

</div>
<input value="Post" id="post-submit-btn" class="fl-subm" type="submit" />
</div>
</div>
</form>
								
                            </div>
							<div id="loading-post"><img src="loading-post.gif"></div>
							<div id="post-display">
      <div class="container" class="container">
	  <?php include 'shared-posts.php'; ?>
<?php include 'getpostdata.php'; ?></div>
						</div>
						<div class="ajax-load text-center" style="display:none">
    <p><img src="images/loader.gif">Loading More post</p>
</div>

						
<script type="text/javascript">
$(document).ready(function() {
	
		 
	$("#profile-post-form").on('submit',(function(e)  {
		
           e.preventDefault();
		$.ajax({
        	url: "save-post.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,		
beforeSend: function()
                {
                    $('#loading-post').show();
                },			
			success: function(data)
		    {
	            $('#loading-post').hide();
				$('#post-display').prepend(data);
				$('#profile-post-form')[0].reset();
		$('#post-submit-btn').removeAttr('disabled');
		    },
		  	error: function() 
	    	{
				
	    	} 
	       
	   });
	   $(this).find(':submit').attr( 'disabled','disabled' );
	  // $(this).unbind("submit");
    //$(this).on('submit',function(){return false;});

	}));
	
	
});
</script>
<!--share-->

	<link rel="stylesheet" href="css/modal.css">	
		
				
					<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
					 
					
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" data-pid="123" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
	  
        <h3 class="modal-title" id="exampleModalLabel">Select Friends To Share This Post</h3>
        <button type="button" class="close" id="share-modal-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <div class="fr-li-cont">
	  <form method="post" id="share-form">
	  <?php
    $friendqry="SELECT * FROM (SELECT child_id as n FROM addfriend WHERE parent_id='$parent_id' UNION SELECT parent_id as n from addfriend WHERE child_id='$parent_id') as t";
$friendrun=mysqli_query($conn,$friendqry);
WHILE($friendlist=mysqli_fetch_assoc($friendrun)) {
	$frn_nameqry=mysqli_query($conn,"SELECT * FROM user_inf WHERE pet_unique_id='$friendlist[n]'");
	$frn_name=mysqli_fetch_assoc($frn_nameqry);
	
	
	
	

	?>
                                <div class="fr-li-row">
                                    <div class="fr-t-l">
									
          <a href="#"><span class="user-icn-img"><img src="images/pet-icon.png" alt="user image"><span class="fr-nm"><?= $frn_name['powner_name'] ?></span></span></a>
		  <input type="checkbox" class="check-share" name="<?= $frn_name['powner_name'] ?>" value="<?= $frn_name['pet_unique_id'] ?>"> 
                                    </div>
                                    <div class="user-nm" id="<?= $frn_name['pet_unique_id']?>"><a href="#" class="share-select-frn">SELECT</a></div>
                                </div>
							
<?php } ?>
<input type="submit" id="share-btn" value="Share">
</form>
								</div>
	  
        
      </div>
      <div class="modal-footer">
        
        
		
      </div>
    </div>
  </div>
</div>	
					
			<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>	
			<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>		
	<script type="text/javascript">
    $(document).ready(function () {
      
        $(document).on('click','.post-share-btn', function() {
			 var pid=$(this).attr('id');
           $('#myModal').show().attr("data-pid",pid);
		 
		   //$('#myModal').data("pid",pid);
		   
        }),
		$('.share-select-frn').click(function() {
			 $(this).attr('id');
			$(this).parent().parent().toggleClass("marked");
			$(this).parent().parent().find('.check-share').trigger('click');
		}),
$('#share-modal-close').click(function() {

$('#myModal').hide();

});
		
    });
</script>				
		
<script type="text/javascript">
$(document).ready(function() {
$("#share-form").on('submit',(function(e)  {
		
           e.preventDefault();
		   var pid=$(this).closest('.modal').attr('data-pid');
		   var fd=new FormData(this);
		   fd.append('pid',pid);
		$.ajax({
        	url: "post-share-fun.php",
			type: "POST",
			data: fd,
			contentType: false,
    	    cache: false,
			processData:false,			
			success: function(data)
		    {
	
				alert(data);
				$('#share-form')[0].reset();
				$('#myModal').hide();
		
		    },
		  	error: function() 
	    	{
				
	    	} 	        
	   });
	}));
});
</script>	



<!--share end-->


                    </div>
					
					
					<div class="col-third   animated fadeInRight">
<div class="ltst-arc">
<h2>The latest articles</h2>
<div class="post-row">
<div class="post-rw-hld">
<div class="post-img"><img src="images/user_image03.jpg" alt=""></div>
<div class="post-content">
<h2><p class="user-nm"><a href="#">Articles Name</a></p></h2>
<p class="pst-text">The #dog is the most faithful of #animals The 
<a href="#">#dog</a> is the most faithful of #animals</p>
</div>
</div>
</div>
<div class="post-row">
<div class="post-rw-hld">
<div class="post-img"><img src="images/user_image07.jpg" alt=""></div>
<div class="post-content">
<h2><p class="user-nm"><a href="#">Articles Name</a></p></h2>
<p class="pst-text">The #dog is the most faithful of #animals The 
<a href="#">#dog</a> is the most faithful of #animals</p>
</div>
</div>
</div>

<div class="post-row">
<div class="post-rw-hld">
<div class="post-img"><img src="images/user_image05.jpg" alt=""></div>
<div class="post-content">
<h2><p class="user-nm"><a href="#">Articles Name</a></p></h2>
<p class="pst-text">The #dog is the most faithful of #animals The 
<a href="#">#dog</a> is the most faithful of #animals</p>
</div>
</div>
</div>


<h2>latest News</h2>
<div class="post-row">
<div class="post-rw-hld">
<div class="post-img"><img src="images/user_image04.jpg" alt=""></div>
<div class="post-content">
<h2><p class="user-nm"><a href="#">News Name</a></p></h2>
<p class="pst-text">The #dog is the most faithful of #animals The 
<a href="#">#dog</a> is the most faithful of #animals</p>
</div>
</div>
</div>
<div class="post-row">
<div class="post-rw-hld">
<div class="post-img"><img src="images/user_image03.jpg" alt=""></div>
<div class="post-content">
<h2><p class="user-nm"><a href="#">News Name</a></p></h2>
<p class="pst-text">The #dog is the most faithful of #animals The 
<a href="#">#dog</a> is the most faithful of #animals</p>
</div>
</div>
</div>
<div class="post-row">
<div class="post-rw-hld">
<div class="post-img"><img src="images/user_image07.jpg" alt=""></div>
<div class="post-content">
<h2><p class="user-nm"><a href="#">News Name</a></p></h2>
<p class="pst-text">The #dog is the most faithful of #animals The 
<a href="#">#dog</a> is the most faithful of #animals</p>
</div>
</div>
</div>
<div class="post-row">
<div class="post-rw-hld">
<div class="post-img"><img src="images/user_image09.jpg" alt=""></div>
<div class="post-content">
<h2><p class="user-nm"><a href="#">News Name</a></p></h2>
<p class="pst-text">The #dog is the most faithful of #animals The 
<a href="#">#dog</a> is the most faithful of #animals</p>
</div>
</div>
</div>
</div>
</div>
					
					
					
					
<script type="text/javascript">
	var fired=0;

    $(window).scroll(function() {

        if($(document).scrollTop() + window.innerHeight >= document.getElementsByTagName("body")[0].scrollHeight) {
			
			if(fired==0) {
            var last_id = $(".two-col-post:last").attr("id");
            loadMoreData(last_id);
			
			}
			fired=1;
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
				fired=0;
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

//$display2="SELECT user_inf.pet_unique_id,user_inf.pet_name FROM addfriend JOIN user_inf ON addfriend.child_id=user_inf.pet_unique_id WHERE addfriend.parent_id='$parent_id'";

$display2="SELECT * 
FROM  `addfriend` 
JOIN user_inf ON user_inf.pet_unique_id = addfriend.child_id
WHERE STATUS =2
AND parent_id ='$parent_id'";

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
                                        <a href="#"><span class="user-icn-img"><img src="images/pet-icon.png" alt="user image"><span class="fr-nm"><?php echo $row["pet_name"] ?></span></span></a>
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
								//$fr_req="SELECT * FROM addfriend WHERE child_id='$parent_id' AND status='0'";
								$fr_req="SELECT * FROM addfriend JOIN user_inf ON user_inf.`pet_unique_id` = addfriend.`child_id` WHERE (parent_id='$parent_id' OR child_id='$parent_id') AND (parent_id!='$parent_id') AND STATUS != 0";
								//$frn_req=mysqli_query($conn,$fr_req);
								WHILE($frnd_req=mysqli_fetch_assoc($frn_req)) {
								//$frnd_inf=mysqli_query($conn,"SELECT * FROM user_inf WHERE pet_unique_id='$frnd_req[parent_id]'");
								//$frnd_info=mysqli_fetch_assoc($frnd_inf);
								?>
								
                            <div class="fr-li-cont">
                                <div class="fr-li-row">
                                    <div class="fr-t-l">
                                        <a href="#"><span class="user-icn-img"><img src="images/pet-icon.png" alt="user image"><span class="fr-nm"><?= $frnd_info['pet_name'] ?></span></span></a>
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
			 
		        
		    }        
		});
						
					});
					
					
				});
				</script>
						
						
						
						
                        <div class="fr-list fr-sug">
						<h2 class="fr-headnig">
						<span class="user-icn-img"><img src="images/fr-sug-icon.png" alt="user image" /></span>
						<p class="user-nm">Friend Suggestion</p>
						</h2>
                        <div class="fr-sug-in">
                        <div class="fr-sug-d-in">
                            <?php

$id = $_SESSION["pet_unique_id"];

//$display3="SELECT DISTINCT user_inf.pet_unique_id,user_inf.pet_name FROM addfriend JOIN user_inf ON addfriend.child_id=user_inf.pet_unique_id WHERE addfriend.parent_id NOT IN (SELECT parent_id FROM addfriend WHERE addfriend.parent_id='$parent_id')";
$display3 = "SELECT DISTINCT user_inf.pet_unique_id,user_inf.pet_name FROM user_inf JOIN `addfriend` ON addfriend.`child_id`=user_inf.pet_unique_id 
WHERE addfriend.`child_id` NOT IN (SELECT `child_id` FROM addfriend WHERE addfriend.parent_id='$parent_id')";

$show_result = mysqli_query($conn, $display3);
//if (mysqli_num_rows($show_result)) 
    //{

            ?>
                            
                                 <?php while ($row = mysqli_fetch_assoc($show_result)) {
                                ?>
                            <div class="fr-li-cont">
                                <div class="fr-li-row">
                                    <div class="fr-t-l">
                                        <a href="#"><span class="user-icn-img"><img src="images/pet-icon.png" alt="user image">
										<span class="fr-nm"><?php echo $row["pet_name"] ?></span></span></a>
                                    </div>
                                    <div class="user-nm" id="add-friend-action<?= $row['pet_unique_id'] ?>">
<input type="hidden" name="id" value="<?= $row['pet_unique_id']; ?>"><a href="#" class="add_friend_bttn">Add Friend</a>

</div>
                                </div>
                                
                            </div>
                            
                             <?php
                           // }
                        }
                        ?>

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
	        
			if($('#'+post_id+'.post-like-button').text()=='Like') {
				$('#'+post_id+'.post-like-button').text('Unlike');
			}
			else if($('#'+post_id+'.post-like-button').text()=='Unlike'){
				$('#'+post_id+'.post-like-button').text('Like');
			}
				
			
			
				//alert(parseInt($('#number-likes').html()));
				$('.number-likes'+post_id).html(data);
				$('.number-likes'+post_id).prev('#paw-likes').toggleClass('paw-like');
				
		        
		    },
		  	error: function() 
	    	{
				
	    	} 	        
	   });
});

</script>

	
<script type="text/javascript">

$(document).on('click', '.post-comment-btn', function() {
 
 $(this).parent().next().next().find('.post-comment-box').show();
 
 });
 </script>
 <script>
 $(document).ready(function() {
 $(document).on('click', '.comment-submit', function() {
	var post_id=$(this).parent().attr("id");
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
	          $('#'+post_id+'.post-comment-box').hide();
			  $('#'+post_id+'.post-comment-box').parent().append("<div class='user-comments'>"+data+"</div>");
		        
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
