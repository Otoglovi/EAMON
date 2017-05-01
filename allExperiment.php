<?php
// Code below was developed with the help of :
// Limitless - Responsive Web Application Kit
// By: Eugene Kopyov

session_start();
require_once 'functions.php';
require_once 'connection.php';
$user=$_SESSION['user'];
$fullname=$_SESSION['fullname'];
$role=$_SESSION['role'];
require 'PHPMailer/PHPMailerAutoload.php';
if (isset($_POST['saveAssign'])){
     $id=$_POST['experimentId'];
     $title=$_POST['title'];
    $eao=$_POST['eao'];

    $arrayeao=array();
    $arrayemails=array();
    foreach ($eao as $ea){
        $rip=explode("|",$ea);
        array_push($arrayeao,$rip['0']);
        array_push($arrayemails,$rip['1']);
    }

    $eaos=implode(",",$arrayeao);
   echo $eaos="[".$eaos."]";

   $query=mysqli_query($link,"UPDATE experiments SET eao='$eaos' WHERE id='$id'" );

foreach ($arrayemails as $receiver) {
    $receiver = $receiver;

    $username = "EAMON ALERTS";

    $emailadd = $receiver;

    $subject = 'EAMON EXPERIMENT ALERTS';

    $mbody = 'Please be informed a new experiment has just been assigned to you';
    $altbody = 'Please be informed a new experiment has just been assigned to you';


    //Create a new PHPMailer instance
    $mail = new PHPMailer();

    //Tell PHPMailer to use SMTP
    $mail->isSMTP();

    //Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug = 2;

//Ask for HTML-friendly debug output
    $mail->Debugoutput = 'html';

//Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
    $mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
    $mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
    $mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
// $mail -> Username = "abrahamodoi2002@gmail.com";
    $mail->Username = "rguexperiments@gmail.com";

//Password to use for SMTP authentication
    $mail->Password = "rguexperiments01";

//Set who the message is to be sent from
    $mail->setFrom('rguexperiments@gmail.com', 'EAMON ALERTS');

//Set an alternative reply-to address
    $mail->addReplyTo('rguexperiments@gmail.com', 'EAMON ALERTS');

//Set who the message is to be sent to
    $mail->addAddress($emailadd, $username);
//Set the subject line
    $mail->Subject = $subject;

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
// $mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));

    $mail->Body = $mbody;

//Replace the plain text body with one created manually
    $mail->AltBody = $altbody;

//Attach an image file
// $mail->addAttachment("dailystats.".$yest.".csv");
//send the message, check for errors
    if (!$mail->send()) {
//        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
//        echo PHP_EOL . "Message sent @ " . date('Y-m-d H:i:s');
    }
}
exit;
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
    <script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>

    <script type="text/javascript" src="assets/js/core/app.js"></script>
    <script type="text/javascript" src="assets/js/pages/datatables_basic.js"></script>
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
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Experiments</span> - All </h4>
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

                    <table class="table datatable-pagination">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>EAO</th>
                            <th>Ethics</th>
                            <th>Other Attachment</th>
                            <?php if ($role=='admin'){ ?>
                            <th>Assign</th>
                            <?php };?>
                            <?php if ($role=='eao'){ ?>
                                <th>Approve</th>
                            <?php };?>
                            <?php if ($role=='eao'){ ?>
                                <th>Disapprove</th>
                            <?php };?>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($role=='admin'){
                                    $query = mysqli_query($link, "SELECT * FROM experiments where status='pending'");
                                }elseif ($role=='eao'){
                                    $query = mysqli_query($link, "SELECT * FROM experiments where eao LIKE '%$fullname%'");
                                }elseif ($role=='student'){
                                    $query = mysqli_query($link, "SELECT * FROM experiments where student='$user'");
                                }
                            $queryEAO = mysqli_query($link, "SELECT * FROM users where type='eao'");
                            $myarray=array();
                            while($as=mysqli_fetch_array($queryEAO)){
                                array_push($myarray,$as['fullName']."|".$as['email']);
                            }
                            while($a=mysqli_fetch_array($query)){
                               ?>
                                   <tr>
                                        <td><?php echo $a['title'];?></td>
                                        <td><?php echo $a['description']; ?></td>
                                        <td><?php echo $a['status']; ?></td>
                                        <td><?php echo $a['startdate']; ?></td>
                                        <td><?php echo $a['enddate']; ?> </td>
                                        <td><?php echo $a['eao']; ?> </td>
                                        <td><a href="uploads/<?php echo $a['ethics']; ?>" target="_blank"><button class="btn btn-primary">View</button></a></td>
                                       <td><a href="uploads/<?php echo $a['otherfiles']; ?>" target="_blank"><button class="btn btn-warning">View</button></a></td>
                                       <?php if ($role=='admin'){ ?>
                                           <td><button class="btn btn-success" data-toggle="modal" data-target="#myModal" onclick="feedModal('<?php echo $a['id']; ?>','<?php echo $a['title']; ?>')">Assign</button></td>
                                       <?php }?>
                                       <?php if ($role=='eao'){ ?>
                                           <td><button class="btn btn-success" onclick="approve('<?php echo $a['id']; ?>','<?php echo $a['title']; ?>','approve')">Approve</button></td>
                                       <?php }?>
                                       <?php if ($role=='eao'){ ?>
                                           <td><button class="btn btn-success" onclick="approve('<?php echo $a['id']; ?>','<?php echo $a['title']; ?>','disapprove')">Disapprove</button></td>
                                       <?php }?>
                                    </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
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
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">ASSIGN EXPERIMENT</h4>
            </div>
            <form action="" method="post">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <input type="hidden" id="experimentId" name="experimentId">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2">
                        <label class="control-label">Assign:</label>
                    </div>
                    <div class="col-lg-10">
                        <input id="title" name="title" class="col-lg-10 form-control" type="text" readonly>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-2">
                        <label class="control-label">To:</label>
                    </div>
                    <div class="col-lg-10">
                        <select name="eao[]" multiple="multiple" data-placeholder="Click to Select EAO" class="select-icons form-control">
                            <optgroup label="Experiment Approval Officers">
                                <?php
                                foreach ($myarray as $as){
                                    $name=explode('|',$as);
                                    echo "<option value='".$as."'>".$name['0']."</option>";
                                }
                                ?>
                            </optgroup>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input name="saveAssign" type="submit" class="btn btn-success"/>
            </div>
            </form>
        </div>

    </div>
</div>
<script>
    function feedModal(id,name) {
        $("#experimentId").val(id);
        $("#title").val(name);

    }

    function approve(id,name,key) {
        var approveConfirm= confirm('Are you sure you want to '+key+' the experiment '+name);
        if(approveConfirm==true){
            $.post("changeStatus.php",{
                key:key,
                id:id
            },function (data) {
                alert(data);
                location.reload();
            })
        }

    }
</script>
<sc
</body>
</html>
