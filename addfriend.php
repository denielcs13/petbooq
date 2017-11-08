<h2>User wall</h2>
<?php
session_start();
//print_r($_SESSION["pet_unique_id"]);die;
$id = $_SESSION["pet_unique_id"];
require './dbcon.php';
$display = "SELECT pet_name,pet_unique_id FROM `user_inf` WHERE `pet_unique_id`<> $id limit 10";

$show_result = mysqli_query($conn, $display);

while ($row = mysqli_fetch_array($show_result))
{
   if (isset($_POST["users"]))
    {
//       print_r($_POST);die;
       $_SESSION["unique_id"] = $_POST["unique_id"];
       $_SESSION["pet_unique_id"];
       header("Location:friednrequest.php");
        
    }
?>
<tbody>
<tr>
<td>   
<form method='post' action="#">
    <?php //  echo $row["pet_unique_id"];?>
    <input type="hidden" name="unique_id" value="<?php  echo $row["pet_unique_id"];?>">
    <input type='submit' value="Add friend" name='users'>
   
</form>
</td>
</tr>
</tbody>    
<?php    
}
?>
<?php
$parent_id = $_SESSION["pet_unique_id"];
print_r($parent_id);
//$user = $_SESSION["unique_id"];
//print_r($user);
require_once './dbcon.php';
$query = "select * from addfriend join user_infos on addfriend.child_id = user_infos.pet_unique_id where user_infos.pet_unique_id = '$parent_id'";
$show = mysqli_query($conn, $query);
if(mysqli_num_rows($show)>0)
{
while ($row = mysqli_fetch_array($show))
{
    echo '<pre><tbody border=1><tr><td>'.$row["pet_name"].'</td><br><td>'.$row["type_of_pet"].'</td><br><td>'.$row["powner_name"].'</td><br><td>'.$row["email"].'</td><br><td>'.$row["country"].'</td><br><td>'.$row["phone"].'</td><br><td>'.$row["pet_unique_id"].'</td></tr></tbody></pre>';
}
}
?>
