<?php

if (isset($_GET['id']) && isset($_GET['status'])) {
    $email = $_GET['id'];
    $newStatus = $_GET['status'];

    include '../connect.php';

    $sql = "UPDATE `all_members` SET status = :status WHERE email_id = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':status', $newStatus, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location:total_alumni.php");
    } else {
        // echo "Error updating user status.";
    }
}
