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
        text-align:center;
        padding-left:0px;
      }
      .dt-button{ 
        padding: 0.25rem 1.5rem;
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
    if (isset($_GET['action'])) {
      if ($_GET['action'] == "approve") {
        $ot_userid = $_GET['id'];
        $ot_id = $_GET['tableid'];
        $sql = "UPDATE overtime SET status='0' WHERE user_id = '$ot_userid' AND id = '$ot_id'";
        $result = mysqli_query($con, $sql);
      } else {
        $ot_userid1 = $_GET['id'];
        $ot_id1 = $_GET['tableid'];
        $sql1 = "UPDATE overtime SET status='2' WHERE user_id = '$ot_userid1' AND id = '$ot_id1'";
        $result1 = mysqli_query($con, $sql1);
      }
    }

    ?>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h5 class="p-2 text-center">Employee Overtime List</h5>
            </div>
            <div class="card-body px-0 pt-2 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0" id="overtimedata">
                  <thead>
                    <tr>
                      <th class="text-center text-uppercase text-xs font-weight-bolder opacity-8">Sr.No</th>
                      <th class="text-center text-uppercase text-xs font-weight-bolder opacity-8">Employee Name</th>
                      <th class="text-center text-uppercase text-xs font-weight-bolder opacity-8">Start Time</th>
                      <th class="text-center text-uppercase text-xs font-weight-bolder opacity-8">End Time</th>
                      <th class="text-center text-uppercase text-xs font-weight-bolder opacity-8">Total Time</th>
                      <th class="text-center text-uppercase text-xs font-weight-bolder opacity-8">Status</th>
                      <th class="text-center text-uppercase text-xs font-weight-bolder opacity-8">Date</th>
                      <th class="text-center text-uppercase text-xs font-weight-bolder opacity-8">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT ";
                    $todaymonth = date('m');
                    $todayyear = date('Y');
                    $sql = "SELECT overtime.id,overtime.user_id,overtime.start,overtime.end,overtime.date,overtime.status,overtime.total_hours,user.user_name,user.user_type from overtime INNER JOIN user WHERE overtime.user_id=user.user_id and overtime.status='1' and user.user_type='1' and month(overtime.date)=$todaymonth and year(overtime.date)=$todayyear";
                    $result = mysqli_query($con, $sql);
                    if (mysqli_num_rows($result) > 0) {
                      $sn = 1;
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
                              <?php echo $row['user_name'] ?>
                            </span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold ">
                              <?php echo $row['start'] ?>
                            </span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold ">
                              <?php echo $row['end'] ?>
                            </span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold ">
                              <?php echo date('g:i', strtotime($row['total_hours'])); ?> hrs
                            </span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold ">
                              <?php echo 'Pending'; ?>
                            </span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold ">
                              <?php echo $row['date'] ?>
                            </span>
                          </td>
                          <form method="POST" action="">
                            <td>
                              <div>
                                <a href="ManageOvertime.php?id=<?php echo $row['user_id']; ?>&tableid=<?php echo $row['id']; ?>&action=approve"
                                  class='btn btn-info bg-gradient-info' name="approve">Approve</a>
                                <a href="ManageOvertime.php?id=<?php echo $row['user_id']; ?>&tableid=<?php echo $row['id']; ?>&action=reject"
                                  class='btn btn-info bg-gradient-danger' name="reject">Reject</a>
                              </div>
                          </form>
                        </tr>
                        <?php $sn++;
                      }
                    } ?>
              </div>

            </div>
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
      $('#overtimedata').DataTable({
        dom: 'Bfrtip',
        buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ]
      });
    });
  </script>

</body>

</html>