<html>
    <?php require_once 'inc/head-content.php'; ?>
    <body>
        <?php require_once 'inc/header.php'; ?>

        <div class="main-content">
            <div class="main-content-inn col-three post-page">
                <div class="main-content-inn-left main-content-full">
                    <div class="col-first">
                        <div class="stat-textarea post-f frgt-pass">


                            <?php
                            session_start();
                            print_r($_SESSION['otp']);
                            $pet = $_SESSION["pet_name"];
                            $rno = $_SESSION["otp"];
                            $pet_name = $_SESSION['pet_name'];
                            $typepet = $_SESSION['typepet'];
                            $date_of_birth = $_SESSION['dob'];
                            $month = $_SESSION['month'];
                            $year = $_SESSION['year'];
                            $owner_name = $_SESSION['owner_name'];
                            $owner_email = $_SESSION['owner_email'];
                            $passwords = $_SESSION['password'];
                            $country = $_SESSION['country'];
                            $mobile = $_SESSION['mobile'];
                            $rannum = rand(11111, 99999);
                            $ran = $rannum;

                            require_once './dbcon.php';

                            if (isset($_POST['verify'])) {
                                $otp_verify = $_POST["otp"];
                                $result = "select otp,createdOn from otp_verfication where otp='$otp_verify'";
                                $query = mysqli_query($conn, $result);
                                if (mysqli_num_rows($query) == 1) {
                                   
                                    while ($row = mysqli_fetch_assoc($query)) {
                                        $_SESSION["timeexpire"] = $row["createdOn"]; //database insert time
                                        $hourcreated = strtotime($_SESSION["timeexpire"]);
                                        $createdHour = date('H', $hourcreated);
                                        $convertedTime = date('H', strtotime('+24 hour', strtotime($_SESSION["timeexpire"])));
                                        $timezone_offset_minutes = 330;  // $_GET['timezone_offset_minutes']
                                        $timezone_name = timezone_name_from_abbr("", $timezone_offset_minutes * 60, false);
                                        date_default_timezone_set($timezone_name);
                                        $newdate = strtotime(date('H:i:s'));
                                        $cueerntTime = date('H');
                                       
                                        $new = $cueerntTime - $convertedTime;
                                         print_r($new);
                                        if ($new > 5) {
                                            echo "Expire OTP";
                                        } else {
                                            echo "Valid OTP";
                                            header("Location:registration.php");
                                        }
                                    }
                                } 
                                else {
                                    echo "Wrong otp";
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
        <?php //require_once 'inc/footer.php';    ?>
    </body>
</html>