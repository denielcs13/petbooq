<?php
   session_start();
   
?>
<html>
<head>
<style>
.post {
	border:1px solid black;
	width:50%;
	padding:12px;
}
.description {
	height:130px;
	width:80%;
}
#submit_post {
	float:right;
}
input[name="addlink"] {
	float:left;
}
input[name="title"] {
	width:64%;
}
input[id="postimage"] {
	display:none;
}
.addpicture {
	    -webkit-appearance: button;
		padding:2px;
}
.image-preview {
	width:200px;
	height:150px;
}
</style>
</head>
   <body>
      <h1>Welcome <?= $_SESSION['login_user'] ?></h1> 
      <h2><a href = "logout.php">Sign Out</a></h2>
	
	
	
	<div class="post">
<form method="post" id="postform">
<div class="title">
<input type="text" name="title" placeholder="Enter a title for the post">
</div>
<div class="description">
<textarea name="description" class="description" placeholder="Description"></textarea>
</div>
<label class="addpicture" >Add Image<input type="file" name="post_image" id="postimage"></label><span id="imgname"></span>
<input type="text" value="http://" name="addlink" placeholder="Add Link">
<div class="submit-post">
<input type="submit" value="POST">
</div>

</form>
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