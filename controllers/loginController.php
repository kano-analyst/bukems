<?php 
require '../models/db_connect.php';
session_start();
    //check if browser has posted any data to be collected
	if(isset($_POST['Login'])){
        $username =$_POST['username'];
        $password=$_POST['password'];
        //$password=md5($password);
        $query= "SELECT * FROM `user` WHERE username='$username' AND password='$password'"; //query  data from database
        $result=$conn->query($query);
    }
    //check if any result was returned
    if (mysqli_num_rows($result) > 0){
        //iterate through the results
        while($row = mysqli_fetch_assoc($result)) {
                $username= $row['username'];
                $role= $row['role'];
                $_SESSION['logged_in']=true;  
            
        switch ($role) {
            case 'super_admin':
            $user=$row['username'];
            $_SESSION['username']= $user;
                header("location: ../views/superadmin_dash.php");
                break;
            case 'du_staff':
                $user=$row['username'];
                header("location:  ../views/dustaff_dash.php");
                break;
            default:
                # code...
                $_SESSION['logged_in']=false;
                header("location:  ../index.php?error=1");
                break;
        }
    }
 }
//   }/*  if($role="supervisor"){
//  header("location: ../views/supervisor_home.php");
//     $_SESSION['username']= $row['username'];
// }
//  if ($role="staff") {
//  header("location: ../views/staff_home.php");
//  $_SESSION['username']= $row['username'];
//  } */
else{
   $_SESSION['logged_in']=false;
    echo"failed";
    	header("location: ../index.php?error=1");

}
?>