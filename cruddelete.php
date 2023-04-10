<?php
include("dbcon.php");
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  delete_data($con, $id);
}
// delete data query
function delete_data($con, $id)
{
  $query = "DELETE from user WHERE user_id=$id";
  $query2 = "DELETE from salary WHERE user_id=$id";
  $query3 = "DELETE from leaves_count WHERE user_id=$id";
  $query4 = "DELETE from leave_data WHERE user_id=$id";
  $query5 = "DELETE from overtime WHERE user_id=$id";
  $query6 = "DELETE from attendance WHERE user_id=$id";
  $exec = mysqli_query($con, $query);
  if ($exec) {
    $sql = mysqli_query($con, "SELECT COUNT(*) from user where user_id=$id");
    $row = mysqli_fetch_array($sql);
    $autoincrement = $row['COUNT(*)'];
       $alter=mysqli_query($con, "ALTER TABLE user AUTO_INCREMENT = $autoincrement");
    $alter;
    header('location:ManageUser.php');
  } else {
    $msg = "Error: " . $query . "<br>" . mysqli_error($con);
    echo $msg;
  }
  $exec2 = mysqli_query($con, $query2);
  if ($exec2) {
    $sql2 = mysqli_query($con, "SELECT COUNT(*) from salary where user_id=$id");
    $row2 = mysqli_fetch_array($sql2);
    $autoincrement = $row2['COUNT(*)'];
       $alter2=mysqli_query($con, "ALTER TABLE salary AUTO_INCREMENT = $autoincrement");
    $alter2;
    header('location:ManageUser.php');
  } else {
    $msg = "Error: " . $query2 . "<br>" . mysqli_error($con);
    echo $msg;
  }
  $exec3 = mysqli_query($con, $query3);
  if ($exec3) {
    $sql3 = mysqli_query($con, "SELECT COUNT(*) from leaves_count where user_id=$id");
    $row3 = mysqli_fetch_array($sql3);
    $autoincrement = $row3['COUNT(*)'];
       $alter3=mysqli_query($con, "ALTER TABLE leaves_count AUTO_INCREMENT = $autoincrement");
       $alter3;
    header('location:ManageUser.php');
  } else {
    $msg = "Error: " . $query3 . "<br>" . mysqli_error($con);
    echo $msg;
  }
  $exec4 = mysqli_query($con, $query4);
  if ($exec4) {
    $sql4 = mysqli_query($con, "SELECT COUNT(*) from leave_data where user_id=$id");
    $row4 = mysqli_fetch_array($sql4);
    $autoincrement = $row4['COUNT(*)'];
       $alter4=mysqli_query($con, "ALTER TABLE leave_data AUTO_INCREMENT = $autoincrement");
       $alter4;
    header('location:ManageUser.php');
  } else {
    $msg = "Error: " . $query4 . "<br>" . mysqli_error($con);
    echo $msg;
  }
  $exec5 = mysqli_query($con, $query5);
  if ($exec5) {
    $sql5 = mysqli_query($con, "SELECT COUNT(*) from overtime where user_id=$id");
    $row5 = mysqli_fetch_array($sql5);
    $autoincrement = $row5['COUNT(*)'];
       $alter5=mysqli_query($con, "ALTER TABLE overtime AUTO_INCREMENT = $autoincrement");
       $alter5;
    header('location:ManageUser.php');
  } else {
    $msg = "Error: " . $query5 . "<br>" . mysqli_error($con);
    echo $msg;
  }
  $exec6 = mysqli_query($con, $query6);
  if ($exec6) {
    $sql6 = mysqli_query($con, "SELECT COUNT(*) from attendance where user_id=$id");
    $row6 = mysqli_fetch_array($sql6);
    $autoincrement = $row6['COUNT(*)'];
       $alter6=mysqli_query($con, "ALTER TABLE attendance AUTO_INCREMENT = $autoincrement");
       $alter6;
    header('location:ManageUser.php');
  } else {
    $msg = "Error: " . $query6 . "<br>" . mysqli_error($con);
    echo $msg;
  }
}
?>