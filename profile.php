<?php
include('session_management.php');
$editMode = false;
$errorMsgPass = "";
$errorMsgDash = "";
$errorMsgProfile = "";
$successMsg = "";
$memberFound = '';
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
if (isset($_SESSION['username'])) {
    include('connect.php');
    $username = $_SESSION['username'];
    $query = "SELECT * FROM all_members WHERE email_id = ?"; // Corrected the column name to "username"
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(1, $username);
    $stmt->execute();
    // Bind the $username value here
    $row = $stmt->fetch();
    $data = $row;
    if (isset($_GET['editMode'])) {
        $editMode = true;
    }



    function isIdDisabled($editMode)
    {
        // Add your logic here to determine whether the field should be disabled or not
        // For example, check user permissions or any other relevant conditions
        // For now, we will simply return the opposite value of $editMode as an example
        return !$editMode;
    }
    $query1 = "SELECT * FROM all_members WHERE dept = ? AND year_of_graduation = ?"; // Corrected the column name to "username"
    $stmt1 = $pdo->prepare($query1); 
    $stmt1->bindParam(1, $data['dept']);
    $stmt1->bindParam(2, $data['year_of_graduation']);
    $stmt1->execute();
    // Bind the $username value here
    $row1 = $stmt1->fetchAll();
    $members = $row1;
    if (isset($_POST['Pass_Change'])) {
        $query3 = "SELECT * FROM login WHERE username = ?";
        $stmt3 = $pdo->prepare($query3);
        $stmt3->bindParam(1, $username);
        $stmt3->execute();
        $row3 = $stmt3->fetch();
        $data3 = $row3;
        $oldpass = $_POST['current_password'];
        $newpass = $_POST['new_password'];
        $confirmpass = $_POST['con_new_password'];



        if ($oldpass == $data3['password']) {
            if (strlen($newpass) < 8) {
                $errorMsgPass = "Password must be at least 8 characters long";
            } else {
                if ($oldpass == $newpass) {
                    $errorMsgPass = "New Password cannot be same as Old Password";
                } elseif ($newpass == $confirmpass) {
                    $query2 = "UPDATE login SET password = ? WHERE username = ?";
                    $stmt2 = $pdo->prepare($query2);
                    $stmt2->bindParam(1, $newpass);
                    $stmt2->bindParam(2, $username);
                    $stmt2->execute();
                    $successMsg = "Password Changed Successfully";
                } else {
                    $errorMsgPass = "New Password and Confirm Password do not match";
                }
            }
        } else {
            $errorMsgPass = "Old Password is incorrect";
        }
    }

    $usaStates = [
        "Alabama", "Alaska", "Arizona", "Arkansas", "California", "Colorado", "Connecticut", "Delaware", "Florida",
        "Georgia", "Hawaii", "Idaho", "Illinois", "Indiana", "Iowa", "Kansas", "Kentucky", "Louisiana", "Maine",
        "Maryland", "Massachusetts", "Michigan", "Minnesota", "Mississippi", "Missouri", "Montana", "Nebraska",
        "Nevada", "New Hampshire", "New Jersey", "New Mexico", "New York", "North Carolina", "North Dakota", "Ohio",
        "Oklahoma", "Oregon", "Pennsylvania", "Rhode Island", "South Carolina", "South Dakota", "Tennessee", "Texas",
        "Utah", "Vermont", "Virginia", "Washington", "West Virginia", "Wisconsin", "Wyoming"
    ];

    $canadaStates = [
        "Alberta", "British Columbia", "Manitoba", "New Brunswick", "Newfoundland and Labrador", "Nova Scotia",
        "Ontario", "Prince Edward Island", "Quebec", "Saskatchewan"
    ];

    // Generate the state options for the USA and Canada
    $selectedState = $data['state'];
    $selectedCountry = strtoupper($data['country']);
    function generateStateOptions($states, $selectedState)
    {
        $options = '';
        foreach ($states as $state) {
            $selected = (strtoupper($selectedState) === strtoupper($state)) ? 'selected' : '';
            $options .= '<option value="' . $state . '" ' . $selected . '>' . $state . '</option>';
        }
        return $options;
    }

    $selectedYear = $data['year_of_graduation'];
    $countQueryMem = "SELECT COUNT(email_id) FROM all_members ";
    $countQueryState = "SELECT COUNT(email_id) FROM all_members WHERE state=? ";
    $countQueryClass = "SELECT COUNT(email_id) FROM all_members WHERE year_of_graduation=? AND dept=? ";
    $countQueryDept = "SELECT COUNT(email_id) FROM all_members WHERE dept=?";
    $stmtCountMem = $pdo->prepare($countQueryMem);
    $stmtCountMem->execute();
    $stmtCountState = $pdo->prepare($countQueryState);
    $stmtCountState->bindParam(1, $data['state']);
    $stmtCountState->execute();
    $stmtCountClass = $pdo->prepare($countQueryClass);
    $stmtCountClass->bindParam(1, $data['year_of_graduation']);
    $stmtCountClass->bindParam(2, $data['dept']);
    $stmtCountClass->execute();
    $stmtCountDept = $pdo->prepare($countQueryDept);
    $stmtCountDept->bindParam(1, $data['dept']);
    $stmtCountDept->execute();
    $countMem = $stmtCountMem->fetchColumn();
    $countState = $stmtCountState->fetchColumn();
    $countClass = $stmtCountClass->fetchColumn();
    $countDept = $stmtCountDept->fetchColumn();
    $totalState = "SELECT COUNT(state) FROM all_members;";
    $stmtTotalState = $pdo->prepare($totalState);
    $stmtTotalState->execute();
    $totalStateCount = $stmtTotalState->fetchColumn();

    $stateMembersQuery = "SELECT * FROM all_members WHERE state = :state";
    $stmtStateMembers = $pdo->prepare($stateMembersQuery);
    $stmtStateMembers->bindValue(':state', $data['state']);
    $stmtStateMembers->execute();
    $stateMembers = $stmtStateMembers->fetchAll();

    $classMembersQuery = "SELECT * FROM all_members WHERE year_of_graduation = :year_of_graduation AND dept = :dept";
    $stmtClassMembers = $pdo->prepare($classMembersQuery);
    $stmtClassMembers->bindValue(':year_of_graduation', $data['year_of_graduation']);
    $stmtClassMembers->bindValue(':dept', $data['dept']);
    $stmtClassMembers->execute();
    $classMembers = $stmtClassMembers->fetchAll();

    $deptMembersQuery = "SELECT * FROM all_members WHERE dept = :dept";
    $stmtDeptMembers = $pdo->prepare($deptMembersQuery);
    $stmtDeptMembers->bindValue(':dept', $data['dept']);
    $stmtDeptMembers->execute();
    $deptMembers = $stmtDeptMembers->fetchAll();


    $progressMem = round(($countMem / $countMem) * 100);
    $progressState = round(($countState / $countMem) * 100);
    $progressClass = round(($countClass / $countMem) * 100);
    $progressDept = round(($countDept / $countMem) * 100);

    if (isset($_POST['status'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $year_of_graduation = $_POST['year_of_graduation'];
        $dept = $_POST['dept'];

        // Initialize the $where variable to "1" (a true condition) to start building the SQL query
        $where = "1";

        // Build the SQL query dynamically based on the submitted form data
        $params = array(); // Store the parameters for the prepared statement
        $placeholders = array(); // Store the placeholders for the prepared statement

        if (!empty($first_name)) {
            $where .= " AND first_name LIKE ?";
            $params[] = '%' . $first_name . '%';
            $placeholders[] = 'first_name';
        }

        if (!empty($last_name)) {
            $where .= " AND last_name LIKE ?";
            $params[] = '%' . $last_name . '%';
            $placeholders[] = 'last_name';
        }

        if (!empty($year_of_graduation)) {
            $where .= " AND year_of_graduation = ?";
            $params[] = $year_of_graduation;
            $placeholders[] = 'year_of_graduation';
        }

        if (!empty($dept)) {
            $where .= " AND dept = ?";
            $params[] = $dept;
            $placeholders[] = 'dept';
        }

        // Check if at least one field is filled
        if (empty($first_name) && empty($last_name) && empty($year_of_graduation) && empty($dept)) {
            $errorMsgDash = 'Please fill at least one field';
        } else {
            // Query to check if the member exists in the all_members table

            $sql = "SELECT * FROM all_members WHERE $where";
            $stmt = $pdo->prepare($sql);
            // Bind parameters to the prepared statement
            for ($i = 0; $i < count($params); $i++) {
                $stmt->bindParam($i + 1, $params[$i], PDO::PARAM_STR);
            }
            $stmt->execute();

            // If the member exists, fetch their details
            if ($stmt->rowCount() > 0) {
                // Member found, you can fetch their details here

                $memberFound = true;


                // Fetch the data and do something with it


            } else {
                $memberFound = false;
                $errorMsgDash = 'No member found';
                // header("location:profile.php?mode=status");
            }
        }
    }
    $currentURL = $_SERVER['REQUEST_URI'];
    $currentURL = explode('?', $currentURL);
}
// Check if the session has been inactive for 15 minutes

// Your other PHP code here...

// End of the PHP script
?>

<!DOCTYPE head>
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<style>
    /* Custom styles for the profile page */
    /* Custom styles for the profile page */
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

    /* Custom styles for the status bars in the dashboard section */
    .tile-progress {
        background-color: #303641;
        color: #fff;
        background: #00a65b;
    }

    .tile-progress .tile-header {
        padding: 15px 20px;
        padding-bottom: 40px;
    }

    .tile-progress .tile-progressbar {
        height: 2px;
        background: rgba(0, 0, 0, 0.18);
        margin: 0;
    }

    .tile-progress .tile-progressbar span {
        display: block;
        background: #ffffff;
        width: 0;
        height: 100%;
        -webkit-transition: all 1.5s cubic-bezier(0.230, 1.000, 0.320, 1.000);
        -moz-transition: all 1.5s cubic-bezier(0.230, 1.000, 0.320, 1.000);
        -o-transition: all 1.5s cubic-bezier(0.230, 1.000, 0.320, 1.000);
        transition: all 1.5s cubic-bezier(0.230, 1.000, 0.320, 1.000);
    }

    .tile-progress .tile-footer {
        padding: 20px;
        text-align: right;
        background: rgba(0, 0, 0, 0.1);
        border-radius: 0 0 3px 3px;
    }

    .tab-pane.dashboard-content.row {
        margin-top: 15px;
    }

    /* Initial styles for non-responsive layout */
    .filterable {
        margin-top: 15px;
    }

    .filterable .panel-heading .pull-right {
        margin-top: -20px;
    }

    .filterable .filters input[disabled] {
        background-color: transparent;
        border: none;
        cursor: auto;
        box-shadow: none;
        padding: 0;
        height: auto;
    }

    .filterable .filters input[disabled]::-webkit-input-placeholder {
        color: #333;
    }

    .filterable .filters input[disabled]::-moz-placeholder {
        color: #333;
    }

    .filterable .filters input[disabled]:-ms-input-placeholder {
        color: #333;
    }

    .panel-primary.filterable .panel-heading {
        background-color: #88211A;
        border-color: #88211A;
        color: #fff;
    }

    .panel-primary.filterable .panel-heading h3.panel-title {
        color: #fff;
    }

    .panel-primary.filterable .btn-filter {
        background-color: #88211A;
        border-color: #88211A;
        color: #fff;
    }

    .panel-primary.filterable .btn-filter:hover {
        background-color: #702017;
        border-color: #702017;
        color: #fff;
    }

    table tbody tr:nth-child(odd) {
        background-color: #f2f2f2;
        /* Grey color for odd rows */
    }

    .table tbody tr:nth-child(even) {
        background-color: #ffffff;
        /* White color for even rows */
    }

    /* Media queries for responsiveness */

    /* Mobile devices up to 767px */
    @media (max-width: 767px) {
        .filterable {
            margin-top: 10px;
        }

        .filterable .panel-heading .pull-right {
            margin-top: -10px !important;
        }
    }

    /* Tablets and small screens from 768px to 991px */
    @media (min-width: 768px) and (max-width: 991px) {
        .filterable {
            margin-top: 20px;
        }

        .filterable .panel-heading .pull-right {
            margin-top: -15px;
        }
    }

    /* Large screens from 992px to 1200px */
    @media (min-width: 992px) and (max-width: 1200px) {
        /* Add any additional styles for this screen size if needed */
    }

    /* Larger screens from 1201px and above */
    @media (min-width: 1201px) {
        /* Add any additional styles for this screen size if needed */
    }


    /* Custom styles for the navigation tabs */
    .nav-profile {
        margin-top: 40px;
    }

    .nav-tabs {
        border-bottom: none;
        margin-bottom: 20px;
        display: flex;
        justify-content: center;
    }

    .nav-tabs .nav-item .nav-link {
        border: none;
        background-color: transparent;
        color: #333333;
        font-weight: bold;
        padding: 15px 20px;
        border-radius: 0;
        white-space: nowrap;
    }

    .nav-tabs .nav-item .nav-link.active {
        background-color: #88211A;
        color: #ffffff;
    }

    /* Custom styles for buttons */
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
    .img-account-profile {
        height: 10rem;
    }

    .rounded-circle {
        border-radius: 70% !important;
    }

    /* Custom styles for typography */
    .small {
        font-size: 0.875rem;
    }

    .font-italic {
        font-style: italic;
    }

    .mb-4 {
        margin-bottom: 1.5rem;
    }

    .membership-status {
        display: inline-block;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin-right: 5px;
    }

    .active-mem {
        background-color: #66BB6A;
        /* Green color for active status */
    }

    .inactive-mem {
        background-color: #FF7043;
        /* Red color for inactive status */
    }

    .tile-progress {
        background-color: #303641;
        color: #fff;
    }

    .tile-progress {
    background: #00a65b;
    color: #fff;
    margin-bottom: 20px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    -webkit-background-clip: padding-box;
    -moz-background-clip: padding;
    background-clip: padding-box;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
}

.tile-progress .tile-header {
    padding: 15px 20px;
    padding-bottom: 40px;
}

.tile-progress .tile-progressbar {
    height: 2px;
    background: rgba(0, 0, 0, 0.18);
    margin: 0;
}

/* Media Query for Mobile */
@media (max-width: 767px) {
    .tile-progress .tile-header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 999; /* You can adjust the z-index as needed */
    }

    /* Add additional styles for the fixed header if necessary */
}

    .tile-progress .tile-progressbar span {
        background: #fff;
    }

    .tile-progress .tile-progressbar span {
        display: block;
        background: #ffffff;
        width: 0;
        height: 100%;
        -webkit-transition: all 1.5s cubic-bezier(0.230, 1.000, 0.320, 1.000);
        -moz-transition: all 1.5s cubic-bezier(0.230, 1.000, 0.320, 1.000);
        -o-transition: all 1.5s cubic-bezier(0.230, 1.000, 0.320, 1.000);
        transition: all 1.5s cubic-bezier(0.230, 1.000, 0.320, 1.000);
    }

    .tile-progress .tile-footer {
        padding: 20px;
        text-align: right;
        background: rgba(0, 0, 0, 0.1);
        -webkit-border-radius: 0 0 3px 3px;
        -webkit-background-clip: padding-box;
        -moz-border-radius: 0 0 3px 3px;
        -moz-background-clip: padding;
        border-radius: 0 0 3px 3px;
        background-clip: padding-box;
        -webkit-border-radius: 0 0 3px 3px;
        -moz-border-radius: 0 0 3px 3px;
        border-radius: 0 0 3px 3px;
    }

    .tile-progress.tile-red {
        background-color: #f56954;
        color: #fff;
    }

    .tile-progress {
        background-color: #303641;
        color: #fff;
    }

    .tile-progress.tile-blue {
        background-color: #0073b7;
        color: #fff;
    }

    .tile-progress.tile-aqua {
        background-color: #00c0ef;
        color: #fff;
    }

    .tile-progress.tile-green {
        background-color: #00a65a;
        color: #fff;
    }

    .tile-progress.tile-cyan {
        background-color: #00b29e;
        color: #fff;
    }

    .tile-progress.tile-purple {
        background-color: #ba79cb;
        color: #fff;
    }

    .tile-progress.tile-pink {
        background-color: #ec3b83;
        color: #fff;
    }

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

    .custom-close {
        outline: none;
        position: absolute;
        top: 15px;
        right: 15px;
        background-color: transparent;
        border: none;
        cursor: pointer;
        padding: 0;
        width: 30px;
        height: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: width 0.3s ease-in-out, height 0.3s ease-in-out;
        /* Add transition for width and height */
        border: 1px solid #fff;
        /* Add border */
        border-radius: 4px;
        /* Optional: Add rounded corners */
        overflow: hidden;
    }

    .custom-close span {
        font-size: 34px;
        color: #ffffff;
    }
</style>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&display=swap');

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

        /* Hide table headers */


        /* Adjust the size of the input fields on small screens */
        .form-group input,
        .form-group select {
            width: 100%;
        }
    }

    .table .row-table:nth-child(even) {
        background-color: #f2f2f2;
        /* Change this color as per your preference */
    }

    .table .row-table:nth-child(odd) {
        background-color: #ffffff;
        /* Change this color as per your preference */
    }
</style>
<!-- ... Your previous HTML and PHP code ... -->

<style>
    /* Custom CSS using Bootstrap class names */
    /* Custom CSS using Bootstrap class names */
    /* ... Your existing CSS code ... */

    /* Responsive styles */
    @media screen and (max-width: 768px) {
        table-status {
            display: block;
            width: 100%;
        }



        /* Adjust the size of the input fields on small screens */
        .form-group input,
        .form-group select {
            width: 100%;
        }
    }

    @media screen and (max-width: 768px) {
        .table-status {
            display: flex;
            flex-direction: column;
        }

        .row-table {
            display: flex;
            flex-wrap: wrap;
            border: 0px solid #ccc;
            margin-bottom: 5px;
        }

        .cell {
            flex: 1;
            padding: 8px;
        }

        .header .cell {
            font-weight: bold;
            background-color: #88211a;
            color: white;
        }

        .row-table .cell:before {
            font-weight: bold;
            margin-bottom: 5px;
        }
    }

    @media screen and (min-width: 769px) {
        .table-status {
            display: table;
            width: 100%;
            border-collapse: collapse;
        }

        .row-table {
            display: table-row;
        }

        .cell {
            display: table-cell;
            padding: 8px;
            border: 1px solid #ccc;
        }

        .header .cell {
            font-weight: bold;
            background-color: #88211a;
            color: white;
        }
    }

    @media screen and (min-width: 991px) {
        .form-inline.status {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
        }
    }
</style>

<style>
    /* Initial styles for non-responsive layout */
    .modal-dialog {
        max-width: 800px;
        /* Adjust this value to your preference */
        margin: 20px auto;
        /* Center the modal horizontally with some top margin */
    }

    .modal-content {
        max-height: 80vh;
        /* Limit the modal height to 80% of the viewport height */
        overflow-y: auto;
        /* Add vertical scroll if content overflows */
    }

    #memberDetailsModal .panel.panel-primary {
        margin: 0;
        /* Remove margins to prevent unnecessary spacing */
    }

    #memberDetailsModal .panel-heading {
        background-color: #0073b7;
        /* Set header background color */
        border-color: #0073b7;
        color: #fff;
        /* Set header text color */
        padding: 10px;
        /* Add padding to the header */
    }

    #memberDetailsModal .table {
        margin: 0;
        /* Remove margins to prevent unnecessary spacing */
    }

    #memberDetailsModal .filters th input {
        width: 100%;
        /* Make filter input fields expand to fill the column */
    }

    #memberDetailsModal .btn-filter {
        background-color: #0073b7;
        border-color: #0073b7;
        color: #fff;
    }

    #memberDetailsModal .btn-filter:hover {
        background-color: #0073b7;
        border-color: #0073b7;
        color: #fff;
    }



    @media (min-width: 768px) and (max-width: 991px) {
        .modal-dialog {
            margin: 100px;
            /* Adjust margin for tablets and small screens */
        }

        #memberDetailsModal .panel-heading .pull-right {
            margin-top: -15px;
        }
    }

    @media (max-width: 767px) {

        /* Adjust the breakpoint as needed */
        #memberDetailsModal .modal-dialog {
            top: 50%;
            transform: translateY(-50%);
        }
    }

    /* Add a custom cursor style for the element */
    .custom-cursor {
        cursor: pointer;
        /* Change 'pointer' to the desired cursor type */
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

    .dropdown-content {
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

    .custom-dropdown.open .dropdown-content {
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

    .disabled-input {
        background-color: #eee !important;
        cursor: not-allowed;
    }
</style>

<title>Profile Page</title>


<body>
    <div class="main-wrapper-profile"><?php include('header.php'); ?><div class="container">
            <div class="row justify-content-center">
                <div class="container">
                    <h2 class="mb-4 text-center">User Profile</h2>
                    <div class="text-center " style="margin-top:10px;">
                        <?php
                        if (($data['membership_status'] == 'Active' || $data['membership_status'] == 'active')) {
                            echo '<p>Membership Status: <span class="membership-status active-mem"></span> Active</p>';
                        } else {
                            echo '<p>Membership Status: <span class="membership-status inactive-mem"></span> Inactive</p>';
                        }
                        ?></div>
                    <!-- Nav tabs -->
                    <ul class="nav-profile nav-tabs justify-content-center">
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#myDashboard" onclick="changeURL('profile.php')">My Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#myProfile">My Profile</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#changePassword">Change Password</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content mt-3">
                        <!-- My Profile Tab -->
                        <?php include 'mydashboard.php'; ?>
                        <!-- My Class Tab -->
                        <?php include 'myprofile.php'; ?>
                        <!-- Logout Tab -->
                        <div class="tab-pane fade " id="changePassword">
                            <form style="margin-top: 20px" method="post" action="?mode=changePassword" id="changePassword">
                                <div style="margin-top:10px; font-size:15px">
                                    <?php if (!empty($errorMsgPass)) { ?>
                                        <div class="alert alert-danger alert-dismissible text-center">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <?php echo $errorMsgPass; ?>
                                        </div>
                                    <?php } ?>
                                    <?php if (!empty($successMsg)) { ?>
                                        <div class="alert alert-success  alert-dismissible text-center">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <?php echo $successMsg; ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4 required">
                                        <label for="Current_Password">Current Password</label>
                                        <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Current Password" required>
                                        <i class="show-password-icon fa fa-eye" onclick="togglePasswordVisibility()" id="togglePassword"></i>
                                    </div>
                                    <div class="form-group col-md-4 required">
                                        <label for="New_Password">New Password</label>
                                        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password" required>
                                        <i class="show-password-icon fa fa-eye" onclick="toggleNewPasswordVisibility()" id="toggleNewPassword"></i>

                                    </div>
                                    <div class="form-group col-md-4 required">
                                        <label for="Confirm_New_Password">Confirm New Password</label>
                                        <input type="password" class="form-control" id="con_new_password" name="con_new_password" placeholder="Confirm New Password " required>
                                        <i class="show-password-icon fa fa-eye" onclick="toggleConNewPasswordVisibility()" id="toggleConNewPassword"></i>

                                    </div>
                                </div>
                                <!-- Add more fields as needed -->
                                <div class="form-group">
                                    <button type="submit" name="Pass_Change" onclick="changePassword()" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><?php include('footer.php'); ?></div>
    </div>

    <!-- Add Bootstrap JS and jQuery -->
    <script src="js/libs/jquery-2.2.4.min.js"></script>
    <script src="js/libs/bootstrap.min.js"></script>
    <script src="js/libs/owl.carousel.min.js"></script>
    <script src="js/libs/jquery.meanmenu.js"></script>
    <script src="js/libs/parallax.min.js"></script>
    <script src="js/libs/jquery.waypoints.min.js"></script>
    <script src="js/custom/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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

        // Function to validate the form and submit
        function validateAndSubmit() {
            // Remove formatting from mobile number
            const rawMobileNumber = mobileInput.value.replace(/\D/g, "");

            if (rawMobileNumber.length !== 10) {
                alert("Mobile Number should be exactly 10 digits");
                mobileInput.focus();
                return false;
            }

            // Set the raw mobile number back to the input value
            mobileInput.value = rawMobileNumber;

            // Your other validation logic...

            return true; // Allow form submission if validation passes
        }
        // Attach the modified validateAndSubmit function to the form's submit event
        const form = document.getElementById("your-form-id"); // Replace with your actual form ID
        form.addEventListener("submit", validateAndSubmit);
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var progressWrappers = document.querySelectorAll('.progress-wrapper.clickable');

            // Loop through each progress wrapper and add a click event listener
            progressWrappers.forEach(function(wrapper) {
                wrapper.addEventListener('click', function() {
                    // Show the modal when a progress wrapper is clicked
                    var targetModal = wrapper.getAttribute('data-target');
                    $(targetModal).modal('show');
                });
            });

            // Function to handle closing modals
            function closeModal(modalId) {
                var modal = document.getElementById(modalId);
                if (modal) {
                    $(modal).modal('hide');
                }
            }

            // Close button click event listeners for each modal
            document.getElementById('closeModalButton1').addEventListener('click', function() {
                closeModal('memberDetailsModal1');
            });

            document.getElementById('closeModalButton2').addEventListener('click', function() {
                closeModal('memberDetailsModal2');
            });

            document.getElementById('closeModalButton3').addEventListener('click', function() {
                closeModal('memberDetailsModal3');
            });

            // Add more event listeners for other modals if needed

        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var progressWrappers = document.querySelectorAll('.progress-wrapper.clickable');

            // Loop through each progress wrapper and add a click event listener
            progressWrappers.forEach(function(wrapper) {
                wrapper.addEventListener('click', function() {
                    // Show the modal when a progress wrapper is clicked
                    var targetModal = wrapper.getAttribute('data-target');
                    $(targetModal).modal('show');
                });
            });

            // Function to handle closing modals
            function closeModal(modalId) {
                var modal = document.getElementById(modalId);
                if (modal) {
                    $(modal).modal('hide');
                }
            }

            // Close button click event listeners for each modal
            document.getElementById('closeModalButton1').addEventListener('click', function() {
                closeModal('memberDetailsModal1');
            });

            document.getElementById('closeModalButton2').addEventListener('click', function() {
                closeModal('memberDetailsModal2');
            });

            document.getElementById('closeModalButton3').addEventListener('click', function() {
                closeModal('memberDetailsModal3');
            });

            // Add more event listeners for other modals if needed

        });
    </script>
    <script>
        const selectYear = document.getElementById('year_of_graduation');
        const currentYear = new Date().getFullYear();

        for (let year = 1980; year <= currentYear; year++) {
            const option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            selectYear.appendChild(option);
        }
    </script>
    <!-- Add this script after including Bootstrap JS -->
    <script>
        // Function to activate tabs

        function activateTab(tabId) {

            // Remove 'active' class from all tab links and content
            document.querySelectorAll('.nav-link').forEach(function(tabLink) {
                tabLink.classList.remove('active');
            });

            document.querySelectorAll('.tab-pane').forEach(function(tabContent) {
                tabContent.classList.remove('show', 'active');
            });

            // Add 'active' class to the clicked tab link and show its content
            var tabLink = document.querySelector('[href="' + tabId + '"]');
            var tabContent = document.querySelector(tabId);

            if (tabLink && tabContent) {
                tabLink.classList.add('active');
                tabContent.classList.add('show', 'active');
            }
        }

        // Attach click event to each tab link
        document.querySelectorAll('.nav-link').forEach(function(tabLink) {
            tabLink.addEventListener('click', function(event) {
                event.preventDefault();
                var targetTabId = this.getAttribute('href');
                activateTab(targetTabId);
            });
        });




        // Activate the tab based on the URL hash
        var urlParams = new URLSearchParams(window.location.search);


        if (urlParams.get('mode') === 'changePassword') {
            var tabId = '#changePassword';
            activateTab(tabId);
            $(document).ready(function() {
                // Set My Profile tab active by default
                $('.nav-profile a[href="#changePassword"]').tab('show');
            });
        } else if (urlParams.get('editMode') === 'true') {
            var tabId = '#myProfile';
            activateTab(tabId);
            $(document).ready(function() {
                // Set My Profile tab active by default
                $('.nav-profile a[href="#myProfile"]').tab('show');
            });
        } else if (urlParams.get('Mode') === 'false' || urlParams.get('Mode') === 'true') {
            var tabId = '#myProfile';
            activateTab(tabId);
            $(document).ready(function() {
                // Set My Profile tab active by default
                $('.nav-profile a[href="#myProfile"]').tab('show');
            });

        } else {
            defaultTabId = '#myDashboard';
            activateTab(defaultTabId);
            $(document).ready(function() {
                // Set My Profile tab active by default
                $('.nav-profile a[href="#myDashboard"]').tab('show');
            });
        }
    </script>
    <script>
        function updateProfile() {
            // Gather form data
            var form = document.querySelector('#profileForm');
            var formData = new FormData(form);

            // Send form data using AJAX
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_profile.php', true);

            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);

                        if (response.success) {
                            // Redirect to the profile page after successful update
                            window.location.href = 'profile.php?Mode=true';
                        } else {
                            // Show the error message
                            var errorMsg = document.getElementById('errorMsg');
                            errorMsg.textContent = response.message;
                            errorMsg.style.display = 'block';


                        }
                    } else {
                        console.error('AJAX request failed.');
                    }
                }
            }

            ;
            xhr.send(formData);

            // Prevent the default form submission behavior
            return false;
        }
    </script>
    <script>
        // States for the USA and Canada
        const usaStates = ["Alabama",
            "Alaska",
            "Arizona",
            "Arkansas",
            "California",
            "Colorado",
            "Connecticut",
            "Delaware",
            "Florida",
            "Georgia",
            "Hawaii",
            "Idaho",
            "Illinois",
            "Indiana",
            "Iowa",
            "Kansas",
            "Kentucky",
            "Louisiana",
            "Maine",
            "Maryland",
            "Massachusetts",
            "Michigan",
            "Minnesota",
            "Mississippi",
            "Missouri",
            "Montana",
            "Nebraska",
            "Nevada",
            "New Hampshire",
            "New Jersey",
            "New Mexico",
            "New York",
            "North Carolina",
            "North Dakota",
            "Ohio",
            "Oklahoma",
            "Oregon",
            "Pennsylvania",
            "Rhode Island",
            "South Carolina",
            "South Dakota",
            "Tennessee",
            "Texas",
            "Utah",
            "Vermont",
            "Virginia",
            "Washington",
            "West Virginia",
            "Wisconsin",
            "Wyoming"
        ];

        const canadaStates = ["Alberta",
            "British Columbia",
            "Manitoba",
            "New Brunswick",
            "Newfoundland and Labrador",
            "Nova Scotia",
            "Ontario",
            "Prince Edward Island",
            "Quebec",
            "Saskatchewan"
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

            $(stateDropdown).select2();
        }

        // Call the function to populate the "state" dropdown when the country selection changes
        const countryDropdown = document.getElementById("country");

        countryDropdown.addEventListener("change", function() {
            const selectedCountry = this.value;
            populateStateDropdown(selectedCountry);
        });

        // Call the function to populate the "state" dropdown on page load
        //selectedCountry = countryDropdown.value;
        populateStateDropdown(selectedCountry);



        // Rest of the existing JavaScript code remains unchanged.
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById("current_password");

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

        function toggleNewPasswordVisibility() {
            const passwordInput = document.getElementById("new_password");

            const toggleIcon = document.getElementById("toggleNewPassword");

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

        function toggleConNewPasswordVisibility() {
            const passwordInput = document.getElementById("con_new_password");

            const toggleIcon = document.getElementById("toggleConNewPassword");

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

        // Function to enable all form fields for editing
        function enableEdit() {
            // Enable all form fields
            // var form = document.querySelector('#profileForm');
            // var formElements = form.elements;

            // for (var i = 0; i < formElements.length; i++) {
            //     var element = formElements[i];
            //     if (element.id === 'email_id' || element.type === 'button') {
            //         continue; // Skip to the next iteration, so 'disabled' won't be removed for this element
            //     }
            //     element.removeAttribute('disabled');
            // }

            // Enable the submit and cancel buttons
            // document.querySelector('#profileForm button[type="submit"]').removeAttribute('disabled');
            // document.querySelector('#profileForm button[type="button"]').removeAttribute('disabled');
            window.location.href = 'profile.php?editMode=true';

        }

        function disableEdit() {
            window.location.href = 'profile.php?Mode=false';

        }

        function getStatus() {
            window.location.href = 'profile.php?status';
        }


        // Function to disable all form fields and reset the form




        // Function to check if the URL contains 'editMode'
        // function isEditMode() {
        //     return window.location.href.indexOf('editMode') > -1;
        // }

        // // Call this function on page load to determine if the form should be editable
        // function initializeEditState() {
        //     if (isEditMode()) {
        //         enableEdit();
        //     }
        // }

        // // Attach the click event to the "Edit" button
        // document.querySelector('#profileForm button[type="button"]').addEventListener('click', function() {
        //     window.location.href = 'profile.php?editMode'; // Add 'editMode' to the URL on button click
        // });


        // // Call the function to initialize the edit state on page load
        // initializeEditState();
    </script>
    <script>
        $(document).ready(function() {
            $('.filterable .btn-filter').click(function() {
                var $panel = $(this).parents('.filterable'),
                    $filters = $panel.find('.filters input'),
                    $tbody = $panel.find('.table tbody');

                if ($filters.prop('disabled') == true) {
                    $filters.prop('disabled', false);
                    $filters.first().focus();
                } else {
                    $filters.val('').prop('disabled', true);
                    $tbody.find('.no-result').remove();
                    $tbody.find('tr').show();
                }
            });

            $('.filterable .filters input').keyup(function(e) {
                /* Ignore tab key */
                var code = e.keyCode || e.which;
                if (code == '9') return;
                /* Useful DOM data and selectors */
                var $input = $(this),
                    inputContent = $input.val().toLowerCase(),
                    $panel = $input.parents('.filterable'),
                    column = $panel.find('.filters th').index($input.parents('th')),
                    $table = $panel.find('.table'),
                    $rows = $table.find('tbody tr');

                /* Dirtiest filter function ever ;) */
                var $filteredRows = $rows.filter(function() {
                    var value = $(this).find('td').eq(column).text().toLowerCase();
                    return value.indexOf(inputContent) === -1;
                });
                /* Clean previous no-result if exist */
                $table.find('tbody .no-result').remove();
                /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
                $rows.show();
                $filteredRows.hide();

                /* Prepend no-result row if all rows are filtered */
                if ($filteredRows.length === $rows.length) {
                    $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="' + $table.find('.filters th').length + '">No result found</td></tr>'));
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Search functionality
            $("#searchInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".table-status .row-table.data").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
    <script>
        function changeURL(newURL) {
            // Change the URL using pushState
            window.history.pushState(null, '', newURL);
        }
    </script>
    <script>
        let selectedOptions = [];

        function toggleDropdown() {
            const dropdown = document.querySelector(".custom-dropdown");
            dropdown.classList.toggle("open");
        }

        function updateInputField() {
            selectedOptions = Array.from(document.querySelectorAll(".dropdown-option input:checked"))
                .map(option => option.value);

            const inputField = document.getElementById("additional_qual");
            inputField.value = selectedOptions.join(", ");
        }

        function handleOtherOption() {
            const otherCheckbox = document.getElementById("otherOption");
            const msCheckbox = document.getElementById("option1");
            const phdCheckbox = document.getElementById("option3");
            const inputField = document.getElementById("additional_qual");
            const otherInputField = document.getElementById("other_qual");
            const dropdown = document.querySelector(".custom-dropdown");

            if (otherCheckbox.checked) {
                msCheckbox.checked = false;
                phdCheckbox.checked = false;

                inputField.type = "text";
                otherInputField.style.display = "block";
                inputField.value = "Other";

                if (otherInputField.value.trim() !== "") {
                    inputField.value += ", " + otherInputField.value;
                }

                dropdown.classList.remove("open");
                document.getElementById("title").scrollIntoView({
                    behavior: "smooth",
                    block: "start"
                });
            } else {
                inputField.type = "text";
                otherInputField.style.display = "none";
                updateInputField();
            }
        }

        // Open dropdown when icon is clicked
        function openDropdown() {
            const dropdown = document.querySelector(".custom-dropdown");
            dropdown.classList.add("open");
        }

        // Close the dropdown if user clicks outside of it
        document.addEventListener("click", function(event) {
            const dropdown = document.querySelector(".custom-dropdown");
            if (!dropdown.contains(event.target)) {
                dropdown.classList.remove("open");
            }
        });
    </script>

</body>

</html>