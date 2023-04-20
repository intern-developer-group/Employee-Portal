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
  <link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

  <style>
    .pagination-f {
      width: 100px !important;
    }
    .dt-buttons{
      padding-left:1.5rem;
    }
    .dt-button {
      color: #fff;
      border: 0;
      cursor: pointer;
      background-image: linear-gradient(310deg, #7928CA 0%, #FF0080 100%);
      letter-spacing: -0.025rem;
      text-transform: uppercase;
      box-shadow: 0 4px 7px -1px rgba(0, 0, 0, 0.11), 0 2px 4px -1px rgba(0, 0, 0, 0.07);
      background-size: 150%;
      background-position-x: 25%;
      display: inline-block;
      font-weight: 700;
      line-height: 1.4;
      text-align: center;
      vertical-align: middle;
      cursor: pointer;
      user-select: none;
      background-color: transparent;
      padding: 0.75rem 1.5rem;
      font-size: 0.75rem;
      border-radius: 0.5rem;
      transition: all 0.15s ease-in;
    }
    .dt-button:hover:not(.btn-icon-only) {
    box-shadow: 0 3px 5px -1px rgba(0, 0, 0, 0.09), 0 2px 3px -1px rgba(0, 0, 0, 0.07);
    transform: scale(1.02);
    }
    @media only screen and (max-width:650px){
      .dt-buttons{
        padding-bottom: 1rem;
      }
    }
  </style>
</head>

<body class="g-sidenav-show  bg-gray-100">
  <?php include 'sidebar.php'; ?>
  <?php include 'dbcon.php'; ?>

  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <?php include 'navbar.php'; ?>
    <?php

    $DaysInCurrentMonth = date('t');
    $user_id = $_SESSION['user_id'];
    $curr_month = date('m');
    $curr_year = date('Y');

    $sql = "SELECT * FROM attendance where user_id = '$user_id' and  month( attendance_date) = '$curr_month ' and year(attendance_date) = '$curr_year'";
    //echo $sql ;
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    // $data = $row['attendance_date'];
    // $month = date('M',$data) ;  
    //echo $row['attendance_date'];
    if(isset($row['attendance_data'])){
      $time = strtotime($row['attendance_date']);
    }else {
      error_reporting(0);
      $time = strtotime($row['attendance_date']);
    }
    //echo $time ;
    $month = date('m', $time);
    $year = date('Y', $time);
    //echo $month ;
    $curr_month = date('m');
    $curr_year = date('Y');
    //echo $curr_month ;
    
    if ($curr_month == $month && $curr_year == $year) {
    } else {
      $thismonth_days = date("t");
      for ($x = 1; $x <= $thismonth_days; $x++) {
        $current_date = date("d");
        $current_month = date("m");
        $current_year = date("Y");
        $thismonth_days = date("t");
        $is_update = 'not_updated';
        $attendance_status = 0;
        $user_id = $_SESSION['user_id'];
        $insert_date = $current_year . "-" . $current_month . "-" . $x;
        $sql = "INSERT INTO attendance(user_id,attendance_date,attendance_status,is_update) VALUES ('$user_id', '$insert_date','$attendance_status','$is_update')";

        if (mysqli_query($con, $sql)) {
          $result = date("l", strtotime($insert_date));
          if ($result == "Saturday" || $result == "Sunday") {
            $attendance_status = 3;

            $sql = "UPDATE attendance set attendance_status = '$attendance_status', is_update = 'updated' WHERE attendance_date = '$insert_date'";

            $result = mysqli_query($con, $sql);

          }
        } else {
          echo "something is wrong";
        }
      }
    }
    ?>
    <?php
    include('dbcon.php');
    if (isset($_POST['insert'])) {
      $attendance_status = 1;
      $user_id = $_SESSION['user_id'];
      $date1 = date('Y-m-d');
      $attendance_date = $_POST['date'];
      date_default_timezone_set("Asia/Calcutta");
      $get_time = '10:05:00';
      $cur_time = date("H:i:s");
      $curr_date = date("Y-m-d");
      $sql = "SELECT * FROM attendance where attendance_date = '$curr_date'and user_id = '$user_id' ";
      $result = mysqli_query($con, $sql);
      $row = mysqli_fetch_assoc($result);

      if ($row['attendance_date'] == $curr_date && $row['attendance_status'] == 1 || $row['attendance_status'] == 2) {
        echo '<script type ="text/JavaScript">';
        echo 'alert("You Are Already Present Today..Thank you")';
        echo '</script>';
      } elseif ($cur_time >= $get_time) {
        $sql1 = "UPDATE attendance set attendance_status = '2', is_update = 'updated' WHERE user_id = '$user_id' and attendance_date = '$attendance_date'";
        if (mysqli_query($con, $sql1)) {
          echo '<script type ="text/JavaScript">';
          echo 'alert("oops, you are late")';
          echo '</script>';
        } else {
          echo "something is wrong";
        }
      } else {
        $sql1 = "UPDATE attendance set attendance_status = '$attendance_status', is_update = 'updated' WHERE attendance_date = '$attendance_date' and user_id = '$user_id' and is_update != 'on_leave' ";
        if (mysqli_query($con, $sql1)) {

          echo '<script type ="text/JavaScript">';
          echo 'alert("Your Attendance Has Been Submitted")';
          echo '</script>';
        } else {
          echo "something is wrong";
        }
      }
      if ($row['attendance_date'] == $curr_date && $row['is_update'] == 'on_leave') {
        echo '<script type ="text/JavaScript">';
        echo 'alert("You Are on Leave")';
        echo '</script>';
      }
    }
    ?>

    <div class="container-fluid py-4">

      <div class="row d-flex justify-content-center align-items-center mb-5">
        <div class="col-xl-6 col-md-6 mt-4">
          <div class="card">
            <div class="card-header pb-0 px-3">
              <h6 class="mb-0 text-center">Add Attendance</h6>
            </div>
            <div class="card-body pt-4 p-3">
              <form method="post" action="">
                <ul class="list-group">
                  <div class="form-group">
                    <input class="form-control" type="date" id="myDate" name="date" value="<?php $date2 = date('Y-m-d');
                    echo $date2; ?>" readonly>
                  </div>
                  <button type="submit" class="btn bg-gradient-primary mt-3 w-30" name="insert">Add</button>
                </ul>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6 class="text-center"> Attendance</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0"id="data">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sr.No</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"> Name</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Day
                      </th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Attendance Status</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $user_id = $_SESSION['user_id'];
                    $query = "SELECT * from user where user_id=$user_id";
                    $result = mysqli_query($con, $query);
                    $row1 = mysqli_fetch_array($result);
                    $today_date = date("Y-m-d");
                    $update_month = date("m");
                    $update_year = date("Y");
                    $sql = "SELECT * FROM attendance where user_id = '$user_id' and attendance_date <= '$today_date' and month(attendance_date) = '$update_month' and year(attendance_date) = '$update_year'";
                    $result = mysqli_query($con, $sql);
                    if (mysqli_num_rows($result) > 0) {
                      $sn = 1;
                      while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                          <td>
                            <div class="d-flex px-4 py-1">
                              <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">
                                  <?php echo $sn; ?>
                                </h6>
                              </div>
                            </div>
                          </td>
                          <td>
                            <p class="text-xs font-weight-bold mb-0">
                              <?php echo $row1['user_name']; ?>
                            </p>
                          </td>
                          <?php
                          $time = strtotime($row['attendance_date']);
                          $month = date('j, F, Y', $time);
                          ?>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">
                              <?php echo $month; ?>
                            </span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">
                              <?php if ($row['attendance_status'] == 0) {
                                echo "absent";
                              } elseif ($row['attendance_status'] == 1) {
                                echo "present";
                              } elseif ($row['attendance_status'] == 2) {
                                echo "half day";
                              } elseif ($row['attendance_status'] == 3) {
                                echo "paid leave";
                              } ?>
                              <?php
                              if ($row['is_update'] == 'medical_leave') {
                                echo "Medical Leave";
                              }
                              ?>
                            </span>
                          </td>
                        </tr>
                        <?php $sn++;
                      }
                    } ?>
              </div>

            </div>
            </tbody>
            </table>

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

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#data').DataTable({
        dom: 'Bfrtip',
        buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ]
      });
    });
  </script>

  </body>
</html>