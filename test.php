<?php include('session_management.php');
 ?>
<!DOCTYPE html>
<html>

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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        /* Custom styles for the profile page */
        body {
            background-color: #f5f5f5;
        }

        .main-wrapper-profile {
            padding-top: 100px;
            padding-bottom: 50px;
        }

        @media (max-width: 767px) {
            .main-wrapper-profile {
                padding-top: 0px;
            }
        }

        .container-profile {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;

            margin: 0 auto;
            /* Center the container horizontally */
        }

        .container-form {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 600px;
            /* Limit the width to fit the screen */
            margin: 0 auto;
            /* Center the container horizontally */
            margin-top: 50px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group.required label::after {
            content: "*";
            color: red;
            margin-left: 5px;
        }

        .btn-primary {
            background-color: #88211A;
            border: none;

            margin-left: 15px;
        }

        .btn-primary:hover {
            background-color: #702017;
        }


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

        .tab-content {
            padding: 20px;
        }

        .tab-pane {
            border: none;
        }

        .tab-pane h4 {
            color: #ffffff;
            margin-bottom: 20px;
        }

        .tab-pane p {
            color: #666666;
        }

        .btn-danger {
            background-color: #88211A;
            border: none;
        }

        .btn-danger:hover {
            background-color: #702017;
        }

        .card-body.text-center {
            padding: 20px;
            background-color: #ffffff;
            /* Change the background color */
        }

        .img-account-profile {
            height: 10rem;
        }

        .rounded-circle {
            border-radius: 70% !important;
        }

        .small {
            font-size: 0.875rem;
        }

        .font-italic {
            font-style: italic;
        }

        .mb-4 {
            margin-bottom: 1.5rem;
        }

        .btn-primary {
            background-color: #88211A;
            /* Change the button background color */
            border: none;
        }

        .btn-primary:hover {
            background-color: #702017;
            /* Change the button hover background color */
        }

        /* Custom styles for the status bars in the dashboard section */
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

        .tab-pane.dashboard-content.row {
            margin-top: 15px;
        }

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

        /* Custom styles for the table */
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

        .panel-primary.filterable .filters input[disabled]::-webkit-input-placeholder {
            color: #333;
        }

        .panel-primary.filterable .filters input[disabled]::-moz-placeholder {
            color: #333;
        }

        .panel-primary.filterable .filters input[disabled]:-ms-input-placeholder {
            color: #333;
        }

        .form-group label {
            margin-bottom: 10px;
            /* Add the desired margin between label and input field */
        }

        /* Add this style to change the hover color of input fields */
        .form-control:focus {
            border-color: #88211A;
            /* Change the border color on focus */
            box-shadow: 0 0 0 0.2rem rgba(136, 33, 26, 0.25);
            /* Add a box-shadow on focus */
            outline: 0;
            /* Remove the default outline */
        }

        /* Custom styles for select2 dropdown on hover */
        .select2-container--open .select2-dropdown--below {
            border-color: #88211A;
            /* Change the border color of the select2 dropdown on open */
            box-shadow: 0 0 0 0.2rem rgba(136, 33, 26, 0.25);
            /* Add a box-shadow to the select2 dropdown on open */
        }
    </style>
    <title>Profile Page</title>
</head>

<body>
    <div class="main-wrapper-profile">
        <?php include('header.php'); ?>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="container-profile">
                    <h2 class="mb-4 text-center">User Profile</h2>

                    <!-- Nav tabs -->
                    <ul class="nav-profile nav-tabs justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#myProfile">My Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#dashboard">Dashboard</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#myClass">My Class</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Password">Password</a>
                        </li>

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content mt-3">
                        <!-- My Profile Tab -->
                        <div class="tab-pane fade show active" id="myProfile">
                            <form style="margin-top:20px">
                                <div class="form-row">
                                    <div class="card-body text-center">
                                        <img class="img-account-profile rounded-circle mb-2" src="https://bootdey.com/img/Content/avatar/avatar1.png" alt>
                                        <div class="small font-italic text-muted mb-4"></div>

                                    </div>
                                    <div class="form-group col-md-4 required">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" id="first_name" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="middle_name">Middle Name</label>
                                        <input type="text" class="form-control" id="middle_name">
                                    </div>
                                    <div class="form-group col-md-4 required">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" required>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12   required">
                                    <label for="email_id">Email</label>
                                    <input type="email" class="form-control" id="email_id" required>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6 required">
                                        <label for="mobile">Mobile</label>
                                        <input type="text" class="form-control" id="mobile" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="nickname">Nickname</label>
                                        <input type="text" class="form-control" id="nickname">
                                    </div>
                                </div>

                                <div class="form-group col-lg-12 required">
                                    <label for="address_line">Address Line 1</label>
                                    <input type="text" class="form-control" id="address_line">
                                </div>

                                <div class="form-row ">
                                    <div class="form-group col-md-6 required">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" id="city">
                                    </div>
                                    <div class="form-group col-md-6 required">
                                        <label for="state">State</label>
                                        <input type="text" class="form-control" id="state">
                                    </div>
                                </div>

                                <div class="form-row ">
                                    <div class="form-group col-md-6 required">
                                        <label for="country">Country</label>
                                        <input type="text" class="form-control" id="country">
                                    </div>
                                    <div class="form-group col-md-6 required">
                                        <label for="postal_code">Postal Code</label>
                                        <input type="text" class="form-control" id="postal_code">
                                    </div>
                                </div>

                                <div class="form-group col-lg-12 required">
                                    <label for="year_of_graduation">Year of Graduation</label>
                                    <input type="text" class="form-control" id="year_of_graduation">
                                </div>

                                <!-- Add more fields as needed -->
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" id="editButton" class="btn btn-primary">Edit</button>
                                </div>
                            </form>

                            <!-- Add more profile details as needed -->
                        </div>


                        <!-- Add this inside the "Dashboard Tab" section -->
                        <div class="tab-pane fade" id="dashboard">

                            <!-- Add your dashboard content here -->

                            <div class="row" style="margin-top: 50px; margin-right: -20px; margin-right: -20px;">
                                <div class="col-sm-3">
                                    <div class="progress-wrapper">
                                        <div class="tile-progress tile-blue">

                                            <!-- Status bar content here -->
                                            <div class="tile-header">
                                                <h3>300+ Members</h3>


                                            </div>
                                            <div class="tile-progressbar">
                                                <span data-fill="65.5%" style="width: 65.5%;"></span>
                                            </div>
                                            <div class="tile-footer">

                                                <span class="pct-counter">so far in our Sanna Alumni</span>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="progress-wrapper">
                                        <div class="tile-progress tile-grey">
                                            <!-- Status bar content here -->
                                            <div class="tile-header">
                                                <h3>18+ Locations</h3>

                                            </div>
                                            <div class="tile-progressbar">
                                                <span data-fill="23.2%" style="width: 23.2%;"></span>
                                            </div>
                                            <div class="tile-footer">

                                                <span> Members from Various locations </span>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="progress-wrapper">
                                        <div class="tile-progress tile-red">
                                            <!-- Status bar content here -->
                                            <div class="tile-header">
                                                <h3>50+</h3>


                                            </div>
                                            <div class="tile-progressbar">
                                                <span data-fill="78%" style="width: 78%;"></span>
                                            </div>
                                            <div class="tile-footer">

                                                <span>so far various companies in saan Alumni</span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="progress-wrapper">
                                        <div class="tile-progress tile-green">
                                            <!-- Status bar content here -->
                                            <div class="tile-header">
                                                <h3>10+ Departments</h3>

                                            </div>
                                            <div class="tile-progressbar">
                                                <span data-fill="78%" style="width: 78%;"></span>
                                            </div>
                                            <div class="tile-footer">
                                                <span>so far various Departments in Akumni</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="panel panel-primary filterable">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Members Status</h3>
                                            <div class="pull-right">
                                                <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                                            </div>
                                        </div>
                                        <table class="table">
                                            <thead>
                                                <tr class="filters">
                                                    <th><input type="text" class="form-control" placeholder="sno" disabled></th>
                                                    <th><input type="text" class="form-control" placeholder="Member name" disabled></th>
                                                    <th><input type="text" class="form-control" placeholder="Company" disabled></th>
                                                    <th><input type="text" class="form-control" placeholder="Position" disabled></th>
                                                    <th><input type="text" class="form-control" placeholder="Country" disabled></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>sivasai</td>
                                                    <td>siva sai naganaboyina</td>
                                                    <td>Google</td>
                                                    <td>Ceo</td>
                                                    <td>India</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Sanjay</td>
                                                    <td>Facebook</td>
                                                    <td>ceo</td>
                                                    <td>India</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Vivek</td>
                                                    <td>Ceo</td>
                                                    <td>Microsoft</td>
                                                    <td>India</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Vivek</td>
                                                    <td>Ceo</td>
                                                    <td>Microsoft</td>
                                                    <td>India</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- My Class Tab -->
                        <div class="tab-pane fade" id="myClass">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="panel panel-primary filterable">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Members Status</h3>
                                            <div class="pull-right">
                                                <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                                            </div>
                                        </div>
                                        <table class="table">
                                            <thead>
                                                <tr class="filters">
                                                    <th><input type="text" class="form-control" placeholder="sno" disabled></th>
                                                    <th><input type="text" class="form-control" placeholder="Member name" disabled></th>
                                                    <th><input type="text" class="form-control" placeholder="Company" disabled></th>
                                                    <th><input type="text" class="form-control" placeholder="Position" disabled></th>
                                                    <th><input type="text" class="form-control" placeholder="Country" disabled></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>siva sai</td>
                                                    <td>Google</td>
                                                    <td>Ceo</td>
                                                    <td>India</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Sanjay</td>
                                                    <td>Facebook</td>
                                                    <td>ceo</td>
                                                    <td>India</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Vivek</td>
                                                    <td>Ceo</td>
                                                    <td>Microsoft</td>
                                                    <td>India</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Password Tab -->
                        <div class="tab-pane fade" id="Password">
                            <form style="margin-top: 20px">
                                <div class="form-row">
                                    <div class="form-group col-md-4 required">
                                        <label for="Current_password">Current password</label>
                                        <input type="password" class="form-control" id="Current_password" placeholder="Enter Current password" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="Current_password">Re-enter Current password</label>
                                        <input type="password" class="form-control" id="re_enter_password" placeholder=" Re-enter Current password">
                                    </div>
                                    <div class="form-group col-md-4 required">
                                        <label for="New_Password">New Password</label>
                                        <input type="password" class="form-control" id="New_Password" required>
                                    </div>
                                </div>
                                <!-- Add more fields as needed -->
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" id="editButton" class="btn btn-primary">Edit</button>
                                </div>
                            </form>
                        </div>








                    </div>
                </div>
            </div>
        </div>
        <?php include('footer.php'); ?>
    </div>
    <!-- Add Bootstrap JS and jQuery -->
    <script src="js/libs/jquery-2.2.4.min.js"></script>
    <script src="js/libs/bootstrap.min.js"></script>
    <script src="js/libs/owl.carousel.min.js"></script>
    <script src="js/libs/jquery.meanmenu.js"></script>
    <script src="js/libs/parallax.min.js"></script>
    <script src="js/libs/jquery.waypoints.min.js"></script>
    <script src="js/custom/main.js"></script>
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

        // Activate the default tab (you can modify the 'defaultTabId' value as needed)
        var defaultTabId = '#myProfile';
        activateTab(defaultTabId);


        // Attach change event to the file input element
        var fileInput = document.getElementById('imageUploadInput');
        if (fileInput) {
            fileInput.addEventListener('change', handleFileSelect);
        }

        // Hide the "Upload new image" button initially
        toggleUploadButton();
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

</body>

</html>