<?php
include('session_management.php');

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page if not logged in
    header('Location: login.php');
    exit();
}

// Include the database connection
include('connect.php');

// Get the logged-in user's email (username)
$username = $_SESSION['username'];

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    // $first_name = $_POST['first_name'];
    // $middle_name = $_POST['middle_name'];
    // $last_name = $_POST['last_name'];
    // $maiden_name = $_POST['maiden_name'];
    $mobile = $_POST['mobile'];
    $mobile_without_formatting = preg_replace('/[^0-9]/', '', $mobile); // Remove non-numeric characters and leading "1"
    $mobile_without_plus = substr($mobile_without_formatting, 1); // Remove leading +1    $nickname = $_POST['nickname'];
    // $nickname = $_POST['nickname'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $postal_code = $_POST['postal_code'];
    $address_line = $_POST['address_line'];
    $address_line2 = $_POST['address_line2'];
    // $year_of_graduation = $_POST['year_of_graduation'];
    // $dept = $_POST['dept'];
    $current_organization = $_POST['current_organization'];
    $curr_role = $_POST['curr_role'];
    $additional_qual = $_POST['additional_qual'];

    // Check if required fields are empty
    if ( empty($mobile_without_plus) || empty($city) || empty($state) || empty($country) || empty($postal_code) || empty($address_line) ) {
        // Return an error response
        $response = array(
            'success' => false,
            'message' => 'Please fill all the required fields(*)'
        );
    } else {
        // Update query
        $query = "UPDATE all_members 
                  SET  mobile = ?,
                   city = ?, state = ?, country = ?, postal_code = ?, address_line = ?,  address_line2 = ?,
                   current_organization = ?, curr_role = ? , additional_qual = ?
                  WHERE email_id = ?";

        $stmt = $pdo->prepare($query);
        $stmt->execute([ $mobile_without_plus, $city, $state, $country, $postal_code, $address_line, $address_line2,  $current_organization, $curr_role,$additional_qual, $username]);

        // Return a success response
        $response = array(
            'success' => true,
            'message' => 'Update successful.'
        );
    }

    // Send the JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
} else {
    // Handle non-POST requests (e.g., if someone tries to access this file directly)
    // Redirect to the profile page
    header('Location: profile.php');
    exit();
}
