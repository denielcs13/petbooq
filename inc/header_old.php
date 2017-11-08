<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
   include("dbcon.php");
   session_start();
   if(isset($_COOKIE['member_login'])) {
	   
      $myusername = $_COOKIE['member_login'];
      $mypassword = $_COOKIE['member_password']; 
      
      //$sql = "SELECT * FROM user_inf WHERE email = '$myusername'";
	//$sql = "select pet_name,password,pet_unique_id from user_inf where email = '$myusername'";  
	  $sql = "select * from user_inf where email = '$myusername'";  
	  
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      
     
      if(password_verify($row['password'], $mypassword)) {
         echo "logged In Successfully".$status;
         $_SESSION['login_user'] = $myusername;
    
		 
		 
         header("location: feed-page.php");
      }
	  else 
	  {
         $error = "Your Login Name or Password is invalid";
		 echo $error;
      }
	   	   
   }
   
   
   if(isset($_POST['username'])) {
      
      
      $myusername = mysqli_real_escape_string($conn,$_POST['username']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['password']); 
      $dec_password=md5(utf8_encode($mypassword));
      //$sql = "SELECT * FROM user_inf WHERE email = '$myusername' and password = '$dec_password'";
	 //$sql = "select pet_name,pet_unique_id from user_inf where email = '$myusername' powner_name = '$myusername'"; 
	  $sql = "select * from user_inf where email = '$myusername' and password = '$dec_password'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);
      if($count == 1) {
		  
		  if(isset($_POST['staylogged'])) {
	   
	   setcookie ("member_login",$_POST["username"],time()+ 3600);
	   setcookie ("member_password",password_hash($_POST['password'], PASSWORD_DEFAULT),time()+ 3600);
   }
         echo "logged In Successfully".$status;
         $_SESSION['login_user'] = $myusername;
         //$_SESSION['unique_id']=$row['pet_unique_id'];
         $_SESSION['pet_unique_id'] = $row['pet_unique_id'];
         //$_SESSION['child_user_id'] = $row['child_user_id'];
         //echo "<script>window.location='feed-page.php'</script>";
         echo "<script>window.location='feed-pagepost.php'</script>";
         //header("location: photo-upload.php");
      }
	  else 
	  {
         echo "<script>alert('Your email id or password not match')</script>";
	     echo "<script>woindow.location='index.php'</script>";
      }
   }
?>


<div class="header">
<div class="header-inn">
<div class="logo"><a href="index.php"><img src="images/logo.png" alt="logo" /></a></div>
<div class="header-right">
<?php if(!isset($_SESSION['login_user'])) { ?>
<div class="al-j"><a href="#">Already joined?</a></div>
<div class="hdr-in-b">


<form method="post" action="" id="loginform">
<input type="text" name="username" placeholder="Email" />
<input type="password" name="password" placeholder="Password" />
<input type="submit" id="login" value="Log In">
</form>
<a href="#" class="f-p">Forgot Password</a>

<?php
 } 
elseif(isset($_SESSION['login_user'])) {
	echo "<h2 class='wel-t'>Welcome   " .$_SESSION['login_user']."</h2><a href ='user-log-out.php'>Sign Out</a><br/>";
        echo "<a href ='demo-post.php'>Post</a>";
}
?>
</div>
</div>
</div>
</div>