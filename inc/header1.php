<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include("dbcon.php");
session_start();
if (isset($_POST['login'])) {
    $myusername = mysqli_real_escape_string($conn, $_POST['email']);
    //$mypassword = mysqli_real_escape_string($conn,$_POST['password']); 
    //$dec_password=md5(utf8_encode($mypassword));
    //$sql = "select * from user_inf where email = '$myusername' and password = '$dec_password'";
    $sql = "select * from user_inf where email = '$myusername'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        $_SESSION['login_user'] = $myusername;
        $_SESSION['pet_unique_id'] = $row['pet_unique_id'];
        $_SESSION['pet_name'] = $row['pet_name'];
        $_SESSION['dob'] = $row['dob'];
        $_SESSION['powner_name'] = $row['powner_name'];
        $_SESSION['profile_pic'] = $row['profile_pic'];
        echo "<script>window.location='profile-page.php'</script>";
    } else {
        echo "<script>alert('Your email id or password not match')</script>";
        echo "<script>woindow.location='index.php'</script>";
    }
}
?>


<div class="header">
    <div class="header-inn">
        <div class="header-left">
            <div class="logo"><a href="index.php"><img src="images/logo.png" alt="logo" /></a></div>
            <div class="search">
                <input type="" placeholder="Search..."></input>
            </div>
        </div>
        <div class="header-right">
            <form action="" method="post">
<?php if (!isset($_SESSION['login_user'])) { ?>
                    <div class="al-j"><a href="#">Already joined?</a></div>
                    <div class="hdr-in-b">
                        <input type="text" name="email" placeholder="Email" />
                        <input type="password" placeholder="Password" />
                        <button type="submit" name="login">Log In</button>
                        <a href="#" class="f-p">Forgot Password</a>
    <?php
} elseif (isset($_SESSION['login_user'])) {
    echo "<h2 class='wel-t'>Welcome   " . $_SESSION['login_user'] . "</h2><a href='user-log-out.php' class='sign-o'>Sign Out</a>";
    echo "<a href ='profile-page.php'  class='hdr-post-anc'>Post</a>";
}
?>
                </div>
            </form>
        </div>



    </div>
</div>