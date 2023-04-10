<?php
session_start();
?>
<?php
  include 'dbcon.php'; ?>
<!-- DELETE QUERY HERE -->
<?php
if (isset($_GET['action'])) {
  if ($_GET['action'] == "delete") {
    $holiday_id = $_GET['id'];
    $result = mysqli_query($con, "SELECT * from holiday where id='$holiday_id'");
    $row = mysqli_fetch_array($result);
    $holiday_start_date = $row['holiday_start_date'];
    $holiday_end_date = $row['holiday_end_date'];

    $sql = "delete from holiday where id = $holiday_id";

    $result = mysqli_query($con, $sql);

    if ($result) {
      $sql2 = "UPDATE attendance SET is_update='not_updated' , attendance_status = '0' WHERE attendance_date BETWEEN '$holiday_start_date' and '$holiday_end_date'";
      $result = mysqli_query($con, $sql2);
      $result3 = mysqli_query($con,"ALTER TABLE holiday AUTO_INCREMENT = $holiday_id");
      $script = "<script>
                 alert('Record deleted successfully');</script>";
      echo $script;
      
      $script = "<script>
                 window.location = 'ManageHoliday.php?url=Manage Holidays';</script>";
      echo $script;
      $result3 = mysqli_query($con,"ALTER TABLE holiday AUTO_INCREMENT = $holiday_id");
    } else {
      echo "Could not deleted record: ";
    }
  }
}
?>
<!-- INSERT QUERY HERE -->
<?php
$holiday_name = "";
$holiday_start_date = "";
$holiday_end_date = "";

if (isset($_POST['submit'])) {
  if ($_POST['holiday_end_date'] == "") {
    $_POST['holiday_end_date'] = $_POST['holiday_start_date'];
  }
  $holiday_name = $_POST['holiday_name'];
  $holiday_type = $_POST['holiday_type'];
  $holiday_start_date = $_POST['holiday_start_date'];
  $holiday_end_date = $_POST['holiday_end_date'];
  $sql = "INSERT INTO holiday (holiday_name ,holiday_type ,holiday_start_date ,holiday_end_date) VALUES ('$holiday_name','$holiday_type','$holiday_start_date','$holiday_end_date')";
  if (mysqli_query($con, $sql)) {
    echo '<script type ="text/JavaScript">';
    echo 'alert("Holiday Added")';
    echo '</script>';

    // echo $holiday_end_date ;
    // echo $holiday_start_date ;

    // update attendance data for paid holidays
    $sql2 = "UPDATE attendance set is_update='updated' , attendance_status = '3' WHERE attendance_date BETWEEN '$holiday_start_date' and '$holiday_end_date'";
    $result = mysqli_query($con, $sql2);
  } else {
    echo "something is wrong";
  }
}
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
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <?php include 'navbar.php'; ?>

    <div class="container-fluid py-4">
      <div class="row justify-content-center">
        <div class="card  w-xl-50 w-lg-50 w-md-50 w-sm-75">
          <div class="row ">
            <h4 class="text-center p-2">Add Holidays</h4>
          </div>
          <form class="mt-3" method="POST">
            <!-- Name -->
            <div class="form-group">
              <label class="form-control-label">Holiday Name</label>
              <input class="form-control" type="text" placeholder="Enter Reason" name="holiday_name" required>
            </div>

            <div class="form-group">
              <label class="form-control-label">Days of Leave</label>
              <select class="form-select" id="slelectID" name="holiday_type">
                <option value="1">One Day Holiday</option>
                <option value="2">Multiple Days Holiday</option>
              </select>
            </div>

            <span>
              <!--one day-->
              <label class="form-label">Start Date</label>
              <input id="files" class="form-control" type="Date" name="holiday_start_date" required />
            </span>

            <span class="box" style="display: none;">
              <!--end date-->
              <label class="form-label">End Date</label>
              <input class="form-control" type="Date" name="holiday_end_date" />
            </span>

            <div class="form-group mt-4">
              <input class=" btn btn-primary bg-gradient-primary" type="submit" value="Submit" name="submit">
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h5 class="align-middle text-center pb-3">Holiday List</h5>
            </div>
            <div class="card-body px-0 pt-1 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0" id="data">
                  <thead>
                    <tr>
                      <th class="text-center text-uppercase text-xs font-weight-bolder opacity-8"
                        name="user_id">Sr.no</th>
                      <th class="text-center text-uppercase text-xs font-weight-bolder opacity-8"
                        name="user_id">Holiday Name</th>
                      <th class="text-center text-uppercase text-xs font-weight-bolder opacity-8">Start Date
                      </th>
                      <th class="text-center text-uppercase text-xs font-weight-bolder opacity-8">End Date
                      </th>
                      <th class="text-center text-uppercase text-xs font-weight-bolder opacity-8">Action
                      </th>
                      <th class="text-center text-uppercase text-xs font-weight-bolder opacity-8">Action
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $results = mysqli_query($con, "SELECT * FROM holiday");
                    if (mysqli_num_rows($results) > 0) {
                      $sn = 1;
                      while ($row = mysqli_fetch_array($results)) {
                        ?>
                        <tr>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">
                              <?php echo $sn; ?>
                            </span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">
                              <?php echo $row['holiday_name']; ?>
                            </span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">
                              <?php echo $row['holiday_start_date']; ?>
                            </span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">
                              <?php echo $row['holiday_end_date']; ?>
                            </span>
                          </td>
                          <?php
                                    $holiday_id = $row['id'];
                                    $holiday_start_date=$row['holiday_start_date'];
                                    $holiday_end_date =$row['holiday_end_date'];
                                    ?>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold"><a class="btn bg-gradient-primary"
                                name="edit" href="EditHoliday.php?id=<?php echo $holiday_id; ?>&action=edit">Edit</a></span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold"><a class="btn bg-gradient-primary"
                                name="delete" href="ManageHoliday.php?id=<?php echo $holiday_id; ?> &action=delete">Delete</a></span>
                          </td>
                        </tr>
                        <?php
                        $sn++;
                      }
                    }
                    ?>
              </div>
            </div>
            </table>
            <script src="https://code.jquery.com/jquery-3.6.0.js"
              integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/jquery-2.2.4.js"
              integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
            <script>
              $(document).ready(function () {
                $('#slelectID').on('change', function () {

                  if (this.value == '2') {
                    $(".box").show();
                  }
                  else {
                    $(".box").hide();
                  }
                });
              });
            </script>
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