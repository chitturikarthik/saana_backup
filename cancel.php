<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// session_start();
// if (isset($_SESSION['mobile'])) {
//     unset($_SESSION['mobile']);
// } else {
//     header('location:register.php');
//     exit();
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
    <script src="js/libs/modernizr.custom.js"></script>
    <title>Payemetn Cancel</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <style>

    </style>
</head>

<body>


    <div class="main-wrapper page">
        <?php
        include("header.php");
        ?> <div class="divider divider--lg"></div>
        <div class="divider divider--lg"></div>
        <div class="content-wrapper">


            <div class="content-wrapper" style="display:flex;flex-direction:column;justify-content:center;align-items:center;">
                <div class="container" style="margin:10px;padding:3% 1%;display:flex;flex-direction:column;justify-content:center;align-items:center;  border-radius:15px;width:80%;">

                    <div style="margin:15px;padding:2% 4%;text-align:center;background-color:rgba(255,0,0,0.2);font-size:14px;border-radius:100px;width:70%;color:rgb(58,58,58);line-height:2em;font-family:'Poppins',sans-serif;font-size:15px;">
                        <p>If you changed your mind and would like to proceed with the payment later, you are always welcome to come back and complete the process whenever you're ready.
                        <p>
                    </div>

                    <img src="https://st4.depositphotos.com/5179615/37876/v/450/depositphotos_378766856-stock-illustration-failed-payment-declined-transaction-invalid.jpg" style="width:30%;height:20%;mix-blend-mode:darken;background:inherit;" />
                </div>
            </div>
        </div>
        <div class="divider divider--lg"></div>
        <div class="divider divider--lg"></div>
        <?php
        include("footer.php");
        ?>
    </div>
    <script src="js/libs/jquery-2.2.4.min.js"></script>
    <script src="js/libs/bootstrap.min.js"></script>
    <script src="js/libs/owl.carousel.min.js"></script>
    <script src="js/libs/jquery.meanmenu.js"></script>
    <script src="js/libs/parallax.min.js"></script>
    <script src="js/libs/jquery.waypoints.min.js"></script>
    <script src="js/custom/main.js"></script>
</body>

</html>