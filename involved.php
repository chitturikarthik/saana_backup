
<?php 
include('session_management.php');
if(!isset($_SESSION['username']))
 {
   header('location:login.php');
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
    <title>Alumni Story</title>
</head>
<body>
<div class="main-wrapper page">
    <!--Begin header ưrapper-->
    <?php
        include("header.php");
    ?>
    <!--End header wrapper-->
    <div class="content-wrapper">
    <div class="galery-wrapper">
            <div class="container">
                <div class="galery-title text-center">
                    <h2 class="heading-regular" style="color:#88211A;">GET INVOLVED PAGE IS COMING SOON!</h2>
                </div>
                <div class="galery-content">
                    <ul>
                        <li class="col-sm-3 col-xs-6">
                            <div class="galery-item">
                                <img src="images/gallery/1.png" alt="">
                                <div class="galery-content">
                                </div>
                                <div class="box-content-item" style="display: none">
                                    <div class="box-img">
                                        <img src="images/big_gallery/1.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="col-sm-3 col-xs-6">
                            <div class="galery-item">
                                <img src="images/gallery/2.png" alt="">
                                <div class="galery-content">
                                </div>
                                <div class="box-content-item" style="display: none">
                                    <div class="box-img">
                                        <img src="images/big_gallery/2.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="col-sm-3 col-xs-6">
                            <div class="galery-item">
                                <img src="images/gallery/3.png" alt="">
                                <div class="galery-content">
                                </div>
                                <div class="box-content-item" style="display: none">
                                    <div class="box-img">
                                        <img src="images/big_gallery/3.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="col-sm-3 col-xs-6">
                            <div class="galery-item">
                                <img src="images/gallery/4.png" alt="">
                                <div class="galery-content">
                                </div>
                                <div class="box-content-item" style="display: none">
                                    <div class="box-img">
                                        <img src="images/big_gallery/4.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="col-sm-3 col-xs-6">
                            <div class="galery-item">
                                <img src="images/gallery/5.png" alt="">
                                <div class="galery-content">
                                </div>
                                <div class="box-content-item" style="display: none">
                                    <div class="box-img">
                                        <img src="images/big_gallery/5.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="col-sm-3 col-xs-6">
                            <div class="galery-item">
                                <img src="images/gallery/6.png" alt="">
                                <div class="galery-content">
                                </div>
                                <div class="box-content-item" style="display: none">
                                    <div class="box-img">
                                        <img src="images/big_gallery/6.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="col-sm-3 col-xs-6">
                            <div class="galery-item">
                                <img src="images/gallery/7.png" alt="">
                                <div class="galery-content">
                                </div>
                                <div class="box-content-item" style="display: none">
                                    <div class="box-img">
                                        <img src="images/big_gallery/7.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="col-sm-3 col-xs-6">
                            <div class="galery-item">
                                <img src="images/gallery/1.png" alt="">
                                <div class="galery-content">
                                </div>
                                <div class="box-content-item" style="display: none">
                                    <div class="box-img">
                                        <img src="images/big_gallery/1.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
    

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
<script>
    jQuery(document).ready(function () {
        $('#time2').syotimer({
            year: 2016,
            month: 7,
            day: 7,
            hour: 7,
            minute: 7,
        });
    });
</script>
</body>
</html>