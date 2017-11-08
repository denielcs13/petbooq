<?php
session_start();
if (!(isset($_SESSION['pet_unique_id']))) {
    header('Location:index.php');
}
?>
<html>
    <?php require_once 'inc/head-content.php'; ?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <body>
        <?php require_once 'inc/header.php'; ?>
        <?php
        $parent_id = $_SESSION['pet_unique_id'];
//        print_r($parent_id);
        //echo '$parent_id';
//$child_id = $_SESSION["child_user_id"];
        require 'dbcon.php';
        $userqry = mysqli_query($conn, "SELECT * FROM user_info WHERE pet_unique_id='$parent_id'");
        $userinf = mysqli_fetch_assoc($userqry);

        $display = "SELECT * FROM(SELECT post.id,post.child_post_id,post.title,post.posts,post.url,post.image,post.time FROM addfriend JOIN post on addfriend.parent_id=post.child_post_id WHERE addfriend.child_id='$parent_id' AND addfriend.status='1' UNION SELECT post.id,post.child_post_id,post.title,post.posts,post.url,post.image,post.time FROM addfriend JOIN post on addfriend.child_id=post.child_post_id WHERE addfriend.parent_id='$parent_id' AND addfriend.status='1') AS u ORDER BY u.id DESC LIMIT 5";

        $disprun = mysqli_query($conn, $display);
        ?>


        <style>
            #filediv0, #filediv1, #filediv2, #filediv3 {
                width:80%;
                float:left;
            }
            .frn_req_acc, .frn_req_rej {
                float:left;
            }
            #add-more-img {
                display:none;
            }
            input[id="video_upload"] {
                display:none;
            }
            .vid-upl {
                -webkit-appearance: button;
                padding: 6px;
                background: #2c86bf;
                color: WHITE;
            }
            .post-video-upl {
                float:left;
            }
        </style>
        <div class="main-content user-pro-dtls-page usr-feed-page-nw">
            <div class="main-content-inn col-three main-content-full">
                <div class="col-first-side">
                    <div class="pro-right-sec">
                        <div class="sidebar">
                            <ul>
                                <li><a href="#"><span class="icn"><img src="images/create-page-icon.png" alt="icon"></span>Create Page</a></li>
                                <li><a href="#"><span class="icn"><img src="images/create-grp-icon.png" alt="icon"></span>Create Groups</a></li>
                                <li><a href="#"><span class="icn"><img src="images/event-icon.png" alt="icon"></span>Events</a></li>
                                <li><a href="#"><span class="icn"><img src="images/create-grp-icon.png" alt="icon"></span>Create Ads</a></li>
                                <li><a href="#"><span class="icn"><img src="images/notes-icon.png" alt="icon"></span>Create Notes</a></li>
                                <li><a href="#"><span class="icn"><img src="images/rec-icon.png" alt="icon"></span>Recommendations</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="main-content-inn-left">
                    <div class="col-first">
                        <div class="user-pro-dtls">
                            <div class="usr-pro-img"><img src="<?= $_SESSION['profile_pic'] ?>" alt="user image" /></div>
                            <div class="usr-pro-dtl-r">
                                <h2><?= $_SESSION['pet_name'] ?></h2>
                                <div class="usr-anc-l">
                                    <span>Name : <?= $_SESSION['powner_name'] ?></span>
                                    <span>DOB : <?= $_SESSION['dob'] ?></span>
                                    <span>Breed : Pomeranian</span>
                                </div>
                                <br>
                                <p>Choosing a purebred is the best way to know what a dog's looks and personality might be like, but it's never...</p>
                                <!--<div class="usr-cnct-l"><a href="#">Add Friend</a><a href="edit-profile-page.php" class="edit">Edit</a></div>-->
                            </div>
                        </div>
                        <div class="two-col-post two-col-post-brdr">
                            <div class="left">
                                <div class="stat-textarea">
                                    <form method="post" id="profile-post-form">
                                        <div class="uplbtn-btm">
                                            <h2 class="p-hdng">Share your new activity</h2>
                                            <div class="upl-btm-text"><input name="title" placeholder="Experience" type="text" /></div>
                                            <div class="upl-btm-text"><textarea name="description" placeholder="Share your pets"></textarea></div>
                                        </div>
                                        <div class="upload-btn uplbtn-top uplbtn-btm-t">
                                            <div class="upload-btn-hld">
                                                <input name="post-url" placeholder="Type your URL" class="typ-t" type="text">
                                            </div>
                                            <div class="upload-btn-hld upload-btn-hld-top">
                                                <div class="upload-btn-inhld" id="upload-post-img">
                                                    <div class="filediv">
                                                        <input name="file[]" value="upload" class="fl-img" type="file" />
                                                    </div>
                                                    <a href="#" id="add-more-img" class="ad-m">+</a> 

                                                </div>
                                                <!--<div class="post-video-upl"><label class="vid-upl">Video<input type="file" name="fileToUpload" id="video_upload"></label></div>-->
                                                <input value="Post" id="post-submit-btn" class="fl-subm" type="submit" />
                                            </div>
                                        </div>
                                    </form>

                                    <script type="text/javascript">
                                        $(document).ready(function () {

                                            $('#add-more-img').on('click', function (e) {

                                                var count = $('input#file').length;

                                                e.preventDefault();
                                                if (count < 4) {
                                                    $(this).before($("<div/>", {
                                                        id: 'filediv' + count
                                                    }).fadeIn('slow').append($("<input/>", {
                                                        name: 'file[]',
                                                        type: 'file',
                                                        id: 'file'
                                                    }), ).append("<a href='#' id='rem_img_upl'>X</a>"));
                                                }

                                                $('#add-more-img').hide();
                                            }),
                                                    $('#upload-post-img > div:first').find('input').change(function () {
                                                if ($(this).val() != '') {
                                                    $('#add-more-img').css("display", "block");
                                                }


                                            }),
                                                    $("#profile-post-form").on('submit', (function (e) {

                                                e.preventDefault();
                                                $.ajax({
                                                    url: "profile-post-save.php",
                                                    type: "POST",
                                                    data: new FormData(this),
                                                    contentType: false,
                                                    cache: false,
                                                    processData: false,
                                                    success: function (data)
                                                    {

                                                        $('#post-display').prepend(data);
                                                        $('#profile-post-form')[0].reset();
                                                        $('#post-submit-btn').removeAttr('disabled');
                                                    },
                                                    error: function ()
                                                    {

                                                    }

                                                });
                                                $(this).find(':submit').attr('disabled', 'disabled');
                                                // $(this).unbind("submit");
                                                //$(this).on('submit',function(){return false;});

                                            }));


                                        });
                                    </script>
                                    <script>

                                        $(document).on('click', '#rem_img_upl', function (e) {
                                            e.preventDefault();
                                            $(this).parent().remove();


                                        });



                                    </script>
                                    <script>
                                        $(document).ready(function () {
                                            $(document).on('change', '#filediv0 input', function () {
                                                //$('#upload-post-img > div:first').next('#filediv').find('input').change(function() {

                                                if ($(this).val() != '') {
                                                    $('#add-more-img').css("display", "block");
                                                }

                                            }),
                                                    $(document).on('change', '#filediv1 input', function () {
                                                //$('#upload-post-img > div:first').next('#filediv').find('input').change(function() {

                                                if ($(this).val() != '') {
                                                    $('#add-more-img').css("display", "block");
                                                }

                                            }),
                                                    $(document).on('change', '#filediv2 input', function () {
                                                //$('#upload-post-img > div:first').next('#filediv').find('input').change(function() {

                                                if ($(this).val() != '') {
                                                    $('#add-more-img').css("display", "block");
                                                }

                                            }),
                                                    $(document).on('change', '#filediv3 input', function () {


                                                if ($(this).val() != '') {
                                                    //$('#add-more-img').css("display","block");
                                                }

                                            });

                                        });


                                    </script>

                                </div>
                                <div id="post-display"></div>
                                <div class="usr-m-post">
                                    <h3 class="pro-post-h"><span class="icon"><img src="images/fr-sug-icon.png" alt="" /></span><span class="p-h-txt">My posts</span></h3>
                                    <div class="post-row">
                                        <div class="post-rw-hld">
                                            <div class="post-img"><img src="images/user_image05.jpg" alt="" /></div>
                                            <div class="post-content">
                                                <h2><p class="user-nm"><a href="#">User Name</a></p></h2>
                                                <p class="pst-text">The #dog is the most faithful of #animals The 
                                                    <a href="#">#dog</a> is the most faithful of #animals</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-row">
                                        <div class="post-rw-hld">
                                            <div class="post-img"><iframe src="https://www.youtube.com/embed/M1djO19aSFQ" allowfullscreen="" width="100%" height="157px" frameborder="0"></iframe></div>
                                            <div class="post-content">
                                                <h2><p class="user-nm"><a href="#">User Name</a></p></h2>
                                                <p class="pst-text">The #dog is the most faithful of #animals The 
                                                    <a href="#">#dog</a> is the most faithful of #animals</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-row">
                                        <div class="post-rw-hld">
                                            <div class="post-img"><iframe src="https://www.youtube.com/embed/M1djO19aSFQ" allowfullscreen="" width="100%" height="157px" frameborder="0"></iframe></div>
                                            <div class="post-content">
                                                <h2><p class="user-nm"><a href="#">User Name</a></p></h2>
                                                <p class="pst-text">The #dog is the most faithful of #animals The 
                                                    <a href="#">#dog</a> is the most faithful of #animals</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-row">
                                        <div class="post-rw-hld">
                                            <div class="post-img"><img src="images/user_image03.jpg" alt="" /></div>
                                            <div class="post-content">
                                                <h2><p class="user-nm"><a href="#">User Name</a></p></h2>
                                                <p class="pst-text">The #dog is the most faithful of #animals The 
                                                    <a href="#">#dog</a> is the most faithful of #animals</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="right">
                                <h3 class="pro-post-h"><span class="icon"><img src="images/fr-sug-icon.png" alt="" /></span><span class="p-h-txt">Share With Me</span></h3>
                                <div class="usr-right">
                                    <div class="post-in-c">
                                        <div class="post-image"><iframe src="https://www.youtube.com/embed/M1djO19aSFQ" allowfullscreen="" width="100%" height="155px" frameborder="0"></iframe></div>
                                        <div class="post-content">
                                            <h2><span class="user-icn-img"><a href="#"><img src="images/user-img-icon.png" alt="user image" /></a></span><p class="user-nm"><a href="#">User Name</a></p></h2>
                                            <p class="pst-text">The #dog is the most faithful of #animals The 
                                                <a href="#">#dog</a> is the most faithful of #animals</p>
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
                                <h3 class="pro-post-h"><span class="icon"><img src="images/fr-sug-icon.png" alt="" /></span><span class="p-h-txt">Friend Shared Video</span></h3>
                                <div class="usr-right">
                                    <div class="post-in-c">
                                        <div class="post-image"><img src="images/user_image09.jpg" alt="user post image/video" /></div>
                                        <div class="post-content">
                                            <h2><span class="user-icn-img"><a href="#"><img src="images/user-img-icon.png" alt="user image" /></a></span><p class="user-nm"><a href="#">User Name</a></p></h2>
                                            <p class="pst-text">The #dog is the most faithful of #animals The 
                                                <a href="#">#dog</a> is the most faithful of #animals</p>
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
                        </div>
                    </div>

                    <div class="col-second">
                        <div class="fr-list">
                            <?php
                            require 'dbcon.php';
                            $display2 = "SELECT F.status, U.pet_name, U.email, U.pet_unique_id
FROM user_info U, addfriend F
WHERE
CASE

WHEN F.parent_id = '$parent_id'
THEN F.`child_id` = U.`pet_unique_id`
WHEN F.`child_id`= '$parent_id'
THEN F.`parent_id`= U.`pet_unique_id`
END

AND 
F.status='1'";

                            $show_result = mysqli_query($conn, $display2);
                            if (mysqli_num_rows($show_result)) {
                                ?>
                                <h2 class="fr-headnig"><span class="user-icn-img"><a href="#">
                                            <img src="images/fr-li-icon.png" alt="user image"></a>
                                    </span><p class="user-nm"><a href="#">Friend List</a></p></h2>
                                <?php while ($row = mysqli_fetch_assoc($show_result)) {
                                    ?>
                                    <div class="fr-li-cont">
                                        <div class="fr-li-row">
                                            <div class="fr-t-l" id="friend-profile<?= $row['pet_unique_id'] ?>">
                                                <a href="#"><span class="user-icn-img"><img src="images/user_image01.jpg" alt="user image" /><span class="fr-nm"><a href="profile-load.php?id=<?= $row['pet_unique_id'] ?>" class="frn_profile"><?php echo $row["pet_name"] ?></a></span></span></a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>

                        <div class="fr-list">
                            <?php
                            require 'dbcon.php';
                            $display2 = "SELECT pet_name,email,parent_id,STATUS,child_id FROM user_info JOIN addfriend ON addfriend.`parent_id` = user_info.`pet_unique_id` WHERE (parent_id='$parent_id' OR child_id='$parent_id') AND (parent_id!='$parent_id') AND STATUS=1";

                            $show_result = mysqli_query($conn, $display2);
                            if (mysqli_num_rows($show_result)) {
                                ?>
                                <h2 class="fr-headnig"><span class="user-icn-img"><a href="#">
                                            <img src="images/fr-li-icon.png" alt="user image"></a>
                                    </span><p class="user-nm"><a href="#">Friend Request</a></p></h2>
                                <?php while ($row = mysqli_fetch_assoc($show_result)) {
                                    ?>
                                    <div class="fr-li-cont">
                                        <div class="fr-li-row">
                                            <div class="fr-t-l">
                                                <a href="#">
                                                    <span class="user-icn-img">
                                                        <img src="images/user_image01.jpg" alt="user image" />
                                                        <span class="fr-nm"><a href=""><?php echo $row["pet_name"] ?></a></span>
                                                    </span>
                                                </a>

                                            </div>

                                            <div class="user-add-cnl">
                                                <div class="user-nm"><a href="#" class="frn_req_acc"  id="<?= $row['pet_unique_id'] ?>">Accept</a>
                                                    <a href="#" class="frn_req_rej" id="<?= $row['pet_unique_id'] ?>">Reject</a></div>

                        <!--<div class="user-nm"><a href="#">Accept</a><p></p></div>
                        <div class="user-nm user-cnl"><a href="#">Cancel</a><p></p></div>-->
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>  

                        <div class="fr-list fr-sug">
                            <h2 class="fr-headnig"><span class="user-icn-img"><a href="#">
                                        <img src="images/fr-li-icon.png" alt="user image"></a>
                                </span><p class="user-nm"><a href="#">Friend Suggestion </a></p></h2>
                            <div class="fr-li-cont">
                                <?php
                                //$id = $_SESSION["pet_unique_id"];
                                //$friend_ =
//$display3="SELECT DISTINCT user_inf.pet_unique_id,user_inf.pet_name FROM addfriend JOIN user_inf ON addfriend.child_id=user_inf.pet_unique_id WHERE addfriend.parent_id NOT IN (SELECT parent_id FROM addfriend WHERE addfriend.parent_id='$parent_id')";
                                $display3 = "SELECT DISTINCT user_info.pet_unique_id,user_info.pet_name FROM user_info JOIN `addfriend` ON addfriend.`child_id`=user_info.pet_unique_id 
WHERE addfriend.`child_id` NOT IN (SELECT `child_id` FROM addfriend WHERE addfriend.parent_id='$parent_id')";
                                $show_result = mysqli_query($conn, $display3);
//if (mysqli_num_rows($show_result)) 
                                //{
                                ?>

                                <?php while ($row = mysqli_fetch_assoc($show_result)) {
                                    ?>
                                    <div class="fr-li-row">
                                        <div class="fr-t-l">    
                                            <a href="#"><span class="user-icn-img">
                                                    <img src="images/user_image01.jpg" alt="user image" />
                                                    <span class="fr-nm"><?php echo $row["pet_name"] ?></span></span>

                                            </a>
                                        </div>

                                        <div class="user-nm" id="add-friend-action<?= $row['pet_unique_id'] ?>" >
                                            <input type="hidden" name="id" value="<?= $row['pet_unique_id']; ?>"><a href="#" class="add_friend_bttn">Add Friend</a>
                                        </div>

                                    </div>

                                    <?php
                                }
                                ?>
                            </div>    
                        </div>

                        <script type="text/javascript">
                            $(document).ready(function (e) {
                                $(document).on('click', '.add_friend_bttn', function (e) {
                                    e.preventDefault();

                                    var user_id = $(this).prev('input').val();

                                    $.ajax({
                                        url: "add_friend.php",
                                        type: "POST",
                                        data: {addid: user_id},
                                        cache: false,
                                        success: function (data) {

                                            $('#add-friend-action' + user_id).html(data);


                                        },
                                        error: function ()
                                        {

                                        }
                                    });
                                });
                            });

                        </script>

                        <script type="text/javascript">
                            $(document).ready(function () {
                                $('.frn_req_acc').on('click', function (e) {
                                    e.preventDefault();
                                    var acc_id = $(this).attr('id');

                                    $.ajax({
                                        url: "friend_req_fun.php",
                                        type: "POST",
                                        data: {accept: acc_id},
                                        cache: false,
                                        success: function (data) {

                                            $('#' + acc_id + '.frn_req_acc').parent().html("ACCEPTED");


                                        }
                                    });

                                }),
                                        $('.frn_req_rej').on('click', function (e) {
                                    e.preventDefault();
                                    var rej_id = $(this).attr('id');

                                    $.ajax({
                                        url: "friend_req_fun.php",
                                        type: "POST",
                                        data: {reject: rej_id},
                                        cache: false,
                                        success: function (data) {

                                            $('#' + rej_id + '.frn_req_rej').parent().html("REJECTED");


                                        }
                                    });

                                });



                            });

                        </script>
                        <script type="text/javascript">
                            $(document).ready(function (e) {
                                $(document).on('click', '.fr_profile', function (e) {
                                    e.preventDefault();

                                    var user_id = $(this).prev('input').val();

                                    $.ajax({
                                        url: "profile-load.php",
                                        type: "POST",
                                        data: {frload: user_id},
                                        cache: false,
                                        success: function (data) {

                                            $('#friend-profile' + user_id).html(data);


                                        },
                                        error: function ()
                                        {

                                        }
                                    });
                                });
                            });

                        </script>




                        <h3 class="pro-post-h"><span class="icon"><img src="images/fr-sug-icon.png" alt="" /></span><span class="p-h-txt">Photo</span></h3>
                        <div class="usr-pro-photoglr">
                            <div class="usr-photo-img"><img src="images/user_image01.jpg" alt="" /></div>
                            <div class="usr-photo-img"><img src="images/user_image02.jpg" alt="" /></div>
                            <div class="usr-photo-img"><img src="images/user_image03.jpg" alt="" /></div>
                            <div class="usr-photo-img"><img src="images/user_image05.jpg" alt="" /></div>
                            <div class="usr-photo-img"><img src="images/user_image06.jpg" alt="" /></div>
                            <div class="usr-photo-img"><img src="images/user_image07.jpg" alt="" /></div>
                        </div>

                        <h3 class="pro-post-h"><span class="icon"><img src="images/fr-sug-icon.png" alt="" /></span><span class="p-h-txt">Video</span></h3>
                        <div class="usr-pro-vdo-list">
                            <div class="post-row">
                                <div class="post-rw-hld">
                                    <div class="post-img"><iframe src="https://www.youtube.com/embed/M1djO19aSFQ" allowfullscreen="" width="100%" height="157px" frameborder="0"></iframe></div>
                                    <div class="post-content">
                                        <h2><p class="user-nm"><a href="#">User Name</a></p></h2>
                                        <p class="pst-text">The #dog is the most faithful of #animals The 
                                            <a href="#">#dog</a> is the most faithful of #animals</p>
                                    </div>
                                </div>
                            </div>
                            <div class="post-row">
                                <div class="post-rw-hld">
                                    <div class="post-img"><iframe src="https://www.youtube.com/embed/M1djO19aSFQ" allowfullscreen="" width="100%" height="157px" frameborder="0"></iframe></div>
                                    <div class="post-content">
                                        <h2><p class="user-nm"><a href="#">User Name</a></p></h2>
                                        <p class="pst-text">The #dog is the most faithful of #animals The 
                                            <a href="#">#dog</a> is the most faithful of #animals</p>
                                    </div>
                                </div>
                            </div>
                            <div class="post-row">
                                <div class="post-rw-hld">
                                    <div class="post-img"><iframe src="https://www.youtube.com/embed/M1djO19aSFQ" allowfullscreen="" width="100%" height="157px" frameborder="0"></iframe></div>
                                    <div class="post-content">
                                        <h2><p class="user-nm"><a href="#">User Name</a></p></h2>
                                        <p class="pst-text">The #dog is the most faithful of #animals The 
                                            <a href="#">#dog</a> is the most faithful of #animals</p>
                                    </div>
                                </div>
                            </div>
                            <div class="post-row">
                                <div class="post-rw-hld">
                                    <div class="post-img"><iframe src="https://www.youtube.com/embed/M1djO19aSFQ" allowfullscreen="" width="100%" height="157px" frameborder="0"></iframe></div>
                                    <div class="post-content">
                                        <h2><p class="user-nm"><a href="#">User Name</a></p></h2>
                                        <p class="pst-text">The #dog is the most faithful of #animals The 
                                            <a href="#">#dog</a> is the most faithful of #animals</p>
                                    </div>
                                </div>
                            </div>
                            <div class="post-row">
                                <div class="post-rw-hld">
                                    <div class="post-img">
                                        <iframe width="100%" height="157px" src="https://www.youtube.com/embed/lizj6OVBM-s" frameborder="0" allowfullscreen></iframe>
                                    </div>
                                    <div class="post-content">
                                        <h2><p class="user-nm"><a href="#">User Name</a></p></h2>
                                        <p class="pst-text">The #dog is the most faithful of #animals The 
                                            <a href="#">#dog</a> is the most faithful of #animals</p>
                                    </div>
                                </div>
                            </div>
                            <div class="post-row">
                                <div class="post-rw-hld">
                                    <div class="post-img"><iframe src="https://www.youtube.com/embed/M1djO19aSFQ" allowfullscreen="" width="100%" height="157px" frameborder="0"></iframe></div>
                                    <div class="post-content">
                                        <h2><p class="user-nm"><a href="#">User Name</a></p></h2>
                                        <p class="pst-text">The #dog is the most faithful of #animals The 
                                            <a href="#">#dog</a> is the most faithful of #animals</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>



            </div>
        </div>
        <?php require_once 'inc/footer.php'; ?>
        <script type="text/javascript"
src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript"
src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css"
     href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
    </body>

</html>
