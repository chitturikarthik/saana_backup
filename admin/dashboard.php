<?php

session_start();
if (!isset($_SESSION['access'])) header("Location:index.php");
include '../connect.php';

$query = "SELECT COUNT(*) FROM all_members"; // Corrected the column name to "username"
$stmt1 = $pdo->prepare($query);
$stmt1->execute();
$alumni = $stmt1->fetchColumn();

$inactive_members = "SELECT COUNT(*) FROM all_members WHERE membership_status = 'Pending' AND status=0 "; // Corrected the column name to "username"
$stmt2 = $pdo->prepare($inactive_members);
$stmt2->execute();
$inactive = $stmt2->fetchColumn();

$active_members = "SELECT COUNT(*) FROM all_members WHERE membership_status = 'active' "; // Corrected the column name to "username"
$stmt3 = $pdo->prepare($active_members);
$stmt3->execute();
$active = $stmt3->fetchColumn();

$pending_payments = "SELECT COUNT(*) FROM all_members WHERE payment_status = 'Pending' "; // Corrected the column name to "username"
$stmt4 = $pdo->prepare($pending_payments);
$stmt4->execute();
$pending = $stmt4->fetchColumn();

$civil_count = "SELECT COUNT(*) FROM all_members WHERE dept='Civil' OR 'CIVIL' ";
$stmt5 = $pdo->prepare($civil_count);
$stmt5->execute();
$civil = $stmt5->fetchColumn();

$cse_count = "SELECT COUNT(*) FROM all_members WHERE dept='CSE' OR 'cse' ";
$stmt6 = $pdo->prepare($cse_count);
$stmt6->execute();
$cse = $stmt6->fetchColumn();

$ece_count = "SELECT COUNT(*) FROM all_members WHERE dept='ECE' OR 'ece' ";
$stmt7 = $pdo->prepare($ece_count);
$stmt7->execute();
$ece = $stmt7->fetchColumn();

$eee_count = "SELECT COUNT(*) FROM all_members WHERE dept='EEE' OR 'eee' ";
$stmt8 = $pdo->prepare($eee_count);
$stmt8->execute();
$eee = $stmt8->fetchColumn();

$it_count = "SELECT COUNT(*) FROM all_members WHERE dept='IT' OR 'it' ";
$stmt9 = $pdo->prepare($it_count);
$stmt9->execute();
$it = $stmt9->fetchColumn();

$mech_count = "SELECT COUNT(*) FROM all_members WHERE dept='MECH' OR 'Mech'  ";
$stmt10 = $pdo->prepare($mech_count);
$stmt10->execute();
$mech = $stmt10->fetchColumn();

$mpie_count = "SELECT COUNT(*) FROM all_members WHERE dept='MPIE' OR 'Mpie'  ";
$stmt11 = $pdo->prepare($mpie_count);
$stmt11->execute();
$mpie = $stmt11->fetchColumn();

$selectQuery = "SELECT * FROM all_members ORDER BY registration_date DESC  LIMIT 20";
$stmt = $pdo->query($selectQuery);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);


$sql = "SELECT state FROM all_members ORDER BY state_ps";
$stmt = $pdo->query($sql);
$countryCounts = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	$countries = explode(",", $row['state']);
	foreach ($countries as $country) {
		$country = trim($country);
		if (!empty($country)) {
			if (isset($countryCounts[$country])) {
				$countryCounts[$country]++;
			} else {
				$countryCounts[$country] = 1;
			}
		}
	}
}
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

	<!-- <link href="https://fonts.googleapis.com/css2?family=Andika:wght@400;700&display=swap" rel="stylesheet"> -->
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
			font-family: 'Inter', sans-serif;
		}
		p{
			font-size: 16pxs;
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

				<h5 class="text-dark mb-3 mt-3">Alumni Insights</h5>
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
											<h4 class="title">Alumni</h4>
											<div class="info">
												<strong class="amount"><?php echo $alumni ?></strong>
												<span class="text-muted">(All members of the SAANA family)</span>
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
											<i class="fas fa-user-clock"></i>
										</div>
									</div>
									<div class="widget-summary-col">
										<div class="summary"><br>
											<h4 class="title">Membership Pending</h4>
											<div class="info">
												<strong class="amount"><?php echo $inactive ?></strong>
												<span class="text-muted">(Alumni with inactive membership)</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</section>
					</div>

					<div class="col-lg-6">
						<section class="card card-featured-left card-featured-secondary mb-4">
							<div class="card-body">
								<div class="widget-summary">
									<div class="widget-summary-col widget-summary-col-icon">
										<div class="summary-icon bg-secondary">
											<i class="fas fa-user-check"></i>
										</div>
									</div>
									<div class="widget-summary-col">
										<div class="summary"><br>
											<h4 class="title">Membership Completed </h4>
											<div class="info">
												<strong class="amount"><?php echo $active ?></strong>
												<span class="text-muted">(Alumni with active membership)</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</section>
					</div>

					<div class="col-lg-6">
						<section class="card card-featured-left card-featured-tertiary mb-4">
							<div class="card-body">
								<div class="widget-summary">
									<div class="widget-summary-col widget-summary-col-icon">
										<div class="summary-icon bg-tertiary"><i class="fas fa-comment-dollar"></i>
										</div>
									</div>
									<div class="widget-summary-col">
										<div class="summary"><br>
											<h4 class="title">Payment Pending</h4>
											<div class="info">
												<strong class="amount"><?php echo $pending ?></strong>
												<span class="text-muted">(Almuni with pending payments)</span>
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
									<!-- <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a> -->
								</div>

								<h2 class="card-title">Alumni By States</h2>
								<p class="card-subtitle">Stats about number of alumni from different states.</p>
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

								<h2 class="card-title">RECENTLY JOINED MEMBERS</h2>
							</header>
							<div class="card-body">
								<table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
									<thead>
										<tr>
											<th>Member Since</th>
											<th>Name</th>
											<th>Email</th>
											<th>Year</th>
											<th>Department</th>
											<th>Membership</th>
											<th>Details</th>
										</tr>
									</thead>
									<tbody>
										<?php
										foreach ($users as $user) : ?>
											<tr>
												<td data-title="date">
													<?php
													$registration_date = $user['registration_date'];
													$date = date("d", strtotime($registration_date));  // Day as a number
													$month = date("F", strtotime($registration_date));
													$year = date("Y", strtotime($registration_date)); // Month as a full string
													echo $month . " " . $date . " , " . $year;
													?>
												</td>
												<td data-tilte="name"><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></td>
												<td data-tilte="email"><?php echo $user['email_id']; ?></td>
												<td data-tilte="yog"><?php echo $user['year_of_graduation']; ?></td>
												<td data-tilte="branch"><?php echo $user['dept']; ?></td>
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
													<a class="modal-with-form" href="#modalHeaderColorPrimary">
														<button data-email="<?php echo $user['email_id']; ?>" data-mobile="<?php echo $user['mobile']; ?>" data-first="<?php echo $user['first_name']; ?>" data-last="<?php echo $user['last_name']; ?>" data-middle="<?php echo $user['middle_name']; ?>" data-maiden="<?php echo $user['maiden_name']; ?>" data-nickname="<?php echo $user['nickname']; ?>" data-address="<?php echo $user['address_line']; ?>" data-zip="<?php echo $user['postal_code']; ?>" data-city="<?php echo $user['city']; ?>" data-state="<?php echo $user['state']; ?>" data-country="<?php echo $user['country']; ?>" data-graduation="<?php echo $user['year_of_graduation']; ?>" data-branch="<?php echo $user['dept']; ?>" data-org="<?php echo $user['current_organization']; ?>" data-role="<?php echo $user['curr_role']; ?>" class="userinfo btn btn-primary">View</button>
													</a>
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
				<form id="userForm" action="dashboard_update.php" method="POST">
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
</body>

</html>