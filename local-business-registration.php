<html>
<?php require_once 'inc/head-content.php';  ?>
<body>
<?php require_once 'inc/header.php';  ?>
<?php
        session_start();
        $error_name=$error_typepet=$error_date=$error_month=$error_year=$error_owner_name=$error_owner_email=$error_passwords=$error_country=$error_mobile="";
        if (isset($_POST['busi_submit'])) {

            $b_name = trim($_POST["bname"]);
            $b_cat = trim($_POST["bcat"]);
            $b_addr = trim($_POST["baddr"]);
            $b_state = trim($_POST["bstate"]);
            $b_city = trim($_POST["bcity"]);
            $b_zip = trim($_POST["bzip"]);
            $b_email = trim($_POST["owner_email"]);
            $b_pass = trim(md5($_POST["bpass"]));
            $b_phone = trim($_POST["bphone"]);
            if(empty($b_name))
            {
                $error_name = "Enter Business name";
            }
            if(empty($b_cat))
            {
                $error_typepet = "Enter Business Category";
            }
            if(empty($b_addr))
            {
                $error_date = "Enter Business Address";
            }
            if(empty($b_state))
            {
                $error_state_name = "Enter State";
            }
            if(empty($b_city))
            {
                $error_city_name = "Enter City";
            }
            if(empty($b_zip))
            {
                $error_zip_code = "Enter Zip Code";
            }
            if(empty($owner_email))
            {
                $error_owner_email = "Enter email";
            }
            
            if(empty($passwords))
            {
                $error_passwords  = "Enter password";
            }
            
           
            if(empty($b_phone))
            {
                $error_mobile = "Enter mobile number";
            }
            else if(!empty ($b_name) && !empty ($b_cat) && !empty ($b_addr) && !empty ($b_city) && !empty ($b_zip) && !empty ($owner_email) && !empty ($b_pass) && !empty ($b_phone))
            {
                echo "Submit";
               
            $random_number = rand(1000, 9999);
//            $expireAfter = 2;
            $_SESSION['otp']  =$random_number;
            require_once './dbconn.php';
                $unique = "select(email) from otp_verfication where email ='" . $owner_email . "'";
                $res = mysqli_query($conn, $unique);
                if (mysqli_num_rows($res) == 1) {
                    echo "Already exist";
                } 
//                if(isset($_SESSION['otp']))
//                {
//                    
//                    $secondsession = time() - $_SESSION['otp'];
////                    convert minutes into secound
//                    
//                    $expireAfterSeconds = $expireAfter * 60;
//                    print_r($expireAfterSeconds);die;
//                    if($secondsession>$expireAfterSeconds)
//                    {
//                        session_unset();
//                        session_destroy();
//                    }
//                }
                else {
                    require 'PHPMailer/PHPMailerAutoload.php';
                    $_SESSION['random_numbers'] = $random_number;
                    require_once './dbconn.php';
                    $otp_verification = "Insert into otp_verfication (otp,email,createdOn) value (" . $_SESSION['random_numbers'] . ",'$owner_email',NOW())";
                    if (mysqli_query($conn, $otp_verification)) {
                        echo "New record insert sucessfully";
                        $suecss = "New record insert sucessfully";
                        require_once('PHPMailer/PHPMailerAutoload.php');
                        $mail = new PHPMailer;
                        $mail->isSMTP();                            // Set mailer to use SMTP
                        $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
                        $mail->SMTPAuth = true;                     // Enable SMTP authentication
                        $mail->Username = 'md.monish@gmail.com';          // SMTP username
                        $mail->Password = 'Monish@1'; // SMTP password
                        $mail->SMTPSecure = 'ssl';
                        $mail->Port = 465;
                        $mail->setFrom('md.monish@gmail.com', 'PetbooQ');
                        $mail->addReplyTo('md.monish@gmail.com', 'PetbooQ');
                        $mail->addAddress($owner_email);   // Add a recipient
                        $mail->isHTML(true);  // Set email format to HTML
                        $bodyContent = '<h1>Welcome to PetbooQ you OTP</h1>' . $_SESSION['random_numbers'];
//                        $bodyContent .= '<p>This is the HTML email sent from localhost using PHP script by <b>CodexWorld</b></p>';
                        $mail->Subject = 'One time paswword verification';
                        $mail->Body = $bodyContent;
                        if (!$mail->send()) {
                            echo 'Message could not be sent.';
                            echo 'Mailer Error: ' . $mail->ErrorInfo;
                        }
                        else {
                            echo 'Message has been sent';
                            $_SESSION['bname'] = $b_name;
                            $_SESSION['bcat']  = $b_cat;
                            $_SESSION['baddr'] = $b_addr;
                            $_SESSION['bstate']=$b_state;
                            $_SESSION['bcity'] = $b_city;
                            $_SESSION['bzip'] = $b_zip;
                            $_SESSION['owner_email'] = $owner_email;
                            $_SESSION['bpass'] = $b_pass;
                            $_SESSION['bphone']= $b_phone;
                            $_SESSION['otp']=$random_number;
                            header("Location:business-otp-verification.php");
                        }
                    }
                    else {
                        echo "Not insert data";
                        die;
                    }
                }
           
        }
        }
      ?>

<div class="main-content">
<div class="main-content-inn">
<div class="reg-left-sec">
<div class="reg-left-top">
<h2>Trending Images</h2>
<div class="tr-img">
<div class="tr-img-col"><div class="image"></div></div>
<div class="tr-img-col"><div class="image"></div></div>
<div class="tr-img-col"><div class="image"></div></div>
</div>

<div class="tr-video">
<h2>Trending Video</h2>
<div class="tr-vd-col"><div class="vdo"><img src="images/video-btm-img.png" alt="" class="vd-l"  /></div></div>
</div>

<div class="tr-news">
<h2>Trending Information and News</h2>
<div class="tr-news-col first"><div class="news"></div></div>
<div class="tr-news-col"><div class="news"></div></div>
<div class="tr-news-col last"><div class="news"></div></div>
</div>
</div>
</div>


<div class="reg-right-sec">
<div class="acc-sec-top">
<p>Have a Business?</p>
<h1>Create a new account</h1>
<p>It's free and always will be.</p>
</div>
<div class="reg-form-sec">
<form action="" method="post">
<div class="pt-dt">
<input type="text" name="bname" id="bname" placeholder="Page Name"/>
<?php if(empty($_POST["bname"])){echo "<p style='color:red'>".$error_busi_name."</p>";}?>
<input type="text" id="bcat" name="bcat" placeholder="Page Category"/>
<?php if(empty($_POST["bcat"])){echo "<p style='color:red'>".$error_cat_name."</p>";}?>
<input type="text" id="baddr" name="baddr" placeholder="Address"/>
<?php if(empty($_POST["baddr"])){echo "<p style='color:red'>".$error_add_name."</p>";}?>
<input type="text" id="bstate" name="bstate" placeholder="State"/>
<?php if(empty($_POST["bstate"])){echo "<p style='color:red'>".$error_state_name."</p>";}?>
<input type="text" id="bcity" name="bcity" placeholder="City"/>
<?php if(empty($_POST["bcity"])){echo "<p style='color:red'>".$error_city_name."</p>";}?>
<input type="text" id="bzip" name="bzip" placeholder="Zip Code"/>
<?php if(empty($_POST["bzip"])){echo "<p style='color:red'>".$error_zip_code."</p>";}?>
</div>
<div class="usr-dt">
<input type="text" id="owner_email" name="owner_email" placeholder="Email"/>
<?php if(empty($_POST["owner_email"])){echo "<p style='color:red'>".$error_owner_email."</p>";}?>
<small>Please Enter Your Correct Email, This will be used for login</small>
<input type="password" id="bpass" name="bpass" placeholder="Password"/>
<?php if(empty($_POST["bpass"])){echo "<p style='color:red'>".$error_busi_pass."</p>";}?>
<div class="form-row">
<label>Phone No.</label> 
<div class="fld-r phn">
<input type="text" placeholder="" value="+91" class="sml"/>
<input type="text" id="bphone" name="bphone" placeholder="No." class="mid"/>
<?php if(empty($_POST["bphone"])){echo "<p style='color:red'>".$error_busi_phone."</p>";}?>
</div>
<small>OTP will be sent to the registerd mobile number </small>
</div>
</div>

<div class="dic-inf">
<p>By clicking Create Account, you agree to our Terms and confirm that you have read our Data Policy, including our Cookie Use Policy. You may receive SMS message notifications from Facebook and can opt out at any time.</p>
</div>

<div class="sub-btn"><input type="submit" name="busi_submit" value="Create Account" /></div>

</form>
<script type="text/javascript">
                            function validate()
                            {
                              var petname = document.getElementById("bname");
                              if(petname.value=="")
                              {
                                  alert("Enter Business name");
                                  return false;
                              }
                              var type_pet = document.getElementById("bcat");
                              if(type_pet.value=="")
                              {
                                  alert("Enter Business Category");
                                  return false;
                              }
                              var dob = document.getElementById("baddr");
                              if(dob.value=="")
                              {
                                  alert("Enter Business Address");
                                  return false;
                              }
                              var month = document.getElementById("bstate");
                              if(month.value=="")
                              {
                                  alert("Enter State Name");
                                  return false;
                              }
                              var year = document.getElementById("bcity");
                              if(year.value=="")
                              {
                                  alert("Enter City");
                                  return false;
                              }
                              var year = document.getElementById("bzip");
                              if(year.value=="")
                              {
                                  alert("Enter Zip Code");
                                  return false;
                              }
                              
                              
                              var owner_email = document.getElementById("owner_email");
                              if(owner_email.value=="")
                              {
                                  alert("Enter Business email");
                                  return false;
                              }
                              var passwords = document.getElementById("bpass");
                              if(passwords.value=="")
                              {
                                  alert("Enter password");
                                  return false;
                              }
                              
                              
                              
                              
                              var mobile = document.getElementById("bphone");
                               if(mobile.value=="")
                              {
                                  alert("Enter Phone number");
                                  return false;
                              
                            }
                        </script>
</div>
</div>

</div>
</div>

</body>
</html>