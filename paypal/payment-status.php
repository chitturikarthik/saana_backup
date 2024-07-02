<?php
SESSION_START();
require_once './config.php';
require_once './../connect.php';
// include  './sendMail.php';
include '../sendgrid/email.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

$payment_ref_id = $statusMsg = '';
$status = 'error';
// Check whether the payment ID is not empty 
if (!empty($_GET['checkout_ref_id'])) {
    $payment_txn_id  = base64_decode($_GET['checkout_ref_id']);
    $sqlQ = "SELECT * FROM all_members WHERE transaction_id = ?";
    $stmt = $pdo->prepare($sqlQ);
    $stmt->bindParam(1, $payment_txn_id, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->rowCount();
    echo $stmt->rowCount();
    if ($stmt->rowCount() > 0) {
        $paymentData = $stmt->fetch(PDO::FETCH_ASSOC);
        // Fetch member details from the database
        $member_name_query = "SELECT * FROM all_members WHERE transaction_id = ?";
        $stmt_member = $pdo->prepare($member_name_query);
        $stmt_member->bindParam(1, $payment_txn_id, PDO::PARAM_STR);
        $stmt_member->execute();
        // Check if member details are found
        if ($stmt_member->rowCount() > 0) {
            $member_data = $stmt_member->fetch(PDO::FETCH_ASSOC);
            $email_id = $member_data['email_id'];
           
            $msgBody = "
                <!DOCTYPE html>
                <html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Email Body</title>
                    <style>
                        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');

                        body {
                            font-family: 'Inter', sans-serif;
                            color: #222;
                            font-weight: 500;
                        }
                    </style>
                </head>
                <body>
                    <p>Dear Alumni,<br>Thank you for registering as a Lifetime Member with SAANA - SRKR Alumni Association of North America!<br><br>
                    Welcome Onboard!<br>You will soon hear from us about exciting opportunities and events of our association.
                    Please feel free to check out our website for updates to stay in touch!<br>
                    <a href='https://www.thesaana.org/'>SAANA Home (thesaana.org)</a><br>
                    You can always reach us at saana.org@gmail.com for any further questions/assistance.<br><br>
                    Thank you,<br>Executive Committee & Board of Directors<br>SAANA, Inc.<br>saana.org@gmail.com<br>(571) 250-6370.</p>
                </body>
                </html>
                ";
            $msgHeading = "Confirmation of your SAANA Lifetime Membership"; 
            sendEmail($email_id, $msgHeading, $msgBody);
        } else {
            echo "<script>console.error('No member data found for transaction ID');</script>";
        }
        header("Location: ./../paypal_success.php");
        $status = 'success';
    } 
    else {
        // smtp_mailer($email_id, $msgHeading, $msgBody);
        $_SESSION['email'] = $email_id;
        $msgHeading = "Reaminder : Pending payment for SAANA Lifetime Membership" ;
        $msgBody="
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
        ";
        sendEmail($email_id,$msgHeading,$msgBody);
        header("Location: ./../cancel.php");
        $statusMsg = "Transaction has been failed!";
    }
} else {
    
    exit;
}