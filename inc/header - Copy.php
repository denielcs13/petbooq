<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
if (isset($_POST["sub"])) {
    $users = $_POST["users"];
    require './dbcon.php';
    $query = "select * from user_inf where email = '".$users."'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        while ($row = mysqli_fetch_array($result)) {
            $_SESSION['login_user'] = $users;
            $_SESSION["pet_unique_id"] = $row["pet_unique_id"];
            $_SESSION["pet_name"]=$row["pet_name"];
            $_SESSION["dob"]=$row["dob"];
            $_SESSION["powner_name"]=$row["powner_name"];
            $_SESSION["profile_pic"]=$row["profile_pic"];
            
            header("Location:feed.php");
        }
    } 
    else {
        echo "You are not login";
    }
}
?>

<script type="text/javascript">
   $(function () {

// Initialize 
       $("#autocomplete").autocomplete({
           source: function (request, response) {
// Fetch data
               $.ajax({
                   url: "search.php",
                   type: 'post',
                   dataType: "json",
                   data: {
                       search: request.term
                   },
                   success: function (data) {
                       console.log(data);
                       response(data);
                   }
               });
           },
           select: function (event, ui) {
               var ide=ui.item.id;
         location.href="profile-load.php?id="+ide;
           $('#autocomplete').val(ui.item.label); // display the selected text
           $('#selectuser_id').val(ui.item.value.id); // save selected id to input
           return false;
           }
       });
   });
</script>

<div class="header">
    <div class="header-inn">
        <div class="header-left">
            <div class="logo"><a href="index.php"><img src="images/logo.png" alt="logo" /></a></div>
<!--            <div class="search">
                <input type="" placeholder="Search..."></input>
            </div>-->
        </div>
        <div class="header-right">
            <form action="" method="post">
<?php if (!isset($_SESSION['login_user'])) { ?>
                    <div class="al-j"><a href="#">Already joined?</a></div>
                    <div class="hdr-in-b">
                        <input type="text" name="users" placeholder="Email">
                        <input type="password" placeholder="Password" />
                        <button type="submit" name="sub">Log In</button>
                        <a href="#" class="f-p">Forgot Password</a>
    <?php
} elseif (isset($_SESSION['login_user'])) {
    echo "<input type='text' id='autocomplete' name='search' placeholder='Search here... ' class='search_lft' />";
    //echo "<a href='profile-page.php' class='profile-img-icon'><img class='profile-img' src='".$_SESSION['profile_pic']."' width='50px' height:50px style='border-radius:35px'><span>".$_SESSION['pet_name']."</span></a>";
    echo "<a href ='feed.php'  class='hdr-post-anc'>Home</a>";
    echo "<a href='user-log-out.php' class='sign-o'>Sign Out</a>";
    
}
?>
                </div>
            </form>
        </div>
    </div>
</div>
