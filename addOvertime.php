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

  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <div class="container-fluid">
      <?php date_default_timezone_set("Asia/Calcutta"); ?>
      <div class="row d-flex justify-content-center align-items-center">
        <div class="col-xl-6 col-md-6 mt-4">
          <div class="card">
            <div class="card-header pb-0 px-3">
              <h6 class="mb-0 text-center">Add Overtime</h6>
            </div>
            <div class="card-body pt-4 p-3">
              <?php
              if (isset($_POST['Add'])) {
                $userid = $_SESSION['user_id'];
                $start = $_POST['start'];
                $end = $_POST['end'];
                $todaydate = date("Y-m-d");
                date_default_timezone_set("Asia/Calcutta");
                $todaytime = date("h:i");
                $otstarttime = "19:15";
                $otendtime = "24:00";
                $datetime1 = new DateTime($_POST['start']);
                $datetime2 = new DateTime($_POST['end']);
                $interval = $datetime1->diff($datetime2);
                $diff = $interval->format('%H:%I:%S');
                $result = mysqli_query($con, "SELECT * FROM overtime where user_id='$userid' and date = '$todaydate'");
                $row = mysqli_num_rows($result);
                if ($row > 0) {
                  echo '<script>alert("Data Already Exists.")</script>';
                } else {
                  if ($todaytime > $start && $todaytime > $end) {
                    if ($start > $otstarttime && $start < $otendtime && $end > $otstarttime && $end <= $otendtime) {
                      if ($end > $start) {
                        $sql = "INSERT INTO overtime ( `user_id`, `start`, `end`, `date`, `month`, `year`, `status`, `is_deleted`,`total_hours`) 
                  VALUES ( '$userid', '$start', '$end', '$todaydate', '$todaydate', '$todaydate', '1', '1', '$diff')";
                        $result = mysqli_query($con, $sql);
                      } else {
                        ?>
                        <script>alert('End time can not be less than Start time');</script>
                        <?php
                      }
                    } else {
                      ?>
                      <script>alert('Start time and End time must be between 7:15 pm to 12:pm');</script>
                      <?php
                    }
                  } else {
                    ?>
                    <script>alert('Please enter only during overtime hours');</script>
                    <?php
                  }
                }
              }
              ?>
              <form method="post" action="">
                <ul class="list-group">
                  <div class="form-group">
                    <label>Start time</label>
                    <input class="form-control" type="time" min="19:15" max="23:59" name="start" required>
                    <label>End time</label>
                    <input class="form-control" type="time" min="19:16" max="24:00" name="end" required>
                    <br>
                    <input class="form-control" type="datetime-local" name="date" value="<?php
                    echo date('Y-m-d\TH:i:s'); ?>" readonly=""><small>*Overtime hours are 7.15 pm to 12 pm</small>
                  </div>
                  <button type="submit" class="btn bg-gradient-primary mt-3 w-30" name="Add">Add</button>
                </ul>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="container-fluid py-4">
        <div class="row d-flex justify-content-center ">
          <div class="col-8">
            <div class="card mb-4">
              <div class="card-header pb-0">
                <h6 class="text-center">Overtime List</h6>
                 
              </div>

              <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                  <table class="table align-items-center mb-0" id="data">
                    <thead>
                      <tr>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No.
                        </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date
                        </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                          Hours</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                          Total Hours</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $user_id = $_SESSION['user_id'];
                      $today_date = date("Y-m-d");
                      $update_month = date("m");
                      $update_year = date("Y");
                      $sql = "SELECT * FROM overtime where user_id = '$user_id' and  month(month) = '$update_month' and year(year) = '$update_year'";
                      $result = mysqli_query($con, $sql);
                      // echo $sql;
                      if (mysqli_num_rows($result) > 0) {
                        $sn = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                          ?>
                          <tr>
                            <td class="align-middle text-center font-weight-bold text-xs">
                              <span>
                                <?php echo $sn; ?>
                              </span>
                            </td>
                            <td class="align-middle text-center font-weight-bold text-xs">
                              <span>
                                <?php $date = date('m/d/Y', strtotime($row['date']));
                                echo $date; ?>
                              </span>
                            </td>
                            <td class="align-middle text-center font-weight-bold text-xs">
                              <span>
                                <?php
                                $t1 = $row['start'];
                                $t2 = $row['end'];

                                $start_time = date('h:i a', strtotime($t1));
                                $end_time = date('h:i a', strtotime($t2));
                                echo $start_time . " To " . $end_time;
                                ?>
                              </span>
                            </td>
                            <td class="align-middle text-center">
                              <span class="text-secondary text-xs font-weight-bold">
                                <?php
                                $t1 = strtotime($row['start']);
                                $t2 = strtotime($row['end']);
                                $hours = ($t2 - $t1) / 3600;
                                echo floor($hours) . ':' . (($hours - floor($hours)) * 60);
                                ?>
                              </span>
                            </td>
                            <td class="align-middle text-center font-weight-bold text-xs">
                              <span>
                                <?php if ($row['status'] == '1') {
                                  echo 'Pending';
                                } elseif ($row['status'] == '2') {
                                  echo 'Rejected';
                                } else {
                                  echo 'Accepted';
                                }?>
                              </span>
                          </tr>
                          <?php $sn++;
                        }
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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