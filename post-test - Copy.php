<html>
<?php
session_start();
$id = $_SESSION["pet_unique_id"];
print_r($id);
if(isset($_POST["submit_data"]))
{
require 'dbcon.php';
$user_profile = "select pet_unique_id,pet_name,phone,email,country,type_of_pet,powner_name,dob from user_inf where pet_unique_id = $id";
$results_display = mysqli_query($conn, $user_profile);
if(mysqli_num_rows($results_display)==1)
{
	while($row = mysqli_fetch_array($results_display))
	{
		
		$filetmp = $_FILES['file_img']['tmp_name'];
        $filname = $_FILES["file_img"]['name'];
		$filetype = $_FILES["file_img"]["type"];
		$name = $_POST["name"];
		$user_name = $_POST["user_name"];
		$type_of_pet = $_POST["type_of_pet"];
		$email = $_POST["email"];
		$address = $_POST["phone"];
		$birthday = $_POST["birthday"];
		$country = $_POST["country"];
		require 'dbcon.php';
		$update = "update  user_inf set pet_name = '$name' where pet_unique_id = $id";
		$target_path = $id . "/profile_pic/" . basename($_FILES['file_img']['name']);
		if(move_uploaded_file($_FILES['file_img']['tmp_name'], $target_path))
		{
			require './dbcon.php';
			$target_path = $id . "/profile_pic/" . basename($_FILES['file_img']['name']);
			
            $insert = "update  user_inf set pet_name = '$name',profile_pic = '$target_path' where pet_unique_id = $id";
			mysqli_query($conn,$insert);
			if(mysqli_num_rows==1)
			{
				echo "Update successfully";
			}
		}
		
		
	}
}	
}
?>
<?php require_once 'inc/head-content.php';  ?>
<body>
<?php require_once 'inc/header.php';  ?>

<div class="main-content edit-profile">
<div class="main-content-inn col-three">
<div class="main-content-inn-left">
<div class="col-first">
<form method="post"  enctype="multipart/form-data">
<div class="edit-profile-hld">
<div class="edit-profile-left">
<div class="edit-pic usr-pro-img">
<img src="images/user_image02.jpg" alt="user image" />
</div>
<input type="file" name="file_img">
</div>
<div class="edit-info-sec">
<a href="#" class="edt-anc" onclick="edit_profile()">Edit</a>
<h2 class="p-hdng">Edit Profile</h2>
<div class="edit-row">
<div class="ed-l"><label>Pet Name</label></div>
<input type="text" class="ed-r"  name="name" value="<?php echo $row["pet_name"]?>" placeholder="Huge criss">
</div>
<div class="edit-row">
<div class="ed-l"><label>Owner name</label></div>
<input type="text" class="ed-r"  name="user_name" value="<?php echo $row["powner_name"]?>" placeholder="Owner name">
</div>
<div class="edit-row">
<div class="ed-l"><label>Type of pet</label></div>
<input type="text" class="ed-r"  name="type_of_pet" value="<?php echo $row["type_of_pet"]?>" placeholder="Type of pet">
</div>
<div class="edit-row">
<div class="ed-l"><label>E-mail</label></div>
<input type="text" class="ed-r"  name="email" value="<?php echo $row["email"]?>" placeholder="Email">
</div>
<div class="edit-row">
<div class="ed-l"><label>Phone</label></div>
<input type="text" class="ed-r"  name="phone" value="<?php echo $row["phone"]?>" placeholder="Phone">
</div>
<div class="edit-row">
<div class="ed-l"><label>Birthday</label></div>
<input type="text" class="ed-r"  name="birthday" value="<?php echo $row["dob"]?>" placeholder="Birthday">
</div>
<div class="edit-row">
<div class="ed-l"><label>Country</label></div>
<input type="text" class="ed-r"  name="country"  value="<?php echo $row["country"]?>" placeholder="Country">
</div>
<div class="save-btn">
<input type="submit" name="submit_data" value="Save">
</div>
</div>
</div>
</form>

</div>
<div class="col-second">
</div>
</div>
<div class="pro-right-sec">
<div class="sidebar">
<ul>
<li><a href="#"><span class="icn"><img src="images/create-grp-icon.png" alt="icon" /></span>Friend List</a></li>
<li><a href="#"><span class="icn"><img src="images/create-grp-icon.png" alt="icon" /></span>Friend Requests</a></li>
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

<?php require_once 'inc/footer.php';  ?>
</body>
</html>