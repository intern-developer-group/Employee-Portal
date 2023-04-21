<?php
include('dbcon.php');
if (isset($_POST['insert'])) {

    $name1 = legal_input($_POST['name']);
    $email1 = legal_input($_POST['email']);
    $password1 = legal_input($_POST['password']);
    $salary = legal_input($_POST['salary']);
    $usertype = legal_input($_POST['radio']);
    $monthdays = date('t');
    $dailysalary = floor(($salary / $monthdays));

    if (isset($_FILES['userimage'])) {
        if ($_FILES['userimage']['name'] == '') {
            $userimage = $img;
        } else {
            $file_name = $_FILES['userimage']['name'];
            $file_size = $_FILES['userimage']['size'];
            $file_tmp = $_FILES['userimage']['tmp_name'];
            $file_type = $_FILES['userimage']['type'];
            move_uploaded_file($file_tmp, "assets/img/" . $file_name);
            $img_ex = pathinfo($file_name, PATHINFO_EXTENSION);
            $allowed_exs = array('JPG', 'JPEG', 'PNG', 'jpg', 'jpeg', 'png');
            if (in_array($img_ex, $allowed_exs)) {
            } else {
                ?> <script> alert('please upload image in selected format only');</script><?php
            }
            $target_folder = "img/";
        $userimage = $target_folder . basename($_FILES['userimage']['name']);
        }
    }  

    $emailquery = " select * from user where user_email = '$email1' ";
    $query = mysqli_query($con, $emailquery);
    $emailcount = mysqli_num_rows($query);
    if ($emailcount > 0) { ?>
        <script> alert("email already exists");</script>
        <?php
    } else {
        $query1 = "INSERT INTO user (user_name,user_email,user_password,user_type,user_image,monthly_salary,daily_salary) VALUES(?,?,?,?,?,?,?)";
        if ($stmt = mysqli_prepare($con, $query1)) {
            mysqli_stmt_bind_param($stmt, 'sssisii', $name1, $email1, $password1, $usertype, $userimage, $salary, $dailysalary);
            if (mysqli_stmt_execute($stmt)) {
                $result2 = mysqli_query($con, "SELECT * from user where user_name='$name1'");
                $row2 = mysqli_fetch_array($result2);
                $userid2 = $row2['user_id'];
                $updatedate = date("Y-m-d");
                $leave = 1;
                $query2 = "INSERT INTO salary (user_id,monthly_salary,daily_salary,update_date) VALUES(?,?,?,?)";
                if ($stmt2 = mysqli_prepare($con, $query2)) {
                    mysqli_stmt_bind_param($stmt2, 'iiis', $userid2, $salary, $dailysalary, $updatedate);
                    if (mysqli_stmt_execute($stmt2)) {
                        $query3 = "INSERT INTO leaves_count (user_id,medical_leave,paid_leave) VALUES(?,?,?)";
                        if ($stmt3 = mysqli_prepare($con, $query3)) {
                            mysqli_stmt_bind_param($stmt3, 'iii', $userid2, $leave, $leave);
                            if (mysqli_stmt_execute($stmt3)) {
                                $msg3 = "Data was created successfully";
                                return $msg3;
                            } else {
                                $msg3 = "Error:" . $query3 . "<br>" . mysqli_error($con);
                            }
                        }
                    } else {
                        $msg2 = "Error:" . $query2 . "<br>" . mysqli_error($con);
                    }
                }
                $msg1 = "Data was created successfully";
                return $msg1;
            } else {
                $msg1 = "Error:" . $query1 . "<br>" . mysqli_error($con);
            }
        }

    }
}
// convert illegal input to legal input
function legal_input($value)
{
    $value = trim($value);
    $value = stripslashes($value);
    $value = htmlspecialchars($value);
    return $value;
}
?>