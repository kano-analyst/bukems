<?php 
require '../models/db_connect.php';
session_start();
    //check if browser has posted any data to be collected
	if(isset($_POST['Login'])){
        $username ="P3000";
        $password="admin";
        $hashed_pass=Password_hash($password,True);
        $role="super_admin";
        $status="active";

        $query= "SELECT * FROM `users` WHERE username='$username'"; //query  data from database
        $result=$conn->query($query);
    }
    //check if any result was returned
    if (mysqli_num_rows($result) > 0){
        //iterate through the results
            while($row = mysqli_fetch_assoc($result)) {
                $key=$row['password'];
                if(password_verify($password,$key)){
                   header('views/superadmin_dash.php');
                    // echo "Password Verification is Success";

                }else{
                echo "Password Verification Failed";
                }
            }
   }

    