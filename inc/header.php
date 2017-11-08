<?php
error_reporting(E_ERROR |  E_PARSE);
 session_start();
 
	
	
   include("dbcon.php");
  
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
	  $sql = "select * from user_inf where email = '$myusername'";
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
		 $_SESSION['user_name'] = $row['powner_name'];
		 $_SESSION["pet_name"]=$row["pet_name"];
		 $_SESSION["profile_pic"]=$row["profile_pic"];
         //$_SESSION['child_user_id'] = $row['child_user_id'];
         echo "<script>window.location='feed-page-test.php'</script>";
         //echo "<script>window.location='feed-pagepost.php'</script>";
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
<div class="header-left">
<?php if(!isset($_SESSION['login_user'])) { ?>
    <div class="logo"><a href="index.php"><img src="images/logo.png" alt="logo" /></a></div>
<?php
}
else
{?>
<div class="logo"><a href="feed-page-test.php"><img src="images/logo.png" alt="logo" /></a></div>    
<?php
}
?> 
<!--<div class="search">
<input placeholder="Search..." type="">
</div>-->
</div>
<div class="header-right">
            <form action="" method="post">
<?php if (!isset($_SESSION['login_user'])) { ?>
                    <div class="al-j"><a href="#">Already joined?</a></div>
                    <div class="hdr-in-b">
                        <input type="text" name="username" placeholder="Email">
                        <input type="password" name="password" placeholder="Password" />
                        <button type="submit" name="sub">Log In</button>
                        <a href="#" class="f-p">Forgot Password</a>
    <?php
} elseif (isset($_SESSION['login_user'])) {
    echo "<input type='text' id='autocomplete' name='search' placeholder='Search here... ' class='search_lft' />";
   // echo "<img src=".$_SESSION["profile_pic"]." >";
   //echo "<a href ='about.php'  class='profile-img-icon'>"."<img class='profile-img' src='.$_SESSION['profile_pic'].'/>".$_SESSION["pet_name"] ."</a>";
   echo "<a href='about.php' class='profile-img-icon'><img class='profile-img' src='".$_SESSION['profile_pic']."' width='50px' height:50px style='border-radius:35px'><span>".$_SESSION['pet_name']."</span></a>";
   
    
    //echo "<a href ='about.php'  class='hdr-post-anc'>". $_SESSION["pet_name"] ."</a>";
    echo "<a href ='feed-page-test.php'  class='hdr-post-anc'>Home</a>";
    echo "<a href='user-log-out.php' class='sign-o'>Sign Out</a>";
}
?>
                </div>
            </form>
        </div>
</div>
</div>
<script type="text/javascript">
   $(function () {

// Initialize 
       $("#autocomplete").autocomplete({
           source: function (request, response) {
// Fetch data
               $.ajax({
                   url: "search1.php",
                   type: 'post',
                   dataType: "json",
                   data: {
                       search: request.term
                   },
                   success: function (data) {
                   if(!data.length)
                   {
                   var result = [
		       {
		       label: 'No matches found', 
		       value: response.term
		       }
		     ];
		       response(result);
                   }
                   else{
                       console.log(data);
                       response(data);
                   }
                   }
               });
           },
           select: function (event, ui) {
               var ide=ui.item.id;
         location.href="profile-page1.php?id="+ide;
           $('#autocomplete').val(ui.item.value); // display the selected text
            $('#autocomplete').val(ui.item.label);
           $('#selectuser_id').val(ui.item.value.id); // save selected id to input
           return false;
           }
       });
   });
</script>