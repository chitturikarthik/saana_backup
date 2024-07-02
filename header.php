<?php
echo '<div class="header-wrapper header-position">
    <header id="header" class="container-header type2">
        <div class="top-nav" style="background-color:#88211A;">
            <div class="container">
                <div class="row">
                    <div class="top-right col-md-9 col-sm-12 col-xs-12 pull-right">
                        <ul class="list-inline">
                            <li class="hidden-xs">
                                <a href="mailto:saana.org@gmail.com">
                                    <span class="icon mail-icon" style="color:#ffd700;"></span>
                                    <span class="text" style="color:white;">saana.org@gmail.com</span>
                                </a>
                            </li>
                            <li class="hidden-xs">
                                <a href="tel:+571.250.6370">
                                    <span class="icon phone-icon" style="color:#ffd700;"></span>
                                    <span class="text" style="color:white;">571.250.6370</span>
                                </a>
                            </li>

                            <li>
                                <a href="https://facebook.com/saanainc" target="_blank"><i class="fa fa-facebook" aria-hidden="true" style="color:#ffffff;"></i></a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/groups/14140116/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true" style="color:#ffffff;"></i></a>
                            </li>';
                            if (isset($_SESSION['username'])) {
                            include('connect.php');
                            $email_id = $_SESSION['username'];
                            $sql = "SELECT first_name,last_name FROM all_members WHERE email_id='$email_id'";
                            $result = $pdo->query($sql);
                            $row = $result->fetch();

                            echo '
                            <li>
                                <a href="profile.php" style="color:#ffffff; margin-left:30px">
                                    <i class="fa fa-user" aria-hidden="true" style="color:#ffffff;"></i>
                                </a>
                            </li>
                            <li class="login">
                                <a href="logout.php" style="color:#88211A;background-color:white;"><b>LOGOUT</b></a>
                            </li>
                            <li class="hidden-xs ">
                                <a href="profile.php" style="color:#ffffff; ">
                                    <p style="color:white">Hi , ' . $row['first_name'] . ' ' . $row['last_name'];
                                        '</p>
                                </a>
                            </li>


                            ';
                            } else {
                            echo '<li class="login">
                                <a href="login.php" style="color:#88211A;background-color:white;"><b>MEMBER LOGIN</b></a>
                            </li>';
                            }
                            echo '
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle">
            <div class="container">
                <div class="logo hidden-sm hidden-xs">
                    <a href="index.php"> <img src="images/logo.png" alt="logo"></a>
                </div>
                <div class="menu">
                    <nav>
                        <ul class="nav navbar-nav">

                            <li>
                                <a href="index.php" style="color:#88211A;"><b>HOME</b></a>
                            </li>
                            <li class="dropdown"><a href="#" style="color:#88211A;"><b>MEMBERSHIP</b></a>
                                <ul class="dropdown-content">
                                    <li><a href="register.php">Join SAANA</a></li>
                                    <li><a href="membership.php">Membership FAQ</a></li>
                                    <li><a href="membership_status.php">Membership Status</a></li>

                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" style="color:#88211A;"><b>ALUMNI</b></a>
                                <ul class="dropdown-content">
                                    <li><a href="alumni.php">Alumni Engagement</a></li>
                                    <li><a href="under-construction.php">Alumni Directory</a></li>
                                    <li><a href="under-construction.php">Alumni Association</a></li>
                                    <li><a href="under-construction.php">Alumni Services</a></li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" style="color:#88211A;"><b>RESOURCES</b></a>
                                <ul class="dropdown-content">
                                    <li><a href="under-construction.php">Career</a></li>
                                    <li><a href="under-construction.php">Notable Alumini</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" style="color:#88211A;"><b>GET INVOLVED</b></a>
                                <ul class="dropdown-content">
                                    <li><a href="under-construction.php">Communities & Clubs</a></li>
                                    <li><a href="events.php">Events</a></li>
                                    <li><a href="under-construction.php">Volunteer</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" style="color:#88211A;"><b>ABOUT</b></a>

                                <ul class="dropdown-content">
                                    <li><a href="under-construction.php">Our History</a></li>
                                    <li><a href="under-construction.php">Our Programs</a></li>
                                    <li><a href="bod.php">Board Of Directors</a></li>
                                    <li><a href="executive_committee.php">Executive Committee</a></li>
                                    <li><a href="advisory.php">Advisory Committee</a></li>
                                    <li><a href="bylaws.php">Bylaws</a></li>
                                    <li><a href="disclaimer.php">Disclaimer</a></li>
                                    <li><a href="under-construction.php">Contact Us</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="area-mobile-content visible-sm visible-xs">
                    <div class="logo-mobile">
                        <a href="index.php"><img src="images/logom.png" alt="logo" style="height:60px;"></a>
                    </div>
                    <div class="mobile-menu ">
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>';