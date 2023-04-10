<?php
include('dbcon.php');
$id = $_GET['edit'];
$results = mysqli_query($con, "Select * from user where user_id=$id");
$row = mysqli_fetch_array($results);
$name = $row['user_name'];
$password = $row['user_password'];
$email = $row['user_email'];
$salary = $row['monthly_salary'];
$usertype = $row['user_type'];
if (isset($_POST['update'])) {
    $name1 = legal_input($_POST['name']);
    $email1 = legal_input($_POST['email']);
    $password1 = legal_input($_POST['password']);
    $salary1 = legal_input($_POST['salary']);
    $usertype1 = legal_input($_POST['usertype']);
    $monthdays = date('t');
    $dailysalary = floor(($salary1 / $monthdays));
    $results1 = "UPDATE user SET user_id=?,user_name=?,user_email=?,user_password=?,user_type=?,monthly_salary=?,daily_salary=? where user_id=?";
    if ($stmt = mysqli_prepare($con, $results1)) {
        mysqli_stmt_bind_param($stmt, 'isssiiii', $id, $name1, $email1, $password1, $usertype1, $salary1, $dailysalary, $id);
        if (mysqli_stmt_execute($stmt)) {
            if($_GET['dashboard'] == '1'){
                echo "<script>window.location.href='user.php?url=".$_GET['url']."&user_type=".$_GET['user_type']."'</script>";
            } else {
                echo "<script>window.location.href='ManageUser.php'</script>";
            }
        } else {
            die(mysqli_error($con));
        }
    }
    $updatedate = date("Y-m-d");
    $query2 = "UPDATE salary SET user_id=?,monthly_salary=?,daily_salary=?,update_date=? where user_id=?";
    if ($stmt2 = mysqli_prepare($con, $query2)) {
        mysqli_stmt_bind_param($stmt2, 'iiisi', $id, $salary1, $dailysalary, $updatedate, $id);
        if (mysqli_stmt_execute($stmt2)) {
        }
    }
}
// $results=mysqli_query($con, "UPDATE crud SET userid='$id',name='$name1',email='$email1' where userid=$id");
// if($results){
// echo "<script>window.location.href='ManageUser.php'</script>";
// // header('location:ManageUser.php');
// } else{
//     die(mysqli_error($con));
// }

// convert illegal input to legal input
function legal_input($value)
{
    $value = trim($value);
    $value = stripslashes($value);
    $value = htmlspecialchars($value);
    return $value;
}
?>