
<?php 
 error_reporting(E_ALL);
 ini_set('display_errors', 1);
 include('session_management.php');
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
    
    <title>About Us</title>
</head>
<body>
<div class="main-wrapper page">
    <!--Begin header wrapper-->
    <?php
include('header.php');
    ?>
    


    <div class="divider divider--lg"></div>
        <div class="divider divider--lg"></div>

         <!--begin our history-->
           <div class="content-wrapper">
                <div class="title-page text-center">
                    <h2 class="text-regular" style="color:#88211a">Welcome</h2>
                    
                </div>
                
                <h4 class="text-regular"  style="color:#88211a">SAANA Introductory Flyer: <a href="./files/SAANA_Introductory_Fyler.pdf" target="_blank" style="text-decoration:none">PDF</a></h4>
                <div class="divider divider--xs"></div>
                <embed src="./files/SAANA_Introductory_Fyler.pdf" target="_blank" style="align-items:center; width:100%; height:1000px" type="application/pdf">
              
            </div>
        
        <!--end our history-->

    <?php
include('footer.php');
    ?>
<!--End footer wrapper-->
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