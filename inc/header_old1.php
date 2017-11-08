<?php
$error="";
if(isset($_POST["login"]))
{
  $email = $_POST["username"];
  $password = $_POST["password"];
  $useremail = stripslashes($email);
  $password = stripslashes($password);
  $useremail = mysql_real_escape_string($useremail);
  $password = mysql_real_escape_string($password);
  require_once './dbcon.php';
  $login_user = "select (email) from user_inf where email= '$useremail'";
  $results = mysqli_query($conn, $login_user);
  if(mysqli_num_rows($results)==1)
  {
      $_SESSION["useremail"]  =$useremail;
      header("Location:feed-page_test.php");
  }
 else
  {
  $error = "Enter correct email or password";    
  }
}
?>
<div class="header">
<div class="header-inn">
<div class="logo"><a href="index.php"><img src="images/logo.png" alt="logo" /></a></div>
<div class="header-right">
    <?php if(!isset($_SESSION['useremail'])) { ?>
<div class="al-j"><a href="#">Already joined?</a></div>
<div class="hdr-in-b">


<form method="post" action="" id="loginform">
<input type="text" name="username" placeholder="Email" />
<input type="password" name="password" placeholder="Password" />
<input type="submit" id="login" value="Log In" name="login">
</form>
<?php echo $error;?>    
<a href="forgetpassword.php" class="f-p">Forgot Password</a>
<?php
 } 
elseif(isset($_SESSION['useremail'])) {
	echo "<h2 class='wel-t'>Welcome   " .$_SESSION['useremail']."</h2><a href ='user-log-out.php'>Sign Out</a><br/>";
        echo "<a href ='demo-post.php'>Post</a>";
}
?>
</div>
</div>
</div>
</div>