<?php
require('../models/db_connect.php');
include'../api/time.php';
include '../views/header.php';
$query= "SELECT * FROM `users` ORDER BY id desc";
                $result=$conn->query($query);
                $numbering=1;
?>
<head>
     <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>
  <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
          <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div style=""class="col-sm-6">
            <h1 class="m-0">System Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">System Users</a></li>
              <li class="breadcrumb-item active">View Users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div>
                    <div class="row">
                <div class="col-lg-12">
                    <p><button style="position:center" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Add New User</button></p>
                  </div>
              
                  
            </div>
                </div>
            <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Location</th>
                    <th>Role</th>
                    <th>Created By</th>
                    <th>Last Seen</th>
                    <th>Status</th>
                    <th>Message</th>
                    <th>Change Password</td>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                <?php
 if (mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)) {
$status=$row['status'];
        $id=$row['id'];
         if($status==1){
                   $flag="Active"; } 
                     else if($status==0){
                   $flag="Suspended";   }
                 //  $time=$row['last_seen'];
                 $time = strtotime($row['last_seen']);
       $dateconvert=new DateTime($row['last_seen']);
        //$datetime= time_Ago($time);
       $datetime= date_format($dateconvert, "d F Y h:i:a");
       ///$time_ago = strtotime($curr_time);
        $url="../controllers/delete_lecturer_handler.php?id=".$id;
        echo '<tr><td>'.$numbering.'</td><td>'.$row['name'].'</td>
        <td>'.$row['username'].'</td><td>'.$row['location'].'</td><td>'.$row['role'].'</td><td>'.$row['created_by'].'</td>
        <td>'.$datetime.'</td><td>'.$flag.'</td><td><a href="#" class="fas fa-edit nav-icon"></a></i></td>
        <td><a class="btn btn-sm btn-info" style="color:white;" href="#">Change Pass</a></td>';
        if($status==1){
            echo '<td><button type="submit" class="btn btn-sm btn-danger">
          <a style="color:white;" href="../controllers/acct_status_handler.php?id='.$id.'&status=1">Deactivate</a>
          </button></td>';
          }else if($status==0){
             echo '<td><button type="submit" class="btn btn-sm btn-success">
          <a style="color:white;" href="../controllers/acct_status_handler.php?id='.$id.'&status=0">Activate</a>
          </button></td></tr>';  
          }                            
               $numbering++;
              }
    }
                ?>
                 
                  </tbody>

                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Modal View -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title"style="text-align:center;" id="myModalLabel">Create New User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <div class="modal-body">
      <form action="../controllers/add_user.php" method="post">
      <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" name="username" style="width: 100%;"
                   placeholder="Name of New User" required>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Location</label>
                  <select class="form-control select2" disabled="disabled" style="width: 100%;">
                    <option selected="selected">Registry</option>
                    <option>Data Unit</option>
                    <option>Establishment</option>
                    <option>Record Office</option>
                    <option>Pension Unit</option>
                    <option>Junior Staff</option>
                    <option>Staff Training</option>
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
              <div class="form-group">
                  <label>Password</label>
                  <input type="text" class="form-control" name="" style="width: 100%;"
                   placeholder="Password(To be used for Logging-In" required>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Role</label>
                  <select class="form-control select2" style="width: 100%;">
                    <option selected="selected">Registry Staff</option>
                    <option>DU User</option>
                    <option>Staff Training User</option>
                    <option>Juniir Staff User</option>
                    <option>Registrar</option>
                    <option>Admin</option>
                    <option>Super Admin</option>
                  </select>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Repeat Password</label>
                  <input type="text" class="form-control" name="password" style="width: 100%;"
                   placeholder="Repeat Password" required>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-12 col-sm-6">
              <div class="form-group">
                  <label>Username</label>
                  <input type="text" class="form-control" name="username" style="width: 100%;"
                   placeholder="Username(To be used for Logging-In" required>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-12 col-sm-6">
             
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
      
              <!-- /.col -->
 <button type="submit"  class="btn btn-primary">Save changes</button>
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      
  
</form>
      </div>
      
    </div>
  </div>
</div>
<!--End of Modal View -->













<?php
include '../views/footer.php';
?>