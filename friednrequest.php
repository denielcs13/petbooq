<?php
session_start();
//print_r($_SESSION["unique_id"]);
//print_r($_SESSION["pet_unique_id"]);die;
if(isset($_POST["accept"]))
{
    $parent_id = $_POST["login_unique_id"];
    $child_id = $_POST["unique_id"];
    require_once './dbcon.php';
    $sql = "insert into addfriends(parent_id,child_id)values($parent_id,$child_id)";
    mysqli_query($conn, $sql);
    $_SESSION["pet_unique_id"];
    header("Location:addfriend.php");
}
?>
<form method="post">
    <input type="hidden" value="<?php echo $_SESSION["pet_unique_id"];?>" name="login_unique_id">
    <input type="hidden" value="<?php echo $_SESSION["unique_id"];?>" name="unique_id">
    <input type="submit" name="accept" value="Accept">
    <input type="submit" name="decline" value="Decline">
</form>