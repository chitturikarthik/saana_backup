<?php
session_start()
?>

<!doctype html>
<html class="fixed sidebar-left-collapsed">

<head>

	<!-- Basic -->
	<meta charset="UTF-8">

	<title>Saana Admin</title>
	<meta name="keywords" content="HTML5 Admin Template" />
	<meta name="description" content="Porto Admin - Responsive HTML5 Template">
	<meta name="author" content="okler.net">

	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<!-- Web Fonts  -->
	<!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css"> -->
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

	<!-- Vendor CSS -->
	<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" href="vendor/animate/animate.css">

	<link rel="stylesheet" href="vendor/font-awesome/css/all.min.css" />
	<link rel="stylesheet" href="vendor/magnific-popup/magnific-popup.css" />
	<link rel="stylesheet" href="vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

	<!-- Specific Page Vendor CSS -->
	<link rel="stylesheet" href="vendor/owl.carousel/assets/owl.carousel.css" />
	<link rel="stylesheet" href="vendor/owl.carousel/assets/owl.theme.default.css" />

	<!-- Theme CSS -->
	<link rel="stylesheet" href="css/theme.css" />

	<!-- Skin CSS -->
	<link rel="stylesheet" href="css/skins/default.css" />

	<!-- Theme Custom CSS -->
	<link rel="stylesheet" href="css/custom.css">

	<!-- Head Libs -->
	<script src="vendor/modernizr/modernizr.js"></script>

	<style>
		body {
			font-family: 'Poppins', sans-serif;
		}
	</style>

</head>

<body>
	<section class="body">

		<!-- start: header -->
		<?php include 'topbar.php'; ?>
		<!-- end: header -->

		<div class="inner-wrapper">
			<!-- start: sidebar -->
			<?php include 'sidebar.php'; ?>
			<!-- end: sidebar -->

			<section role="main" class="content-body pb-0">


				<!-- start: page -->

				<!-- end: page -->
			</section>
		</div>
	</section>

	<!-- Vendor -->
	<script src="vendor/jquery/jquery.js"></script>
	<script src="vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
	<script src="vendor/popper/umd/popper.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.js"></script>
	<script src="vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="vendor/common/common.js"></script>
	<script src="vendor/nanoscroller/nanoscroller.js"></script>
	<script src="vendor/magnific-popup/jquery.magnific-popup.js"></script>
	<script src="vendor/jquery-placeholder/jquery.placeholder.js"></script>

	<!-- Specific Page Vendor -->
	<script src="vendor/jquery-appear/jquery.appear.js"></script>
	<script src="vendor/owl.carousel/owl.carousel.js"></script>
	<script src="vendor/isotope/isotope.js"></script>

	<!-- Theme Base, Components and Settings -->
	<script src="js/theme.js"></script>

	<!-- Theme Custom -->
	<script src="js/custom.js"></script>

	<!-- Theme Initialization Files -->
	<script src="js/theme.init.js"></script>

	<!-- Examples -->
	<script src="js/examples/examples.landing.dashboard.js"></script>
</body>

</html>