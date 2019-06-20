<?php include_once("includes/header.php"); ?>
<?php include_once("includes/menu.php"); ?>
<?php include_once("includes/sidebar.php"); ?>

	     	<?php include_once('includes/alerts.php'); ?>
                <div class="content container-fluid">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-lg-3">
							<div class="dash-widget clearfix card-box employees-box">
<!-- 								<span class="dash-widget-icon"><i class="fa fa-user" aria-hidden="true"></i></span>
 -->								<div class="dash-widget-info">
									<h1><?= $users; ?></h1>
									<span>Active Employees</span>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-lg-3">
							<div class="dash-widget clearfix card-box department-box">
								<div class="dash-widget-info">
									<h1><?= $departments; ?></h1>
									<span>Departments</span>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-lg-3">
							<div class="dash-widget clearfix card-box salary-box">
								<div class="dash-widget-info">
									<h1><?php $net_salary = $salary['basic_salary'] + $salary['house_rent_allowance'] + $salary['medical_allowance'] + $salary['travelling_allowance'] - $salary['provident_fund']; 
									echo number_format($net_salary);
									?>
										
									</h1>
									<span>Total Net Salary</span>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-lg-3">
							<div class="dash-widget clearfix card-box designation-box">
								<div class="dash-widget-info">
									<h1><?= $designations; ?></h1>
									<span>Designations</span>
								</div>
							</div>
						</div>
						
					</div>
		
					</div>
				</div>			
			</div>
<?php include_once("includes/footer.php"); ?>