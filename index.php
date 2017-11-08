<html>
<?php require_once 'inc/head-content.php';  ?>
<body>
<?php require_once 'inc/header.php';  ?>

<div class="main-content ">
<div class="main-content-inn ">
<div class="acc-sec-top">
<p>New to PetBootQ?</p>
<h1>Create a new account</h1>
<p>It's free and always will be.</p>
</div>

<div class="acc-sec-btm acc-sec-col">
<div class="acc-sign-top">
<div class="bl-top-acc">
<p class="lf">Pet Owner</p>
<a href="registration.php" class="sing-btn">sign in</a>
</div>

<div class="bl-top-acc">
<p class="lf">Non-Profit Orgnisation</p>
<a href="#" class="sing-btn">sign in</a>
</div>

<div class="bl-top-acc">
<p class="lf">Non-Profit Orgnisation</p>
<a href="#" class="sing-btn">sign in</a>
</div>

</div>
<div class="lgn-image-sec">
<?php
                                require './dbcon.php';
                                $image = "select * from uploadimages ORDER BY RAND() LIMIT 3";
                                $res = mysqli_query($conn, $image);
                                while ($row = mysqli_fetch_array($res)) {
                                    $dir = $row["uniqueid"] . "/Photos/" . $row["image_name"];
                                    ?>
                                    <div class="image">    <div class="tr-img-col"> <img src="<?php echo $dir; ?>" width="50" height="50"></div></div>
                                    <?php
                                }
                                ?>
</div>

<div class="lgn-txt-sec">
<div class="cont-btm-sec"><p>Sign Up Now, Share and enjoy your pet with others Give your pet, place of his own. </p></div>
<div class="cont-btm-sec"><p>If you have goods or sevices which can bring a 
change in the life of animals, Sign Up Now, Share  
with others </p></div>
<div class="cont-btm-sec"><p>If you are an non-profit orgnasation whose objective is to 
help animals, Sign Up Now, Share  with others</p></div>
</div>






</div>

</div>
</div>

</body>
</html>