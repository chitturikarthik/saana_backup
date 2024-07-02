<?php
include('connect.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
$errorMsg = '';
include('session_management.php');
$memberFound = '';

// Check if the form is submitted
if (isset($_POST['submit'])) {
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
        $errorMsg = 'Please fill at least one field';
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
            $errorMsg = 'No member found';
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
    <title>Membership Status</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
            /* Add other table styling as needed */
        }

        table th,
        table td {
            padding: 8px;
            border: 1px solid #ccc;
            /* Add other cell styling as needed */
        }

        th {
            font-weight: bold;
            background-color: #88211a;
            color: white;
            text-align: center;
        }

        td {
            font-size: 12px;
            color: darkslategray;
            font-family: 'Poppins', sans-serif;
        }

        span {
            font-size: 12px;
            font-weight: 400;
            padding-top: 2px;
            color: darkgrey;
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

            table th,
            table td {
                display: block;
                width: 100%;
            }

            table th {
                margin-top: 10px;
            }
        }

        @media screen and (max-width: 768px) {

            /* Hide table headers */
            table th {
                display: none;
            }

            /* Display table rows as blocks and adjust column width */
            table td {
                display: block;
                width: 100%;
            }

            /* Add some spacing between the table cells */
            table td:before {
                content: attr(data-label);
                float: left;
                font-weight: bold;
                margin-right: 10px;
            }

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
            table {
                display: block;
                width: 100%;
            }

            table thead {
                display: none;
            }

            table tbody {
                display: block;
            }

            table tr {
                margin-bottom: 10px;
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                border: 1px solid #ccc;
                padding: 8px;
            }

            table td {
                flex-basis: 100%;
            }

            table td:before {
                content: attr(data-label);
                font-weight: bold;
                display: block;
                margin-bottom: 5px;
            }

            /* Adjust the size of the input fields on small screens */
            .form-group input,
            .form-group select {
                width: 100%;
            }
        }

        @media screen and (max-width: 768px) {
            .table {
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
            .table {
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
    </style>
    <!-- ... Your previous HTML and PHP code ... -->




</head>

<body>
    <div class="main-wrapper page">
        <?php
        include("header.php");
        ?>

        <!-- Begin content wrapper -->
        <div class="content-wrapper">
            <div class=" login text-center" style="padding-top:50px;">
                <div class="container">
                    <div class="account-title">
                        <h4 class="heading-light"><b style='color:#88211A;'>Check Your Membership Status Here..!</b><br><span>
                                Get the member's status by their FIRST NAME or LAST NAME or YEAR OF GRADUATION or BRANCH
                            </span></h4>

                    </div>
                    <div class="account-content">
                        <?php if (!$memberFound && !empty($errorMsg)) { ?>
                            <div class="alert alert-danger alert-dismissible text-center">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <?php echo $errorMsg; ?>
                            </div>
                        <?php } ?>
                        <form action="" method="post" class="form-inline" style="padding:5px;margin:5px;">

                            <div class="form-group" style="margin-right: 10px;">
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="<?php echo isset($first_name) ? htmlspecialchars($first_name) : ''; ?>">
                            </div>
                            <div class="form-group" style="margin-right: 10px;">
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="<?php echo isset($last_name) ? htmlspecialchars($last_name) : ''; ?>">
                            </div>
                            <!-- <div class="form-group" style="margin-right: 10px;">
                                <input type="number" class="form-control" id="year_of_graduation" name="year_of_graduation" placeholder="Gradution Year">
                            </div> -->
                            <!-- <div class="form-group" style="margin-right: 10px;">
                                <input type="text" class="form-control" id="uppercaseInput" oninput="convertToUppercase(this)" name="dept" placeholder="Branch">
                            </div> -->
                            <!-- <script>
                                function convertToUppercase(inputElement) {
                                    var inputValue = inputElement.value;
                                    inputElement.value = inputValue.toUpperCase();
                                }
                            </script> -->
                            <?php
                            // $total = $pdo->query("select count(*) as total from public.all_members");
                            // $total = $total->fetch(PDO::FETCH_ASSOC);
                            // echo "<h1>". $total['total']."</h1>";
                            ?>

                            <div class="form-group" style="margin-right: 10px;">
                                <select class="form-control" name="year_of_graduation" id="year_of_graduation">
                                    <option value="">Select Graduation Year</option>
                                    <?php
                                    $deptmt = $pdo->query("select year_of_graduation from all_members group by year_of_graduation order by year_of_graduation;");

                                    while ($row = $deptmt->fetch(PDO::FETCH_ASSOC)) {
                                        $selected = $year_of_graduation == $row['year_of_graduation'] ? 'selected' : '';
                                    ?>
                                        <option value="<?php echo $row['year_of_graduation'] ?>" <?php echo $selected ?>><?php echo $row['year_of_graduation'] ?></option>

                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="dept" id="dept">
                                    <option value="">Select Department</option>
                                    <?php
                                    $deptmt = $pdo->query("select dept from all_members group by dept");
                                    while ($row = $deptmt->fetch(PDO::FETCH_ASSOC)) {
                                        $selected = $dept === $row['dept'] ? 'selected' : '';

                                    ?>
                                        <option value="<?php echo $row['dept'] ?>" <?php echo $selected ?>><?php echo $row['dept'] ?></option>

                                    <?php } ?>
                                </select>
                            </div>

                            <div class="buttons-set" style="margin-top: 10px;">
                                <button type="submit" class="heading-regular" name="submit" style="background-color:#88211A;color:white; border:none; padding:10px;font-size:large;">FIND</button>
                            </div>
                        </form>

                        <?php if (isset($memberFound)) : ?>
                            <?php if ($memberFound) : ?>
                                <!-- Display the member details in a table -->


                                <div class="table-responsive">
                                    <div class="table">
                                        <div class="row-table header">
                                            <div class="cell">First Name</div>
                                            <div class="cell">Last Name</div>
                                            <div class="cell">Graduated Year</div>
                                            <div class="cell">Branch</div>

                                        </div>
                                        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                                            <div class="row-table data">
                                                <div class="cell" data-label="First Name"><?php echo $row['first_name']  ?></div>
                                                <div class="cell" data-label="Last Name"><?php echo $row['last_name']; ?></div>
                                                <div class="cell" data-label="Graduated Year"><?php echo $row['year_of_graduation']; ?></div>
                                                <div class="cell" data-label="Branch"><?php echo $row['dept']; ?></div>
                                            </div>
                                        <?php endwhile; ?>
                                    </div>
                                </div>
                            <?php else : ?>
                                <!-- Display error message if data not found -->
                                <!-- Display error message if data not found -->


                            <?php endif; ?>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
        <!-- End content wrapper -->
        <?php
        include("footer.php");
        ?>
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