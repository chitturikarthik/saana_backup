<?php
// error_reporting(E_ALL);
// session_start();
// ini_set('display_errors', 1);
// if ($_POST) {
// $mobile = $_GET['mobile'];
// include 'connect.php';
// $successMsg = '';
// $errorMsg = '';
// // print_r($_POST);

// $data = $_POST;
// $txn_id = $data['txn_id'];
// $amount_paid = $data['mc_gross'];
// $paid_on = $data['payment_date'];
// $payer_id = $data['payer_id'];
// $payment_status = "Paid";
// $membership_status = "Active";
// // $insert_data = 'INSERT INTO all_members (transaction_id,payable_total,payment_id,payment_date) VALUES (:txn_id,:amount_paid,:paid_on,:payer_id)';
// $insert_data = "UPDATE all_members SET transaction_id = :txn_id, payable_total = :amount_paid, payment_id = :payer_id, payment_date = :paid_on,payment_status = :payment_status, membership_status = :membership_status WHERE mobile = :mobile";
// $stmtInset = $pdo->prepare($insert_data);
// $stmtInset->bindParam(':mobile', $mobile);
// $stmtInset->bindParam(':txn_id', $txn_id);
// $stmtInset->bindParam(':amount_paid', $amount_paid);
// $stmtInset->bindParam(':paid_on', $paid_on);
// $stmtInset->bindParam(':payer_id', $payer_id);
// $stmtInset->bindParam(':payment_status', $payment_status);
// $stmtInset->bindParam(':membership_status', $membership_status);
// if ($stmtInset->execute()) {
//     $successMsg = "You Registered Successfully";
//     unset($_SESSION['mobile']);
// } else {
//     $errorMsg = "Registration Failed";
// }
// } else {
//     header('location:register.php');
// }

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="icon" href="favicon.ico" type="image/ico" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/animate.css" />
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <link rel="stylesheet" type="text/css" href="css/meanmenu.css" />
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <!-- <link rel="stylesheet" href="css/dropdowns.css"> -->
    <script src="js/libs/modernizr.custom.js"></script>
    <title>Complete Payment</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,800;1,400&display=swap');
    </style>
</head>

<body>
    <div class="main-wrapper page">
        <!--Begin header ưrapper-->
        <?php
        include("header.php");
        ?>
        <!--End header wrapper-->
        <div class="divider divider--lg"></div>
        <div class="divider divider--lg"></div>

        <div class="content-wrapper" style="display:flex;flex-direction:column;justify-content:center;align-items:center;">
            <div class="container" style="margin:5px;padding:3% 1%;display:flex;flex-direction:column;justify-content:center;align-items:center;  border-radius:15px;width:80%;">
                <div style="margin:15px;padding:2% 4%;text-align:center;background-color:rgba(0,128,0,0.2);font-size:1vw;border-radius:15px;width:70%;color:black;line-height:1.5em;font-family:'Poppins',sans-serif;text-transform:capitalize;">
                    <h4 style="font-weight:600;line-height:30px;">Your journey with Saana begins now...<br><span>Welcome to our extended family!</span></h4><br>
                    <p style="font-family:14px;">Your payment and registration have been processed successfully. </p>
                    <button style="margin:10px;padding:1% 3%;background-color:black;font-size:14px;border-radius:40px;">
                        <a href="login.php" style="color:white;">Login Here!</a>
                    </button>
                </div>
            </div>
            <img src="https://chfcanada.coop/wp-content/uploads/2017/12/welcome.jpg" />
        </div>
    </div>
    <div class="divider divider--lg"></div>
    <div class="divider divider--lg"></div>



    <?php
    include("footer.php");
    ?>

    <script src="js/libs/jquery-2.2.4.min.js"></script>
    <script src="js/libs/bootstrap.min.js"></script>
    <script src="js/libs/owl.carousel.min.js"></script>
    <script src="js/libs/jquery.meanmenu.js"></script>
    <script src="js/libs/jquery.syotimer.js"></script>
    <script src="js/libs/parallax.min.js"></script>
    <script src="js/libs/jquery.waypoints.min.js"></script>
    <script src="js/custom/main.js"></script>
</body>

</html>