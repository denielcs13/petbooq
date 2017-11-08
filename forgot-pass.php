<html>
<?php require_once 'inc/head-content.php';  ?>
<body>
<?php require_once 'inc/header.php';  ?>
<?php
        session_start();
        $error_name=$error_typepet=$error_date=$error_month=$error_year=$error_owner_name=$error_owner_email=$error_passwords=$error_country=$error_mobile="";
        if (isset($_POST['user_submit'])) {

            
            $owner_email = trim($_POST["owner_email"]);
         
            if(empty($pet_name))
            {
                $error_name = "Enter pet name";
            }
            if(empty($typepet))
            {
                $error_typepet = "Select pet type";
            }
            if(empty($date_of_birth))
            {
                $error_date = "Select date of birth";
            }
            if(empty($owner_name))
            {
                $error_owner_name = "Select owner name";
            }
            if(empty($owner_email))
            {
                $error_owner_email = "Enter email";
            }
            if(empty($passwords))
            {
                $error_passwords  = "Enter password";
            }
            if(empty($country))
            {
                $error_country = "Select country";
            }
           
            if(empty($mobile))
            {
                $error_mobile = "Enter mobile number";
            }
            else if(!empty ($pet_name) && !empty ($typepet) && !empty ($date_of_birth) && !empty ($owner_name) && !empty ($owner_email) && !empty ($passwords) && !empty ($country) && !empty ($mobile))
            {
                echo "Submit";
               
            $random_number = rand(1000, 9999);
//            $expireAfter = 2;
            $_SESSION['otp']  =$random_number;
            //require_once './dbconn.php';
               // $unique = "select(email) from otp_verfication where email ='" . $owner_email . "'";
                //$res = mysqli_query($conn, $unique);
                //if (mysqli_num_rows($res) == 1) {
                   // echo "Already exist";
               // } 
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
                            $_SESSION['pet_name'] = $pet_name;
                            $_SESSION['typepet']  = $typepet;
                            $_SESSION['dob'] = $date_of_birth;
                            $_SESSION['month']=$month;
                            $_SESSION['year'] = $year;
                            $_SESSION['owner_name'] = $owner_name;
                            $_SESSION['owner_email'] = $owner_email;
                            $_SESSION['password'] = $passwords;
                            $_SESSION['country'] = $country;
                            $_SESSION['mobile']= $mobile;
                            $_SESSION['otp']=$random_number;
                            header("Location:otp_verify.php");
                        }
                    }
                    else {
                        echo "Not insert data";
                        die;
                    }
           
        }
        }
      ?>

<div class="main-content">
<div class="main-content-inn col-three post-page">
<div class="main-content-inn-left main-content-full">
<div class="col-first">
<div class="stat-textarea post-f frgt-pass">
<form method="post" action="">
<div class="uplbtn-btm">
<h2>Find Your Account</h2>
<p style="margin-top:15px;margin-bottom:0px;">Please enter your email address or phone number to search for your account.</p>
<div class="upl-btm-text"><input type="text" name="owner_email" placeholder="Email address or phone number" /></div>
</div>
<div class="upload-btn uplbtn-top uplbtn-btm-t">
<div class="upload-btn-hld upload-btn-hld-top">
<input type="submit" class="fl-upld" value="Resend OTP"  />
<input type="submit" name="user_submit" class="fl-upld" value="Submit" />
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