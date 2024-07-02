

<?php 
include('session_management.php');
?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="icon" href="favicon.ico" type="image/ico" />
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>EVENTS - SAANA</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.2.2/flickity.min.css">
  <style>
    /* Base carousel styles */
    .carousel {
      margin: 0 auto;
    }

    .carousel-cell img {
      max-width: 100%;
      height: auto;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
      /* For small screens, adjust carousel width and hide navigation dots */
      .carousel {
        width: 90%;
      }
      .flickity-page-dots {
        display: none;
      }
    }

    @media (min-width: 769px) and (max-width: 1200px) {
      /* For medium-sized screens, adjust carousel width */
      .carousel {
        width: 70%;
      }
    }

    @media (min-width: 1201px) {
      /* For large screens, adjust carousel width */
      .carousel {
        width: 50%;
      }
    }
  </style>
</head>
<body>


<div class="main-wrapper page">
<?php
include("header.php");
?>



<div class="divider divider--lg"></div>

<div class="content-wrapper">
    <div class="responsive-container-block container-team"><br>
    <h2 class="heading-regular text-center text-uppercase" style="color:#88211A;">PAST EVENTS</h2>
    <!-- <div class="divider divider--lg"></div> -->
<div class="responsive-container-block">


    <div class="container-fluid upcoming-event">
            <div class="container">

            <?php
           
// Include necessary files and libraries for authentication
require_once 'vendor/autoload.php';

           use Google\Client as Google_Client;
           use Google\Service\Drive as Google_Service_Drive;
            




// Initialize the Google Client
$client = new Google_Client();
$client->setAuthConfig('credentials.json'); // Path to your client credentials JSON file
$client->setAccessType('offline');
$client->setScopes([
    Google_Service_Drive::DRIVE,
    Google_Service_Drive::DRIVE_FILE,
]);

// Authenticate using the access token
if ($client->isAccessTokenExpired()) {
    $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
}

// Initialize the Google Drive service
$driveService = new Google_Service_Drive($client);

// Define the folder ID of your Google Drive folder containing images
$folderId = 'rQYnu2E4Gx7iF8xN7';

// List files in the folder
$files = $driveService->files->listFiles([
    'q' => "'$folderId' in parents",
]);
?>

            <section class="container">
            <span><h2 class="heading-regular mx-auto" style="color:#88211A;">ALUMNI MEET PICTURES</h2></span><br>

                        <div style="position:relative;padding-bottom:56%;height:0;overflow:hidden;border:1px dashed #88211a;border-radius:5px;">                        
                            <iframe src="https://drive.google.com/embeddedfolderview?id=1aPomVI9r1PJiKGwpp3hbHEuaQK-qvZ3P#grid" widht="550px" height="250px" allowfullscreen="" style="position:absolute;top:0;left:0;width:100%;height:100%;"></iframe>
                        </div>
                        <!-- <div class="container m-5 p-5">
                            <div class="carousel">
                            </div>
                        </div> -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.2.2/flickity.pkgd.min.js"></script>
    <script>
        const images = [
        'https://drive.google.com/uc?export=view&id=1-jZervGKIMRKEkJhmiXa4twBJYVWrQ7p/view?usp=drivesdk',
        'https://drive.google.com/uc?export=view&id=10MdNQJtFbBYJm11EC6HTq66sBLY8DHed/view?usp=drivesdk',
        'https://drive.google.com/file/d/1CTcEAwDmFUumfd-B49V2Beq7HZoNG9m8/view?usp=drivesdk',
        'https://drive.google.com/file/d/1J85H7QisNVycCHbUb6ilBN5SvTBlp6A1/view?usp=drive_link',
        // Add more image URLs here
        ];

        $(document).ready(() => {
        const carousel = $('.carousel');
        images.forEach((imageUrl) => {
            const img = $('<img>').attr('src', imageUrl).attr('alt', 'Image');
            carousel.append($('<div class="carousel-cell">').append(img));
        });

        carousel.flickity({
            // Flickity settings
            cellAlign: 'left',
            contain: true,
            wrapAround: true,
            autoPlay: 2000, // Slide every 2 seconds
            // Add more settings as needed
        });
        });
    </script>

            </section>

            <div class="divider divider--lg"></div><div class="divider divider--lg"></div>
                <div class="row">
				
                    <div class="area-img col-md-8 col-sm-12 col-xs-12">



            <div class="owl-carousel" style='border-radius:5px;'>
                <div class="item">
                    <img src="images/slider/4.jpg" alt="">
                </div>
                <div class="item">
                    <img src="images/gallery/event1/1.png" alt="">
                </div>
                <div class="item">
                    <img src="images/gallery/event1/2.png" alt="">
                </div>
                <div class="item">
                    <img src="images/gallery/event1/3.png" alt="">
                </div>
                <div class="item">
                    <img src="images/gallery/event1/4.png" alt="">
                </div>
                <div class="item">
                    <img src="images/gallery/event1/5.png" alt="">
                </div>
                <div class="item">
                    <img src="images/gallery/event1/6.png" alt="">
                </div>
            </div>
</div>

                <section>
                    <div class="area-content col-md-4 col-sm-12 col-xs-12">
                        <div class="area-top">
                            <div class="row">
							<div class="col-sm-10 col-xs-9">
                                    <h5 class="heading-light no-margin animated fadeInRight" style="color:black;">PAST EVENT | <a href='welcome_letter.php' style="color:#88211A;">View Welcome Letter</a></h5>
                                    <h2 class="heading-regular animated fadeInLeft" style="color:#88211A;">FIRST SRKREC ALUMNI MEET IN NORTH AMERICA</h2>
                                    <span>
                                        <span class="text-place text-light animated fadeInRight"> New Jersey Convention & Expo center Edison , NJ.</span>
                                    </span>
                                    
                                </div>
                                <div class="col-sm-2 col-xs-3">
                                    <div class="area-calendar calendar animated slideInRight">
                                        <span class="day text-bold">27</span>
                                        <span class="month text-light">MAY</span>
                                        <span class="year text-light bg-year">2023</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="area-bottom">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                            <div class="pull-left animated slideInLeft"><h4 style='color:blue;'><i class="fa fa-video-camera"></i><a href='https://fb.watch/kPULk6O-TF/?mibextid=Nif5oz' target="_new" style='color:blue;'><B> EVENT LIVE RECORDED - 1</b></a></h4></div>
                            <div class="pull-left animated slideInLeft"><h4 style='color:blue;'><i class="fa fa-video-camera"></i><a href='https://fb.watch/kOabbKtMyi/?mibextid=SDPelY' target="_new" style='color:blue;'><B> EVENT LIVE RECORDED - 2</b></a></h4></div>
							</div>
                        </div>
                        
                    </div>
                </div>
                    </section>

                    <!-- <section class="container m-5 p-5">
                        
                        <div style="  
                        position: relative;
                        padding-bottom: 56.25%;
                        padding-top: 35px;
                        height: 0;
                        overflow: hidden;"> -->
                        <!-- <h2 class="heading-regular" style="color:#88211A;">ALUMNI MEET PICTURES</h2><br> -->
                            <!-- <iframe src="https://drive.google.com/embeddedfolderview?id=1aPomVI9r1PJiKGwpp3hbHEuaQK-qvZ3P#grid" class="container" width="500px" height="300px" allowfullscreen="" frameborder='0' style="
                            position: absolute;
                            top:0;
                            left: 0;
                            width: 100%;
                            height: 100%;"></iframe> -->
                        <!-- </div>
                    </section> -->



                    
                </div>
            </div>
        </div>		

</div>
</div>
</div>

<?php
include("footer.php");
?>
</div>

<script src="js/libs/jquery-2.2.4.min.js"></script>
<script src="js/libs/bootstrap.min.js"></script>
<script src="js/libs/owl.carousel.min.js"></script>
<script src="js/libs/jquery.meanmenu.js"></script>
<script src="js/libs/jquery.syotimer.js"></script>
<script src="js/libs/parallax.min.js"></script>
<script src="js/libs/jquery.waypoints.min.js"></script>
<script src="js/libs/slider.js"></script>
<script src="js/custom/main.js"></script>
<script>
    jQuery(document).ready(function () {
        $('#time').syotimer({
            year: 2016,
            month: 12,
            day: 7,
            hour: 7,
            minute: 7,
        });
    });
    
</script>
</body>
</html>