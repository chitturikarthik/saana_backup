<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
$errorMsg = "";
$successMsg = "";
// Check if the form is submitted
if (isset($_POST['register'])) {
    // Include the database connection file
    require 'connect.php';
    // Function to sanitize input data
    function sanitize($input)
    {
        return trim(htmlspecialchars($input, ENT_QUOTES, 'UTF-8'));
    }
    // Function to validate integer fields
    function validateInteger($value)
    {
        return filter_var($value, FILTER_VALIDATE_INT);
    }
    // Sanitize and validate input data
    $date = date("Y-m-d");
    $email = sanitize($_POST['email']);
    $pass = $_POST['pass'];
    // $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
    $cpass = $_POST['cpass'];
    $fname = sanitize($_POST['fname']);
    $mname = sanitize($_POST['mname']);
    $lname = sanitize($_POST['lname']);
    $maiden = sanitize($_POST['maiden']);
    $nname = sanitize($_POST['nname']);
    $mobile = $_POST['mobile'];
    $mobile_without_formatting = preg_replace('/[^0-9]/', '', $mobile); // Remove non-numeric characters and leading "1"
    $mobile_without_plus = substr($mobile_without_formatting, 1); // Remove leading +1    $nickname = $_POST['nickname'];
    $addr_one = sanitize($_POST['address']);
    $addr_two = sanitize($_POST['addr_two']);
    $country = sanitize($_POST['country']);
    $state = sanitize($_POST['state']);
    $city = sanitize($_POST['city']);
    $code = ($_POST['code']);
    $work = sanitize($_POST['work']);
    $title = sanitize($_POST['title']);
    $year = validateInteger($_POST['year']);
    $dept = sanitize($_POST['dept']);
    $additional_qual = sanitize($_POST['additional_qual']);
    $comment = sanitize($_POST['comment']);
    $amount = validateInteger($_POST['amount']);
    $other_amount = validateInteger($_POST['other-amount']);
    $addn_amount = $amount + $other_amount;
    $recaptchaResponse = $_POST['g-recaptcha-response'];
    $payment_status = "Pending";

    if (!isset($_POST['terms'])) {
        $errorMsg = "Please accept the terms and conditions";
    } else if (empty($email) || empty($pass) || empty($fname) || empty($lname) || empty($mobile_without_plus) || empty($addr_one) || empty($country) || empty($state) || empty($city) || empty($code) || empty($year) || empty($dept)) {
        $errorMsg = "Please fill all the required fields (*)";
    } else {
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
            $checkQuery = "SELECT COUNT(*) as count FROM all_members WHERE email_id = :email OR mobile LIKE :mobile ";
            $checkStmt = $pdo->prepare($checkQuery);

            // Create a new variable to pass by reference
            $mobileParam = '%' . $mobile_without_plus . '%';

            $checkStmt->bindParam(':mobile', $mobileParam);
            $checkStmt->bindParam(':email', $email);
            $checkStmt->execute();
            $row = $checkStmt->fetch(PDO::FETCH_ASSOC);

            if ($row['count'] > 0) {
                $errorMsg = 'You are already Registered, Please <a href="login.php">Log In</a>';
            } else {
                $nameCheckQuery = "SELECT COUNT(*) as count FROM all_members WHERE first_name = :first_name AND last_name = :last_name AND year_of_graduation = :year_of_graduation AND dept = :branch";
                $nameCheckStmt = $pdo->prepare($nameCheckQuery);
                $nameCheckStmt->bindParam(':first_name', $fname);
                $nameCheckStmt->bindParam(':last_name', $lname);
                $nameCheckStmt->bindParam(':year_of_graduation', $year);
                $nameCheckStmt->bindParam(':branch', $dept);
                $nameCheckStmt->execute();
                $nameCheckRow = $nameCheckStmt->fetch(PDO::FETCH_ASSOC);

                if ($nameCheckRow['count'] > 0) {
                    $errorMsg = 'A user with the provided First Name, Last Name, Year of Graduation, and Branch is already registered, Please <a href="login.php">Log In</a>';
                } else {
                    // Prepare the SQL statement with placeholders
                    $query = "INSERT INTO all_members
                    (
                        registration_date,
                        email_id,
                        mobile,
                        first_name,
                        middle_name,
                        last_name,
                        maiden_name,
                        nickname,
                        address_line,
                        address_line2,
                        country,
                        state,
                        city,
                        postal_code,
                        current_organization,
                        curr_role, 
                        year_of_graduation,
                        dept,
                        additional_qual,
                        additional_comments,
                        addn_amount,
                        payment_status
                    ) 
                    VALUES (
                        ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?
                    )";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindParam(1, $date);
                    $stmt->bindParam(2, $email);
                    $stmt->bindParam(3, $mobile_without_plus);
                    $stmt->bindParam(4, $fname);
                    $stmt->bindParam(5, $mname);
                    $stmt->bindParam(6, $lname);
                    $stmt->bindParam(7, $maiden);
                    $stmt->bindParam(8, $nname);
                    $stmt->bindParam(9, $addr_one);
                    $stmt->bindParam(10, $addr_two);
                    $stmt->bindParam(11, $country);
                    $stmt->bindParam(12, $state);
                    $stmt->bindParam(13, $city);
                    $stmt->bindParam(14, $code);
                    $stmt->bindParam(15, $work);
                    $stmt->bindParam(16, $title);
                    $stmt->bindParam(17, $year);
                    $stmt->bindParam(18, $dept);
                    $stmt->bindParam(19, $additional_qual);
                    $stmt->bindParam(20, $comment);
                    $stmt->bindParam(21, $addn_amount);
                    $stmt->bindParam(22, $payment_status);

                    // Execute the statement
                    if ($stmt->execute()) {
                        $successMsg = "You Registered Successfully";
                        $queryLogin = "INSERT INTO login (username,password) VALUES (:username,:password)";
                        $stmtLogin = $pdo->prepare($queryLogin);
                        $stmtLogin->bindParam(':username', $email);
                        $stmtLogin->bindParam(':password', $pass);

                        if ($stmtLogin->execute()) {
                            $successMsg = "Your membership registration was successfully completed.";
                            
                            include './sendgrid/email.php';

                            $_SESSION['email'] = $email;
                            $msgHeading = "Remainder : Pending payment for SAANA Lifetime Membership" ;
                            $msgBody="
                            <div style='font-family:Inter,sans-serif;'>
                            <p>
                            Dear SAANA Member,<br>
                            We have received your SAANA Lifetime Membership Registration form. <br>
                            Thank you for completing the registration.However, the membership payment is still pending.<br>
                            We would not be able to confirm your membership to be active if the payment is not processed.<br><br>
                            Could you please kindly submit the payment for your registration?<br>
                            You could make the payment via Zelle or Paypal. Please see the related information below:<br>
                            <b>Zelle - No Additional  Convenience  Fees are charged !
                            </b><br>
                            <b>Zelle Account: saana.org@gmail.com</b><br><br>
                            Please add your Full Name, Year of Graduation & Branch in the memo on the payment screen!<br><br><br>
                            Thank You<br>
                            Executive Committee & Board of Directors<br>
                            SAANA, Inc.<br>
                            saana.org@gmail.com<br>
                           (571) 250-6370
                            </p>
                            </div>
                            ";
                            echo "
                            <script>
                            console.log('Email Sent Successfully!');
                            </script>
                            ";
                            sendEmail($email, $msgHeading,$msgBody);
                            header('Location: paypal_index_copy.php');
                            exit;
                        } else {
                            $errorMsg = "Registration Failed";
                        }
                    } else {
                        $errorMsg = "Registration Failed";
                    }
                }
            }
        } else {
            $errorMsg = "reCAPTCHA verification failed";
        }
    }
    // Close the database connection
    unset($pdo);
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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <script src="js/libs/modernizr.custom.js"></script>
    <title> Register Page </title>


    <style>
        /* Add this CSS to style the radio buttons */
        .radio-container {
            display: flex;
            flex-wrap: wrap;
            /* Allow wrapping of amount boxes on smaller screens */
            background-color: #ffffff;
            /* Transparent green background color */
            padding: 10px;
            /* Adjust padding as needed */
            border-radius: 5px;
            border: 1px solid #ccc;
            /* Add grey border */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            /* Box shadow */
        }

        .form-check {
            display: flex;
            align-items: center;
            flex-grow: 1;
            /* Allow form-check elements to grow and fill available space */
        }

        .form-check input[type="radio"] {
            display: none;
            /* Hide the actual radio input */
        }

        .form-check label {
            cursor: pointer;
            padding: 15px;
            /* Adjust space around the text */
            border: 2px solid #ccc;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            background-color: #f8f8f8;
            /* Background color for the boxes */
            margin: 10px;
            /* Adjust as needed for spacing between boxes */
            text-align: center;
            /* Center text horizontally within the label */
            flex-grow: 1;
            /* Allow label to grow and fill available space */
        }

        .form-check input[type="radio"]:checked+label {
            background-color: #88211A;
            /* Change background color for selected option */
            border-color: #88211A;
            /* Change border color for selected option */
            color: #fff;
            /* Change text color for selected option */
        }

        .custom-amount {
            display: none;
            /* Initially hide the custom amount input */
            margin-top: 10px;
        }

        .custom-amount input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group {
            width: 100%;
        }

        .select-label {
            font-weight: bold;
            margin-right: 20px;
        }

        /* Additional CSS for the Other Amount input */
        .other-amount-input {
            margin-top: 20px;
            /* Adjust as needed for spacing */
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* Responsive styling for smaller screens (e.g., mobile) */
        @media (max-width: 768px) {
            .radio-container {
                flex-direction: column;
                /* Display radio buttons vertically on smaller screens */
            }

            .form-check {
                margin-right: 0;
                /* Reset right margin to stack them vertically */
                margin-bottom: 10px;
                /* Reduce bottom margin for spacing */
                flex-grow: 0;
                /* Prevent form-check elements from growing on mobile */
                width: auto;
                /* Allow form-check elements to have their natural width on mobile */
            }

            .form-check label {
                width: auto;
                /* Allow labels to have their natural width on mobile */
            }

            .custom-amount {
                margin-top: 10px;
                /* Add margin to separate the custom input on mobile */
            }
        }

        /* Style for the Other Amount input when displayed */
        .custom-amount input[type="text"] {
            border: none;
            /* Remove border for the text input */
            border-bottom: 2px solid #ccc;
            /* Add a green line styling to the bottom of the input */
            background-color: transparent;
            /* Transparent background */
            margin-top: 10px;
            font-weight: bold;
            padding: 0;
            /* Remove any padding */
            width: 100%;
            /* Make the input span the full width */
            text-align: left;
            /* Move text to the right side */
            outline: none;
            /* Remove the default focus outline */
            box-shadow: none;
            /* Remove box shadow */
            appearance: none;
            /* Remove default input styling (e.g., arrows in number input) */
            padding-right: 10px;
            /* Add some right padding to move the text to the right */
        }

        /* Style the placeholder text */
        .custom-amount input[type="text"]::placeholder {
            text-align: left;
            /* Align placeholder text to the right */
        }

        /* Remove spin buttons in number input for certain browsers */
        .custom-amount input[type="number"]::-webkit-inner-spin-button,
        .custom-amount input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            appearance: none;
            margin: 0;
        }
    </style>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&display=swap');

        body {
            background-color: #f5f5f5;
        }

        @media (min-width: 991px) {
            .main-wrapper-profile {
                padding-top: 135px;

            }
        }

        @media (max-width: 767px) {
            .main-wrapper-profile {
                padding-top: 0px;
            }
        }

        .container-form {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 0 auto;
            /* Center the container horizontally */
        }

        .container-form {
            max-width: 600px;
            /* Limit the width to fit the screen */
            margin-top: 50px;
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 10px;
            /* Add the desired margin between label and input field */
        }

        .form-control:focus {
            border-color: cyan;
            /* Change the border color on focus */
            box-shadow: cyan 0 0 0 0.2rem;
            /* Add a box-shadow on focus */
            outline: 0;
            /* Remove the default outline */
        }

        .form-group.required label::after {
            content: "*";
            color: red;
            margin-left: 5px;
        }

        /* Custom styles for select2 dropdown on hover */
        .select2-container--open .select2-dropdown--below {
            border-color: #88211A;
            /* Change the border color of the select2 dropdown on open */
            box-shadow: 0 0 0 0.2rem rgba(136, 33, 26, 0.25);
            /* Add a box-shadow to the select2 dropdown on open */
        }

        .select2-results__option {
            color: #000000;
            /* Change the color of the select2 dropdown options */
        }

        .btn-primary,
        .btn-danger {
            background-color: #88211A;
            border: none;
            margin-left: 15px;
        }

        .btn-primary:hover,
        .btn-danger:hover {
            background-color: #702017;
        }

        /* Custom styles for images and icons */


        .show-password-icon {
            cursor: pointer;
        }

        .show-password-icon::before {
            cursor: pointer;
            position: absolute;
            right: 25px;
            top: 50%;
            transform: translateY(-50%);
        }

        @media (max-width: 767px) {

            /* For screens less than 768px wide */
            .row.justify-content-center {
                flex-direction: column;
                /* Stack columns vertically */
                align-items: center;
                /* Center align columns vertically */
            }

            .col-lg-4,
            .col-md-6,
            .col-sm-6 {
                width: 100%;
                /* Full width on mobile screens */
            }
        }




        /* Custom CSS using Bootstrap class names */
        /* Custom CSS using Bootstrap class names */
        .form-group label {
            display: block;
            margin-bottom: 8px;
        }

        .account-content .form-group {
            margin-bottom: 20px;
        }

        table-status {
            width: 100%;
            border-collapse: collapse;
            /* Add other table styling as needed */
        }

        span {
            font-size: 12px;
            font-weight: 400;
            padding-top: 2px;
            color: #ffffff;
            font-family: 'Poppins', sans-serif;
        }

        /* Responsive styles */
        @media screen and (max-width: 768px) {
            .account-title h4 {
                font-size: 20px;
            }
        }

        @media screen and (max-width: 600px) {
            .account-title h4 {
                font-size: 18px;
            }

            .account-content {
                padding: 20px;
            }

            .form-group {
                margin-right: 0;
                margin-bottom: 10px;
            }

            .buttons-set {
                margin-top: 20px;
                text-align: center;
            }

            .buttons-set button {
                width: 100%;
            }
        }

        @media screen and (max-width: 768px) {

            .form-group input,
            .form-group select {
                width: 100%;
            }
        }

        @media screen and (max-width: 768px) {
            table-status {
                display: block;
                width: 100%;
            }

            .form-group input,
            .form-group select {
                width: 100%;
            }
        }

        @media screen and (min-width: 991px) {
            .form-inline.status {
                display: flex;
                align-items: baseline;
                justify-content: space-between;
            }
        }

        .close {
            opacity: 1 !important;
        }

        .custom-dropdown {
            position: relative;
            width: 100%;
        }

        .custom-dropdown input[type="text"] {
            background-color: white;
            color: black;
            /* Change text color to black */
        }

        .custom-dropdown input[type="text"]::placeholder {
            color: black;
            /* Change placeholder color to black */
        }

        .custom-dropdown input[type="text"]::placeholder {
            color: #333;
            /* Change placeholder color to #757575 */
        }

        .dropdown-content-1 {
            position: absolute;
            top: 100%;
            left: 0;
            display: none;
            width: 100%;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 1;
        }

        .dropdown-option {
            display: flex;
            align-items: center;
            padding: 8px 8px 8px 10px;
            /* Added top padding to move labels downward */
            cursor: pointer;
        }

        .dropdown-option label {
            margin-left: 10px;
            margin-right: 8px;
            margin-top: 10px;
            /* Add margin to the right of the label */
            flex: 0;
            /* Set flex to 0 so labels don't expand */
        }

        .dropdown-option:hover {
            background-color: #f4f4f4;
            /* Change to the desired grey color */
        }

        .label-large {
            font-size: 16px;
            /* Adjust as needed */
        }

        input[type="checkbox"] {
            width: 16px;
            height: 16px;
        }

        input[type="checkbox"]:checked+label {
            font-weight: bold;
        }

        .custom-dropdown.open .dropdown-content-1 {
            display: block;
        }

        .dropdown-button {
            position: absolute;
            top: 0;
            right: 0;
            height: 100%;
            width: 40px;
            border: none;
            background-color: transparent;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .fa-caret-down {
            font-size: 15px;
            /* Adjust the size of the icon */
        }

        .fa {
            font-family: "FontAwesome";
        }

        .other-option-input {
            margin-top: 10px;
        }

        .show-password-icon {
            cursor: pointer;
        }

        .valid {
            color: green !important;
        }

        .invalid {
            color: red !important;
        }

        .is-valid {
            border-color: green !important;
            box-shadow: 0 0 0 0.2rem rgba(0, 255, 0, 0.25) !important;
        }

        .is-invalid {
            border-color: red !important;
            box-shadow: 0 0 0 0.2rem rgba(255, 0, 0, 0.25) !important;
        }

        .password-input:hover+.password-checklist {
            opacity: 1;
            display: block;
            transition: translateZ(0);
        }

        .checklist-title {
            font-size: 15px;
            margin-bottom: 10px;
            /* font-family: 'Poppins', sans-serif; */
        }

        .checklist {
            list-style: none;
        }

        .list-item {
            padding-left: 30px;
            font-size: 12px;
            color: whitesmoke;
            letter-spacing: 1px;
            font-size: 400;

        }

        .list-item::before {
            content: '\f00d';
            font-family: FontAwesome;
            display: inline-block;
            margin: 8px 0;
            margin-left: -30px;
            width: 20px;
            font-size: 12px;
            letter-spacing: 1px;
        }

        .list-item.checked {
            opacity: 0.8;
        }

        .list-item.checked::before {
            content: '\f00c';
        }

        .password-checklist {
            display: none;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            position: fixed;
            color: #88211A;
            /* font-weight: bold; */
            border-radius: 8px;
            /* margin: 10px 10px; */
            padding: 1% 4%;
            background-color: white;
            /* box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; */
        }

        /*
        .password-input:hover+.password-checklist {
            display: block;
        } */
        /* .password-checklist {
            display: none;
        } */

        .password-input:focus+.password-checklist {
            display: block;
        }

        .list-item.checked {
            color: green;
        }

        .list-item:not(.checked) {
            color: lightgrey;
        }
    </style>
    <style>
        #register-button:disabled {
            background-color: gray;
            color: white;
            cursor: not-allowed;
        }

        #register-button:not(:disabled) {
            background-color: #88211a;
        }
    </style>

    <style>
        .custom-dropdown {
            position: relative;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content.open {
            display: block;
        }

        .dropdown-option {
            padding: 12px 16px;
            display: flex;
            align-items: center;
        }

        #other_qual_container {
            display: none;
        }

        /* Style for the "Other Qualification" input when displayed */
        #other_qual {
            border: none;
            /* Remove border for the text input */
            border-bottom: 2px solid #ccc;
            /* Add a green line styling to the bottom of the input */
            background-color: transparent;
            /* Transparent background */
            margin-top: 10px;
            font-weight: bold;
            padding: 0;
            /* Remove any padding */
            width: 100%;
            /* Make the input span the full width */
            text-align: left;
            /* Align text to the left side */
            outline: none;
            /* Remove the default focus outline */
            box-shadow: none;
            /* Remove box shadow */
            appearance: none;
            /* Remove default input styling (e.g., arrows in number input) */
            padding-right: 10px;
            /* Add some right padding to move the text to the right */
        }

        /* Style the placeholder text for the "Other Qualification" input */
        #other_qual::placeholder {
            text-align: left;
            /* Align placeholder text to the left */
            color: gray;
            /* Set the text color to gray */
        }

        /* Remove spin buttons in number input for certain browsers */
        #other_qual[type="number"]::-webkit-inner-spin-button,
        #other_qual[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            appearance: none;
            margin: 0;
        }

        /* ... (previous styles) */

        /* Remove hover effect for "Enter Other Qualification" input */
        #other_qual:hover {
            border-bottom: 2px solid #ccc;
            /* Change the color to the default */
        }

        /* Apply hover effect when clicking on "Enter Qualification" option */
        #otherOption:hover+label {
            background-color: #e0e0e0;
            /* Change the background color on hover */
        }

        /* ... (remaining styles) */
    </style>
    <style>
        /* Add your CSS styles here */
        .is-invalid {
            border: 1px solid red;
        }
    </style>


</head>

<body>
    <div class="main-wrapper page">
        <!--Begin header wrapper-->
        <?php
        include('header.php');
        ?>
        <!--End header wrapper-->
        <div class="content-wrapper">
            <div class='container'>
                <!--Begin content wrapper-->
                <div class="account-page register ">

                    <div class="title-write">
                        <h4 class="heading-regular text-uppercase">Membership Registration</h4>
                    </div>

                    
                    <form style="margin-top: 20px;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validate()">
                        <div style="margin-top:10px; font-size:15px">
                            <?php if (!empty($errorMsg)) { ?>
                                <div class="alert alert-danger alert-dismissible text-center">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <?php echo $errorMsg; ?>
                                </div>
                            <?php } ?>
                            <?php if (!empty($successMsg)) { ?>
                                <div class="alert alert-success  alert-dismissible text-center">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <?php echo $successMsg; ?>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="alert alert-info alert-dismissible text-center">
                            <p style="font-size:14px;"><B><u>PAYMENT NOTICE</u></B> : <b>$100</b> will be charged for <b>the SAANA membership</b> along with <b>additional amount</b> (if opted).</p>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-lg-12 required ">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email">
                                <span id="email-error" class="has-error" style="color:red"></span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 required">
                                <label for="pass">Password</label>
                                <input type="password" class="form-control" id="pass" name="pass" onkeyup="validatePassword()">
                                <i class="fa fa-eye show-password-icon" onclick="togglePasswordVisibility()" id="togglePassword"></i>
                                <span id="password-error" class="has-error" style="color:red"></span>
                                <div class="col-md-12 password-checklist">
                                    <h3 class="checklist-title"><b>YOUR PASSWORD MUST CONTAIN</b></h3>
                                    <ul class="checklist">
                                        <li class="list-item">At least 8 characters</li>
                                        <li class="list-item">At least one lowercase letter</li>
                                        <li class="list-item">At least one uppercase letter</li>
                                        <li class="list-item">At least one special character</li>
                                        <li class="list-item">At least one numerical character</li>
                                    </ul>
                                </div>
                            </div>


                            <div class="form-group col-md-6 required">
                                <label for="cpass">Confirm Password</label>
                                <input type="password" class="form-control" id="cpass" name="cpass">
                                <i class="fa fa-eye show-password-icon" onclick="confirmTogglePasswordVisibility()" id="confirmTogglePassword"></i>
                                <span id="confirm-password-error" class="has-error" style="color:red"></span>
                            </div>
                        </div>




                        <div class="form-row">
                            <div class="form-group col-md-6 required"><label for="fname">First Name</label><input type="text" class="form-control" id="fname" name="fname">
                                <span class="has-error" id="fname-error" style="color:red"></span>
                            </div>
                            <div class="form-group col-md-6"><label for="mname">Middle Name</label><input type="text" class="form-control" id="mname" name="mname">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 required"><label for="lname">Last Name</label><input type="text" class="form-control" id="last_name" name="lname">
                                <span class="has-error" id="lname-error" style="color:red"></span>
                            </div>
                            <div class="form-group col-md-6 "><label for="maiden">Maiden Name</label><input type="text" class="form-control" id="maiden" name="maiden"></div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6"><label for="nname">Nick Name</label><input type="text" class="form-control" id="nname" name="nname"></div>
                            <div class="form-group col-md-6 required"><label for="mobile">Mobile Number</label><input type="text" class="form-control" id="mobile" name="mobile">
                                <span class="has-error" id="mobile-error" style="color:red"></span>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 required"><label for="country">Country</label>
                                <select class="form-control" id="country" name="country" required>
                                    <option value="">Select Country</option>
                                    <option value="USA">USA</option>
                                    <option value="CANADA">CANADA</option>
                                </select>
                                <span class="has-error" id="country-error" style="color:red"></span>
                            </div>
                            <div class="form-group col-md-6 required"><label for="state">State</label>
                                <select class="form-control " id="state" name="state" required>
                                    <option value="">Select State</option>
                                </select>
                                <span class="has-error" id="state-error" style="color:red"></span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 required">
                                <label for="city">City</label>
                                <input type="text" class="form-control" id="city" name="city">
                                <span class="has-error" id="city-error" style="color:red"></span>
                            </div>
                            <div class="form-group col-md-6 required"><label for="code">Zip Code</label>
                                <input type="text" class="form-control" id="code" name="code">
                                <span class="has-error" id="code-error" style="color: red;"></span>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 required">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address">
                                <span class="has-error" id="address-error" style="color:red"></span>
                            </div>
                            <div class="form-group col-md-6 "><label for="addr_two">Address Line 2</label>
                                <input type="text" class="form-control" id="addr_two" name="addr_two">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6"><label for="work">Employer</label>
                                <input type="text" class="form-control" id="work" name="work">
                            </div>
                            <div class="form-group col-md-6 "><label for="title">Job Title</label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 required"><label for="year">Graduation Year</label>
                                <select class="form-control" id="year" name="year" required>
                                    <option value="">Select Year</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 required"><label for="dept">Department</label>
                                <select class="form-control" id="dept" name="dept" required>
                                    <option value="">Select Department</option>

                                    <option value="CSE">CSE</option>
                                    <option value="ECE">ECE</option>
                                    <option value="IT">IT</option>
                                    <option value="AIDS">AIDS</option>
                                    <option value="AIML">AIML</option>
                                    <option value="CSD">CSD</option>
                                    <option value="CSBS">CS-BS</option>
                                    <option value="CIC">CIC</option>
                                    <option value="EEE">EEE</option>
                                    <option value="MECH">MECH</option>
                                    <option value="CIVIL">CIVIL</option>
                                    <option value="MPIE">MPIE</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-6" id="comment_container">
                                <label for="comment">Additional Comments</label>
                                <input type="text" class="form-control" id="comment" name="comment">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="additional_qual">Additional Qualifications</label>
                                <div class="custom-dropdown">
                                    <input type="text" class="form-control" id="additional_qual" name="additional_qual" placeholder="Select Additional Qualifications" onclick="toggleDropdown()" readonly>

                                    <div class="dropdown-content-1">
                                        <div class="dropdown-option">
                                            <input type="checkbox" id="option1" name="option1" value="MS" onchange="updateInputField()">
                                            <label for="option1">MS</label>
                                        </div>
                                        <div class="dropdown-option">
                                            <input type="checkbox" id="option2" name="option2" value="MCA" onchange="updateInputField()">
                                            <label for="option2">MCA</label>
                                        </div>
                                        <div class="dropdown-option">
                                            <input type="checkbox" id="option4" name="option4" value="MBA" onchange="updateInputField()">
                                            <label for="option3">MBA</label>
                                        </div>
                                        <div class="dropdown-option">
                                            <input type="checkbox" id="option3" name="option3" value="PHD" onchange="updateInputField()">
                                            <label for="option3">PHD</label>
                                        </div>
                                        <!-- Inside the .dropdown-content div -->
                                        <div class="dropdown-option">
                                            <input type="checkbox" id="otherOption" name="otherOption" value="OTHER" onchange="handleOtherOption()">
                                            <label for="otherOption">OTHER</label>
                                        </div>
                                        <div class="dropdown-option" id="other-qual-option" style="display: none;">
                                            <input type="text" id="other_qual" name="other_qual" placeholder="Enter Other Qualification">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <style>
                            #clearAmountButton {
                                display: none;
                                border-radius: 5px;
                                padding: 10px;
                                margin-bottom: 10px;
                                font-size: 14px;
                                color: #88211A;
                                border: 1px solid #88211A;
                                background-color: #fff;
                                transition: 0.3s ease-in-out;
                            }

                            #clearAmountButton:hover {
                                background-color: #88211a;
                                color: #fff;
                            }
                        </style>
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label class="select-label" for="amount">Additional Amount: </label>

                                <div class="radio-container">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="amount" id="amount200" value="200">
                                        <label class="form-check-label" for="amount200">$200</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="amount" id="amount500" value="500">
                                        <label class="form-check-label" for="amount500">$500</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="amount" id="amount1000" value="1000">
                                        <label class="form-check-label" for="amount1000">$1000</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="amount" id="amount1500" value="1500">
                                        <label class="form-check-label" for="amount1500">$1500</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="amount" id="other" value="other">
                                        <label class="form-check-label" for="other">Other</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="amount" id="clear" value="0">
                                        <label class="form-check-label" id="clearAmountButton" for="clear">Clear</label>
                                    </div> 
                                    <!-- Text input for Other Amount (Initially Hidden) -->
                                    <div class="form-group col-lg-12 custom-amount" id="other-amount-input">
                                        <input type="number" class="form-control other-amount-input" name="other-amount" placeholder="Enter Other Amount">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="" style=" align-items: center; margin-left:15px; margin-bottom:10px">
                            <input type="checkbox" style="margin-right: 5px;" name="terms" id="terms" required>
                            <span style="font-size: 14px; color:black;">I Accept</span>
                            <a href="#" id="termsLink" style="color: blue; margin-left: 5px;">Terms & Conditions</a>
                        </div>


                        <div class="form-row" style="margin-left:15px">
                            <div class="g-recaptcha" data-sitekey="6LfWhEQnAAAAAL2WmqEPkmGFXXzuixrN_pjF1KcS" style="margin-bottom: 20px;"></div>
                            <div id="captcha-error"></div>
                        </div>

                        


                        <div class="buttons-set text-center pull-right" style="margin-bottom: 40px; margin-right: 15px">
                            <!-- Changed the class to center the content -->
                            <button type="submit" name="register" id="register-button" class="bnt bnt-theme text-regular text-uppercase" style="padding: 16px 55px; color: white; font-size: 16px; border: none;" disabled title="This button is disabled. Please fill in the required fields.">REGISTER</button>
                        </div>

                    </form>
                    <div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered custom-modal" role="document">
                            <div class="modal-content custom-modal-content">
                                <?php require 't&c.php'; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!--Begin footer wrapper-->
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

        <script>
            let selectedOptions = [];

            function toggleDropdown() {
                const dropdown = document.querySelector(".custom-dropdown");
                dropdown.classList.toggle("open");
            }

            function updateInputField() {
                const selectedOptionInputs = document.querySelectorAll(".dropdown-option input:checked");
                selectedOptions = Array.from(selectedOptionInputs).map(option => option.value);

                const inputField = document.getElementById("additional_qual");
                const otherQualInput = document.getElementById("other_qual");

                const otherQualValue = otherQualInput.value.trim();

                if (selectedOptions.includes("OTHER")) {
                    // If "OTHER" is selected, use the entered text and add the previously selected qualifications
                    const filteredOptions = selectedOptions.filter(option => option !== "OTHER");
                    if (otherQualValue !== "") {
                        inputField.value = otherQualValue + (filteredOptions.length > 0 ? ", " + filteredOptions.join(", ") : "");
                    } else {
                        inputField.value = filteredOptions.join(", ");
                    }
                } else {
                    // If other options are selected, display them along with the previously selected qualifications
                    inputField.value = selectedOptions.join(", ");
                }
            }

            function handleOtherOption() {
                const otherCheckbox = document.getElementById("otherOption");
                const otherQualOption = document.getElementById("other-qual-option");
                const inputField = document.getElementById("additional_qual");
                const otherQualInput = document.getElementById("other_qual");

                if (otherCheckbox.checked) {
                    // Show the "Other Qualification" text box
                    otherQualOption.style.display = "block";

                    // Focus on the "Other Qualification" input field
                    otherQualInput.focus();
                } else {
                    // Hide the "Other Qualification" text box
                    otherQualOption.style.display = "none";

                    // Clear the entered text in the "Other Qualification" input
                    otherQualInput.value = "";
                }

                // Update the input field value with the selected qualifications (excluding "OTHER")
                const selectedQualifications = selectedOptions.filter(option => option !== "OTHER");
                inputField.value = selectedQualifications.join(", ");
            }






            function openDropdown(event) {
                event.preventDefault(); // Prevent the default button click behavior
                const dropdown = document.querySelector(".custom-dropdown");
                dropdown.classList.toggle("open");
            }

            // Close the dropdown if the user clicks outside of it
            document.addEventListener("click", function(event) {
                const dropdown = document.querySelector(".custom-dropdown");
                if (!dropdown.contains(event.target)) {
                    dropdown.classList.remove("open");
                }
            });

            // Listen for input changes in the "Other Qualification" input
            const otherQualInput = document.getElementById("other_qual");
            otherQualInput.addEventListener("input", function() {
                // Update the selected qualifications when text is entered
                updateInputField();
            });
        </script>

        <script>
            const passwordInp = document.getElementById('pass');
            const checklistItems = document.querySelectorAll('.list-item');

            const validationRules = [
                /.{8,}/, // At least 8 characters
                /[a-z]/, // Lowercase letter
                /[A-Z]/, // Uppercase letter
                /[^A-Za-z0-9]/, // Special character
                /[0-9]/ // Numerical character
            ];

            function validatePassword() {
                const password = passwordInp.value;
                let allRequirementsMet = true;

                validationRules.forEach((rule, i) => {
                    if (i === 1 && rule.test(password)) {
                        checklistItems[i].classList.add('checked');
                    } else if (i === 2 && rule.test(password)) {
                        checklistItems[i].classList.add('checked');
                    } else if (i !== 1 && i !== 2 && rule.test(password)) {
                        checklistItems[i].classList.add('checked');
                    } else {
                        checklistItems[i].classList.remove('checked');
                        allRequirementsMet = false;
                    }
                });

                if (allRequirementsMet) {
                    document.querySelector('.password-checklist').style.display = 'none';
                } else {
                    document.querySelector('.password-checklist').style.display = 'block';
                }
            }
        </script>
        <script>
            const registerButton = document.getElementById('register-button');
            const requiredFields = ['email', 'pass', 'cpass', 'fname', 'last_name', 'mobile', 'country', 'state', 'city', 'code', 'address', 'year', 'dept', 'terms']
            requiredFields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                field.addEventListener('input', () => {
                    const allFieldsFilled = requiredFields.every(id => {
                        const input = document.getElementById(id);
                        return input.value.trim() !== '';
                    });
                    registerButton.disabled = !allFieldsFilled;

                    // Show/hide the title attribute as a tooltip
                    if (registerButton.disabled) {
                        registerButton.removeAttribute('title');
                    } else {
                        registerButton.setAttribute('title', 'This button is disabled. Please fill in the required fields.');
                    }
                });
            });
        </script>

        <script>
            // JavaScript to toggle the visibility of the Other Amount input
            const otherRadioButton = document.getElementById('other');
            const otherAmountInput = document.getElementById('other-amount-input');
            const amountRadios = document.querySelectorAll('input[name="amount"]');
            const clearAmountButton = document.getElementById('clearAmountButton');
            // document.getElementById("clearAmountButton").addEventListener("click", function() {
            //     document.getElementById("amount").value = "";
            // });

            // Function to hide the Other Amount input
            function hideOtherAmountInput() {
                otherAmountInput.style.display = 'none';
            }

            // Function to show the Other Amount input
            function showOtherAmountInput() {
                otherAmountInput.style.display = 'block';
            }

            // Function to clear the selected amount
            function clearSelectedAmount() {
                // Uncheck all amount radios
                amountRadios.forEach((radio) => {
                    radio.checked = false;
                });

                // console the selected amount

                // Uncheck the "Other" radio button
                otherRadioButton.checked = false;

                // Hide the Other Amount input
                hideOtherAmountInput();

                // Hide the Clear Selection button
                clearAmountButton.style.display = 'none';
            }

            hideOtherAmountInput(); // Initially hide the input

            // Listen for changes on the amount radios to hide the Other Amount input
            amountRadios.forEach((radio) => {
                radio.addEventListener('change', () => {
                    if (otherRadioButton.checked) {
                        showOtherAmountInput();
                    } else {
                        hideOtherAmountInput();
                    }
                    // Show the Clear Selection button when any amount is selected
                    clearAmountButton.style.display = 'block';
                });
            });

            // Listen for changes on the "Other" radio button to show/hide the Other Amount input
            otherRadioButton.addEventListener('change', () => {
                if (otherRadioButton.checked) {
                    showOtherAmountInput();
                } else {
                    hideOtherAmountInput();
                }

                // Show the Clear Selection button when "Other" is selected
                clearAmountButton.style.display = 'block';
            });

            // Listen for click on the clear button to clear the selected amount
            clearAmountButton.addEventListener('click', clearSelectedAmount);
        </script>

        <script>
            // Function to format the mobile number input
            function formatMobile() {
                const mobileInput = document.getElementById("mobile");
                let rawNumber = mobileInput.value.replace(/\D/g, ""); // Remove non-numeric characters

                if (rawNumber.length > 0) {
                    // Remove leading "1"
                    if (rawNumber.startsWith("1")) {
                        rawNumber = rawNumber.substring(1);
                    }

                    // Ensure rawNumber is at most 10 digits
                    rawNumber = rawNumber.substring(0, 10);

                    let formattedNumber = "";

                    if (rawNumber.length > 0) {
                        formattedNumber = `+1 (${rawNumber.slice(0, 3)}`;

                        if (rawNumber.length > 3) {
                            formattedNumber += `) ${rawNumber.slice(3, 6)}`;

                            if (rawNumber.length > 6) {
                                formattedNumber += `-${rawNumber.slice(6)}`;
                            }
                        }
                    }

                    mobileInput.value = formattedNumber;
                } else {
                    // Clear both input and visual format
                    mobileInput.value = "";
                }
            }

            // Add input event listener to format the mobile number as it's being typed
            const mobileInput = document.getElementById("mobile");
            mobileInput.addEventListener("input", formatMobile);

            // Add input event listener to handle backspace key
            mobileInput.addEventListener("keydown", function(e) {
                if (e.key === "Backspace") {
                    formatMobile();
                }
            });

            // Function to clear both format and content
            function clearMobileInput() {
                mobileInput.value = ""; // Clear the input field
                formatMobile();
            }

            // Function to validate the mobile number
            function validateMobile() {
                const rawMobileNumber = mobileInput.value.replace(/\D/g, "");

                if (rawMobileNumber.length !== 10) {
                    const mobileError = document.getElementById('mobile-error');
                    mobileError.textContent = 'Mobile Number should be exactly 10 digits';
                    mobileInput.classList.remove('is-valid');
                    mobileInput.classList.add('is-invalid');
                    return false;
                } else {
                    const mobileError = document.getElementById('mobile-error');
                    mobileError.textContent = ''; // Clear the error message
                    mobileInput.classList.remove('is-invalid');
                    mobileInput.classList.add('is-valid');
                    return true;
                }
            }

            // Function to validate the form and submit
        </script>

        <script>
            const emailInput = document.getElementById('email');
            const emailError = document.getElementById('email-error');
            const passwordInput = document.getElementById('pass');
            const confirmPasswordInput = document.getElementById('cpass');
            // const passwordError = document.getElementById('password-error');
            const confirmPasswordError = document.getElementById('confirm-password-error');
            const firstNameInput = document.getElementById('fname');
            const lastNameInput = document.getElementById('last_name');
            const cityInput = document.getElementById('city');
            const addressInput = document.getElementById('address');
            const firstNameError = document.getElementById('fname-error');
            const lastNameError = document.getElementById('lname-error');
            const cityError = document.getElementById('city-error');
            const addressError = document.getElementById('address-error');
            const mobileInput1 = document.getElementById('mobile');
            const mobileError1 = document.getElementById('mobile-error');
            // Function to validate names using the provided regex pattern
            function validateName(nameInput, nameError, nameRegex, minLength) {
                const name = nameInput.value.trim();
                if (!name) {
                    nameError.textContent = ''; // Clear error message when input is empty
                    nameInput.classList.remove('is-invalid', 'is-valid');
                } else if (!name.match(nameRegex)) {
                    nameError.textContent = 'Invalid name. Please use letters and spaces only.';
                    registerButton.disabled = true;
                    nameInput.classList.remove('is-valid');
                    nameInput.classList.add('is-invalid');
                    disableOtherInputs();
                } else if (name.length < minLength) {
                    nameError.textContent = `Field must be at least ${minLength} characters.`;
                    registerButton.disabled = true;
                    nameInput.classList.remove('is-valid');
                    nameInput.classList.add('is-invalid');
                    disableOtherInputs();
                } else {
                    nameError.textContent = '';
                    nameInput.classList.remove('is-invalid');
                    nameInput.classList.add('is-valid');
                    enableOtherInputs();
                }
            }

            // Function to validate city and address using the provided regex pattern
            function validateCityAddress(input, error, regex, minLength) {
                const value = input.value.trim();
                if (!value) {
                    error.textContent = ''; // Clear error message when input is empty
                    input.classList.remove('is-invalid', 'is-valid');
                } else if (value.length < minLength) {
                    error.textContent = `Field must be at least ${minLength} characters.`;
                    registerButton.disabled = true;
                    input.classList.remove('is-valid');
                    input.classList.add('is-invalid');
                    disableOtherInputs();
                } else if (!value.match(regex)) {
                    error.textContent = 'Invalid input. Please check your input format.';
                    registerButton.disabled = true;
                    input.classList.remove('is-valid');
                    input.classList.add('is-invalid');
                    disableOtherInputs();
                } else {
                    error.textContent = '';
                    input.classList.remove('is-invalid');
                    input.classList.add('is-valid');
                    enableOtherInputs();
                }
            }

            // Email input validation
            emailInput.addEventListener('input', () => {
                const email = emailInput.value.trim();
                if (!email) {
                    emailError.textContent = ''; // Clear error message when input is empty
                    emailInput.classList.remove('is-invalid', 'is-valid');
                } else if (!validateEmail(email)) {
                    emailError.textContent = 'Please enter a valid email address';
                    registerButton.disabled = true;
                    emailInput.classList.remove('is-valid');
                    emailInput.classList.add('is-invalid');
                    disableOtherInputs();
                } else {
                    emailError.textContent = '';
                    emailInput.classList.remove('is-invalid');
                    emailInput.classList.add('is-valid');
                    enableOtherInputs();
                }
            });

            // Password input validation
            // passwordInput.addEventListener('input', () => {
            //     const password = passwordInput.value.trim();
            //     if (!password) {
            //         passwordError.textContent = ''; // Clear error message when input is empty
            //         passwordInput.classList.remove('is-invalid', 'is-valid');
            //     } else if (password.length < 8) {
            //         passwordError.textContent = 'Password must be at least 8 characters';
            //         passwordInput.classList.remove('is-valid');
            //         passwordInput.classList.add('is-invalid');
            //     } else {
            //         passwordError.textContent = '';
            //         passwordInput.classList.remove('is-invalid');
            //         passwordInput.classList.add('is-valid');
            //     }
            // });

            // Confirm password input validation
            confirmPasswordInput.addEventListener('input', () => {
                const password = passwordInput.value.trim();
                const confirmPassword = confirmPasswordInput.value.trim();
                if (!confirmPassword) {
                    confirmPasswordError.textContent = ''; // Clear error message when input is empty
                    confirmPasswordInput.classList.remove('is-invalid', 'is-valid');
                } else if (confirmPassword !== password) {
                    confirmPasswordError.textContent = 'Passwords do not match';
                    registerButton.disabled = true;
                    confirmPasswordInput.classList.remove('is-valid');
                    confirmPasswordInput.classList.add('is-invalid');
                } else {
                    confirmPasswordError.textContent = '';
                    confirmPasswordInput.classList.remove('is-invalid');
                    confirmPasswordInput.classList.add('is-valid');
                }
            });

            // First name input validation
            firstNameInput.addEventListener('input', () => {
                const nameRegex = /^[A-Za-z\s]+$/;
                minLength = 3;
                validateName(firstNameInput, firstNameError, nameRegex, minLength);
            });

            // Last name input validation
            lastNameInput.addEventListener('input', () => {
                const nameRegex = /^[A-Za-z\s]+$/;
                minLength = 3;
                validateName(lastNameInput, lastNameError, nameRegex, minLength);
            });

            // City input validation
            cityInput.addEventListener('input', () => {
                const cityRegex = /^[A-Za-z\s]+$/;
                const minLength = 3;
                validateCityAddress(cityInput, cityError, cityRegex, minLength);
            });

            // Address input validation
            addressInput.addEventListener('input', () => {
                const addressRegex = /^[A-Za-z0-9\s,.'-]+$/;
                const minLength = 10;
                validateCityAddress(addressInput, addressError, addressRegex, minLength);
            });

            // Mobile number input validation
            mobileInput1.addEventListener('input', () => {
                let mobile = mobileInput1.value.trim();
                mobile = mobile.replace(/\D/g, ''); // Remove all non-numeric characters
                mobile = mobile.replace(/^1/, ''); // Remove leading "1"
                if (mobile.length > 10) {
                    mobile = mobile.substring(mobile.length - 10); // Only keep the last 10 digits
                }
                if (!mobile) {
                    mobileError1.textContent = ''; // Clear error message when input is empty
                    mobileInput1.classList.remove('is-invalid', 'is-valid');
                } else if (mobile.length < 10 || mobile.length > 10) {
                    mobileError1.textContent = 'Mobile Number should be exactly 10 digits';
                    mobileInput1.classList.remove('is-valid');
                    mobileInput1.classList.add('is-invalid');
                    registerButton.disabled = true;
                } else {
                    mobileError1.textContent = '';
                    mobileInput1.classList.remove('is-invalid');
                    mobileInput1.classList.add('is-valid');
                }
            });

            // Email validation function
            function validateEmail(email) {
                const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

                if (!emailRegex.test(email)) {
                    return false;
                }

                const disposableDomains = ["example.com", "test.com"];
                const domain = email.split('@')[1];

                if (disposableDomains.includes(domain)) {
                    return false;
                }

                return true;
            }

            // function disableOtherInputs() {
            //     otherInputs.forEach(input => {
            //         input.setAttribute('disabled', 'true');
            //     });
            // }

            // function enableOtherInputs() {
            //     otherInputs.forEach(input => {
            //         input.removeAttribute('disabled');
            //     });
            // }
        </script>



        <script>
            // Function to enable or disable the zip code input based on the selected country
            function toggleZipCodeInput() {
                const countrySelect = document.getElementById("country");
                const zipCodeInput = document.getElementById("code");

                if (countrySelect.value === "USA") {
                    zipCodeInput.disabled = false;
                    zipCodeInput.setAttribute("maxlength", "5");
                    zipCodeInput.pattern = "\\d{5}"; // Allow only digits for USA
                    zipCodeInput.value = ""; // Clear zip code and format
                    zipCodeInput.style.borderColor = ""; // Remove red border
                    displayErrorMessage("");
                } else if (countrySelect.value === "CANADA") {
                    zipCodeInput.disabled = false;
                    zipCodeInput.setAttribute("maxlength", "7"); // Update maxlength to 7 (including spaces)
                    zipCodeInput.pattern = "^[A-Z]\\d[A-Z] \\d[A-Z]\\d$"; // Allow letters and digits for Canada in the format "A1A 1A1"
                    zipCodeInput.value = ""; // Clear zip code and format
                    zipCodeInput.style.borderColor = ""; // Remove red border
                    displayErrorMessage("");
                } else {
                    zipCodeInput.disabled = true;
                    zipCodeInput.removeAttribute("maxlength");
                    zipCodeInput.removeAttribute("pattern");
                    zipCodeInput.value = ""; // Clear zip code when no country is selected
                    zipCodeInput.style.borderColor = ""; // Remove red border
                    displayErrorMessage("");
                }
            }

            // Function to display an error message below the input field
            function displayErrorMessage(message) {
                const zipCodeError = document.getElementById("code-error");
                zipCodeError.textContent = message;
            }

            // Function to validate and format zip codes
            function checkZipCodeValidity() {
                const countrySelect = document.getElementById("country");
                const zipCodeInput = document.getElementById("code");

                if (countrySelect.value === "USA") {
                    const zipCode = zipCodeInput.value.trim();
                    const regex = /^\d+$/;
                    if (!zipCode) {
                        zipCodeInput.style.borderColor = ""; // Remove red border
                        displayErrorMessage("");
                    } else if (!regex.test(zipCode)) {
                        displayErrorMessage('US zip code should contain only numbers.');
                        zipCodeInput.style.borderColor = 'red'; // Set border color to red
                        registerButton.disabled = true;
                    } else {
                        zipCodeInput.style.borderColor = ""; // Remove red border
                        displayErrorMessage("");
                    }
                } else if (countrySelect.value === "CANADA") {
                    let zipCode = zipCodeInput.value.trim();
                    const regex = /^[A-Z\d\s]*$/; // Allow letters, digits, and spaces for Canada
                    zipCode = zipCode.toUpperCase(); // Convert to uppercase
                    zipCode = zipCode.replace(/\s/g, ""); // Remove spaces from the input
                    // Format the input with a space after the third character if needed
                    if (zipCode.length >= 3) {
                        zipCode = zipCode.slice(0, 3) + " " + zipCode.slice(3);
                    }
                    zipCodeInput.value = zipCode; // Update the input value
                    if (!zipCode) {
                        zipCodeInput.style.borderColor = ""; // Remove red border
                        displayErrorMessage("");
                    } else if (!regex.test(zipCode)) {
                        displayErrorMessage("Canada zip code must follow the pattern 'A1A 1A1' (e.g., K1A 0T6).");
                        zipCodeInput.style.borderColor = "red"; // Set border color to red
                        registerButton.disabled = true;
                    } else {
                        zipCodeInput.style.borderColor = ""; // Remove red border
                        displayErrorMessage(""); // Clear error message when pattern is correct
                    }
                } else {
                    zipCodeInput.style.borderColor = ""; // Remove red border
                    displayErrorMessage("");
                }
            }

            // Add input event listener to the zip code input
            const zipCodeInput = document.getElementById("code");
            // ... (previous code)

            // Add input event listener to handle backspace key
            zipCodeInput.addEventListener("keydown", function(e) {
                if (e.key === "Backspace" && zipCodeInput.selectionStart === 3) {
                    // Handle backspace key to clear the third character
                    const currentPosition = zipCodeInput.selectionStart;
                    zipCodeInput.value = zipCodeInput.value.substring(0, currentPosition - 1) + zipCodeInput.value.substring(currentPosition);
                    zipCodeInput.setSelectionRange(currentPosition - 1, currentPosition - 1);
                } else if (e.key === "Backspace" && zipCodeInput.selectionStart === 4) {
                    // Handle backspace key to clear the space between the third and fourth character
                    const currentPosition = zipCodeInput.selectionStart;
                    zipCodeInput.value = zipCodeInput.value.substring(0, 3) + zipCodeInput.value.substring(4);
                    zipCodeInput.setSelectionRange(currentPosition - 1, currentPosition - 1);
                } else if (e.key === "Backspace" && zipCodeInput.selectionStart <= 3 && zipCodeInput.selectionEnd >= zipCodeInput.selectionStart) {
                    // Handle backspace key to clear one character or space at a time up to the third character
                    const currentPosition = zipCodeInput.selectionStart;
                    zipCodeInput.value = zipCodeInput.value.substring(0, currentPosition - 1) + zipCodeInput.value.substring(currentPosition);
                    zipCodeInput.setSelectionRange(currentPosition - 1, currentPosition - 1);
                }
                checkZipCodeValidity();
            });



            // ... (rest of the code)

            // Add input event listener to handle backspace key
            zipCodeInput.addEventListener("keydown", function(e) {
                if (e.key === "Backspace" && zipCodeInput.selectionStart === 4) {
                    // Handle backspace key to clear the space between the third and fourth character
                    const currentPosition = zipCodeInput.selectionStart;
                    zipCodeInput.value = zipCodeInput.value.substring(0, 3) + zipCodeInput.value.substring(4);
                    zipCodeInput.setSelectionRange(currentPosition - 1, currentPosition - 1);
                    checkZipCodeValidity();
                }
            });

            // Add change event listener to the country select input
            const countrySelect = document.getElementById("country");
            countrySelect.addEventListener("change", toggleZipCodeInput);

            // Call the function initially to set the initial state
            toggleZipCodeInput();
        </script>

        <script>
            const selectYear = document.getElementById('year');
            const currentYear = new Date().getFullYear();

            for (let year = 1980; year <= currentYear; year++) {
                const option = document.createElement('option');
                option.value = year;
                option.textContent = year;
                selectYear.appendChild(option);
            }
        </script>



        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script> -->
        <script>
            // States for the USA and Canada
            const usaStates = [
                "Alabama", "Alaska", "Arizona", "Arkansas", "California", "Colorado", "Connecticut", "Delaware", "Florida",
                "Georgia", "Hawaii", "Idaho", "Illinois", "Indiana", "Iowa", "Kansas", "Kentucky", "Louisiana", "Maine",
                "Maryland", "Massachusetts", "Michigan", "Minnesota", "Mississippi", "Missouri", "Montana", "Nebraska",
                "Nevada", "New Hampshire", "New Jersey", "New Mexico", "New York", "North Carolina", "North Dakota", "Ohio",
                "Oklahoma", "Oregon", "Pennsylvania", "Rhode Island", "South Carolina", "South Dakota", "Tennessee", "Texas",
                "Utah", "Vermont", "Virginia", "Washington", "Washington D.C.", "West Virginia", "Wisconsin", "Wyoming"
            ];

            const canadaStates = [
                "Alberta", "British Columbia", "Manitoba", "New Brunswick", "Newfoundland and Labrador", "Nova Scotia",
                "Ontario", "Prince Edward Island", "Quebec", "Saskatchewan"
            ];

            // Function to populate the "state" dropdown based on the selected country
            function populateStateDropdown(country) {
                const stateDropdown = document.getElementById("state");
                stateDropdown.innerHTML = '<option value="">Select a State</option>';

                // Select the appropriate array of states based on the selected country
                const countryStates = (country === 'USA') ? usaStates : (country === 'CANADA') ? canadaStates : [];

                // Populate the "state" dropdown with options
                countryStates.forEach(state => {
                    const option = document.createElement("option");
                    option.value = state;
                    option.textContent = state;
                    stateDropdown.appendChild(option);
                });

                // $(stateDropdown).select2();
            }

            // Call the function to populate the "state" dropdown when the country selection changes
            const countryDropdown = document.getElementById("country");
            countryDropdown.addEventListener("change", function() {
                const selectedCountry = this.value;
                populateStateDropdown(selectedCountry);
            });

            // Call the function to populate the "state" dropdown on page load
            const selectedCountry = document.getElementById("country").value;
            populateStateDropdown(selectedCountry);
        </script>

        <script>
            $(document).ready(function() {
                $('#termsLink').click(function() {
                    $('#termsModal').modal('show');
                });
            });
        </script>

        <script>
            function togglePasswordVisibility() {
                const passwordInput = document.getElementById("pass");
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

            function confirmTogglePasswordVisibility() {
                const passwordInput = document.getElementById("cpass");
                const toggleIcon = document.getElementById("confirmTogglePassword");

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

</body>

</html>