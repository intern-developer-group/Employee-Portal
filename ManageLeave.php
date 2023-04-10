<?php
session_start();
?>
<?php include 'dbcon.php'; ?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

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
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <!--Start Navbar -->
    <?php include "navbar.php"; ?>
    <!-- End Navbar -->

    <!-- Approve Query Starts Here -->
    <?php
    if (isset($_GET['action'])) {
      if ($_GET['action'] == "approve") {
        $id = $_GET['id'];
        $tableid = $_GET['tableid'];
        $result = mysqli_query($con, "SELECT * from leave_data WHERE user_id='$id' AND id='$tableid'");
        $row = mysqli_fetch_array($result);
        $type = "Approve"; ?><br>
        <?php

        $result2 = mysqli_query($con, "SELECT user_email from user WHERE user_id='$id'");
        $row2 = mysqli_fetch_array($result2);
        $email = $row2['user_email'];

        $start_date = $row['leave_start_date'];
        $end_date = $row['leave_end_date'];
        $leave_type = $row['leave_type'];

        $result3 = mysqli_query($con, "SELECT user_name from user WHERE user_id='$id'");
        $row3 = mysqli_fetch_array($result3);
        $name = $row3['user_name'];
        // start this is for update leave_status  Approve  on leave_data
        $sql = "UPDATE leave_data set leave_status='$type' , leave_reject_reason = '' WHERE user_id='$id' and id='$tableid' and leave_start_date = '$start_date'";
        if (mysqli_query($con, $sql)) {
          if ($type == "Approve") {
            //check leave_type which leave type is on leave data table
            if ($leave_type == 'Medical Leave') {
              $sql2 = "UPDATE attendance set is_update='medical_leave',attendance_status ='1' WHERE user_id='$id' and attendance_date='$start_date'";
            } elseif ($leave_type == 'Paid Leave') {
              $sql2 = "UPDATE attendance set is_update='updated',attendance_status ='1' WHERE user_id='$id' and attendance_date='$start_date'";
            } elseif ($leave_type == 'Normal Leave') {
              $sql2 = "UPDATE attendance set is_update='on_leave',attendance_status ='0' WHERE user_id='$id' and attendance_date BETWEEN '$start_date' and '$end_date'";
            } else {
              $sql2 = "UPDATE attendance set is_update='on_leave',attendance_status ='0' WHERE user_id='$id' and attendance_date BETWEEN '$start_date' and '$end_date'";
            }
            if (mysqli_query($con, $sql2)) {
              $tempmail = $email;

              $html1 = '"<table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8">
<tr>
    <td>
        <table style="background-color: #f2f3f8; max-width:670px; margin:0 auto;" width="100%" border="0"
            align="center" cellpadding="0" cellspacing="0">
            <tr>
                <td style="height:80px;">&nbsp;</td>
            </tr>
            <!-- Logo -->
            <tr>
                <td style="text-align:center;">
                  <a href="http://localhost/portal/signin.php" title="logo" target="_blank">
                    <img src="https://media.istockphoto.com/id/1333583900/vector/out-of-office-written-on-yellow-sticky-note.jpg?s=1024x1024&w=is&k=20&c=PXYyNNPsHoKqlPPPd5HyVQw0lZCJuYGbPeoR5SqjbUY=" class="navbar-brand-img" width="120" alt="main_logo">
                  </a>
                </td>
            </tr>
            <tr>
                <td style="height:20px;">&nbsp;</td>
            </tr>
            <!-- Email Content -->
            <tr>
                <td>
                    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                        style="max-width:670px; background:#fff; border-radius:3px;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);padding:0 40px;">
                        <tr>
                            <td style="height:40px;">&nbsp;</td>
                        </tr>
                        <!-- Title -->
                        <tr>
                            <td style="padding:0 15px; text-align:center;">
                                <h1 style="color:#1e1e2d; font-weight:400; margin:0;font-size:32px;"><span style="color:green"> Leave Approved  !!!!</span><br><br>
                                  Leave Detail</h1>
                                <span style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; 
                                width:100px;"></span>
                            </td>
                        </tr>
                        <!-- Details Table -->
                        <tr>
                            <td>
                                <table cellpadding="0" cellspacing="0"
                                    style="width: 100%; border: 1px solid #ededed">
                                    <tbody>
                                        
                                        <tr>
                                            <td
                                                style="padding: 10px; border-bottom: 1px solid #ededed;border-right: 1px solid #ededed; width: 35%; font-weight:500; color:rgba(0,0,0,.64)">
                                                Employee Name:</td>
                                            <td
                                                style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056;">
                                                ' . $name . '</td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="padding: 10px; border-bottom: 1px solid #ededed;border-right: 1px solid #ededed; width: 35%; font-weight:500; color:rgba(0,0,0,.64)">
                                                Employee Mail:</td>
                                            <td
                                                style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056;">
                                                ' . $tempmail . '</td>
                                        </tr>
                                      <tr>
                                            <td
                                                style="padding: 10px; border-bottom: 1px solid #ededed;border-right: 1px solid #ededed; width: 35%; font-weight:500; color:rgba(0,0,0,.64)">
                                                Leave Type:</td>
                                            <td
                                                style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056;">
                                                ' . $leave_type . '</td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="padding: 10px;  border-bottom: 1px solid #ededed; border-right: 1px solid #ededed; width: 35%;font-weight:500; color:rgba(0,0,0,.64)">
                                                Leave Date Start:</td>
                                            <td
                                                style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056;">
                                                ' . $start_date . '</td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="padding: 10px; border-bottom: 1px solid #ededed; border-right: 1px solid #ededed; width: 35%;font-weight:500; color:rgba(0,0,0,.64)">
                                                Leave Date End:</td>
                                            <td
                                                style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056; ">
                                               ' . $end_date . '</td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="padding: 10px; border-bottom: 1px solid #ededed;border-right: 1px solid #ededed; width: 35%; font-weight:500; color:rgba(0,0,0,.64)">
                                                Status:</td>
                                            <td
                                                style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056;">
                                                Approved</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="height:40px;">&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="height:20px;">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align:center;">
                        <p style="font-size:14px; color:#455056bd; line-height:18px; margin:0 0 0;">&copy; <strong>Company Portal</strong></p>
                </td>
            </tr>
        </table>
    </td>
</tr>
</table>"';

              $mail = new PHPMailer(true);
              try {
                //Server settings
                $mail->isSMTP(); //Send using SMTP
                $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
                $mail->SMTPAuth = true; //Enable SMTP authentication
                $mail->Username = 'jinalkansagara5@gmail.com'; //SMTP username
                $mail->Password = 'dpuapozslartlkxr'; //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
                $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
                //Recipients
                $mail->setFrom('jinalkansagara5@gmail.com', 'Company Portal');
                $mail->addAddress('jinal.kansagara17072@marwadieducation.edu.in', 'Jinal User'); //Add a recipient
    

                //Content
                $mail->isHTML(true); //Set email format to HTML
                $mail->Subject = 'Leave Aprroved by Admin';
                $mail->Body = $html1;

                $mail->send();
                $script = "<script>
                              window.location = 'ManageLeave.php';</script>";
                echo $script;
                echo 'Message has been sent';
              } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
              }

            }
          }
        } else {
          //for main if else error leave data update
          echo "ERROR: Could not able  execute $sql. " . mysqli_error($con);
        }
      }
    }
    ?>
    <!-- Reject Query Starts Here -->
    <?php
    if (isset($_POST['reject'])) {
      $id = $_POST['data_id'];
      $start_date = $_POST['data_start'];
      $end_date = $_POST['data_end'];
      $reason = $_POST['text-reason'];
      $email = $_POST['data_email'];
      $leave_type = $_POST['data_type'];
      $update_month = date('m');
      $year = date('Y');
      if ($reason != '') {
        $sql5 = "UPDATE leave_data set leave_reject_reason='$reason' , leave_status = 'Reject' WHERE user_id='$id 'and leave_start_date = '$start_date' ";
      } else {
        $sql5 = "UPDATE leave_data set leave_reject_reason ='Leave Cancellation Has Been Cancelled' , leave_status = 'Reject' WHERE user_id=$id and leave_start_date = '$start_date'";
      }
      if (mysqli_query($con, $sql5)) {
        if ($leave_type == 'Medical Leave') {
          $sql2 = "UPDATE attendance set is_update='not_updated', attendance_status = '0' WHERE user_id=$id and attendance_date='$start_date'";
        } elseif ($leave_type == 'Paid Leave') {
          $sql2 = "UPDATE attendance set is_update='not_updated', attendance_status = '0' WHERE user_id=$id and attendance_date='$start_date'";
        } elseif ($leave_type == 'Normal Leave') {
          $sql2 = "UPDATE attendance set is_update='not_updated', attendance_status = '0' WHERE user_id=$id and attendance_date BETWEEN '$start_date' and '$end_date'";
        }
        // check datab is updated on att mng tbl
        if (mysqli_query($con, $sql2)) {
          if ($leave_type == 'Paid Leave') {
            $query = "UPDATE leaves_count set paid_leave = '1' WHERE user_id = '$id' and month(created_date) = '$update_month' and year(created_date) = '$year'";
            $result = mysqli_query($con, $query);
          } elseif ($leave_type == 'Medical Leave') {
            $query1 = "UPDATE leaves_count set medical_leave = '1' WHERE user_id = '$id' and month(created_date) = '$update_month' and year(created_date) = '$year'";
            $result = mysqli_query($con, $query1);
          }
          // for sending Reject mail 
          $tempmail = $email;

          $mail = new PHPMailer(true);
          $sql3 = "SELECT leave_reject_reason FROM leave_data WHERE user_id=$id and leave_start_date = '$start_date'";
          $result3 = mysqli_query($con, $sql3);
          $row3 = mysqli_fetch_array($result3);
          $reason = $row3['leave_reject_reason'];
          $result2 = mysqli_query($con, "SELECT user_name from user WHERE user_id='$id'");
          $row2 = mysqli_fetch_array($result2);
          $name = $row2['user_name'];

          // formating of email 
          $html = '"<table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8">
<tr>
    <td>
        <table style="background-color: #f2f3f8; max-width:670px; margin:0 auto;" width="100%" border="0"
            align="center" cellpadding="0" cellspacing="0">
            <tr>
                <td style="height:80px;">&nbsp;</td>
            </tr>
            <!-- Logo -->
            <tr>
                <td style="text-align:center;">
                  <a href="http://localhost/portal/signin.php" title="logo" target="_blank">
                    <img src="https://media.istockphoto.com/id/1333583900/vector/out-of-office-written-on-yellow-sticky-note.jpg?s=1024x1024&w=is&k=20&c=PXYyNNPsHoKqlPPPd5HyVQw0lZCJuYGbPeoR5SqjbUY=" class="navbar-brand-img" width="120" alt="main_logo">
                  </a>
                </td>
            </tr>
            <tr>
                <td style="height:20px;">&nbsp;</td>
            </tr>
            <!-- Email Content -->
            <tr>
                <td>
                    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                        style="max-width:670px; background:#fff; border-radius:3px;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);padding:0 40px;">
                        <tr>
                            <td style="height:40px;">&nbsp;</td>
                        </tr>
                        <!-- Title -->
                        <tr>
                            <td style="padding:0 15px; text-align:center;">
                                <h1 style="color:#1e1e2d; font-weight:400; margin:0;font-size:32px;"><span style="color:red"> Leave Rejected  !!!!</span><br><br>
                                  Leave Detail</h1>
                                <span style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; 
                                width:100px;"></span>
                            </td>
                        </tr>
                        <!-- Details Table -->
                        <tr>
                            <td>
                                <table cellpadding="0" cellspacing="0"
                                    style="width: 100%; border: 1px solid #ededed">
                                    <tbody>
                                        
                                        <tr>
                                            <td
                                                style="padding: 10px; border-bottom: 1px solid #ededed;border-right: 1px solid #ededed; width: 35%; font-weight:500; color:rgba(0,0,0,.64)">
                                                Employee Name:</td>
                                            <td
                                                style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056;">
                                                ' . $name . '</td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="padding: 10px; border-bottom: 1px solid #ededed;border-right: 1px solid #ededed; width: 35%; font-weight:500; color:rgba(0,0,0,.64)">
                                                Employee Mail:</td>
                                            <td
                                                style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056;">
                                                ' . $tempmail . '</td>
                                        </tr>
                                      <tr>
                                            <td
                                                style="padding: 10px; border-bottom: 1px solid #ededed;border-right: 1px solid #ededed; width: 35%; font-weight:500; color:rgba(0,0,0,.64)">
                                                Leave Type:</td>
                                            <td
                                                style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056;">
                                                ' . $leave_type . '</td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="padding: 10px;  border-bottom: 1px solid #ededed; border-right: 1px solid #ededed; width: 35%;font-weight:500; color:rgba(0,0,0,.64)">
                                                Leave Date Start:</td>
                                            <td
                                                style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056;">
                                                ' . $start_date . '</td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="padding: 10px; border-bottom: 1px solid #ededed; border-right: 1px solid #ededed; width: 35%;font-weight:500; color:rgba(0,0,0,.64)">
                                                Leave Date End:</td>
                                            <td
                                                style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056; ">
                                               ' . $end_date . '</td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="padding: 10px; border-bottom: 1px solid #ededed;border-right: 1px solid #ededed; width: 35%; font-weight:500; color:rgba(0,0,0,.64)">
                                                Status</td>
                                            <td
                                                style="padding: 10px; border-bottom: 1px solid #ededed; color: #455056;">
                                                Rejected</td>
                                        </tr>
                                        <tr>
                                                    <td
                                                        style="padding: 10px; border-right: 1px solid #ededed; width: 35%;font-weight:500; color:rgba(0,0,0,.64)">
                                                        Reason:</td>
                                                    <td style="padding: 10px; color: #455056;">' . $reason . '</td>
                                                </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="height:40px;">&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="height:20px;">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align:center;">
                        <p style="font-size:14px; color:#455056bd; line-height:18px; margin:0 0 0;">&copy; <strong>Company Portal</strong></p>
                </td>
            </tr>
        </table>
    </td>
</tr>
</table>"';
          //main code for sending Reject mail
          try {
            //Server settings
            $mail->isSMTP(); //Send using SMTP
            $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
            $mail->SMTPAuth = true; //Enable SMTP authentication
            $mail->Username = 'jinalkansagara5@gmail.com'; //SMTP username
            $mail->Password = 'dpuapozslartlkxr'; //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
            $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
            //Recipients
            $mail->setFrom('jinalkansagara5@gmail.com', 'Mailer');
            $mail->addAddress('jinal.kansagara17072@marwadieducation.edu.in', 'Jinal User'); //Add a recipient
    

            //Content
            $mail->isHTML(true); //Set email format to HTML
            $mail->Subject = 'Rejected Leave by admin';
            $mail->Body = $html;

            $mail->send();
            $script = "<script>
                              window.location = 'ManageLeave.php';</script>";
            echo $script;
            echo 'Message has been sent';
          } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
          }
        }

      }
    }
    ?>


    <!-- Main Start Contant Here  -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4 w-100">
              <h5 class="p-2 text-center">Leave List</h5>
            <div class="card-body px-0 pt-2 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0 pt-2 pb-5" id="leavedata">
                  <thead>
                    <tr>
                      <th class="text-center text-uppercase text-xs font-weight-bolder opacity-8" name="user_id">Sr.no
                      </th>
                      <th class="text-center text-uppercase text-xs font-weight-bolder opacity-8"> Name</th>
                      <th class="text-center text-uppercase text-xs font-weight-bolder opacity-8">Reason
                      </th>
                      <th class="text-center text-uppercase text-xs font-weight-bolder opacity-8">Status
                      </th>
                      <th class="text-center text-uppercase text-xs font-weight-bolder opacity-8">
                        Description</th>
                      <th class="text-center text-uppercase text-xs font-weight-bolder opacity-8">Leave Type
                      </th>
                      <th class="text-center text-uppercase text-xs font-weight-bolder opacity-8">Start Date
                      </th>
                      <th class="text-center text-uppercase text-xs font-weight-bolder opacity-8">End Date
                      </th>
                      <th class="text-center text-uppercase text-xs font-weight-bolder opacity-8">Action
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    $sql = "SELECT user.user_name,user.user_email,user.user_id,leave_data.user_id ,leave_data.leave_reason, leave_data.leave_status, leave_data.leave_description,leave_data.leave_type ,leave_data.leave_start_date, leave_data.leave_end_date, leave_data.id FROM user INNER JOIN leave_data WHERE user.user_id = leave_data.user_id and leave_data.leave_status != 'Approve'and leave_data.leave_status != 'Reject' ";

                    $result = mysqli_query($con, $sql);
                    //$row = mysqli_fetch_assoc($result);
                    //print_r ($row) ;
                    
                    if (mysqli_num_rows($result) > 0) {
                      $srno = 1;

                      while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['user_id'];
                        $tableid = $row['id'];
                        $get_start_date = $row['leave_start_date'];
                        $get_end_date = $row['leave_end_date'];
                        $get_email = $row['user_email'];
                        $get_leave_type = $row['leave_type'];

                        ?>
                        <tr>
                          <td>
                            <div class="text-secondary text-xs font-weight-bold text-center">
                              <?php echo $srno; ?>
                            </div>
                          </td>
                          <td>
                            <div class="text-secondary text-xs font-weight-bold text-center">
                              <?php echo $row['user_name']; ?>
                            </div>
                          </td>
                          <td>
                            <div class="text-secondary text-xs font-weight-bold text-center">
                              <?php echo $row['leave_reason']; ?>
                            </div>
                          </td>
                          <td>
                            <div class="text-secondary text-xs font-weight-bold text-center">
                              <?php echo $row['leave_status']; ?>
                            </div>
                          </td>
                          <td>
                            <div class="text-secondary text-xs font-weight-bold text-center">
                              <?php echo $row['leave_description']; ?>
                            </div>
                          </td>
                          <td>
                            <div class="text-secondary text-xs font-weight-bold text-center">
                              <?php echo $row['leave_type']; ?>
                            </div>
                          </td>
                          <td>
                            <div class="text-secondary text-xs font-weight-bold text-center">
                              <?php echo $row['leave_start_date']; ?>
                            </div>
                          </td>
                          <td>
                            <div class="text-secondary text-xs font-weight-bold text-center">
                              <?php echo $row['leave_end_date']; ?>
                            </div>
                          </td>
                          <form method="POST" action="">
                            <td>
                              <div>
                                <a href="ManageLeave.php?id=<?php echo $id; ?>&tableid=<?php echo $tableid; ?>&action=approve"
                                  class='btn btn-info bg-gradient-info' name="approve">Approve</a>
                                <a href="ManageLeave.php?id=<?php echo $id; ?>&tableid=<?php echo $tableid; ?>&action=reject"
                                  class='btn btn-info bg-gradient-danger' data-bs-toggle="modal"
                                  data-bs-target="#exampleModal<?php echo $id; ?>" data-id="<?php echo $row['user_id'] ?>"
                                  name="reject">Reject</a>
                              </div>
                          </form>
                          <div class="modal fade" id="exampleModal<?php echo $id; ?>" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Describe Leave Cancellation Reason </h5>
                                </div>
                                <div class="modal-body">
                                  <form method="POST">
                                    <div class="mb-3">
                                      <label for="message-text" class="col-form-label">Enter Reason:</label>
                                      <textarea class="form-control" id="message-text" name="text-reason"></textarea>
                                      <input type="hidden" value="<?php echo $row['user_id']; ?>" name="data_id">
                                      <input type="hidden" value="<?php echo $row['leave_start_date']; ?>"
                                        name="data_start">
                                      <input type="hidden" value="<?php echo $row['leave_end_date']; ?>" name="data_end">
                                      <input type="hidden" value="<?php echo $row['user_email']; ?>" name="data_email">
                                      <input type="hidden" value="<?php echo $row['leave_type']; ?>" name="data_type">
                                    </div>
                                    <div>
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                      <!--<a href='?id="<?php echo $id; ?>"&type=Reject&get_start_date="<?php echo $get_start_date; ?>"&get_end_date="<?php echo $get_end_date; ?>"&get_email=<?php echo $get_email; ?>' class='btn btn-info bg-gradient-info' name="Rejected">Submit</a>-->
                                      <input type="submit" class="btn btn-info bg-gradient-info" name="reject">
                                      <!--come back -->
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>

                          </td>
                        </tr>
                        <?php $srno++;
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
      $('#leavedata').DataTable({
        dom: 'Bfrtip',
        buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ]
      });
    });
  </script>
</body>
</body>

</html>