<?php
session_start();
if (isset($_POST["sub"])) {
    $users = $_POST["users"];
    require './dbcon.php';
    $query = "select * from user_info where powner_name = '$users'";
//    print_r($query);die;
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        echo "You login";
        while ($row = mysqli_fetch_array($result)) {
//            echo $row["pet_unique_id"];
            $_SESSION["pet_unique_id"] = $row["pet_unique_id"];
            header("Location:feed-page.php");
        }
    } else {
        echo "You are not login";
    }
}

//require './dbcon.php';
//$display = "SELECT * FROM `addfriends` JOIN user_infos on addfriends.child_id = user_infos.pet_unique_id WHERE addfriends.parent_id =55933";
//$result = mysqli_query($conn, $display);
//if(mysqli_num_rows($result))
//{
//    while($row = mysqli_fetch_assoc($result))
//    {
//        echo '<pre>'.$row["child_id"].'-'.$row["pet_name"].'-'.$row["powner_name"].'-'.$row["email"].'</pre>';
//    }
//}
?>

<form method="post">
    <input type="text" name="users">
    <input type="submit" name="sub" value="submit">
</form>