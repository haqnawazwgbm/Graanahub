<?php include_once("includes/header.php"); ?>
<?php include_once("includes/menu.php"); ?>
<?php include_once("includes/sidebar.php"); ?>

	     	<?php include_once('includes/alerts.php'); ?>
                <div class="content container-fluid">
					<div class="row">
					
					
						<div class="col-md-6 col-sm-6 col-lg-3">
							<div class="dash-widget clearfix card-box salary-box">
								<div class="dash-widget-info">
									<h1><?php echo number_format($basic_salaries);
									?>
										
									</h1>
									<span>Total Paid Net Salary</span>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-lg-3">
							<div class="dash-widget clearfix card-box accepted-request-box">
								<div class="dash-widget-info">
									<h1><?php echo $accepted_requests;
									?>
										
									</h1>
									<span>Accepted Requests</span>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-lg-3">
							<div class="dash-widget clearfix card-box rejected-request-box">
								<div class="dash-widget-info">
									<h1><?php echo $rejected_requests;
									?>
										
									</h1>
									<span>Rejected Requests</span>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-lg-3">
							<div class="dash-widget clearfix card-box pending-request-box">
								<div class="dash-widget-info">
									<h1><?php echo $pending_requests;
									?>
										
									</h1>
									<span>Pending Requests</span>
								</div>
							</div>
						</div>
					
						
					</div>
		
					</div>
				</div>			
			</div>
<?php include_once("includes/footer.php"); ?>