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
      .card-header{
        text-align:center;
      }
      .user-card{
        padding-left: 0px !important;
        padding-right: 0px !important;
    }
  }

  @media only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

	table, thead, tbody, th, td, tr { 
		display: block; 
	}

	thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	tr { border: 1px solid #ccc; }
	
	td { 
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
	}
	
	td:before { 
		position: absolute;
		top: 6px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
	}
	
	/*
	Label the data
	*/
	td:nth-of-type(1):before { content: " Sr.No"; }
	td:nth-of-type(2):before { content: "Employee Name"; }
	td:nth-of-type(3):before { content: "Email"; }
	td:nth-of-type(4):before { content: "Password"; }
	td:nth-of-type(5):before { content: "Monthly Salary"; }
	td:nth-of-type(6):before { content: "User Type"; }
}
</style>
</head>

<body class="g-sidenav-show  bg-gray-100">
  <?php include 'sidebar.php'; ?>
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <?php include 'navbar.php'; ?>
    <div class="container-fluid py-4">
      <div class="row d-flex justify-content-center align-items-center">
        <?php include 'crudinsert.php'; ?>
        <div class="col-xl-6 col-md-6 mt-4">
          <div class="card">
            <div class="card-header pb-0 px-3">
              <h6 class="mb-0 text-center">Insert Form table</h6>
            </div>
            <div class="card-body pt-4 p-3">
              <form role="form" method="POST" action="">
                <ul class="list-group">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="name" class="form-control" placeholder="name" aria-label="name"
                      aria-describedby="name-addon" name="name" required>
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="email" aria-label="Email"
                      aria-describedby="email-addon" name="email" required>
                    <label>Password</label>
                    <input type="password" class="form-control" placeholder="password" aria-label="password"
                      aria-describedby="password-addon" name="password" required>
                    <label>Monthly Salary</label>
                    <input type="number" class="form-control" placeholder="monthly salary" min="1000"
                      aria-label="salary" aria-describedby="salary-addon" name="salary" required>
                    <div class="form-group mt-3">
                      <label class="form-control-label">User Type</label>
                    </div>
                    <div class="form-check mb-3">
                      <input class="form-check-input" type="radio" id="1" name="radio" value="1" checked="checked">
                      <label class="form-check-label" for="1">Employee</label>
                    </div>
                    <div class="form-check mb-3">
                      <input class="form-check-input" type="radio" id="2" name="radio" value="2">
                      <label class="form-check-label" for="2">Admin</label>
                    </div>
                    <button type="submit" class="btn bg-gradient-primary mt-3" name="insert">Insert</button>
                </ul>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid user-card py-4">
        <div class="row">
          <div class="col-12">
            <div class="card mb-4">
              <div class="card-header pb-0">
                <h6 class="text-center">All Employees</h6>
              </div>
              <div class="card-body px-0 pt-2 pb-2">
                <div class="table-responsive p-0">
                  <table class="table align-items-center mb-0" id="data">
                    <thead>
                      <tr>
                        <th class="text-center text-uppercase text-xs font-weight-bolder opacity-8">
                          Sr.No</th>
                        <th class="text-center text-uppercase text-xs font-weight-bolder opacity-8">
                          Employee Name</th>
                        <th class="text-center text-uppercase text-xs font-weight-bolder opacity-8">
                          Email</th>
                        <th class="text-center text-uppercase text-xs font-weight-bolder opacity-8">
                          Password</th>
                        <th class="text-center text-uppercase text-xs font-weight-bolder opacity-8">
                          Monthly Salary</th>
                        <th class="text-center text-uppercase text-xs font-weight-bolder opacity-8">
                          User Type</th>
                        <th class="text-center text-uppercase text-xs font-weight-bolder opacity-8">
                          EDIT</th>
                        <th class="text-center text-uppercase text-xs font-weight-bolder opacity-8">
                          DELETE</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $results = mysqli_query($con, "SELECT * FROM user");
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
                              <?php echo $row['user_name']; ?>
                            </span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">
                              <?php echo $row['user_email']; ?>
                            </span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">
                              <?php echo $row['user_password']; ?>
                            </span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">
                              <?php if (isset($row['monthly_salary'])) {
                                echo $row['monthly_salary'];
                              } else {
                                echo "None";
                              } ?>
                            </span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">
                              <?php if ($row['user_type'] == 1) {
                                echo "User";
                              } else {
                                echo "Admin";
                              } ?>
                            </span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold"><a class="btn bg-gradient-primary"
                                name="edit" href="EditUser.php?edit=<?php echo $row['user_id']; ?>">Edit</a></span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold"><a class="btn bg-gradient-primary"
                                name="delete"
                                href="cruddelete.php ?delete=<?php echo $row['user_id']; ?>">Delete</a></span>
                          </td>
                        </tr>
                        <?php
                        $sn++;
                      }
                      ?>
                </div>
              </div>
              </table>
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