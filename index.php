<?php
include('session_management.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="title" content="SAANA SRKREC ALUMNI ASSOCIATION OF NORTH AMERICA">
    <meta name="description" content="SRKREC ALUMNI ASSOCIATION OF NORTH AMERICA (SAANA) is the Alumni Association of SRKR Engineering College, Bhimavaram residing in North America">
    <meta name="keywords" content="SAANA, SRKREC ALUMNI ASSOCIATION OF NORTH AMERICA, SRKR Alumni, America Alumni, SRKREC Bhimavaram, USA Alumni, America Alumni">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="revisit-after" content="2 days">
    <meta name="author" content="Department of Computer Science & Design (CSD), SRKREC, Bhimavaram">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="icon" href="favicon.ico" type="image/ico" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/animate.css" />
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <link rel="stylesheet" type="text/css" href="css/meanmenu.css" />
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/lightbox.css" />

    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <script src="js/libs/lightbox-plus-jquery.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <script src="js/libs/alumni_gallery.js" defer></script>
    <title>SAANA Home</title>

    <style>
        .gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly;
            align-items: center;
        }

        .gallery img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            margin: 10px;
            cursor: pointer;
        }

        .popup {
            display: none;
            position: fixed;
            z-index: 9999;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            overflow: auto;
        }

        .popup-img {
            display: block;
            /* position: absolute; */
            margin: auto;
            max-width: 70%;
            max-height: 70%;
            padding-top: 20px;
            /* padding-bottom: 20px; */

        }

        .close {
            display: block;
            position: absolute;
            top: 0;
            right: 0;
            font-size: 50px;
            font-weight: bold;
            color: white;
            padding: 10px;
            cursor: pointer;
        }

        .prev,
        .next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 3em;
            font-weight: bold;
            color: #fff;
            text-decoration: none;
            background-color: brown;
            padding: 0.5em;
            border-radius: 50%;
            cursor: pointer;
            z-index: 2;
        }

        .prev {
            left: 2em;
            z-index: 2;

        }

        .next {
            right: 2em;
        }

        /* Import Google font - Poppins */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

        /* * {
            
        } */

        .karthik {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
            display: flex;
            /* padding: 0 30px; */
            align-items: center;
            justify-content: center;
            min-height: 70vh;
            /* background: lightgray; */
        }

        .wrapper {
            max-width: 1300px;
            width: 100%;
            position: relative;
        }

        .wrapper i {
            top: 50%;
            height: 50px;
            width: 50px;
            cursor: pointer;
            font-size: 1.25rem;
            position: absolute;
            text-align: center;
            line-height: 50px;
            color: white;
            background: rgba(136, 33, 26, 0.7);
            border-radius: 50%;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.23);
            transform: translateY(-50%);
            transition: transform 0.1s linear;
        }

        .wrapper i:active {
            transform: translateY(-50%) scale(0.85);
        }

        .wrapper i:first-child {
            left: -22px;
        }

        .wrapper i:last-child {
            right: -22px;
        }

        .wrapper .carousel {
            display: grid;
            grid-auto-flow: column;
            grid-auto-columns: calc((100% / 3) - 12px);
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            gap: 20px;
            border-radius: 8px;
            scroll-behavior: smooth;
            scrollbar-width: none;
        }

        .carousel::-webkit-scrollbar {
            display: none;
        }

        .carousel.no-transition {
            scroll-behavior: auto;

        }

        .carousel.dragging {
            scroll-snap-type: none;
            scroll-behavior: auto;
        }

        .carousel.dragging .card {
            cursor: grab;
            user-select: none;
        }

        .carousel :where(.card, .img) {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .carousel .card {
            scroll-snap-align: start;
            height: 342px;
            list-style: none;
            /* background: brown; */
            cursor: pointer;
            padding-bottom: 15px;
            flex-direction: column;
            border-radius: 8px;
        }

        .carousel .card .img {
            /* background: #8B53FF; */
            height: 100%;
            width: auto;
            /* box-shadow: 2px 2px 10px black; */
            /* border-radius: 50%; */
        }

        .card .img img {
            width: 100%;
            height: auto;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            object-fit: cover;
            /* border: 4px solid #fff; */
            /* border-radius: 8px; */

        }

        .carousel .card h2 {
            font-weight: 500;
            font-size: 1.56rem;
            margin: 30px 0 5px;
        }

        .carousel .card span {
            color: #6A6D78;
            font-size: 1.31rem;
        }

        .left {
            z-index: 3;
        }

        @media screen and (max-width: 900px) {
            .wrapper .carousel {
                grid-auto-columns: calc((100% / 2) - 9px);
            }
        }

        @media screen and (max-width: 600px) {
            .wrapper .carousel {
                grid-auto-columns: 100%;
            }
        }
    </style>



</head>

<body>
    <div class="main-wrapper">
        <!--Begin header ưrapper-->
        <?php
        include('header.php');
        ?>
        <!--End header wrapper-->

        <!--Begin content wrapper-->
        <div class="content-wrapper">
            <!--begin slider-->
            <div class="slider-hero mt-5">
                <div class="owl-carousel">
                    <div class="item">
                        <img src="images/slider/1.jpg" alt="">
                        <div class="owl-caption">
                            <div class="container">
                                <div class="content-block">
                                    <h2 class="text-center">
                                    </h2>
                                    <h2 class="text-center">
                                        <span class="text-bold"> </span> <br /><br />
                                        <span class="text-white"></span>
                                    </h2>
                                    <div align="center"><a href="register_google.php" class="bnt bnt-theme read-story" style="background-color:#88211c;border-color:#882110;">Join the Network</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <a href="events.php">
                            <img src="images/slider/SAANA.png" alt="">
                            <div class="owl-caption">
                                <div class="container">
                                    <div class="content-block">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!--end slider-->

            <!--begin alumni interview-->
            <div class="about-us">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 pull-right">
                            <div class="interview-wrapper">
                                <div class="interview-title"><br><br>
                                    <h2 class="heading-regular animated fadeInLeft" style="color:#88211A;">SAANA: SRKREC ALUMNI ASSOCIATION OF NORTH AMERICA</h2>
                                </div>
                                <div class="font14 text-justify">
                                    <p class="desc" style="color:#262626;line-height:1.5; font-family: Poppins; font-size:medium;"><br>
                                        Welcome SRKREC alumni, and friends!<br>
                                        <img src='images/saana_slogo3.png' class="img-responsive" style='float:right;width:50%;'>
                                        Whether you’re looking to reconnect or grow your career, support, and contribute to SRKREC Alumni Association of North America (SAANA)’s mission, or learn about the impact of giving, you’ve come to the right place. <b style="color:#000009; text-decoration:none;">SAANA’s mission is to inspire, educate and empower SRKREC Alumni in North America to take everyday action to improve and share with the alumni community.</b> If you simply come here to connect, we encourage you to check out communities, career offerings, and events. Take a look around and find the SAANA that speaks to you.<br><br><br>

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--end alumni interview-->

        </div>
        
        <!--begin upcoming event-->
        <div class="divider divider--lg"></div>

        <div class="container-fluid upcoming-event">
            <div class="container">

                <div class="row">

                    <div class="area-img col-md-9 col-sm-12 col-xs-12">
                        <a href="javascript:void(0)">
                            <img class="img-responsive animated zoomIn" src="images/gallery/event1/event1.jpg" alt="SAANA EVENT" style='border-radius:5px;'>
                        </a>
                    </div>
                    <section>
                        <div class="area-content col-md-3 col-sm-12 col-xs-12">
                            <div class="area-top">
                                <div class="row">
                                    <div class="col-sm-12 col-xs-9">
                                        <h2 class="heading-regular animated fadeInLeft" style="color:#88211A;">FIRST SRKREC ALUMNI MEET IN NORTH AMERICA</h2>
                                        <span>
                                            <span class="text-place text-light animated fadeInRight"> New Jersey Convention & Expo center Edison , NJ.</span>
                                        </span>
                                        <br><br><br>
                                        <div class="area-calendar calendar animated slideInRight">
                                            <span class="day text-bold">27</span>
                                            <span class="month text-light">MAY</span>
                                            <span class="year text-light bg-year">2023</span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <div class="upcoming-event galery-title text-center">
            <h2 class="heading-regular" style="color:#88211A;">ALUMNI GALLERY</h2>
        </div>
        <section class="upcoming-event container-fluid karthik">
            <div class="wrapper">

                <i id="left" class="fa-solid fa-angle-left left"></i>
                <!-- <i id="right" class="fa-solid fa-angle-right"></i> -->
                <ul class="carousel">
                    <li class="card">
                        <a href="images/gallery/1.jpg" data-lightbox="models" data-title="">
                            <div class="img"><img src="images/gallery/1.jpg" alt="img" draggable="false"></div>
                        </a>
                    </li>
                    <li class="card">
                        <a href="images/gallery/2.jpg" data-lightbox="models" data-title="">
                            <div class="img"><img src="images/gallery/2.jpg" alt="img" draggable="false"></div>
                        </a>
                    </li>
                    <li class="card">
                        <a href="images/gallery/3.jpg" data-lightbox="models" data-title="">
                            <div class="img"><img src="images/gallery/3.jpg" alt="img" draggable="false"></div>
                        </a>
                    </li>
                    <li class="card">
                        <a href="images/gallery/4.jpg" data-lightbox="models" data-title="">
                            <div class="img"><img src="images/gallery/4.jpg" alt="img" draggable="false"></div>
                        </a>
                    </li>
                    <li class="card">
                        <a href="images/gallery/5.jpg" data-lightbox="models" data-title="">
                            <div class="img"><img src="images/gallery/5.jpg" alt="img" draggable="false"></div>
                        </a>
                    </li>
                    <li class="card">
                        <a href="images/gallery/6.jpg" data-lightbox="models" data-title="">
                            <div class="img"><img src="images/gallery/6.jpg" alt="img" draggable="false"></div>
                        </a>
                    </li>
                    <li class="card">
                        <a href="images/gallery/7.jpg" data-lightbox="models" data-title="">
                            <div class="img"><img src="images/gallery/7.jpg" alt="img" draggable="false"></div>
                        </a>
                    </li>
                    <li class="card">
                        <a href="images/gallery/8.jpg" data-lightbox="models" data-title="">
                            <div class="img"><img src="images/gallery/8.jpg" alt="img" draggable="false"></div>
                        </a>
                    </li>
                    <li class="card">
                        <a href="images/gallery/9.jpg" data-lightbox="models" data-title="">
                            <div class="img"><img src="images/gallery/9.jpg" alt="img" draggable="false"></div>
                        </a>
                    </li>
                    <li class="card">
                        <a href="images/gallery/10.jpg" data-lightbox="models" data-title="">
                            <div class="img"><img src="images/gallery/10.jpg" alt="img" draggable="false"></div>
                        </a>
                    </li>
                    <li class="card">
                        <a href="images/gallery/11.jpg" data-lightbox="models" data-title="">
                            <div class="img"><img src="images/gallery/11.jpg" alt="img" draggable="false"></div>
                        </a>
                    </li>
                    <li class="card">
                        <a href="images/gallery/12.jpg" data-lightbox="models" data-title="">
                            <div class="img"><img src="images/gallery/12.jpg" alt="img" draggable="false"></div>
                        </a>
                    </li>
                </ul>
                <i id="right" class="fa-solid fa-angle-right right"></i>
            </div>
        </section>


        <div class="our-history">
            <div class="container">
                <div class="title-page text-center">
                    <h3 class="text-regular">SRKREC Expansion (New Branches)</h3>
                </div>
                <div class="history-content">
                    <ul class="list-history text-center">
                        <li>
                            <span class="history-title text-light">CIVIL, MECH, ECE <br><br></span>
                            <span class="history-dot"> <span></span></span>
                            <span class="history-year">1980</span>
                        </li>
                        <li>
                            <span class="history-title">CSE , EEE, IT<br><br></span>
                            <span class="history-dot"> <span></span></span>
                            <span class="history-year">1990</span>
                        </li>
                        <li>
                            <span class="history-title">MPIE <br> <br>
                            </span>
                            <span class="history-dot"> <span></span></span>
                            <span class="history-year">2000</span>
                        </li>
                        <li>
                            <span class="history-title">-<br><br></span>
                            <span class="history-dot"> <span></span></span>
                            <span class="history-year">2010</span>
                        </li>

                        <li>
                            <span class="history-title" style="width:300px; align-items: center; margin-left:-50px;">CSBS,AI&DS,AI&ML,CSD,CS-IOT <br><br></span>
                            <span class="history-dot"> <span></span></span>
                            <span class="history-year">2020</span>
                        </li>
                        <li>
                            <span class="history-title"><br><br></span>
                            <span class="history-dot"> <span></span></span>
                            <span class="history-year"></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="divider divider--lg"></div>

        <!--End content wrapper-->
        <!--Begin footer wrapper-->
        <?php
        include('footer.php');
        ?>
        <!--End footer wrapper-->
        <div class="bg-popup"></div>
        <div class="wrapper-popup">
            <a href="javascript:void(0)" class="close-popup"><span class="lnr lnr-cross-circle"></span></a>
            <div class="popup-content">
                <!--content-popup   -->

            </div>
        </div>

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
        jQuery(document).ready(function() {
            $('#time').syotimer({
                year: 2016,
                month: 12,
                day: 7,
                hour: 7,
                minute: 7,
            });
        });
    </script>
    <script>
    </script>


</body>

</html>