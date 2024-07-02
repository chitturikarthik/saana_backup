
<?php 
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
    <link rel="stylesheet" href="css/dropdowns.css">
    <script src="js/libs/modernizr.custom.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <title>Alumni</title>
    <style>
     @media (min-width: 768px) {
    .mx-auto {
        margin-top: 210px;
      }
}
    </style>
</head>

<body>
    <div class="main-wrapper page">

        <?php
        include('header.php');
        ?>
        <!--End header wrapper-->

        <!--Begin content wrapper-->
        <div class="content-wrapper">
            <!--begin alumni interview-->
            <div class="alumni-interview">
                <div class="container">
                    <div class=" row  ">
                        <div class="  col-sm-6 col-xs-12 pull-left">
                            <div>
                                <img class="img-responsive mx-auto" src="images/saana_slogo3.png" alt="Loading" >
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12 pull-right">
                            <div class="interview-wrapper">
                                <div class="interview-title animated lightSpeedIn">
                                    <h1 class="heading-light text-capitalize" style="color:#88211A; font-weight:bold;">Alumni Engagement</h1>
                                </div>
                                <div class="interview-desc text-left animated rollIn">
                                    <p class="text-light text-large" style="font-family:Poppins;color:black; font-size: medium;">The SRKR Engineering College experience does not have to end when the canals and by-lanes of China amiram Road are in the rearview mirror. The green fields and the Godavari "ruchulu/abhiruchulu" extend beyond the SRKR campus. There are myriad opportunities to continue learning and to stay connected with one another and the College.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--end alumni interview-->

            <!--begin event calendar-->
            <div class="event-calendar">

                <div class="event-list-content">
                    <div class="event-list-item">
                        <div class="date-desc-wrapper">
                            <div class="typography text-regular">
                                <div class="container">
                                    <div class="divider divider--lg"></div>
                                    <div class="row listing">
                                        <div class="date-title">
                                            <h4 class="heading-regular"><a href="#" style="color:#88211A;">Alumni Directory</a></h4>
                                        </div>
                                        <div class="simple-list col-sm-6 col-xs-12">
                                            <ul>
                                                <li style="font-style:Poppins; color:black;">Login</li>
                                                <li style="font-style:Poppins; color:black;">Search the directory</li>
                                                <li style="font-style:Poppins; color:black;">See your class list</li>
                                                <li style="font-style:Poppins; color:black;">Update your profile</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="divider divider--lg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="event-list-item">
                        <div class="date-desc-wrapper">
                            <div class="date-desc">
                                <div class="date-title">
                                    <h4 class="heading-regular"><a href="#" style="color:#88211A;">Alumni Events </a></h4>
                                </div>
                                <div class="date-excerpt">
                                    <p style="font-style:Poppins; color:black;">Join us at one of our in-person or virtual alumni events</p>
                                </div>
                                <div class="place">
                                    <span class="icon map-icon"></span>
                                    <span class="text-place" style="font-style:Poppins; color:black;">New Jersey </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="event-list-item">
                        <div class="date-desc-wrapper">
                            <div class="date-desc">
                                <div class="date-title">
                                    <h4 class="heading-regular"><a href="#" style="color:#88211A">Career Network </a></h4>
                                </div>
                                <div class="date-excerpt">
                                    <p style="font-style:Poppins; color:black;">Help students and receive help from SAANA.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="event-list-item">
                        <div class="date-desc-wrapper">
                            <div class="typography text-regular">
                                <div class="container">
                                    <div class="divider divider--lg"></div>
                                    <div class="row listing">
                                        <div class="date-title">
                                            <h4 class="heading-regular"><a href="#" style="color:#88211A">Reunion</a></h4>
                                        </div>
                                        <div class="simple-list col-sm-6 col-xs-12">
                                            <ul>
                                                <li style="font-style:Poppins; color:black;">Reunion Classes</li>
                                                <li style="font-style:Poppins; color:black;">Meets</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="divider divider--lg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!--end alumni interview-->



            <!--begin Alumni Story-->

            <!--begin programs & services-->
            <div class="programs-services">
                <div class="container">
                    <div class="row">
                        <div class="services-img col-md-6 col-sm-12 col-xs-12">
                            <img class="img-responsive" src="images/saana_slogo3.png" alt="">
                        </div>
                        <div class="services-content col-md-6 col-sm-12 col-xs-12">
                            <h2 class="heading-regular" style="color:#88211A">Alumni Learning &amp; Services</h2>
                            <div id="tab_services">
                                <!--Nav tabs-->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a class="text-light" href="#social" aria-controls="social" role="tab" data-toggle="tab">Learning</a>
                                    </li>
                                    <li role="presentation">
                                        <a class="text-light" href="#professional" aria-controls="professional" role="tab" data-toggle="tab">Services</a>
                                    </li>
                                </ul>
                                <!--Tab panes-->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active animated zoomIn" id="social">
                                        <div class="tab-content-wrapper">
                                            <ul class="list-item text-light">
                                                <li style="font-style:Poppins; color:black;">Lectures and Talks</li>
                                                <li style="font-style:Poppins; color:black;">Alumni Travel - Travel globally?</li>
                                                <li style="font-style:Poppins; color:black;">Stories - Listen to unique stories and tell your story</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane animated zoomIn" id="professional">
                                        <div class="tab-content-wrapper">
                                            <ul class="list-item">
                                                <li style="font-style:Poppins; color:black;">Update your contact information</li>
                                                <li>Career services - Connect with the Center for Career and Professional Development to meet with a career coach and to search for employment opportunities. </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end programs & services-->

            <!--end Alumni Story-->




        </div>
        <!--End content wrapper-->



        <!--Begin footer wrapper-->
        <?php include('footer.php'); ?>
        <!--End footer wrapper-->
    </div>
    <script src="js/libs/jquery-2.2.4.min.js"></script>
    <script src="js/libs/bootstrap.min.js"></script>
    <script src="js/libs/owl.carousel.min.js"></script>
    <script src="js/libs/jquery.meanmenu.js"></script>
    <script src="js/libs/jquery.syotimer.js"></script>
    <script src="js/libs/parallax.min.js"></script>
    <script src="js/libs/jquery.waypoints.min.js"></script>
    <script src="js/custom/main.js"></script>
    <script>
        jQuery(document).ready(function() {
            $('#time2').syotimer({
                year: 2023,
                month: 04,
                day: 15,
                hour: 15,
                minute: 15,
            });
        });
    </script>
</body>

</html>