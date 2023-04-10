<?php
include 'dbcon.php';
?>

<!-- Data Update Query Start hear -->

<?php

if (isset($_POST['Update'])) {
  $holiday_id = $_GET['id'];
  $holiday_name = $_POST['holiday_name'];
  $holiday_start_date = $_POST['holiday_start_date'];
  $holiday_end_date = $_POST['holiday_end_date'];

  if ($_GET['status'] == "mul1") {
    $holiday_end_date = $_POST['holiday_start_date'];
  } elseif ($_GET['status'] == "mul2") {
    $holiday_end_date = $_POST['holiday_end_date'];
  }

  // if($holiday_start_date != $holiday_end_date)
  // {
  //     $holiday_end_date = $_POST['holiday_end_date'];
  //      echo "start date is =" .$_POST['holiday_start_date']."and end date". $holiday_end_date;
  // }else{
  //       $holiday_end_date = $holiday_start_date;
  //      echo "start date is =" .$_POST['holiday_start_date']."and end date". $holiday_end_date;
  // }
  // echo $holiday_end_date;

  $sql = "UPDATE holiday set holiday_name = '$holiday_name', holiday_start_date = '$holiday_start_date', holiday_end_date = '$holiday_end_date' WHERE id = $holiday_id";
  $result = mysqli_query($con, $sql);

  $script = "<script>window.location = 'ManageHoliday.php';</script>";
  echo $script;
}
?>

<!-- Data Update Query Start hear -->
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
<!DOCTYPE html>
<html lang="en">

<body class="g-sidenav-show  bg-gray-100">

  <!-- Start Sidebar -->
  <?php include "sidebar.php"; ?>
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <!-- End Sidebar -->

    <!--Start Navbar -->
    <?php include "navbar.php"; ?>
    <!-- End Navbar -->

    <!-- Main Start Contant Here  -->
    <div class="container-fluid py-4">
      <div class="row justify-content-center">

        <div class="card  w-xl-50 w-lg-50 w-md-50 w-sm-75">
          <div class="row">
            <h4 class="text-center p-2">Edit Holidays</h4>
          </div>
          <?php
          if (isset($_GET['id'])) {
            $holiday_id = $_GET['id'];

            if ($_GET['action'] == "edit") {
              $sql = "SELECT * FROM holiday where id = '$holiday_id'";
              $result = mysqli_query($con, $sql);
              $row = mysqli_fetch_array($result);
            }

          }
          ?>
          <form class="mt-3" method="POST">
            <!-- Name -->
            <div class="form-group">
              <label class="form-control-label">Holiday Name</label>
              <input class="form-control" type="text" placeholder="Enter Reason"
                value="<?php echo $row['holiday_name']; ?>" name="holiday_name" required>
            </div>

            <div class="form-group">
              <label class="form-control-label">Days of Holidays</label>
              <select class="form-select" id="slelectID" name="holiday_type">
                <option value="1" <?php if ($row['holiday_type'] == 1) {
                  echo ' selected="selected"';
                } ?>>One Day Holiday
                </option>
                <option value="2" <?php if ($row['holiday_type'] == 2) {
                  echo ' selected="selected"';
                } ?>>Multiple Days
                  Holiday</option>
              </select>
            </div>

            <span>
              <!--start date-->
              <label class="form-label">Start Date</label>
              <input id="files" class="form-control" type="Date" name="holiday_start_date"
                value="<?php echo $row['holiday_start_date']; ?>" required />
            </span>

            <span class="box" style="display: none;">
              <!--end date-->
              <label class="form-label">End Date</label>
              <input class="form-control" type="Date" name="holiday_end_date"
                value="<?php echo $row['holiday_end_date']; ?>" />
            </span>

            <div class="form-group mt-4">
              <input class=" btn btn-primary bg-gradient-primary" type="submit" value="Submit" name="Update">
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Main End Contant Here  -->

    <div class="container-fluid py-4">
      <!-- Start Footer -->
      <!-- End Footer -->
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
</body>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
  crossorigin="anonymous"></script>
<script>
  $(document).ready(function () {

    var get_status = "<?php echo $_GET['status']; ?>";
    if (get_status == 'mul2') {
      $(".box").show();
      //here is your code
    } else {
      $(".box").hide();
    }
  });
</script>

</html>