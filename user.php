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
  <link rel="stylesheet" href="sweetalert2.min.css">
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
    
    }
    
    
  </style>
</head>

<body class="g-sidenav-show  bg-gray-100">
    
<!-- Data Delete Query Start hear -->

<?php

if(isset($_GET['id'])){
  $id=mysqli_real_escape_string($con,$_GET['id']);
  $type=mysqli_real_escape_string($con,$_GET['type']);
  
  if($type=='active'){
    $status=1;
    $script = "<script>
                 window.location = 'ManageUser.php?url=Manage User';</script>";
                 echo $script;
  }else{
    $status=0;
    $script = "<script>
                 window.location = 'ManageUser.php?url=Manage User';</script>";
                 echo $script;
  }
  

  mysqli_query($con,"UPDATE user set user_status='$status' where user_id='$id'");
}


    if (isset($_GET['u_id']))
    {
    $user_id = $_GET['u_id'];
   
    if($_GET['action'] == "delete"){

        
        
        $sql = "DELETE from overtime where user_id = $user_id";  
        $result = mysqli_query($con, $sql);
        
        if($result)
        {  
            //  $script = "<script>
            //      alert('Record deleted successfully');</script>";
            //  echo $script;
           //echo "Record deleted successfully";
           $sql = "DELETE from user where user_id = $user_id";  
           $result = mysqli_query($con, $sql);
            $script = "<script>
                 window.location = 'ManageUser.php?url=Manage User';</script>";
                 echo $script;
        }
        else
        {  
           // echo "Could not deleted record: ";  
        } 
    }
    }
?>
<!-- Data Delete Query End hear -->


   <!-- Start Sidebar --> 
     <?php include "sidebar.php"; ?>
  <!-- End Sidebar --> 

  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <!--Start Navbar -->
    <?php include "navbar.php"; ?>
    <!-- End Navbar -->

    <!-- Main Start Contant Here  -->
        
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Manage User table</h6>
            </div>
            <!--<div class="m-3">-->
            <!--    <a class="btn btn-warning bg-gradient-warning" href="add_user.php?url=Add_user">+ ADD USER</a>-->
            <!--</div>-->
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0 pt-2 pb-5" id="data">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" name="user_id">Sr.no</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Photo</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Monthly Salary</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created Date </th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    
                        if($_GET['user_type'] == "")
                        {
                            //$status=3;
                        }
                        else
                        {
                             $user_type = $_GET['user_type'];
                        }
                    
                        $sql = "SELECT * FROM user where user_type = $user_type";
                        $result = mysqli_query($con, $sql);
                      
                        if (mysqli_num_rows($result) > 0)
                        {
                            $sr_no = 1;
                            while($row = mysqli_fetch_assoc($result))
                            {
                                $u_id = $row['user_id'];
                    ?>
                    <tr>  
                      <td>
                        <div class="text-secondary text-xs font-weight-bold text-center"><?php echo $sr_no ?> </div>
                      </td>
                      <td class="text-center">
                          <img class="w-50 img-fluid" src="assets/<?php echo $row['user_image']; ?>" alt="img not found">
                      </td>
                      <td>
                          <?php
                                if($row['user_type'] == 3)
                                {
                          ?>
                          <a href="bde_main_data.php?url=BDE DATA&b_id=<?php echo $u_id ?>" class="text-sm mb-0 text-capitalize font-weight-bold">
                                    <div class="text-secondary text-xs font-weight-bold"><?php echo $row['user_name']; ?></div>
                                    </a>
                          <?php          
                                }
                                else{
                                    ?>
                                     <div class="text-secondary text-xs font-weight-bold"><?php echo $row['user_name']; ?></div>
                                    <?php
                                }
                          ?>
                         
                      </td>
                      <td>
                        <div class="text-secondary text-xs font-weight-bold"><?php echo $row['user_email']; ?></div>
                      </td>
                      <td>
                        <div class="text-secondary text-xs font-weight-bold"><?php  if ($row['user_type'] == 2){
                            echo "<p class='badge bg-danger'> Admin </p>"; }
                            elseif($row['user_type'] == 1)
                            {
                                echo "<p class='badge bg-info'>Developer</p>";
                            }
                            elseif($row['user_type'] == 3)
                            {
                                echo "<p class='badge bg-info'>BDE</p>";
                            }
                            else{
                                echo "<p class='badge bg-info'> Normal user </p>";
                            }
                        ; ?></div>
                      </td>
                      
                      <td>
                        <div class="text-secondary text-xs font-weight-bold"><?php echo $row['monthly_salary']; ?>
                        
                            <a href="edit_salary.php?&u_id=<?php echo $u_id ?>&action=edit&usertype=<?php echo $user_type?>"  class="btn badge bg-gradient-primary font-weight-bold">+</a></div>
                    
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $row['created_date']; ?></span>
                      </td>
                      <td class="align-middle text-center">
                        
                       
                        <?php
                      if($row['user_status']== 1){
                        echo "<a href='?id=".$row['user_id']."&type=deactive' class='btn btn-info bg-gradient-success' >Active</a>";
                      }else{
                        echo "<a href='?id=".$row['user_id']."&type=active' class='btn btn-danger'>Deactive</a>";
                      }
                     ?>

                     
                      </td>
                      <td class="align-middle text-center text-sm">
                                
                            <a href="EditUser.php?edit=<?php echo $u_id?>&dashboard=1&url=<?php echo $_GET['url']?>&user_type=<?php echo $_GET['user_type']?>"  class="btn bg-gradient-primary text-xs font-weight-bold">Edit</a>
                            
                              <a href="
                              user.php?url=user&u_id=<?php echo $u_id ?>&action=delete"  type="submit" class="btn bg-gradient-primary text-xs font-weight-bold"> Delete </a>
                      
                      </td>
                    </tr>
                    <?php
                    $sr_no++;
                        }
                        }
                    ?>                        
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

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

