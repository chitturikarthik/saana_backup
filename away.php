<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Away Notification</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background-color: rgba(0, 0, 0, 0.8);
    }

    .modal {
      display: flex;
      justify-content: center;
      align-items: center;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: #88211a;
    }

    .modal-content {
      background-color: #ffffff;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
      padding: 20px;
      text-align: center;
    }

    .modal-content p {
      margin: 0;
      font-size: 18px;
      color: #333333;
    }

    .popup {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 1000;
    }

    .popup.active {
      display: block;
    }
  </style>
</head>
<body>
  <div class="modal" id="modal">
    <div class="popup active">
      <div class="modal-content">
        <h2>Logged Out</h2>
        <p>You have been logged out due to 30 seconds inactivity</p>
      </div>
    </div>
  </div>

  <script>
    setTimeout(function() {
      document.querySelector('.popup').classList.remove('active');
      setTimeout(function() {
        window.location.href = 'login.php';
      }, 1000); // Redirect to login.php after 1 second
    }, 30000); // 30 seconds in milliseconds
  </script>
</body>
</html>
