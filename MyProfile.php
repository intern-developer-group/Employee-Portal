<!--
=========================================================
* Portal - v1
=========================================================

* Product Page: C:\xampp\htdocs\portal\Dashboard.php
* Copyright 2021 Jinal Kansagara (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>
    Company Portal
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id=" style" href="assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
</head>
<?php include 'dbcon.php';?>
<body class="g-sidenav-show bg-gray-100">
<?php include 'sidebar.php';?>
  <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
    <!-- Navbar -->
    <?php include 'navbarprofile.php';?>
    <!-- End Navbar -->
    <div class="container-fluid">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
      </div>
      <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <?php $userid=$_SESSION['user_id'];
              $result=mysqli_query($con,"SELECT * from user where user_id='$userid'");
              $row=mysqli_fetch_array($result);?>
              <img src="assets/<?php echo $row['user_image'];?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                <?php echo $row['user_name'];?>
              </h5>
              <p class="mb-0 font-weight-bold text-sm">
                Co-maker of portal
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-xs-12 col-sm-6">
          <div class="card h-100 pt-0 ">
            <div class="card-header pb-0 p-4">
                <div class="col-md-8 d-flex align-items-center">
                  <h6 class="">Company Information</h6>
                </div>
            </div>
            <div class="card-body pt-0 p-3">
              <hr class="horizontal dark pt-0">
              <ul class="list-group">
                <li class="list-group-item border-0 ps-0 py-3 text-sm"><strong class="text-dark">Employeeid:</strong> &nbsp; &nbsp; 14151</li>
                <li class="list-group-item border-0 ps-0 py-3 text-sm"><strong class="text-dark">Department:</strong> &nbsp; &nbsp; Web Developer</li>
                <li class="list-group-item border-0 ps-0 py-3 text-sm"><strong class="text-dark">Position:</strong> &nbsp; &nbsp; Backend Developer</li>
                <li class="list-group-item border-0 ps-0 py-3 text-sm"><strong class="text-dark">Start Date:</strong> &nbsp; &nbsp; Feb 01,2022</li>
                <li class="list-group-item border-0 ps-0 py-3 text-sm"><strong class="text-dark">Current Office Location:</strong> &nbsp; &nbsp; Rajkot</li>
                <li class="list-group-item border-0 ps-0 py-3 text-sm"><strong class="text-dark">Status:</strong> &nbsp; &nbsp; Full Time</li>
                <li class="list-group-item border-0 ps-0 py-3 text-sm"><strong class="text-dark">Projects-Completed:</strong> &nbsp; &nbsp; 3</li>
              </ul>
            </div>
          </div>
        </div>
            <div class="col-xs-12 col-sm-6">
            <div class="card w-100 ps-3">
              <form class="mt-3" method="POST" enctype="multipart/form-data">
                <?php 
                $userid=$_SESSION['user_id'];
                $result=mysqli_query($con,"SELECT * from user where user_id='$userid'");
                $row=mysqli_fetch_array($result);
                ?>
                <div class="form-group w-95">
                  <label class="form-control-label">Name</label>
                  <input class="form-control" type="text" name="username" value="<?php echo $row['user_name'];?>" required>
                </div>
                <div class="form-group w-95">
                  <label  class="form-control-label">Email</label>
                  <input class="form-control" type="email" name="useremail"  value="<?php echo $row['user_email'];?>" required>
                </div>
                <div class="form-group w-95">
                  <label class="form-control-label">Password</label>
                  <input class="form-control" type="text" name="userpassword"  value="<?php echo $row['user_password'];?>" required>
                </div>
                <div class="mb-3 form-group w-95">
                  <label  class="form-label">Photo</label></br>
                  <div class="avatar avatar-xl position-relative">
                    <img  alt="profile_image" src="assets/<?php echo $row['user_image'];?>"  class="w-100 border-radius-lg shadow-sm" name="photo"   >
                  </div>
                  <input type="file" name="userimage" class="form-control"/>
                </div> 
                <?php 
                if(isset($_POST['Update'])){
                  $username=$_POST['username'];
                  $useremail=$_POST['useremail'];
                  $userpassword=$_POST['userpassword'];
                  $userid=$_SESSION['user_id'];
                  if(isset($_FILES['userimage'])){
                    $file_name = $_FILES['userimage']['name'];
                    $file_size = $_FILES['userimage']['size'];
                    $file_tmp = $_FILES['userimage']['tmp_name'];
                    $file_type = $_FILES['userimage']['type'];
                    move_uploaded_file($file_tmp,"assets/img/".$file_name);
                    $img_ex = pathinfo($file_name,PATHINFO_EXTENSION);
                    $allowed_exs = array('JPG', 'JPEG', 'PNG', 'jpg', 'jpeg', 'png');
                    if(in_array($img_ex, $allowed_exs)){
                  } else{
                    ?> <script> alert('please upload image in selected format only');</script><?php
                  }
                }
                      $target_folder = "img/";
                    $userimage = $target_folder . basename($_FILES['userimage']['name']);
                   $sql = "UPDATE user set user_name = '$username ', user_email = '$useremail' ,  user_password = '$userpassword' , user_image = '$userimage' WHERE user_id = $userid" ;
             $result = mysqli_query($con, $sql);
              $script = "<script>
              window.location = 'signin.php';</script>";
              echo $script;
                }
                ?>
                <div class="form-group mt-3">
                  <input class="btn bg-gradient-primary" type="reset" value="Reset" name="Reset" >
                  <input class="btn bg-gradient-primary" type="submit" value="Update" name="Update">
                </div>
              </form>

         </div>
            </div>
          </div>
        </div>
</div>
      </div>
      
<!--   Core JS Files   -->
<script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
  </body>
</html>