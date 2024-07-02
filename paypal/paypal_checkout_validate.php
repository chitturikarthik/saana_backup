<?php
// Include the configuration file 
require_once 'config.php';
session_start();
// Include the database connection file 
include_once './../connect.php';

// Include the PayPal API library 
require_once 'PaypalCheckout.class.php';
$paypal = new PaypalCheckout;

$response = array('status' => 0, 'msg' => 'Transaction Failed!');
error_log('Initial response: ' . print_r($response, true));

if (!empty($_POST['paypal_order_check']) && !empty($_POST['order_id'])) {
    error_log('paypal_order_check and order_id are set');

    // Validate and get order details with PayPal API 
    try {
        $order = $paypal->validate($_POST['order_id']);
        error_log('Order after validation: ' . print_r($order, true));

    } catch (Exception $e) {
        $api_error = $e->getMessage();
        error_log('API error: ' . $api_error);

    }

    if (!empty($order)) {
        $order_id = $order['id'];
        $intent = $order['intent'];
        $order_status = $order['status'];
        $order_time = date("Y-m-d H:i:s", strtotime($order['create_time']));

        if (!empty($order['purchase_units'][0])) {
            $purchase_unit = $order['purchase_units'][0];

            $item_number = $purchase_unit['custom_id'];
            $item_name = $purchase_unit['description'];

            if (!empty($purchase_unit['amount'])) {
                $currency_code = $purchase_unit['amount']['currency_code'];
                $amount_value = $purchase_unit['amount']['value'];
            }

            if (!empty($purchase_unit['payments']['captures'][0])) {
                $payment_capture = $purchase_unit['payments']['captures'][0];
                $transaction_id = $payment_capture['id'];
                $payment_status = $payment_capture['status'];
            }

            if (!empty($purchase_unit['payee'])) {
                $payee = $purchase_unit['payee'];
                $payee_email_address = $payee['email_address'];
                $merchant_id = $payee['merchant_id'];
            }
        }

        $payment_source = '';
        if (!empty($order['payment_source'])) {
            foreach ($order['payment_source'] as $key => $value) {
                $payment_source = $key;
            }
        }

        if (!empty($order['payer'])) {
            $payer = $order['payer'];
            $payer_id = $payer['payer_id'];
            $payer_name = $payer['name'];
            $payer_given_name = !empty($payer_name['given_name']) ? $payer_name['given_name'] : '';
            $payer_surname = !empty($payer_name['surname']) ? $payer_name['surname'] : '';
            $payer_full_name = trim($payer_given_name . ' ' . $payer_surname);
            $payer_full_name = filter_var($payer_full_name, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

            $payer_email_address = $payer['email_address'];
            $payer_address = $payer['address'];
            $payer_country_code = !empty($payer_address['country_code']) ? $payer_address['country_code'] : '';
        }

        if (!empty($order_id) && $order_status == 'COMPLETED') {
            error_log('Order is completed');
            error_log('Order ID: ' . $order_id);
            error_log('Order Status: ' . $order_status);
            error_log('Transaction ID: ' . $transaction_id);
            // Check if any transaction data is exists already with the same TXN ID 
            $status = 'Active';
            $sqlQ = "SELECT transaction_id FROM all_members WHERE transaction_id = ?";
            $stmt = $pdo->prepare($sqlQ);
            $stmt->bindParam(1, $transaction_id, PDO::PARAM_STR);
            error_log('SQL Query: ' . $stmt->queryString);
            $stmt->execute();
            $row_id = $stmt->fetchColumn();
            error_log('Row ID: ' . $row_id);
            $payment_id = 0;
            if (!empty($row_id)) {
                $payment_id = $row_id;
            } else {
                // Insert transaction data into the database 
                // $email = 'sivasai_csd@srkrec.edu.in';
                $email = $_SESSION['email'];
                $sqlQ = "UPDATE all_members SET transaction_id = ?, payable_total = ?, payer_id = ?, payment_date = ?, payment_status = ?, membership_status = ? , order_id = ?, payment_type= ?  WHERE email_id = ?";
                $stmt = $pdo->prepare($sqlQ);
                $insert = $stmt->execute([$transaction_id, $amount_value, $payer_id, $order_time, $payment_status, $status,$order_id,$payment_source, $email]);
                error_log('Insert status: ' . ($insert ? 'success' : 'failure'));

                if ($insert) {
                    $payment_id = $pdo->lastInsertId();
                    error_log('Payment ID: ' . $payment_id);
                    $payment_id = 2024;
                    error_log('Payment ID: ' . $payment_id);

                }
            }
            if (!empty($payment_id)) {
                $ref_id_enc = base64_encode($transaction_id);
                $response = array('status' => 1, 'msg' => 'Transaction completed!', 'ref_id' => $ref_id_enc);
                error_log('Final response: ' . print_r($response, true));

            }
        }
    } else {
        $response['msg'] = $api_error;
    }
}
session_unset();
echo json_encode($response);
