
<?php
include('session_management.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="icon" href="favicon.ico" type="image/ico" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="css/animate.css" />
  <link rel="stylesheet" type="text/css" href="css/owl.carousel.css" />
  <link rel="stylesheet" type="text/css" href="css/styles.css" />
  <link rel="stylesheet" type="text/css" href="css/meanmenu.css" />
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
  <link rel="stylesheet" type="text/css" href="css/custom.css">
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <style>
    /* custom.css */
    p {
      font-family: 'Poppins';
    }

    /* Team members cards */
    .responsive-cell-block {
      min-height: 75px;
    }

    .text-blk {
      margin: 0;
      font-size: 18px;
      color: black;
      font-weight: 800;
    }

    .responsive-container-block {
      min-height: 75px;
      height: fit-content;
      width: 100%;
      display: flex;
      flex-wrap: wrap;
      justify-content: space-evenly;
      margin-top: 0px;
      margin-bottom: 0px;
    }

    .team-head-text {
      font-size: 48px;
      font-weight: 900;
      text-align: center;
    }

    .team-head-text {
      line-height: 50px;
      width: 100%;
      margin-bottom: 50px;
    }

    .container-team {
      max-width: 1380px;
      margin: 60px auto;
      padding: 0 30px;
    }

    .card {
      text-align: center;
      box-shadow: rgba(0, 0, 0, 0.05) 0px 4px 20px 7px;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 30px 25px;
      background-color: #f9f9f9;
      margin-bottom: 30px;
    }

    .card-container {
      width: 285px;
      margin: 0 10px 25px;
      flex-wrap: wrap;
    }

    .name {
      margin: 15px 0 5px;
      font-size: 18px;
      color: black;
      font-weight: 800;

    }

    .position {
      margin-bottom: 10px;
    }

    .feature-text {
      margin-bottom: -40px;
      color: #88211a;
      line-height: 30px;
    }

    .social-icons {
      width: 70px;
      display: flex;
      justify-content: space-between;
    }

    .team-image-wrapper {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      overflow: hidden;
      margin: 0 auto 20px;
    }

    .team-member-image {
      max-width: 100%;
      height: auto;
      display: block;
      margin: 0 auto;
    }

    .tag {
      background-color: #88211A;
      color: white;
      font-size: 14px;
      padding: 2px 8px;
      border-radius: 4px;
      text-transform: uppercase;
      margin-top: -18px;
      display: inline-block;
    }

    /* Responsive adjustments */
    @media (max-width: 1200px) {
      .container-team {
        max-width: 960px;
      }
    }

    @media (max-width: 991px) {
      .card-container {
        width: 45%;
      }
    }

    @media (max-width: 767px) {
      .card-container {
        width: 100%;
        margin: 0;
        padding: 5px;
      }

      .responsive-cell-block {
        width: 100%;
      }

      .tag {
        margin-top: 5px;
      }
    }

    @media (max-width: 480px) {
      .card-container {
        width: 100%;
        margin: 0;
        padding: 5px;
      }

      .tag {
        margin-top: 5px;
      }
    }
  </style>
</head>

<body>
  <div class="main-wrapper page">
    <?php include("header.php"); ?>
    <div class="content-wrapper">
      <div class="responsive-container-block container-team">
        <h2 class="heading-regular text-center text-uppercase">Board Of Directors</h2>
        <div class="divider divider--lg"></div>
        <div class="responsive-container-block">
          <div class="responsive-cell-block card-container">
            <div class="card">
              <div class="team-image-wrapper">
                <img class="team-member-image" src="./images/profile_boy.png" alt="Chairperson">
                <br>

              </div>
              <span class="tag">CHAIRPERSON</span>
              <p class="text-blk name">
                Srinivasa Raju<br> Penematcha<br>
                1985 MECH
              </p>
            </div>
          </div>
          <div class="responsive-cell-block card-container">
            <div class="card">
              <div class="team-image-wrapper">
                <img class="team-member-image" src="./images/team/directors/bhanu.jpg" alt="Vice Chairperson">
                <br>

              </div>
              <span class="tag">VICE CHAIRPERSON</span>
              <p class="text-blk name">
                Bhanu Prakash Dhulipalla<br>(Co-founder)<br>
                1987 ECE
              </p>
            </div>
          </div>
          <div class="responsive-cell-block card-container">
            <div class="card">
              <div class="team-image-wrapper">
                <img class="team-member-image" src="./images/team/directors/ravib.jpg" alt="Secretary">
                <br>

              </div>
              <span class="tag">SECRETARY</span>
              <p class="text-blk name">
                Ravi Banda<br>
                1984 CIVIL
              </p>
            </div>
          </div>
          <div class="responsive-cell-block card-container">
            <div class="card">
              <div class="team-image-wrapper">
                <img class="team-member-image" src="./images/profile_boy.png" alt="Joint Secretary">
                <br>

              </div>
              <span class="tag">JOINT SECRETARY</span>
              <p class="text-blk name">
                Suman Chepuri<br>
                1996 CSE
              </p>
            </div>
          </div>
          <div class="responsive-cell-block card-container">
            <div class="card">
              <div class="team-image-wrapper">
                <img class="team-member-image" src="./images/team/directors/kanthisri.jpg" alt="Treasurer">
                <br>

              </div>
              <span class="tag">TREASURER</span>
              <p class="text-blk name">
                Kanthisri Chimirala<br>
                1999 CSE
              </p>
            </div>
          </div>
          <div class="responsive-cell-block card-container">
            <div class="card">
              <div class="team-image-wrapper">
                <img class="team-member-image" src="./images/team/directors/srinivas.jpg" alt="Director">
                <br>

              </div>
              <span class="tag">DIRECTOR</span>
              <p class="text-blk name">
                Srinivasa Babu Kunamneni<br>(Co-founder)<br>
                1989 MECH
              </p>
            </div>
          </div>
          <div class="responsive-cell-block card-container">
            <div class="card">
              <div class="team-image-wrapper">
                <img class="team-member-image" src="./images/team/directors/venky.jpg" alt="Director">
                <br>

              </div>
              <span class="tag">DIRECTOR</span>
              <p class="text-blk name">
                Venkateswara Rao Gadde<br>
                2003 CSE
              </p>
            </div>
          </div>
          <div class="responsive-cell-block card-container">
            <div class="card">
              <div class="team-image-wrapper">
                <img class="team-member-image" src="./images/team/directors/pavani.jpg" alt="Director">
                <br>

              </div>
              <span class="tag">DIRECTOR</span>
              <p class="text-blk name">
                Pavani Parupudi<br>
                1995 ECE
              </p>
            </div>
          </div>
          <div class="responsive-cell-block card-container">
            <div class="card">
              <div class="team-image-wrapper">
                <img class="team-member-image" src="./images/profile_boy.png" alt="Director">
                <br>

              </div>
              <span class="tag">DIRECTOR</span>
              <p class="text-blk name">
                Jaya Yellajosula<br>
                2007 EEE
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include("footer.php"); ?>
  </div>
  <script src="js/libs/jquery-2.2.4.min.js"></script>
  <script src="js/libs/bootstrap.min.js"></script>
  <script src="js/libs/owl.carousel.min.js"></script>
  <script src="js/libs/jquery.meanmenu.js"></script>
  <script src="js/libs/parallax.min.js"></script>
  <script src="js/libs/jquery.waypoints.min.js"></script>
  <script src="js/custom/main.js"></script>
</body>

</html>