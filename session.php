<?php
session_start();
if (isset($_POST["sub"])) {
    $users = $_POST["users"];
    require './dbcon.php';
    $query = "select pet_name,pet_unique_id from user_info where email = '$users'";
//    print_r($query);die;
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        echo "You login";
        while ($row = mysqli_fetch_array($result)) {
//            echo $row["pet_unique_id"];
            print_r($row["pet_unique_id"]);die;
            $_SESSION["pet_unique_id"] = $row["pet_unique_id"];
            header("Location:profile_page.php");
        }
    } 
    
    else {
        echo "You are not login";
    }
}
?>


<form method="post">
    <input type="text" name="users">
    <input type="submit" name="sub" value="submit">
</form>