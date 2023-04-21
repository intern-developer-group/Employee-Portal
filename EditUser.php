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

<body class="g-sidenav-show  bg-gray-100">
  <?php include 'sidebar.php'; ?>
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <?php include 'navbar.php'; ?>
    <?php include 'crudupdate.php'; ?>
    <div class="container-fluid py-4">
      <div class="row d-flex justify-content-center align-items-center">
        <div class="col-xl-6 col-md-6 mt-4">
          <div class="card">
            <div class="card-header pb-0 px-3">
              <h6 class="mb-0 text-center">Update user details</h6>
            </div>
            <div class="card-body pt-4 p-3">
              <form role="form" method="POST" action="" enctype="multipart/form-data">
                <ul class="list-group">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="name" class="form-control" placeholder="name" aria-label="Name"
                      aria-describedby="name-addon" name="name" required value=<?php echo $name; ?>>
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="email" aria-label="Email"
                      aria-describedby="email-addon" name="email" required value=<?php echo $email; ?>>
                    <label>Password</label>
                    <input type="text" class="form-control" placeholder="password" aria-label="text"
                      aria-describedby="text-addon" name="password" required value=<?php echo $password; ?>>
                    <label>Monthly Salary</label>
                    <input type="number" class="form-control" placeholder="monthly salary" min="1000"
                      aria-label="salary" aria-describedby="salary-addon" name="salary" required value=<?php echo $salary; ?>>
                      <label  class="form-label">Photo</label></br>
                  <div class="avatar avatar-xl position-relative">
                    <img  alt="profile_image" src="assets/<?php echo $img;?>"  class="w-100 border-radius-lg shadow-sm" name="photo"   >
                  </div>
                  <input type="file" name="userimage" class="form-control"/>
                    <label>usertype</label>
                    <input type="text" class="form-control" placeholder="user type" aria-label="usertype"
                      aria-describedby="usertype-addon" name="usertype" required value=<?php echo $usertype; ?>>
                    <button type="submit" class="btn bg-gradient-primary mt-3 w-30" name="update">Update</button>
                </ul>
              </form>
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
</body>

</html>