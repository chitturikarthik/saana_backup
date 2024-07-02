<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
$phone = $_SESSION['mobile'];
$errorMsg = '';

if (isset($_SESSION['mobile'])) {
    include 'connect.php';
    $mobile = $_SESSION['mobile'];
    $stmt = $pdo->prepare('SELECT addn_amount,mobile FROM all_members WHERE mobile = :mobile');
    $stmt->bindParam(':mobile', $mobile);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $value1 = $row['addn_amount'];
    $value2 = 100;
    $money = $value1 + $value2;
    // echo $money;
    $phone = $row['mobile'];
    // echo $money;
    define('PAYPAL_URL', 'https://www.sandbox.paypal.com/cgi-bin/webscr');
    define('PAYPAL_RETURN_URL', 'http://localhost/saana_new/paypal_success.php?mobile=' . $phone);
    define('PAYPAL_CANCEL_URL', 'http://localhost/saana_new/cancel.php');
    define('PAYPAL_ID', 'sb-xgth4726864319@business.example.com');
    header('locaton: paypal_success.php');
} else {
    header('location:register.php');
}

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

        <div class="content-wrapper">

            <form method="post" action="<?php echo PAYPAL_URL; ?>" style="display:flex;justify-content:center;align-items:center;">

                <input type="hidden" name="cmd" value="_xclick">
                <input type="hidden" name="business" value="<?php echo PAYPAL_ID ?>" />
                <input type="hidden" name="item_name" value="Saana Membership Registration" />
                <input type="hidden" name="item_number" value="1" />
                <input type="hidden" name="amount" value="<?php echo $money; ?>" />
                <input type="hidden" name="no_shipping" value="0" />
                <input type="hidden" name="no_note" value="1" />
                <input type="hidden" name="currency_code" value="USD" />
                <input type="hidden" name="lc" value="AU" />
                <input type="hidden" name="rm" value="2" />
                <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>" />
                <input type="hidden" name="cancel_return" value="<?PHP echo PAYPAL_CANCEL_URL; ?>" />

                <div class="container" style="margin:10px;padding:3% 1%;display:flex;flex-direction:column;justify-content:center;align-items:center;  border-radius:15px;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;width:70%;">
                    <div style="margin:15px;padding:2% 4%;text-align:center;background-color:antiquewhite;font-size:14px;border-radius:100px;width:70%;color:black;line-height:1.5em;font-family:'Poppins',sans-serif;text-transform:capitalize;">
                        <p>Please note that this total amount encompasses both the membership fee and any additional payment you want to make.</p>
                    </div>
                    <p style="font-family:'Poppins',sans-serif;font-weight:600;color:darkslategray;font-size:2vw;margin-top:20px;">AMOUNT PAYABLE : <b><?php echo $money; ?></b>&nbsp;USD</p>
                    <div>
                        <button type="submit" name="pay" style="border: none;
                                cursor: pointer;
                                appearance: none;
                                background-color: inherit;">
                            <img src="images/paypal.png" style="
                            mix-blend-mode: darken;
                            width: 55%;
                            height: auto;" />
                        </button>
                    </div>
                    <!-- <img src="images/paypal.png" style="" name="pya" /> -->

            </form>


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