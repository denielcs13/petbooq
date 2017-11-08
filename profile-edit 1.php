<html>
    <?php
    session_start();
    $alrt='';
    $id = $_SESSION["pet_unique_id"];
    if (isset($_POST["file"])) {
        $image_name =$_FILES['file']['name'];
	$image_type=$_FILES['file']['type'];
	$image_size=$_FILES['file']['size'];
	$image_tmpname=$_FILES['file']['tmp_name'];
        $target_path = $id . "/profile_pic/" . basename($_FILES['file']['name']);
        if($image_type=='application/msword' or $image_type=='application/vnd.openxmlformats-officedocument.wordprocessingml.document' or $image_type=='application/pdf' or $image_type=='image/png' or $image_type=='image/jpeg' or $image_type=='image/jpg' or $image_type=='application/msword'){
		move_uploaded_file($image_tmpname,$target_path);
                $target_path = $id . "/profile_pic/" . basename($_FILES['file']['name']);
		}
                //else{
			
		//	echo "<script>alert('uploade file formate not supported')</script>";
		//	}
        
            require './dbcon.php';
            $insert = "update  user_inf set  profile_pic = '$target_path' where pet_unique_id = $id";
           // print_r($insert);die;
            $sqll=mysqli_query($conn, $insert);
            //print_r($sqll);die;
            if ($sqll>0) {
               $alrt= "Your record Updated Successfully";
            }
            else{
			echo "<script>alert('Record not updated')</script>";
			
			}
        }
        if (isset($_POST["submit_data"])) {
        $name = $_POST["name"];
        $user_name = $_POST["user_name"];
        $type_of_pet = $_POST["type_of_pet"];
        $email = $_POST["email"];
        $address = $_POST["phone"];
        $birthday = $_POST["birthday"];
        $country = $_POST["country"];        
            require './dbcon.php';
            $insert = "update  user_inf set pet_name = '$name',type_of_pet = '$type_of_pet',dob ='$birthday',powner_name='$user_name',email='$email',country='$country',phone='$address',
        updateOn=NOW() where pet_unique_id = $id";
           // print_r($insert);die;
            $sqll=mysqli_query($conn, $insert);
            //print_r($sqll);die;
            if ($sqll>0) {
               $alrt= "Your record Updated Successfully";
            }
            else{
			echo "<script>alert('Record not updated')</script>";
			
			}
        }
    
    ?>
    <?php require_once 'inc/head-content.php'; ?>
    <body>
    <?php require_once 'inc/header.php'; ?>

        <div class="main-content edit-profile">
            <div class="main-content-inn col-three">
                <div class="main-content-inn-left">
        <?php
        require 'dbcon.php';
       $results_display = mysqli_query($conn, "select * from user_inf where pet_unique_id = '$id'");
        $profileinfo = mysqli_fetch_assoc($results_display);

        ?>
                    <div class="col-first">
                        
                            <div class="edit-profile-hld">
                               <form method="post"  enctype="multipart/form-data">
                                <div class="edit-profile-left">
                                    <div class="edit-pic usr-pro-img">
<!--                                        <img src="images/user_image02.jpg" alt="user image" />-->
<!--                                        <img src="<?php// echo $profileinfo["profile_pic"] ?>" alt="user image" />-->
                                        
                                        <?php if($profileinfo['profile_pic']=="") {
							echo "<img src='images/fr-pro-big-img.jpg'>";
							}
							else {
							?>
							<img src="<?= $profileinfo['profile_pic'] ?>" alt="user image" />
							<?php } ?>
                                    </div>
                                    <div class="edit-pic-upl">
                                    <div class="edit-pic-in">
                                    <input type="file" name="file" >
                                    <input type="submit" name="file" value="Upload Photo"> 
                                    </div>
                                    </div>
                                </div>
                            </form>
                                <form method="post"  enctype="multipart/form-data">
                                <div class="edit-profile-left">
                                    <div class="edit-pic usr-pro-img">
<!--                                        <img src="images/user_image02.jpg" alt="user image" />-->
<!--                                        <img src="<?php// echo $profileinfo["profile_pic"] ?>" alt="user image" />-->
                                        
                                        <?php if($profileinfo['profile_pic']=="") {
							echo "<img src='images/fr-pro-big-img.jpg'>";
							}
							else {
							?>
							<img src="<?= $profileinfo['profile_pic'] ?>" alt="user image" />
							<?php } ?>
                                    </div>
                                    <div class="edit-pic-upl">
                                    <div class="edit-pic-in">
                                    <input type="file" name="file" >
                                    <input type="submit" name="file" value="Upload Photo"> 
                                    </div>
                                    </div>
                                </div>
                            </form>
                                <form method="post" action="">
                                <div class="edit-info-sec">
                                    <!-- <a href="#" class="edt-anc" onclick="edit_profile()">Edit</a> -->
                                   
                                    <h2 class="p-hdng">Edit Profile <span class="su-msg"><center><?php print_r($alrt) ;?></center></span></h2>
                                    
                                    <div class="edit-row">
                                        <div class="ed-l"><label>Pet Name</label></div>
                                        <input type="text" class="ed-r"  name="name" value="<?php echo $profileinfo["pet_name"] ?>" placeholder="Huge criss">
                                    </div>
                                    <div class="edit-row">
                                        <div class="ed-l"><label>Owner name</label></div>
                                        <input type="text" class="ed-r"  name="user_name" value="<?php echo $profileinfo["powner_name"] ?>" placeholder="Owner name">
                                    </div>
                                    <div class="edit-row">
                                        <div class="ed-l"><label>Type of pet</label></div>
                                        <input type="text" class="ed-r"  name="type_of_pet" value="<?php echo $profileinfo["type_of_pet"] ?>" placeholder="Type of pet">
                                    </div>
                                    <div class="edit-row">
                                        <div class="ed-l"><label>E-mail</label></div>
                                        <input type="text" class="ed-r"  name="email" value="<?php echo $profileinfo["email"] ?>" placeholder="Email">
                                    </div>
                                    <div class="edit-row">
                                        <div class="ed-l"><label>Phone</label></div>
                                        <input type="text" class="ed-r"  name="phone" value="<?php echo $profileinfo["phone"] ?>" placeholder="Phone">
                                    </div>
                                    <div class="edit-row">
                                        <div class="ed-l"><label>Birthday</label></div>
                                        <input type="text" class="ed-r"  name="birthday" value="<?php echo $profileinfo["dob"] ?>" placeholder="Birthday">
                                    </div>
                                    <div class="edit-row">
                                        <div class="ed-l"><label>Country</label></div>
                                        <input type="text" class="ed-r"  name="country"  value="<?php echo $profileinfo["country"] ?>" placeholder="Country">
                                    </div>
                                    <div class="save-btn">
                                        <input type="submit" name="submit_data" value="Save">
                                    </div>
                                </div>
                           </form>     
                            </div>

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

<?php require_once 'inc/footer.php'; ?>
    </body>
</html>