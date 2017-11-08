<html>
    <?php require_once 'inc/head-content.php'; ?>
	
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	
    <body>
        <?php require_once 'inc/header1.php'; ?>
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

  $display = "SELECT * FROM(SELECT post.id,post.child_post_id,post.title,post.posts,post.url,post.image FROM addfriends JOIN post on addfriends.parent_id=post.child_post_id WHERE addfriends.child_id='$parent_id' UNION SELECT post.id,post.child_post_id,post.title,post.posts,post.url,post.image FROM addfriends JOIN post on addfriends.child_id=post.child_post_id WHERE addfriends.parent_id='$parent_id') AS u ORDER BY u.id ASC LIMIT 3"; 
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
.user-comments {
	font-weight:600;
	word-wrap:break-word;
	color:#2c86bf;
}
.comment-head {
	padding: 10px 0px 9px 0px;
	
}
.post-share-dialog {
	background:#fff;
	padding:13px;
	
}
.marked{
		background-color:#eeeeea;color:#000000;font-weight:500;
	}
	.check-share {
		display:none;
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
							<?php //include 'shared-posts.php'; ?>
      <?php include 'getpostdata.php'; ?>
						</div>
						<div class="ajax-load text-center" style="display:none">
    <p><img src="images/loader.gif">Loading More</p>
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
						
                    </div>
					
			<link rel="stylesheet" href="css/modal.css">	
		
				
					<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
					 
					
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" data-pid="123" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
	  
        <h3 class="modal-title" id="exampleModalLabel">Select Friends To Share This Post</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <div class="fr-li-cont">
	  <form method="post" id="share-form">
	  <?php
    $friendqry="SELECT * FROM (SELECT child_id as n FROM addfriends WHERE parent_id='$parent_id' UNION SELECT parent_id as n from addfriends WHERE child_id='$parent_id') as t";
$friendrun=mysqli_query($conn,$friendqry);
WHILE($friendlist=mysqli_fetch_assoc($friendrun)) {
	$frn_nameqry=mysqli_query($conn,"SELECT * FROM user_inf WHERE pet_unique_id='$friendlist[n]'");
	$frn_name=mysqli_fetch_assoc($frn_nameqry);
	
	
	
	

	?>
                                <div class="fr-li-row">
                                    <div class="fr-t-l">
									
          <a href="#"><span class="user-icn-img"><img src="images/fr-img-icon.png" alt="user image"><span class="fr-nm"><?= $frn_name['powner_name'] ?></span></span></a>
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
        
        <button type="button" class="share-post-frn">Share</button>
		
      </div>
    </div>
  </div>
</div>	
					
				
			<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>		
	<script type="text/javascript">
    $(document).ready(function () {
      
        $(document).on('click','.post-share-btn', function() {
			 var pid=$(this).attr('id');
           $('#myModal').modal().attr("data-pid",pid);
		 
		   //$('#myModal').data("pid",pid);
		   
        }),
		$('.share-select-frn').click(function() {
			 $(this).attr('id');
			$(this).parent().parent().toggleClass("marked");
			$(this).parent().parent().find('.check-share').trigger('click');
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
				$('#myModal').modal('hide').reset();
		
		    },
		  	error: function() 
	    	{
				
	    	} 	        
	   });
	}));
});
</script>		
					
<script type="text/javascript">

    $(window).scroll(function() {
		
		if(stop!==true) {
			
        if($(document).scrollTop() + window.innerHeight >= document.getElementsByTagName("body")[0].scrollHeight) {
            var last_id = $(".two-col-post:last").attr("id");
            loadMoreData(last_id);
			
		}
		
        }
    });

    function loadMoreData(last_id){
      $.ajax(
            {
                url: 'loadmoredata.php?last_id=' + last_id,
                type: "get",
				cache: false,
                beforeSend: function()
                {
                    $('.ajax-load').show();
                }
            })
            .done(function(data)
            {
			     
                $('.ajax-load').hide();
			                      	
                $("#post-display").append(data);
			if(isEmpty(data)) {
				var stop=true;
			}
				   
				
				
            })
            .fail(function(jqXHR, ajaxOptions, thrownError)
            {
                  alert('server not responding...');
            });
    }
</script>

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
 
 $(this).parent().next().next('.comment-area').html("<textarea class='comment-box' placeholder='Enter your comments'></textarea><button class='comment-submit'>Submit</button>");
 
 }),
 $(document).on('click', '.post-share-btn', function() {
	 
	 
	 
 });
 </script>
 <script type="text/javascript">
 $(document).ready(function() {
 $(document).on('click', '.comment-submit', function() {
	var post_id=$(this).parent().prev().prev().find('.post-comment-btn').attr("id");
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