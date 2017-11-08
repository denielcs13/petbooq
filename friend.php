<?php
session_start();
if (isset($_POST["sub"])) {
    $name = $_POST["user"];
    require_once './dbcon.php';
    $sql = "select pet_name,pet_unique_id from user_infos where pet_name = '$name'";
    $results = mysqli_query($conn, $sql);
    if (mysqli_num_rows($results) == 1) {
        echo "You are already exists<br>";
        while ($row = mysqli_fetch_assoc($results)){
//           echo $row["pet_name"].$row["pet_unique_id"];
            $_SESSION["pet_unique_id"] = $row["pet_unique_id"];
//            print_r($_SESSION["pet_unique_id"]);die;
            header("Location:addfriend.php");
        }
    }
    else
    {
        echo "You are not exists";
    }
}
?>
<form method="post" action="#">
    <input type="text" name="user">
    <input type="submit" name="sub" value="Submit">
</form>
