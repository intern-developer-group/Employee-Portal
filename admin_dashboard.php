<?php
session_start();
?>
<?php
include 'dbcon.php';
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


  <!-- Start Sidebar -->
  <?php include "sidebar.php"; ?>
  <!-- End Sidebar -->

  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <!--Start Navbar -->
    <?php include "navbar.php"; ?>
    <!-- End Navbar -->


    <!-- Main Start Contant Here  -->
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
  }?>

    <section class="container p-5">

      <div class="row">
        <?php

        $sql = "SELECT DISTINCT user_type FROM user";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $user_type = $row['user_type'];
            //echo $user_type ;
        

            ?>

            <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4 mt-4">
              <a href="user.php?url=<?php if ($row['user_type'] == 2) {
                echo "Admin";
              } elseif ($row['user_type'] == 1) {
                echo "Developer";
              } else {
                echo " Normal user";
              } ?>&user_type=<?php echo $user_type; ?>"
                class="text-sm mb-0 text-capitalize font-weight-bold">
                <!--<a href="bde_main_data.php?url=BDE DATA" class="text-sm mb-0 text-capitalize font-weight-bold">-->
                <div class="card">
                  <div class="card-body p-3">
                    <div class="row">
                      <div class="col-8">
                        <div class="numbers">
                          <div>
                            <?php if ($row['user_type'] == 2) {
                              echo "Admin";
                            } elseif ($row['user_type'] == 1) {
                              echo "Developer";
                            } else {
                              echo " Normal user";
                            } ?>
                          </div>

                          <h5 class="font-weight-bolder mb-0">
                            <span class="text-success text-sm font-weight-bolder"></span>
                          </h5>

                        </div>
                      </div>

                      <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                          <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          <?php
          }
        }
        ?>
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