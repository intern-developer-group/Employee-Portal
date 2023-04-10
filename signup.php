<!--
=========================================================
* Soft UI Dashboard - v1.0.3
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<?php include 'dbcon.php'; ?>
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
  <link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100" style="overflow-y:hidden;">
  <!-- Navbar -->
  <nav
    class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3  navbar-transparent mt-4">
    <div class="container">
      <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white" href="../pages/dashboards/default.html">
        Elite Infotech
      </a>
      <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
        data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon mt-2">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </span>
      </button>
      <div class="collapse navbar-collapse w-100 pt-3 pb-2 py-lg-0" id="navigation">
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <section class="min-vh-100 mb-8">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
      style="background-image: url('assets/img/curved-images/curved14.jpg');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 text-center mx-auto">
            <h1 class="text-white mb-2 mt-3">Welcome!</h1>

          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n12 mt-md-n11 mt-n10">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card z-index-0">
            <div class="card-header text-center pt-4">
              <h5>Register with</h5>
            </div>
            <div class="card-body pt-0">
              <form role="form text-left" action="" method="post"
                onsubmit="if(document.getElementById('agree').checked) { return true; } else { alert('Please indicate that you have read and agree to the Terms and Conditions and Privacy Policy'); return false; }">
                <div class="mb-3">
                  <input type="text" class="form-control" placeholder="Name" aria-label="Name"
                    aria-describedby="email-addon" name="username" required>
                </div>
                <div class="mb-3">
                  <input type="email" class="form-control" placeholder="Email" aria-label="Email"
                    aria-describedby="email-addon" name="email" required>
                </div>
                <div class="mb-3">
                  <input type="password" class="form-control" placeholder="Password" aria-label="Password"
                    aria-describedby="password-addon" name='pswd' required>
                </div>
                <div class="mb-3 form-group w-95">
                  <label class="form-label">Photo</label></br>
                  <input type="file" name="userimage" class="form-control" />
                </div>
                <div class="form-check form-check-info text-left">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                  <label class="form-check-label" for="flexCheckDefault">
                    I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                  </label>
                </div>
                <?php
if (isset($_POST['sign'])) {
  $name1 = legal_input($_POST['username']);
  $email1 = legal_input($_POST['email']);
  $password1 = legal_input($_POST['pswd']);

  if (isset($_FILES['userimage'])) {
    $file_name = $_FILES['userimage']['name'];
    $file_size = $_FILES['userimage']['size'];
    $file_tmp = $_FILES['userimage']['tmp_name'];
    $file_type = $_FILES['userimage']['type'];
    move_uploaded_file($file_tmp, "assets/img/" . $file_name);
    $img_ex = pathinfo($file_name, PATHINFO_EXTENSION);
    echo $img_ex;
    $allowed_exs = array('JPG', 'JPEG', 'PNG', 'jpg', 'jpeg', 'png');
    if (in_array($img_ex, $allowed_exs)) {
    } else {
      ?>
      <script> alert('please upload image in selected format only');</script>
      <?php
    }
  } 
  $target_folder = "img/";
  $userimage = $target_folder . basename($_FILES['userimage']['name']);
  $emailquery = "SELECT * from user WHERE user_email = '$email1'";
  $query = mysqli_query($con, $emailquery);
  $emailcount = mysqli_num_rows($query);
  if ($emailcount > 0) { ?>
    <script> alert("email already exists");</script>
    <?php
  } else {
    $query1 = "INSERT INTO user (user_name,user_email,user_password,user_type,user_image) VALUES(?,?,?,?,?)";
    if ($stmt = mysqli_prepare($con, $query1)) {
      mysqli_stmt_bind_param($stmt, 'sssis', $name1, $email1, $password1, $usertype, $userimage);
      if (mysqli_stmt_execute($stmt)) {
        $result2 = mysqli_query($con, "SELECT * from user where user_name='$name1'");
        $row2 = mysqli_fetch_array($result2);
        $userid2 = $row2['user_id'];
        echo $userid2;
        $leave = 1;
        $query3 = "INSERT INTO leaves_count (user_id,medical_leave,paid_leave) VALUES(?,?,?)";
        if ($stmt3 = mysqli_prepare($con, $query3)) {
          mysqli_stmt_bind_param($stmt3, 'iii', $userid2, $leave, $leave);
          if (mysqli_stmt_execute($stmt3)) {
            $msg3 = "Data was created successfully";
            return $msg3;
          } else {
            $msg3 = "Error:" . $query3 . "<br>" . mysqli_error($con);
          }
        }
      }
      $msg1 = "Data was created successfully";
      return $msg1;
    } else {
      $msg1 = "Error:" . $query1 . "<br>" . mysqli_error($con);
    }
  }

}
// convert illegal input to legal input
function legal_input($value)
{
  $value = trim($value);
  $value = stripslashes($value);
  $value = htmlspecialchars($value);
  return $value;
}
?>
                <div class="text-center">
                  <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2" name="sign">Sign up</button>
                </div>
                <p class="text-sm mt-3 mb-0">Already have an account? <a href="signin.php"
                    class="text-dark font-weight-bolder">Sign in</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- php -->

  



  <!-- Core JS Files   -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
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
  <script src="assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script> -->
</body>

</html>