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
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <title>SAANA Membership</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,800;1,900&display=swap');

        body {
            line-height: 20px;
        }

        h3 {
            text-align: center;
            text-transform: uppercase;
            font-weight: 600;
            color: #88211A;
            margin: 5px;
            padding: 5px;
        }

        h4 {
            margin: 20px 0px 10px 0px;
            text-transform: capitalize;
            font-size: 18px;
            color: #88211A;
        }

        .content {
            margin: 20px;
            padding: 1% 3%;
            font-family: 'Poppins', sans-serif;
            background-color: white;

            /* background-color: aquamarine; */
            /* background-color: black; */
        }

        .disclaimer {
            padding: 2% 3%;
            background-color: white;

        }

        p {
            font-size: 13px;
            color: #3b3c36;

        }
    </style>

</head>

<body>
    <div class="main-wrapper">


        <?php
        include 'header.php';
        ?>
        <div class="divider divider--lg"></div>
        <div class="divider divider--lg"></div>
        <div class="content-wrapper" style="margin-top:50px">

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default terms" style="border:none;box-shadow: rgba(0, 0, 0, 0.07) 0px 1px 2px, rgba(0, 0, 0, 0.07) 0px 2px 4px, rgba(0, 0, 0, 0.07) 0px 4px 8px, rgba(0, 0, 0, 0.07) 0px 8px 16px, rgba(0, 0, 0, 0.07) 0px 16px 32px, rgba(0, 0, 0, 0.07) 0px 32px 64px;border-radius:10px;">
                                <div class="panel-heading disclaimer" style="background-color:white;border-radius:10px;">
                                    <h3 class="">Disclaimer</h3>
                                    <br>
                                    <p style="margin:5px;padding:1% 7%;text-align:center;">
                                        The SAANA is a nonprofit, tax-exempt charitable organization under Section 501(c)(3) of the
                                        Internal Revenue Code and is a registered Non-Profit Organization in Florida. Donations are
                                        tax-deductible as allowed by law.
                                    </p>

                                    <h4>SAANA respects your privacy</h4>
                                    <p style="text-align:justify;">
                                        Membership helps support the success and longevity of our alumni programming. This includes but is not limited to, educational resources, career services, regional and local clubs, networking opportunities through our Online Communities, and more.
                                        We respect the privacy of our website visitors. We collect information on or through this site
                                        that can personally identify you only when it is voluntarily offered by you. For example, we
                                        collect personally identifiable information to respond to your questions on our website and
                                        comments about us, and our services and mail e-newsletters, emails, and any additional
                                        updates that may be sent to you either by mail or electronically.
                                        We do not share any of the personal information you provide to us with any third party other
                                        than our service providers who assist us in providing the information and/or services we provide
                                        to you.
                                        Like many other organizations, we may use “cookie” technology, where our servers deposit
                                        special codes on a visitor’s computer. This information helps us determine in the aggregate the
                                        total number of visitors to the site on an ongoing basis and the types of Internet browsers (e.g.,
                                        Mozilla Firefox, Microsoft Edge, and Google Chrome) and operating systems (e.g., Windows or
                                        Apple) used by our visitors. This information is used to enhance your online visits. Under no
                                        circumstances do we use this information to personally identify visitors or cross-reference the
                                        information with any type of personal information that is voluntarily offered on or through the
                                        site.
                                        We may modify this policy at any time, in our sole discretion and all modifications will be
                                        effective immediately upon our posting of the modifications on this site. Unless we specifically
                                        provide otherwise, this policy only applies to this site and our online activities and does not
                                        apply to any of our offline activities.
                                    </p>

                                    <h4>Your Safety</h4>
                                    <p style="text-align:justify;">
                                        Please note that we never ask you for Social Security Numbers or Passwords when making
                                        donations or membership fees. Should you receive an email or letter asking you for such
                                        information, you are requested to inform us at info@saana.org. </p>

                                    <h4>Credit Card</h4>
                                    <p style="text-align:justify;">
                                        Credit card information is required to secure and properly process your credit card. This
                                        information is solely used for the processing of the credit card and is not stored in our system. If
                                        you feel a charge has been made against your credit card inappropriately, please contact us at
                                        info@saana.org, and we will endeavor to work with you to obtain a refund of the donation. </p>
                                </div>
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
    <script src="js/custom/main.js"></script>
</body>

</html>