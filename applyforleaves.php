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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

  <style>
    .pagination-f {
      width: 100px !important;
    }

    .dt-buttons {
      padding-left: 1.5rem;
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

    @media only screen and (max-width:650px) {
      .dt-buttons {
        padding-bottom: 1rem;
      }
    }
  </style>
</head>

<body class="g-sidenav-show  bg-gray-100">
  <?php include 'sidebar.php'; ?>
  <?php include 'dbcon.php'; ?>

  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <?php include 'navbar.php'; ?>
    <?php
    if (isset($_POST['submit'])) {
      $startdate = $_POST['startdate'];
      $userid = $_SESSION['user_id'];
      $date = date('Y-m-d');

      // to check if already on leave or not
    
      $result1 = mysqli_query($con, "SELECT * FROM leave_data where user_id = '$userid' and  leave_start_date ='$startdate'");
      $row1 = mysqli_fetch_array($result1);
      if (isset($row1['leave_start_date'])) {
        $get_date = $row1['leave_start_date'];
      }
      $result2 = mysqli_query($con, "SELECT * FROM attendance where user_id = '$userid' and attendance_date ='$startdate' and is_update='updated'");
      $row2 = mysqli_fetch_array($result2);
      if (isset($row2['is_update'])) {
        $get_status = $row2['is_update'];
      }
      if (mysqli_num_rows($result1) != 0) {
        echo '<script type ="text/JavaScript">';
        echo 'alert("you have already Applied for Leave")';
        echo '</script>';
      } elseif (mysqli_num_rows($result2) != 0) {
        echo '<script type ="text/JavaScript">';
        echo 'alert("you are Present on that day.")';
        echo '</script>';
      }


      // insert for leaves code starts here
      else {

        $startdate = $_POST['startdate'];

        if (!empty($_POST['enddate'])) {
          $enddate = $_POST['enddate'];
        } else {
          $enddate = $startdate;
        }


        //calculate days between two date
    
        $firstdate = strtotime($startdate);
        $seconddate = strtotime($enddate);
        if ($firstdate == $seconddate) {
          $total_days = 1;
        } else {
          $datediff = $seconddate - $firstdate;
          $total_days = ($datediff / (60 * 60 * 24));
        }

        //main insert for leaves code starts here
    
        $radio = $_POST['radio'];
        $userid = $_SESSION['user_id'];
        $name = $_POST['start'];

        $reason = $_POST['reason'];
        $reason_escape = mysqli_real_escape_string($con, $reason);

        $description = $_POST['description'];
        $description_escape = mysqli_real_escape_string($con, $description);

        $update_month = date("m");
        $year = date('Y');


        //calculate paid leave , medical leave
    
        $result3 = mysqli_query($con, "SELECT * FROM leaves_count where user_id ='$userid' and month(created_date) = '$update_month' and year(created_date) = '$year'");
        $row3 = mysqli_fetch_array($result3);
        $get_paid_leave = $row3['paid_leave'];
        $get_medical_leave = $row3['medical_leave'];
        $get_total_paid_leave = $row3['total_paid_leave'];
        $get_total_medical_leave = $row3['total_medical_leave'];


        //for paid leave
    
        if ($radio == 'Paid Leave') {
          if ($get_paid_leave == '0') {
            echo '<script type ="text/JavaScript">
                            	alert("You have already take one paid leave")
                                window.location = "applyforleaves.php";
                            </script>';
          } else {
            $sql = "INSERT INTO leave_data(user_id,leave_reason,leave_description,leave_type,leave_start_date,leave_end_date,total_days)
                            VALUES('$userid','$reason_escape','$description_escape','$radio','$startdate','$enddate','$total_days')";
            if (mysqli_query($con, $sql)) {
              $result = mysqli_query($con, "UPDATE leaves_count set paid_leave = '0' WHERE user_id = '$userid' and month(created_date) = '$update_month' and year(created_date) = '$year'");
            } else {
              echo "Error: 1";
            }
          }


          //for medical leave
    
        } elseif ($radio == 'Medical Leave') {
          if ($get_medical_leave == '0') {
            echo '<script type ="text/JavaScript">
                                      alert("You have already take one paid leave")
                                        window.location = "applyforleaves.php";
                                    </script>';
          } else {
            $sql = "INSERT INTO leave_data(user_id,leave_reason,leave_description,leave_type,leave_start_date,leave_end_date,total_days)
                              VALUES('$userid','$reason_escape','$description_escape','$radio','$startdate','$enddate','$total_days')";
            if (mysqli_query($con, $sql)) {
              $result = mysqli_query($con, "UPDATE leaves_count set medical_leave = '0' WHERE user_id = '$userid' and month(created_date) = '$update_month' and year(created_date) = '$year'");
            } else {
              echo "Error: 2";
            }
          }


          // for normal leave
    
        } else {
          $sql = "INSERT INTO leave_data(user_id,leave_reason,leave_description,leave_type,leave_start_date,leave_end_date,total_days)
                              VALUES('$userid','$reason_escape','$description_escape','$radio','$startdate','$enddate','$total_days')";
          if (mysqli_query($con, $sql)) {
          } else {
            echo "Error: 3";
          }
        }
      }
    }
    ?>
    <div class="container-fluid py-4">
      <div class="row d-flex justify-content-center align-items-center">
        <div class="col-xl-6 col-md-6 mt-4">
          <div class="card">
            <div class="card-header pb-0 px-3">
              <h6 class="mb-0 text-center">Apply For Leaves</h6>
            </div>
            <div class="card-body pt-4 p-3">
              <form method="post" action="">
                <ul class="list-group">
                  <div class="form-group">
                    <?php
                    $userid = $_SESSION['user_id'];
                    $result = mysqli_query($con, "SELECT user_name from user where user_id='$userid'");
                    while ($row = mysqli_fetch_array($result)) {
                      ?>
                      <label>Name</label>
                      <input class="form-control" type="text" name="start" value="<?php echo $row['user_name']; ?>"
                        readonly>
                      <label>Reason</label>
                    <?php } ?>
                    <input class="form-control" type="text" name="reason" required>
                    <label>Description</label>
                    <input class="form-control" type="text" name="description" required>

                    <div class="form-group mt-3">
                      <label class="form-control-label">Check Only One Leave Type</label>
                    </div>
                    <div class="form-check mb-3">
                      <input class="form-check-input" type="radio" id="1" name="radio" value="Medical Leave"
                        onclick="show1();">
                      <label class="form-check-label" for="1">Medical Leave</label>
                    </div>
                    <div class="form-check mb-3">
                      <input class="form-check-input" type="radio" id="2" name="radio" value="Paid Leave"
                        onclick="show2();">
                      <label class="form-check-label" for="2">Paid Leave</label>
                    </div>
                    <div class="form-check ">
                      <script type="text/javascript">
                        $(function () {
                          $("#3").on("click", function () {
                            $(".enddate").toggle(this.checked);
                          });
                        });
                      </script>
                      <input class="form-check-input" type="radio" id="3" name="radio" value="Normal Leave"
                        onclick="show3();">
                      <label class="form-check-label" for="3">Normal Leave</label>
                    </div>
                    <script>
                      function show1() {
                        document.getElementById('enddate').style.display = 'none';
                      }
                      function show2() {
                        document.getElementById('enddate').style.display = 'none';
                      }
                      function show3() {
                        document.getElementById('enddate').style.display = 'block';
                      }
                    </script>
                  </div>
                  <label for="startdate">Start Date</label>
                  <input class="form-control mb-2" id="startdate" type="date" name="startdate" required>
                  <div class="enddate" style="display:none" id="enddate">
                    <label for="enddate">End Date</label>
                    <input class="form-control mb-2" type="date" name="enddate">
                  </div>
                  <button class="btn bg-gradient-primary mt-3 w-30" name="submit">Submit</a>
                </ul>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid py-5">
        <div class="row">
          <div class="col-12">
            <div class="card mb-4">
              <div class="card-header pb-0">
                <h6>Leave List</h6>
              </div>

              <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                  <table class="table align-items-center mb-0" id="data">
                    <thead>
                      <tr>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                          Sr.No</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name
                        </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                          Reason</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                          Description</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                          Leave Type</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                          Start Date</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">End
                          Date</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                          Status</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                          Reject Reason</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sn = 1;
                      $userid = $_SESSION['user_id'];
                      $result = mysqli_query($con, "SELECT * from leave_data where user_id='$userid'");
                      $result1 = mysqli_query($con, "SELECT user_name from user where user_id='$userid'");
                      $row1 = mysqli_fetch_array($result1);
                      while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold ">
                              <?php echo $sn; ?>
                            </span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold ">
                              <?php echo $row1['user_name']; ?>
                            </span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">
                              <?php echo $row['leave_reason']; ?>
                            </span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">
                              <?php echo $row['leave_description']; ?>
                            </span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">
                              <?php echo $row['leave_type']; ?>
                            </span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">
                              <?php echo $row['leave_start_date']; ?>
                            </span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">
                              <?php echo $row['leave_end_date']; ?>
                            </span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">
                              <?php echo $row['leave_status']; ?>
                            </span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">
                              <?php echo $row['leave_reject_reason']; ?>
                            </span>
                          </td>
                        </tr>
                        <?php $sn++;
                      } ?>
                    </tbody>
                </div>
                </table>
                <br>
              </div>

            </div>
  </main>
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