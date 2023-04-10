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

  <main class="main-content position-relative max-height-vh-10F0 h-100 mt-1 border-radius-lg ">
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- End Navbar -->
    <div class="name">
      <h4 class="text-center">Displaying attendance data of :
        <?php
        $user_id = $_GET['uid'];
        $resultn = mysqli_query($con, "SELECT user_name from user where user_id='$user_id'");
        $rown = mysqli_fetch_assoc($resultn);
        echo $rown['user_name'];
        ?>
         <td class="align-middle text-center">
          <span class="text-secondary text-xs font-weight-bold ps-5" style="visibility:hidden;"></span>
        </td>
        <td class="align-middle text-center">
          <span class="text-secondary text-xs font-weight-bold ps-5"><a class="btn bg-gradient-primary" name="view"
              href="admin_attendance.php">Go Back</a></span>
        </td>
      </h4>
    </div>
    <div class="container-fluid py-4">
      <div class="row mx-3">
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <a href="view_employee_present.php?uid=<?php echo $user_id?>">
                <div class="row">
                  <div class="col-8">
                    <?php
                    $user_id = $_GET['uid'];
                    $current_month = date('m');
                    $current_year = date('Y');
                    $current_date = date("Y-m-d");
                    $sql = "SELECT COUNT(*) FROM attendance WHERE user_id = '$user_id' and attendance_status='1' and attendance_date <= '$current_date' and month(attendance_date) = '$current_month' and year(attendance_date) = '$current_year'or user_id = '$user_id' and attendance_status='2' and attendance_date <= '$current_date' and month(attendance_date) = '$current_month' and year(attendance_date) = '$current_year'";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <div class="numbers text-sm mb-0 text-capitalize font-weight-bold ps-3 pt-2">
                      <span class="badge badge-warning bg-gradient-primary me-2">
                        <?php echo $row['COUNT(*)']; ?>
                      </span>
                      Days Present
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                      <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <a href="view_employee_absent.php?uid=<?php echo $user_id?>">
                <div class="row">
                  <div class="col-8">
                    <?php
                    $user_id1 = $_GET['uid'];
                    $sql1 = "SELECT COUNT(*) FROM attendance WHERE user_id = '$user_id' and attendance_status='0' and attendance_date <= '$current_date' and month(attendance_date) = '$current_month' and year(attendance_date) = '$current_year'or user_id = '$user_id' and attendance_status='3' and attendance_date <= '$current_date' and month(attendance_date) = '$current_month' and year(attendance_date) = '$current_year'";
                    $result1 = mysqli_query($con, $sql1);
                    $row1 = mysqli_fetch_assoc($result1);
                    ?>
                    <div class="numbers text-sm mb-0 text-capitalize font-weight-bold ps-3 pt-2">
                      <span class="badge badge-warning bg-gradient-primary me-2">
                        <?php echo $row1['COUNT(*)'] ?>
                      </span>
                      Days Absent
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                      <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <?php
                  $user_id = $_GET['uid'];
                  $result = mysqli_query($con, "SELECT monthly_salary from salary where user_id='$user_id'");
                  $row = mysqli_fetch_array($result);
                  ?>
                  <div class="numbers text-sm mb-0 text-capitalize font-weight-bold ps-3 pt-2">
                    <span class="badge badge-warning bg-gradient-primary me-2">
                      <?php if (isset($row['monthly_salary'])) {
                        echo $row['monthly_salary'];
                      } else {
                        echo "0";
                      } ?>
                    </span>
                    Monthly Salary
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

      <!-- new -->
      <!-- new row -->

      <div class="row mt-5 ms-3 ">
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        
          <div class="card">
            <div class="card-body p-3">
              <a href="view_holiday.php?uid=<?php echo $user_id?>">
              <div class="row">
                <div class="col-8">
                <?php
                                $user_id1 = $_SESSION['user_id'];
                                 $result1 = mysqli_query($con, "SELECT COUNT(*) FROM holiday");
                                 $row1 = mysqli_fetch_assoc($result1);
                            ?>  
                <div class="numbers text-sm mb-0 text-capitalize font-weight-bold ps-3 pt-2">
                    <span class="badge badge-warning bg-gradient-primary me-2"><?php echo $row1['COUNT(*)']?></span>
                    Holidays
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
              </a>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4 ">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-12">
                <?php
                  $user_id1 = $_GET['uid'];
                  $update_month = date("m");
                  $update_year = date("Y");
                  $result1 = mysqli_query($con, "SELECT medical_leave FROM leaves_count WHERE user_id='$user_id1'");
                  $row1 = mysqli_fetch_assoc($result1);
                  ?>
                  <div class="numbers text-sm mb-0 text-capitalize font-weight-bold ps-3">
                    <span class="badge badge-warning bg-gradient-primary me-2">
                      <?php if (isset($row1['medical_leave'])) {
                        echo $row1['medical_leave'];
                      } else{
                        echo '0';
                      }
                         ?>
                    </span>
                    Medical Leave Remaining
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-12">
                <?php
                  $user_id1 = $_GET['uid'];
                  $update_month = date("m");
                  $update_year = date("Y");
                  $result1 = mysqli_query($con, "SELECT paid_leave FROM leaves_count WHERE user_id='$user_id1'");
                  $row1 = mysqli_fetch_assoc($result1);
                  ?>
                  <div class="numbers text-sm mb-0 text-capitalize font-weight-bold ps-3">
                    <span class="badge badge-warning bg-gradient-primary me-2">
                      <?php if (isset($row1['paid_leave'])) {
                        echo $row1['paid_leave'];
                      } else{
                        echo '0';
                      }?>
                    </span>
                    Paid Leave Remaining
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      

      <footer class="footer pt-3  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
          </div>
        </div>
      </footer>
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