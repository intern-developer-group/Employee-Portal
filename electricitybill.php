<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
<div class="row justify-content-center vertical-align-middle">
	<?php
    $result_str = $result = '';
    if(isset($_POST['unit-submit'])){
        $Units= $_POST['units'];
            $result = Totalbill($Units);
            $result_str = 'Total amount of ' . $Units . ' - ' . $result;
    }
    function Totalbill($Units){
        $firstbillunit = 3.5;
        $secondbillunit = 4.0;
        $thirdbillunit = 5.2;
        $fourthbillunit = 6.5;

        switch($Units) {
            case ($Units<=50):
                $bill = $Units * $firstbillunit;
                break;
            case ($Units>50 && $Units<=150):
                $one = 50 * $firstbillunit;
                $two = ($Units-50) * $secondbillunit;
                $bill = $one + $two;
                break;
            case ($Units>150 && $Units<=250):
                $three = 50 * $firstbillunit;
                $four = 100 * $secondbillunit;
                $five = ($Units-150) * $thirdbillunit;
                $bill = $three + $four + $five;
                break;
            case ($Units >250):
            $six = 50 * $firstbillunit;
            $seven = 100 * $secondbillunit;
            $eight = 100 * $thirdbillunit;
            $nine = ($Units-250) * $fourthbillunit;
            $bill = $six + $seven +$eight +$nine;
                break;
        }
        return number_format((float)$bill, 2, '.', '');

        // If($Units<=50) {
        //     $bill = $Units * $firstbillunit;
        // } elseif ($Units>50 && $Units<=150){
        //     $one = 50 * $firstbillunit;
        //     $two = ($Units-50) * $secondbillunit;
        //     $bill = $one + $two;
        // } elseif ($Units>150 && $Units<=250){
        //     $three = 50 * $firstbillunit;
        //     $four = 100 * $secondbillunit;
        //     $five = ($Units-150) * $thirdbillunit;
        //     $bill = $three + $four + $five;
        // } else {
        //     $six = 50 * $firstbillunit;
        //     $seven = 100 * $secondbillunit;
        //     $eight = 100 * $thirdbillunit;
        //     $nine = ($Units-250) * $fourthbillunit;
        //     $bill = $six + $seven +$eight +$nine;
        // }
        // return number_format((float)$bill, 2, '.', '');
    }
    ?>
	<div class="col-4 mt-5">
      <div class="container bg-dark text-white border border-dark">
    <h4 class="text-dark text-center m-4 bg-light rounded-pill">Calculate Electricity Bill</h4>

    <form action="" method="post" id="quiz-form">
              <input type="text" name="units" placeholder="Please Enter no. of Units"  class="form-control"  required/>
              <input type="submit" name="unit-submit" class="btn btn-light mt-4" value="Submit" />
    </form>
 <div class="badge badge-dark mt-3">
 <?php echo '<br />' . $result_str; ?>
 </div>
	</div>
	</div>
</div>
</body>
</html>