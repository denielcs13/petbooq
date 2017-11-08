<html>
    <?php require_once 'inc/head-content.php'; ?>
    <body>
        <?php require_once 'inc/header.php'; ?>
        <?php
       session_start();
print_r($_SESSION);
session_start();
if (isset($_POST["submit"])) {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $_SESSION["child_user_id"] = $_SESSION['pet_unique_id'];
    $id = $_SESSION["child_user_id"];
    require './dbcon.php';
    $query_insert = "INSERT INTO `post`(`child_post_id`, `posts`) VALUES ('$id','$description')";
    mysqli_query($conn, $query_insert);
    $_SESSION["child_user_id"];
//    header("Location:feed-page.php");
    echo "<script>alert('Post Updated Successfully !!!!')</script>";
}

        $parent_id = $_SESSION['pet_unique_id'];
        //print_r($parent_id);
        //echo '$parent_id';
//$child_id = $_SESSION["child_user_id"];
        require './dbcon.php';
        $display = "SELECT * FROM addfriends JOIN user_inf ON addfriends.child_id=user_inf.pet_unique_id JOIN post on post.child_post_id = addfriends.child_id WHERE addfriends.parent_id = '$parent_id'"; ///fetch data from database child id post comment
        $result = mysqli_query($conn, $display);
        if (mysqli_num_rows($result)) {
            ?>
            <div class="main-content">
                <div class="main-content-inn col-three main-content-full usr-feed-page">
                    <div class="main-content-inn-left">
                        <div class="col-first">
                            <div class="stat-textarea post-f">
                                <form method="post" id="postform">
                                <div class="uplbtn-btm">
                                    <h2 class="p-hdng">Share your new experience</h2>
                                    <div class="upl-btm-text"><input placeholder="Experience" type="text" name="title"  id ="heading"></div>
                                    <div class="upl-btm-text"><textarea placeholder="Share your pets" name = "description" id="description"></textarea></div>
                                </div>
                                <div class="upload-btn uplbtn-top uplbtn-btm-t">
                                    <div class="upload-btn-hld">
                                        <input placeholder="Type your URL" class="typ-t" type="text" name="addlink">
                                    </div>
                                    <div class="upload-btn-hld upload-btn-hld-top">
                                        <input value="upload" class="fl-img" type="file">
                                        <input class="fl-upld" value="upload" name="post_image" id="postimage"><a href="#" class="ad-m">+</a> <input value="Post" class="fl-subm" type="submit" name="submit" onclick="return submit()">
                                    </div>
                                </div>
                                </form>
                            </div>
                            <?php while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <div class="two-col-post">
                                    <div class="left">
                                        <div class="post-in-c">
                                            <div class="post-image">
                                                <a class="example-image-link" data-lightbox="example-1" data-title=" lorem ipsum is a filler text or greeking commonly used to demonstrate the textual" href="images/user_image08.jpg" data-lightbox="example-1">
                                                    <img class="example-image" src="<?php echo $id . "/post_images/" . $row["img_name"]?>" alt="image-1" />
                                                </a>

                                            </div>
                                            <div class="post-content">
                                                <h2><span class="user-icn-img"><img src="images/user-img-icon.png" alt="user image" /></span><p class="user-nm"><a href="#"><?php echo $row["pet_name"] . '-' . $row["child_id"] ?></a></p></h2>
                                                <p class="pst-text"><?php echo $row["posts"] ?><p>
                                                <p class="ttl-lks"><a href="#">435 likes</a></p>
                                            </div>
                                            <div class="post-act-btn">

                                                <div class="post-act-ins">
                                                    <a href="#" title="">like
                                                    </a><a href="#" title="">Comment</a>
                                                    <a href="#" title="">Share</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div> 
                                <?php
                            }
                        }
                        ?>
                    </div>

                    <div class="col-second">
                        <div class="fr-list">
                            <?php
session_start();
//print_r($_SESSION["pet_unique_id"]);die;
$id = $_SESSION["pet_unique_id"];
require './dbcon.php';
$display2="SELECT user_inf.pet_unique_id,user_inf.pet_name FROM addfriend JOIN user_inf ON addfriend.child_id=user_inf.pet_unique_id WHERE addfriend.parent_id=77777";
$show_result = mysqli_query($conn, $display2);
if (mysqli_num_rows($show_result)) {
//
            ?>
                            <h2 class="fr-headnig"><span class="user-icn-img"><a href="#">
                                        <img src="images/fr-li-icon.png" alt="user image"></a>
                                </span><p class="user-nm"><a href="#">Friend List</a></p></h2>
                                <?php while ($row = mysqli_fetch_assoc($show_result)) {
                                ?>
                            <div class="fr-li-cont">
                                <div class="fr-li-row">
                                    <div class="fr-t-l">
                                        <a href="#"><span class="user-icn-img"><img src="images/fr-img-icon.png" alt="user image"><span class="fr-nm"><?php echo $row["pet_name"] ?></span></span></a>
                                    </div>                                   
                                </div>                              
                            </div>
                             <?php
                            }
                        }
                        ?>
                            
                            
                        </div>

                        <div class="fr-list fr-req">
                            <h2 class="fr-headnig"><span class="user-icn-img"><a href="#">
                                        <img src="images/fr-req-icon.png" alt="user image"></a>
                                </span><p class="user-nm"><a href="#">Friend Request</a></p></h2>
                            <div class="fr-li-cont">
                                <div class="fr-li-row">
                                    <div class="fr-t-l">
                                        <a href="#"><span class="user-icn-img"><img src="images/fr-img-icon.png" alt="user image"><span class="fr-nm">Friend Name</span></span></a>
                                    </div>
                                    <div class="user-nm"><a href="#">Add Friend</a><a href="#" class="dlt">Delete</a></p></div>
                                </div>
                                <div class="fr-li-row">
                                    <div class="fr-t-l">
                                        <a href="#"><span class="user-icn-img"><img src="images/fr-img-icon.png" alt="user image"><span class="fr-nm">Friend Name</span></span></a>
                                    </div>
                                    <div class="user-nm"><a href="#">Add Friend</a><a href="#" class="dlt">Delete</a></p></div>
                                </div>
                                <div class="fr-li-row">
                                    <div class="fr-t-l">
                                        <a href="#"><span class="user-icn-img"><img src="images/fr-img-icon.png" alt="user image"><span class="fr-nm">Friend Name</span></span></a>
                                    </div>
                                    <div class="user-nm"><a href="#">Add Friend</a><a href="#" class="dlt">Delete</a></p></div>
                                </div>
                                <div class="fr-li-row">
                                    <div class="fr-t-l">
                                        <a href="#"><span class="user-icn-img"><img src="images/fr-img-icon.png" alt="user image"><span class="fr-nm">Friend Name</span></span></a>
                                    </div>
                                    <div class="user-nm"><a href="#">Add Friend</a><a href="#" class="dlt">Delete</a></p></div>
                                </div>
                            </div>
                        </div>

                        <div class="fr-list fr-sug">
                            <?php
session_start();
//print_r($_SESSION["pet_unique_id"]);die;
$id = $_SESSION["pet_unique_id"];
require './dbcon.php';
$display2 = "SELECT DISTINCT user_inf.pet_unique_id,user_inf.pet_name FROM addfriend JOIN user_inf ON addfriend.child_id=user_inf.pet_unique_id WHERE addfriend.parent_id NOT IN (SELECT parent_id FROM addfriend WHERE addfriend.parent_id='77777')<> $id limit 10";
$show_result = mysqli_query($conn, $display2);
if (mysqli_num_rows($show_result)) 
    {
//
            ?>
                            <h2 class="fr-headnig"><span class="user-icn-img"><a href="#">
                                        <img src="images/fr-sug-icon.png" alt="user image"></a>
                                </span><p class="user-nm"><a href="#">Friend Suggestion </a></p></h2>
                                 <?php while ($row = mysqli_fetch_assoc($show_result)) {
                                ?>
                            <div class="fr-li-cont">
                                <div class="fr-li-row">
                                    <div class="fr-t-l">
                                        <a href="#"><span class="user-icn-img"><img src="images/fr-img-icon.png" alt="user image"><span class="fr-nm"><span class="fr-nm"><?php echo $row["pet_name"] ?></span></span></span></a>
                                    </div>
                                    <div class="user-nm"><input type="text" name="id" value="<?php echo $row['pet_unique_id']; ?>"/><a href="#">Add Friend</a></p></div>
                                </div>
                                
                            </div>
                            
                             <?php
                            }
                        }
                        ?>
                            
                            
                        </div>
                    </div>
                </div>
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
        </div>

        <?php require_once 'inc/footer.php'; ?>
    </body>
</html>