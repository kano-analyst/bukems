<?php 
include('../models/db_connect.php');
$id=$_GET['id'];
$status=$_GET['status'];
echo $id;
echo $status;
if($status==0){
 $query="UPDATE `users` SET `status`=1 WHERE `id`='$id' ";
mysqli_query($conn, $query);
header('location: ../controllers/all_users.php');
}elseif ($status==1) {
    $query="UPDATE `users` SET `status`=0 WHERE `id`='$id' ";
mysqli_query($conn, $query);
header('location: ../controllers/all_users.php');

}

?>