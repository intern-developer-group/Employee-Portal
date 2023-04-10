<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  include 'dbcon.php'; ?>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>
    Portal
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
<!-- Data update Query Start hear -->

<?php

if (isset($_POST['Edit'])) {
  $user_id = $_GET['u_id'];
  $salary = $_POST['monthly_salary'];
  $monthdays = date('t');
  $dailysalary = floor(($salary / $monthdays));
  $sql = "UPDATE user set monthly_salary='" . $salary . "',daily_salary='" . $dailysalary . "' WHERE user_id = $user_id ";
  $result = mysqli_query($con, $sql);

  $sql1 = "UPDATE salary set monthly_salary='" . $salary . "',daily_salary='" . $dailysalary . "' WHERE user_id = $user_id ";
  $result = mysqli_query($con, $sql1);
  if (isset($_GET['usertype'])) {
    if ($_GET['usertype'] == '1') {
      $script = "<script>
    window.location = 'user.php?url=Developer&user_type=1';</script>";
      echo $script;
    } else {
      $script = "<script>
    window.location = 'user.php?url=Admin&user_type=2';</script>";
      echo $script;
    }
  }

}
?>

<!-- Data update Query Start hear -->

<body class="g-sidenav-show  bg-gray-100">

  <!-- Start Sidebar -->
  <?php include "sidebar.php"; ?>
  <!-- End Sidebar -->

  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <!--Start Navbar -->
    <?php include "navbar.php"; ?>
    <!-- End Navbar -->

    <!-- Main Start Contant Here  -->

    <section>
      <div class="container-fluid py-4 mt-4">
        <div class="row justify-content-center">
          <div class="card  w-xl-50 w-lg-50 w-md-50 w-sm-75">
            <div class="row ">
              <h5 class="text-center p-1">Edit Salary</h5>
            </div>
            <form class="mt-3" method="POST">
              <?php
              if (isset($_GET['u_id'])) {
                $user_id = $_GET['u_id'];


                $sql = " SELECT * FROM user where user_id = $user_id";

                $result = mysqli_query($con, $sql);
                $row = mysqli_fetch_array($result);

                ?>
                <div class="form-group">
                  <label class="form-control-label">Monthly Salary</label>
                  <input class="form-control" type="text" placeholder="Enter Salary" name="monthly_salary" value=<?php echo $row['monthly_salary']; ?>>
                </div>
                <div class="form-group">
                  <input class="btn bg-gradient-primary" type="submit" value="Edit" name="Edit">
                </div>
                <?php
              }
              ?>
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- Main End Contant Here  -->

  </main>
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