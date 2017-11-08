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
$rno = $_SESSION["otp"];
$b_name=$_SESSION['bname'];
$b_cat=$_SESSION['bcat'];
$b_addr=$_SESSION['baddr'];
$b_state=$_SESSION['bstate'];
$b_city=$_SESSION['bcity'];
$b_zip=$_SESSION['bzip'];
$owner_email=$_SESSION['owner_email'];
$b_pass=$_SESSION['bpass'];
$b_phone=$_SESSION['bphone'];
$random_number=$_SESSION['otp'];
$rannum=rand(11111,99999);
$ran=$rannum;

//$_SESSION['otp']=$random_number;
require_once './dbconn.php';
if (isset($_POST['verify'])) {
    $otp_verify = $_POST["otp"];
    $result = "select otp,createdOn from otp_verfication where otp='$otp_verify'";
    $query = mysqli_query($conn, $result);
    if (mysqli_num_rows($query) == 1) {
        
        $qu="insert into tbl_local_business(`id`,`page_name`,`page_category`,`address`,`state`,`city`,`zip_code`,`email`,`password`,`phone_number`,`otp`,`local_unique_id`)values('null','$b_name','$b_cat','$b_addr','$b_state','$b_city','$b_zip','$owner_email','$b_pass','$b_phone','$rno',1)";
    $sqll=mysqli_query($conn,$qu);
    mkdir("$ran"."/Photos",0777,true);
    mkdir("$ran"."/Videos",0777,true);
    mkdir("$ran"."/Shared_Videos",0777,true);
    echo "Registration Successful!";
    }
    else 
    {
        echo "Wrong otp";
        die;
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

