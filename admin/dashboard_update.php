<?php
include "../connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email_new'];
    $mobile = $_POST['mobile_new'];
    $fname = $_POST['fname_new'];
    $lname = $_POST['lname_new'];
    $mname = $_POST['mname_new']; // Assuming you missed 'mname_new'
    $maiden = $_POST['maiden_new'];
    $nickname = $_POST['nickname_new'];
    $address = $_POST['address_new'];
    $city = $_POST['city_new'];
    $zip = $_POST['postal_new'];
    $state = $_POST['state_new'];
    $country = $_POST['country_new'];
    $yog = $_POST['yog_new'];
    $branch = $_POST['dept_new']; // Assuming you missed 'dept_new'
    $org = $_POST['employer_new'];
    $role = $_POST['job_new']; // Assuming you missed 'job_new'

    // Update the data in the database
    $updateSql = "UPDATE `all_members` SET  
                    mobile = :mobile, 
                    first_name = :fname, 
                    last_name = :lname, 
                    middle_name = :mname, 
                    maiden_name = :maiden, 
                    nickname = :nickname, 
                    address_line = :address, 
                    city = :city, 
                    postal_code = :zip, 
                    state = :state, 
                    country = :country, 
                    year_of_graduation = :yog, 
                    dept = :branch, 
                    current_organization = :org, 
                    curr_role = :role 
                    WHERE email_id = :email";

    $updateStmt = $pdo->prepare($updateSql);
    $updateStmt->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $updateStmt->bindParam(':fname', $fname, PDO::PARAM_STR);
    $updateStmt->bindParam(':lname', $lname, PDO::PARAM_STR);
    $updateStmt->bindParam(':mname', $mname, PDO::PARAM_STR);
    $updateStmt->bindParam(':maiden', $maiden, PDO::PARAM_STR);
    $updateStmt->bindParam(':nickname', $nickname, PDO::PARAM_STR);
    $updateStmt->bindParam(':address', $address, PDO::PARAM_STR);
    $updateStmt->bindParam(':city', $city, PDO::PARAM_STR);
    $updateStmt->bindParam(':zip', $zip, PDO::PARAM_STR);
    $updateStmt->bindParam(':state', $state, PDO::PARAM_STR);
    $updateStmt->bindParam(':country', $country, PDO::PARAM_STR);
    $updateStmt->bindParam(':yog', $yog, PDO::PARAM_STR);
    $updateStmt->bindParam(':branch', $branch, PDO::PARAM_STR);
    $updateStmt->bindParam(':org', $org, PDO::PARAM_STR);
    $updateStmt->bindParam(':role', $role, PDO::PARAM_STR);
    $updateStmt->bindParam(':email', $email, PDO::PARAM_STR);

    if ($updateStmt->execute()) {
        header("Location: dashboard.php");
    } else {
        echo "Error while updating data";
    }
    exit();
}
