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
require_once './dbconn.php';
if (isset($_POST['verify'])) {
    $otp_verify = $_POST["otp"];
    $result = "select otp,createdOn from otp_verfication where otp='$otp_verify'";
    $query = mysqli_query($conn, $result);
    if (mysqli_num_rows($query) == 1) {
        
        $qu="insert into tbl_petdetails_registration(`id`,`pet_name`,`type_of_pet`,`dob`,`powner_name`,`email`,`password`,`country`,`phone`,`otp`,`pet_unique_id`)values('null','$pet_name','$typepet','$date_of_birth','$owner_name','$owner_email','$passwords','$country','$mobile','$rno',1)";
    $sqll=mysqli_query($conn,$qu);
	mkdir("$ran"."/Photos",0777,true);
	mkdir("$ran"."/Videos",0777,true);
	mkdir("$ran"."/Shared_Videos",0777,true);
     echo "Corect otp";
    }
    else 
    {
        echo "Wrong otp";
        die;
    }
}
?>

<form method="post" action="#">
    <input type="text" name="otp">
    <input type="submit" value="submit" name="verify">
</form>

