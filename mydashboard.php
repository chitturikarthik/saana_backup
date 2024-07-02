<div class="tab-pane fade" id="myDashboard">
    <div class="container-fluid">
        <div class="row" style="margin-top: 50px; margin-right: -20px; margin-right: -20px;">

            <div class="col-sm-4 custom-cursor">
                <div class="progress-wrapper">
                    <div class="tile-progress tile-cyan" data-toggle="modal" data-target="#memberDetailsModal1">
                        <!-- Status bar content here -->
                        <div class="tile-header">
                            <h3><?php echo $countState; ?> Alumni</h3>
                        </div>
                        <div class="tile-progressbar">
                            <span data-fill="<?php echo $progressState ?>%;" style="width:<?php echo $progressState ?>%;"></span>
                        </div>
                        <div class="tile-footer">
                            <span> So Far From <?php echo $data['state']; ?> </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 custom-cursor">
                <div class="progress-wrapper">
                    <div class="tile-progress tile-red" data-toggle="modal" data-target="#memberDetailsModal2">
                        <!-- Status bar content here -->
                        <div class="tile-header">
                            <h3><?php echo $countClass ?> Alumni</h3>


                        </div>
                        <div class="tile-progressbar">
                            <span data-fill="<?php echo $progressClass ?>%" style="width: <?php echo $progressClass ?>%;"></span>
                        </div>
                        <div class="tile-footer">

                            <span>So Far From Your Class</span>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="progress-wrapper custom-cursor">
                    <div class="tile-progress tile-green" data-toggle="modal" data-target="#memberDetailsModal3">
                        <!-- Status bar content here -->
                        <div class="tile-header">
                            <h3><?php echo $countDept ?> Alumni</h3>

                        </div>
                        <div class="tile-progressbar">
                            <span data-fill="<?php echo $progressDept ?>%" style="width: <?php echo $progressDept ?>%;"></span>
                        </div>
                        <div class="tile-footer">
                            <span>So Far From <?php echo $data['dept'] ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade " id="memberDetailsModal1" tabindex="-1" role="dialog" aria-labelledby="memberDetailsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document" style="position: relative; top: 50%; transform: translateY(-50%); width: 90%; max-width: 1200px;">
                <div class="modal-content filterable">
                    <div class="modal-header" style="background-color:#00b29e; color: #fff;">
                        <h5 class="modal-title" id="memberDetailsModalLabel">
                            State Alumni
                        </h5>
                        <button class="btn btn-default btn-xs  btn-filter"><span class="glyphicon glyphicon-filter"></span>Filter</button>

                        <button type="button" class="close custom-close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr class="filters">
                                    <th><input type="text" class="form-control" placeholder="Name" disabled></th>
                                    <th> <input type="text" class="form-control" placeholder="State" disabled> </th>
                                    <th> <input type="text" class="form-control" placeholder="Country" disabled> </th>
                                    <th> <input type="text" class="form-control" placeholder="Email" disabled> </th>
                                    <!-- Add other columns here -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $targetState = strtolower($data['state']); // Change to the state you need
                                if (count($stateMembers) > 0) {
                                    foreach ($stateMembers as $member) {
                                ?>
                                        <tr>
                                            <td><?php echo $member['first_name'] . ' ' . $member['last_name']; ?></td>
                                            <td><?php echo $member['state']; ?></td>
                                            <td><?php echo $member['country']; ?></td>
                                            <td><?php echo $member['email_id']; ?> </td>
                                            <!-- Add other columns here -->
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="3">No members from <?php echo ucfirst(strtolower($data['state'])); ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="memberDetailsModal2" tabindex="-1" role="dialog" aria-labelledby="memberDetailsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document" style="position: relative; top: 50%; transform: translateY(-50%); width: 90%; max-width: 1200px;">
                <div class="modal-content filterable">
                    <div class="modal-header" style="background-color: #f56954; color: #fff;">
                        <h5 class="modal-title" id="memberDetailsModalLabel">
                            Classmates
                        </h5>
                        <button class="btn btn-default btn-xs  btn-filter"><span class="glyphicon glyphicon-filter"></span>Filter</button>

                        <button type="button" class="close custom-close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr class="filters">
                                    <th><input type="text" class="form-control" placeholder="Name" disabled></th>
                                    <th> <input type="text" class="form-control" placeholder="State" disabled> </th>
                                    <th> <input type="text" class="form-control" placeholder="Country" disabled> </th>
                                    <th> <input type="text" class="form-control" placeholder="Email" disabled> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Populate the table rows here using PHP -->
                                <?php foreach ($classMembers as $member) : ?>
                                    <tr>
                                        <td><?php echo $member['first_name'] . ' ' . $member['last_name']; ?></td>
                                        <td><?php echo $member['state']; ?></td>
                                        <td><?php echo $member['country']; ?></td>
                                        <td><?php echo $member['email_id']; ?> </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="memberDetailsModal3" tabindex="-1" role="dialog" aria-labelledby="memberDetailsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document" style="position: relative; top: 50%; transform: translateY(-50%); width: 90%; max-width: 1200px;">
                <div class="modal-content filterable">
                    <div class="modal-header" style="background-color: #00a65a; color: #fff;">
                        <h5 class="modal-title" id="memberDetailsModalLabel">
                            Department Alumni
                        </h5>
                        <button class="btn btn-default btn-xs  btn-filter"><span class="glyphicon glyphicon-filter"></span>Filter</button>

                        <button type="button" class="close custom-close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr class="filters">
                                    <th><input type="text" class="form-control" placeholder="Name" disabled></th>
                                    <th> <input type="text" class="form-control" placeholder="State" disabled> </th>
                                    <th> <input type="text" class="form-control" placeholder="Country" disabled> </th>
                                    <th> <input type="text" class="form-control" placeholder="Email" disabled> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Populate the table rows here using PHP -->
                                <?php foreach ($deptMembers as $member) : ?>
                                    <tr>
                                        <td><?php echo $member['first_name'] . ' ' . $member['last_name']; ?></td>
                                        <td><?php echo $member['state']; ?></td>
                                        <td><?php echo $member['country']; ?></td>
                                        <td><?php echo $member['email_id']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="account-content ">
            <?php if (!$memberFound && !empty($errorMsgDash)) { ?>
                <div class="alert alert-danger alert-dismissible text-center">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo $errorMsgDash; ?>
                </div>
            <?php } ?>
            <h4 class="heading-light text-align " style="text-align: center;"><b style='color:#88211A; '>Check Your Friends Here..!</b><br><br><span style="color:#000000;">
                    Get the status by their FIRST NAME or LAST NAME or YEAR OF GRADUATION or BRANCH
                </span></h4>
            <form action="" method="post" class="form-inline status" style="padding:5px;margin:5px;">

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
                    <button type="submit" class="heading-regular" name="status" style="background-color:#88211A;color:white; border:none; padding:10px;font-size:large;" onclick="getStatus()">FIND</button>
                </div>
            </form>

            <?php if (isset($memberFound)) : ?>
                <?php if ($memberFound) : ?>
                    <!-- Display the member details in a table -->


                    <div class="modal-content filterable" style="margin-bottom: 75px;">
                        <div class="modal-header" style="background-color: #88211A; color: #fff;">
                            <h5 class="modal-title" id="memberDetailsModalLabel">
                                Membership Details
                            </h5>
                            <button class="btn btn-default  pull-right btn-xs  btn-filter"><span class="glyphicon glyphicon-filter"></span>Filter</button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                    <tr class="filters">
                                        <th><input type="text" class="form-control " placeholder="First Name" disabled> </th>
                                        <th><input type="text" class="form-control " placeholder="Last Name" disabled> </th>
                                        <th><input type="text" class="form-control " placeholder="Email" disabled> </th>
                                        <th><input type="text" class="form-control " placeholder="Mobile" disabled> </th>
                                        <th><input type="text" class="form-control " placeholder="Graduation Year" disabled> </th>
                                        <th><input type="text" class="form-control " placeholder="Branch" disabled> </th>
                                        <th><input type="text" class="form-control " placeholder="Country" disabled> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                                        <tr>
                                            <td><?php echo $row['first_name']; ?></td>
                                            <td><?php echo $row['last_name']; ?></td>
                                            <td><?php echo $row['email_id']; ?></td>
                                            <td><?php echo $row['mobile']; ?></td>
                                            <td><?php echo $row['year_of_graduation']; ?></td>
                                            <td><?php echo $row['dept']; ?></td>
                                            <td><?php echo $row['country']; ?></td>
                                        </tr>
                                    <?php endwhile;  ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php else : ?>
                    <!-- Display error message if data not found -->
                    <!-- Display error message if data not found -->


                <?php endif; ?>
            <?php endif; ?>

        </div>
        <div class="modal-content filterable" style="margin-bottom:30px">
            <div class="modal-header" style="background-color: #88211a; color: #fff;">
                <h5 class="modal-title" id="memberDetailsModalLabel">
                    Classmates
                    <button class="btn btn-default btn-xs pull-right btn-filter"><span class="glyphicon glyphicon-filter"></span>Filter</button>

                </h5>

                <!-- <button type="button" class="close custom-close btn-filter" data-dismiss="modal" aria-label="Close">
                                        <span class="glyphicon glyphicon-filter">Filter</span>
                                        </button> -->

            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr class="filters">
                            <th><input type="text" class="form-control" placeholder="Name" disabled></th>
                            <th> <input type="text" class="form-control" placeholder="State" disabled> </th>
                            <th> <input type="text" class="form-control" placeholder="Country" disabled> </th>
                            <th> <input type="text" class="form-control" placeholder="Email" disabled> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Populate the table rows here using PHP -->
                        <?php foreach ($classMembers as $member) : ?>
                            <tr>
                                <td><?php echo $member['first_name'] . ' ' . $member['last_name']; ?></td>
                                <td><?php echo $member['state']; ?></td>
                                <td><?php echo $member['country']; ?></td>
                                <td><?php echo $member['email_id']; ?> </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
