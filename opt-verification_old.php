<html>
<?php require_once 'inc/head-content.php';  ?>
<body>
<?php require_once 'inc/header.php';  ?>

<div class="main-content">
<div class="main-content-inn col-three post-page">
<div class="main-content-inn-left main-content-full">
<div class="col-first">
<div class="stat-textarea post-f frgt-pass">


<?php
session_start();
$pet = $_SESSION["pet_name"];
$rno = $_SESSION["otp"];
$pet_name=$_SESSION['pet_name'];
$typepet=$_SESSION['typepet'];
$date_of_birth=$_SESSION['dob'];
$month=$_SESSION['month'];
$year=$_SESSION['year'];
$owner_name=$_SESSION['owner_name'];
$owner_email=$_SESSION['owner_email'];
$passwords=$_SESSION['password'];
$country=$_SESSION['country'];
$mobile=$_SESSION['mobile'];
$rannum=rand(11111,99999);
$ran=$rannum;

//$_SESSION['otp']=$random_number;
require_once './dbcon.php';
if (isset($_POST['verify'])) {
    $otp_verify = $_POST["otp"];
    $result = "select otp,createdOn from otp_verfication where otp='$otp_verify'";
    $query = mysqli_query($conn, $result);
    if (mysqli_num_rows($query) == 1) {
        
        $qu="insert into user_inf(`id`,`pet_name`,`type_of_pet`,`dob`,`powner_name`,`email`,`password`,`country`,`phone`,`pet_unique_id`,`craetedOn`) values('null','$pet_name','$typepet','$date_of_birth,$month,$year','$owner_name','$owner_email','$passwords','$country','$mobile','$ran',NOW())";
    $sqll=mysqli_query($conn,$qu);
	mkdir("$ran"."/Photos",0777,true);
	mkdir("$ran"."/Videos",0777,true);
	mkdir("$ran"."/Shared_Videos",0777,true);
        mkdir("$ran"."/post_images",0777,true);
    echo "Registration Successful!";
    }
    else 
    {
        echo "<p>Wrong OTP</p>";
        
    }
}
?>
<form method="post" action="">
<div class="uplbtn-btm">
<h2>OPT Verification</h2>
<p style="margin-top:15px;margin-bottom:0px;">Please enter your OTP for verification.</p>
<div class="upl-btm-text"><input type="text" name="otp" placeholder="Please Enter your OTP" /></div>
</div>
<div class="upload-btn uplbtn-top uplbtn-btm-t">
<div class="upload-btn-hld upload-btn-hld-top">
<a href="forgot-pass.php" class="rs-anc">Resend OTP</a>
<input type="submit" class="fl-upld" name="verify" value="Submit" />
</div>
</div>
</form>

</div>
</div>
</div>

</div>
</div>



<?php //require_once 'inc/footer.php';  ?>
</body>
</html>