// Code below was developed with the help of :
// Limitless - Responsive Web Application Kit
// By: Eugene Kopyov

<?php
	 $role=$_SESSION['role'];


?>
<!-- Main sidebar -->
<div class="sidebar sidebar-main sidebar-default">
	<div class="sidebar-content">

		<!-- Main navigation -->
		<div class="sidebar-category sidebar-category-visible">
			<div class="category-title h6">
				<span>Main navigation</span>
				<ul class="icons-list">
					<li><a href="index.html#" data-action="collapse"></a></li>
				</ul>
			</div>

			<div class="category-content no-padding">
				<ul class="navigation navigation-main navigation-accordion">

					<!-- Main -->
					<li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
					<li class="active" ><a href="dashboard.php"><i class="icon-home4"></i> <span>Dashboard</span></a></li>

                    <li class="active" style="display: <?php if ($role=='student' ||$role=='eao' ){ echo 'none'; }?>">
						<a href="" style="background: #29b6f6;"><i class="icon-stack2"></i> <span>Users</span></a>
						<ul>
							<li><a href="allUsers.php">User Info</a></li>
							<li><a href="newUser.php">Add User</a></li>
						</ul>
					</li>

                    <li class="active">
						<a href="" style="background: #29b6f6;"><i class="icon-copy"></i> <span>Experiments</span></a>
						<ul>
							<li><a href="allExperiment.php" id="layout1">All Experiments</a></li>
							<li><a href="newExperiment.php" id="layout2"  style="display: <?php  if ($role=='admin' || $role=='eao' ){ echo 'none'; }?>">New Experiment</a></li>
						</ul>
					</li>

					<li class="active">
						<a href="" style="background: #29b6f6;"><i class="icon-copy"></i> <span>Reports</span></a>
						<ul>
							<li><a href="pendingExperiments.php" id="layout1">Pending Experiments</a></li>
							<li><a href="approvedExperiments.php" id="layout2">Approved Experiment</a></li>
						</ul>
					</li>
					<!-- /main -->

				</ul>
			</div>
		</div>
		<!-- /main navigation -->

	</div>
</div>
<!-- /main sidebar -->