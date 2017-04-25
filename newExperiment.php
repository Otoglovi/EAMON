// Code below was developed with the help of :
// Limitless - Responsive Web Application Kit
// By: Eugene Kopyov

<?php
session_start();
require_once 'functions.php';
require_once 'connection.php';
$user=$_SESSION['user'];
$role='student';

if(isset($_POST['submit'])){
     $title=$_POST['title'];
    $description=$_POST['description'];
     $startdate=$_POST['startdate'];
    $enddate=$_POST['enddate'];
    $description=$_POST['description'];

    $target_dir = "uploads/";

    $ethics_file = $target_dir . basename($_FILES["ethics"]["name"]);
    $ethics=basename( $_FILES['ethics']['name']);
    move_uploaded_file($_FILES['ethics']['tmp_name'], $ethics_file);

    $other_file = $target_dir . basename($_FILES["otherfiles"]["name"]);
    $otherfiles=basename( $_FILES['otherfiles']['name']);
    move_uploaded_file($_FILES['otherfiles']['tmp_name'], $other_file);

       $query= mysqli_query($link,"INSERT INTO experiments (title, description, status, student, startdate, enddate, ethics, otherfiles)
VALUES
('$title', '$description', 'pending', '$user', '$startdate', '$enddate', '$ethics', '$otherfiles');"
) ;
       if ($query){
           $alert= "<div class=\"alert alert-primary alert-bordered\">
									<button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span>&times;</span><span class=\"sr-only\">Close</span></button>
									<span class=\"text-semibold\">Success!</span> Experiment successfully sent for review
							    </div>";
       }else{
           $alert= "<div class=\"alert alert-warning alert-bordered\">
									<button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span>&times;</span><span class=\"sr-only\">Close</span></button>
									<span class=\"text-semibold\">Failed!</span> Experiment creation failed 
							    </div>";
       }
}

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
    <script type="text/javascript" src="assets/js/pages/form_layouts.js"></script>
	<!-- /theme JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>

    <script type="text/javascript" src="assets/js/core/app.js"></script>
    <script type="text/javascript" src="assets/js/pages/form_layouts.js"></script>
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
				<li><a href=""><i class="icon-home2 position-left"></i>Experiment</a></li>
				<li class="active">New</li>
			</ul>
		</div>

		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Experiments</span> - New </h4>
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
                    <!-- 2 columns form -->
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">Experiment Details</h5>
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li><a data-action="collapse"></a></li>
                                        <li><a data-action="reload"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <?php
                                if(isset($alert)){
                                    echo $alert;
                                }
                            ?>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Title:</label>
                                            <input type="text" name="title" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Start Date:</label>
                                            <input type="date" name="startdate" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>End Date:</label>
                                            <input type="date" name="enddate" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description:</label>
                                            <textarea class="form-control" name="description" rows="10" cols="100"> </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Attach Ethics:</label>
                                            <input type="file" name="ethics" class="file-styled">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Other Attachments:</label>
                                            <input type="file" name="otherfiles" class="file-styled">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" name="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- /2 columns form -->
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
			<div class="navbar-text">
				&copy; 2015. <a href="#" class="navbar-link">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" class="navbar-link" target="_blank">Eugene Kopyov</a>
			</div>

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
