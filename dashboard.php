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
  <link rel="icon" type="image/png" href="/assets/img/favicon.png">
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
  <?php include 'dbcon.php'; ?>
  <?php
  $current_month = date('m');
  $user_id = $_SESSION['user_id'];
  $result2 = mysqli_query($con, "SELECT * from leaves_count WHERE user_id='$user_id'");
  $row2 = mysqli_fetch_array($result2);
  $createddate = $row2['created_date'];
  $time = strtotime($createddate);
  $month = date("m", $time);
  $leave = '1';
  if ($current_month == $month) {
  }else{
    $result3 = mysqli_query($con, "SELECT * from leaves_count WHERE user_id='$user_id' and month(created_date)='$current_month'");
    if (mysqli_num_rows($result3) > 0) {
    } else {
      $result3 = mysqli_query($con, "INSERT into leaves_count(user_id,medical_leave,paid_leave) VALUES($user_id,$leave,$leave)");
    }
  }
  ?>
  <?php include 'sidebar.php'; ?>

  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">

    <!-- Navbar -->
    <?php include 'navbar.php'; ?>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
      <?php if ($_SESSION['user_type'] == "1") {
        ?>
        <h3 class="text-center mb-5">WELCOME TO DASHBOARD</h3>
      <?php } elseif ($_SESSION['user_type'] == "2") {
        ?>
        <h3 class="text-center mb-5">WELCOME TO ADMIN DASHBOARD</h3>
      <?php } ?>
      <div class="row d-flex justify-content-center">
        <div class="col-xl-5 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <a href="dayspresent.php">
                <div class="row">
                  <div class="col-8">
                    <?php
                    $current_month = date('m');
                    $current_year = date('Y');
                    $current_date = date("Y-m-d");
                    $user_id = $_SESSION['user_id'];
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
        <div class="col-xl-5 col-sm-6 mb-xl-0 mb-4">
          <div class="card">

            <div class="card-body p-3">
              <a href="dayleave.php">
                <div class="row">
                  <div class="col-8">
                    <?php
                    $user_id1 = $_SESSION['user_id'];
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
        <div class="col-xl-6 col-sm-6 mb-xl-0 my-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row p-3">
                <div class="col-12">
                  <?php
                  $current_month = date('m');
                  $current_year = date('Y');
                  $current_date = date("Y-m-d");
                  $currentmonth_days = date('t');
                  $userid = $_SESSION['user_id'];

                  $result = mysqli_query($con, "SELECT * from user where user_id='$userid'");
                  $row = mysqli_fetch_array($result);
                  $monthly_salary = (isset($row['monthly_salary'])) ? $row['monthly_salary'] : 0;
                  $daily_salary = $monthly_salary / $currentmonth_days;
                  $half_day = $daily_salary / 2;

                  // salary of present + paid leave
                  
                  $result2 = mysqli_query($con, "SELECT COUNT(*) FROM attendance where user_id='$userid' and attendance_status='1' and month(attendance_date) = '$current_month' and year(attendance_date) = '$current_year' or user_id='$userid' and attendance_status='3' and month(attendance_date) = '$current_month' and year(attendance_date) = '$current_year'");
                  $row2 = mysqli_fetch_assoc($result2);
                  $current_total_present = $row2['COUNT(*)'];
                  $present_salary = $daily_salary * $current_total_present;

                  // salary of halfday
                  
                  $result3 = mysqli_query($con, "SELECT COUNT(*) FROM attendance where user_id='$userid' and attendance_status='2' and attendance_date <= '$current_date' and month(attendance_date) = '$current_month' and year(attendance_date) = '$current_year'");
                  $row3 = mysqli_fetch_assoc($result3);
                  $current_halfday_present = $row3['COUNT(*)'];
                  $half_day_salary = $half_day * $current_halfday_present;

                  // total salary
                  
                  $total_salary = $present_salary + $half_day_salary;

                  // overtime salary
                  
                  $hour_salary = $daily_salary / 8;
                  $minute_salary = $hour_salary / 60;

                  $result5 = mysqli_query($con, "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(`total_hours`))) AS total_hours FROM overtime WHERE user_id = '$userid' and month(month) = '$current_month' and year(year) = '$current_year' and status='0'");
                  $row5 = mysqli_fetch_assoc($result5);
                  $total_hours_time = $row5['total_hours'];

                  $result6 = mysqli_query($con, "SELECT HOUR('$total_hours_time') As hours");
                  $row6 = mysqli_fetch_assoc($result6);
                  $hours = $row6['hours'];

                  $result7 = mysqli_query($con, "SELECT MINUTE('$total_hours_time') As Minutes ");
                  $row7 = mysqli_fetch_assoc($result7);
                  $Minutes = $row7['Minutes'];

                  $overtime_salary = ($hour_salary * $hours) + ($minute_salary * $Minutes);

                  //final salary
                  
                  $final_salary = $total_salary + $overtime_salary;
                  $final_salary_floor = floor($final_salary);

                  $sql = "UPDATE salary set total_salary = '$final_salary_floor' WHERE user_id = '$userid' and month(update_date) = '$current_month'  and year(update_date) = '$current_year'";
                  $result = mysqli_query($con, $sql);
                  ?>
                  <div class="numbers text-sm mb-0 text-capitalize font-weight-bold">
                    Monthly Salary
                    <span class="badge badge-warning bg-gradient-primary ">
                      <?php echo floor($total_salary); ?>
                    </span>
                    + Overtime Salary
                    <span class="badge badge-warning bg-gradient-primary ">
                      <?php echo floor($overtime_salary); ?>
                    </span>
                    = Total Salary
                    <span class="badge badge-warning bg-gradient-primary ">
                      <?php echo floor($final_salary) ?>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row d-flex justify-content-center mt-5 ">
        <h6 class="text-center my-4">Your leave data</h6>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4 ">
          <div class="card">
            <div class="card-body p-3">
              <div class="row ">
                <div class="col-12">
                  <?php
                  $user_id1 = $_SESSION['user_id'];
                  $update_month = date("m");
                  $update_year = date("Y");
                  $result1 = mysqli_query($con, "SELECT medical_leave FROM leaves_count WHERE user_id='$user_id1'");
                  $row1 = mysqli_fetch_assoc($result1);
                  ?>
                  <div class="numbers text-sm mb-0 text-capitalize font-weight-bold ps-3">
                    <span class="badge badge-warning bg-gradient-primary me-2">
                      <?php if (isset($row1['medical_leave'])) {
                        echo $row1['medical_leave'];
                      } else {
                        echo '0';
                      } ?>
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
                  $user_id1 = $_SESSION['user_id'];
                  $update_month = date("m");
                  $update_year = date("Y");
                  $result1 = mysqli_query($con, "SELECT paid_leave FROM leaves_count WHERE user_id='$user_id1'");
                  $row1 = mysqli_fetch_assoc($result1);
                  ?>
                  <div class="numbers text-sm mb-0 text-capitalize font-weight-bold ps-3">
                    <span class="badge badge-warning bg-gradient-primary me-2">
                      <?php if (isset($row1['paid_leave'])) {
                        echo $row1['paid_leave'];
                      } else {
                        echo '0';
                      } ?>
                    </span>
                    Paid Leave Remaining
                  </div>
                </div>
              </div>
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