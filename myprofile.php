<div class="tab-pane fade show active" id="myProfile">
    <form style="margin-top:20px" id="profileForm" onsubmit="return updateProfile()">
        <div class="form-row">
            <div class="form-group col-md-6 "><label for="first_name">First Name</label><input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo htmlspecialchars($data['first_name']); ?>" disabled></div>
            <div class="form-group col-md-6"><label for="middle_name">Middle Name</label><input type="text" class="form-control" id="middle_name" name="middle_name" value='<?php echo htmlspecialchars($data['middle_name']); ?>' disabled></div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6 "><label for="last_name">Last Name</label><input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo htmlspecialchars($data['last_name']); ?>" disabled></div>
            <div class="form-group col-md-6 "><label for="maiden_name">Maiden Name</label><input type="text" class="form-control" id="maiden_name" name="maiden_name" value="<?php echo htmlspecialchars($data['maiden_name']); ?>" disabled></div>
        </div>
        <div class="form-group col-lg-12 "><label for="email_id">Email</label><input type="email" class="form-control" id="email_id" value="<?php echo htmlspecialchars($data['email_id']); ?>" disabled></div>
        <div class="form-row">
            <div class="form-group col-md-6 required">
                <label for="mobile">Mobile</label>
                <?php
                // Get the mobile number from the data array
                $mobileNumber = $data['mobile'];

                // Remove non-numeric characters
                $rawNumber = preg_replace('/\D/', '', $mobileNumber);

                // If the number starts with '1', remove it
                if (strlen($rawNumber) === 11 && $rawNumber[0] === '1') {
                    $rawNumber = substr($rawNumber, 1);
                }

                // Ensure rawNumber is at most 10 digits
                $rawNumber = substr($rawNumber, 0, 10);

                // Format the number for display
                $formattedNumber = "+1 (" . substr($rawNumber, 0, 3) . ") " . substr($rawNumber, 3, 3) . "-" . substr($rawNumber, 6);
                ?>
                <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo htmlspecialchars($formattedNumber); ?>" required <?php echo isIdDisabled($editMode) ? 'disabled' : ''; ?>>
            </div>
            <div class="form-group col-md-6"><label for="nickname">Nickname</label><input type="text" class="form-control" id="nickname" name="nickname" value="<?php echo htmlspecialchars($data['nickname']); ?>" disabled></div>
        </div>
        <div class="form-row ">
            <div class="form-group col-md-6 required "><label for="country">Country</label><select class="form-control" id="country" name="country" required <?php echo isIdDisabled($editMode) ? 'disabled' : ''; ?>>
                    <option value="">Select a Country</option>
                    <option value="USA" <?php if ($data['country'] === 'USA') echo 'selected'; ?>>USA</option>
                    <option value="CANADA" <?php if ($data['country'] === 'CANADA') echo 'selected'; ?>>CANADA</option>
                    <!-- Add more countries as needed -->
                </select></div>
            <div class="form-group col-md-6 required"><label for="state">State</label><select class="form-control" id="state" name="state" required <?php echo isIdDisabled($editMode) ? 'disabled' : ''; ?>>
                    <option value="">Select a State</option>
                    <!-- States will be dynamically populated here based on the selected country -->
                    <?php
                    if ($selectedCountry === 'USA') {
                        echo generateStateOptions($usaStates, $selectedState);
                    } elseif ($selectedCountry === 'CANADA') {
                        echo generateStateOptions($canadaStates, $selectedState);
                    } else {
                        // Default option when no state is selected
                        echo '<option value="" selected>Select a State</option>';
                    }
                    ?>
                </select></div>
        </div>
        <div class="form-row ">
            <div class="form-group col-md-6 required "><label for="city">City</label><input type="text" class="form-control" id="city" name="city" required value="<?php echo htmlspecialchars($data['city']); ?>" <?php echo isIdDisabled($editMode) ? 'disabled' : ''; ?>></div>
            <div class="form-group col-md-6 required"><label for="postal_code">Zip Code</label><input type="text" class="form-control" id="postal_code" required name="postal_code" value="<?php echo htmlspecialchars($data['postal_code']); ?>" <?php echo isIdDisabled($editMode) ? 'disabled' : ''; ?>></div>
        </div>
        <div class="form-group col-lg-12 required"><label for="address_line">Address Line 1</label><input type="text" class="form-control" id="address_line" name="address_line" required value="<?php echo htmlspecialchars($data['address_line']); ?>" <?php echo isIdDisabled($editMode) ? 'disabled' : ''; ?>></div>
        <div class="form-group col-lg-12 "><label for="address_line">Address Line 2</label><input type="text" class="form-control" id="address_line2" name="address_line2" value="<?php echo htmlspecialchars($data['address_line2']); ?>" <?php echo isIdDisabled($editMode) ? 'disabled' : ''; ?>></div>
        <div class="form-row">
            <div class="form-group col-md-6 "><label for="year_of_graduation">Year of Graduation</label><select class="form-control" id="year_of_graduation" name="year_of_graduation" required disabled>
                    <option value="">Select a Year</option><?php
                                                            // Loop through the years from 1980 to 2020
                                                            for ($year = 1980; $year <= 2023; $year++) {
                                                                // Check if the current year matches the selected year from the database
                                                                $selected = ($selectedYear == $year) ? 'selected' : '';
                                                                echo '<option value="' . $year . '" ' . $selected . '>' . $year . '</option>';
                                                            }
                                                            ?>
                </select></div>
            <div class="form-group col-md-6 "><label for="dept">Department</label><select class="form-control" name="dept" id="dept" required disabled>
                    <option value="">Select a Department</option>
                    <option value="CSE" <?php if ($data['dept'] === 'CSE') echo 'selected'; ?>>CSE</option>
                    <option value="ECE" <?php if ($data['dept'] === 'ECE') echo 'selected'; ?>>ECE</option>
                    <option value="EEE" <?php if ($data['dept'] === 'EEE') echo 'selected'; ?>>EEE</option>
                    <option value="MECH" <?php if ($data['dept'] === 'MECH') echo 'selected'; ?>>MECH</option>
                    <option value="CIVIL" <?php if ($data['dept'] === 'CIVIL') echo 'selected'; ?>>CIVIL</option>
                    <option value="IT" <?php if ($data['dept'] === 'IT') echo 'selected'; ?>>IT</option>
                    <option value="CS-BS" <?php if ($data['dept'] === 'CS-BS') echo 'selected'; ?>>CS-BS</option>
                    <option value="CSD" <?php if ($data['dept'] === 'CSD') echo 'selected'; ?>>CSD</option>
                    <option value="AIDS" <?php if ($data['dept'] === 'AIDS') echo 'selected'; ?>>AIDS</option>
                    <option value="AIML" <?php if ($data['dept'] === 'AIML') echo 'selected'; ?>>AIML</option>
                    <option value="MPIE" <?php if ($data['dept'] === 'MPIE') echo 'selected'; ?>>MPIE</option>
                    <option value="CIC" <?php if ($data['dept'] === 'CIC') echo 'selected'; ?>>CIC</option>
                    <option value="CS-IT" <?php if ($data['dept'] === 'CS-IT') echo 'selected'; ?>>CS-IT</option>
                </select></div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4 "><label for="year_of_graduation">Employer</label><input type="text" class="form-control" id="current_organization" name="current_organization" value="<?php echo htmlspecialchars($data['current_organization']); ?>" <?php echo isIdDisabled($editMode) ? 'disabled' : ''; ?>></div>
            <div class="form-group col-md-4 "><label for="dept">Job Title</label><input type="text" class="form-control" id="curr_role" name="curr_role" value="<?php echo htmlspecialchars($data['curr_role']); ?>" <?php echo isIdDisabled($editMode) ? 'disabled' : ''; ?>></div>
            <div class="form-group col-md-4 "><label for="dept">Additional Qualifications</label>
                <div class="custom-dropdown">
                    <input type="text" class="form-control <?php echo isIdDisabled($editMode) ? 'disabled-input' : ''; ?>" id="additional_qual" name="additional_qual"  onclick="toggleDropdown()" value="<?php echo htmlspecialchars($data['additional_qual']); ?>" <?php echo isIdDisabled($editMode) ? 'disabled' : '';?> >
                    
                    <div class="dropdown-content">
                        <div class="dropdown-option">
                            <input type="checkbox" id="option1" name="option1" value="MS" onchange="updateInputField()" <?php echo isIdDisabled($editMode) ? 'disabled' : '';?>   >
                            <label for="option1">MS</label>
                        </div>
                        <div class="dropdown-option">
                            <input type="checkbox" id="option2" name="option2" value="MCA" onchange="updateInputField()" <?php echo isIdDisabled($editMode) ? 'disabled' : '';?>>
                            <label for="option2">MCA</label>
                        </div>
                        <div class="dropdown-option">
                            <input type="checkbox" id="option3" name="option3" value="PHD" onchange="updateInputField()" <?php echo isIdDisabled($editMode) ? 'disabled' : '';?>>
                            <label for="option3">PHD</label>
                        </div>
                        <div class="dropdown-option">
                            <input type="checkbox" id="otherOption" name="otherOption" value="OTHER" onchange="handleOtherOption()" <?php echo isIdDisabled($editMode) ? 'disabled' : '';?>>
                            <label for="otherOption">OTHER</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add more fields as needed -->
        <div class="form-group"><?php if ($editMode) { ?><button type="submit" class="btn btn-primary" name="update">Submit</button><button type="button" class="btn btn-primary" onclick="disableEdit()">Cancel</button><?php } else { ?><button type="button" class="btn btn-primary" onclick="enableEdit()">Edit</button><?php } ?></div>
        <div class="alert alert-danger alert-dismissible text-center" id="errorMsg" style="display:none"><button type="button" class="close" data-dismiss="alert">&times;
            </button></div>
    </form>
    <!-- Add more profile details as needed -->
</div>