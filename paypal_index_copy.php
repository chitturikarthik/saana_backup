<?php
// show error reporting
require_once './paypal/config.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
// $_SESSION['email']='chitturikarthik5225@gmail.com';
if (isset($_SESSION['email'])) {
  include 'connect.php';
  $email = $_SESSION['email'];
  $stmt = $pdo->prepare('SELECT addn_amount,email_id FROM all_members WHERE email_id = :email_id');
  $stmt->bindParam(':email_id', $email, PDO::PARAM_STR);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $value1 = $row['addn_amount'];
  $value2 = 100;
  $subtotal = $value1 + $value2;
  $charges = round(($subtotal * 4.0) / 100, 2);
  $money = $subtotal + $charges;
  // $money= 0.2;
  $productName = "SAANA MEMBERSHIP";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="favicon.ico" type="image/ico" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="css/animate.css" />
  <link rel="stylesheet" type="text/css" href="css/owl.carousel.css" />
  <link rel="stylesheet" type="text/css" href="css/styles.css" />
  <link rel="stylesheet" type="text/css" href="css/meanmenu.css" />
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
  <link rel="stylesheet" type="text/css" href="css/custom.css">
  <script src="js/libs/modernizr.custom.js"></script>
  <script src="https://www.paypal.com/sdk/js?client-id=<?php echo PAYPAL_SANDBOX ? PAYPAL_SANDBOX_CLIENT_ID : PAYPAL_PROD_CLIENT_ID; ?>&currency=<?php echo $currency; ?>"></script>
  <title>PayPal JS SDK Demo</title>
</head>

<body>
  <!--Begin header wrapper-->
  <?php include 'header.php'; ?>
  <div class="container main-container">
    <div class="info-container">
      <div class="info-text">
        <p>Please note that this total amount encompasses both the membership fee and any additional payment you want to make.</p>
      </div>
    </div>
    <div class="membership-fee">  
      <p class="text">MEMBERSHIP FEE : <b>$100.00</b>&nbsp;USD</p>
      <p class="text">ADDITIONAL AMOUNT : <b>$<?php echo $value1; ?></b>&nbsp;USD</p>
      <p class="text">PAYPAL CHARGES : <b>$<?php echo $charges; ?></b>&nbsp;USD</p>
      <hr>
      <p class="text">AMOUNT PAYABLE : <b>$<?php echo $money; ?></b>&nbsp;USD</p>
    </div>


    <div id="paypal-container">
      <div id="paypal-button-container"></div>
    </div>
  </div>

  <?php include 'footer.php'; ?>

  <script>
    const FUNDING_SOURCES = [
      paypal.FUNDING.PAYPAL,
      paypal.FUNDING.CARD
    ];
    FUNDING_SOURCES.forEach(fundingSource => {
      paypal.Buttons({
        fundingSource,

        style: {
          layout: 'vertical',
          shape: 'rect',
          color: (fundingSource == paypal.FUNDING.PAYLATER) ? 'gold' : '',
        },

        createOrder: async (data, actions) => {
          console.log('Data',data);
          return actions.order.create({
            "purchase_units": [{
              "custom_id": "12345",
              "description": "<?php echo $productName; ?>",
              "amount": {
                "currency_code": "USD",
                "value": <?php echo $money; ?>,
                "breakdown": {
                  "item_total": {
                    "currency_code": "USD",
                    "value": <?php echo $money; ?>
                  }
                }
              },
              "items": [{
                "name": "<?php echo $productName; ?>",
                "description": "<?php echo $productName; ?>",
                "unit_amount": {
                  "currency_code": "USD",
                  "value": <?php echo $money; ?>
                },
                "quantity": "1",
                "category": "DIGITAL_GOODS"
              }, ]
            }]
          });
        },


        onApprove: (data, actions) => {
          console.log('onApprove called', data, actions);
          return actions.order.capture().then(function(orderData) {
            console.log('Order captured', orderData);
            // setProcessing(true);
            var postData = {
              paypal_order_check: 1,
              order_id: orderData.id
            };
            console.log('Post data', postData);
            fetch('./paypal/paypal_checkout_validate.php', {
                method: 'POST',
                headers: {
                  'Accept': 'application/json'
                },
                body: encodeFormData(postData)
              })
              .then((response) => {
                console.log('Response received', response);
                return response.json();
              })
              .then((result) => {
                console.log('Result', result)
                if (result.status == 1) {
                  console.log('Redirecting to payment status');
                  window.location.href = "./paypal/payment-status.php?checkout_ref_id=" + result.ref_id;
                } else {
                  console.log('Showing error message');
                  const messageContainer = document.querySelector("#paymentResponse");
                  console.log('Message container', messageContainer);
                  messageContainer.classList.remove("hidden");
                  messageContainer.textContent = result.msg;

                  setTimeout(function() {
                    console.log('Hiding error message');
                    messageContainer.classList.add("hidden");
                    messageText.textContent = "";
                  }, 5000);
                }
                console.log('Setting processing to false');
                // setProcessing(false);
              })
              .catch(error => console.log('Error caught', error));
          });
        },

        onCancel: async (data, actions) => {
          window.location.href ="cancel.php";
        },

        onError: async (err) => {
          window.location.href ="cancel.php";
        }

      }).render("#paypal-button-container");
    })

    const encodeFormData = (data) => {
      var form_data = new FormData();

      for (var key in data) {
        form_data.append(key, data[key]);
      }
      return form_data;
    }
  </script>
  <script src="js/libs/jquery-2.2.4.min.js"></script>
  <script src="js/libs/bootstrap.min.js"></script>
  <script src="js/libs/owl.carousel.min.js"></script>
  <script src="js/libs/jquery.meanmenu.js"></script>
  <script src="js/libs/parallax.min.js"></script>
  <script src="js/libs/jquery.waypoints.min.js"></script>
  <script src="js/custom/main.js"></script>
</body>

</html>