<?php

   if (isset($_POST['submit']))
    {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $pswd =$_POST['pswd'];

     $password = password_hash($pswd, PASSWORD_BCRYPT);

     $emailquery = " select * from register where email = '$email' ";
     $query = mysqli_query($con, $emailquery);

     $emailcount = mysqli_num_rows($query);

     if($emailcount>0){
         echo "email already exists";
     }
     else{
        $insertquery = "INSERT INTO register (name,email,password) VALUES ( '$username', '$email', '$password')";

        $iquery = mysqli_query($con, $insertquery);

        if($iquery){
                ?>
                    <script>
                        alert("inserted successful");
                    </script>           
                <?php
            }            
            else{           
                ?>
                    <script>
                        alert("Not inserted");
                    </script>           
                <?php
            }
        }
     }

  ?>