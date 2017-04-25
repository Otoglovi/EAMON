// Code below was developed with the help of :
// Limitless - Responsive Web Application Kit
// By: Eugene Kopyov

<?php
session_start();
require_once 'functions.php';
$user=$_SESSION['user'];
$role='student';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>EAMON-Ethical Approval Monitoring for RGU Experiments</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="assets/css/colors.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="assets/js/plugins/visualization/d3/d3.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script type="text/javascript" src="assets/js/plugins/ui/moment/moment.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/pickers/daterangepicker.js"></script>

	<script type="text/javascript" src="assets/js/core/app.js"></script>
	<script type="text/javascript" src="assets/js/pages/dashboard.js"></script>
	<!-- /theme JS files -->

</head>

<body class="navbar-bottom">

	<?php
        include 'header.php';
    ?>


	<!-- Page header -->
	<div class="page-header">
		<div class="breadcrumb-line">
			<ul class="breadcrumb">
				<li><a href=""><i class="icon-home2 position-left"></i> Home</a></li>
				<li class="active">Dashboard</li>
			</ul>
		</div>

		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Dashboard </h4>
			</div>

			<div class="heading-elements">
				<div class="heading-btn-group">
					<a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span></span></a>
					<a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span></span></a>
					<a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span></span></a>
				</div>
			</div>
		</div>
	</div>
	<!-- /page header -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

            <?php
                include 'navigation.php';
            ?>


			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Dashboard content -->
				<div class="row">
					<div class="col-lg-8">

						<!-- Quick stats boxes -->
						<div class="row">
							<div class="col-lg-4">

								<div class="panel bg-teal-400">
									<div class="panel-body">
										<div class="heading-elements">
											<span class="heading-text badge bg-teal-800">Total Experiments</span>
										</div>

										<h3 class="no-margin"><?php countExperiments($user,'all',$role) ?></h3>
                                        Total Experiments
									</div>

									<div class="container-fluid">
										<div id="members-online"></div>
									</div>
								</div>

							</div>
                            <div class="col-lg-4">

                                <div class="panel bg-pink-400">
                                    <div class="panel-body">
                                        <div class="heading-elements">
                                            <span class="heading-text badge bg-pink-800"> Pending Experiments</span>
                                        </div>

                                        <h3 class="no-margin"><?php countExperiments($user,'pending',$role) ?></h3>
                                        Pending Experiments
                                    </div>

                                    <div class="container-fluid">
                                        <div id="members-online"></div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-4">

                                <div class="panel bg-blue-400">
                                    <div class="panel-body">
                                        <div class="heading-elements">
                                            <span class="heading-text badge bg-blue-800"> Approved Experiments</span>
                                        </div>

                                        <h3 class="no-margin"><?php countExperiments($user,'approved',$role) ?></h3>
                                        Approved Experiments
                                    </div>

                                    <div class="container-fluid">
                                        <div id="members-online"></div>
                                    </div>
                                </div>

                            </div>
						</div>
						<!-- /quick stats boxes -->


						<!-- Support tickets -->
						<div class="panel panel-flat">

							<div class="table-responsive">
								<table class="table table-xlg text-nowrap">
									<tbody>
									</tbody>
								</table>
							</div>

							<div class="table-responsive">
								<table class="table text-nowrap">
									<thead>
										<tr align="center">
											<th>Created</th>
											<th>Status</th>
											<th>Title</th>
										</tr>
									</thead>
									<tbody>
                                        <?php
                                            fetchExperiments($user,$role);
                                        ?>

									</tbody>
								</table>
							</div>
						</div>
						<!-- /support tickets -->


					</div>

					<div class="col-lg-4">

						<!-- Progress counters -->
						<div class="row">
							<div class="col-md-6">

								<!-- Available hours -->
								<div class="panel text-center">
									<div class="panel-body">
										<div class="heading-elements">
											<ul class="icons-list">
						                		<li class="dropdown text-muted">
						                			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog3"></i> <span class="caret"></span></a>
													<ul class="dropdown-menu dropdown-menu-right">
														<li><a href="#"><i class="icon-sync"></i> Update data</a></li>
														<li><a href="#"><i class="icon-list-unordered"></i> Detailed log</a></li>
														<li><a href="#"><i class="icon-pie5"></i> Statistics</a></li>
														<li><a href="#"><i class="icon-cross3"></i> Clear list</a></li>
													</ul>
						                		</li>
						                	</ul>
					                	</div>

					                	<!-- Progress counter -->
										<div class="content-group-sm svg-center position-relative" id="hours-available-progress"></div>
										<!-- /progress counter -->


										<!-- Bars -->
										<div id="hours-available-bars"></div>
										<!-- /bars -->

									</div>
								</div>
								<!-- /available hours -->

							</div>

							<div class="col-md-6">

								<!-- Productivity goal -->
								<div class="panel text-center">
									<div class="panel-body">
										<div class="heading-elements">
											<ul class="icons-list">
						                		<li class="dropdown text-muted">
						                			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog3"></i> <span class="caret"></span></a>
													<ul class="dropdown-menu dropdown-menu-right">
														<li><a href="#"><i class="icon-sync"></i> Update data</a></li>
														<li><a href="#"><i class="icon-list-unordered"></i> Detailed log</a></li>
														<li><a href="#"><i class="icon-pie5"></i> Statistics</a></li>
														<li><a href="#"><i class="icon-cross3"></i> Clear list</a></li>
													</ul>
						                		</li>
						                	</ul>
										</div>

										<!-- Progress counter -->
										<div class="content-group-sm svg-center position-relative" id="goal-progress"></div>
										<!-- /progress counter -->

										<!-- Bars -->
										<div id="goal-bars"></div>
										<!-- /bars -->

									</div>
								</div>
								<!-- /productivity goal -->

							</div>
						</div>
						<!-- /progress counters -->



					</div>
				</div>
				<!-- /dashboard content -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->


	<!-- Footer -->
	<div class="navbar navbar-default navbar-fixed-bottom footer">
		<ul class="nav navbar-nav visible-xs-block">
			<li><a class="text-center collapsed" data-toggle="collapse" data-target="#footer"><i class="icon-circle-up2"></i></a></li>
		</ul>

		<div class="navbar-collapse collapse" id="footer">

			<div class="navbar-right">
				<ul class="nav navbar-nav">
					<li><a href="#">About</a></li>
					<li><a href="#">Terms</a></li>
					<li><a href="#">Contact</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /footer -->

</body>
</html>
