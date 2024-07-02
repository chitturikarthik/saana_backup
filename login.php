<?php
include('session_management.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('connect.php');

if (isset($_SESSION['username'])) {
    header('location:profile.php');
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $recaptchaResponse = $_POST['g-recaptcha-response'];
    $errorMsg = "";
    if (empty($username) || empty($password)) {
        $errorMsg = "Please fill all the fields";
    } else {
        // Verify reCAPTCHA response
        $secretKey = "6LfWhEQnAAAAALQqDfu1TcNl_MHsSuVYuANUUUl3"; // Replace with your Secret key
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $data = [
            "secret" => $secretKey,
            "response" => $recaptchaResponse,
            "remoteip" => $_SERVER["REMOTE_ADDR"]
        ];

        $options = [
            "http" => [
                "header" => "Content-type: application/x-www-form-urlencoded\r\n",
                "method" => "POST",
                "content" => http_build_query($data)
            ]
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $response = json_decode($result, true);

        if ($response["success"]) {
            $sql = "SELECT * FROM login WHERE username=:username AND password=:password ";
            $sql_payment = "SELECT * FROM all_members WHERE email_id=:username";
            $stmt_payment = $pdo->prepare($sql_payment);
            $stmt_payment->execute(['username' => $username]);
            // $result_payment = $stmt_payment->fetch(PDO::FETCH_ASSOC);
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['username' => $username, 'password' => $password]);
            // $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($stmt->rowCount() > 0 && $stmt_payment->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $row_payment = $stmt_payment->fetch(PDO::FETCH_ASSOC);
                if ($row_payment['payment_status'] != "Pending") {
                    $_SESSION['username'] = $row['username'];
                    header('Location: profile.php');
                } else {
                    $errorMsg = "Your account is inactive, please contact admin";
                }
            } else {
                $errorMsg = "Invalid Email ID or Password";
            }
        } else {
            // header('Location: login.php');
            $errorMsg = "reCAPTCHA verification failed, please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="icon" href="favicon.ico" type="image/ico" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <link rel="stylesheet" type="text/css" href="css/meanmenu.css" />
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <script src="js/libs/modernizr.custom.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title> Login Page </title>
    <style>
        .input-box.mobile {
            position: relative;
        }

        .show-password-icon {
            cursor: pointer;
        }

        .show-password-icon::before {
            cursor: pointer;
            position: absolute;
            right: 5px;
            top: 40%;
            transform: translateY(-50%);
        }

        @media (min-width: 768px) {
            .container.login {
                width: 601px;
            }
        }
    </style>
</head>

<body>
    <div class="main-wrapper page">
        <!--Begin content wrapper-->
        <?php include('header.php'); ?>
        <div class="content-wrapper">
            <div class="account-page login text-center">
                <div class="container login">
                    <div class="account-title">
                        <h4 class="heading-light"><B>MEMBER LOGIN</B></h4>
                    </div>
                    <div class="account-content" style="display:flex;flex-direction:column;justify-content:center;align-items:center;">
                        <form action="#" method="post">
                            <!-- Display the error message in a div with red color -->
                            <?php if (!empty($errorMsg)) { ?>
                                <div class="alert alert-danger alert-dismissible text-center">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <?php echo $errorMsg; ?>
                                </div>
                            <?php } ?>
                            <div class="input-box email_id">
                                <input type="text" placeholder="Email ID" name="username">
                            </div>
                            <div class="input-box mobile">
                                <input type="password" placeholder="Password" name="password" id="password">
                                <i class="show-password-icon fa fa-eye" onclick="togglePasswordVisibility()" id="togglePassword"></i>
                            </div><br><br>
                            <div class="input-box email_id">
                                <div class="input-box mobile">
                                    <div class="g-recaptcha" data-sitekey="6LfWhEQnAAAAAL2WmqEPkmGFXXzuixrN_pjF1KcS"></div>
                                    <div id="captcha-error"></div>
                                </div>
                            </div>
                            <div class="buttons-set">
                                <button type="submit" class="heading-regular" name="login" style="background-color:#88211A;color:white;margin:2px;padding:10px;font-size:large; border:0px;">LOG IN</button>
                            </div>
                            <div class="container-fluid" style="margin: 10px;padding:10px;">
                                <h5 class="heading-regular">Not a Member? <span><a href="register.php" style="color:#88211A;"><U>REGISTER HERE</U>!</a><span></h5>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!--End content wrapper-->
        <?php include('footer.php'); ?>

    </div>
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById("password");
            const toggleIcon = document.getElementById("togglePassword");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }
    </script>
    <script src="js/libs/jquery-2.2.4.min.js"></script>
    <script src="js/libs/bootstrap.min.js"></script>
    <script src="js/libs/owl.carousel.min.js"></script>
    <script src="js/libs/jquery.meanmenu.js"></script>
    <script src="js/libs/parallax.min.js"></script>
    <script src="js/libs/jquery.waypoints.min.js"></script>
    <script src="js/custom/main.js"></script>

</body>

</html>