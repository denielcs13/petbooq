<?php
   session_start();
   
?>
<?php require_once 'inc/head-content.php';  ?>
<body>
<?php require_once 'inc/header.php';  ?>

<div class="main-content">
<div class="main-content-inn col-three post-page">
<div class="main-content-inn-left main-content-full">
<div class="col-first">
<div class="stat-textarea post-f">

<div class="uplbtn-btm">
<h2>Share your new experience</h2>
<form method="post" id="postform">

<div class="upl-btm-text"><input type="text" name="title" placeholder="Enter a title for the post">
</div>
<div class="upl-btm-text"><textarea name="description" class="description" placeholder="Description"></textarea>
</div>
</div>
<div class="upload-btn uplbtn-top uplbtn-btm-t">
 
<div class="upload-btn-hld upload-btn-hld-top upload-btn-hld">
<P class="upl-t">Upload File:</P> <input type="file" class="fl-img" name="post_image" id="postimage">
</div>
<div class="upload-btn-hld "><input type="text" value="http://" name="addlink" placeholder="Add Link" class="typ-t"></div>
<div class="upload-btn-hld-sub">
<input type="submit" value="POST" class="fl-subm">
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>


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