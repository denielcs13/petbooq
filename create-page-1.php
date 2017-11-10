<?php
session_start();
  if(!(isset($_SESSION['pet_unique_id']))) {
    header('Location:index.php');
  }
  ?>
<html>
<?php require_once 'inc/head-content.php';  ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="feather/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
  <link type="text/css" rel="stylesheet" href="feather/featherlight.min.css" />
<body>
<?php require_once 'inc/header_11.php';  ?>
<div class="main-content">
<div class="main-content-inn col-three main-content-full usr-feed-page usr-feed-page-nw create-new-page">
<div class="col-first-side">
  <?php
        if (isset($_POST["submit"])) 
        {
        $parent_id = $_SESSION['pet_unique_id'];
        //$p_type = $_POST["p_type"];
        $p_name = $_POST["p_name"];            
        $desc = $_POST["desc"];
        $web_name = $_POST["web_name"];
        $c_name= $_POST["c_name"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $phone = $_POST["phone"];
        $position = $_POST["position"];
        //$group_id= rand(222222, 9999999);
        //$ran = $group_id;  
        //print_r($_POST);die;
        require_once './dbcon.php';
                $q = "select * from pages where user_id_fk ='" . $parent_id . "'";
                $res = mysqli_query($conn, $q);
                //print_r($res);
                $group_info=mysqli_fetch_assoc($res);
                if($group_info['pages']=="$p_name")
                    {
    echo "<script>alert('Page Already Exist')</script>";             
                                                         
                    }
 else {
        require './dbcon.php';
        
        $insert = "INSERT INTO pages( page_name,page_desc,website,country_name,f_name,l_name,phone_num,position,user_id_fk,status) 
VALUES ('$p_name','$desc','$web_name','$c_name','$fname','$lname','$phone','$position','$parent_id','1')";
//print_r($insert);die;
if ($conn->query($insert) === TRUE) {
    $last_id = $conn->insert_id;
    echo $last_id;
    $_SESSION['name']= $p_name;
    $_SESSION['last_id']=$last_id;
    //print_r($_SESSION);die;
}
        $insert1="INSERT INTO page_users
(page_id_fk,user_id_fk,status) 
VALUES 
('$last_id','$parent_id','1')";
                                   mkdir($parent_id . "/Pages/".$p_name."/Photos", 0777, true);
                                   mkdir($parent_id . "/Pages/".$p_name."/Videos", 0777, true);
                                   mkdir($parent_id . "/Pages/".$p_name."/Shared_Videos", 0777, true);
                                   mkdir($parent_id . "/Pages/".$p_name."/post_images", 0777, true);
                                   mkdir($parent_id . "/Pages/".$p_name."/profile_pic", 0777, true);
           // print_r($insert);die;
            //$sqll=mysqli_query($conn, $insert);
            $sqll2=mysqli_query($conn, $insert1);
            //print_r($sqll);die;
            if ($sqll2>0) {            
               
                echo "<script>alert('Page created Successfully')</script>";
                echo "<script>window.location='pages.php'</script>";
            }
            else{
      echo "<script>alert('Page not created')</script>";
      
      }
        }
        }
        ?>
    <?php
         $parent_id = $_SESSION['pet_unique_id'];
        $profileqry=mysqli_query($conn,"SELECT * FROM user_inf WHERE pet_unique_id='$parent_id'");
        $profileinfo=mysqli_fetch_assoc($profileqry);
        
        ?>
<div class="pro-pic-sec">
<div class="pht"><?php if($profileinfo['profile_pic']=="") {
              echo "<img src='images/fr-pro-big-img.jpg'>";
              }
              else {
              ?>
              <img src="<?= $profileinfo['profile_pic'] ?>" alt="user image" />
              <?php } ?></div>
<div class="pet-info">
<p>Name: <?= $profileinfo['pet_name']; ?></p>
<p>DOB: <?= $profileinfo['dob']; ?></p>
</div>
<div class="pet-info">
<p>Owner: <?= $profileinfo['powner_name']; ?></p>
</div>
</div>

<script>

$(document).ready(function() {
    $(".cate-hld a").click(function(){
        $("this").addClass("select").siblings().removeClass("select");   
    });
});

/*$('.cate-hld a').on('click', 'a', function(){
    $('.cate-hld a').removeClass('active');
    $(this).addClass('active');
});*/
</script>

<div class="pro-right-sec">
<div class="sidebar">
<ul>
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

<div class="main-content-inn-left products gallery">
<div class="col-first">

<div class="stat-textarea post-f">

<div class="uplbtn-btm">
<div id="tabs">

<div class="sel-cat">
	<ul class="sel-tbs">
    <li><a href="#tabs-1"><input type="radio" name="p_type" /><label>I am a Professional</label></a></li>
    <li><a href="#tabs-2"><input type="radio" name="c_type" /><label>Charity</label></a></li>
  </ul>
  </div>
  <div id="tabs-1">
    <p><div class="form-row">
<div class="cate-hld">
<ul>
<li><a href="#" class="">
<div class="icon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></div>
<div class="c-nm">Shop</div>
</a></li>

<li><a href="#" class="">
<div class="icon"><i class="fa fa-shopping-bag" aria-hidden="true"></i></div>
<div class="c-nm">Brand / Product</div>
</a></li>

<li><a href="#" class="">
<div class="icon"><i class="fa fa-stethoscope" aria-hidden="true"></i></div>
<div class="c-nm">Medical service</div>
</a></li>

<li><a href="#" class="">
<div class="icon"><i class="fa fa-paw" aria-hidden="true"></i></div>
<div class="c-nm">Animal service</div>
</a></li>

<li><a href="#" class="">
<div class="icon"><i class="fa fa-share" aria-hidden="true"></i></div>
<div class="c-nm">Other</div>
</a></li>

</ul>
</div>
</div></p>
  </div>
  <div id="tabs-2">
    <p><div class="form-row">
<div class="cate-hld">
<ul>
<li><a href="#" class="">
<div class="icon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></div>
<div class="c-nm">Shop</div>
</a></li>

<li><a href="#" class="">
<div class="icon"><i class="fa fa-shopping-bag" aria-hidden="true"></i></div>
<div class="c-nm">Brand / Product</div>
</a></li>

<li><a href="#" class="">
<div class="icon"><i class="fa fa-stethoscope" aria-hidden="true"></i></div>
<div class="c-nm">Medical service</div>
</a></li>

<li><a href="#" class="">
<div class="icon"><i class="fa fa-share" aria-hidden="true"></i></div>
<div class="c-nm">Other</div>
</a></li>

</ul>
</div>
</div></p>
  </div>
  
</div>


<div class="cr-form">
<div class="reg-form-sec">
<form method="post" action="">
<div class="pt-dt">
<div class="form-row">
<label>Page name</label>
<input type="text" name="p_name" placeholder="Page name" />
</div>
<div class="form-row">
<label>Description</label>
<textarea name="desc" placeholder="Description"></textarea>
</div>
<div class="form-row">
<label>Website</label>
<input type="text" name="web_name" placeholder="http://"/>
</div>
<div class="form-row">
<label>Country</label>
<select class="d-sml" name="c_name" required>
<option value="" >Select a country</option>
<option value="Afghanistan" >Afghanistan</option>
<option value="Albania" >Albania</option>
<option value="Aland Islands" >Aland Islands</option>
<option value="Aruba" >Aruba</option>
<option value="Afghanistan" >Afghanistan</option>
<option value="Albania" >Albania</option>
<option value="Aland Islands" >Aland Islands</option>
<option value="Aruba" >Aruba</option>
</select>
</div>
<div class="form-row">
<label>First name</label>
<input type="text" name="fname" placeholder="First name" />
</div>
<div class="form-row">
<label>Last name</label>
<input type="text" name="lname" placeholder="Last name" />
</div>
<div class="form-row">
<label>Phone number</label>
<input type="text" name="phone" placeholder="Phone Number" />
</div>
<div class="form-row">
<label>Position</label>
<input type="text" name="position" placeholder="Position"/>
</div>
</div>
    <div class="sub-btn"><input type="submit"  name="submit" value="Create" /></div>
</form>
</div>
</div>
</div>
</div>


<div class="col-third   animated fadeInRight">
<div class="ltst-arc">
                        <div class="ads-arc">
                            <h2>Sponsored Ads</h2>
                            <?php
                            require './dbcon.php';
                            $display_banner = "select * from ads ORDER BY RAND() LIMIT 3";
                            $results = mysqli_query($conn, $display_banner);
                            while ($row = mysqli_fetch_array($results)) {
                                $description = $row["description"];
                                ?>
                                <div class="post-row">
                                    <div class="post-rw-hld">
                                        <div class="post-img"><img src="<?php echo $row["banner_image"] ?>" alt=""></div>
                                        <div class="post-content">
                                            <h2><p class="user-nm"><a href="#"><?php echo $row["heading"] ?></a></p></h2>
                                            <p class="pst-text"><?php echo substr($description, 0, 100) ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                           
                        </div>
                        </div>
</div>
</div>



</div>
</div>

<script>
/*$(".cate-hld a").click(function(){
    $("cate-hld a.select").hide();
});

$(".cate-hld a").click(function(){
    $("cate-hld a.select").show();
	$("cate-hld a.select").css("background-color", "yellow");
}); */

$(document).ready(function() {
    $(".cate-hld a").click(function(){
        $("this").addClass("select").siblings().removeClass("select");   
    });
});
/*$('.cate-hld a').on('click', 'a', function(){
    $('.cate-hld a').removeClass('active');
    $(this).addClass('active');
});*/
</script>





<?php require_once 'inc/footer.php';  ?>
</body>
</html>
