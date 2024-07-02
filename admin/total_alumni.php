<?php
session_start();
include '../connect.php';

$query = "SELECT COUNT(*) FROM all_members"; // Corrected the column name to "username"
$stmt1 = $pdo->prepare($query);
$stmt1->execute();
$result = $stmt1->fetchColumn();

$selectQuery = "SELECT * FROM all_members ORDER BY registration_date DESC";
$stmt = $pdo->query($selectQuery);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

$query = "SELECT COUNT(*) FROM all_members WHERE status = 1"; // Corrected the column name to "username"
$stmt1 = $pdo->prepare($query);
$stmt1->execute();
$alumni = $stmt1->fetchColumn();

$inactive_members = "SELECT COUNT(*) FROM all_members WHERE  status=0 "; // Corrected the column name to "username"
$stmt2 = $pdo->prepare($inactive_members);
$stmt2->execute();
$inactive = $stmt2->fetchColumn();


$sql = "SELECT year_of_graduation FROM all_members ORDER BY year_of_graduation DESC";
$stmt = $pdo->query($sql);
$countryCounts = array();
// Loop through the query results
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	$countries = explode(",", $row['year_of_graduation']); // Assuming countries are comma-separated

	// Count occurrences of each country
	foreach ($countries as $country) {
		$country = trim($country); // Remove extra spaces
		if (!empty($country)) {
			if (isset($countryCounts[$country])) {
				$countryCounts[$country]++;
			} else {
				$countryCounts[$country] = 1;
			}
		}
	}
}
// Convert the country counts array into JavaScript data format
$jsCountryData = '';
foreach ($countryCounts as $country => $count) {
	$jsCountryData .= '["' . $country . '", ' . $count . '],';
}
$jsCountryData = rtrim($jsCountryData, ',');

?>

<!DOCTYPE html>
<html class="fixed">

<head>
	<!-- Basic -->
	<meta charset="UTF-8" />

	<title>
		Saana Dashboard
	</title>
	<meta name="keywords" content="HTML5 Admin Template" />
	<meta name="description" content="Porto Admin - Responsive HTML5 Template" />
	<meta name="author" content="okler.net" />

	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<!-- Web Fonts  -->
	<!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css" />
 -->
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

	<!-- Vendor CSS -->
	<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" href="vendor/animate/animate.css" />

	<link rel="stylesheet" href="vendor/font-awesome/css/all.min.css" />
	<link rel="stylesheet" href="vendor/magnific-popup/magnific-popup.css" />
	<link rel="stylesheet" href="vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

	<!-- Specific Page Vendor CSS -->
	<link rel="stylesheet" href="vendor/select2/css/select2.css" />
	<link rel="stylesheet" href="vendor/select2-bootstrap-theme/select2-bootstrap.min.css" />
	<link rel="stylesheet" href="vendor/datatables/media/css/dataTables.bootstrap4.css" />

	<!-- Theme CSS -->
	<link rel="stylesheet" href="css/theme.css" />

	<!-- Skin CSS -->
	<link rel="stylesheet" href="css/skins/default.css" />

	<!-- Theme Custom CSS -->
	<link rel="stylesheet" href="css/custom.css" />

	<!-- Head Libs -->
	<script src="vendor/modernizr/modernizr.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<style>
		body {
			font-family: 'Poppins', sans-serif;
		}
	</style>
</head>

<body>
	<section class="body">
		<!-- start: header -->
		<?php include 'topbar.php' ?>
		<!-- end: header -->

		<div class="inner-wrapper">
			<!-- start: sidebar -->
			<?php include 'sidebar.php' ?>
			<!-- end: sidebar -->

			<section role="main" class="content-body">

				<!-- start: page -->

				<!-- <h5 class="font-weight-semibold text-dark text-uppercase mb-3 mt-3">Alumni Insights</h5> -->
				<div class="row">
					<div class="col-lg-6">
						<section class="card card-featured-left card-featured-quaternary mb-4">
							<div class="card-body">
								<div class="widget-summary">
									<div class="widget-summary-col widget-summary-col-icon">
										<div class="summary-icon bg-quaternary">
											<i class="fas fa-user"></i>
										</div>
									</div>
									<div class="widget-summary-col">
										<div class="summary"><br>
											<h4 class="title">Status Active</h4>
											<div class="info">
												<strong class="amount"><?php echo $alumni ?></strong>
												<span class="text-muted">(Alumni with active status)</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</section>
					</div>

					<div class="col-lg-6">
						<section class="card card-featured-left card-featured-primary mb-4">
							<div class="card-body">
								<div class="widget-summary">
									<div class="widget-summary-col widget-summary-col-icon">
										<div class="summary-icon bg-primary">
											<i class="fas fa-user-slash"></i>
										</div>
									</div>
									<div class="widget-summary-col">
										<div class="summary"><br>
											<h4 class="title">Status Inactive</h4>
											<div class="info">
												<strong class="amount"><?php echo $inactive ?></strong>
												<span class="text-muted">(Alumni with inactive status)</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</section>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-12">
						<section class="card">
							<header class="card-header">
								<div class="card-actions">
									<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
									<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
								</div>

								<h2 class="card-title">Alumni stats by graduation years.</h2>
								<!-- <p class="card-subtitle">With the categories plugin you can plot categories/textual data easily.</p> -->
							</header>
							<div class="card-body">

								<!-- Flot: Bars -->
								<div class="chart chart-md" id="flotBars"></div>
								<script type="text/javascript">
									var flotBarsData = [<?php echo $jsCountryData; ?>];
								</script>

							</div>
						</section>
					</div>

				</div>


				<div class="row">
					<div class="col">
						<section class="card">
							<header class="card-header">
								<div class="card-actions">
									<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
									<!-- <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a> -->
								</div>

								<h2 class="card-title">All Alumni</h2>
							</header>
							<div class="card-body">
								<table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
									<thead>
										<tr style="font-size:12px;">
											<th>Member Since</th>
											<th>Name</th>
											<th>Email</th>
											<th>Year</th>
											<th>Department</th>
											<th>Membership</th>
											<th>Status</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody style="font-size:12px;">
										<?php
										foreach ($users as $user) : ?>
											<tr>
												<td>
													<?php
													$registration_date = $user['registration_date'];
													$date = date("d", strtotime($registration_date));  // Day as a number
													$month = date("F", strtotime($registration_date));
													$year = date("Y", strtotime($registration_date)); // Month as a full string
													echo $month . " " . $date . " , " . $year;
													?>
												</td>
												<td><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></td>
												<td><?php echo $user['email_id']; ?></td>
												<td><?php echo $user['year_of_graduation']; ?></td>
												<td><?php echo $user['dept']; ?></td>
												<td>

													<?php
													if ($user['membership_status'] == 'Pending') {
														echo '
															<p class="text-muted">Pending</p>
															';
													} else {
														echo '
															<p class="text-success">Completed</p>
															';
													}
													?>
												</td>
												<td>
													<?php
													if ($user['status'] == 1) {
														echo '
															<p class="text-success">Active</p>
															';
													} else {
														echo '
															<p class="text-muted">Inactive</p>
															';
													}

													?>
												</td>
												<td style="display:flex;flex-direction:row;justify-content:space-evenly;align-items:center;">
													<div>
														<?php
														if ($user['status'] == 1) {
															echo '
															<a href="mode.php?id=' . $user['email_id'] . '&status=0" target="new" style="text-decoration:none;color:white;">
															<button type="button" class="mb-1 mt-1 mr-1 btn-sm btn-warning" style="border:none;font-size:12px;">Disable</button>
															</a>
															';
														} else {
															echo '
															<a href="mode.php?id=' . $user['email_id'] . '&status=1" target="new" style="text-decoration:none;color:white;">

															<button type="button" class="mb-1 mt-1 mr-1 btn-sm btn-default activate-button" style="border:none;font-size:12px;">Enable</button>
															</a>
															';
														}

														?>
													</div>
													<div>
														<a class="modal-with-form" href="#modalHeaderColorPrimary">
															<button data-id="<?php echo $user['email_id']; ?>" data-email="<?php echo $user['email_id']; ?>" data-mobile="<?php echo $user['mobile']; ?>" data-first="<?php echo $user['first_name']; ?>" data-last="<?php echo $user['last_name']; ?>" data-middle="<?php echo $user['middle_name']; ?>" data-maiden="<?php echo $user['maiden_name']; ?>" data-nickname="<?php echo $user['nickname']; ?>" data-address="<?php echo $user['address_line']; ?>" data-zip="<?php echo $user['postal_code']; ?>" data-city="<?php echo $user['city']; ?>" data-state="<?php echo $user['state']; ?>" data-country="<?php echo $user['country']; ?>" data-graduation="<?php echo $user['year_of_graduation']; ?>" data-branch="<?php echo $user['dept']; ?>" data-org="<?php echo $user['current_organization']; ?>" data-role="<?php echo $user['curr_role']; ?>" class="userinfo btn-sm btn-primary" style="border:none;">View</button>
														</a>
													</div>

												</td>
											</tr>
										<?php
										endforeach; ?>
									</tbody>
								</table>
							</div>
						</section>
					</div>
				</div>
				<!-- end: page -->
			</section>
		</div>
	</section>

	<script>
		$(document).ready(function() {
			var isEditMode = false; // To track edit mode
			$(".edit-button").click(function() {
				isEditMode = true;
				$("input, textarea").removeAttr("disabled");
				$(".save-changes-button").show();
				$(this).hide(); // Hide the Edit button
			});
			$(".save-changes-button").click(function() {
				if (isEditMode) {
					$("#userForm").submit();
				}
			});
			$(".userinfo").click(function() {
				var email = $(this).data("email");
				var mobile = $(this).data("mobile");
				var first = $(this).data("first");
				var last = $(this).data("last");
				var middle = $(this).data("middle");
				var maiden = $(this).data("maiden");
				var nick = $(this).data("nickname");
				var address = $(this).data("address");
				var zip = $(this).data("zip");
				var city = $(this).data("city");
				var state = $(this).data("state");
				var country = $(this).data("country");
				var graduation = $(this).data("graduation");
				var branch = $(this).data("branch");
				var org = $(this).data("org");
				var role = $(this).data("role");
				$("#email_new").val(email);
				$("#mobile_new").val(mobile);
				$("#fname_new").val(first);
				$("#lname_new").val(last);
				$("#mname_new").val(middle);
				$("#maiden_new").val(maiden);
				$("#nickname_new").val(nick);
				$("#address_new").val(address);
				$("#city_new").val(city);
				$("#postal_new").val(zip);
				$("#state_new").val(state);
				$("#country_new").val(country);
				$("#yog_new").val(graduation);
				$("#dept_new").val(branch);
				$("#employer_new").val(org);
				$("#job_new").val(role);
			});
		});
	</script>

	<div id="modalHeaderColorPrimary" class="modal-block modal-header-color modal-block-primary modal-block-lg mfp-hide">
		<section class="card">
			<header class="card-header">
				<h2 class="card-title">Alumnus Details</h2>
			</header>
			<div class="card-body">
				<footer class="card-footer">
					<div class="row">
						<div class="col-md-12 text-right">
							<button class="btn btn-primary edit-button ml-2">Edit</button>
							<button class="btn btn-success save-changes-button ml-2" style="display:none;">Save Changes</button>
							<button class="btn btn-danger modal-dismiss ml-2">Close</button>
						</div>
					</div>
				</footer>
				<form id="userForm" action="total_alumni_update.php" method="POST">
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="inputEmail4">Email</label>
							<input disabled type="email" class="form-control" id="email_new" name="email_new">
						</div>
						<div class="form-group col-md-6 mb-3 mb-lg-0">
							<label for="inputPassword4">Mobile</label>
							<input disabled type="number" class="form-control" id="mobile_new" name="mobile_new">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-4">
							<label for="inputEmail4">First Name</label>
							<input disabled type="text" class="form-control" id="fname_new" name="fname_new">
						</div>
						<div class="form-group col-md-4">
							<label for="inputPassword4">Middle Name</label>
							<input disabled type="text" class="form-control" id="mname_new" name="mname_new">
						</div>
						<div class="form-group col-md-4">
							<label for="inputPassword4">Last Name</label>
							<input disabled type="text" class="form-control" id="lname_new" name="lname_new">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="inputEmail4">Maiden Name</label>
							<input disabled type="text" class="form-control" id="maiden_new" name="maiden_new">
						</div>
						<div class="form-group col-md-6 mb-3 mb-lg-0">
							<label for="inputPassword4">Nick Name</label>
							<input disabled type="text" class="form-control" id="nickname_new" name="nickname_new">
						</div>
					</div>

					<div class="form-group">
						<label for="inputAddress">Address</label>
						<input disabled type="text" class="form-control" id="address_new" name="address_new">
					</div>

					<div class="form-row">
						<div class="form-group col-md-3">
							<label for="inputZip">Zip Code</label>
							<input disabled type="text" class="form-control" id="postal_new" name="postal_new">
						</div>
						<div class="form-group col-md-3">
							<label for="inputCity">City</label>
							<input disabled type="text" class="form-control" id="city_new" name="city_new">
						</div>
						<div class="form-group col-md-3">
							<label for="inputZip">State</label>
							<input disabled type="text" class="form-control" id="state_new" name="state_new">
						</div>
						<div class="form-group col-md-3">
							<label for="inputCity">Country</label>
							<input disabled type="text" class="form-control" id="country_new" name="country_new">
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-3">
							<label for="inputZip">Graduation Year</label>
							<input disabled type="text" class="form-control" id="yog_new" name="yog_new">
						</div>
						<div class="form-group col-md-3">
							<label for="inputCity">Department</label>
							<input disabled type="text" class="form-control" id="dept_new" name="dept_new">
						</div>
						<div class="form-group col-md-3">
							<label for="inputZip">Employer</label>
							<input disabled type="text" class="form-control" id="employer_new" name="employer_new">
						</div>
						<div class="form-group col-md-3">
							<label for="inputCity">Job Title</label>
							<input disabled type="text" class="form-control" id="job_new" name="job_new">
						</div>
					</div>
				</form>
			</div>

		</section>
	</div>




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
	<script src="vendor/select2/js/select2.js"></script>
	<script src="vendor/datatables/media/js/jquery.dataTables.min.js"></script>
	<script src="vendor/datatables/media/js/dataTables.bootstrap4.min.js"></script>
	<script src="vendor/datatables/extras/TableTools/Buttons-1.4.2/js/dataTables.buttons.min.js"></script>
	<script src="vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.bootstrap4.min.js"></script>
	<script src="vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.html5.min.js"></script>
	<script src="vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.print.min.js"></script>
	<script src="vendor/datatables/extras/TableTools/JSZip-2.5.0/jszip.min.js"></script>
	<script src="vendor/datatables/extras/TableTools/pdfmake-0.1.32/pdfmake.min.js"></script>
	<script src="vendor/datatables/extras/TableTools/pdfmake-0.1.32/vfs_fonts.js"></script>
	<script src="js/theme.js"></script>
	<script src="js/cstom.js"></script>
	<script src="js/theme.init.js"></script>
	<script src="js/examples/examples.datatables.default.js"></script>
	<script src="js/examples/examples.datatables.row.with.details.js"></script>
	<script src="js/examples/examples.datatables.tabletools.js"></script>
	<script src="vendor/liquid-meter/liquid.meter.js"></script>
	<script src="vendor/flot/jquery.flot.js"></script>
	<script src="vendor/flot.tooltip/jquery.flot.tooltip.js"></script>
	<script src="vendor/flot/jquery.flot.categories.js"></script>
	<script src="vendor/flot/jquery.flot.resize.js"></script>
	<script src="vendor/chartist/chartist.js"></script>
	<script src="js/examples/examples.charts.js"></script>
	<script src="js/examples/examples.modals.js"></script>


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
	<script src="vendor/jquery.easy-pie-chart/jquery.easypiechart.js"></script>
	<script src="vendor/flot/jquery.flot.js"></script>
	<script src="vendor/flot.tooltip/jquery.flot.tooltip.js"></script>
	<script src="vendor/flot/jquery.flot.pie.js"></script>
	<script src="vendor/flot/jquery.flot.categories.js"></script>
	<script src="vendor/flot/jquery.flot.resize.js"></script>
	<script src="vendor/jquery-sparkline/jquery.sparkline.js"></script>
	<script src="vendor/raphael/raphael.js"></script>
	<script src="vendor/morris/morris.js"></script>
	<script src="vendor/gauge/gauge.js"></script>
	<script src="vendor/snap.svg/snap.svg.js"></script>
	<script src="vendor/liquid-meter/liquid.meter.js"></script>
	<script src="vendor/chartist/chartist.js"></script>

	<!-- Theme Base, Components and Settings -->
	<script src="js/theme.js"></script>

	<!-- Theme Custom -->
	<script src="js/custom.js"></script>

	<!-- Theme Initialization Files -->
	<script src="js/theme.init.js"></script>

	<!-- Examples -->
	<style>
		#ChartistCSSAnimation .ct-series.ct-series-a .ct-line {
			fill: none;
			stroke-width: 4px;
			stroke-dasharray: 5px;
			-webkit-animation: dashoffset 1s linear infinite;
			-moz-animation: dashoffset 1s linear infinite;
			animation: dashoffset 1s linear infinite;
		}

		#ChartistCSSAnimation .ct-series.ct-series-b .ct-point {
			-webkit-animation: bouncing-stroke 0.5s ease infinite;
			-moz-animation: bouncing-stroke 0.5s ease infinite;
			animation: bouncing-stroke 0.5s ease infinite;
		}

		#ChartistCSSAnimation .ct-series.ct-series-b .ct-line {
			fill: none;
			stroke-width: 3px;
		}

		#ChartistCSSAnimation .ct-series.ct-series-c .ct-point {
			-webkit-animation: exploding-stroke 1s ease-out infinite;
			-moz-animation: exploding-stroke 1s ease-out infinite;
			animation: exploding-stroke 1s ease-out infinite;
		}

		#ChartistCSSAnimation .ct-series.ct-series-c .ct-line {
			fill: none;
			stroke-width: 2px;
			stroke-dasharray: 40px 3px;
		}

		@-webkit-keyframes dashoffset {
			0% {
				stroke-dashoffset: 0px;
			}

			100% {
				stroke-dashoffset: -20px;
			}

			;
		}

		@-moz-keyframes dashoffset {
			0% {
				stroke-dashoffset: 0px;
			}

			100% {
				stroke-dashoffset: -20px;
			}

			;
		}

		@keyframes dashoffset {
			0% {
				stroke-dashoffset: 0px;
			}

			100% {
				stroke-dashoffset: -20px;
			}

			;
		}

		@-webkit-keyframes bouncing-stroke {
			0% {
				stroke-width: 5px;
			}

			50% {
				stroke-width: 10px;
			}

			100% {
				stroke-width: 5px;
			}

			;
		}

		@-moz-keyframes bouncing-stroke {
			0% {
				stroke-width: 5px;
			}

			50% {
				stroke-width: 10px;
			}

			100% {
				stroke-width: 5px;
			}

			;
		}

		@keyframes bouncing-stroke {
			0% {
				stroke-width: 5px;
			}

			50% {
				stroke-width: 10px;
			}

			100% {
				stroke-width: 5px;
			}

			;
		}

		@-webkit-keyframes exploding-stroke {
			0% {
				stroke-width: 2px;
				opacity: 1;
			}

			100% {
				stroke-width: 20px;
				opacity: 0;
			}

			;
		}

		@-moz-keyframes exploding-stroke {
			0% {
				stroke-width: 2px;
				opacity: 1;
			}

			100% {
				stroke-width: 20px;
				opacity: 0;
			}

			;
		}

		@keyframes exploding-stroke {
			0% {
				stroke-width: 2px;
				opacity: 1;
			}

			100% {
				stroke-width: 20px;
				opacity: 0;
			}

			;
		}
	</style>
	<script src="js/examples/examples.charts.js"></script>
</body>

</html>