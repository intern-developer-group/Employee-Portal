<?php
include 'dbcon.php';
?>
<?php $activePage = basename($_SERVER['PHP_SELF'], ".php"); ?>
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
  navbar-scroll="true">
  <div class="container-fluid py-1 px-3">

    <?php function ACTIVEPAGE($page, $page1)
    { ?>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">pages</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
            <?php echo "$page" ?>
          </li>
        </ol>
        <h6 class="font-weight-bolder mb-0">
          <?php echo "$page";
          echo " $page1"; ?>
        </h6>
      </nav>
    <?php } ?>
    <?php if ($activePage == 'dashboard') { ?>
      <?php ACTIVEPAGE('Dashboard', '') ?>
    <?php } elseif ($activePage == 'admin_dashboard') { ?>
      <?php ACTIVEPAGE('Admin Dashboard', '') ?>
    <?php } elseif ($activePage == 'user') { ?>
      <?php ACTIVEPAGE('Admin Dashboard', '/ Manage User') ?>
    <?php } elseif ($activePage == 'edit_salary') { ?>
      <?php ACTIVEPAGE('Admin Dashboard', '/ Edit Salary') ?>

    <?php } elseif ($activePage == 'ManageUser') { ?>
      <?php ACTIVEPAGE('ManageUser', '') ?>
    <?php } elseif ($activePage == 'EditUser') { ?>
      <?php ACTIVEPAGE('ManageUser', '/ Edit') ?>


    <?php } elseif ($activePage == 'attendance') { ?>
      <?php ACTIVEPAGE('Attendance', '') ?>
    <?php } elseif ($activePage == 'dayspresent') { ?>
      <?php ACTIVEPAGE('Attendance', '/ Days Present') ?>
    <?php } elseif ($activePage == 'dayleave') { ?>
      <?php ACTIVEPAGE('Attendance', '/ Days Leave') ?>
    <?php } elseif ($activePage == 'addattendance') { ?>
      <?php ACTIVEPAGE('Attendance', '/ Add Attendance') ?>
    <?php } elseif ($activePage == 'applyforleaves') { ?>
      <?php ACTIVEPAGE('Attendance', '/ Days Leave') ?>
    <?php } elseif ($activePage == 'admin_attendance') { ?>
      <?php ACTIVEPAGE('Admin Attendance', '') ?>
    <?php } elseif ($activePage == 'admin_attendance') { ?>
      <?php ACTIVEPAGE('Admin Attendance', '') ?>
    <?php } elseif ($activePage == 'view_employee_attendance') { ?>
      <?php ACTIVEPAGE('Admin Attendance', '/ view') ?>
    <?php } elseif ($activePage == 'view_employee_present') { ?>
      <?php ACTIVEPAGE('Admin Attendance', '/ present') ?>
    <?php } elseif ($activePage == 'view_employee_absent') { ?>
      <?php ACTIVEPAGE('Admin Attendance', '/ absent') ?>
    <?php } elseif ($activePage == 'view_holiday') { ?>
      <?php ACTIVEPAGE('Admin Attendance', '/ holiday') ?>

    <?php } elseif ($activePage == 'overtime') { ?>
      <?php ACTIVEPAGE('Overtime', '') ?>
    <?php } elseif ($activePage == 'addOvertime') { ?>
      <?php ACTIVEPAGE('Overtime', '/ Add Overtime') ?>
    <?php } elseif ($activePage == 'ManageOvertime') { ?>
      <?php ACTIVEPAGE('Manage Overtime', '') ?>

    <?php } elseif ($activePage == 'ManageLeave') { ?>
      <?php ACTIVEPAGE('Manage Leave', '') ?>

    <?php } elseif ($activePage == 'ManageHoliday') { ?>
      <?php ACTIVEPAGE('Manage Holiday', '') ?>
    <?php } elseif ($activePage == 'EditHoliday') { ?>
      <?php ACTIVEPAGE('Manage Holiday', '/ Edit ') ?>

    <?php } else { ?>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">pages</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Holidays</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Holidays</h6>
      </nav>

    <?php } ?>
    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
      <div class="ms-md-12 pe-md-3 d-flex align-items-center" style="visibility:hidden;">
        <div class="input-group">
          <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
          <input type="text" class="form-control" placeholder="Type here...">
        </div>
      </div>
      <ul class="navbar-nav  justify-content-end">
        <li class="nav-item ms-md-auto pe-md-3 d-flex align-items-center">
          <a href="logout.php" class="nav-link text-body font-weight-bold px-0">
            <i class="fa fa-user me-sm-1"></i>
            <span class="d-sm-inline d-none">Sign Out</span>
          </a>
        </li>
        <li class="nav-item d-xl-none ms-md-auto pe-md-3 ps-3 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </a>
        </li>
        <?php
        $user_id = $_SESSION['user_id'];
        $sql2 =
          $result = mysqli_query($con, "SELECT * from leave_data WHERE user_id='$user_id' AND leave_status = 'Pending' AND read_status='0'");
        $count = mysqli_num_rows($result);
        if (isset($_GET['action'])) {

        }
        ?>
        <form method="POST" action="">
          <li class="nav-item dropdown ms-md-auto pe-md-3 d-flex align-items-center">
            <a class="nav-link" href="&action=read" type="submit" role="button" data-bs-toggle="dropdown"
              aria-expanded="false" name="submit">
              <i class="fa fa-bell cursor-pointer"></i><span
                class="badge rounded-pill bg-danger text-center d-inline-flex align-items-center justify-content-center"
                style="width:10%; height:2vh; position: relative; top: -10px; left: -6px;">
                <?php echo $count; ?>
              </span>
            </a>
            <ul class="dropdown-menu">
              <?php
              $result = mysqli_query($con, "SELECT * from leave_data WHERE user_id='$user_id' AND leave_status!='Pending'");
              if (mysqli_num_rows($result) > 0) {
                while ($query = mysqli_fetch_array($result)) { ?>
                  <li><a class="dropdown-item" href="applyforleaves.php">Your
                      <?php echo $query['leave_type']; ?> is
                      <?php echo $query['leave_status']; ?>
                    </a></li>
                  <div class="dropdown-divider"></div>
                  <?php
                }
              } else {
                echo '<li><a class="dropdown-item text-danger font-weight-bold" href="applyforleaves.php"><i class="fas fa-frown-open"></i>Sorry! No Messages</a></li>';
              }
              ?>
            </ul>
            </button>
          </li>
        </form>
      </ul>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
    integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>

  </script>
</nav>