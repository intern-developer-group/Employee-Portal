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

<body class="g-sidenav-show  bg-gray-100">

  <?php include 'sidebar.php'; ?>
  <?php include 'dbcon.php'; ?>
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">

    <!-- Navbar -->

    <?php include 'navbar.php'; ?>

    <!-- End Navbar -->

    <div class="container-fluid py-4">
      <div class="row mx-3">
        <div class="col-xl-6 col-sm-6 mb-xl-0">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <?php
                $user_id = $_SESSION['user_id'];

                $today_date = date("Y-m-d");

                $update_month = date("m");

                $update_year = date("Y");

                $sql = "SELECT round(SEC_TO_TIME(SUM(TIME_TO_SEC(total_hours)))) as total_hours FROM overtime WHERE user_id = '$user_id' and status = '0' and month(month) = '$update_month' and year(year) = '$update_year' ";

                $result = mysqli_query($con, $sql);

                $row = mysqli_fetch_assoc($result);
                ?>
                <div class="col-12 text-center">
                  <div class="numbers text-sm mb-0 text-capitalize font-weight-bold ">
                    Total overtime of the month
                    <span class="badge badge-warning bg-gradient-primary me-2">
                      <?php if ($row['total_hours'] == NULL) {
                        echo 0;
                      } else {
                        echo $row['total_hours'];
                      }
                      ?>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-sm-6 mb-xl-0">
          <div class="card">
            <div class="card-body text-center p-3">
              <a href="addOvertime.php">
                <div class="row">
                  <div class="col-12">
                    <div class="numbers text-sm mb-0 text-capitalize font-weight-bold ">
                      Add Overtime
                      <span class="badge badge-warning bg-gradient-primary me-2">+</span>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
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