<?php

function sendEmail($mail_to, $mail_subject, $mail_body)
{
    $CURL_key = "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";
    $mail_from = "saananoreply@gmail.com";

    $curl = curl_init();

    $data = [ 
        "personalizations" => [
            [
                "to" => [
                    [
                        "email" => $mail_to
                    ]
                ],
                "subject" => $mail_subject
            ]
        ],  
        "from" => [
            "email" => $mail_from
        ],
        "content" => [
            [
                "type" => "text/html",
                "value" => $mail_body
            ]
        ]
    ];

    $data_string = json_encode($data);

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.sendgrid.com/v3/mail/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data_string,
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer $CURL_key",
            "content-type: application/json",
            "cache-control: no-cache"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #" . $err;
    } else {
        echo $response;
    }
}

// sendEmail("karthik_csd@srkrec.edu.in", "Testing Mail With Sendgrid", "This is a test mail sent using SendGrid.");
// sendEmail("karthik_csd@srkrec.edu.in", "Testing Mail With Sendgrid", "Sending mail through GoDaddy Server is successfull with saana Email.");



?>
