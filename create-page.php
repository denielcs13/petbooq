<?php
session_start();
	if(!(isset($_SESSION['pet_unique_id']))) {
		header('Location:index.php');
	}
	?>
<html>
<?php require_once 'inc/head-content.php';  ?>    
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="feather/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
	<link type="text/css" rel="stylesheet" href="feather/featherlight.min.css" />
<body>
<?php require_once 'inc/header.php';  ?>
<div class="main-content">
<div class="main-content-inn col-three main-content-full usr-feed-page usr-feed-page-nw create-new-page">
<div class="col-first-side">
    <?php
        if (isset($_POST["submit"])) {
        $parent_id = $_SESSION['pet_unique_id'];
        $name = $_POST["gname"];       
        $desc = $_POST["desc"];        
        $group_id= rand(222222, 9999999);
        $ran = $group_id;  
        require_once './dbcon.php';
                $q = "select(group_name) from groups where user_id_fk ='" . $parent_id . "'";
                $res = mysqli_query($conn, $q);
                //print_r($res);
                if (mysqli_num_rows($res) == 1) {
                echo "<script>alert('Group Already Exist')</script>";
                }
 else {
        require './dbcon.php';
        
        $insert = "INSERT INTO groups(group_id,group_name,group_desc,user_id_fk) 
VALUES ('$ran','$name','$desc','$parent_id')";
        $insert1="INSERT INTO group_users
(group_id_fk,user_id_fk) 
VALUES 
('$ran','$parent_id')";
                                   mkdir($parent_id . "/Groups/".$name."/Photos", 0777, true);
                                   mkdir($parent_id . "/Groups/".$name."/Videos", 0777, true);
                                   mkdir($parent_id . "/Groups/".$name."/Shared_Videos", 0777, true);
                                   mkdir($parent_id . "/Groups/".$name."/post_images", 0777, true);
                                   mkdir($parent_id . "/Groups/".$name."/profile_pic", 0777, true);
           // print_r($insert);die;
            $sqll=mysqli_query($conn, $insert);
            $sqll2=mysqli_query($conn, $insert1);
            //print_r($sqll);die;
            if ($sqll && $sqll2>0) {
            
               
                echo "<script>alert('Group created Successfully')</script>";
                echo "<script>window.location='groups.php'</script>";
            }
            else{
			echo "<script>alert('Group not created')</script>";
			
			}
        }
        }
        ?>
    <?php
                                $parent_id = $_SESSION['pet_unique_id'];
				$profileqry=mysqli_query($conn,"SELECT * FROM user_inf WHERE pet_unique_id='$parent_id'");
				$profileinfo=mysqli_fetch_assoc($profileqry);
				
				?>
<div class="pro-pic-sec">
<div class="pht"><?php if($profileinfo['profile_pic']=="") {
							echo "<img src='images/prof_img.jpg'>";
							}
							else {
							?>
							<img src="<?= $profileinfo['profile_pic'] ?>" alt="user image" />
							<?php } ?></div>
<div class="pet-info">
<p>Name: <?= $profileinfo['pet_name']; ?></p>
<p>DOB: <?= $profileinfo['dob']; ?></p>
</div>
<div class="pet-info">
<p>Owner: <?= $profileinfo['powner_name']; ?></p>
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
<div class="main-content-inn-left products gallery">
<div class="col-first">
<div class="stat-textarea post-f">
<div class="uplbtn-btm">
<div class="cr-form">
<div class="reg-form-sec">
<form action="">
<div class="pt-dt">
<div class="sel-cat">
<ul class="sel-tbs">
<li><a href="#tabs-1"><input type="radio" name="p_type" /><label>I am a Professional</label></a></li>
<li><a href="#tabs-2"><input type="radio" name="p_type1" /><label>Charity</label></a></li>
</ul>
</div>
<div class="form-row">
<div class="cate-hld">
<ul>
<li><a href="#" class="select">
<div class="icon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></div>
<div class="c-nm">Shop</div>
</a></li>

<li><a href="#">
<div class="icon"><i class="fa fa-shopping-bag" aria-hidden="true"></i></div>
<div class="c-nm">Brand / Product</div>
</a></li>

<li><a href="#">
<div class="icon"><i class="fa fa-stethoscope" aria-hidden="true"></i></div>
<div class="c-nm">Medical service</div>
</a></li>

<li><a href="#">
<div class="icon"><i class="fa fa-paw" aria-hidden="true"></i></div>
<div class="c-nm">Animal service</div>
</a></li>
<li><a href="#">
<div class="icon"><i class="fa fa-share" aria-hidden="true"></i></div>
<div class="c-nm">Other</div>
</a></li>
</ul>
</div>
</div>
<div class="form-row">
<label>Page name</label>
<input type="text" name="p_name" placeholder="Page name" />
</div>
<div class="form-row">
<label>Description</label>
<textarea name="description" placeholder="Description"></textarea>
</div>
<div class="form-row">
<label>Website</label>
<input type="text" name="web_name" placeholder="http://"/>
</div>
<div class="form-row">
<label>Country</label>
<select class="d-sml" name="c_name" required>
<option value="" >Select a country</option>
<option value="" >Afghanistan</option>
<option value="" >Albania</option>
<option value="" >Aland Islands</option>
<option value="" >Aruba</option>
<option value="" >Afghanistan</option>
<option value="" >Albania</option>
<option value="" >Aland Islands</option>
<option value="" >Aruba</option>
</select>
</div>
<div class="form-row">
<label>First name</label>
<input type="text" name="fname" placeholder="First name" />
</div>
<div class="form-row">
<label>Last name</label>
<input type="text" name="lname" placeholder="Last name" />
</div>
<div class="form-row">
<label>Phone number</label>
<input type="text" name="phone number" placeholder="Phone Number" />
</div>
<div class="form-row">
<label>Position</label>
<input type="text" name="position" placeholder="Position"/>
</div>
</div>
    <div class="sub-btn"><input type="submit" name="submit" value="Create" /></div>
</form>
</div>
</div>
</div>
</div>


<div class="col-third ads-sec">
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

</div>
</div>
</div>



</div>
</div>



<?php require_once 'inc/footer.php';  ?>
</body>
</html>